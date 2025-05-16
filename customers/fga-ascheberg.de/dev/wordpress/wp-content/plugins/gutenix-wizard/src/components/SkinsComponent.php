<?php

namespace zw\components;

use zw\utils\Curl;

class SkinsComponent
{
    const PREFIX = 'skins';

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/list', array($this, 'actionList'));
    }

    /**
     * @return mixed
     */
    public function actionList()
    {
        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-content/uploads/static/wizard-skins.json');
        $response = $curl->execute();
        $curlInfo = $curl->getCurlInfo();
        if (isset($curlInfo['http_code']) && $curlInfo['http_code'] !== 200) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Remote server is not responding.'),
                array('status' => 503)));
        }
        $response = json_decode($response);
        return apply_filters('zw/jsonResponse', $response);
    }
}