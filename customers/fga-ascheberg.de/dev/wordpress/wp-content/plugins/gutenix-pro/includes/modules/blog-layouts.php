<?php
/**
 * Gutenix_Pro_Blog_Layouts class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Blog_Layouts' ) ) {

	/**
	 * Define Gutenix_Pro_Blog_Layouts class
	 */
	class Gutenix_Pro_Blog_Layouts extends Gutenix_Pro_Module_Base {

		/**
		 * Added blog layouts options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				'blog_layout_type' => array(
					'title'    => esc_html__( 'Layout', 'gutenix-pro' ),
					'section'  => 'blog',
					'priority' => 5,
					'default'  => 'default',
					'field'    => 'select',
					'choices'  => $this->get_blog_layouts(),
					'type'     => 'control',
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
				'posts_list' => array(
					'settings' => array( 'blog_layout_type' ),
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
			add_filter( 'gutenix_posts_list_layout',       array( $this, 'set_posts_list_layout' ) );
			add_filter( 'gutenix_post_template_part_slug', array( $this, 'post_template_part_slug' ) );
		}

		/**
		 * Get blog layouts options.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function get_blog_layouts() {
			return apply_filters( 'gutenix_pro/blog_layouts', array(
				'default'   => esc_html__( 'Listing 1', 'gutenix-pro' ),
				'default-2' => esc_html__( 'Listing 2', 'gutenix-pro' ),
				'grid'      => esc_html__( 'Grid', 'gutenix-pro' ),
				'masonry'   => esc_html__( 'Masonry', 'gutenix-pro' ),
				'justify'   => esc_html__( 'Justify', 'gutenix-pro' ),
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
		public function set_posts_list_layout( $default_layout = 'default' ) {

			$layout = gutenix_theme()->customizer->get_value( 'blog_layout_type' );

			if ( ! empty( $layout ) && ! is_search() ) {
				return $layout;
			}

			return $default_layout;
		}

		/**
		 * Added additional post template part slugs.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $slug Default slug.
		 * @return string
		 */
		public function post_template_part_slug( $slug ) {
			$layout = gutenix_theme()->customizer->get_value( 'blog_layout_type' );

			if ( 'default' !== $layout ) {
				return 'template-parts/posts/' . esc_attr( $layout ) . '/content';
			}

			return $slug;
		}
	}

}
