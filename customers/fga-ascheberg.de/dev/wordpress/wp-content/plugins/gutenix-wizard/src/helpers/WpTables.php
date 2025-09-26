<?php

namespace zw\helpers;


class WpTables
{
    public static function doesTableExist($table){
        global $wpdb;

        $table_name = $wpdb->prefix . $table;

        return ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) ) === $table_name );

    }
}