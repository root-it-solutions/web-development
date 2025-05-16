<?php
/**
 * Get Dynamic CSS
 */
	
$css = '';
$parse_css = '';


/**
 * Header
 */

/* Header Box Shadow */
$header_shadow_visible 			= gutenix_theme()->customizer->get_value( 'header_shadow_visible' );
if( $header_shadow_visible ) {
	$header_shadow_color 			= gutenix_theme()->customizer->get_value( 'header_shadow_color' );
	$header_shadow_size 			= gutenix_theme()->customizer->get_value( 'header_shadow_size' );
	$header_shadow_size_vertical 	= $header_shadow_size['desktop']['vertical'];
	$header_shadow_size_horizontal 	= $header_shadow_size['desktop']['horizontal'];
	$header_shadow_size_blur 		= $header_shadow_size['desktop']['blur'];
	$header_shadow_size_spread 		= $header_shadow_size['desktop']['spread'];

	$css .= '
		.header-bar {
			box-shadow:'. esc_attr( $header_shadow_size_vertical ) .'px '. esc_attr( $header_shadow_size_horizontal ) .'px '. esc_attr( $header_shadow_size_blur ) .'px '. esc_attr( $header_shadow_size_spread ) .'px '. esc_attr( $header_shadow_color ) .';
		}
	';
}

/* Header Sub Menu Box Shadow */
$sub_menu_shadow_color 			= gutenix_theme()->customizer->get_value( 'sub_menu_shadow_color' );
$sub_menu_shadow_size 			= gutenix_theme()->customizer->get_value( 'sub_menu_shadow_size' );
$sub_menu_shadow_size_vertical 	= $sub_menu_shadow_size['desktop']['vertical'];
$sub_menu_shadow_size_horizontal = $sub_menu_shadow_size['desktop']['horizontal'];
$sub_menu_shadow_size_blur 		= $sub_menu_shadow_size['desktop']['blur'];
$sub_menu_shadow_size_spread 	= $sub_menu_shadow_size['desktop']['spread'];

$css .= '#site-navigation.main-navigation--default .menu .sub-menu {
	box-shadow:'. esc_attr( $sub_menu_shadow_size_vertical ) .'px '. esc_attr( $sub_menu_shadow_size_horizontal ) .'px '. esc_attr( $sub_menu_shadow_size_blur ) .'px '. esc_attr( $sub_menu_shadow_size_spread ) .'px '. esc_attr( $sub_menu_shadow_color ) .';
}';

/* Header Sub Menu Paddings */
$sub_menu_margin 				= gutenix_theme()->customizer->get_value( 'sub_menu_margin' );
$sub_menu_padding 				= gutenix_theme()->customizer->get_value( 'sub_menu_padding' );

$css .= '
	#site-navigation.main-navigation--default .menu > .menu-item > .sub-menu {
		margin-left:-' . esc_attr( $sub_menu_padding['desktop']['left'] ) . 'px;
	}
	#site-navigation.main-navigation--default .menu > .menu-item > .sub-menu .sub-menu {
		margin-top:-' . esc_attr( $sub_menu_padding['desktop']['top'] ) . 'px;
	}
';

$sub_menu_spacing = array(
	'#site-navigation.main-navigation--default .menu > .menu-item > .sub-menu' => array(
		'margin-top' 		=> $sub_menu_margin['desktop']['top'],
		'padding-top' 		=> $sub_menu_padding['desktop']['top'],
		'padding-bottom' 	=> $sub_menu_padding['desktop']['bottom'],
	),
	'#site-navigation.main-navigation--default .menu > .menu-item > .sub-menu:before' => array(
		'height' 			=> $sub_menu_margin['desktop']['top'],
	),
	'#site-navigation.main-navigation--default .menu .sub-menu a' => array(
		'padding-right' 	=> $sub_menu_padding['desktop']['right'],
		'padding-left' 		=> $sub_menu_padding['desktop']['left'],
	),
	'#site-navigation.main-navigation--default .menu > .menu-item > .sub-menu .sub-menu' => array(
		'padding-top' 		=> $sub_menu_padding['desktop']['top'],
		'padding-bottom' 	=> $sub_menu_padding['desktop']['bottom'],
	),
);

$parse_css .= gutenix_parse_css( $sub_menu_spacing );


/**
 * Breadcrumbs
 */

