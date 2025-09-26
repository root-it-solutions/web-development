<?php
/**
 * Get Dynamic CSS
 */
	
$css = '';
$parse_css = '';


/**
 * Products List
 */

/* Products List Categories Padding */
$woo_products_cat_padding 		= gutenix_theme()->customizer->get_value( 'woo_products_cat_padding' );
$woo_products_title = array(
	'.products .product .product-content .woocommerce-loop-product__category' => array(
		'margin-top' 		=> $woo_products_cat_padding['desktop']['top'],
		'margin-bottom' 	=> $woo_products_cat_padding['desktop']['bottom'],
	),
);

// Tablet
$tablet_woo_products_title = array(
	'.products .product .product-content .woocommerce-loop-product__category' => array(
		'margin-top' 		=> $woo_products_cat_padding['tablet']['top'],
		'margin-bottom' 	=> $woo_products_cat_padding['tablet']['bottom'],
	),
);

// Mobile
$mobile_woo_products_title = array(
	'.products .product .product-content .woocommerce-loop-product__category' => array(
		'margin-top' 		=> $woo_products_cat_padding['mobile']['top'],
		'margin-bottom' 	=> $woo_products_cat_padding['mobile']['bottom'],
	),
);

$parse_css .= gutenix_parse_css( $woo_products_title );
$parse_css .= gutenix_parse_css( $tablet_woo_products_title, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_woo_products_title, '', '544' );

/* Products List Categories Font Size */
$woo_products_cat_font_size 	= gutenix_theme()->customizer->get_value( 'woo_products_cat_font_size' );
$woo_products_title = array(
	'.products .product .product-content .woocommerce-loop-product__category a' => array(
		'font-size' 		=> $woo_products_cat_font_size['desktop'],
	),
);

// Tablet
$tablet_woo_products_title = array(
	'.products .product .product-content .woocommerce-loop-product__category a' => array(
		'font-size' 		=> $woo_products_cat_font_size['tablet'],
	),
);

// Mobile
$mobile_woo_products_title = array(
	'.products .product .product-content .woocommerce-loop-product__category a' => array(
		'font-size' 		=> $woo_products_cat_font_size['mobile'],
	),
);

$parse_css .= gutenix_parse_css( $woo_products_title );
$parse_css .= gutenix_parse_css( $tablet_woo_products_title, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_woo_products_title, '', '544' );

/* Products List Title */
$woo_products_title_padding 		= gutenix_theme()->customizer->get_value( 'woo_products_title_padding' );
$woo_products_title_font_size 		= gutenix_theme()->customizer->get_value( 'woo_products_title_font_size' );
$woo_products_title = array(
	'.products .woocommerce-loop-product__title' => array(
		'margin-top' 		=> $woo_products_title_padding['desktop']['top'],
		'margin-bottom' 	=> $woo_products_title_padding['desktop']['bottom'],
		'font-size' 		=> $woo_products_title_font_size['desktop'],
	),
);

// Tablet
$tablet_woo_products_title = array(
	'.products .woocommerce-loop-product__title' => array(
		'margin-top' 		=> $woo_products_title_padding['tablet']['top'],
		'margin-bottom' 	=> $woo_products_title_padding['tablet']['bottom'],
		'font-size' 		=> $woo_products_title_font_size['tablet'],
	),
);

// Mobile
$mobile_woo_products_title = array(
	'.products .woocommerce-loop-product__title' => array(
		'margin-top' 		=> $woo_products_title_padding['mobile']['top'],
		'margin-bottom' 	=> $woo_products_title_padding['mobile']['bottom'],
		'font-size' 		=> $woo_products_title_font_size['mobile'],
	),
);

$parse_css .= gutenix_parse_css( $woo_products_title );
$parse_css .= gutenix_parse_css( $tablet_woo_products_title, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_woo_products_title, '', '544' );


/* Products List Price */
$woo_products_price_padding 		= gutenix_theme()->customizer->get_value( 'woo_products_price_padding' );
$woo_products_price_font_size 		= gutenix_theme()->customizer->get_value( 'woo_products_price_font_size' );
$woo_products_price_del_font_size 	= gutenix_theme()->customizer->get_value( 'woo_products_price_del_font_size' );
$woo_products_price = array(
	'.products .product .price' => array(
		'margin-top' 		=> $woo_products_price_padding['desktop']['top'],
		'margin-bottom' 	=> $woo_products_price_padding['desktop']['bottom'],
		'font-size' 		=> $woo_products_price_font_size['desktop'],
	),
	'.products .product .price del' => array(
		'font-size' 		=> $woo_products_price_del_font_size['desktop'],
	),
);

// Tablet
$tablet_woo_products_price = array(
	'.products .product .price' => array(
		'margin-top' 		=> $woo_products_price_padding['tablet']['top'],
		'margin-bottom' 	=> $woo_products_price_padding['tablet']['bottom'],
		'font-size' 		=> $woo_products_price_font_size['tablet'],
	),
	'.products .product .price del' => array(
		'font-size' 		=> $woo_products_price_del_font_size['tablet'],
	),
);

// Mobile
$mobile_woo_products_price = array(
	'.products .product .price' => array(
		'margin-top' 		=> $woo_products_price_padding['mobile']['top'],
		'margin-bottom' 	=> $woo_products_price_padding['mobile']['bottom'],
		'font-size' 		=> $woo_products_price_font_size['mobile'],
	),
	'.products .product .price del' => array(
		'font-size' 		=> $woo_products_price_del_font_size['mobile'],
	),
);

