<?php
/**
 * Gutenix_Pro_Blog_Posts class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Blog_Posts' ) ) {

	/**
	 * Define Gutenix_Pro_Blog_Posts class
	 */
	class Gutenix_Pro_Blog_Posts extends Gutenix_Pro_Module_Base {

		/**
		 * Added blog posts options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(

				/* Blog Posts Thumbnail */
				'blog_listing2_thumb_width' => array(
					'title' 			=> esc_html__( 'Thumbnail Width, %', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 5,
					'default' 			=> 44,
					'field' 			=> 'gutenix-range',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_layout_type' => 'default-2',
					)
				),
				'blog_listing2_thumb_margin' => array(
					'title' 			=> esc_html__( 'Thumbnail Indent, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 5,
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
						'desktop' => array( 'top' => '5', 'right' => '40', 'bottom' => '0', 'left' => '' ),
						'tablet'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'mobile'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => ''	),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_layout_type' => 'default-2',
					)
				),
				'blog_post_border_width' => array(
					'title' 			=> esc_html__( 'Posts Separator Border Width, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 5,
					'default' 			=> '1',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_layout_type' => array( 'default', 'default-2' ),
					)
				),
				'blog_post_border_color' => array(
					'title' 			=> esc_html__( 'Posts Separator Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 5,
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'default' 			=> '#e8e9eb',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_layout_type' => array( 'default', 'default-2' ),
					)
				),

				/* Grid, Masonry Posts per Row */
				'blog_post_grid_columns' => array(
					'title' 			=> esc_html__( 'Posts per row', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 5,
					'default' 			=> '2',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> array(
						'2' => esc_html__( '2 Columns', 'gutenix-pro' ),
						'3' => esc_html__( '3 Columns', 'gutenix-pro' ),
					),
					'conditions' 		=> array(
						'blog_layout_type' => array( 'grid', 'masonry' ),
					),
				),

				'blog_post_item_indent' => array(
					'title' 			=> esc_html__( 'Blog Post Indent, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 5,
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '50', 'bottom' => '50' ),
						'tablet'  => array( 'top' => '', 'bottom' => '' ),
						'mobile'  => array( 'top' => '', 'bottom' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
				),
				
				'blog_post_sidebar_order' => array(
					'title'    => esc_html__( 'Mobile Sidebar Order', 'gutenix-pro' ),
					'section'  => 'blog',
					'priority' 			=> 5,
					'default'  => 'content-sidebar',
					'field'    => 'select',
					'type'     => 'control',
					'choices' 			=> array(
						'content-sidebar' => esc_html__( 'Content / Sidebar', 'gutenix-pro' ),
						'sidebar-content' => esc_html__( 'Sidebar / Content', 'gutenix-pro' ),
					),
					'conditions' 		=> array(
						'layout_type_blog' => array( 'boxed-content-sidebar', 'boxed-sidebar-content' ),
					),
				),

				'blog_entry_elements_positioning' => array(
					'title' 			=> esc_html__( 'Elements Order', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 5,
					'default' 			=> array( 'title', 'meta', 'featured_image', 'excerpt', 'entry_footer' ),
					'field' 			=> 'gutenix-sortable',
					'type' 				=> 'control',
					'choices' 			=> $this->get_blog_order(),
					'sanitize_callback' => 'gutenix_customizer_sanitize_multi_choices',
					'conditions' 		=> array(
						'blog_layout_type' => array( 'default', 'grid', 'masonry', 'justify' ),
					)
				),

				/* `Read More` options */
				'blog_read_more_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '800',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
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
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '1.5',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '#3260b1',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_color_hover' => array(
					'title' 			=> esc_html__( 'Color Hover', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '#3260b1',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_bg_color' => array(
					'title' 			=> esc_html__( 'Background Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '#ffffff',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_bg_color_hover' => array(
					'title' 			=> esc_html__( 'Background Color Hover', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '#f6f6f7',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_border_width' => array(
					'title' 			=> esc_html__( 'Border Width, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '1',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> 0,
						'max' 	=> 100,
						'step' 	=> 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_border_radius' => array(
					'title' 			=> esc_html__( 'Border Radius, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '4',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> 0,
						'max' 	=> 500,
						'step' 	=> 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_border_color' => array(
					'title' 			=> esc_html__( 'Border Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '#e8e9eb',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_border_color_hover' => array(
					'title' 			=> esc_html__( 'Border Color Hover', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
					'default' 			=> '#f6f6f7',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),
				'blog_read_more_padding' => array(
					'title' 			=> esc_html__( 'Vertical Padding, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 60,
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
						'desktop' => array( 'top' => '12', 'right' => '20', 'bottom' => '12', 'left' => '20' ),
						'tablet'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'mobile'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => ''	),
					),
					'input_attrs' 		=> array(
						'min' 		=> 0,
						'max' 		=> 200,
						'step' 		=> 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'blog_read_more' => true,
					),
				),

				/* Blog Post Title Settings */
				'blog_post_title_typography_heading' => array(
					'title' 			=> esc_html__( 'Blog Post Title Settings', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_font_family' => array(
					'title' 			=> esc_html__( 'Font Family', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> 'Libre Franklin, sans-serif',
					'field' 			=> 'fonts',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_character_set' => array(
					'title' 			=> esc_html__( 'Character Set', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Important: Not all fonts support every characters and font-weight.', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> 'latin',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_character_sets(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> array(
						'desktop' 	=> '48',
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
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> '1.2',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_align' => array(
					'title' 			=> esc_html__( 'Text Align', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> 'inherit',
					'field' 			=> 'gutenix-radio-image',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_align_options(),
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),
				'blog_post_title_padding' => array(
					'title' 			=> esc_html__( 'Vertical Padding, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 70,
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top' 		=> esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' 	=> esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' 	=> array( 'top' => '', 'bottom' => '20' ),
						'tablet' 	=> array( 'top' => '', 'bottom' => '' ),
						'mobile' 	=> array( 'top' => '', 'bottom' => ''	),
					),
					'input_attrs' 		=> array(
						'min' 		=> 0,
						'max' 		=> 200,
						'step' 		=> 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_title',
				),

				/* Blog Post Meta Settings */
				'blog_post_meta_typography_heading' => array(
					'title' 			=> esc_html__( 'Blog Post Meta Settings', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_font_size' => array(
					'title' 			=> esc_html__( 'Font Size for all Meta Tags, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
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
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				'blog_post_meta_sep1' => array(
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				'blog_post_meta_cat_font_style' => array(
					'title' 			=> esc_html__( 'Categories Font Style', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_cat_font_weight' => array(
					'title' 			=> esc_html__( 'Categories Font Weight', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Important: Not all fonts support every font-weight.', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_cat_color' => array(
					'title' 			=> esc_html__( 'Categories Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '#3260B1',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				'blog_post_meta_sep2' => array(
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				// meta author
				'blog_post_meta_author_font_style' => array(
					'title' 			=> esc_html__( 'Author Font Style', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_author_font_weight' => array(
					'title' 			=> esc_html__( 'Author Font Weight', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Important: Not all fonts support every font-weight.', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_author_color' => array(
					'title' 			=> esc_html__( 'Author Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '#a0a3aa',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				'blog_post_meta_sep3' => array(
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				// meta date
				'blog_post_meta_date_font_style' => array(
					'title' 			=> esc_html__( 'Date Font Style', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_date_font_weight' => array(
					'title' 			=> esc_html__( 'Date Font Weight', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Important: Not all fonts support every font-weight.', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '400',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_date_color' => array(
					'title' 			=> esc_html__( 'Date Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '#a0a3aa',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				'blog_post_meta_sep4' => array(
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				// meta tags
				'blog_post_meta_tags_font_style' => array(
					'title' 			=> esc_html__( 'Tags Font Style', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_tags_font_weight' => array(
					'title' 			=> esc_html__( 'Tags Font Weight', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Important: Not all fonts support every font-weight.', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '400',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),
				'blog_post_meta_tags_color' => array(
					'title' 			=> esc_html__( 'Tags Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'default' 			=> '#a0a3aa',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				'blog_post_meta_sep5' => array(
					'section' 			=> 'blog',
					'priority' 			=> 75,
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				'blog_post_meta_padding' => array(
					'title' 			=> esc_html__( 'Vertical Padding, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 80,
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top' 		=> esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' 	=> esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' 	=> array( 'top' => '', 'bottom' => '20' ),
						'tablet' 	=> array( 'top' => '', 'bottom' => '' ),
						'mobile' 	=> array( 'top' => '', 'bottom' => ''	),
					),
					'input_attrs' 		=> array(
						'min' 		=> 0,
						'max' 		=> 200,
						'step' 		=> 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_meta',
				),

				/* Blog Post Excerpt Settings */
				'blog_post_excerpt_settings_heading' => array(
					'title' 			=> esc_html__( 'Blog Post Excerpt Settings', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_excerpt',
				),
				'blog_post_excerpt_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_excerpt',
				),
				'blog_post_excerpt_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'default' 			=> '400',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_excerpt',
				),
				'blog_post_excerpt_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
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
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_excerpt',
				),
				'blog_post_excerpt_line_height' => array(
					'title' 			=> esc_html__( 'Line Height', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'default' 			=> '1.6',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1.0,
						'max'  => 3.0,
						'step' => 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'blog_post_excerpt_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_excerpt',
				),
				'blog_post_excerpt_align' => array(
					'title' 			=> esc_html__( 'Text Align', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'default' 			=> 'inherit',
					'field' 			=> 'gutenix-radio-image',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_align_options(),
					'dynamic_css' 		=> true,
				),
				'blog_post_excerpt_text_transform' => array(
					'title' 			=> esc_html__( 'Text Transform', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
				),
				'blog_post_excerpt_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_excerpt',
				),
				'blog_post_excerpt_padding' => array(
					'title' 			=> esc_html__( 'Vertical Padding, px', 'gutenix-pro' ),
					'section' 			=> 'blog',
					'priority' 			=> 85,
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top' 		=> esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' 	=> esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' 	=> array( 'top' => '', 'bottom' => '15' ),
						'tablet' 	=> array( 'top' => '', 'bottom' => '' ),
						'mobile' 	=> array( 'top' => '', 'bottom' => ''	),
					),
					'input_attrs' 		=> array(
						'min' 		=> 0,
						'max' 		=> 200,
						'step' 		=> 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'active_callback' 	=> 'gutenix_cac_has_blog_entry_excerpt',
				),
			);
		}

		/**
		 * Modify posts list selective refresh partial
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function selective_refresh_partials() {
			return array(
				'posts_order' => array(
					'settings' => array(
						'blog_entry_elements_positioning'
					),
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
			add_filter( 'gutenix_posts_list_order', 		array( $this, 'set_posts_list_order' ) );
			add_filter( 'gutenix_get_dynamic_css_options', 	array( $this, 'dynamic_css_file' ) );
			add_filter( 'gutenix_posts_grid_columns', 		array( $this, 'set_posts_grid_columns' ) );
		}

		/**
		 * Get blog order options.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function get_blog_order() {
			return apply_filters( 'gutenix_pro/blog_order', array(
				'title'       		=> esc_html__( 'Title', 'gutenix-pro' ),
				'meta' 				=> esc_html__( 'Meta', 'gutenix-pro' ),
				'featured_image'    => esc_html__( 'Featured Image', 'gutenix-pro' ),
				'excerpt' 			=> esc_html__( 'Content', 'gutenix-pro' ),
				'entry_footer'   	=> esc_html__( 'Bottom Line', 'gutenix-pro' ),
			) );
		}

		/**
		 * Modify post list layout.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $default_layout Default posts list layout.
		 * @return string
		 */
		public function set_posts_list_order( $sections = array() ) {

			// Default sections
			$sections = array( 'title', 'meta', 'featured_image', 'excerpt', 'entry_footer' );

			// Get sections from Customizer
			$sections = gutenix_theme()->customizer->get_value( 'blog_entry_elements_positioning', $sections );

			// Turn into array if string
			if ( $sections && ! is_array( $sections ) ) {
				$sections = explode( ',', $sections );
			}

			// Return sections
			return $sections;
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

			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/blog-posts.css' );

			return $options;
		}

		/**
		 * Modify post list layout.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $default_layout Default posts list layout.
		 * @return string
		 */
		public function set_posts_grid_columns( $default_cols = '2' ) {

			$columns = gutenix_theme()->customizer->get_value( 'blog_post_grid_columns' );

			if ( ! empty( $columns ) && ! is_search() ) {
				return $columns;
			}

			return $default_cols;
		}
	}
}
