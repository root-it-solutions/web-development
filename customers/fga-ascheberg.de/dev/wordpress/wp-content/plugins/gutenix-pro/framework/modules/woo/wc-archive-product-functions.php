<?php
/**
 * WooCommerce archive product hooks.
 *
 * @package Gutenix
 */

add_action( 'woocommerce_before_shop_loop', 'gutenix_wc_loop_products_panel_open' );
add_action( 'woocommerce_before_shop_loop', 'gutenix_wc_loop_products_panel_filter_button', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'gutenix_wc_product_badges_list_content', 20 );


if ( ! function_exists( 'gutenix_wc_loop_products_panel_filter_button' ) ) {
	
	/**
	 * Add to panel filter button.
	 *
	 * @since 1.0.0
	 */
	function gutenix_wc_loop_products_panel_filter_button() {

		if ( ! class_exists( 'Gutenix_Pro' ) ) {
			return;
		}

		$filter_enable 		= gutenix_theme()->customizer->get_value( 'woo_products_panel_filter_enable', true );
		$filter_btn_text 	= gutenix_theme()->customizer->get_value( 'woo_products_panel_filter_btn_text', true );

		$output = '';

		if ( true != $filter_enable ) {
			return;
		}

		$output .= '<a href="javascript:void(0)" id="gutenix-products-filter">';
			$output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 459 459" xml:space="preserve"><path d="M178.5,382.5h102v-51h-102V382.5z M0,76.5v51h459v-51H0z M76.5,255h306v-51h-306V255z"/></svg>';
			if( !empty( $filter_btn_text ) ) :
				$output .= esc_html( $filter_btn_text );
			endif;
		$output .= '</a>';
			
		$output .= gutenix_wc_products_filters_panel();	

		echo $output;
	}
}

if ( ! function_exists( 'gutenix_wc_product_badges_list_content' ) ) {

	/**
	 * All badges list
	 *
	 * @since 1.0.0
	 */
	function gutenix_wc_product_badges_list_content() {

		global $post;
 		
		$badge_sale_enable 		= true;
		$gutenix_custom_badge 	= '';

 		if ( class_exists( 'Gutenix_Pro' ) ) {
			
		 	$product 				= wc_get_product( $post->ID );
		 	$badges 				= gutenix_theme()->customizer->get_value( 'woo_products_badges' );
			$badge_sale_enable 		= ( in_array( 'sale', $badges) ) ? true : false;
		 	$gutenix_custom_badge 	= '';
		 	$text 					= $product->get_meta( 'gutenix_woo_product_custom_badge' );
		 	$bg 					= $product->get_meta( 'gutenix_woo_product_custom_badge_bg' );

		 	if( $text ) {
				$gutenix_custom_badge = '<span class="gutenix-custom-badge" style="background-color:'. esc_attr( $bg ) .';">' . esc_html( $text ) . '</span>';
		 	}

		 }

		echo '<div class="woo_badge_wrap onsale">' . $gutenix_custom_badge;
			if ( false != $badge_sale_enable ) {
				gutenix_wc_sale_badge_content();
			}
			gutenix_woo_product_show_flash();
		echo '</div>';
	}
}