<?php
/**
 * Gutenix_Pro_CPT class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( class_exists( 'Gutenix_Pro_CPT' ) ) {

	// create a Header Tempates custom post type
	$header_template = new Gutenix_Pro_CPT('custom_template');
	
	// define the columns to appear on the admin edit screen
	$header_template->columns( array(
	    'title' => esc_html__( 'Title' ),
	    'date' => esc_html__( 'Date')
	));
	
	// use "pages" icon for post type
	$header_template->menu_icon( 'dashicons-welcome-widgets-menus' );
}
