<?php

namespace zw\components;

use zw\services\PluginService;
use zw\utils\Curl;

class PluginsComponent
{
    const PREFIX = 'plugins';

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/install', array($this, 'actionInstall'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/activate', array($this, 'actionActivate'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/list', array($this, 'actionList'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/update', array($this, 'actionUpdate'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/active-plugins', array($this, 'actionActivePlugins'));
    }

    /**
     * @return array|mixed|\WP_Error
     */
    public function actionList()
    {
        $licenceKey = isset($_REQUEST['licenceKey']) ? $_REQUEST['licenceKey'] : null;
        $skinSlug = isset($_REQUEST['skinSlug']) ? $_REQUEST['skinSlug'] : null;

        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/plugins/list');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            '_rnd' => time(),
            'licenceKey' => $licenceKey,
            'skinSlug' => $skinSlug,
        ));
        $response = $curl->execute();

        $curlInfo = $curl->getCurlInfo();
        if (isset($curlInfo['http_code']) && $curlInfo['http_code'] !== 200) {
            return new \WP_Error(
                self::PREFIX . '/error',
                __('Remote server is not responding.'),
                array('status' => 503));
        }
        $response = json_decode($response, true);
        return apply_filters('zw/jsonResponse', isset($response['body']) ? $response['body'] : array());
    }

    /**
     * @return mixed
     */
    public function actionInstall()
    {
        if (!\current_user_can('install_plugins')
            || !\current_user_can('activate_plugins')
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $licenceKey = isset($_REQUEST['licenceKey']) ? $_REQUEST['licenceKey'] : null;
        $pluginSlug = isset($_REQUEST['plugin']['slug']) ? $_REQUEST['plugin']['slug'] : null;

        if ($pluginSlug === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        // check exist plugin
        $pluginService = new PluginService();
        if ($pluginService->exist($pluginSlug)) {
            return apply_filters('zw/jsonResponse', array('message' => '', 'installed' => true));
        }

        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/plugins/get');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            '_rnd' => time(),
            'licenceKey' => $licenceKey,
            'pluginSlug' => $pluginSlug,
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

        if (!isset($response['body']['plugin'])) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Plugin not found'),
                array('status' => 503)));
        }

        $pluginData = $response['body']['plugin'];

        $info = $pluginService->install(array(
            'slug' => $pluginSlug,
            'plugin' => $pluginData,
            'activate' => true,
        ));

        $installed = isset($info['installed']) ? $info['installed'] : false;
        $log = isset($info['log']) ? $info['log'] : '';
        if (!$installed) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                $log,
                array('status' => 503)));
        }
        return apply_filters('zw/jsonResponse', array('message' => $log, 'version' => $pluginData["version"], 'installed' => $installed));
    }

    /**
     * @return mixed
     */
    public function actionActivate()
    {
        if (!\current_user_can('install_plugins')
            || !\current_user_can('activate_plugins')
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $pluginSlug = isset($_REQUEST['plugin']['slug']) ? $_REQUEST['plugin']['slug'] : null;
        if ($pluginSlug === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        // check exist plugin
        $pluginService = new PluginService();
        $exist = $pluginService->exist($pluginSlug);
        if (!$exist) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Plugin not Found'),
                array('status' => 503)));
        }

        if ($pluginService->isActive($pluginSlug)) {
            return apply_filters('zw/jsonResponse', array('message' => 'activated'));
        }
        $activatePlugin = $pluginService->activatePlugin($pluginSlug);
        if ($activatePlugin == null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Plugin Not Activated'),
                array('status' => 503)));
        }
        return apply_filters('zw/jsonResponse', array('message' => 'activated'));
    }

    /**
     * @return void|null
     */
    public function actionActivePlugins()
    {
        $plugins = isset($_REQUEST["plugins"]) ? $_REQUEST["plugins"] : null;
        if (!isset($plugins)) {
            return null;
        }
        $pluginService = new PluginService();
        for ($i = 0; $i < count($plugins); $i++) {
            if (!isset($plugins[$i]["slug"])) {
                continue;
            }
            $plugins[$i]["isActive"] = $pluginService->isActive($plugins[$i]["slug"]);
            $pluginInfo = $pluginService->info($plugins[$i]["slug"]);
            $plugins[$i]["isInstalled"] = isset($pluginInfo) && isset($pluginInfo["info"]) ? true : false;
            $plugins[$i]["currentVersion"] = isset($pluginInfo) && isset($pluginInfo["info"]) && isset($pluginInfo["info"]["Version"]) ? $pluginInfo["info"]["Version"] : null;
        }
        return apply_filters('zw/jsonResponse', isset($plugins) ? $plugins : array());
    }


    public function actionUpdate(){

        if (!\current_user_can('install_plugins')
            || !\current_user_can('activate_plugins')
        ) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                \esc_html__('You don\'t have permissions to do this', 'zw'),
                array('status' => 503)));
        }

        $licenceKey = isset($_REQUEST['licenceKey']) ? $_REQUEST['licenceKey'] : null;
        $pluginSlug = isset($_REQUEST['plugin']['slug']) ? $_REQUEST['plugin']['slug'] : null;

        if ($pluginSlug === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/plugins/get');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            '_rnd' => time(),
            'licenceKey' => $licenceKey,
            'pluginSlug' => $pluginSlug,
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

        if (!isset($response['body']['plugin'])) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Plugin not found'),
                array('status' => 503)));
        }

        // check exist plugin
        $pluginService = new PluginService();
        if ($pluginService->exist($pluginSlug)) {
            $pluginService->remove($pluginSlug);
        }

        $pluginData = $response['body']['plugin'];
        $info = $pluginService->install(array(
            'slug' => $pluginSlug,
            'plugin' => $pluginData,
            'activate' => true,
        ));

        $installed = isset($info['installed']) ? $info['installed'] : false;
        $log = isset($info['log']) ? $info['log'] : '';
        if (!$installed) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                $log,
                array('status' => 503)));
        }
        return apply_filters('zw/jsonResponse', array('message' => $log, 'installed' => $installed));

    }

}