/* Breadcrumbs Padding */
$breadcrumbs_visible = gutenix_theme()->customizer->get_value( 'breadcrumbs_visible' );
if( $breadcrumbs_visible ) {
	$breadcrumbs_padding = gutenix_theme()->customizer->get_value( 'breadcrumbs_padding' );
	$breadcrumbs_padding_spacing = array(
		'#page .breadcrumbs' => array(
			'padding-top' 		=> $breadcrumbs_padding['desktop']['top'],
			'padding-bottom' 	=> $breadcrumbs_padding['desktop']['bottom'],
		),
	);

	// Tablet
	$tablet_breadcrumbs_padding_spacing = array(
		'#page .breadcrumbs' => array(
			'padding-top' 		=> $breadcrumbs_padding['tablet']['top'],
			'padding-bottom' 	=> $breadcrumbs_padding['tablet']['bottom'],
		),
	);

	// Mobile
	$mobile_breadcrumbs_padding_spacing = array(
		'#page .breadcrumbs' => array(
			'padding-top' 		=> $breadcrumbs_padding['mobile']['top'],
			'padding-bottom' 	=> $breadcrumbs_padding['mobile']['bottom'],
		),
	);

	$parse_css .= gutenix_parse_css( $breadcrumbs_padding_spacing );
	$parse_css .= gutenix_parse_css( $tablet_breadcrumbs_padding_spacing, '', '800' );
	$parse_css .= gutenix_parse_css( $mobile_breadcrumbs_padding_spacing, '', '544' );
}


/* Breadcrumbs Title Padding */
$breadcrumbs_title_padding = gutenix_theme()->customizer->get_value( 'breadcrumbs_title_padding' );
$breadcrumbs_title_padding_spacing = array(
	'#page .breadcrumbs__title' => array(
		'padding-top' 		=> $breadcrumbs_title_padding['desktop']['top'],
		'padding-bottom' 	=> $breadcrumbs_title_padding['desktop']['bottom'],
	),
);

// Tablet
$tablet_breadcrumbs_title_padding_spacing = array(
	'#page .breadcrumbs__title' => array(
		'padding-top' 		=> $breadcrumbs_title_padding['tablet']['top'],
		'padding-bottom' 	=> $breadcrumbs_title_padding['tablet']['bottom'],
	),
);

// Mobile
$mobile_breadcrumbs_title_padding_spacing = array(
	'#page .breadcrumbs__title' => array(
		'padding-top' 		=> $breadcrumbs_title_padding['mobile']['top'],
		'padding-bottom' 	=> $breadcrumbs_title_padding['mobile']['bottom'],
	),
);

$parse_css .= gutenix_parse_css( $breadcrumbs_title_padding_spacing );
$parse_css .= gutenix_parse_css( $tablet_breadcrumbs_title_padding_spacing, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_breadcrumbs_title_padding_spacing, '', '544' );

/* Title Font Size */
$breadcrumbs_title_font_size = gutenix_theme()->customizer->get_value( 'breadcrumbs_title_font_size' );
$breadcrumbs_title_font_size_value = array(
	'.breadcrumbs__title' => array(
		'font-size' => $breadcrumbs_title_font_size['desktop']
	)
);
$tablet_breadcrumbs_title_font_size_value = array(
	'.breadcrumbs__title' => array(
		'font-size' => $breadcrumbs_title_font_size['tablet']
	)
);
$mobile_breadcrumbs_title_font_size_value = array(
	'.breadcrumbs__title' => array(
		'font-size' => $breadcrumbs_title_font_size['mobile']
	)
);

$parse_css .= gutenix_parse_css( $breadcrumbs_title_font_size_value );
$parse_css .= gutenix_parse_css( $tablet_breadcrumbs_title_font_size_value, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_breadcrumbs_title_font_size_value, '', '544' );

/* Text Font Size */
$breadcrumbs_text_font_size = gutenix_theme()->customizer->get_value( 'breadcrumbs_text_font_size' );
$breadcrumbs_text_font_size_value = array(
	'.breadcrumbs__content .breadcrumbs__item' => array(
		'font-size' => $breadcrumbs_text_font_size['desktop']
	)
);
$tablet_breadcrumbs_text_font_size_value = array(
	'.breadcrumbs__content .breadcrumbs__item' => array(
		'font-size' => $breadcrumbs_text_font_size['tablet']
	)
);
$mobile_breadcrumbs_text_font_size_value = array(
	'.breadcrumbs__content .breadcrumbs__item' => array(
		'font-size' => $breadcrumbs_text_font_size['mobile']
	)
);

