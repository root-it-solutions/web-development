<?php
/**
 * WooCommerce single product hooks.
 *
 * @package Gutenix
 */

// Remove the single product summary content to add the sortable control
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'gutenix_woo_product_summary_content_positioning', 10 );

// Alternative upsells display action
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'gutenix_single_product_upsell_display', 15 );

// Related Products
add_filter( 'woocommerce_output_related_products_args', 'gutenix_wc_related_products_args' );

if ( ! function_exists( 'gutenix_woo_product_summary_content_positioning' ) ) {

	/**
	 * Single Product Summary Content Sorting
	 */
	function gutenix_woo_product_summary_content_positioning() {

		$elements = apply_filters( 'gutenix_product_summary_structure', gutenix_theme()->customizer->get_value( 'woo_product_summary_elements_positioning' ) );

		if ( is_array( $elements ) && ! empty( $elements ) ) {

			foreach ( $elements as $element ) {

				if ( 'title' == $element ) {
					woocommerce_template_single_title();
				}

				if ( 'price' == $element ) {
					woocommerce_template_single_price();
				}

				if ( 'rating' == $element ) {
					woocommerce_template_single_rating();
				}

				if ( 'excerpt' == $element ) {
					woocommerce_template_single_excerpt();
				}

				if ( 'button' == $element ) {
					woocommerce_template_single_add_to_cart();
				}

				if ( 'meta' == $element ) {
					woocommerce_template_single_meta();
				}

				if ( 'share' == $element ) {
					gutenix_woocommerce_share_product();
				}
			}
		}
	}
}

if ( ! function_exists( 'gutenix_single_product_upsell_display' ) ) {

	/**
	 * Change products per row for upsells.
	 */
	function gutenix_single_product_upsell_display() {

		// Get count
		$count = gutenix_theme()->customizer->get_value( 'woo_product_upsells_count', '9' );
		$count = $count ? $count : '9';

		// Get columns
		$columns = gutenix_theme()->customizer->get_value( 'woo_product_upsells_cols', '3' );
		$columns = $columns ? $columns : '3';

		// Alter upsell display
		woocommerce_upsell_display( $count, $columns );
	}
}

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 *
 * @return array $args related products args.
 */
function gutenix_wc_related_products_args( $args ) {
	
	//	Related Products Enable
	$related_products_enable = gutenix_theme()->customizer->get_value( 'woo_product_related_enable', true );

	// Get posts per page
	$posts_per_page = gutenix_theme()->customizer->get_value( 'woo_product_related_count', '9' );
	$posts_per_page = false != $related_products_enable ? $posts_per_page : '0';

	// Get columns
	$columns = gutenix_theme()->customizer->get_value( 'woo_product_related_cols', '3' );
	$columns = $columns ? $columns : '3';

	// Return array
	$defaults = array(
		'posts_per_page' => $posts_per_page,
		'columns'        => $columns,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}