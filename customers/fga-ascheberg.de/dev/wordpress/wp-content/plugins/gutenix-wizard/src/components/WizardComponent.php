<?php


namespace zw\components;

use zw\helpers\File;
use zw\utils\FileCache;
use zw\utils\Curl;

class WizardComponent
{
    const PREFIX = 'wizard';
    const SKIN_OPTION = 'gutenixSkin';

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/set', array($this, 'actionSet'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/facts', array($this, 'actionFacts'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/links', array($this, 'actionLinks'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/save-state', array($this, 'actionSaveState'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/get-state', array($this, 'actionGetState'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/set-skin-option', array($this, 'actionSetSkinOption'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/update-skin-install', array($this, 'actionUpdateSkinInstall'));
    }

    /**
     * @return mixed
     */
    public function actionSet()
    {
        $key = isset($_REQUEST['key']) ? $_REQUEST['key'] : null;
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'string';
        $value = isset($_REQUEST['value']) ? $_REQUEST['value'] : null;

        if ($key === null) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }
        \zw\OptionStorage::setByPath($key, $value);

        return apply_filters('zw/jsonResponse', array(
            'message' => 'update value'
        ));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionFacts()
    {
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
        $cacheRootDid = File::normalizePath(ZW_ROOT . '/runtime/cache');
        File::createDirectory($cacheRootDid);
        $cacheId = 'interest_facts';
        $cache = new FileCache(array(
            'name' => $cacheId,
            'path' => $cacheRootDid . DIRECTORY_SEPARATOR,
            'extension' => '.bin'
        ));
        $cache->eraseExpired();
        $items = $cache->retrieve($cacheId);

        if (!defined('ZW_ENABLE_CACHE') || ZW_ENABLE_CACHE === false) {
            $items = null;
        }

        if ($items === null) {
            $curl = new Curl();
            $curl->setURL(ZW_API . '/wp-content/uploads/static/interest-facts.json');
            $response = $curl->execute();
            $response = json_decode($response, true);
            $items = $response;
            $cache->store($cacheId, $items, 86400);
        }
        if (!is_array($items) || count($items) < 1) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        shuffle($items);
        $items = array_slice($items, 0, $limit);
        return apply_filters('zw/jsonResponse', array(
            'items' => $items
        ));
    }

    public function actionSaveState(){
        $state = isset($_REQUEST['state']) ? (bool)$_REQUEST['state'] : null;
        if (!isset($state)) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }
        $storage = \zw\OptionStorage::get();
        $storage["wizardCompleted"] = $state;
        \zw\OptionStorage::set($storage);
        return apply_filters('zw/jsonResponse', array(
            'message' => 'state saved'
        ));
    }

    public function actionGetState(){
        $storage = \zw\OptionStorage::get();
        $storage["wizardCompleted"] = isset($storage["wizardCompleted"]) ? $storage["wizardCompleted"] : false;
        return apply_filters('zw/jsonResponse', array(
            'state' => $storage["wizardCompleted"]
        ));
    }

    public function actionSetSkinOption(){
        $skin = isset($_POST['skin'])?$_POST['skin']:null;
        if(!isset($skin) || $skin === 'custom'){
            return apply_filters('zw/jsonResponse', array(
                'message' => "Skin is not set"
            ));
        }
        update_option(self::SKIN_OPTION, $skin);
        return apply_filters('zw/jsonResponse', array(
            'skin' => $skin
        ));
    }


    public function actionUpdateSkinInstall(){
        $skin = get_option(self::SKIN_OPTION, true);
        if($skin === "" || $skin ==="custom"){
            return apply_filters('zw/jsonResponse', array(
                'message' => "Skin slug is invalid"
            ));
        }
        \zw\OptionStorage::setByPath('skinInstall.slug', $skin);
        return apply_filters('zw/jsonResponse', array(
            'skin' => $skin
        ));
    }

    public function actionLinks(){
        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/links');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            '_rnd' => time(),
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
        if (!isset($response['body']['links'])||!is_array($response['body']['links'])) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        return apply_filters('zw/jsonResponse', array(
            'links' => $response['body']['links']
        ));
    }
}