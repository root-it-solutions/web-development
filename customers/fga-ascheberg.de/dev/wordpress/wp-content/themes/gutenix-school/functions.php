<?php

add_action('wp_enqueue_scripts', 'gutenix_school_child_wp_enqueue_scripts');
function gutenix_school_child_wp_enqueue_scripts()
{

    $parent_theme = wp_get_theme(get_template());
    $child_theme = wp_get_theme();

    // Enqueue the parent stylesheet
    wp_enqueue_style('gutenix-parent-style', get_template_directory_uri() . '/style.css', array(), $parent_theme['Version']);
    wp_enqueue_style('gutenix-style', get_stylesheet_uri(), array('gutenix-parent-style'), $child_theme['Version']);


    wp_enqueue_style('gutenix-school-fonts', gutenix_school_fonts_url(), array(), null);


    // Enqueue the parent rtl stylesheet
    if (is_rtl()) {
        wp_enqueue_style('gutenix-parent-style-rtl', get_template_directory_uri() . '/style-rtl.css', array(), $parent_theme['Version']);
    }
}

if (!function_exists('gutenix_school_setup')) :
    function gutenix_school_setup()
    {

        add_editor_style('editor-styles.css');

        add_theme_support('editor-color-palette', array(
            array(
                'name' => esc_html__('Color 1', 'school'),
                'slug' => 'color-1',
                'color' => '#90cc98',
            ),
            array(
                'name' => esc_html__('Color 2', 'school'),
                'slug' => 'color-2',
                'color' => '#1c1e1e',
            ),
            array(
                'name' => esc_html__('Color 3', 'school'),
                'slug' => 'color-3',
                'color' => '#9d9fa3',
            ),
            array(
                'name' => esc_html__('Color 4', 'school'),
                'slug' => 'color-4',
                'color' => '#ebe5d7',
            ),
            array(
                'name' => esc_html__('Color 5', 'school'),
                'slug' => 'color-5',
                'color' => '#ffffff',
            ),
            array(
                'name' => esc_html__('Color 6', 'school'),
                'slug' => 'color-6',
                'color' => '#8fbdf2',
            ),
            array(
                'name' => esc_html__('Color 7', 'school'),
                'slug' => 'color-7',
                'color' => '#7a7afd',
            ),
            array(
                'name' => esc_html__('Color 8', 'school'),
                'slug' => 'color-8',
                'color' => '#e9803c',
            ),
        ));

        gutenix_school_register_block_styles();
    }
endif;
add_action('after_setup_theme', 'gutenix_school_setup');

function gutenix_school_register_block_styles()
{
    if (function_exists('register_block_style')) {
        register_block_style('getwid/person', array(
            'label' => esc_html_x('Style 1 ', 'block style name', 'gutenix-school'),
            'name' => 'style1'
        ));

        register_block_style('getwid/person', array(
            'label' => esc_html_x('Style 2', 'block style name', 'gutenix-school'),
            'name' => 'style2'
        ));

        register_block_style('getwid/person', array(
            'label' => esc_html_x('Style 3', 'block style name', 'gutenix-school'),
            'name' => 'style3'
        ));

        register_block_style('getwid/person', array(
            'label' => esc_html_x('Style 4', 'block style name', 'gutenix-school'),
            'name' => 'style4'
        ));

        register_block_style('getwid/person', array(
            'label' => esc_html_x('Style 5', 'block style name', 'gutenix-school'),
            'name' => 'style5'
        ));

        register_block_style('getwid/social-links', array(
            'label' => esc_html_x('Bordered', 'block style name', 'gutenix-school'),
            'name' => 'border'
        ));

        register_block_style('getwid/media-text-slider', array(
            'label' => esc_html_x('Content Bottom', 'block style name', 'gutenix-school'),
            'name' => 'bottom-content'
        ));

        register_block_style('getwid/images-slider', array(
            'label' => esc_html_x('Style1', 'block style name', 'gutenix-school'),
            'name' => 'style1'
        ));

        register_block_style('getwid/advanced-heading', array(
            'label' => esc_html_x('Style 1', 'block style name', 'gutenix-school'),
            'name' => 'style1'
        ));

        register_block_style('getwid/advanced-heading', array(
            'label' => esc_html_x('Style 2', 'block style name', 'gutenix-school'),
            'name' => 'style2'
        ));

        register_block_style('core/gallery', array(
            'label' => esc_html_x('Grid without indents', 'block style name', 'gutenix-school'),
            'name' => 'grid-without-indents'
        ));
    }
}

function gutenix_school_fonts_url()
{
    $url = 'https://fonts.googleapis.com/css2?';
    $fonts = [];

    $font1 = esc_html_x('on', 'Poppins font: on or off', 'gutenix-school');
    if ('off' !== $font1) {
        $fonts[] = 'family=Poppins:wght@0,400;0,500;1,400;1,700';
    }

    $font2 = esc_html_x('on', 'Roboto font: on or off', 'gutenix-school');
    if ('off' !== $font2) {
        $fonts[] = 'family=Roboto:wght@0,400;0,700;1,400;1,700';
    }

    if (!$fonts) {
        return null;
    }

    $url .= implode('&amp;', $fonts);
    $url .= '&amp;display=swap';

    return esc_url_raw($url);
}

function gutenix_school_before_single_post()
{
    if (class_exists('\mp_timetable\plugin_core\classes\Core') && is_singular(['mp-event']) || class_exists('\mp_timetable\plugin_core\classes\Core') && is_singular(['mp-column'])) {
        remove_filter('the_content', [\mp_timetable\plugin_core\classes\Core::get_instance(), 'append_post_meta']);
    }
}

add_action('gutenix_before_single_post', 'gutenix_school_before_single_post');

function gutenix_school_after_event_thumbnail()
{
    if (class_exists('mp_timetable\classes\models\Events')) {
        mp_timetable\classes\models\Events::get_instance()->render_event_metas();
    }
}

add_action('gutenix_school_after_event_thumbnail', 'gutenix_school_after_event_thumbnail');

function gutenix_school_after_column_content()
{
    if (class_exists('mp_timetable\classes\models\Column')) {
        mp_timetable\classes\models\Column::get_instance()->render_column_metas();
    }
}

add_action('gutenix_school_after_column_content', 'gutenix_school_after_column_content');

function gutenix_school_comments_args($args)
{
    $args['avatar_size'] = 100;
    return $args;
}

add_filter('gutenix_wp_list_comments_args', 'gutenix_school_comments_args');

function gutenix_school_importer_config() 
{
    $config = array(
        'export' => [
            'tables' => [
                'mp_timetable_data'
            ]
        ]
    );

    if ( function_exists('zemixDataImporterRegisterConfig') ) {
        zemixDataImporterRegisterConfig($config);
    }
}

add_action('init', 'gutenix_school_importer_config');
