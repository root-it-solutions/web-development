<?php
/**
 * Gutenix_Pro_Breadcrumbs class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Breadcrumbs' ) ) {

	/**
	 * Define Gutenix_Pro_Breadcrumbs class
	 */
	class Gutenix_Pro_Breadcrumbs extends Gutenix_Pro_Module_Base {

		/**
		 * Added breadcrumbs options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				/** `Breadcrumbs` section */
				'breadcrumbs' => array(
					'title'    => esc_html__( 'Breadcrumbs', 'gutenix-pro' ),
					'priority' => 15,
					'type'     => 'section',
					'panel'    => 'general_settings',
				),
				'breadcrumbs_visible' => array(
					'title'   => esc_html__( 'Show Breadcrumbs', 'gutenix-pro' ),
					'section' => 'breadcrumbs',
					'default' => false,
					'field'   => 'gutenix-toggle-checkbox',
					'type'    => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
				'breadcrumbs_front_visible' => array(
					'title'      => esc_html__( 'Show Breadcrumbs on Front Page', 'gutenix-pro' ),
					'section'    => 'breadcrumbs',
					'default'    => false,
					'field'      => 'gutenix-toggle-checkbox',
					'type'       => 'control',
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_page_title' => array(
					'title' 			=> esc_html__( 'Show Page Title in Breadcrumbs Area', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> false,
					'field' 			=> 'gutenix-toggle-checkbox',
					'type' 				=> 'control',
					'conditions' 		=> array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_path_type' => array(
					'title' 			=> esc_html__( 'Show Full / Minified Path', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> 'minified',
					'field' 			=> 'select',
					'choices' 			=> array(
						'full'     => esc_html__( 'Full', 'gutenix-pro' ),
						'minified' => esc_html__( 'Minified', 'gutenix-pro' ),
					),
					'type' 				=> 'control',
					'conditions' 		=> array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_container_type' => array(
					'title' 			=> esc_html__( 'Container Type', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> 'boxed',
					'field' 			=> 'select',
					'choices' 			=> array(
						'boxed' => esc_html__( 'Boxed', 'gutenix-pro' ),
						'fluid' => esc_html__( 'Full Width', 'gutenix-pro' ),
					),
					'type' 				=> 'control',
					'conditions' 		=> array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_bg_color' => array(
					'title' 			=> esc_html__( 'Background Color', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_padding' => array(
					'title' 			=> esc_html__( 'Vertical Padding, px', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top' 		=> esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' 	=> esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' 	=> array( 'top' => '20', 'bottom' => '10' ),
						'tablet' 	=> array( 'top' => '', 'bottom' => '' ),
						'mobile' 	=> array( 'top' => '', 'bottom' => ''	),
					),
					'input_attrs' 		=> array(
						'min' 		=> 0,
						'max' 		=> 500,
						'step' 		=> 1,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_align' => array(
					'title' 			=> esc_html__( 'Text Align', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '',
					'field' 			=> 'gutenix-buttonset',
					'type' 				=> 'control',
					'choices' 			=> array(
						'left' 		=> esc_html__( 'Left', 'gutenix-pro' ),
						'center' 	=> esc_html__( 'Center', 'gutenix-pro' ),
						'right' 	=> esc_html__( 'Right', 'gutenix-pro' ),
					),
					'default' 			=> 'left',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'breadcrumbs_visible' => true,
					),
				),

				/* Breadcrumbs Separator */
				'breadcrumbs_sep' => array(
					'title' 			=> esc_html__( 'Breadcrumb Separator', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'field' 			=> 'text',
					'type' 				=> 'control',
					'default' 			=> '&bull;',
					'dynamic_css' 		=> true,
					'conditions' 		=> array(
						'breadcrumbs_visible' => true,
					),
				),

				/* Breadcrumbs Title Settings */
				'breadcrumbs_title_settings_heading' => array(
					'title' 			=> esc_html__( 'Breadcrumbs Title Settings', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),
				'breadcrumbs_title_transform' => array(
					'title' 			=> esc_html__( 'Transform', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),
				'breadcrumbs_title_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),
				'breadcrumbs_title_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Important: Not all fonts support every font-weight.', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '700',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),
				'breadcrumbs_title_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> array(
						'desktop' 	=> '24',
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
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),
				'breadcrumbs_title_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),
				'breadcrumbs_title_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '#414756',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),
				'breadcrumbs_title_padding' => array(
					'title' 			=> esc_html__( 'Vertical Padding, px', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top' 		=> esc_html__( 'Top', 'gutenix-pro' ),
						'bottom' 	=> esc_html__( 'Bottom', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' 	=> array( 'top' => '', 'bottom' => '5' ),
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
					'conditions' => array(
						'breadcrumbs_visible' => true,
						'breadcrumbs_page_title' => true,
					),
				),

				/* Breadcrumbs Text Settings */
				'breadcrumbs_text_settings_heading' => array(
					'title' 			=> esc_html__( 'Breadcrumbs Text Settings', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'field' 			=> 'gutenix-heading',
					'type' 				=> 'control',
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_transform' => array(
					'title' 			=> esc_html__( 'Transform', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> 'none',
					'field' 			=> 'select',
					'type' 				=> 'control',
					'choices' 			=> Gutenix_Utils::get_text_transform(),
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_font_style' => array(
					'title' 			=> esc_html__( 'Font Style', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> 'normal',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_styles(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_font_weight' => array(
					'title' 			=> esc_html__( 'Font Weight', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Important: Not all fonts support every font-weight.', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '400',
					'field' 			=> 'select',
					'choices' 			=> Gutenix_Utils::get_font_weight(),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_font_size' => array(
					'title' 			=> esc_html__( 'Font Size, px', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
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
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_letter_spacing' => array(
					'title' 			=> esc_html__( 'Letter Spacing, px', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '0',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min' 	=> - 10,
						'max' 	=> 10,
						'step' 	=> 0.1,
					),
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_color' => array(
					'title' 			=> esc_html__( 'Color', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '#A0A3AA',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
				'breadcrumbs_text_color_hover' => array(
					'title' 			=> esc_html__( 'Color on Hover', 'gutenix-pro' ),
					'section' 			=> 'breadcrumbs',
					'default' 			=> '#3260B1',
					'field' 			=> 'hex_color',
					'type' 				=> 'control',
					'dynamic_css' 		=> true,
					'conditions' => array(
						'breadcrumbs_visible' => true,
					),
				),
			);
		}

		/**
		 * Added breadcrumbs selective refresh partial.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function selective_refresh_partials() {
			return array(
				'breadcrumbs' => array(
					'selector' => '.breadcrumbs',
					'settings' => array(
						'breadcrumbs_visible',
						'breadcrumbs_container_type',
						'breadcrumbs_front_visible',
						'breadcrumbs_page_title',
						'breadcrumbs_path_type',
						'breadcrumbs_sep',
						'breadcrumbs_title_transform',
						'breadcrumbs_title_font_style',
						'breadcrumbs_title_font_weight',
						'breadcrumbs_title_letter_spacing',
						'breadcrumbs_title_color',
						'breadcrumbs_text_transform',
						'breadcrumbs_text_font_style',
						'breadcrumbs_text_font_weight',
						'breadcrumbs_text_letter_spacing',
						'breadcrumbs_text_color',
					),
					'render_callback'     => array( $this, 'render_breadcrumbs' ),
					'container_inclusive' => true,
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
			add_action( 'gutenix_breadcrumbs', 						array( $this, 'render_breadcrumbs' ) );
			add_filter( 'gutenix_get_dynamic_css_options', 			array( $this, 'dynamic_css_file' ) );
			add_filter( 'gutenix_pro/page_settings/disable_fields', array( $this, 'post_meta_fields' ) );
		}

		/**
		 * Render breadcrumbs html markup.
		 * 
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function render_breadcrumbs() {

			$visible = gutenix_theme()->customizer->get_value( 'breadcrumbs_visible' );

			if ( ! $visible ) {

				// Need for render breadcrumbs partial in the customizer.
				if ( is_customize_preview() ) {
					echo '<div class="breadcrumbs" hidden="hidden"></div>';
				}

				return;
			}

			$text_align 		= gutenix_theme()->customizer->get_value( 'breadcrumbs_text_align' );
			$breadcrumbs_sep 	= gutenix_theme()->customizer->get_value( 'breadcrumbs_sep' );
			$container_type 	= gutenix_theme()->customizer->get_value( 'breadcrumbs_container_type' );
			$container_class 	= gutenix_get_container_class( $container_type );

			$args = apply_filters( 'gutenix_pro/breadcrumbs/args', array(
				'wrapper_format'    => '<div class="' . esc_attr( $container_class ) . ' content-align-' . esc_attr( $text_align ) . '">%1$s%2$s</div>',
				'page_title_format' => '<h4 class="breadcrumbs__title">%s</h4>',
				'separator'         => esc_html( $breadcrumbs_sep ),
				'show_on_front'     => gutenix_theme()->customizer->get_value( 'breadcrumbs_front_visible' ),
				'show_title'        => gutenix_theme()->customizer->get_value( 'breadcrumbs_page_title' ),
				'show_browse'       => false,
				'path_type'         => gutenix_theme()->customizer->get_value( 'breadcrumbs_path_type' ),
				'action'            => 'gutenix_breadcrumbs/render',
				'strings' => array(
					'error_404'      => esc_html__( '404 Not Found', 'gutenix-pro' ),
					'archives'       => esc_html__( 'Archives', 'gutenix-pro' ),
					'search'         => esc_html__( 'Search results for &#8220;%s&#8221;', 'gutenix-pro' ),
					'paged'          => esc_html__( 'Page %s', 'gutenix-pro' ),
					'archive_minute' => esc_html__( 'Minute %s', 'gutenix-pro' ),
					'archive_week'   => esc_html__( 'Week %s', 'gutenix-pro' ),
				),
				'date_labels' => array(
					'archive_minute_hour' => esc_html_x( 'g:i a', 'minute and hour archives time format', 'gutenix-pro' ),
					'archive_minute'      => esc_html_x( 'i', 'minute archives time format', 'gutenix-pro' ),
					'archive_hour'        => esc_html_x( 'g a', 'hour archives time format', 'gutenix-pro' ),
					'archive_year'        => esc_html_x( 'Y', 'yearly archives date format', 'gutenix-pro' ),
					'archive_month'       => esc_html_x( 'F', 'monthly archives date format', 'gutenix-pro' ),
					'archive_day'         => esc_html_x( 'j', 'daily archives date format', 'gutenix-pro' ),
					'archive_week'        => esc_html_x( 'W', 'weekly archives date format', 'gutenix-pro' ),
				),
				'css_namespace' => array(
					'module'    => 'breadcrumbs',
					'content'   => 'breadcrumbs__content',
					'wrap'      => 'breadcrumbs__wrap',
					'browse'    => 'breadcrumbs__browse',
					'item'      => 'breadcrumbs__item',
					'separator' => 'breadcrumbs__item-sep',
					'link'      => 'breadcrumbs__item-link',
					'target'    => 'breadcrumbs__item-target',
				),
			) );

			$breadcrumbs = new CX_Breadcrumbs( $args );

			// Print breadcrumbs area.
			$breadcrumbs->get_trail();
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

			$options['css_files'][] = gutenix_pro()->plugin_path( 'assets/css/dynamic/breadcrumbs.css' );

			return $options;
		}

		/**
		 * Added breadcrumbs post meta fields.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $fields Post Meta Fields.
		 * @return array
		 */
		public function post_meta_fields( $fields = array() ) {

			$fields['gutenix_pro_disable_breadcrumbs_visible'] = array(
				'title'  => esc_html__( 'Disable Breadcrumbs', 'gutenix-pro' ),
				'type'   => 'switcher',
				'value'  => false,
				'toggle' => array(
					'true_toggle'  => esc_html__( 'Yes', 'gutenix-pro' ),
					'false_toggle' => esc_html__( 'No', 'gutenix-pro' ),
				),
			);

			return $fields;
		}

	}

}
