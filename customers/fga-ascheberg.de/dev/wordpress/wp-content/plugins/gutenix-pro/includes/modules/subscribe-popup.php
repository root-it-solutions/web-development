<?php
/**
 * Gutenix_Pro_Subscribe_Popup class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Subscribe_Popup' ) ) {

	/**
	 * Define Gutenix_Pro_Subscribe_Popup class
	 */
	class Gutenix_Pro_Subscribe_Popup extends Gutenix_Pro_Module_Base {

		/**
		 * Is enabled subscribe popup.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    null|bool
		 */
		private $is_subscribe_popup_enabled = null;

		/**
		 * Added options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				'subscribe_popup_panel' => array(
					'title'    => esc_html__( 'Subscribe Popup', 'gutenix-pro' ),
					'priority' => 50,
					'type'     => 'section',
					'panel'    => 'general_settings',
				),
				'subscribe_popup' => array(
					'title'    => esc_html__( 'Enable', 'gutenix-pro' ),
					'section'  => 'subscribe_popup_panel',
					'default'  => false,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'subscribe_popup_bg' => array(
					'title'    => esc_html__( 'Background Image', 'gutenix-pro' ),
					'section'  => 'subscribe_popup_panel',
					'default'  => '',
					'field'    => 'image',
					'type'     => 'control',
					'conditions'  => array(
						'subscribe_popup' => true,
					),
				),
				'subscribe_popup_content' => array(
					'title'       => esc_html__( 'Content', 'gutenix-pro' ),
					'section'     => 'subscribe_popup_panel',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
					'conditions'  => array(
						'subscribe_popup' => true,
					),
				),
				'subscribe_popup_shortcode' => array(
					'title'       => esc_html__( 'Form Shortcode', 'gutenix-pro' ),
					'section'     => 'subscribe_popup_panel',
					'default'     => '',
					'field'       => 'text',
					'type'        => 'control',
					'conditions'  => array(
						'subscribe_popup' => true,
					),
				),
			);
		}

		/**
		 * Modify posts list selective refresh partial
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function selective_refresh_partials() {
			return array(
				'subscribe_popup_enable' => array(
					'settings' => array( 'subscribe_popup' ),
				),
			);
		}

		/**
		 * Add or remove module-related hooks
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function hooks() {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
			add_action( 'gutenix_body_end', array( $this, 'render_subscribe_popup' ), 20, 2);
		}

		/**
		 * Check comment likes is enabled.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return null|bool
		 */
		public function is_subscribe_popup_enabled() {

			if ( null === $this->is_subscribe_popup_enabled ) {
				$this->is_subscribe_popup_enabled = gutenix_theme()->customizer->get_value( 'subscribe_popup' );
			}

			return $this->is_subscribe_popup_enabled;
		}

		/**
		 * Register assets.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function register_assets() {
			
			if( $this->is_subscribe_popup_enabled() ) {
				
				wp_enqueue_style( 'gutenix-subscribe-popup', gutenix_pro()->plugin_url( 'assets/lib/jquery-subscribe-popup/subscribe-popup.css' ), array(), '1.0.0' );

				wp_enqueue_script( 'js-cookie', gutenix_pro()->plugin_url( 'assets/lib/jquery-subscribe-popup/cookie.js' ), array( 'jquery' ), '1.5.1', true );
				
				wp_enqueue_script( 'gutenix-jquery-subscribe-popup', gutenix_pro()->plugin_url( 'assets/lib/jquery-subscribe-popup/jquery-subscribe-popup.js' ), array( 'jquery' ), '1.0.0', true );
			}
		}

		/**
		 * Added additional template part slugs.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $slug Default slug.
		 * @return string
		 */
		function render_subscribe_popup() {

			$subscribe_popup_bg 	= gutenix_theme()->customizer->get_value( 'subscribe_popup_bg' );
			$content 				= gutenix_theme()->customizer->get_value( 'subscribe_popup_content' );
			$shortcode 				= gutenix_theme()->customizer->get_value( 'subscribe_popup_shortcode' );

			$allowed_html = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
				),
				'img' => array(
					'src' => array(),
					'alt' => array(),
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'p' => array(),
				'h1' => array(),
				'h2' => array(),
				'h3' => array(),
				'h4' => array(),
				'h5' => array(),
				'h6' => array(),
			);
			
			if( $this->is_subscribe_popup_enabled() ) {
				?>
				
				<div id="gutenix_pro-subscribe_popup">
					<button class="gutenix_pro-subscribe_popup-close" type="button" title="Close (Esc)"><?php echo gutenix_get_icon_svg( 'close' ); ?></button>
			        <?php if( !empty( $subscribe_popup_bg ) ) { ?>
						<div class="gutenix_pro-subscribe_popup_left" style="background-image: url(<?php echo esc_url( $subscribe_popup_bg ); ?>);"></div>
					<?php } ?>
			        <div class="gutenix_pro-subscribe_popup_right">
						<div class="gutenix_pro-subscribe_popup_wrap_content">

						    <?php
								if ( $content ) {
									echo wp_kses( $content, $allowed_html);
								}

								echo ( shortcode_exists('mc4wp_form') ) ? do_shortcode( $shortcode ) : '';
							?>
						</div>
						<p class="checkbox-label align-center">
						    <input type="checkbox" value="do-not-show" name="showagain" id="showagain" class="showagain" />
						    <label for="showagain"><?php esc_html_e("Don't show this popup again", 'gutenix-pro'); ?></label>
						</p>
			        </div>
				</div>
				<div class="gutenix_pro-subscribe_popup-overlay"></div>

				<?php
			}
        }
	}
}
