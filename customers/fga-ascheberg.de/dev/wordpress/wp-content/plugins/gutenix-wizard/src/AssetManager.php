<?php

namespace zw;

use zw\helpers\ArrayHelper;
use zw\helpers\NumberHelper;

class AssetManager
{
    public function register()
    {
        if(!isset($_REQUEST['page'])
            || $_REQUEST['page'] !== 'gutenix-wizard'
        ){
            return false;
        }


        $path = ZW_PATH . '/assets/dist/webpack-assets.json';
        $path = \zw\helpers\File::normalizePath($path);
        if (!file_exists($path)) {
            return false;
        }

        $content = file_get_contents($path);
        $assetWebpack = json_decode($content, true);
        $this->css($assetWebpack);
        $this->js($assetWebpack);
    }

    /**
     * @return array
     */
    public function jsVariable()
    {
        $memoryLimit = NumberHelper::unitToInt(ini_get('memory_limit')) / 1048576;
        $wpVersion = \get_bloginfo('version');

        $language = \get_bloginfo('language');
        $languageExplode = explode('-', mb_strtolower($language));

        $jsData = array(
            'environments' => array(
                'wp' => array(
                    'name' => \get_bloginfo('name'),
                    'url' => \get_bloginfo('url'),
                    'charset' => \get_bloginfo('charset'),
                    'version' => $wpVersion,
                    'versionNumber' => (float)$wpVersion,
                    'language' => $language,
                    'locale' => isset($languageExplode[0]) ? $languageExplode[0] : 'en',
                    'homeUrl' => home_url('/'),
                ),
                'php' => array(
                    'version' => defined('PHP_VERSION') ? \PHP_VERSION : '',
                    'versionNumber' => defined('PHP_VERSION_ID') ? \PHP_VERSION_ID : '',
                    'os' => defined('PHP_OS') ? \PHP_OS : '',
                    'osFamily' => defined('PHP_OS_FAMILY') ? \PHP_OS_FAMILY : '',
                    'maxExecutionTime' => (int)ini_get('max_execution_time'),
                    'memoryLimit' => $memoryLimit > 1 ? floor($memoryLimit) : round($memoryLimit, 1),
                )
            ),
            'urls' => array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
            ),
            'initialState' => array()
        );

        $options = \zw\OptionStorage::get();
        $licensekey = ArrayHelper::getValue($options, 'license.key');
        $typeInstall = ArrayHelper::getValue($options, 'typeInstall');
        $typeInstall = isset($typeInstall) ? $typeInstall : "free";
        $wizardCompleted = ArrayHelper::getValue($options, 'wizardCompleted');

        ArrayHelper::setValue($jsData, 'initialState.common.typeInstall', $typeInstall);
        ArrayHelper::setValue($jsData, 'initialState.common.tabTitle', 'License');
        ArrayHelper::setValue($jsData, 'initialState.common.wizardCompleted', $wizardCompleted);

        if ($typeInstall !== 'pro' && isset($options['license'])) {
            unset($options['license']);
            \zw\OptionStorage::set($options);
            $licensekey = null;
        }

        if ($licensekey !== null && $licensekey !== '') {
            ArrayHelper::setValue($jsData, 'initialState.licensekey.key', $licensekey);
        }

        if (isset($options['skinInstall'])) {
            ArrayHelper::setValue($jsData, 'initialState.skinInstall', $options['skinInstall']);
        }

        if (isset($options['pluginChoice']['plugins'])  && $options['pluginChoice']['plugins'] !== '') {
            ArrayHelper::setValue($jsData, 'initialState.pluginChoice.plugins', $options['pluginChoice']['plugins']);
        }

        return $jsData;
    }

    /**
     * @param array $assetWebpack
     * @return bool
     */
    public function js($assetWebpack = array())
    {
        if (!isset($assetWebpack['main']['js'])) {
            return false;
        }

        $jsData = $this->jsVariable();
        $url = ZW_URL . 'assets/dist/' . $assetWebpack['main']['js'];
        $url = str_replace('./', '/', $url);
        $prefix = \zw\Plugin::PREFIX;

        wp_register_script($prefix . '-js', $url, array('jquery'), false, true);
        wp_enqueue_script($prefix . '-js');
        wp_localize_script($prefix . '-js', $prefix . 'Data', $jsData);
    }

    /**
     * @param array $assetWebpack
     * @return bool
     */
    public function css($assetWebpack = array())
    {
        if (!isset($assetWebpack['main']['css'])) {
            return false;
        }

        $_path = $assetWebpack['main']['css'];
        $_path = str_replace('./', '', $_path);
        $url = ZW_URL . 'assets/dist/' . $_path;
        wp_enqueue_style(\zw\Plugin::PREFIX . '-css', $url);
    }
}
