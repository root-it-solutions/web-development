<?php


namespace zw\services;
use zw\utils\Curl;
use zw\helpers\File;
if (!class_exists('WP_Upgrader')) {
    include_once(\ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'class-wp-upgrader.php');
}
if (!function_exists('themes_api')) {
    include_once(ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'theme.php');
}

class ThemeService
{
    /**
     *
     * @param string $url
     * @return array
     */
    public function info()
    {
        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/info');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $response = $curl->execute();
        $response = json_decode($response, true);
        if (!isset($response['body']['theme'])) {
            return null;
        }
        return $response['body']['theme'];
    }


    /**
     *
     * @param string $url
     * @return array
     */
    public function install($url = '')
    {
        add_filter('upgrader_source_selection', array($this, 'adjustThemeDir'), 1, 3);

        $skin = new \WP_Ajax_Upgrader_Skin();
        $upgrader = new \Theme_Upgrader($skin);
        $result = $upgrader->install($url);

        remove_filter('upgrader_source_selection', array($this, 'adjustThemeDir'), 1);

        $data = array();
        $success = true;
        $message = esc_html__('The theme is succesfully installed. Activating...', 'zw');
        if (is_wp_error($result)) {

            $message = $result->get_error_message();
            $success = false;

        } elseif (is_wp_error($skin->result)) {
            if (!isset($skin->result->errors['folder_exists'])) {
                $message = $skin->result->get_error_message();
                $success = false;
            } else {
                $message = esc_html__('The theme has been already installed. Activating...', 'zw');
            }
        } elseif ($skin->get_errors()->get_error_code()) {
            $message = $skin->get_error_messages();
            $success = false;
        } elseif (is_null($result)) {
            global $wp_filesystem;
            $message = esc_html__('Unable to connect to the filesystem. Please confirm your credentials.', 'zw');
            // Pass through the error from WP_Filesystem if one was raised.
            if ($wp_filesystem instanceof WP_Filesystem_Base && is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code()) {
                $message = esc_html($wp_filesystem->errors->get_error_message());
            }
            $success = false;
        }

        return array(
            'success' => $success,
            'message' => $message,
        );
    }

    /**
     * Adjust the theme directory name.
     *
     * @param string $source Path to upgrade/zip-file-name.tmp/subdirectory/.
     * @param string $remote_source Path to upgrade/zip-file-name.tmp.
     * @param \WP_Upgrader $upgrader Instance of the upgrader which installs the theme.
     * @return string $source
     */
    public function adjustThemeDir($source, $remote_source, $upgrader)
    {
        global $wp_filesystem;

        if (!is_object($wp_filesystem)) {
            return $source;
        }

        // Ensure that is Wizard installation request
        if (empty($_REQUEST['action'])) {
            return $source;
        }

        // Check for single file plugins.
        $source_files = array_keys($wp_filesystem->dirlist($remote_source));
        if (1 === count($source_files) && false === $wp_filesystem->is_dir($source)) {
            return $source;
        }

        $css_key = array_search('style.css', $source_files);

        if (false === $css_key) {
            return $source;
        }

        $css_path = $remote_source . '/' . $source_files[$css_key];

        if (!file_exists($css_path)) {
            return $source;
        }

        $theme_data = get_file_data($css_path, array(
            'TextDomain' => 'Text Domain',
            'ThemeName' => 'Theme Name',
        ), 'theme');

        if (!$theme_data || !isset($theme_data['TextDomain'])) {
            return $source;
        }

        $theme_name = $theme_data['TextDomain'];
        $from_path = untrailingslashit($source);
        $to_path = untrailingslashit(str_replace(basename($remote_source), $theme_name, $remote_source));

        if (true === $wp_filesystem->move($from_path, $to_path)) {

            /**
             * Fires after reanming before returns result.
             */
            do_action('zw/source-rename-done', $theme_data);

            return trailingslashit($to_path);

        } else {
            return new WP_Error(
                'rename_failed',
                esc_html__('The remote plugin package does not contain a folder with the desired slug and renaming did not work.', 'zw'),
                array('found' => '', 'expected' => $theme_name)
            );

        }
        return $source;
    }

    /**
     * Check exist theme
     * @param string $name
     * @return \WP_Theme|null
     */
    public function exist($name = '')
    {
        $theme = wp_get_theme($name);
        if (!($theme instanceof \WP_Theme)) {
            return null;
        }
        if ($theme->errors() || !$theme->exists()) {
            return null;
        }
        return $theme;
    }

    /**
     * Is active theme
     * @param string $name
     * @return bool
     */
    public function isActive($name = '')
    {
        $theme = $this->exist($name);
        if ($theme === null) {
            return false;
        }

        $currentTheme = \wp_get_theme();
        if ($currentTheme->stylesheet === $name) {
            return true;
        }
        return false;
    }


    public function deleteTheme($name = ''){
        $pluginDir = WP_CONTENT_DIR  . '/themes/' . $name;
        if ( !is_dir( $pluginDir ) ) {
            return true;
        }
        File::deleteFiles($pluginDir);
        return true;
    }
}