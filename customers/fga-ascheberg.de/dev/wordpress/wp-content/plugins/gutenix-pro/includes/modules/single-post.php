<?php
/**
 * Gutenix_Pro_Single_Post class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Single_Post' ) ) {

	/**
	 * Define Gutenix_Pro_Single_Post class
	 */
	class Gutenix_Pro_Single_Post extends Gutenix_Pro_Module_Base {

		/**
		 * Added blog posts options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				
				/* Single Post Content Width */
				'single_post_content_width' => array(
					'title' 			=> esc_html__( 'Content Width, %', 'gutenix' ),
					'section' 			=> 'blog_post',
					'priority' 			=> 15,
					'default' 			=> 100,
					'field' 			=> 'gutenix-range',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'layout_type_post' => array( 'boxed-full-width', 'full-width' )
					),
				),

				'single_post_sidebar_order' => array(
					'title'    => esc_html__( 'Mobile Sidebar Order', 'gutenix-pro' ),
					'section' 			=> 'blog_post',
					'priority' 			=> 15,
					'default' 			=> 'content-sidebar',
					'field'    => 'select',
					'type'     => 'control',
					'choices' 				=> array(
						'content-sidebar' 	=> esc_html__( 'Content / Sidebar', 'gutenix-pro' ),
						'sidebar-content' 	=> esc_html__( 'Sidebar / Content', 'gutenix-pro' ),
					),
					'conditions' => array(
						'layout_type_post' => array( 'boxed-content-sidebar', 'boxed-sidebar-content' ),
					),
				),

				'single_post_elements_positioning' => array(
					'title' 			=> esc_html__( 'Elements Positioning', 'gutenix-pro' ),
					'section' 			=> 'blog_post',
					'priority' 			=> 15,
					'default' 			=> array( 'title', 'meta', 'thumbmnail', 'content', 'tags', 'share', 'author_bio', 'post_navigation', 'related_posts', 'comments' ),
					'field' 			=> 'gutenix-sortable',
					'type' 				=> 'control',
					'choices' 			=> $this->get_post_order(),
					'sanitize_callback' => 'gutenix_customizer_sanitize_multi_choices',
				),

				'single_post_meta_sep' => array(
					'section' 			=> 'blog_post',
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
				),

				'single_post_share_networks' => array(
					'title' 			=> esc_html__( 'Share on:', 'gutenix-pro' ),
					'section' 			=> 'blog_post',
					'priority' 			=> 25,
					'default' 			=> array( 'facebook', 'twitter', 'pinterest', 'whatsapp', 'email' ),
					'field' 			=> 'gutenix-multi-check',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_share_networks_options(),
					'sanitize_callback' => 'gutenix_customizer_sanitize_multi_choices',
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
						'single_post_elements_positioning'
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
			add_filter( 'gutenix_single_post_order', 		array( $this, 'set_single_post_order' ) );
			add_filter( 'gutenix_get_dynamic_css_options', 	array( $this, 'dynamic_css_file' ) );
		}

		/**
		 * Get blog order options.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function get_post_order() {
			return apply_filters( 'gutenix_pro/blog_order', array(
				'title' 			=> esc_html__( 'Title', 'gutenix-pro' ),
				'meta' 				=> esc_html__( 'Meta', 'gutenix-pro' ),
				'thumbmnail' 		=> esc_html__( 'Featured Image', 'gutenix-pro' ),
				'content' 			=> esc_html__( 'Content', 'gutenix-pro' ),
				'tags' 				=> esc_html__( 'Tags', 'gutenix-pro' ),
				'share' 			=> esc_html__( 'Share Icons', 'gutenix-pro' ),
				'author_bio' 		=> esc_html__( 'Author Bio', 'gutenix-pro' ),
				'post_navigation' 	=> esc_html__( 'Post Navigation', 'gutenix-pro' ),
				'related_posts' 	=> esc_html__( 'Related Posts', 'gutenix-pro' ),
				'comments' 			=> esc_html__( 'Comments', 'gutenix-pro' ),
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
		public function set_single_post_order( $sections = array() ) {

			// Default sections
			$sections = array( 'title', 'meta', 'thumbmnail', 'content', 'tags', 'share', 'author_bio', 'post_navigation', 'related_posts', 'comments' );

			// Get sections from Customizer
			$sections = gutenix_theme()->customizer->get_value( 'single_post_elements_positioning', $sections );

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

			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/single-post.css' );

			return $options;
		}
	}
}
