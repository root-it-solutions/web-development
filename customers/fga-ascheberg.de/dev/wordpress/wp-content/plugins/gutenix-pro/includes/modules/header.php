<?php
/**
 * Gutenix_Pro_Header class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Header' ) ) {

	/**
	 * Define Gutenix_Pro_Header class
	 */
	class Gutenix_Pro_Header extends Gutenix_Pro_Module_Base {

		/**
		 * Added blog posts options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				
				/** `Top Panel` section */
				'top_panel_enable_on_tablet' => array(
					'title' 			=> esc_html__( 'Enable on Tablet', 'gutenix-pro' ),
					'section' 			=> 'top_panel',
					'priority' 			=> 10,
					'default' 			=> true,
					'field' 			=> 'checkbox',
					'type' 				=> 'control',
					'conditions' 		=> array(
						'top_panel_visible' => true,
					),
				),
				'top_panel_enable_on_mobile' => array(
					'title' 			=> esc_html__( 'Enable on Mobile', 'gutenix-pro' ),
					'section' 			=> 'top_panel',
					'priority' 			=> 10,
					'default' 			=> false,
					'field' 			=> 'checkbox',
					'type' 				=> 'control',
					'conditions' 		=> array(
						'top_panel_visible' => true,
					),
				),

				'top_panel_border_width' => array(
					'title' 			=> esc_html__( 'Border Width, px', 'gutenix' ),
					'section' 			=> 'top_panel',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'top_panel_visible' => true,
					),
				),
				'top_panel_border_color' => array(
					'title' 			=> esc_html__( 'Border Color', 'gutenix' ),
					'section' 			=> 'top_panel',
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'top_panel_visible' => true,
					),
				),

				/** `Header Bar` section */
				'header_custom_template' => array(
					'title' 			=> esc_html__( 'Custom Template', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 10,
					'default' 			=> 'style-1',
					'choices' 			=> Gutenix_Utils::get_custom_template( 'header_template' ),
					'field' 			=> 'select',
					'type' 				=> 'control',
					'conditions' 		=> array(
						'header_layout_type' => array( 'custom' ),
					),
				),
				
				/* Header Shadow */
				'header_shadow_sep' => array(
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
				),
				'header_shadow_visible' => array(
					'title' 			=> esc_html__( 'Show Shadow ', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'default' 			=> true,
					'field' 			=> 'gutenix-toggle-checkbox',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'header_shadow_size' => array(
					'title' 			=> esc_html__( 'Size', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> false,
					'responsive' 		=> false,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'vertical'   => esc_html__( 'Vertical', 'gutenix-pro' ),
						'horizontal' => esc_html__( 'Horizontal', 'gutenix-pro' ),
						'blur' 		=> esc_html__( 'Blur', 'gutenix-pro' ),
						'spread' 	=> esc_html__( 'Spread', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'vertical' => '0', 'horizontal' => '6', 'blur' => '10', 'spread' => '0' )
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'header_shadow_visible' => true,
					),
				),
				'header_shadow_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'default' 			=> 'rgba(65,71,86,0.1)',
					'field' 			=> 'gutenix-alphacolor',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'header_shadow_visible' => true,
					),
				),
				'header_sticky_shadow_visible' => array(
					'title' 			=> esc_html__( 'Show Shadow Sticky Header', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'default' 			=> true,
					'field' 			=> 'checkbox',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'header_shadow_visible' => true,
					),
				),

				/* Header Sign In */
				'header_login_heading' => array(
					'title' 			=> esc_html__( 'Sign In', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
				),
				'header_login_visible' => array(
					'title' 			=> esc_html__( 'Show Login Popup', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'default' 			=> false,
					'field' 			=> 'gutenix-toggle-checkbox',
					'type' 				=> 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'header_login_text1' => array(
					'title' 			=> esc_html__( 'Link Text', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'default' 			=> esc_html__( 'Sign In', 'gutenix-pro' ),
					'field' 			=> 'text',
					'type' 				=> 'control',
					'transport' 		=> 'postMessage',
					'conditions' 		=> array(
						'header_login_visible' 	=> true,
					),
				),
				'header_login_text2' => array(
					'title' 			=> esc_html__( 'Link Text', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 35,
					'default' 			=> esc_html__( 'Sign Out', 'gutenix-pro' ),
					'field' 			=> 'text',
					'type' 				=> 'control',
					'transport' 		=> 'postMessage',
					'conditions' 		=> array(
						'header_login_visible' 	=> true,
					),
				),

				/* Social Links */
				'header_social_links_type' => array(
					'title' 			=> esc_html__( 'Type', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 40,
					'default' 			=> 'list',
					'field' 			=> 'gutenix-buttonset',
					'type' 				=> 'control',
					'choices' 			=> array(
						'list' 		=> esc_html__( 'List', 'gutenix-pro' ),
						'dropdown' 	=> esc_html__( 'Dropdown', 'gutenix-pro' ),
					),
					'conditions' 		=> array(
						'header_social_links_visible' => true,
					),
				),
				'header_social_links_drop_btn_text' => array(
					'title' 			=> esc_html__( 'Link Text', 'gutenix-pro' ),
					'section' 			=> 'header_bar',
					'priority' 			=> 40,
					'default' 			=> esc_html__( 'Follow us', 'gutenix-pro' ),
					'field' 			=> 'text',
					'type' 				=> 'control',
					'transport' 		=> 'postMessage',
					'conditions' 		=> array(
						'header_social_links_visible' 	=> true,
						'header_social_links_type' 		=> 'dropdown',
					),
				),

				/* Sub Menu Settings */
				'sub_menu_link_border_width' => array(
					'title' 			=> esc_html__( 'Sub Menu Link Border Width, px', 'gutenix' ),
					'section' 			=> 'main_menu',
					'default' 			=> '1',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'sub_menu_link_border_color' => array(
					'title' 			=> esc_html__( 'Sub Menu Link Border Color', 'gutenix' ),
					'section' 			=> 'main_menu',
					'default' 			=> '#e8e9eb',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),

				'sub_menu_sep' => array(
					'section' 			=> 'main_menu',
					'field' 			=> 'gutenix-separator',
					'type' 				=> 'control',
				),
				'sub_menu_width' => array(
					'title' 			=> esc_html__( 'Box Width, px', 'gutenix' ),
					'section' 			=> 'main_menu',
					'default' 			=> '200',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
				'sub_menu_margin' => array(
					'title' 			=> esc_html__( 'Indentation Outside, px', 'gutenix' ),
					'section' 			=> 'main_menu',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> false,
					'responsive' 		=> false,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '10' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
				),
				'sub_menu_padding' => array(
					'title' 			=> esc_html__( 'Indentation Inside, px', 'gutenix' ),
					'section' 			=> 'main_menu',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> false,
					'responsive' 		=> false,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top'    => esc_html__( 'Top', 'gutenix' ),
						'right'  => esc_html__( 'Right', 'gutenix' ),
						'bottom' => esc_html__( 'Bottom', 'gutenix' ),
						'left'   => esc_html__( 'Left', 'gutenix' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '0', 'right' => '20', 'bottom' => '0', 'left' => '20' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
				),
				'sub_menu_shadow_size' => array(
					'title' 			=> esc_html__( 'Box Shadow Size', 'gutenix-pro' ),
					'section' 			=> 'main_menu',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> false,
					'responsive' 		=> false,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'vertical'   => esc_html__( 'Vertical', 'gutenix-pro' ),
						'horizontal' => esc_html__( 'Horizontal', 'gutenix-pro' ),
						'blur' 		 => esc_html__( 'Blur', 'gutenix-pro' ),
						'spread' 	 => esc_html__( 'Spread', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'vertical' => '0', 'horizontal' => '4', 'blur' => '10', 'spread' => '0' )
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'header_shadow_visible' => true,
					),
				),
				'sub_menu_shadow_color' => array(
					'title' 			=> esc_html__( 'Box Shadow Color', 'gutenix-pro' ),
					'section' 			=> 'main_menu',
					'default' 			=> 'rgba(65, 71, 86, 0.2)',
					'field' 			=> 'gutenix-alphacolor',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
				),
			);
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
				'top_panel' => array(
					'settings' => array(
						'top_panel_enable_on_tablet',
						'top_panel_enable_on_mobile',
					),
				),
			);

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
			add_filter( 'gutenix_top_panel_class', 			array( $this, 'top_panel_classes' ) );
			add_filter( 'gutenix_header_bar_class', 		array( $this, 'header_bar_classes' ) );
			add_filter( 'gutenix_get_dynamic_css_options', 	array( $this, 'dynamic_css_file' ) );
		}

		/**
		 * Add additional classes to top panel.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $classes Top Panel classes.
		 * @return array
		 */
		public function top_panel_classes( $classes = array() ) {
			
			$visible 		= gutenix_is_top_panel_visible();
			
			if( $visible ) {
				$top_panel_enable_on_tablet = gutenix_theme()->customizer->get_value( 'top_panel_enable_on_tablet' );
				$top_panel_enable_on_mobile = gutenix_theme()->customizer->get_value( 'top_panel_enable_on_mobile' );

				if ( $top_panel_enable_on_tablet ) {
					$classes[] = 'top-panel-tablet';
				}

				if ( $top_panel_enable_on_mobile ) {
					$classes[] = 'top-panel-mobile';
				}
			}

			return $classes;
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

			$header_layout_type 	= gutenix_theme()->customizer->get_value( 'header_layout_type' );
			$header_shadow 			= gutenix_theme()->customizer->get_value( 'header_shadow_visible' );
			$header_sticky 			= gutenix_theme()->customizer->get_value( 'sticky_header_effect' );
			$header_sticky_shadow 	= gutenix_theme()->customizer->get_value( 'header_sticky_shadow_visible' );
			
			if( $header_layout_type != 'disable' && $header_shadow && $header_sticky && $header_sticky_shadow ) {
				$classes[] = 'header-bar-sticky-shadow';
			}

			return $classes;
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

			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/header.css' );

			return $options;
		}
	}
}
