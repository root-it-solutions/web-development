<?php
/**
 * Gutenix_Pro_Header_Transparent class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Header_Transparent' ) ) {

	/**
	 * Define Gutenix_Pro_Header_Transparent class
	 */
	class Gutenix_Pro_Header_Transparent extends Gutenix_Pro_Module_Base {

		/**
		 * Added additional header options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {

			$ext_options = array(
				/** `Transparent Header` section */
				'transparent_header' => array(
					'title' => esc_html__( 'Transparent Header', 'gutenix-pro' ),
					'type'  => 'section',
					'panel' => 'header_options',
				),
				'transparent_header_enable' => array(
					'title'    => esc_html__( 'Enable Transparent Header', 'gutenix-pro' ),
					'section'  => 'transparent_header',
					'default'  => false,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'priority' => 5,
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'transparent_header_disable_on_blog' => array(
					'title'      => esc_html__( 'Disable on Posts Page?', 'gutenix-pro' ),
					'section'    => 'transparent_header',
					'default'    => true,
					'field'      => 'checkbox',
					'type'       => 'control',
					'priority'   => 10,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_disable_on_archive' => array(
					'title'      => esc_html__( 'Disable on Archives & Search?', 'gutenix-pro' ),
					'section'    => 'transparent_header',
					'default'    => true,
					'field'      => 'checkbox',
					'type'       => 'control',
					'priority'   => 15,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_disable_on_404' => array(
					'title'      => esc_html__( 'Disable on 404 Page?', 'gutenix-pro' ),
					'section'    => 'transparent_header',
					'default'    => true,
					'field'      => 'checkbox',
					'type'       => 'control',
					'priority'   => 20,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_disable_on_pages' => array(
					'title'      => esc_html__( 'Disable on Pages?', 'gutenix-pro' ),
					'section'    => 'transparent_header',
					'default'    => false,
					'field'      => 'checkbox',
					'type'       => 'control',
					'priority'   => 25,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_disable_on_posts' => array(
					'title'      => esc_html__( 'Disable on Posts?', 'gutenix-pro' ),
					'section'    => 'transparent_header',
					'default'    => true,
					'field'      => 'checkbox',
					'type'       => 'control',
					'priority'   => 30,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_enable_on_tablet' => array(
					'title'    => esc_html__( 'Enable on Tablet', 'gutenix-pro' ),
					'section'  => 'transparent_header',
					'default'  => false,
					'field'    => 'checkbox',
					'type'     => 'control',
					'priority' => 40,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_enable_on_mobile' => array(
					'title'    => esc_html__( 'Enable on Mobile', 'gutenix-pro' ),
					'section'  => 'transparent_header',
					'default'  => false,
					'field'    => 'checkbox',
					'type'     => 'control',
					'priority' => 45,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'different_logo_transparent_header' => array(
					'title'    => esc_html__( 'Different Logo?', 'gutenix-pro' ),
					'section'  => 'transparent_header',
					'default'  => false,
					'field'    => 'checkbox',
					'type'     => 'control',
					'priority' => 50,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_logo' => array(
					'title'        => esc_html__( 'Transparent Logo', 'gutenix-pro' ),
					'section'      => 'transparent_header',
					'field'        => 'cropped_image',
					'cropped_args' => Gutenix_Utils::get_custom_logo_args(),
					'labels'       => Gutenix_Utils::get_custom_logo_labels(),
					'type'         => 'control',
					'priority'     => 55,
					'conditions'   => array(
						'different_logo_transparent_header' => true,
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_bg' => array(
					'title'       => esc_html__( 'Background', 'gutenix-pro' ),
					'section'     => 'transparent_header',
					'default'     => gutenix_pro()->get_default_dynamic_css_values( 'transparent_header_bg' ),
					'field'       => 'hex_color',
					'type'        => 'control',
					'priority'    => 60,
					'dynamic_css' => true,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_bg_alpha' => array(
					'title'       => esc_html__( 'Background Alpha', 'gutenix-pro' ),
					'section'     => 'transparent_header',
					'default'     => gutenix_pro()->get_default_dynamic_css_values( 'transparent_header_bg_alpha' ),
					'field'       => 'gutenix-range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'type'        => 'control',
					'priority'    => 65,
					'conditions' 	=> array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_site_title_color' => array(
					'title'       => esc_html__( 'Site Title Color', 'gutenix-pro' ),
					'section'     => 'transparent_header',
					'priority'    => 70,
					'default'     => gutenix_pro()->get_default_dynamic_css_values( 'transparent_header_site_title_color' ),
					'field'       => 'hex_color',
					'type'        => 'control',
					'dynamic_css' => true,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_header_link_color' => array(
					'title'       => esc_html__( 'Link Color', 'gutenix-pro' ),
					'section'     => 'transparent_header',
					'default'     => gutenix_pro()->get_default_dynamic_css_values( 'transparent_header_header_link_color' ),
					'field'       => 'hex_color',
					'type'        => 'control',
					'dynamic_css' => true,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
				'transparent_header_header_link_hover_color' => array(
					'title'       => esc_html__( 'Link Hover Color', 'gutenix-pro' ),
					'section'     => 'transparent_header',
					'default'     => gutenix_pro()->get_default_dynamic_css_values( 'transparent_header_header_link_hover_color' ),
					'field'       => 'hex_color',
					'type'        => 'control',
					'dynamic_css' => true,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				),
			);

			if ( function_exists( 'wc' ) ) {
				$ext_options['transparent_header_disable_on_woo_products'] = array(
					'title'      => esc_html__( 'Disable on WooCommerce Product Pages?', 'gutenix-pro' ),
					'section'    => 'transparent_header',
					'default'    => true,
					'field'      => 'checkbox',
					'type'       => 'control',
					'priority'   => 32,
					'conditions' => array(
						'transparent_header_enable' => true,
					),
				);
			}

			return $ext_options;
		}

		/**
		 * Modify header bar selective refresh partial.
		 *
		 * @since  1.0.0
		 * @access public

		 * @return array
		 */
		public function selective_refresh_partials() {

			$partials = array(
				'header_bar' => array(
					'settings' => array(
						'transparent_header_enable',
						'transparent_header_disable_on_blog',
						'transparent_header_disable_on_archive',
						'transparent_header_disable_on_404',
						'transparent_header_disable_on_pages',
						'transparent_header_disable_on_posts',
						'transparent_header_enable_on_tablet',
						'transparent_header_enable_on_mobile',
					),
				),
			);

			if ( function_exists( 'wc' ) ) {
				$partials['header_bar']['settings'][] = 'transparent_header_disable_on_woo_products';
			}

			return $partials;
		}

		/**
		 * Add or remove module-related hooks
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function hooks() {
			add_filter( 'gutenix_header_bar_class',        array( $this, 'header_bar_classes' ) );
			add_filter( 'gutenix_get_dynamic_css_options', array( $this, 'dynamic_css_file' ) );
			add_filter( 'gutenix_header_logo_format',      array( $this, 'modify_header_logo_format' ) );

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

			if ( $this->is_transparent_header_enabled() ) {
				$classes[] = 'header-bar--transparent';

				$enable_on_tablet = gutenix_theme()->customizer->get_value( 'transparent_header_enable_on_tablet' );
				$enable_on_mobile = gutenix_theme()->customizer->get_value( 'transparent_header_enable_on_mobile' );

				if ( $enable_on_tablet ) {
					$classes[] = 'header-bar--transparent-tablet';
				}

				if ( $enable_on_mobile ) {
					$classes[] = 'header-bar--transparent-mobile';
				}
			}

			return $classes;
		}

		/**
		 * Check transparent header is enabled.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return bool
		 */
		public function is_transparent_header_enabled() {
			$enable = gutenix_theme()->customizer->get_value( 'transparent_header_enable' );

			$rewritten_mods = gutenix_pro_hooks()->rewritten_mods;
			$is_rewrite     = in_array( 'transparent_header_enable', $rewritten_mods );

			if ( $enable && ! $is_rewrite ) {
				if ( is_home() && gutenix_theme()->customizer->get_value( 'transparent_header_disable_on_blog' ) ) {
					$enable = false;
				}

				if ( ( is_archive() || is_search() ) && gutenix_theme()->customizer->get_value( 'transparent_header_disable_on_archive' ) ) {
					$enable = false;
				}

				if ( is_404() && gutenix_theme()->customizer->get_value( 'transparent_header_disable_on_404' ) ) {
					$enable = false;
				}

				if ( is_page() && gutenix_theme()->customizer->get_value( 'transparent_header_disable_on_pages' ) ) {
					$enable = false;
				}

				if ( ( is_single() && ! is_singular( 'product' ) ) && gutenix_theme()->customizer->get_value( 'transparent_header_disable_on_posts' ) ) {
					$enable = false;
				}

				if ( function_exists( 'wc' ) && ( is_woocommerce() || is_product() || is_shop() || is_cart() || is_checkout() || is_account_page() || is_product_category() || is_product_tag() ) && gutenix_theme()->customizer->get_value( 'transparent_header_disable_on_woo_products' ) ) {
					$enable = false;
				}
			}

			return apply_filters( 'gutenix_pro/transparent_header/is_enabled', $enable );
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

			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/transparent-header.css' );

			return $options;
		}

		/**
		 * Modify header logo format in the transparent header.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $format Logo format.
		 * @return string
		 */
		public function modify_header_logo_format( $format ) {
			$visible_transparent_logo = gutenix_theme()->customizer->get_value( 'different_logo_transparent_header' );
			$transparent_logo_id      = gutenix_theme()->customizer->get_value( 'transparent_header_logo' );

			if ( ! $visible_transparent_logo || ! $transparent_logo_id ) {
				return $format;
			}

			$attr = array(
				'class' => 'transparent-logo',
				'alt'   => esc_attr( get_bloginfo( 'name', 'display' ) ),
			);

			$transparent_logo = sprintf(
				'<a class="transparent-logo-link" href="%1$s" rel="home">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( $transparent_logo_id, 'full', false, $attr )
			);

			$format = $transparent_logo;

			return $format;
		}

		/**
		 * Added header transparent post meta fields.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $fields Post Meta Fields.
		 * @return array
		 */
		public function post_meta_fields( $fields = array() ) {

			$fields['gutenix_pro_transparent_header_enable'] = array(
				'title'       => esc_html__( 'Transparent Header', 'gutenix-pro' ),
				'description' => esc_html__( 'Transparent header global settings redefining.', 'gutenix-pro' ),
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
