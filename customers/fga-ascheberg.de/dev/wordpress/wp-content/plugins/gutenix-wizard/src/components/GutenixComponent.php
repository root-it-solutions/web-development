<?php

namespace zw\components;

use zw\utils\Curl;
use zw\services\ThemeService;
use zw\helpers\File;
use zw\utils\FileCache;

class GutenixComponent
{
    const PREFIX = 'gutenix';
    const BACKUP_DIR = 'theme-backups';

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/info', array($this, 'actionInfo'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/local-theme', array($this, 'actionLocalTheme'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/install', array($this, 'actionInstall'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/activate', array($this, 'actionActivate'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/update', array($this, 'actionUpdate'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/create-backup', array($this, 'actionCreateBackup'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/get-backups', array($this, 'actionGetBackups'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/download-backup', array($this, 'actionDownloadBackup'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/delete-backup', array($this, 'actionDeleteBackup'));
    }

    /**
     * @return mixed
     */
    public function actionInfo()
    {
        $cacheRootDid = File::normalizePath(ZW_ROOT . '/runtime/cache');
        File::createDirectory($cacheRootDid);
        $cacheId = 'theme-info';
        $cache = new FileCache(array(
            'name' => $cacheId,
            'path' => $cacheRootDid . DIRECTORY_SEPARATOR,
            'extension' => '.bin'
        ));
        $cache->eraseExpired();
        $themeInfo = $cache->retrieve($cacheId);
        if ($themeInfo === null && isset($_REQUEST['clearCache']) && $_REQUEST['clearCache']) {
            $themeService = new ThemeService();
            $themeInfo = $themeService->info();
        }
        return apply_filters('zw/jsonResponse', isset($themeInfo) ? $themeInfo : array());
    }

    /**
     * @return mixed
     */
    public function actionLocalTheme()
    {
        $themeName = isset($_REQUEST["themeName"]) ? $_REQUEST["themeName"] : null;
        if (!isset($themeName)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }
        $themeService = new ThemeService();
        $themeInfo = $themeService->exist($themeName);
        if (!isset($themeInfo)) {
            return apply_filters('zw/jsonResponse', null);
        }
        $isActive = $themeService->isActive($themeName);
        $theme = array(
            'name' => $themeInfo->get("Name"),
            'slug' => $themeName,
            'description' => $themeInfo->get("Description"),
            'version' => $themeInfo->get("Version"),
            'isActive' => $isActive
        );
        return apply_filters('zw/jsonResponse', $theme);
    }


    /**
     * @return mixed
     */
    public function actionInstall()
    {
        if (!\current_user_can('switch_themes')
            || !\current_user_can('install_themes')
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }
        $licenceKey = isset($_REQUEST['licenceKey']) ? $_REQUEST['licenceKey'] : null;
        $typeInstall = isset($_REQUEST['typeInstall']) ? $_REQUEST['typeInstall'] : null;
        $typeTheme = isset($_REQUEST['typeTheme']) ? $_REQUEST['typeTheme'] : null;

        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/info');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            '_rnd' => time(),
            'licenceKey' => $licenceKey,
            'typeInstall' => $typeInstall,
            'typeTheme' => $typeTheme,
        ));
        $response = $curl->execute();
        $curlInfo = $curl->getCurlInfo();
        if (isset($curlInfo['http_code']) && $curlInfo['http_code'] !== 200) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Remote server is not responding.'),
                array('status' => 503)));
        }
        $response = json_decode($response, true);

        $themeInfo = isset($response['body']['theme']) ? $response['body']['theme'] : null;
        $themeSlug = isset($themeInfo['slug']) ? $themeInfo['slug'] : null;
        $themeZip = isset($themeInfo['themeZip']) ? $themeInfo['themeZip'] : null;
        $childThemeZip = isset($themeInfo['childThemeZip']) ? $themeInfo['childThemeZip'] : null;

        $_zipUrl = $themeZip;
        $_themeName = $themeSlug;

        if ($typeTheme === 'child') {
            $_zipUrl = $childThemeZip;
            $_themeName = $themeSlug . "-child";
        }

        if ($themeInfo === null
            || $_zipUrl === null
            || $_themeName === null
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Response'),
                array('status' => 503)));
        }

        $themeService = new ThemeService();
        $themeExist = $themeService->exist($_themeName);

        $storage = \zw\OptionStorage::get();
        if ($typeTheme === 'parent' && isset($storage['themes'])) {
            $storage['themes'] = array();
        }

        $storage['themes'] = isset($storage['themes']) ? $storage['themes'] : array();
        $storage['themes'][] = array(
            'typeTheme' => $typeTheme,
            'slug' => $_themeName,
        );
        \zw\OptionStorage::set($storage);
        if ($themeExist === null) {
            $rr = $themeService->install($_zipUrl);
        }

        $themeExist = $themeService->exist($_themeName);
        $themeActive = $themeService->isActive($_themeName);
        $response = array(
            'theme' => array(
                'name' => $_themeName,
                'isExist' => $themeExist === null ? false : true,
                'isActivated' => $themeActive,
            )
        );
        return apply_filters('zw/jsonResponse', $response);
    }


    /**
     * @return mixed
     */
    public function actionActivate()
    {
        if (!\current_user_can('switch_themes')
            || !\current_user_can('install_themes')
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $licenceKey = isset($_REQUEST['licenceKey']) ? $_REQUEST['licenceKey'] : null;
        $typeInstall = isset($_REQUEST['typeInstall']) ? $_REQUEST['typeInstall'] : null;
        $typeTheme = isset($_REQUEST['typeTheme']) ? $_REQUEST['typeTheme'] : null;
        $storage = \zw\OptionStorage::get();

        if (!isset($storage['themes'])
            || !is_array($storage['themes'])
            || count($storage['themes']) < 1
            || $typeTheme === null
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Params'),
                array('status' => 503)));
        }

        $theme = null;
        foreach ($storage['themes'] as $item) {
            if (!isset($item['typeTheme']) || !isset($item['slug']) || $item['typeTheme'] !== $typeTheme) {
                continue;
            }
            $theme = $item;
        }

        if ($theme === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Not found Downloaded Theme'),
                array('status' => 503)));
        }

        $themeName = $theme['slug'];
        $themeService = new \zw\services\ThemeService();
        $themeExist = $themeService->exist($themeName);
        $isActiveTheme = $themeService->isActive($themeName);
        if ($themeExist === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Not found Downloaded Theme'),
                array('status' => 503)));
        }


        if (!$isActiveTheme) {
            do_action('zw/install-theme/before-activation', $themeName, $themeExist);
            switch_theme($themeName);
            do_action('zw/install-theme/after-activation', $themeName, $themeExist);
        }

        $isActiveTheme = $themeService->isActive($themeName);
        if (!$isActiveTheme) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Problem with activation theme'),
                array('status' => 503)));
        }
        return apply_filters('zw/jsonResponse', array(
            'status' => 'activated'
        ));
    }


    /**
     * @return mixed
     */
    public function actionUpdate()
    {
        if (!\current_user_can('switch_themes')
            || !\current_user_can('install_themes')
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }
        $licenceKey = isset($_REQUEST['licenceKey']) ? $_REQUEST['licenceKey'] : null;
        $typeInstall = isset($_REQUEST['typeInstall']) ? $_REQUEST['typeInstall'] : null;
        $typeTheme = isset($_REQUEST['typeTheme']) ? $_REQUEST['typeTheme'] : null;

        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/info');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            '_rnd' => time(),
            'licenceKey' => $licenceKey,
            'typeInstall' => $typeInstall,
            'typeTheme' => $typeTheme,
        ));
        $response = $curl->execute();
        $curlInfo = $curl->getCurlInfo();
        if (isset($curlInfo['http_code']) && $curlInfo['http_code'] !== 200) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Remote server is not responding.'),
                array('status' => 503)));
        }
        $response = json_decode($response, true);

        $themeInfo = isset($response['body']['theme']) ? $response['body']['theme'] : null;
        $themeSlug = isset($themeInfo['slug']) ? $themeInfo['slug'] : null;
        $themeZip = isset($themeInfo['themeZip']) ? $themeInfo['themeZip'] : null;
        $childThemeZip = isset($themeInfo['childThemeZip']) ? $themeInfo['childThemeZip'] : null;

        $_zipUrl = $themeZip;
        $_themeName = $themeSlug;

        if ($typeTheme === 'child') {
            $_zipUrl = $childThemeZip;
            $_themeName = $themeSlug . "-child";
        }

        if ($themeInfo === null
            || $_zipUrl === null
            || $_themeName === null
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Response'),
                array('status' => 503)));
        }

        $themeService = new ThemeService();
        $themeExist = $themeService->exist($_themeName);

        $storage = \zw\OptionStorage::get();
        if ($typeTheme === 'parent' && isset($storage['themes'])) {
            $storage['themes'] = array();
        }

        $storage['themes'] = isset($storage['themes']) ? $storage['themes'] : array();
        $storage['themes'][] = array(
            'typeTheme' => $typeTheme,
            'slug' => $_themeName,
        );
        \zw\OptionStorage::set($storage);
        if ($themeExist !== null) {
            $themeService->deleteTheme($themeSlug);
        }

        $rr = $themeService->install($_zipUrl);
        $themeExist = $themeService->exist($_themeName);
        $themeActive = $themeService->isActive($_themeName);
        $response = array(
            'theme' => array(
                'name' => $_themeName,
                'isExist' => $themeExist === null ? false : true,
                'isActivated' => $themeActive,
            )
        );
        return apply_filters('zw/jsonResponse', $response);
    }


    /**
     * @return mixed
     */
    public function actionCreateBackup()
    {
        if (!current_user_can('manage_options')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }


        $licenceKey = isset($_REQUEST['licenceKey']) ? $_REQUEST['licenceKey'] : null;
        $themeSlug = isset($_REQUEST['themeSlug']) ? $_REQUEST['themeSlug'] : null;

        if (!isset($themeSlug)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        $themesDir = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'themes';

        $themeService = new ThemeService();
        $themeInfo = $themeService->exist($themeSlug);
        if ($themeInfo === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Not Found'),
                array('status' => 404)));
        }

        $uploadsDir = wp_upload_dir();
        $backupsDir = $uploadsDir["basedir"] . DIRECTORY_SEPARATOR . self::BACKUP_DIR;
        if (!is_dir($backupsDir)) {
            mkdir($backupsDir, 0700);
            $filePath = $backupsDir . '/.htaccess';
            $content = "Order allow,deny\nDeny from all\n";
            file_put_contents($filePath, $content);
        }
        $themeVersion = $themeInfo->get("Version");

        $zipFilePath = File::createZipArchive($themesDir . DIRECTORY_SEPARATOR . $themeSlug, $backupsDir . DIRECTORY_SEPARATOR . $themeSlug . '-' . $themeVersion);
        if ($zipFilePath === false) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        $creationDate = date("M d Y, H:i", filectime($zipFilePath));
        $zipFileName = basename($zipFilePath);

        $response = array(
            "name" => $zipFileName,
            "creationDate" => $creationDate
        );
        return apply_filters('zw/jsonResponse', $response);
    }

    public function actionGetBackups()
    {
        if (!current_user_can('manage_options')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }


        $uploadsDir = wp_upload_dir();
        $backupsDir = $uploadsDir["basedir"] . DIRECTORY_SEPARATOR . self::BACKUP_DIR;
        if (!is_dir($backupsDir)) {
            return apply_filters('zw/jsonResponse', array());
        }

        $allFiles = array_diff(scandir($backupsDir), array('.', '..'));
        $backups = [];
        foreach ($allFiles as $file) {
            $fileParts = pathinfo($file);
            if ($fileParts["extension"] === "zip") {
                $backups[] = array(
                    "name" => $file,
                    "creationDate" => date("M d Y, H:i", filectime($backupsDir . DIRECTORY_SEPARATOR . $file))
                );
            }
        }
        return apply_filters('zw/jsonResponse', $backups);
    }

    public function actionDownloadBackup()
    {
        if (!current_user_can('manage_options')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $backupFile = isset($_REQUEST["backupFile"]) ? $_REQUEST["backupFile"] : null;
        if ($backupFile === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }


        $uploadsDir = wp_upload_dir();
        $backupsDir = $uploadsDir["basedir"] . DIRECTORY_SEPARATOR . self::BACKUP_DIR;
        if (!is_dir($backupsDir)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('Not Found', 'zw'),
                array('status' => 404)));
        }

        $filepath = $backupsDir . DIRECTORY_SEPARATOR . $backupFile;

        if(!file_exists($filepath)){
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('Not Found', 'zw'),
                array('status' => 404)));
        }


        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"".$filepath."\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($filepath));
        ob_end_flush();
        readfile($filepath);
        exit;

    }

    public function actionDeleteBackup(){
        if (!current_user_can('manage_options')) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $backupFile = isset($_REQUEST["backupFile"]) ? $_REQUEST["backupFile"] : null;
        if ($backupFile === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        $uploadsDir = wp_upload_dir();
        $backupsDir = $uploadsDir["basedir"] . DIRECTORY_SEPARATOR . self::BACKUP_DIR;
        if (!is_dir($backupsDir)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('Not Found', 'zw'),
                array('status' => 404)));
        }

        $filepath = $backupsDir . DIRECTORY_SEPARATOR . $backupFile;

        if (!file_exists($filepath)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('Not Found', 'zw'),
                array('status' => 404)));
        }
        unlink($filepath);
        return apply_filters('zw/jsonResponse', array(
            "message" => "deleted"
        ));
    }
}