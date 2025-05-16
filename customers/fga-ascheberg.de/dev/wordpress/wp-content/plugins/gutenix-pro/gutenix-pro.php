<?php
/**
 * Plugin Name: GutenixPro
 * Plugin URI:
 * Description: Premium Modules for Gutenix Theme
 * Version:     1.0.5
 * Author:      Gutenix
 * Author URI:
 * Text Domain: gutenix-pro
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// If class `Gutenix_Pro` doesn't exists yet.
if ( ! class_exists( 'Gutenix_Pro' ) ) {

	/**
	 * Sets up and initializes the plugin.
	 */
	class Gutenix_Pro {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    Gutenix_Pro
		 */
		private static $instance = null;

		/**
		 * Plugin version
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $version = '1.0.0';

		/**
		 * Framework component
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    object
		 */
		public $framework;

		/**
		 * Holder for base plugin URL
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_url = null;

		/**
		 * Holder for base plugin path
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_path = null;

		/**
		 * Loaded modules
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    array
		 */
		public $modules = array();

		/**
		 * Default values for dynamic css options.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    array
		 */
		private $default_dynamic_css_values = array(
			'transparent_header_bg'                      => '#000',
			'transparent_header_bg_alpha'                => '5',
			'transparent_header_site_title_color'        => '#fff',
			'transparent_header_header_link_color'       => '#fff',
			'transparent_header_header_link_hover_color' => '#3260b1',
		);

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {

			// Load the CX Loader.
			add_action( 'after_setup_theme', array( $this, 'framework_loader' ), -20 );

			// Internationalize the text strings used.
			add_action( 'plugins_loaded', array( $this, 'lang' ) );

			// Load files.
			add_action( 'after_setup_theme', array( $this, 'init' ), 0 );

			// Register activation and deactivation hook.
			register_activation_hook( __FILE__, array( $this, 'activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );
		}

		/**
		 * Load the theme modules.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function framework_loader() {
			require $this->plugin_path( 'framework/loader.php' );

			$this->framework = new Gutenix_Pro_CX_Loader(
				array(
					$this->plugin_path( 'framework/modules/breadcrumbs/cherry-x-breadcrumbs.php' ),
					$this->plugin_path( 'framework/modules/post-meta/cherry-x-post-meta.php' ),
					$this->plugin_path( 'framework/modules/post-type/post-type.php' ),
					$this->plugin_path( 'framework/modules/interface-builder/cherry-x-interface-builder.php' ),
				)
			);

			if( class_exists( 'WooCommerce' ) ) {
				require $this->plugin_path( 'framework/modules/woo/wc-integration.php' );
				require $this->plugin_path( 'framework/modules/woo/wc-archive-product-functions.php' );
				require $this->plugin_path( 'framework/modules/woo/wc-content-product-functions.php' );
				require $this->plugin_path( 'framework/modules/woo/wc-single-product-functions.php' );
			}
		}

		/**
		 * Returns plugin version
		 *
		 * @since  1.0.0
		 * @access public
		 * @return string
		 */
		public function get_version() {
			return $this->version;
		}

		/**
		 * Manually init required modules.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init() {

			if ( ! $this->is_gutenix_theme() ) {
				return;
			}

			do_action( 'gutenix_pro/before_init', $this );

			$this->load_files();

			gutenix_pro_post_meta()->init();
			gutenix_pro_hooks()->init();
			gutenix_pro_dynamic_css_file()->init();
			gutenix_pro_settings()->init();

			$this->load_modules();

			do_action( 'gutenix_pro/after_init', $this );
		}

		/**
		 * Gutenix Theme Check
		 *
		 * @since  1.0.0
		 * @access public
		 * @return boolean
		 */
		public function is_gutenix_theme() {
			return function_exists( 'gutenix_theme' );
		}

		/**
		 * Load required files.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function load_files() {
			require $this->plugin_path( 'includes/post-meta.php' );
			// require $this->plugin_path( 'includes/post-type.php' );
			require $this->plugin_path( 'includes/hooks.php' );
			require $this->plugin_path( 'includes/dynamic-css-file.php' );
			require $this->plugin_path( 'includes/settings.php' );
		}

		/**
		 * Load required modules.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function load_modules() {

			$available_modules = gutenix_pro_settings()->get( 'available_modules' );

			require gutenix_pro()->plugin_path( 'includes/base/module.php' );

			foreach ( glob( gutenix_pro()->plugin_path( 'includes/modules/' ) . '*.php' ) as $file  ) {
				$module  = basename( $file, '.php' );
				$enabled = isset( $available_modules[ $module ] ) ? $available_modules[ $module ] : false;

				if ( filter_var( $enabled, FILTER_VALIDATE_BOOLEAN ) || ! $available_modules ) {
					$this->load_module( $file );
				}
			}
		}

		/**
		 * Load required module.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $file Module file
		 * @return void
		 */
		public function load_module( $file ) {
			$module = basename( $file, '.php' );
			$class  = ucwords( str_replace( '-', ' ', $module ) );
			$class  = str_replace( ' ', '_', $class );
			$class  = sprintf( 'Gutenix_Pro_%s', $class );

			require $file;

			if ( class_exists( $class ) ) {
				$instance = new $class;

				$this->modules[ $module ] = $instance;
			}
		}

		/**
		 * Returns path to file or dir inside plugin folder
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}

		/**
		 * Returns url to file or dir inside plugin folder
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
			}

			return $this->plugin_url . $path;
		}

		/**
		 * Added default values for dynamic css options.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $option Option id.
		 * @return mixed
		 */
		public function get_default_dynamic_css_values( $option ) {

			if ( $option ) {
				return isset( $this->default_dynamic_css_values[ $option ] ) ? $this->default_dynamic_css_values[ $option ] : false;
			}

			return $this->default_dynamic_css_values;
		}

		/**
		 * Loads the translation files.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function lang() {
			load_plugin_textdomain( 'gutenix-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Set default values to dynamic css theme mods.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function set_dynamic_css_theme_mods() {

			if ( ! $this->is_gutenix_theme() ) {
				return;
			}

			$default_dynamic_css = $this->default_dynamic_css_values;

			if ( empty( $default_dynamic_css ) ) {
				return;
			}

			$mods = get_theme_mods();

			foreach ( $default_dynamic_css as $mod => $value ) {
				if ( isset( $mods[ $mod ] ) ) {
					continue;
				}

				set_theme_mod( $mod, $value );
			}
		}

		/**
		 * Do some stuff on plugin activation
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function activation() {
			$this->set_dynamic_css_theme_mods();
		}

		/**
		 * Do some stuff on plugin activation
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function deactivation() {
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return Gutenix_Pro
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

if ( ! function_exists( 'gutenix_pro' ) ) {

	/**
	 * Returns instance of the plugin class.
	 *
	 * @since  1.0.0
	 * @return Gutenix_Pro
	 */
	function gutenix_pro() {
		return Gutenix_Pro::get_instance();
	}
}

gutenix_pro();
