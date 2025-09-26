<?php


namespace zw\components;

if (!function_exists('get_file_description')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
}

class Manager
{
    private $components;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->components = array(
            'license' => \zw\components\LicenseComponent::class,
            'wizard' => \zw\components\WizardComponent::class,
            'themes' => \zw\components\ThemesComponent::class,
            'skins' => \zw\components\SkinsComponent::class,
            'plugins' => \zw\components\PluginsComponent::class,
            'content' => \zw\components\ContentComponent::class,
            'thumbnails' => \zw\components\ThumbnailsComponent::class,
            'gutenix' => \zw\components\GutenixComponent::class,
            'export' => \zw\components\ExportComponent::class,
        );
        add_action('init', array($this, 'init'));
    }

    /**
     * Init
     */
    public function init()
    {
        if (wp_doing_ajax()) {
            $this->loadOnAjax();
        }
        $this->load('license');
    }

    /**
     * @return bool|mixed
     */
    public function loadOnAjax()
    {
        $component = isset($_REQUEST['_component']) ? $_REQUEST['_component'] : null;
        if ($component == null) {
            return false;
        }
        return $this->load($component);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function load($name = '')
    {
        if (!isset($this->components[$name])) {
            return false;
        }
        $className = $this->components[$name];
        if (!class_exists($className)) {
            return false;
        }
        return new $className;
    }
}