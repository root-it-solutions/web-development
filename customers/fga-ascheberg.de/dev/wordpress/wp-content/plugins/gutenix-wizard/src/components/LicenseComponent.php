<?php

namespace zw\components;

use zw\helpers\ArrayHelper;
use zw\utils\Curl;

class LicenseComponent
{
    const PREFIX = 'license';

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/check', array($this, 'actionCheck'));
    }

    /**
     * @return mixed
     */
    public function getLicense()
    {
        $option = \zw\OptionStorage::get();
        return ArrayHelper::getValue($option, 'license.key');
    }

    /**
     * @return mixed
     */
    public function actionCheck()
    {
        $key = isset($_REQUEST['key']) ? $_REQUEST['key'] : null;

        if ($key === null || \zw\helpers\StringHelper::clean($key) === '') {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }
        $key = \zw\helpers\StringHelper::clean($key);

        $curl = new Curl();
        $url = ZW_API . '/wp-json/zemix-api/v1/licence/check';
        $curl->setURL($url);
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            'rnd' => time(),
            'key' => $key,
        ));
        $response = $curl->execute();
        $curlInfo = $curl->getCurlInfo();

        if (isset($curlInfo['http_code']) && $curlInfo['http_code'] !== 200) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Remote server is not responding.'),
                array('status' => 503)));
        }

        $response = json_decode($response,true);
        if (isset($response['body']['state']) && ($response['body']['state'] === 'active'
                || $response['body']['state'] === 'inactive'
                || $response['body']['state'] === 'expired')) {
            \zw\OptionStorage::setByPath('license.key', $key);
            \zw\OptionStorage::setByPath('typeInstall', 'pro');
        }
        return apply_filters('zw/jsonResponse', isset($response['body']) ? $response['body'] : array());
    }
}