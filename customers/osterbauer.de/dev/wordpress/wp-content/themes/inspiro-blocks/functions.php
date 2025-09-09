<?php
/**
 * This file adds functions to the inspiro-blocks WordPress theme.
 *
 * @package inspiro-blocks
 * @author  WPZOOM
 * @license GNU General Public License v2 or later
 * @link    https://www.wpzoom.com/
 */

/**
 * Define Constants
 */
define( 'INSPIRO_THEME_DIR', trailingslashit( get_template_directory() ) );

/**
 * Enqueues scripts and styles
 */
require INSPIRO_THEME_DIR . 'inc/classes/class-inspiro-enqueue-scripts.php';


/**
 * Theme admin notices and info page
 */
if ( is_admin() ) {
    require INSPIRO_THEME_DIR . 'inc/admin-notice.php';
    require INSPIRO_THEME_DIR . 'inc/theme-info-page.php';

    if ( current_user_can( 'manage_options' ) ) {
        require INSPIRO_THEME_DIR . 'inc/classes/class-inspiro-notices.php';
        require INSPIRO_THEME_DIR . 'inc/classes/class-inspiro-notice-review.php';
    }
}


if ( ! function_exists( 'inspiro_blocks_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function inspiro_blocks_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'inspiro-blocks', get_template_directory() . '/languages' );

		// Enqueue editor styles and fonts.
		add_editor_style(
			array(
				'./style.css',
			)
		);

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

        register_nav_menus( array( 'primary' => esc_html__( 'Primary Menu', 'inspiro-blocks' ) ) );

	}
}
add_action( 'after_setup_theme', 'inspiro_blocks_setup' );

