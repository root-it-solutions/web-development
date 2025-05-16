<?php
/**
 * Plugin Name: Gutenix Wizard
 * Plugin URI: https://gutenix.com
 * Description: This tool will help you automatically install Gutenix theme with all the necessary content and extra plugins.
 * Version: 1.0.6
 * Author: Gutenix
 * Author URI: https://gutenix.com
 * Text Domain: zw
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

if (!defined('WPINC')) {
    die();
}

error_reporting(E_ALL);

register_activation_hook(__FILE__, 'afterPluginActivation');
function afterPluginActivation(){
    set_transient('gutenixWizardActivationRedirect', true, 3600);
}

if (!version_compare(PHP_VERSION, '7.0', '>=')) {
    add_action('admin_notices', 'zwFailPhpVersion');
} elseif (!version_compare(get_bloginfo('version'), '5.0', '>=')) {
    add_action('admin_notices', 'zwFailWpVersion');
} else {
    add_action('plugins_loaded', 'zwInit');
}

/**
 * Admin notice for minimum PHP version.
 * @return void
 */
function zwFailPhpVersion()
{
    $message = 'Templates API requires PHP version 5.6+, plugin is currently NOT ACTIVE.';
    $html_message = sprintf('<div class="error">%s</div>', wpautop($message));
    echo wp_kses_post($html_message);
}

/**
 * Admin notice for minimum WordPress version.
 * @return void
 */
function zwFailWpVersion()
{
    $message = 'Gutenix Wizard requires WordPress version 4.6+. Because you are using an earlier version, the plugin is currently NOT ACTIVE.';
    $html_message = sprintf('<div class="error">%s</div>', wpautop($message));
    echo wp_kses_post($html_message);
}

/**
 * @return \zw\Plugin|null
 */
function zwInstance()
{
    \zw\utils\Logger::$basePath = dirname(__FILE__) . '/runtime/logs';
    return \zw\Plugin::instance();
}

/**
 * Initializes plugin on plugins_loaded hook
 * @return void
 */
function zwInit()
{
    define('ZW_PLUGIN_BASE', plugin_basename(__FILE__));
    define('ZW_PATH', plugin_dir_path(__FILE__));
    define('ZW_URL', plugins_url('/', __FILE__));
    define('ZW_ROOT', dirname(__FILE__));
    define('ZW_ENABLE_CACHE', true);
    define('ZW_API', 'https://admin.gutenix.com');
    require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
    zwInstance();
}

add_filter('zw/jsonResponse', 'zwJsonResponse', 10, 2);
function zwJsonResponse($value = null, $attr = null, $content = null)
{
    if ($value instanceof \WP_Error) {
        $errorData = $value->get_error_data();
        $statusCode = isset($errorData['status']) ? (int)$errorData['status'] : 503;
        \wp_send_json_error(array(
            'error' => array(
                'key' => $value->get_error_code(),
                'message' => $value->get_error_message(),
                'statusCode' => $statusCode,
            )
        ), $statusCode);
    } else {
        \wp_send_json_success($value);
    }
    wp_die();
    die();
}

function zemixDataImporterRegisterConfig($config = array()){
    zwInstance()->addExternalConfig( $config );
}
