<?php
/**
 * Gutenix_Pro_Footer class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Footer' ) ) {

	/**
	 * Define Gutenix_Pro_Footer class
	 */
	class Gutenix_Pro_Footer extends Gutenix_Pro_Module_Base {

		/**
		 * Added blog posts options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				'footer_widget_areas_count' => array(
					'title' 			=> esc_html__( 'Footer Widget Areas Count', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> '4',
					'field' 			=> 'number',
					'input_attrs' 		=> array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
					'type' 				=> 'control',
					'conditions' 		=> array(
						'footer_widgets_visible' => true,
					),
				),
				'footer_widgets_columns' => array(
					'title' 			=> esc_html__( 'Columns in Row', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> '4',
					'field' 			=> 'select',
					'choices' 			=> array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'type' 				=> 'control',
					'conditions' 		=> array(
						'footer_widgets_visible' => true,
						'footer_widgets_dynamic_width' => false,
					),
				),
				'footer_widgets_dynamic_width' => array(
					'title' 			=> esc_html__( 'Dynamic Width for Columns', 'gutenix-pro' ),
					'description' 		=> esc_html__( 'Sum of all columns should be 100%', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'priority' 			=> 20,
					'default' 			=> false,
					'field' 			=> 'gutenix-toggle-checkbox',
					'type' 				=> 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
					'conditions' 		=> array(
						'footer_widgets_visible' => true,
					),
				),
				'footer_widgetarea_width_col1' => array(
					'title' 			=> esc_html__( '1 Column Width, %', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> 25,
					'field' 			=> 'gutenix-range',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'conditions' 		=> array(
						'footer_widget_areas_count' 	=> array( '1','2','3','4','5','6' ),
						'footer_widgets_visible' 		=> true,
						'footer_widgets_dynamic_width' 	=> true,
					),
					'active_callback' 	=> 'gutenix_cac_footer_column1',
				),
				'footer_widgetarea_width_col2' => array(
					'title' 			=> esc_html__( '2 Column Width, %', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> 25,
					'field' 			=> 'gutenix-range',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'conditions' 		=> array(
						'footer_widget_areas_count' 	=> array( '2','3','4','5','6' ),
						'footer_widgets_visible' 		=> true,
						'footer_widgets_dynamic_width' 	=> true,
					),
					'active_callback' 	=> 'gutenix_cac_footer_column2',
				),
				'footer_widgetarea_width_col3' => array(
					'title' 			=> esc_html__( '3 Column Width, %', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> 25,
					'field' 			=> 'gutenix-range',
					'type' 				=> 'control',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'conditions' 		=> array(
						'footer_widget_areas_count' 	=> array( '3','4','5','6' ),
						'footer_widgets_visible' 		=> true,
						'footer_widgets_dynamic_width' 	=> true,
					),
					'active_callback' 	=> 'gutenix_cac_footer_column3',
				),
				'footer_widgetarea_width_col4' => array(
					'title' 			=> esc_html__( '4 Column Width, %', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> 25,
					'field'       => 'gutenix-range',
					'type'        => 'control',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'conditions' 		=> array(
						'footer_widget_areas_count' 	=> array( '4','5','6' ),
						'footer_widgets_visible' 		=> true,
						'footer_widgets_dynamic_width' 	=> true,
					),
					'active_callback' 	=> 'gutenix_cac_footer_column4',
				),
				'footer_widgetarea_width_col5' => array(
					'title' 			=> esc_html__( '5 Column Width, %', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> 10,
					'field' 			=> 'gutenix-range',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'conditions' 		=> array(
						'footer_widget_areas_count' 	=> array( '5','6' ),
						'footer_widgets_visible' 		=> true,
						'footer_widgets_dynamic_width' 	=> true,
					),
					'active_callback' 	=> 'gutenix_cac_footer_column5',
				),
				'footer_widgetarea_width_col6' => array(
					'title' 			=> esc_html__( '6 Column Width, %', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'default' 			=> 10,
					'field' 			=> 'gutenix-range',
					'type' 				=> 'control',
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'conditions' 		=> array(
						'footer_widget_areas_count' 	=> array( '6' ),
						'footer_widgets_visible' 		=> true,
						'footer_widgets_dynamic_width' 	=> true,
					),
					'active_callback' 	=> 'gutenix_cac_footer_column6',
				),
				'footer_widgetarea_column_padding' => array(
					'title' 			=> esc_html__( 'Inside Padding for Column, px', 'gutenix-pro' ),
					'section' 			=> 'footer_widgets',
					'priority' 			=> 20,
					'field' 			=> 'gutenix-dimensions',
					'type' 				=> 'control',
					'linked_choices' 	=> true,
					'unit_choices' 		=> '',
					'choices' 			=> array(
						'top' 		=> esc_html__( 'Top', 'gutenix-pro' ),
						'right' 	=> esc_html__( 'Right', 'gutenix-pro' ),
						'bottom' 	=> esc_html__( 'Bottom', 'gutenix-pro' ),
						'left' 		=> esc_html__( 'Left', 'gutenix-pro' ),
					),
					'default' 			=> array(
						'desktop' => array( 'top' => '0', 'right' => '15', 'bottom' => '60', 'left' => '15' ),
						'tablet'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'mobile'  => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					),
					'input_attrs' 		=> array(
						'min'  => 0,
						'max'  => 600,
						'step' => 1,
					),
					'conditions' 		=> array(
						'footer_widgets_visible' => true,
					),
					'sanitize_callback' => 'gutenix_sanitize_dimensions',
					'dynamic_css' 		=> true,
				),

				/** `Footer Bar` section */
				'footer_custom_template' => array(
					'title' 			=> esc_html__( 'Custom Template', 'gutenix-pro' ),
					'section' 			=> 'footer_bar',
					'priority' 			=> 10,
					'default' 			=> 'style-1',
					'choices' 			=> Gutenix_Utils::get_custom_template( 'header_template' ),
					'field' 			=> 'select',
					'type' 				=> 'control',
					'conditions' 		=> array(
						'footer_layout_type' => array( 'custom' ),
					),
				),
			);
		}
	}
}
