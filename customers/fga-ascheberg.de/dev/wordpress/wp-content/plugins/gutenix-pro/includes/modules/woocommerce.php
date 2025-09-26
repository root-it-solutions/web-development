<?php
/**
 * Gutenix_Pro_WooCommerce class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( ! class_exists( 'WooCommerce' ) ) {
	return;
}

if ( ! class_exists( 'Gutenix_Pro_WooCommerce' ) ) {

	/**
	 * Define Gutenix_Pro_WooCommerce class
	 */
	class Gutenix_Pro_WooCommerce extends Gutenix_Pro_Module_Base {

		/**
		 * Added blog posts options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(

				/** `WooCommerce Theme` panel */
				'woo_panel' => array(
					'title' 			=> esc_html__( 'WooCommerce Theme', 'gutenix-pro' ),
					'priority' 			=> 85,
					'type' 				=> 'panel',
				),

				/** `WooCoomerce General` section */
				'woo_general_section' => array(
					'title' 			=> esc_html__( 'General', 'gutenix-pro' ),
					'panel' 			=> 'woo_panel',
					'type' 				=> 'section',
				),

				'woo_header_cart_all_pages' => array(
					'title'    => esc_html__( 'Header Cart for Cart Page', 'gutenix-pro' ),
					'description' => esc_html__( 'Enable header drop-down cart on Cart page', 'gutenix-pro' ),
					'section'  => 'woo_general_section',
					'default'  => false,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
					'active_callback' => 'gutenix_cac_woo_header_cart_icon',
				),

				'woo_sale_badge_heading' => array(
					'title' 	=> esc_html__( 'Badges', 'gutenix-pro' ),
					'section' 	=> 'woo_general_section',
					'field' 	=> 'gutenix-heading',
					'type' 		=> 'control',
				),
				'woo_products_badges' => array(
					'title'    => esc_html__( 'Badges', 'gutenix-pro' ),
					'description' => esc_html__( 'Select which badges you want to show', 'gutenix-pro' ),
					'section'  => 'woo_general_section',
					'default'  => array( 'sale', 'featured', 'new', 'outofstock' ),
					'field'    => 'gutenix-multi-check',
					'type'     => 'control',
					'choices'  => array(
						'sale'			=> esc_html__( 'Sale', 'gutenix-pro' ),
						'featured' 		=> esc_html__( 'Featured', 'gutenix-pro' ),
						'new' 			=> esc_html__( 'New', 'gutenix-pro' ),
						'outofstock' 	=> esc_html__( 'Out of Stock', 'gutenix-pro' ),
					),
					'sanitize_callback' => 'gutenix_customizer_sanitize_multi_choices',
				),
				'woo_sale_badge_style' => array(
					'title'       => esc_html__( 'Badges Style', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => 'square',
					'field'       => 'select',
					'type'        => 'control',
					'choices'     => array(
						'square' 	=> esc_html__( 'Square', 'gutenix-pro' ),
						'circle' 	=> esc_html__( 'Circle', 'gutenix-pro' ),
					),
				),
				'woo_sale_badge_style_sep' => array(
					'section' 	=> 'woo_general_section',
					'field' 	=> 'gutenix-separator',
					'type' 		=> 'control',
				),

				'woo_sale_badge_content' => array(
					'title'       => esc_html__( 'Badge "Sale" Type', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => 'sale',
					'field'       => 'select',
					'type'        => 'control',
					'choices'     => array(
						'sale' 		=> esc_html__( 'On Sale Text', 'gutenix-pro' ),
						'percent' 	=> esc_html__( 'Percentage', 'gutenix-pro' ),
					),
					'active_callback' => 'gutenix_cac_woo_product_has_sale_badge',
				),
				'woo_sale_badge_text_color' => array(
					'title'       => esc_html__( 'Badge "Sale" Color', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#ffffff',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_sale_badge',
				),
				'woo_sale_badge_bg' => array(
					'title'       => esc_html__( 'Badge "Sale" BG', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#fd6d75',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_sale_badge',
				),
				'woo_sale_badge_bg_sep' => array(
					'section' 	=> 'woo_general_section',
					'field' 	=> 'gutenix-separator',
					'type' 		=> 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_sale_badge',
				),

				'woo_products_badge_featured_text' => array(
					'title'    => esc_html__( 'Badge "Featured" Text', 'gutenix-pro' ),
					'section'  => 'woo_general_section',
					'default'  => esc_html__( 'Featured', 'gutenix-pro' ),
					'field'    => 'text',
					'type'     => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_featured_badge',
				),
				'woo_products_badge_featured_text_color' => array(
					'title'       => esc_html__( 'Badge "Featured" Color', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#ffffff',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_featured_badge',
				),
				'woo_products_badge_featured_bg' => array(
					'title'       => esc_html__( 'Badge "Featured" BG', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#71b726',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_featured_badge',
				),
				'woo_products_badge_featured_bg_sep' => array(
					'section' 	=> 'woo_general_section',
					'field' 	=> 'gutenix-separator',
					'type' 		=> 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_featured_badge',
				),

				'woo_products_badge_new_text' => array(
					'title'    => esc_html__( 'Badge "New" Text', 'gutenix-pro' ),
					'section'  => 'woo_general_section',
					'default'  => esc_html__( 'New', 'gutenix-pro' ),
					'field'    => 'text',
					'type'     => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_new_badge',
				),
				'woo_products_badge_new_text_color' => array(
					'title'       => esc_html__( 'Badge "New" Color', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#ffffff',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_new_badge',
				),
				'woo_products_badge_new_bg' => array(
					'title'       => esc_html__( 'Badge "New" BG', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#3aaae4',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_new_badge',
				),
				'woo_products_badge_new_novelty' => array(
					'title'       => esc_html__( 'Product Novelty', 'gutenix-pro' ),
					'description' => esc_html__( 'Display the "New" badge for how many days?', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '3',
					'field'       => 'number',
					'type'        => 'control',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 365,
						'step' => 1,
					),
					'active_callback' => 'gutenix_cac_woo_product_has_new_badge',
				),
				'woo_products_badge_new_novelty_sep' => array(
					'section' 	=> 'woo_general_section',
					'field' 	=> 'gutenix-separator',
					'type' 		=> 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_new_badge',
				),

				'woo_products_badge_outofstock_text' => array(
					'title'    => esc_html__( 'Badge "Out of Stock" Text', 'gutenix-pro' ),
					'section'  => 'woo_general_section',
					'default'  => esc_html__( 'Out of Stock', 'gutenix-pro' ),
					'field'    => 'text',
					'type'     => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_outofstock_badge',
				),
				'woo_products_badge_outofstock_text_color' => array(
					'title'       => esc_html__( 'Badge "Out of Stock" Color', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#ffffff',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_outofstock_badge',
				),
				'woo_products_badge_outofstock_bg' => array(
					'title'       => esc_html__( 'Badge "Out of Stock" BG', 'gutenix-pro' ),
					'section'     => 'woo_general_section',
					'default'     => '#414756',
					'field'       => 'hex_color',
					'type'        => 'control',
					'active_callback' => 'gutenix_cac_woo_product_has_outofstock_badge',
				),

				/** `WooCoomerce Product Catalog` section */
				'woo_sidebar_width' => array(
					'title' 			=> esc_html__( 'Sidebar Width, %', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'priority' 			=> 10,
					'default'     => 25,
					'field'       => 'gutenix-range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type'        => 'control',
					'dynamic_css' => true,
					'conditions' => array(
						'layout_type_shop' => array( 'boxed-content-sidebar', 'boxed-sidebar-content' ),
					),
				),
				'shop_sidebar_order' => array(
					'title'    => esc_html__( 'Mobile Sidebar Order', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'priority' 			=> 10,
					'default'  => 'content-sidebar',
					'field'    => 'select',
					'type'     => 'control',
					'choices' 				=> array(
						'content-sidebar' 	=> esc_html__( 'Content / Sidebar', 'gutenix-pro' ),
						'sidebar-content' 	=> esc_html__( 'Sidebar / Content', 'gutenix-pro' ),
					),
					'active_callback' 		=> 'gutenix_cac_woo_shop_sidebar_order',
				),
				
				// Tool Bar Options
				'woo_products_toolbar_heading' => array(
					'title' 	=> esc_html__( 'Toolbar', 'gutenix-pro' ),
					'section' 	=> 'woo_catalog',
					'field' 	=> 'gutenix-heading',
					'type' 		=> 'control',
				),
				'woo_products_grid_list_enable' => array(
					'title'    => esc_html__( 'Grid/List Buttons', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'default'  => true,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'woo_products_catalog_view' => array(
					'title'    => esc_html__( 'Default Catalog View', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'default'  => 'grid',
					'field'    => 'select',
					'type'     => 'control',
					'choices'  => array(
						'grid' 	=> esc_html__( 'Grid View', 'gutenix-pro' ),
						'list' 	=> esc_html__( 'List View', 'gutenix-pro' ),
					),
					'active_callback' 		=> 'gutenix_cac_woo_products_grid_list_enable',
				),
				'woo_products_panel_filter_enable' => array(
					'title'    => esc_html__( 'Filter Button', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'default'  => true,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'woo_products_panel_filter_btn_text' => array(
					'title'    => esc_html__( 'Filter Button Text', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'default'  => esc_html__( 'Filter', 'gutenix-pro' ),
					'field'    => 'text',
					'type'     => 'control',
					'transport'  => 'postMessage',
					'conditions'  => array(
						'woo_products_panel_filter_enable' => true,
					),
					'dynamic_css' => true,
				),
				
				'woo_products_heading' => array(
					'title' 	=> esc_html__( 'Products', 'gutenix-pro' ),
					'section' 	=> 'woo_catalog',
					'field' 	=> 'gutenix-heading',
					'type' 		=> 'control',
				),
				'woo_products_style' => array(
					'title'    => esc_html__( 'Products Style', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'default'  => 'default',
					'field'    => 'select',
					'type'     => 'control',
					'choices' 				=> array(
						'default' 		=> esc_html__( 'Default', 'gutenix-pro' ),
					),
				),
				'shop_elements_positioning' => array(
					'title'    => esc_html__( 'Elements Positioning', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'default'  => array( 'category', 'title', 'price', 'description', 'button', 'tags' ),
					'field'    => 'gutenix-sortable',
					'type'     => 'control',
					'choices'  => array(
						'category' 		=> esc_html__( 'Category', 'gutenix-pro' ),
						'title' 		=> esc_html__( 'Title', 'gutenix-pro' ),
						'price' 		=> esc_html__( 'Price', 'gutenix-pro' ),
						'description' 	=> esc_html__( 'Description', 'gutenix-pro' ),
						'button' 		=> esc_html__( 'Add To Cart', 'gutenix-pro' ),
						'rating' 		=> esc_html__( 'Rating', 'gutenix-pro' ),
						'tags' 			=> esc_html__( 'Meta Tags', 'gutenix-pro' ),
					),
					'sanitize_callback' => 'gutenix_customizer_sanitize_multi_choices',
					'conditions' => array(
						'woo_products_catalog_view' => 'grid',
					),
				),
				'woo_products_content_align' => array(
					'title'    => esc_html__( 'Content Alignment', 'gutenix-pro' ),
					'section'  => 'woo_catalog',
					'default'  => '',
					'field'    => 'select',
					'type'     => 'control',
					'choices'  => array(
						'' 			=> esc_html__( 'Left', 'gutenix-pro' ),
						'center' 	=> esc_html__( 'Center', 'gutenix-pro' ),
						'right' 	=> esc_html__( 'Right', 'gutenix-pro' ),
					),
				),
				'woo_products_excerpt_length' => array(
					'title'       => esc_html__( 'Excerpt Length', 'gutenix-pro' ),
					'description' => esc_html__( 'Length of the short description', 'gutenix-pro' ),
					'section'     => 'woo_catalog',
					'default'     => '10',
					'field'       => 'number',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 350,
						'step' => 1,
					),
					'type'        => 'control',
					'active_callback' 		=> 'gutenix_cac_woo_products_has_description',
				),

				/* Products Categories Settings */
				'woo_products_cat_typography_heading' => array(
					'title' 			=> esc_html__( 'Products Categories Settings', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_cat_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> array(
						'desktop' 	=> '16',
						'tablet' 	=> '',
						'mobile' 	=> '',
					),
					'field' 			=> 'gutenix-input-responsive',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min' => 0,
					),
					'unit_choices' 		=> '',
					'dynamic_css' 		=> true,
					'sanitize_callback' => 'sanitize_input_responsive',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '1.4',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#3260B1',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_color_hover' => array(
					'title' 			=> esc_html__( 'Hover Color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),
				'woo_products_cat_padding' => array(
					'title' 			=> esc_html__( 'Paddings, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '', 'bottom' => '7' ),
						'tablet'  => array( 'top' => '', 'bottom' => '' ),
						'mobile'  => array( 'top' => '', 'bottom' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),

				/* Products Title Settings */
				'woo_products_title_typography_heading' => array(
					'title' 			=> esc_html__( 'Products Title Settings', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> array(
						'desktop' 	=> '16',
						'tablet' 	=> '',
						'mobile' 	=> '',
					),
					'field' 			=> 'gutenix-input-responsive',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min' => 0,
					),
					'unit_choices' 		=> '',
					'dynamic_css' 		=> true,
					'sanitize_callback' => 'sanitize_input_responsive',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '1.4',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),
				'woo_products_title_padding' => array(
					'title' 			=> esc_html__( 'Paddings, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '', 'bottom' => '5' ),
						'tablet'  => array( 'top' => '', 'bottom' => '' ),
						'mobile'  => array( 'top' => '', 'bottom' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_title',
				),

				/* Products Categories Settings */
				'woo_products_price_typography_heading' => array(
					'title' 			=> esc_html__( 'Products Price Settings', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '400',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> array(
						'desktop' 	=> '20',
						'tablet' 	=> '',
						'mobile' 	=> '',
					),
					'field' 			=> 'gutenix-input-responsive',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min' => 0,
					),
					'unit_choices' 		=> '',
					'dynamic_css' 		=> true,
					'sanitize_callback' => 'sanitize_input_responsive',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_del_font_size' => array(
					'title' 			=> esc_html__( 'Sale Price Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> array(
						'desktop' 	=> '16',
						'tablet' 	=> '',
						'mobile' 	=> '',
					),
					'field' 			=> 'gutenix-input-responsive',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min' => 0,
					),
					'unit_choices' 		=> '',
					'dynamic_css' 		=> true,
					'sanitize_callback' => 'sanitize_input_responsive',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '1.3',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_color' => array(
					'title' 			=> esc_html__( 'Price Color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_ins_color' => array(
					'title' 			=> esc_html__( 'Regular Price Color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#DA4747',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_del_color' => array(
					'title' 			=> esc_html__( 'Sale Price Color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#A0A3AA',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_price',
				),
				'woo_products_price_padding' => array(
					'title' 			=> esc_html__( 'Paddings, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '', 'bottom' => '6' ),
						'tablet'  => array( 'top' => '', 'bottom' => '' ),
						'mobile'  => array( 'top' => '', 'bottom' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_cat',
				),

				/* Products Description Settings */
				'woo_products_descr_typography_heading' => array(
					'title' 			=> esc_html__( 'Products Description Settings', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '400',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> array(
						'desktop' 	=> '14',
						'tablet' 	=> '',
						'mobile' 	=> '',
					),
					'field' 			=> 'gutenix-input-responsive',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min' => 0,
					),
					'unit_choices' 		=> '',
					'dynamic_css' 		=> true,
					'sanitize_callback' => 'sanitize_input_responsive',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '1.6',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#A0A3AA',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_descr_padding' => array(
					'title' 			=> esc_html__( 'Paddings, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '', 'bottom' => '15' ),
						'tablet'  => array( 'top' => '', 'bottom' => '' ),
						'mobile'  => array( 'top' => '', 'bottom' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),

				/* Products Button Settings */
				'woo_products_btn_typography_heading' => array(
					'title' 			=> esc_html__( 'Products Button Settings', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_woo_products_has_description',
				),
				'woo_products_btn_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '800',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> array(
						'desktop' => '16',
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
				'woo_products_btn_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '1.5',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => - 10,
						'max'  => 10,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_text_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_radius' => array(
					'title' 			=> esc_html__( 'Border Radius, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '4',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_border_width' => array(
					'title' 			=> esc_html__( 'Border Width, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_text_color' => array(
					'title' 			=> esc_html__( 'Text color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#ffffff',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_text_color_hover' => array(
					'title' 			=> esc_html__( 'Text color on Hover or Active Button', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#ffffff',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_bg' => array(
					'title' 			=> esc_html__( 'Background color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#3260B1',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_bg_hover' => array(
					'title' 			=> esc_html__( 'Background color on Hover or Active Button', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '#5886d7',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_border_color' => array(
					'title' 			=> esc_html__( 'Border color', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_border_color_hover' => array(
					'title' 			=> esc_html__( 'Border color on Hover', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'default' 			=> '',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'woo_products_btn_padding' => array(
					'title' 			=> esc_html__( 'Paddings, px', 'gutenix-pro' ),
					'section' 			=> 'woo_catalog',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix-pro' ),
						'right'  => esc_html__( 'Right', 'gutenix-pro' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix-pro' ),
						'left'   => esc_html__( 'Left', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '10', 'right' => '30', 'bottom' => '10', 'left' => '30' ),
						'tablet'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'mobile'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
				),

				/** `WooCommerce Single Product` section */
				'woo_product' => array(
					'title'    => esc_html__( 'Single Product', 'gutenix-pro' ),
					'panel'    => 'woo_panel',
					'type'     => 'section',
				),
				'layout_type_product' => array(
					'title'    => esc_html__( 'Layout for Single Product', 'gutenix-pro' ),
					'section'  => 'woo_product',
					'default'  => 'boxed-full-width',
					'field'    => 'gutenix-radio-image',
					'type'     => 'control',
					'choices'  => Gutenix_Utils::get_page_layout_options(),
				),
				'product_sidebar_order' => array(
					'title'    => esc_html__( 'Mobile Sidebar Order', 'gutenix-pro' ),
					'section'  => 'woo_product',
					'default'  => 'content-sidebar',
					'field'    => 'select',
					'type'     => 'control',
					'choices' 				=> array(
						'content-sidebar' 	=> esc_html__( 'Content / Sidebar', 'gutenix-pro' ),
						'sidebar-content' 	=> esc_html__( 'Sidebar / Content', 'gutenix-pro' ),
					),
					'active_callback' 		=> 'gutenix_cac_woo_product_sidebar_order',
				),
				'woo_product_gallery_summary_width' => array(
					'title'       => esc_html__( 'Content Gallery & Summary Width, %', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => 84,
					'field'       => 'gutenix-range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type'        => 'control',
				),
				'woo_product_gallery_width' => array(
					'title'       => esc_html__( 'Image Width, %', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => 57,
					'field'       => 'gutenix-range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type'        => 'control',
				),
				'woo_product_summary_width' => array(
					'title'       => esc_html__( 'Summary Width, %', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => 43,
					'field'       => 'gutenix-range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type'        => 'control',
				),
				'woo_product_gallery_thumbs_cols' => array(
					'title'       => esc_html__( 'Thumbnails Product Per Row', 'gutenix-pro' ),
					'description' => esc_html__( 'How many thumbnails product should be shown per row?', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => '5',
					'field'       => 'number',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
					'type'        => 'control',
				),

				'woo_product_summary_elements_positioning' => array(
					'title'    => esc_html__( 'Summary Elements Positioning', 'gutenix-pro' ),
					'section'  => 'woo_product',
					'default'  => array( 'title', 'price', 'rating', 'excerpt', 'button', 'meta', 'share' ),
					'field'    => 'gutenix-sortable',
					'type'     => 'control',
					'choices'  => array(
						'title' 		=> esc_html__( 'Title', 'gutenix-pro' ),
						'price' 		=> esc_html__( 'Price', 'gutenix-pro' ),
						'rating' 		=> esc_html__( 'Rating', 'gutenix-pro' ),
						'excerpt' 		=> esc_html__( 'Excerpt', 'gutenix-pro' ),
						'button' 		=> esc_html__( 'Quantity & Add To Cart', 'gutenix-pro' ),
						'meta' 			=> esc_html__( 'Product Meta', 'gutenix-pro' ),
						'share' 		=> esc_html__( 'Share Networks', 'gutenix-pro' ),
					),
					'sanitize_callback' => 'gutenix_customizer_sanitize_multi_choices',
				),
				'woo_product_share_networks' => array(
					'title'    => esc_html__( 'Share on:', 'gutenix-pro' ),
					'section'  => 'woo_product',
					'default'  => array( 'facebook', 'twitter', 'pinterest', 'whatsapp', 'email' ),
					'field'    => 'gutenix-multi-check',
					'type'     => 'control',
					'choices'  => Gutenix_Utils::get_share_networks_options(),
					'sanitize_callback' => 'gutenix_customizer_sanitize_multi_choices',
					'active_callback' => 'gutenix_cac_woo_product_has_share',
				),

				'woo_product_upsells_heading' => array(
					'title' 	=> esc_html__( 'Upsells & Related Items', 'gutenix-pro' ),
					'section' 	=> 'woo_product',
					'field' 	=> 'gutenix-heading',
					'type' 		=> 'control',
				),
				'woo_product_upsells_count' => array(
					'title'       => esc_html__( 'UpSells Count', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => '3',
					'field'       => 'number',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
					'type'        => 'control',
				),
				'woo_product_upsells_cols' => array(
					'title'       => esc_html__( 'UpSells Columns', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => '3',
					'field'       => 'number',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 7,
						'step' => 1,
					),
					'type'        => 'control',
				),
				'woo_product_related_enable' => array(
					'title'    => esc_html__( 'Display Related Items', 'gutenix-pro' ),
					'section'  => 'woo_product',
					'default'  => true,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'woo_product_related_count' => array(
					'title'       => esc_html__( 'Related Items Count', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => '3',
					'field'       => 'number',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
					'type'        => 'control',
				),
				'woo_product_related_cols' => array(
					'title'       => esc_html__( 'Related Products Columns', 'gutenix-pro' ),
					'section'     => 'woo_product',
					'default'     => '3',
					'field'       => 'number',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 7,
						'step' => 1,
					),
					'type'        => 'control',
				),

				/* Single Product Title Settings */
				'woo_product_title_typography_heading' => array(
					'title' 			=> esc_html__( 'Product Title Settings', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'default' 			=> array(
						'desktop' 	=> '34',
						'tablet' 	=> '',
						'mobile' 	=> '',
					),
					'field' 			=> 'gutenix-input-responsive',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min' => 0,
					),
					'unit_choices' 		=> '',
					'dynamic_css' 		=> true,
					'sanitize_callback' => 'sanitize_input_responsive',
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'default' 			=> '1.2',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),
				'woo_product_title_padding' => array(
					'title' 			=> esc_html__( 'Paddings, px', 'gutenix-pro' ),
					'section' 			=> 'woo_product',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '', 'bottom' => '4' ),
						'tablet'  => array( 'top' => '', 'bottom' => '' ),
						'mobile'  => array( 'top' => '', 'bottom' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_single_product_has_title',
				),

				/** `WooCommerce Checkout Page` section */
				'woo_checkout_section' => array(
					'title'    => esc_html__( 'Checkout', 'gutenix-pro' ),
					'panel'    => 'woo_panel',
					'type'     => 'section',
				),
				'woo_checkout_sticky_order' => array(
					'title'    => esc_html__( 'Sticky Order', 'gutenix-pro' ),
					'section'  => 'woo_checkout_section',
					'default'  => false,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
			);
		}

		/**
		 * Added single product selective refresh partial.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function selective_refresh_partials() {
			return array(
				'woo_single_product' => array(
					'selector' => '.summary',
					'settings' => array(
						'woo_product_gallery_summary_width',
						'woo_product_share_networks',
					),
				),
				'woo_products_list_item' => array(
					'selector' => '.products',
					'settings' => array(
						'shop_elements_positioning'
					)
				)
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
			add_action( 'woocommerce_before_shop_loop', 	array( $this, 'gutenix_wc_loop_products_panel_grid_list_buttons' ), 15 );
			add_filter( 'gutenix_get_dynamic_css_options', 	array( $this, 'dynamic_css_file' ) );
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

			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/woo-dynamic-css.php' );
			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/woo-dynamic.css' );

			return $options;
		}

		/**
		 * Add to panel grid/list buttons.
		 *
		 * @since 1.0.0
		 */
		function gutenix_wc_loop_products_panel_grid_list_buttons() {

			$buttons_enable = gutenix_theme()->customizer->get_value( 'woo_products_grid_list_enable', true );

			if ( true != $buttons_enable ) {
				return;
			}

			// Titles
			$grid_view = esc_html__( 'Grid View', 'gutenix-pro' );
			$list_view = esc_html__( 'List View', 'gutenix-pro' );

			// Active class
			if ( 'list' == gutenix_theme()->customizer->get_value( 'woo_products_catalog_view', 'grid' ) ) {
				$list = 'active ';
				$grid = '';
			} else {
				$grid = 'active ';
				$list = '';
			}

			$output = sprintf( '<nav class="gutenix-products-panel-views">
				<a href="javascript:void(0)" id="gutenix-views-grid" title="%1$s" class="%2$sgrid-btn">
					<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="7" height="7"/><rect y="9" width="7" height="7"/><rect x="9" y="9" width="7" height="7"/><rect x="9" width="7" height="7"/></svg>
				</a>
				<a href="javascript:void(0)" id="gutenix-views-list" title="%3$s" class="%4$slist-btn">
					<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="4" height="4"/><rect y="6" width="4" height="4"/><rect y="12" width="4" height="4"/><rect x="5" width="11" height="4"/><rect x="5" y="6" width="11" height="4"/><rect x="5" y="12" width="11" height="4"/></svg>
				</a>
				</nav>',
				esc_html( $grid_view ), esc_attr( $grid ), esc_html( $list_view ), esc_attr( $list ) );

			echo $output;
		}
	}
}
