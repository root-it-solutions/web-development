<?php
/**
 * Gutenix_Pro_Custom_Content class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Custom_Content' ) ) {

	/**
	 * Define Gutenix_Pro_Custom_Content class
	 */
	class Gutenix_Pro_Custom_Content extends Gutenix_Pro_Module_Base {

		/**
		 * Add custom content hooks
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function hooks() {

			// Get ads locations
			$locations = $this->get_custom_content_locations();

			foreach ( $locations as $location ) {
				add_action( 'gutenix_before_' . $location['slug'], 	array( $this, 'custom_content_display' ) );
				add_action( 'gutenix_after_' . $location['slug'], 	array( $this, 'custom_content_display' ) );
			}
		}
		
		/**
		 * Define array of Additional Content Locations
		 */
		public function get_custom_content_locations() {
			$content = array(
				array(
					'slug'     => 'body',
					'name'     => esc_html__( 'Body', 'gutenix-pro' ),
				),
				array(
					'slug'     => 'header',
					'name'     => esc_html__( 'Header', 'gutenix-pro' ),
				),
				array(
					'slug'     => 'content_page',
					'name'     => esc_html__( 'Page Content', 'gutenix-pro' ),
				),
				array(
					'slug'     => 'posts_list',
					'name'     => esc_html__( 'Posts List', 'gutenix-pro' ),
				),
				array(
					'slug'     => 'single_post',
					'name'     => esc_html__( 'Single Post', 'gutenix-pro' ),
				),
				array(
					'slug'     => 'single_post_content',
					'name'     => esc_html__( 'Single Post Content', 'gutenix-pro' ),
				),
				array(
					'slug'     => 'single_post_author',
					'name'     => esc_html__( 'Single Post Author', 'gutenix-pro' ),
				),
			);
			return $content;
		}

		/**
		 * Added custom content options to customizer
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				
				// Body Section
				'add_content_body_section' => array(
					'title'    => esc_html__( 'Body', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_body' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_body_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
					'sanitize_callback' => 'wp_kses_post',
				),
				'add_content_after_body' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_body_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),

				// Header Section
				'add_content_header_section' => array(
					'title'    => esc_html__( 'Header', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_header' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_header_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
				'add_content_after_header' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_header_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),

				// Page Content Section
				'add_content_content_section' => array(
					'title'    => esc_html__( 'Page Content', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_content_page' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_content_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
				'add_content_after_content_page' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_content_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),

				// Posts List Section
				'add_content_posts_list_section' => array(
					'title'    => esc_html__( 'Posts List', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_posts_list' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_posts_list_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
				'add_content_after_posts_list' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_posts_list_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),

				// Single Post Section
				'add_content_single_post_section' => array(
					'title'    => esc_html__( 'Single Post', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_single_post' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_single_post_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
				'add_content_after_single_post' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_single_post_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),

				// Single Post Content Section
				'add_content_single_post_content_section' => array(
					'title'    => esc_html__( 'Single Post Content', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_single_post_content' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_single_post_content_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
				'add_content_after_single_post_content' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_single_post_content_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),

				// Single Post Author Section
				'add_content_single_post_author_section' => array(
					'title'    => esc_html__( 'Single Post Author', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_single_post_author' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_single_post_author_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
				'add_content_after_single_post_author' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_single_post_author_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),

				// Footer Section
				'add_content_footer_section' => array(
					'title'    => esc_html__( 'Footer', 'gutenix-pro' ),
					'panel'    => 'additional_content_panel',
					'type'     => 'section',
				),
				'add_content_before_footer' => array(
					'title'       => esc_html__( 'Before', 'gutenix-pro' ),
					'section'     => 'add_content_footer_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
				'add_content_after_footer' => array(
					'title'       => esc_html__( 'After', 'gutenix-pro' ),
					'section'     => 'add_content_footer_section',
					'default'     => '',
					'field'       => 'textarea',
					'type'        => 'control',
				),
			);
		}

		/**
		 * Actions
		 */
		public function custom_content_display() {

			// Get current action name
			$current = current_filter();

			// Get ads locations
			$locations = $this->get_custom_content_locations();

			$allowed_html = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
				),
				'img' => array(
					'src' => array(),
					'alt' => array(),
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'p' => array(),
				'h1' => array(),
				'h2' => array(),
				'h3' => array(),
				'h4' => array(),
				'h5' => array(),
				'h6' => array(),
			);

			// Loop through all locations
			foreach ( $locations as $location ) {
					
				// Before.
				if ( 'gutenix_before_' . $location['slug'] === $current ) {
					$code = gutenix_theme()->customizer->get_value( 'add_content_before_' . $location['slug'] );
					if ( $code ) {
						echo '<section class="custom-content custom-content-before-' . esc_html( $location['slug'] ) . '">' . wp_kses( $code, $allowed_html) . '</section>';
					}
				}
				
				// After.
				if ( 'gutenix_after_' . $location['slug'] === $current ) {
					$code = gutenix_theme()->customizer->get_value( 'add_content_after_' . $location['slug'] );
					if ( $code ) {
						echo '<section class="custom-content custom-content-after-' . esc_html( $location['slug'] ) . '">' . wp_kses( $code, $allowed_html) . '</section>';
					}
				}
			}
		}
	}
}
