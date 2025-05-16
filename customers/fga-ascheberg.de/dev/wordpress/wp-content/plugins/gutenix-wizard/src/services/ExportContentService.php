<?php

namespace zw\services;


class ExportContentService
{
    public function __construct() {
        require_once( ABSPATH . '/wp-admin/includes/export.php' );
    }


    /**
     * Get array of options to export with content
     *
     * @return array
     */
    function getOptionsToExport()
    {


        $theme = get_option('stylesheet');

        $defaultOptions = array(
            'blogname',
            'blogdescription',
            'users_can_register',
            'posts_per_page',
            'date_format',
            'time_format',
            'thumbnail_size_w',
            'thumbnail_size_h',
            'thumbnail_crop',
            'medium_size_w',
            'medium_size_h',
            'large_size_w',
            'large_size_h',
            'theme_mods_' . $theme,
            'show_on_front',
            'page_on_front',
            'page_for_posts',
            'permalink_structure',
            $theme . '_sidebars',
            $theme . '_sidbars',
            'zw_site_conditions',
            'elementor_container_width',
            'gutenixSkin'
        );

        $externalConfig = zwInstance()->externalConfig;

        $exportOptions = [];
        if ( isset($externalConfig)
            && isset($externalConfig["export"])
            && isset($externalConfig["export"]["options"]))  {

            $exportOptions = $externalConfig["export"]["options"];

        }


        $options = array_unique(array_merge($defaultOptions, $exportOptions));

        return $options;

    }

    /**
     * Get options list in XML format.
     *
     * @return string
     */
    function getOptions(){
        $options        = '';
        $format         = "\t\t<wp:%1$s>%2$s</wp:%1$s>\r\n";
        $exportOptions = $this->getOptionsToExport();

        foreach ( $exportOptions as $option ) {

            $value = get_option( $option );

            if ( is_array( $value ) ) {
                $value = json_encode( $value );
            }

            if ( ! empty( $option ) ) {
                $value   = wxr_cdata( $value );
                $options .= "\t\t<wp:{$option}>{$value}</wp:{$option}>\r\n";
            }

        }

        return "\t<wp:options>\r\n" . $options . "\t</wp:options>\r\n";

    }


    /**
     * Get tables to export
     *
     * @return string
     */
    public function getTables() {
        $externalConfig = zwInstance()->externalConfig;

        $exportTables = [];
        if ( isset($externalConfig)
            && isset($externalConfig["export"])
            && isset($externalConfig["export"]["tables"])) {
            $exportTables = $externalConfig["export"]["tables"];
        }


        if ( ! is_array( $exportTables ) ) {
            $exportTables = array();
        }

//        if ( class_exists( 'WooCommerce' ) && ! in_array( 'woocommerce_attribute_taxonomies', $exportTables ) ) {
//            $exportTables[] = 'woocommerce_attribute_taxonomies';
//        }

        if ( empty( $exportTables ) ) {
            return;
        }

        global $wpdb;

        $result = '';

        foreach ( $exportTables as $table ) {

            if ( ! \zw\helpers\WpTables::doesTableExist( $table ) ) {
                continue;
            }

            $name = esc_attr( $wpdb->prefix . $table );
            $data = $wpdb->get_results( "SELECT * FROM $name WHERE 1", ARRAY_A );

            if ( empty( $data ) ) {
                continue;
            }

            $data = maybe_serialize( $data );

            $result .= "\t\t<" . $table . ">" . wxr_cdata( $data ) . "</" . $table . ">\r\n";
        }

        if ( empty( $result ) ) {
            return;
        }

        return "\t<wp:user_tables>\r\n" . $result . "\r\n\t</wp:user_tables>\r\n";
    }



    /**
     * Add options and widgets to XML
     *
     * @param  string $xml Exported XML.
     * @return string
     */
    function addExtraData( $xml ) {

        ini_set( 'max_execution_time', -1 );
        ini_set( 'memory_limit', -1 );
        set_time_limit( 0 );

        $xml = str_replace(
            "</wp:base_blog_url>",
            "</wp:base_blog_url>\r\n" . $this->getOptions() . $this->getWidgets() . $this->getTables(),
            $xml
        );
        return $xml;
    }


    /**
     * Get widgets data to export
     *
     * @return string
     */
    function getWidgets() {

        // Get all available widgets site supports
        $availableWidgets = Widgets::availableWidgets();

        // Get all widget instances for each widget
        $widgetInstances = array();
        foreach ( $availableWidgets as $widget ) {

            // Get all instances for this ID base
            $instances = get_option( 'widget_' . $widget['id_base'] );

            // Have instances
            if ( ! empty( $instances ) ) {

                // Loop instances
                foreach ( $instances as $instanceId => $instanceData ) {

                    // Key is ID (not _multiwidget)
                    if ( is_numeric( $instanceId ) ) {
                        $uniqueInstanceId = $widget['id_base'] . '-' . $instanceId;
                        $widgetInstances[ $uniqueInstanceId ] = $instanceData;
                    }

                }

            }

        }

        // Gather sidebars with their widget instances
        $sidebarsWidgets = get_option( 'sidebars_widgets' ); // get sidebars and their unique widgets IDs
        $sidebarsWidgetInstances = array();
        foreach ( $sidebarsWidgets as $sidebarId => $widgetIds ) {

            // Skip inactive widgets
            if ( 'wp_inactive_widgets' == $sidebarId ) {
                continue;
            }

            // Skip if no data or not an array (array_version)
            if ( ! is_array( $widgetIds ) || empty( $widgetIds ) ) {
                continue;
            }

            // Loop widget IDs for this sidebar
            foreach ( $widgetIds as $widgetId ) {

                // Is there an instance for this widget ID?
                if ( isset( $widgetInstances[ $widgetId ] ) ) {

                    // Add to array
                    $sidebarsWidgetInstances[ $sidebarId ][ $widgetId ] = $widgetInstances[ $widgetId ];

                }

            }

        }

        // Encode the data for file contents
        $encodedData = json_encode( $sidebarsWidgetInstances );

        // Return contents
        return "\t<wp:widgets_data>" . wxr_cdata( $encodedData ) . "</wp:widgets_data>\r\n";

    }


    public function doExport()
    {
        ob_start();
        export_wp();
        $xml = ob_get_clean();
        $xml = $this->addExtraData( $xml );
        return $xml;
    }


}