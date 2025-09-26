<?php
/**
 * Gutenix_Pro_Module_Base class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Module_Base' ) ) {

	/**
	 * Define Gutenix_Pro_Module_Base class
	 */
	abstract class Gutenix_Pro_Module_Base {

		/**
		 * Constructor for the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {

			add_filter( 'gutenix_get_customizer_options',         array( $this, 'add_customizer_options' ) );
			add_filter( 'gutenix_get_selective_refresh_partials', array( $this, 'add_selective_refresh_partials' ) );

			$this->hooks();
		}

		/**
		 * Added new options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $options Theme customizer options.
		 * @return array
		 */
		public function add_customizer_options( $options = array() ) {

			$ext_options = $this->customizer_options();

			if ( empty( $ext_options ) ) {
				return $options;
			}

			$options['options'] = array_merge( $options['options'], $ext_options );

			return $options;
		}

		/**
		 * Modify selective refresh partials.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array $partials Theme partials.
		 * @return array
		 */
		public function add_selective_refresh_partials( $partials = array() ) {

			$module_partials = $this->selective_refresh_partials();

			if ( empty( $module_partials ) ) {
				return $partials;
			}

			$partials = array_merge_recursive( $partials, $module_partials );

			return $partials;
		}

		/**
		 * Add or remove module-related customizer options
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array();
		}

		/**
		 * Add or remove module-related selective refresh partials
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function selective_refresh_partials() {
			return array();
		}

		/**
		 * Add or remove module-related hooks
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function hooks() {}
	}

}
