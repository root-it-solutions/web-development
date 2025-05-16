<?php
/**
 * Gutenix_Pro_Woo_Breadcrumbs class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Woo_Breadcrumbs' ) ) {

	/**
	 * Define Gutenix_Pro_Woo_Breadcrumbs class
	 */
	class Gutenix_Pro_Woo_Breadcrumbs {

		/**
		 * Constructor for the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {

			if ( ! class_exists( 'WooCommerce' ) ){
				return;
			}

			add_filter( 'cx_breadcrumbs/custom_trail', array( $this, 'get_wc_breadcrumbs' ), 10, 2 );
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			$this->includes();
		}

		/**
		 * Include appropriate module files.
		 *
		 * @return void
		 */
		public function includes() {
			require gutenix_pro()->plugin_path( 'includes/classes/class-woo-breadcrumbs.php' );
		}

		/**
		 * Replace default breadcrumbs trail with WooCommerce-related.
		 *
		 * @param  bool $is_custom_breadcrumbs Default cutom breadcrumbs trigger.
		 * @param  array $args Breadcrumb arguments.
		 *
		 * @return bool|array
		 */
		public function get_wc_breadcrumbs( $is_custom_breadcrumbs, $args ) {
			if ( ! is_woocommerce() ){
				return $is_custom_breadcrumbs;
			}

			$wc_breadcrumbs = new Gutenix_Pro_Woo_Breadcrumbs_Class( $args );

			return array( 'items' => $wc_breadcrumbs->items, 'page_title' => $wc_breadcrumbs->page_title );
		}
	}

}
