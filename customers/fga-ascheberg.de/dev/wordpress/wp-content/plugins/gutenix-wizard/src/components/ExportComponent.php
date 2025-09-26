<?php

namespace zw\components;

use zw\utils\FileCache;
use zw\services\ExportContentService;
use zw\helpers\File;

class ExportComponent
{
    const PREFIX = 'export';

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/run', array($this, 'actionRunExport'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/import', array($this, 'actionRunImport'));
    }



    /**
     * Returns filename for exported sample data
     *
     * @return string
     */
    function getFilename() {

        $date     = date( 'm-d-Y' );
        $template = get_template();

        return 'sample-data-' . $template . '-' . $date . '.xml';

    }

    /**
     * Send download headers
     *
     * @return void
     */
    function downloadHeaders( $file = 'sample-data.xml' ) {

        session_write_close();

        header( 'Pragma: public' );
        header( 'Expires: 0' );
        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
        header( 'Cache-Control: public' );
        header( 'Content-Description: File Transfer' );
        header( 'Content-type: application/octet-stream' );
        header( 'Content-Disposition: attachment; filename="' . $file . '"' );
        header( 'Content-Transfer-Encoding: binary' );

    }

    /**
     * @return mixed
     */
    function actionRunExport()
    {
        if ( ! current_user_can( 'export' ) ) {

            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $exportService = new ExportContentService();
        $xml = $exportService->doExport();
        $this->downloadHeaders( $this->getFilename() );

        echo $xml;

        die();

    }

    public function actionRunImport(){
        if ( ! current_user_can( 'import' ) ) {

            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $importFile = isset($_FILES["fileToImport"])?$_FILES["fileToImport"]:null;
        if(!isset($importFile)){
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('Bad Request', 'zw'),
                array('status' => 400)));
        }


        $uploadsDir = wp_upload_dir();
        $customImportDir = $uploadsDir["basedir"] . DIRECTORY_SEPARATOR . "custom-import";
        File::createDirectory($customImportDir);
        $fileName = "custom-import.xml";


        move_uploaded_file($importFile["tmp_name"], $customImportDir.DIRECTORY_SEPARATOR.$fileName);

        $cacheRootDid = File::normalizePath(ZW_ROOT . '/runtime/cache');
        File::createDirectory($cacheRootDid);
        $cacheId = 'skin-info-custom';
        $cache = new FileCache(array(
            'name' => $cacheId,
            'path' => $cacheRootDid . DIRECTORY_SEPARATOR,
            'extension' => '.bin'
        ));
        $cache->eraseExpired();
        $skinInfo = array(
                "name" => "Custom",
                "slug" => "custom",
                "full_xml" => $uploadsDir["baseurl"]."/custom-import/".$fileName
        );

        $cache->store($cacheId, $skinInfo, 3600);

        \zw\OptionStorage::setByPath("skinInstall.slug", "custom");

        return apply_filters('zw/jsonResponse', array(
            "status" => 200,
            "message" => "Ready for import"
        ));
    }

}