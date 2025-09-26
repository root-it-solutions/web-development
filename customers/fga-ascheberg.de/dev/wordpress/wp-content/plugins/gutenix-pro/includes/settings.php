<?php
/**
 * Gutenix_Pro_Settings class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Settings' ) ) {

	/**
	 * Define Gutenix_Pro_Settings class
	 */
	class Gutenix_Pro_Settings {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    Gutenix_Pro_Settings
		 */
		private static $instance = null;

		/**
		 * Settings key
		 *
		 * @since  1.0.0
		 * @access public
		 * @var   string
		 */
		public $key = 'gutenix-pro-settings';

		/**
		 * Interface builder instance
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    CX_Interface_Builder
		 */
		public $builder = null;

		/**
		 * Settings values
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    null
		 */
		public $settings = null;

		/**
		 * Available Modules array
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    array
		 */
		public $available_modules = array();

		/**
		 * Constructor for the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init() {

			add_action( 'admin_enqueue_scripts', array( $this, 'init_builder' ), 0 );
			add_action( 'admin_enqueue_scripts', array( $this, 'register_controls' ), 5 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ), 10 );

			add_action( 'admin_menu',    array( $this, 'register_page' ), 99 );
			add_action( 'init',          array( $this, 'save' ), 40 );
			add_action( 'admin_notices', array( $this, 'saved_notice' ) );

			foreach ( glob( gutenix_pro()->plugin_path( 'includes/modules/' ) . '*.php' ) as $file ) {
				$slug = basename( $file, '.php' );
				$name = ucwords( str_replace( '-', ' ', $slug ) );

				$this->available_modules[ $slug ] = $name;
			}

		}

		/**
		 * Initialize page builder module if required
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init_builder() {

			if ( ! isset( $_REQUEST['page'] ) || $this->key !== $_REQUEST['page'] ) {
				return;
			}

			$builder_data = gutenix_pro()->framework->get_included_module_data( 'cherry-x-interface-builder.php' );

			$this->builder = new CX_Interface_Builder(
				array(
					'path' => $builder_data['path'],
					'url'  => $builder_data['url'],
				)
			);
		}

		/**
		 * Register controls for settings page
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function register_controls() {

			if ( ! isset( $_REQUEST['page'] ) || $this->key !== $_REQUEST['page'] ) {
				return;
			}

			$this->builder->register_section(
				array(
					'gutenix_pro_settings' => array(
						'type'   => 'section',
						'scroll' => false,
						'title'  => esc_html__( 'Gutenix Settings', 'gutenix-pro' ),
					),
				)
			);

			$this->builder->register_form(
				array(
					'gutenix_pro_settings_form' => array(
						'type'   => 'form',
						'parent' => 'gutenix_pro_settings',
						'action' => add_query_arg(
							array( 'page' => $this->key, 'action' => 'save-settings' ),
							esc_url( admin_url( 'themes.php' ) )
						),
					),
				)
			);

			$this->builder->register_settings(
				array(
					'settings_top' => array(
						'type'   => 'settings',
						'parent' => 'gutenix_pro_settings_form',
					),
					'settings_bottom' => array(
						'type'   => 'settings',
						'parent' => 'gutenix_pro_settings_form',
					),
				)
			);

			$default_available_modules = array();

			foreach ( $this->available_modules as $key => $value ) {
				$default_available_modules[ $key ] = 'true';
			}

			$controls = array(
				'available_modules' => array(
					'type'        => 'checkbox',
					'id'          => 'available_modules',
					'name'        => 'available_modules',
					'value'       => $this->get( 'available_modules', $default_available_modules ),
					'options'     => $this->available_modules,
					'parent'      => 'settings_top',
					'title'       => esc_html__( 'Available Pro Modules', 'gutenix-pro' ),
					'description' => esc_html__( 'List of modules that will be available', 'gutenix-pro' ),
					'class'       => 'gutenix_pro_settings_form__checkbox-group'
				),
			);

			$this->builder->register_control( $controls );

			$this->builder->register_html(
				array(
					'save_button' => array(
						'type'   => 'html',
						'parent' => 'settings_bottom',
						'class'  => 'cx-control dialog-save',
						'html'   => '<button type="submit" class="button button-primary">' . esc_html__( 'Save', 'gutenix-pro' ) . '</button>',
					),
				)
			);
		}

		/**
		 * Register options page
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function register_page() {

			add_submenu_page(
				'themes.php',
				esc_html__( 'Gutenix Settings', 'gutenix-pro' ),
				esc_html__( 'Gutenix Settings', 'gutenix-pro' ),
				'manage_options',
				$this->key,
				array( $this, 'render_page' )
			);
		}

		/**
		 * Render settings page
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function render_page() {

			echo '<div class="gutenix-pro-settings-page">';
			$this->builder->render();
			echo '</div>';
		}

		/**
		 * Enqueue admin styles
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $hook Admin page slug
		 * @return void
		 */
		public function admin_enqueue_styles( $hook ) {

			if ( 'appearance_page_gutenix-pro-settings' === $hook ) {

				wp_enqueue_style(
					'gutenix-pro-admin',
					gutenix_pro()->plugin_url( 'assets/css/admin.css' ),
					false,
					gutenix_pro()->get_version()
				);
			}
		}

		/**
		 * Save settings
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function save() {

			if ( ! isset( $_REQUEST['page'] ) || $this->key !== $_REQUEST['page'] ) {
				return;
			}

			if ( ! isset( $_REQUEST['action'] ) || 'save-settings' !== $_REQUEST['action'] ) {
				return;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$current = get_option( $this->key, array() );
			$data    = $_REQUEST;

			unset( $data['action'] );

			foreach ( $data as $key => $value ) {
				$current[ $key ] = is_array( $value ) ? $value : esc_attr( $value );
			}

			update_option( $this->key, $current );

			$redirect = add_query_arg(
				array( 'dialog-saved' => true ),
				$this->get_settings_page_link()
			);

			wp_redirect( $redirect );
			die();

		}

		/**
		 * Return settings page URL
		 *
		 * @since  1.0.0
		 * @access public
		 * @return string
		 */
		public function get_settings_page_link() {

			return add_query_arg(
				array( 'page' => $this->key ),
				esc_url( admin_url( 'themes.php' ) )
			);
		}

		/**
		 * Show saved notice
		 *
		 * @since  1.0.0
		 * @access public
		 * @return bool
		 */
		public function saved_notice() {

			if ( ! isset( $_GET['dialog-saved'] ) ) {
				return false;
			}

			$message = esc_html__( 'Settings saved', 'gutenix-pro' );

			printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', $message );

			return true;
		}

		/**
		 * Get setting value.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $setting Setting slug.
		 * @param  mixed  $default Default value.
		 * @return bool
		 */
		public function get( $setting, $default = false ) {

			if ( null === $this->settings ) {
				$this->settings = get_option( $this->key, array() );
			}

			return isset( $this->settings[ $setting ] ) ? $this->settings[ $setting ] : $default;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return Gutenix_Pro_Settings
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}

}

if ( ! function_exists( 'gutenix_pro_settings' ) ) {

	/**
	 * Returns instance of Gutenix_Pro_Settings
	 *
	 * @since  1.0.0
	 * @return Gutenix_Pro_Settings
	 */
	function gutenix_pro_settings() {
		return Gutenix_Pro_Settings::get_instance();
	}
}