$parse_css .= gutenix_parse_css( $breadcrumbs_text_font_size_value );
$parse_css .= gutenix_parse_css( $tablet_breadcrumbs_text_font_size_value, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_breadcrumbs_text_font_size_value, '', '544' );


/**
 * Page Title
 */

/* Page Title Font Size */
$page_title_font_size = gutenix_theme()->customizer->get_value( 'page_title_font_size' );
$page_title_font_size_value = array(
	'body.page .entry-header .entry-title, .page-header .page-title' => array(
		'font-size' => $page_title_font_size['desktop']
	)
);
$tablet_page_title_font_size_value = array(
	'body.page .entry-header .entry-title, .page-header .page-title' => array(
		'font-size' => $page_title_font_size['tablet']
	)
);
$mobile_page_title_font_size_value = array(
	'body.page .entry-header .entry-title, .page-header .page-title' => array(
		'font-size' => $page_title_font_size['mobile']
	)
);

$parse_css .= gutenix_parse_css( $page_title_font_size_value );
$parse_css .= gutenix_parse_css( $tablet_page_title_font_size_value, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_page_title_font_size_value, '', '544' );

/* Page Title Padding */
$page_title_vertical_padding = gutenix_theme()->customizer->get_value( 'page_title_vertical_padding' );
$page_title_vertical_padding_value = array(
	'body.page .entry-header, .page-header' => array(
		'margin-top' 		=> $page_title_vertical_padding['desktop']['top'],
		'margin-bottom' 	=> $page_title_vertical_padding['desktop']['bottom'],
	),
);

// Tablet
$tablet_page_title_vertical_padding_value = array(
	'body.page .entry-header, .page-header' => array(
		'margin-top' 		=> $page_title_vertical_padding['tablet']['top'],
		'margin-bottom' 	=> $page_title_vertical_padding['tablet']['bottom'],
	),
);

// Mobile
$mobile_page_title_vertical_padding_value = array(
	'body.page .entry-header, .page-header' => array(
		'margin-top' 		=> $page_title_vertical_padding['mobile']['top'],
		'margin-bottom' 	=> $page_title_vertical_padding['mobile']['bottom'],
	),
);

$parse_css .= gutenix_parse_css( $page_title_vertical_padding_value );
$parse_css .= gutenix_parse_css( $tablet_page_title_vertical_padding_value, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_page_title_vertical_padding_value, '', '544' );


/**
 * Blog Posts
 */

/* Blog Post Item Indent */
$blog_post_item_indent = gutenix_theme()->customizer->get_value( 'blog_post_item_indent' );
$blog_post_item_indent_spacing = array(
	'.posts-list.posts-list--default .hentry + .hentry, .posts-list.posts-list--default-2 .hentry + .hentry, .posts-list.posts-list--grid .hentry, .posts-list.posts-list--masonry .hentry, .posts-list.posts-list--justify .hentry' => array(
		'padding-top' 		=> $blog_post_item_indent['desktop']['top'],
		'padding-bottom' 	=> $blog_post_item_indent['desktop']['bottom'],
	),
	'.posts-list.posts-list--default article:first-child, .posts-list.posts-list--default-2 article:first-child, .posts-list.posts-list--grid .hentry, .posts-list.posts-list--masonry .hentry, .posts-list.posts-list--justify .hentry' => array(
		'padding-bottom' 	=> $blog_post_item_indent['desktop']['bottom'],
	),
);

// Tablet
$tablet_blog_post_item_indent_spacing = array(
	'.posts-list.posts-list--default .hentry + .hentry, .posts-list.posts-list--default-2 .hentry + .hentry, .posts-list.posts-list--grid .hentry, .posts-list.posts-list--masonry .hentry, .posts-list.posts-list--justify .hentry' => array(
		'padding-top' 		=> $blog_post_item_indent['tablet']['top'],
		'padding-bottom' 	=> $blog_post_item_indent['tablet']['bottom'],
	),
	'.posts-list.posts-list--default article:first-child, .posts-list.posts-list--default-2 article:first-child, .posts-list.posts-list--grid .hentry, .posts-list.posts-list--masonry .hentry, .posts-list.posts-list--justify .hentry' => array(
		'padding-bottom' 	=> $blog_post_item_indent['tablet']['bottom'],
	),
);