$parse_css .= gutenix_parse_css( $woo_products_price );
$parse_css .= gutenix_parse_css( $tablet_woo_products_price, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_woo_products_price, '', '544' );

/* Products List Description */
$woo_products_descr_padding 		= gutenix_theme()->customizer->get_value( 'woo_products_descr_padding' );
$woo_products_descr_font_size 		= gutenix_theme()->customizer->get_value( 'woo_products_descr_font_size' );
$woo_products_descr = array(
	'.products .product .product-content p.woocommerce-loop-product__description' => array(
		'margin-top' 		=> $woo_products_descr_padding['desktop']['top'],
		'margin-bottom' 	=> $woo_products_descr_padding['desktop']['bottom'],
		'font-size' 		=> $woo_products_descr_font_size['desktop'],
	),
);

// Tablet
$tablet_woo_products_descr = array(
	'.products .product .product-content p.woocommerce-loop-product__description' => array(
		'margin-top' 		=> $woo_products_descr_padding['tablet']['top'],
		'margin-bottom' 	=> $woo_products_descr_padding['tablet']['bottom'],
		'font-size' 		=> $woo_products_descr_font_size['tablet'],
	),
);

// Mobile
$mobile_woo_products_descr = array(
	'.products .product .product-content p.woocommerce-loop-product__description' => array(
		'margin-top' 		=> $woo_products_descr_padding['mobile']['top'],
		'margin-bottom' 	=> $woo_products_descr_padding['mobile']['bottom'],
		'font-size' 		=> $woo_products_descr_font_size['mobile'],
	),
);

$parse_css .= gutenix_parse_css( $woo_products_descr );
$parse_css .= gutenix_parse_css( $tablet_woo_products_descr, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_woo_products_descr, '', '544' );

/* Products List Button */
$woo_products_btn_padding 		= gutenix_theme()->customizer->get_value( 'woo_products_btn_padding' );
$woo_products_btn_font_size 	= gutenix_theme()->customizer->get_value( 'woo_products_btn_font_size' );
$woo_products_btn = array(
	'.products .product .product-content .button' => array(
		'padding-top' 		=> $woo_products_btn_padding['desktop']['top'],
		'padding-right' 	=> $woo_products_btn_padding['desktop']['right'],
		'padding-bottom' 	=> $woo_products_btn_padding['desktop']['bottom'],
		'padding-left' 		=> $woo_products_btn_padding['desktop']['left'],
		'font-size' 		=> $woo_products_btn_font_size['desktop'],
	),
);

// Tablet
$tablet_woo_products_btn = array(
	'.products .product .product-content .button' => array(
		'padding-top' 		=> $woo_products_btn_padding['tablet']['top'],
		'padding-right' 	=> $woo_products_btn_padding['tablet']['right'],
		'padding-bottom' 	=> $woo_products_btn_padding['tablet']['bottom'],
		'padding-left' 		=> $woo_products_btn_padding['tablet']['left'],
		'font-size' 		=> $woo_products_btn_font_size['tablet'],
	),
);

// Mobile
$mobile_woo_products_btn = array(
	'.products .product .product-content .button' => array(
		'padding-top' 		=> $woo_products_btn_padding['mobile']['top'],
		'padding-right' 	=> $woo_products_btn_padding['mobile']['right'],
		'padding-bottom' 	=> $woo_products_btn_padding['mobile']['bottom'],
		'padding-left' 		=> $woo_products_btn_padding['mobile']['left'],
		'font-size' 		=> $woo_products_btn_font_size['mobile'],
	),
);

$parse_css .= gutenix_parse_css( $woo_products_btn );
$parse_css .= gutenix_parse_css( $tablet_woo_products_btn, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_woo_products_btn, '', '544' );


/**
 * Single Product
 */

/* Single Product Title */
$woo_product_title_padding 		= gutenix_theme()->customizer->get_value( 'woo_product_title_padding' );
$woo_product_title_font_size 	= gutenix_theme()->customizer->get_value( 'woo_product_title_font_size' );
$woo_product_title = array(
	'.single-product .summary .product_title' => array(
		'margin-top' 		=> $woo_product_title_padding['desktop']['top'],
		'margin-bottom' 	=> $woo_product_title_padding['desktop']['bottom'],
		'font-size' 		=> $woo_product_title_font_size['desktop'],
	)
);

// Tablet
$tablet_woo_product_title = array(
	'.single-product .summary .product_title' => array(
		'margin-top' 		=> $woo_product_title_padding['tablet']['top'],
		'margin-bottom' 	=> $woo_product_title_padding['tablet']['bottom'],
		'font-size' 		=> $woo_product_title_font_size['tablet'],
	)
);

// Mobile
$mobile_woo_product_title = array(
	'.single-product .summary .product_title' => array(
		'margin-top' 		=> $woo_product_title_padding['mobile']['top'],
		'margin-bottom' 	=> $woo_product_title_padding['mobile']['bottom'],
		'font-size' 		=> $woo_product_title_font_size['mobile'],
	)
);

$parse_css .= gutenix_parse_css( $woo_product_title );
$parse_css .= gutenix_parse_css( $tablet_woo_product_title, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_woo_product_title, '', '544' );


$css .= $parse_css;

// Return CSS
if ( ! empty( $css ) ) {
	$output = '/* WooCommerce Dynamic CSS */'. $css;
}

// Return output css
echo $output;