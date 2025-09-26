<?php

namespace zw;

use zw\components\Manager;

class Plugin
{
    public static $instance = null;
    const PREFIX = 'zw';
    public $components = null;
    public $filesManager = null;
    public $settings = null;
    public $externalConfig = [];


    /**
     * Plugin constructor.
     */
    private function __construct()
    {
        add_action('admin_init', array($this, 'pluginRedirects'));
        add_action('admin_menu', array($this, 'adminMenu'));
        add_action('admin_enqueue_scripts', array($this, 'registerAssets'));
        add_filter('plugin_action_links_' . ZW_PLUGIN_BASE, array($this, 'pluginActionLinks'));
        add_filter('upload_mimes', array($this, 'allowUploadXml'));

        $this->filesManager = new \zw\FilesManager(array(
            'baseSlug' => self::PREFIX
        ));
        $this->components = new Manager();
        $this->settings = new Settings();
    }

    /**
     * Add XML to alowed MIME types to upload
     *
     * @param array $mimes Allowed MIME-types.
     * @return array
     */
    public function allowUploadXml($mimes)
    {
        $mimes = array_merge($mimes, array('xml' => 'application/xml'));
        return $mimes;
    }

    /**
     * Plugin action links.
     * Adds ink to wizard strat page to the plugin list table
     * Fired by `plugin_action_links` filter.
     *
     * @param array $links An array of plugin action links.
     * @return array An array of plugin action links.
     */
    public function pluginActionLinks($links = array())
    {
        $start_page = sprintf(
            '<a href="%1$s">%2$s</a>',
            '/wp-admin/admin.php?page=gutenix-wizard',
            __('Start Page', 'zw')
        );
        array_unshift($links, $start_page);
        return $links;
    }

    /**
     * @return bool
     */
    public function registerAssets()
    {
        $asset = (new \zw\AssetManager())->register();
    }

    public function adminMenu()
    {
        add_menu_page(
            __('Gutenix Wizard', 'zw'),
            __('Gutenix Wizard', 'zw'),
            'manage_options',
            'gutenix-wizard',
            array($this, 'adminPageView'),
            ZW_URL . 'assets/images/zw-icon.svg',
            81
        );
    }

    /**
     * Admin Page View
     */
    public function adminPageView()
    {
        include Plugin::instance()->get_view('layout');
    }

    /**
     * Returns path to view file
     * @param string $path
     * @return mixed
     */
    public function get_view($path = '')
    {
        return apply_filters(
            self::PREFIX . '/get-view',
            \zw\helpers\File::normalizePath(ZW_PATH . 'views/' . $path . '.php')
        );
    }

    public function getWizardUrl($step = '')
    {
        return admin_url("admin.php?page=gutenix-wizard#/". $step);
    }

    /**
     * @return Plugin|null
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            do_action(self::PREFIX . '/loaded');
        }
        return self::$instance;
    }


    public function pluginRedirects()
    {
        if (!get_transient('gutenixWizardActivationRedirect')) {
            return;
        }
        delete_transient('gutenixWizardActivationRedirect');
        $storage = \zw\OptionStorage::get();
        $storage["wizardCompleted"] = isset($storage["wizardCompleted"]) ? $storage["wizardCompleted"] : false;
        if (!$storage["wizardCompleted"]) {
            \zw\OptionStorage::set($storage);
            wp_redirect($this->getWizardUrl("welcome"));
            die();
        }
        wp_redirect($this->getWizardUrl("license"));
        die();
    }

    public function addExternalConfig($config){
        $this->externalConfig = array_merge( $this->externalConfig, $config );
    }
}