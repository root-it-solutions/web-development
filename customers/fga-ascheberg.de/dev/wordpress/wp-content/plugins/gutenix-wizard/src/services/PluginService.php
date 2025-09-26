<?php


namespace zw\services;
use zw\helpers\File;
if (!function_exists('get_plugins')) {
    require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'plugin.php';
}

class PluginService
{
    /**
     *
     * @param string $url
     * @return array
     */
    public function install($params = array())
    {
        $plugin = isset($params['plugin']) ? $params['plugin'] : null;
        $activate = isset($params['activate']) ? $params['activate'] : true;

        /**
         * Hook fires before plugin installation.
         * @param array $plugin Plugin data array.
         */
        do_action('zw/before-plugin-install', $plugin);

        ob_start();
        $this->dependencies();
        $source = $this->locateSource($plugin);
        if (!$source) {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                \zw\components\PluginsComponent::PREFIX . '/error',
                __('Plugin source not found'),
                array('status' => 503)));
        }

        $installer = new \zw\services\PluginUpgrader(
            new \zw\services\PluginUpgraderSkin(
                array(
                    'url' => false,
                    'plugin' => $plugin['slug'],
                    'source' => $plugin['source'],
                    'title' => $plugin['name'],
                )
            )
        );
        $installed = $installer->install($source);
        $pluginActivate = $installer->plugin_info();

        $log = ob_get_clean();

        /**
         * Hook fires after plugin installation but before activation.
         * @param array $plugin Plugin data array.
         */
        do_action('zw/after-plugin-install', $plugin);

        return [
            'log' => $log,
            'installed' => $installed,
        ];
    }

    /**
     * Include dependencies.
     *
     * @return void
     */
    public function dependencies()
    {
        if (!class_exists('\\Plugin_Upgrader', false)) {
            require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'class-wp-upgrader.php';
        }
    }

    /**
     * Returns plugin installation source URL.
     *
     * @param array $plugin Plugin data.
     * @return string
     */
    public function locateSource($plugin = array())
    {
        $source = isset($plugin['source']) ? $plugin['source'] : 'wordpress';
        $result = false;
        $log = '';
        switch ($source) {
            case 'wordpress':
                require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'plugin-install.php'; // Need for plugins_api
                $api = plugins_api(
                    'plugin_information',
                    array(
                        'slug' => $plugin['slug'],
                        'fields' => array('sections' => false)
                    ));
                if (\is_wp_error($api)) {
                    $log = __('Plugins API error', 'zw') . ': ' . $api->get_error_message();
                    return false;
                }
                if (isset($api->download_link)) {
                    $result = $api->download_link;
                }
                break;
            case 'local':
                $result = !empty($plugin['path']) ? $plugin['path'] : false;
                break;
            case 'remote':
                $result = !empty($plugin['path']) ? \esc_url($plugin['path']) : false;
                break;
        }
        return $result;
    }

    /**
     * Activate plugin.
     *
     * @param string $activation_data Activation data.
     * @param string $slug Plugin slug.
     * @return WP_Error|null
     */
    public function activatePlugin($slug = '')
    {
        $pluginData = $this->info($slug);
        if ($pluginData === null) {
            return null;
        }

        if (!\is_plugin_active($pluginData['key'])) {
            \activate_plugin($pluginData['key']);
        }
        return true;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function exist($name = '')
    {
        $pluginData = \get_plugins('/' . $name);
        $pluginFiles = array_keys($pluginData);
        if (empty($pluginFiles)) {
            return false;
        }
        return true;
    }

    /**
     * Is active theme
     * @param string $name
     * @return bool
     */
    public function isActive($name = '')
    {
        $pluginData = \get_plugins('/' . $name);
        $pluginFiles = array_keys($pluginData);
        if (empty($pluginFiles) || !isset($pluginFiles[0])) {
            return false;
        }

        $pluginPath = $name . '/' . $pluginFiles[0];
        $activated = is_plugin_active($pluginPath);
        return $activated;
    }

    /**
     * @param string $name
     * @return array|null
     */
    public function info($name = '')
    {
        $pluginData = \get_plugins('/' . $name);
        $pluginFiles = array_keys($pluginData);
        if (empty($pluginFiles) || !isset($pluginFiles[0])) {
            return null;
        }
        return [
            'key' => $name . '/' . $pluginFiles[0],
            'info' => $pluginData[$pluginFiles[0]],
        ];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function remove($name = ''){
        $pluginDir = WP_PLUGIN_DIR . '/' . $name;
        if ( !is_dir( $pluginDir ) ) {
            return true;
        }
        File::deleteFiles($pluginDir);
        return true;
    }
}