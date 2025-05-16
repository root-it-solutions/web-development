<?php
/**
 * Gutenix_Pro_Post_Meta class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Post_Meta' ) ) {

	/**
	 * Define Gutenix_Pro_Post_Meta class
	 */
	class Gutenix_Pro_Post_Meta {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    Gutenix_Pro_Post_Meta
		 */
		private static $instance = null;

		/**
		 * Constructor for the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init() {
			add_action( 'init', array( $this, 'init_post_meta' ) );
		}

		/**
		 * Init post meta.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init_post_meta() {

			$default_fields = apply_filters( 'gutenix_pro/page_settings/default_fields', array(
				'gutenix_pro_layout_type_pages' => array(
					'title'       => esc_html__( 'Page Layout', 'gutenix-pro' ),
					'description' => esc_html__( 'Page layout global settings redefining.', 'gutenix-pro' ),
					'type'        => 'select',
					'value'       => 'inherit',
					'options'     => array_merge( array( 'inherit' => esc_html__( 'Inherit', 'gutenix-pro' ) ), Gutenix_Utils::get_page_layout_options() ),
				),
				'gutenix_pro_get_page_sidebar' => array(
					'title'       => esc_html__( 'Page Sidebar', 'gutenix-pro' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array_merge( array( 'inherit' => esc_html__( 'Inherit', 'gutenix-pro' ) ), Gutenix_Utils::get_page_sidebar_options() ),
				),
				'gutenix_pro_show_page_title' => array(
					'title'       => esc_html__( 'Show Page Title', 'gutenix-pro' ),
					'description' => esc_html__( 'Page title global settings redefining.', 'gutenix-pro' ),
					'type'        => 'select',
					'value'       => 'inherit',
					'options'     => array(
						'inherit' => esc_html__( 'Inherit', 'gutenix-pro' ),
						'true'    => esc_html__( 'Show', 'gutenix-pro' ),
						'false'   => esc_html__( 'Hide', 'gutenix-pro' ),
					),
					'page'        => 'page',
				),
				'gutenix_pro_header_layout_type' => array(
					'title'       => esc_html__( 'Header Layout', 'gutenix-pro' ),
					'description' => esc_html__( 'Header layout global settings redefining.', 'gutenix-pro' ),
					'type'        => 'select',
					'value'       => 'inherit',
					'options'     => array_merge( array( 'inherit' => esc_html__( 'Inherit', 'gutenix-pro' ) ), Gutenix_Utils::get_header_layout_options() ),
				),
				'gutenix_pro_footer_layout_type' => array(
					'title'       => esc_html__( 'Footer Layout', 'gutenix-pro' ),
					'description' => esc_html__( 'Footer layout global settings redefining.', 'gutenix-pro' ),
					'type'        => 'select',
					'value'       => 'inherit',
					'options'     => array_merge( array( 'inherit' => esc_html__( 'Inherit', 'gutenix-pro' ) ), Gutenix_Utils::get_footer_layout_options() ),
				),
			) );

			$disable_fields = apply_filters( 'gutenix_pro/page_settings/disable_fields', array(
				'gutenix_pro_disable_top_panel_visible' => array(
					'title'  => esc_html__( 'Disable Top Panel', 'gutenix-pro' ),
					'type'   => 'switcher',
					'value'  => false,
					'toggle' => array(
						'true_toggle'  => esc_html__( 'Yes', 'gutenix-pro' ),
						'false_toggle' => esc_html__( 'No', 'gutenix-pro' ),
					),
				),
				'gutenix_pro_disable_footer_widgets_visible' => array(
					'title'  => esc_html__( 'Disable Footer Widgets Area', 'gutenix-pro' ),
					'type'   => 'switcher',
					'value'  => false,
					'toggle' => array(
						'true_toggle'  => esc_html__( 'Yes', 'gutenix-pro' ),
						'false_toggle' => esc_html__( 'No', 'gutenix-pro' ),
					),
				),
			) );

			$fields = array_merge( $default_fields, $disable_fields );

			$post_types = apply_filters( 'gutenix_pro/page_settings/allowed_post_types', array( 'page', 'post' ) );

			foreach ( $post_types as $post_type ) {

				$fields = $this->prepare_fields( $fields, $post_type );

				new Cherry_X_Post_Meta( array(
					'id'            => 'gutenix-pro-' . $post_type . '-settings',
					'title'         => esc_html__( 'Gutenix Page Settings', 'gutenix-pro' ),
					'page'          => $post_type,
					'context'       => 'normal',
					'priority'      => 'high',
					'callback_args' => false,
					'builder_cb'    => array( $this, 'get_builder' ),
					'fields'        => $fields,
				) );
			};
		}

		/**
		 * Prepare fields.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array  $fields    Fields list.
		 * @param  string $post_type Post type.
		 * @return array
		 */
		public function prepare_fields( $fields, $post_type ) {

			foreach ( $fields as $meta_key => $field ) {

				if ( isset( $field['page'] ) ) {

					if ( ( is_array( $field['page'] ) && ! in_array( $post_type, $field['page'] ) ) || $field['page'] !== $post_type ) {
						unset( $fields[ $meta_key ] );
					}

					unset( $field['page'] );
				}
			}

			return $fields;
		}

		/**
		 * Get interface builder instance
		 *
		 * @since  1.0.0
		 * @access public
		 * @return CX_Interface_Builder
		 */
		public function get_builder() {

			$builder_data = gutenix_pro()->framework->get_included_module_data( 'cherry-x-interface-builder.php' );

			return new CX_Interface_Builder(
				array(
					'path' => $builder_data['path'],
					'url'  => $builder_data['url'],
				)
			);
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return Gutenix_Pro_Post_Meta
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}

}

if ( ! function_exists( 'gutenix_pro_post_meta' ) ) {

	/**
	 * Returns instance of Gutenix_Pro_Post_Meta
	 *
	 * @since  1.0.0
	 * @return Gutenix_Pro_Post_Meta
	 */
	function gutenix_pro_post_meta() {
		return Gutenix_Pro_Post_Meta::get_instance();
	}
}
