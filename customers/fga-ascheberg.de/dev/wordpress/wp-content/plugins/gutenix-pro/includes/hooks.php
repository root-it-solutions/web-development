<?php
/**
 * Gutenix_Pro_Hooks class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Hooks' ) ) {

	/**
	 * Define Gutenix_Pro_Hooks class
	 */
	class Gutenix_Pro_Hooks {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    Gutenix_Pro_Hooks
		 */
		private static $instance = null;

		/**
		 * Rewritten theme mods.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    array
		 */
		public $rewritten_mods = array();

		/**
		 * Constructor for the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init() {
			$rewrite_theme_mods = apply_filters( 'gutenix_pro/rewrite_theme_mods', array(
				'layout_type_pages',
				'get_page_sidebar',
				'layout_type_blog',
				'layout_type_post',
				'show_page_title',
				'header_layout_type',
				'footer_layout_type',
				'sticky_header_enable',
				'transparent_header_enable',
			) );

			$disabled_theme_mods = apply_filters( 'gutenix_pro/disabled_theme_mods', array(
				'top_panel_visible',
				'footer_widgets_visible',
				'breadcrumbs_visible',
			) );

			foreach ( $rewrite_theme_mods as $mod ) {
				add_filter( "theme_mod_{$mod}", array( $this, 'set_post_meta_value' ), 20 );
			}

			foreach ( $disabled_theme_mods as $mod ) {
				add_filter( "theme_mod_{$mod}", array( $this, 'set_disabled_post_meta_value' ), 20 );
			}

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			add_filter( 'gutenix_queried_object_id', array( $this, 'woo_set_shop_page' ) );

			add_filter( 'upload_mimes', array( $this, 'add_svg_to_upload_mimes' ) );
			
		}

		/**
		 * Adds custom classes to the array of body classes.
		 */
		public function body_classes( $classes ) {

			$classes[] = 'gutenix-pro-active';

			// Mobile sidebar order
			if ( 'sidebar-content' == $this->sidebar_order() ) {
				$classes[] = 'sidebar-content';
			}

			return $classes;
		}

		/**
		 * Set specific post meta value.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  mixed $value Filtered value.
		 * @return string|bool
		 */
		public function set_post_meta_value( $value ) {
			$queried_obj = $this->get_queried_obj();

			if ( ! $queried_obj ) {
				return $value;
			}

			$theme_mod  = str_replace( 'theme_mod_', '', current_filter() );
			$meta_key   = 'gutenix_pro_' . $theme_mod;
			$meta_value = get_post_meta( $queried_obj, $meta_key, true );

			if ( ! $meta_value || 'inherit' === $meta_value ) {
				return $value;
			}

			if ( in_array( $meta_value, array( 'yes', 'true', 'no', 'false' ) ) ) {
				$meta_value = filter_var( $meta_value, FILTER_VALIDATE_BOOLEAN );
			}

			if ( ! isset( $this->rewritten_mods[ $theme_mod ] ) ) {
				$this->rewritten_mods[] = $theme_mod;
			}

			return $meta_value;
		}

		/**
		 * Set disabled post meta value.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  mixed $value Filtered value.
		 * @return string|bool
		 */
		public function set_disabled_post_meta_value( $value ) {
			$queried_obj = $this->get_queried_obj();

			if ( ! $queried_obj ) {
				return $value;
			}

			$meta_key   = 'gutenix_pro_disable_' . str_replace( 'theme_mod_', '', current_filter() );
			$meta_value = get_post_meta( $queried_obj, $meta_key, true );

			if ( 'true' !== $meta_value ) {
				return $value;
			}

			return false;
		}

		/**
		 * Get queried object.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return string|boolean
		 */
		public function get_queried_obj() {
			$queried_obj = apply_filters( 'gutenix_queried_object_id', false );

			if ( ! $queried_obj && ! $this->maybe_need_rewrite_mod() ) {
				return false;
			}

			$queried_obj = is_home() ? get_option( 'page_for_posts' ) : $queried_obj;
			$queried_obj = ! $queried_obj ? get_the_id() : $queried_obj;

			return $queried_obj;
		}

		/**
		 * Check if we need to try rewrite theme mod or not
		 *
		 * @since  1.0.0
		 * @access public
		 * @return boolean
		 */
		public function maybe_need_rewrite_mod() {

			if ( is_front_page() && 'page' !== get_option( 'show_on_front' ) ) {
				return false;
			}

			if ( is_home() && 'page' === get_option( 'show_on_front' ) ) {
				return true;
			}

			if ( ! is_singular() ) {
				return false;
			}

			return true;
		}

		/**
		 * Allow to rewrite shop page layout from page options.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  int $id Current page ID.
		 * @return int
		 */
		function woo_set_shop_page( $id ) {

			if ( ! function_exists( 'is_shop' ) || ! function_exists( 'wc_get_page_id' ) ) {
				return $id;
			}

			if ( ! is_shop() && ! is_tax( 'product_cat' ) && ! is_tax( 'product_tag' ) ) {
				return $id;
			}

			$page_id = wc_get_page_id( 'shop' );

			return $page_id;
		}

		/**
		 * SVG mimes
		 *
		 * @since  1.0.0
		 * @access public
		 * @return Gutenix_Pro_Hooks
		 */
		public function add_svg_to_upload_mimes( $mimes ) {
			
			$mimes['svg'] = 'image/svg+xml';
			
			return $mimes;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return Gutenix_Pro_Hooks
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Mobile sidebar order
		 */
		public static function sidebar_order() {

			// Define variables
			$order  = 'content-sidebar';
			
			// Home
			if ( is_home() || is_category() || is_tag() || is_date() || is_author() ) {
				$order = gutenix_theme()->customizer->get_value( 'blog_post_sidebar_order' );
			}

			// Singular Post
			elseif ( is_singular( 'post' ) ) {
				$order = gutenix_theme()->customizer->get_value( 'single_post_sidebar_order' );
			}

			// WooCommerce Pages
			elseif ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_shop() || is_product_category() || is_product_tag() ) ) {
				$order = gutenix_theme()->customizer->get_value( 'shop_sidebar_order' );
			}

			// WooCommerce Product Page
			elseif ( class_exists( 'woocommerce' ) && is_product()  ) {
				$order = gutenix_theme()->customizer->get_value( 'product_sidebar_order' );
			}

			// All else
			else {
				$order = 'content-sidebar';
			}

			// The order should never be empty
			if ( empty( $order ) ) {
				$order = 'content-sidebar';
			}

			// Apply filters and return
			return apply_filters( 'gutenix_set_sidebar_order', $order );

		}
	}

}

if ( ! function_exists( 'gutenix_pro_hooks' ) ) {

	/**
	 * Returns instance of Gutenix_Pro_Hooks
	 *
	 * @since  1.0.0
	 * @return Gutenix_Pro_Hooks
	 */
	function gutenix_pro_hooks() {
		return Gutenix_Pro_Hooks::get_instance();
	}
}