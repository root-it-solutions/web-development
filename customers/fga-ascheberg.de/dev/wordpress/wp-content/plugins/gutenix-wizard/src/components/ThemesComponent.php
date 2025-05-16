<?php

namespace zw\components;

use zw\utils\Curl;

class ThemesComponent
{
    const PREFIX = 'themes';

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/install', array($this, 'actionInstall'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/activate', array($this, 'actionActivate'));

        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/install-child-theme', array($this, 'actionInstallAndActivateChildTheme'));
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
            if (!isset($item['typeTheme']) || !isset($item['slug'])) {
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

        $themeService = new \zw\services\ThemeService();
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

    public function actionInstallAndActivateChildTheme() {

        $childTheme = $_POST['childTheme'];

        if(!isset($childTheme['source'])) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                __('Bad Request'),
                array('status' => 503)));
        }

        $themeZIP = $childTheme['source'];
        $themeSlug = basename($themeZIP, '.zip');

        $themeService = new \zw\services\ThemeService();
        $themeExist = $themeService->exist($themeSlug);

        if (!$themeExist) {
            $rr = $themeService->install($themeZIP);
        }

        switch_theme($themeSlug);

        $response = array(
            'theme' => array(
                'slug' => $themeSlug,
                'isExist' => $themeService->exist($themeSlug) === null ? false : true,
                'isActivated' => $themeService->isActive($themeSlug),
            )
        );

        return apply_filters('zw/jsonResponse', $response);
    }
}
