<?php

namespace zw\components;

use zw\helpers\File;
use zw\helpers\StringHelper;
use zw\services\ImporterExtensions;
use zw\utils\FileCache;
use zw\WXRImporter;


class ContentComponent
{
    const PREFIX = 'content';
    const CHUNK_SIZE = 20;
    const CACHE_TTL = 604800;

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/clear-content', array($this, 'actionClearContent'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/info', array($this, 'actionInfo'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/chunk-import', array($this, 'actionChunkImport'));
    }

    /**
     * @return mixed
     */
    public function actionClearContent()
    {
        if (!current_user_can('import')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
        if (empty($password) || StringHelper::clean($password) === '') {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('Password is empty', 'zw'),
                array('status' => 503)));
        }

        if (!current_user_can('delete_users')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $password = esc_attr(StringHelper::clean($password));
        $userId = get_current_user_id();
        $data = get_userdata($userId);

        if (!wp_check_password($password, $data->user_pass, $userId)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('Entered password is invalid', 'zw'),
                array('status' => 503)));
        }


        // delete attachment
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
        ));

        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                wp_delete_attachment($attachment->ID, true);
            }
        }

        // truncate tables
        global $wpdb;

        $tables_to_clear = array(
            $wpdb->commentmeta,
            $wpdb->comments,
            $wpdb->links,
            $wpdb->postmeta,
            $wpdb->posts,
            $wpdb->termmeta,
            $wpdb->terms,
            $wpdb->term_relationships,
            $wpdb->term_taxonomy,
        );
        foreach ($tables_to_clear as $table) {
            $wpdb->query("TRUNCATE {$table};");
        }

        // delete options
        $options = apply_filters('zw/clear-options-on-remove', array(
            'sidebars_widgets',
        ));

        foreach ($options as $option) {
            delete_option($option);
        }

        // Clear widgets data
        $widgets = $wpdb->get_results(
            "SELECT * FROM $wpdb->options WHERE `option_name` LIKE 'widget_%'"
        );

        if (!empty($widgets)) {
            foreach ($widgets as $widget) {
                delete_option($widget->option_name);
            }
        }
        return apply_filters('zw/jsonResponse', array('message' => esc_html__('Content successfully removed', 'zw')));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionInfo()
    {
        if (!current_user_can('import')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $skin = isset($_REQUEST['skin']) ? $_REQUEST['skin'] : null;
        if (empty($skin) || StringHelper::clean($skin) === '') {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('Bad Params', 'zw'),
                array('status' => 503)));
        }

        $skin = StringHelper::clean($skin);
        $cacheId = 'demo-import-state-' . $skin;
        $cacheRootDid = File::normalizePath(ZW_ROOT . '/runtime/cache');
        File::createDirectory($cacheRootDid);
        $cache = new FileCache(array(
            'name' => $cacheId,
            'path' => $cacheRootDid . DIRECTORY_SEPARATOR,
            'extension' => '.bin'
        ));
        $cache->eraseExpired();
        $cache->retrieve($cacheId);
        $cache->store($cacheId, array(), self::CACHE_TTL);

        $icService = new \zw\services\ImportContentService();
        $file = $icService->getImportFile($skin);
        if ($file === null || !file_exists($file)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('File Import Content Not Found', 'zw'),
                array('status' => 503)));
        }

        $importer = new WXRImporter(array(), $file);
        $importer->prepare_import();
        $total = \zw\utils\LocalStorage::get('importer.total_count');
        $summary = \zw\utils\LocalStorage::get('importer.import_summary');

        $chunksCount = ceil( intval( $total ) / self::CHUNK_SIZE );
        $chunksCount++;

        \zw\utils\LocalStorage::set('importer.chunks_count', $chunksCount);
        $cache->store($cacheId, \zw\utils\LocalStorage::get('importer'), self::CACHE_TTL);

        return apply_filters('zw/jsonResponse', array(
            'total' => $total,
            'summary' => array_values($summary),
            'chunksCount' => $chunksCount,
            'chunkSize' => self::CHUNK_SIZE,
        ));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionChunkImport()
    {
        if (!current_user_can('import')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $skin = isset($_REQUEST['skin']) ? $_REQUEST['skin'] : null;
        $skin = StringHelper::clean($skin);
        $chunkIndex = isset($_REQUEST['chunkIndex']) ? $_REQUEST['chunkIndex'] : null;
        if ($chunkIndex == null || StringHelper::clean($chunkIndex) === '') {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('Bad Params', 'zw'),
                array('status' => 503)));
        }

        $icService = new \zw\services\ImportContentService();
        $file = $icService->getImportFile($skin);
        if ($file === null || !file_exists($file)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('File Import Content Not Found', 'zw'),
                array('status' => 503)));
        }

        /**
         * Load data from cache
         */
        $cacheId = 'demo-import-state-' . $skin;
        $cacheRootDid = File::normalizePath(ZW_ROOT . '/runtime/cache');
        File::createDirectory($cacheRootDid);
        $cache = new FileCache(array(
            'name' => $cacheId,
            'path' => $cacheRootDid . DIRECTORY_SEPARATOR,
            'extension' => '.bin'
        ));
        $cache->eraseExpired();
        $importState = $cache->retrieve($cacheId);
        $importState = !is_array($importState) ? array() : $importState;
        \zw\utils\LocalStorage::set('importer', $importState);
        $icService = new \zw\services\ImportContentService();
        new ImporterExtensions();
        $chunksCount = (int)\zw\utils\LocalStorage::get('importer.chunks_count', 0);
        $importer = new WXRImporter(array(), $file);
        switch ($chunkIndex) {
            case $chunksCount:
                $icService->remapAll($importer);
                flush_rewrite_rules();
                /**
                 * Hook on last import chunk
                 */
                do_action('zw/import/finish');
                $file = $icService->getImportFile($skin);
                $importer->close_reader();
                if (file_exists($file)) {
                    unlink($file);
                }
                break;
            default:
                $offset = self::CHUNK_SIZE * ($chunkIndex - 1);
                $importer->chunked_import(self::CHUNK_SIZE, $offset);
                $cache->store($cacheId, \zw\utils\LocalStorage::get('importer'), self::CACHE_TTL);
                break;
        }


        $processedSummary = array_values(\zw\utils\LocalStorage::get('importer.processed_summary', array()));
        $totalCount = (int)\zw\utils\LocalStorage::get('importer.total_count', 0);
        $totalCountProcessed = 0;
        if (is_array($processedSummary)) {
            foreach ($processedSummary as $k => $v) {
                $totalCountProcessed += (int)$v['countItems'];
            }
        }

        return apply_filters('zw/jsonResponse', array(
            'totalCountProcessed' => $totalCountProcessed,
            'totalCount' => $totalCount,
            //'summary' =>\zw\utils\LocalStorage::get('importer.import_summary'),
            'processed' => array_values(\zw\utils\LocalStorage::get('importer.processed_summary', array())),
        ));
    }
}