<?php
/**
 * Gutenix_Pro_Header_Sticky class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Header_Sticky' ) ) {

	/**
	 * Define Gutenix_Pro_Header_Sticky class
	 */
	class Gutenix_Pro_Header_Sticky extends Gutenix_Pro_Module_Base {

		/**
		 * Added additional header options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				/** `Sticky Header` section */
				'sticky_header' => array(
					'title' => esc_html__( 'Sticky Header', 'gutenix-pro' ),
					'type'  => 'section',
					'panel' => 'header_options',
				),
				'sticky_header_enable' => array(
					'title'   => esc_html__( 'Enable Sticky Header', 'gutenix-pro' ),
					'section' => 'sticky_header',
					'default' => false,
					'field'   => 'gutenix-toggle-checkbox',
					'type'    => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'sticky_header_effect' => array(
					'title'    => esc_html__( 'Sticky Effect', 'gutenix-pro' ),
					'section'  => 'sticky_header',
					'default'  => 'sticky',
					'field'    => 'select',
					'type'     => 'control',
					'choices'  => array(
						'sticky' 	=> esc_html__( 'Always Sticky', 'gutenix-pro' ),
						'headroom' 	=> esc_html__( 'Scrolling Up', 'gutenix-pro' ),
					),
					'conditions'  => array(
						'sticky_header_enable' => true,
					),
				),
				'sticky_header_effects_offset' => array(
					'title'       => esc_html__( 'Effects Offset', 'gutenix-pro' ),
					'section'     => 'sticky_header',
					'default'     => '100',
					'field'       => 'number',
					'input_attrs' => array(
						'min'  => 50,
						'max'  => 1000,
						'step' => 10,
					),
					'type'        => 'control',
					'conditions'  => array(
						'sticky_header_enable' => true,
					),
				),
				'sticky_header_enable_on_tablet' => array(
					'title'      => esc_html__( 'Enable on Tablet', 'gutenix-pro' ),
					'section'    => 'sticky_header',
					'default'    => false,
					'field'      => 'checkbox',
					'type'       => 'control',
					'conditions' => array(
						'sticky_header_enable' => true,
					),
				),
				'sticky_header_enable_on_mobile' => array(
					'title'      => esc_html__( 'Enable on Mobile', 'gutenix-pro' ),
					'section'    => 'sticky_header',
					'default'    => false,
					'field'      => 'checkbox',
					'type'       => 'control',
					'conditions' => array(
						'sticky_header_enable' => true,
					),
				),
				'sticky_header_heading' => array(
					'title' 	=> esc_html__( 'Sticky Logo', 'gutenix-pro' ),
					'section' 	=> 'sticky_header',
					'default' 	=> '',
					'field' 	=> 'gutenix-heading',
					'type' 		=> 'control',
					'conditions'  => array(
						'sticky_header_enable' => true,
					),
				),
				'sticky_header_logo' => array(
					'title'        => esc_html__( 'Upload Logo Image', 'gutenix-pro' ),
					'section'      => 'sticky_header',
					'field'        => 'cropped_image',
					'cropped_args' => Gutenix_Utils::get_custom_logo_args(),
					'labels'       => Gutenix_Utils::get_custom_logo_labels(),
					'type'         => 'control',
					'conditions'   => array(
						'sticky_header_enable' => true,
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
			add_filter( 'gutenix_header_bar_class', 				array( $this, 'header_bar_classes' ) );
			add_action( 'wp_enqueue_scripts', 						array( $this, 'register_assets' ), 9 );
			add_filter( 'gutenix_theme_script_depends', 			array( $this, 'modify_theme_script_depends' ) );
			add_filter( 'gutenix_theme_script_variables', 			array( $this, 'modify_theme_script_variables' ) );
			add_filter( 'gutenix_sticky_header_logo_format', 		array( $this, 'modify_sticky_header_logo_format' ) );
			add_filter( 'gutenix_pro/page_settings/default_fields', array( $this, 'post_meta_fields' ) );
		}

		/**
		 * Add additional classes to header bar.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $classes Header Bar classes.
		 * @return array
		 */
		public function header_bar_classes( $classes = array() ) {

			if ( $this->is_sticky_enabled() ) {
				$classes[] = 'header-bar--sticky';

				$effect = gutenix_theme()->customizer->get_value( 'sticky_header_effect' );
				
				$classes[] = 'header-bar--' . $effect;
			}

			return $classes;
		}

		/**
		 * Check sticky header is enabled.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return null|bool
		 */
		public function is_sticky_enabled() {
			$enable = gutenix_theme()->customizer->get_value( 'sticky_header_enable' );

			$rewritten_mods = gutenix_pro_hooks()->rewritten_mods;
			$is_rewrite     = in_array( 'sticky_header_enable', $rewritten_mods );

			if ( $enable && ! $is_rewrite ) {
				$enable = true;
			}

			return apply_filters( 'gutenix_pro/sticky_header/is_enabled', $enable );
		}

		/**
		 * Register assets.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function register_assets() {
			if ( 'headroom' != gutenix_theme()->customizer->get_value( 'sticky_header_effect' ) ) {
				wp_register_script( 'jquery-stickup', gutenix_pro()->plugin_url( 'assets/lib/jquery-stickup/jquery.stickup.min.js' ), array( 'jquery' ), '1.0.0', true );
			} else {
				wp_register_script( 'jquery-stickup', gutenix_pro()->plugin_url( 'assets/lib/jquery-headroom/headroom.min.js' ), array( 'jquery' ), '1.0.0', true );
			}
		}

		/**
		 * Add sticky js to theme script depends.
		 *
		 * @since  1.0.0
		 * @param  array $depends Default dependencies.
		 * @return array
		 */
		function modify_theme_script_depends( $depends = array() ) {

			if ( $this->is_sticky_enabled() ) {
				$depends[] = 'jquery-stickup';
			}

			return $depends;
		}

		/**
		 * Add stickUp var to theme script variables if required.
		 *
		 * @since  1.0.0
		 * @param  array $variables Theme js variables.
		 * @return array
		 */
		function modify_theme_script_variables( $variables = array() ) {

			if ( $this->is_sticky_enabled() ) {

				$sticky_on = array( 'desktop' );

				if ( gutenix_theme()->customizer->get_value( 'sticky_header_enable_on_tablet' ) ) {
					$sticky_on[] = 'tablet';
				}

				if ( gutenix_theme()->customizer->get_value( 'sticky_header_enable_on_mobile' ) ) {
					$sticky_on[] = 'mobile';
				}

				$variables['stickUp']       = true;
				$variables['stickUpOn']     = $sticky_on;
				$variables['stickUpOffset'] = get_theme_mod( 'sticky_header_effects_offset' );
			}

			return $variables;
		}

		/**
		 * Modify header logo format in the sticky header.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $format Logo format.
		 * @return string
		 */
		public function modify_sticky_header_logo_format( $format ) {
			$sticky_header_enable 	= gutenix_theme()->customizer->get_value( 'sticky_header_enable' );
			$sticky_logo_id 		= gutenix_theme()->customizer->get_value( 'sticky_header_logo' );

			if ( ! $sticky_header_enable || ! $sticky_logo_id ) {
				return $format;
			}

			$attr = array(
				'class' => 'sticky-logo',
				'alt'   => esc_attr( get_bloginfo( 'name', 'display' ) ),
			);

			$sticky_logo = sprintf(
				'<a class="sticky-logo-link" href="%1$s" rel="home">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( $sticky_logo_id, 'full', false, $attr )
			);

			$format = $sticky_logo;

			return $format;
		}

		/**
		 * Added header sticky post meta fields.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $fields Post Meta Fields.
		 * @return array
		 */
		public function post_meta_fields( $fields = array() ) {

			$fields['gutenix_pro_sticky_header_enable'] = array(
				'title'       => esc_html__( 'Sticky Header', 'gutenix-pro' ),
				'description' => esc_html__( 'Sticky header global settings redefining.', 'gutenix-pro' ),
				'type'        => 'select',
				'value'       => 'inherit',
				'options'     => array(
					'inherit' => esc_html__( 'Inherit', 'gutenix-pro' ),
					'true'    => esc_html__( 'Enable', 'gutenix-pro' ),
					'false'   => esc_html__( 'Disable', 'gutenix-pro' ),
				),
			);

			return $fields;
		}
	}

}