// Mobile
$mobile_blog_post_item_indent_spacing = array(
	'.posts-list.posts-list--default .hentry + .hentry, .posts-list.posts-list--default-2 .hentry + .hentry, .posts-list.posts-list--grid .hentry, .posts-list.posts-list--masonry .hentry, .posts-list.posts-list--justify .hentry' => array(
		'padding-top' 		=> $blog_post_item_indent['mobile']['top'],
		'padding-bottom' 	=> $blog_post_item_indent['mobile']['bottom'],
	),
	'.posts-list.posts-list--default article:first-child, .posts-list.posts-list--default-2 article:first-child, .posts-list.posts-list--grid .hentry, .posts-list.posts-list--masonry .hentry, .posts-list.posts-list--justify .hentry' => array(
		'padding-bottom' 	=> $blog_post_item_indent['mobile']['bottom'],
	),
);

$parse_css .= gutenix_parse_css( $blog_post_item_indent_spacing );
$parse_css .= gutenix_parse_css( $tablet_blog_post_item_indent_spacing, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_blog_post_item_indent_spacing, '', '544' );


/* Blog Listing 2 Thumbnail Width */
$blog_listing2_thumb_width 		= gutenix_theme()->customizer->get_value( 'blog_listing2_thumb_width' );
$blog_listing2_content_width 	= abs(100 - $blog_listing2_thumb_width);

if ( ! empty( $blog_listing2_content_width ) && '56' != $blog_listing2_content_width ) {
	$css .= '@media (min-width: 1025px) {
		#primary .posts-list--default-2 .has-post-thumbnail .post-content-wrapper {
			flex: 0 0 ' . esc_html( $blog_listing2_content_width ) . '%;
			max-width: ' . esc_html( $blog_listing2_content_width ) . '%;
		}
	}';
}

if ( ! empty( $blog_listing2_thumb_width ) && '44' != $blog_listing2_thumb_width ) {
	$css .= '@media (min-width: 1025px) {
		.has-sidebar #primary .posts-list--default-2 .post-thumbnail, .no-sidebar #primary .posts-list--default-2 .post-thumbnail {
			flex: 0 0 ' . esc_html( $blog_listing2_thumb_width ) . '%;
			max-width: ' . esc_html( $blog_listing2_thumb_width ) . '%;
		}
	}';
}

/* Blog Listing 2 Thumbnail Margin Right */
$blog_listing2_thumb_margin = gutenix_theme()->customizer->get_value( 'blog_listing2_thumb_margin' );
$blog_listing2_thumb_margin_spacing = array(
	'.has-sidebar #primary .posts-list--default-2 .post-thumbnail, .no-sidebar #primary .posts-list--default-2 .post-thumbnail' => array(
		'margin-top' 		=> $blog_listing2_thumb_margin['desktop']['top'],
		'padding-right' 	=> $blog_listing2_thumb_margin['desktop']['right'],
		'margin-bottom' 	=> $blog_listing2_thumb_margin['desktop']['bottom'],
		'padding-left' 		=> $blog_listing2_thumb_margin['desktop']['left'],
	),
);

// Tablet
$tablet_blog_listing2_thumb_margin_spacing = array(
	'.has-sidebar #primary .posts-list--default-2 .post-thumbnail, .no-sidebar #primary .posts-list--default-2 .post-thumbnail' => array(
		'margin-top' 		=> $blog_listing2_thumb_margin['tablet']['top'],
		'padding-right' 	=> $blog_listing2_thumb_margin['tablet']['right'],
		'margin-bottom' 	=> $blog_listing2_thumb_margin['tablet']['bottom'],
		'padding-left' 		=> $blog_listing2_thumb_margin['tablet']['left'],
	),
);

// Mobile
$mobile_blog_listing2_thumb_margin_spacing = array(
	'.has-sidebar #primary .posts-list--default-2 .post-thumbnail, .no-sidebar #primary .posts-list--default-2 .post-thumbnail' => array(
		'margin-top' 		=> $blog_listing2_thumb_margin['mobile']['top'],
		'padding-right' 	=> $blog_listing2_thumb_margin['mobile']['right'],
		'margin-bottom' 	=> $blog_listing2_thumb_margin['mobile']['bottom'],
		'padding-left' 		=> $blog_listing2_thumb_margin['mobile']['left'],
	),
);

$parse_css .= gutenix_parse_css( $blog_listing2_thumb_margin_spacing );
$parse_css .= gutenix_parse_css( $tablet_blog_listing2_thumb_margin_spacing, '', '800' );
$parse_css .= gutenix_parse_css( $mobile_blog_listing2_thumb_margin_spacing, '', '544' );


$css .= $parse_css;

// Return CSS
if ( ! empty( $css ) ) {
	$output = '/* Dynamic CSS */'. $css;
}

// Return output css
echo $output;