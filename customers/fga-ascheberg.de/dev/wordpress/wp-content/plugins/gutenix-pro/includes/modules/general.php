<?php
/**
 * Gutenix_Pro_General class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_General' ) ) {

	/**
	 * Define Gutenix_Pro_General class
	 */
	class Gutenix_Pro_General extends Gutenix_Pro_Module_Base {

		/**
		 * Is enabled subscribe popup.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    null|bool
		 */
		private $is_sticky_sidebar_enabled = null;

		/**
		 * Added blog posts options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				'sidebar_width' => array(
					'title' 			=> esc_html__( 'Sidebar Width, %', 'gutenix-pro' ),
					'section' 			=> 'page_layout',
					'priority' 			=> 5,
					'default' 			=> 33,
					'field' 			=> 'gutenix-range',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions'  => array(
						'layout_type_pages' => array( 'boxed-content-sidebar', 'boxed-sidebar-content' ),
					),
				),

				/** `Sidebar` section */
				'sidebar_section' => array(
					'title' 			=> esc_html__( 'Sidebar', 'gutenix-pro' ),
					'priority' 			=> 20,
					'type' 				=> 'section',
					'panel' 			=> 'general_settings',
				),
				'sidebar_fixed' => array(
					'title' 			=> esc_html__( 'Sticky Effect', 'gutenix-pro' ),
					'section' 			=> 'sidebar_section',
					'default' 			=> false,
					'field' 			=> 'gutenix-toggle-checkbox',
					'type' 				=> 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'sidebar_dynamic_generator' => array(
					'title' 			=> esc_html__( 'Dynamic Sidebar Generator', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Enter a name (Without special characters) for the sidebar, then click on "Add More" to add a new sidebar.', 'gutenix-pro' ),
					'section' 			=> 'sidebar_section',
					'default' 			=> '',
					'field' 			=> 'gutenix-multi-field',
					'type' 				=> 'control',
				),

				/* Page Title */
				'page_title_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'page_title_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'page_title_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> array(
						'desktop' => '48',
						'tablet'  => '',
						'mobile'  => '',
					),
					'field' 			=> 'gutenix-input-responsive',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min' => 0,
					),
					'unit_choices' 		=> '',
					'dynamic_css' 		=> true,
					'sanitize_callback' => 'sanitize_input_responsive',
				),
				'page_title_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> '1.2',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'page_title_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'page_title_text_align' => array(
					'title' 			=> esc_html__( 'Text Align', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> 'inherit',
					'field' 			=> 'gutenix-radio-image',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_align_options(),
					'dynamic_css' 		=> true,
				),
				'page_title_text_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
				),
				'page_title_text_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'page_title_vertical_padding' => array(
					'title' 			=> esc_html__( 'Vertical Padding, px', 'gutenix' ),
					'section' 			=> 'page_title_section',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '', 'bottom' => '' ),
						'tablet'  => array( 'top' => '', 'bottom' => '' ),
						'mobile'  => array( 'top' => '', 'bottom' => ''	),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
				),

				/** `404 Page` section */
				'page404' => array(
					'title' 			=> esc_html__( '404 Error Page', 'gutenix-pro' ),
					'priority' 			=> 25,
					'type' 				=> 'section',
					'panel' 			=> 'general_settings',
				),
				'page404_layout' => array(
					'title' 			=> esc_html__( 'Layout', 'gutenix-pro' ),
					'section' 			=> 'page404',
					'priority' 			=> 5,
					'default' 			=> 'boxed-full-width',
					'field' 			=> 'gutenix-radio-image',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_boxed_wide_layout_options(),
				),
				'page404_template' => array(
					'title' 			=> esc_html__( 'Select Template', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Choose a template created in Pages', 'gutenix-pro' ),
					'section' 			=> 'page404',
					'default' 			=> '0',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_custom_template( 'page' ),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),

				/** `Google Api Key` section */
				'google_api_key_section' => array(
					'title' 			=> esc_html__( 'Google Map API Key', 'gutenix-pro' ),
					'priority' 			=> 35,
					'type' 				=> 'section',
					'panel' 			=> 'general_settings',
				),
				'google_map_api_key' => array(
					'title' 			=> esc_html__( 'API Key', 'gutenix-pro' ),
					'section' 			=> 'google_api_key_section',
					'default' 			=> '',
					'field' 			=> 'text',
					'type' 				=> 'control',
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
			add_action( 'wp_enqueue_scripts', 				array( $this, 'register_assets' ) );
			add_filter( 'gutenix_get_dynamic_css_options', 	array( $this, 'dynamic_css_file' ) );
		}

		/**
		 * Check sticky sidebar is enabled.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return null|bool
		 */
		public function is_sticky_sidebar_enabled() {

			if ( null === $this->is_sticky_sidebar_enabled ) {
				$this->is_sticky_sidebar_enabled = gutenix_theme()->customizer->get_value( 'sidebar_fixed' );
			}

			return $this->is_sticky_sidebar_enabled;
		}

		/**
		 * Register assets.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function register_assets() {
			
			if( $this->is_sticky_sidebar_enabled() ) {
				wp_enqueue_script( 'theia-sticky-sidebar', gutenix_pro()->plugin_url( 'assets/lib/sticky-sidebar/theia-sticky-sidebar.min.js' ), array( 'jquery' ), '1.7.0', true );
			}

			// Google Api Key
			$api 		= gutenix_theme()->customizer->get_value( 'google_map_api_key' );
			$protocol 	= is_ssl() ? 'https://' : 'http://';
			if( ! empty( $api ) ) {
				wp_enqueue_script( 'google-map', esc_url( $protocol . 'maps.google.com/maps/api/js?key=' . esc_attr( $api ) ), array(), '', true );
			}
		}

		/**
		 * Added dynamic css file.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $options Dynamic Css options.
		 * @return array
		 */
		public function dynamic_css_file( $options = array() ) {

			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/dynamic-css.php' );
			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/general.css' );

			return $options;
		}
	}
}