// Enqueue style sheet.
add_action( 'wp_enqueue_scripts', 'inspiro_blocks_enqueue_style_sheet' );
function inspiro_blocks_enqueue_style_sheet() {

	wp_enqueue_style( 'inspiro-blocks', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 1.0.0
 */
function inspiro_blocks_register_block_styles() {

	$block_styles = array(
		'core/group'           => array(
			'shadow'       => __( 'Shadow', 'inspiro-blocks' ),
			'border' => __( 'Border', 'inspiro-blocks' ),
			'full-height'  => __( 'Full-height', 'inspiro-blocks' ),
		),
        'core/cover'           => array(
            'round-corners'       => __( 'Rounded', 'inspiro-blocks' ),
        ),
        'core/column'           => array(
            'shadow'       => __( 'Shadow', 'inspiro-blocks' ),
            'border' => __( 'Border', 'inspiro-blocks' ),
            'pull-right'  => __( 'Pull right', 'inspiro-blocks' ),
            'pull-left'  => __( 'Pull left', 'inspiro-blocks' ),
        ),
		'core/image'           => array(
			'shadow' => __( 'Shadow', 'inspiro-blocks' ),
		),
		'core/list'            => array(
			'no-disc' => __( 'No Disc', 'inspiro-blocks' ),
		),
		'core/media-text'      => array(
			'shadow-media' => __( 'Shadow', 'inspiro-blocks' ),
		),
		'core/navigation-link' => array(
			'fill'         => __( 'Fill', 'inspiro-blocks' ),
			'fill-background'    => __( 'Fill Background', 'inspiro-blocks' ),
			'outline'      => __( 'Outline', 'inspiro-blocks' ),
			'outline-background' => __( 'Outline Background', 'inspiro-blocks' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'inspiro_blocks_register_block_styles' );

/**
 * Registers block categories, and type.
 *
 * @since 1.0
 */

if ( ! function_exists( 'inspiro_blocks_register_block_pattern_categories' ) ) {

    function inspiro_blocks_register_block_pattern_categories() {

    	/* Functionality specific to the Block Pattern Explorer plugin. */
    	if ( function_exists( 'register_block_pattern_category_type' ) ) {
    		register_block_pattern_category_type( 'inspiro-blocks', array( 'label' => __( 'inspiro-blocks', 'inspiro-blocks' ) ) );
    	}

    	$block_pattern_categories = array(
    		'inspiro-blocks-footer'  => array(
    			'label'         => __( 'Footer', 'inspiro-blocks' ),
    			'categoryTypes' => array( 'inspiro-blocks' ),
    		),
    		'inspiro-blocks-general' => array(
    			'label'         => __( 'Sections', 'inspiro-blocks' ),
    			'categoryTypes' => array( 'inspiro-blocks' ),
    		),
    		'inspiro-blocks-header'  => array(
    			'label'         => __( 'Header', 'inspiro-blocks' ),
    			'categoryTypes' => array( 'inspiro-blocks' ),
    		),
    		'inspiro-blocks-page'    => array(
    			'label'         => __( 'Pages', 'inspiro-blocks' ),
    			'categoryTypes' => array( 'inspiro-blocks' ),
    		),
    		'inspiro-blocks-query'   => array(
    			'label'         => __( 'Blog Posts', 'inspiro-blocks' ),
    			'categoryTypes' => array( 'inspiro-blocks' ),
    		),
    	);

    	foreach ( $block_pattern_categories as $name => $properties ) {
    		register_block_pattern_category( $name, $properties );
    	}
    }
    add_action( 'init', 'inspiro_blocks_register_block_pattern_categories', 9 );

}


function inspiro_blocks_get_custom_typography() {

	$font_families = array();

	$args = array(
		'post_type'      => 'wp_global_styles',
		'posts_per_page' => 1,
	);
	
	$get_custom_styles = get_posts( $args );
	
	if( !empty( $get_custom_styles ) ) {
		
		$styles = $get_custom_styles[0]->post_content;
		$styles = json_decode( $styles, true );
		$font_families = inspiro_blocks_extract_font_families( $styles );
	}

	return $font_families;

}

function inspiro_blocks_extract_font_families( $data = array() ) {

	if( empty( $data ) ) {
		return array();
	}

	$pattern  = '/var:preset\|font-family\|([^|]+)/';
	$pattern2 = '/var\(--wp--preset--font-family--([\w\-]+)\)/';
	$preset_patern = 'var(--wp--preset--font-family--';

	$font_families = $matches = $matches2 = array();

    $data = getFontFamilyValues($data);

	foreach ( $data as $key => $value ) {

        if ( strpos( $value, $preset_patern ) !== false ) {
            if ( preg_match( $pattern2, $value, $matches2 ) ) {
                $value = $matches2[1];
                $font_families[] = $value;	
            }
        } else {
            if( preg_match_all( $pattern, $value, $matches ) ) {
                $value = end( $matches[1] );
            }
            $font_families[] = $value;
        }

    }	

	$font_families = array_unique( $font_families );

	return $font_families;

}

function getFontFamilyValues( $array, $excludeKey = 'fontFamilies' ) {
    
    $fontFamilies = [];
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            if ($key !== $excludeKey) {
                $fontFamilies = array_merge($fontFamilies, getFontFamilyValues($value, $excludeKey));
            }
        } elseif ($key === 'fontFamily') {
            $fontFamilies[] = $value;
        }
    }

    return $fontFamilies;
}


/**
* Enqueue theme fonts.
*/
function inspiro_blocks_theme_fonts() {
    
	$theme_fonts_url             = inspiro_blocks_get_fonts_url();
	$theme_fonts_url_for_editor  = inspiro_blocks_get_fonts_url( true );

    // Load Fonts if necessary.
    if ( $theme_fonts_url ) {
        require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
        wp_enqueue_style( 'inspiro-blocks-theme-fonts', wptt_get_webfont_url( $theme_fonts_url ), array(), wp_get_theme()->get( 'Version' ) );
    }
	if( $theme_fonts_url_for_editor ) {
		add_editor_style( $theme_fonts_url_for_editor );
	}

}
add_action( 'admin_init', 'inspiro_blocks_theme_fonts', 1 );
add_action( 'wp_enqueue_scripts', 'inspiro_blocks_theme_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'inspiro_blocks_theme_fonts', 1 );

/*
 * Gutenberg Editor CSS
 *
 * Load a stylesheet for customizing the Gutenberg editor
 * including support for Google Fonts and @import rules.
 */
function inspiro_blocks_gutenberg_editor_css() {
  
	wp_enqueue_style( 
		'inspiro-blocks-theme-editor-css', 
		get_stylesheet_directory_uri() . '/assets/admin/css/editor-google-fonts.css', 
		array(), 
		wp_get_theme()->get( 'Version' ) 
	);
  
  }
  add_action( 'enqueue_block_editor_assets', 'inspiro_blocks_gutenberg_editor_css' );


/**
 * Retrieve webfont URL to load fonts locally.
 */
function inspiro_blocks_get_fonts_url( $all = false ) {

	//Set default theme typography font families
	$theme_default_typo = array(
		'inter',
		'montserrat',
		'bitter',
		'raleway',
		'epilogue',
		'source-sans-pro',
		'poppins',
		'nunito',
		'yeseva-one',
		'josefin-sans'
	);

	$fonts_to_download = array();

    $font_families = array(
        'alegreya'           => 'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
        'archivo'            => 'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'bitter'             => 'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'cormorant-garamond' => 'Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700',
        'crimson-pro'        => 'Crimson+Pro:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600',
        'dm-sans'            => 'DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700',
        'epilogue'           => 'Epilogue:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'figtree'            => 'Figtree:wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900',
		'ibm-plex-mono'      => 'IBM+Plex+Mono:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700',
        'ibm-plex-sans'      => 'IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
        'inter'              => 'Inter:wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900',
        'josefin-sans'       => 'Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
        'jost'               => 'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'lexend'             => 'Lexend:wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900',
        'libre-baskerville'  => 'Libre+Baskerville:ital,wght@0,400;0,700;1,400',
        'libre-franklin'     => 'Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'lora'               => 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
        'manrope'            => 'Manrope:wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800',
        'merriweather'       => 'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900',
        'montserrat'         => 'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'mulish'             => 'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000',
        'nunito'             => 'Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000',
        'open-sans'          => 'Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800',
        'oswald'             => 'Oswald:wght@0,200;0,300;0,400;0,500;0,600;0,700',
        'outfit'             => 'Outfit:wght@100;200;300;400;500;600;700;800;900',
        'philosopher'        => 'Philosopher:ital,wght@0,400;0,700;1,400;1,700',
        'playfair-display'   => 'Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
        'poppins'            => 'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'quicksand'          => 'Quicksand:wght@0,300;0,400;0,500;0,600;0,700',
        'raleway'            => 'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'roboto'             => 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900',
        'roboto-condensed'   => 'Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
        'rubik'              => 'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'source-sans-pro'    => 'Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900',
        'source-serif-pro'   => 'Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900',
        'space-grotesk'      => 'Space+Grotesk:wght@0,300;0,400;0,500;0,600;0,700',
        'urbanist'           => 'Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'work-sans'          => 'Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
        'yeseva-one'         => 'Yeseva+One'
    );

	//Get user's saved custom typography
	$user_custom_typo = inspiro_blocks_get_custom_typography();
	
	//Combine default and custom typography
	$theme_custom_typo = array_merge( $user_custom_typo, $theme_default_typo );
	$theme_custom_typo = array_unique( $theme_custom_typo );

	if( ! empty( $theme_custom_typo ) ) {

		foreach( $theme_custom_typo as $value ) {
			if( isset( $font_families[ $value ] ) ) {
				$fonts_to_download[] = $font_families[ $value ];
			}
		}

		if( $all ) {
			$fonts_to_download = $font_families;
		}

		$query_args = array(
			'family'  => implode( '|', $fonts_to_download ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'swap' ),
		);
	
		return apply_filters( 'inspiro_blocks_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
	
	}

	return $fonts_to_download;

}


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'inspiro_blocks_register_required_plugins' );


/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function inspiro_blocks_register_required_plugins() {

    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // Recommended plugins from the WordPress Plugin Repository.
        array(
            'name'      => 'WPZOOM Portfolio',
            'slug'      => 'wpzoom-portfolio',
            'required'  => false,
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'inspiro-blocks',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}
