<?php

namespace zw;

use zw\helpers\ArrayHelper;

class OptionStorage
{
    const VERSION = 1;

    const NAME = 'gutenixWizardData';

    public static $instance = null;

    /**
     * @return array|mixed|null
     */
    public static function get()
    {
        if (self::$instance === null) {
            self::$instance = \get_option(self::NAME);
            self::$instance = json_decode(self::$instance, true);
        }
        self::$instance = !is_array(self::$instance) ? array() : self::$instance;
        return self::$instance;
    }

    /**
     * @param array $value
     * @return mixed
     */
    public static function set($value = array())
    {
        if (!isset($value['_version'])) {
            $value['_version'] = self::VERSION;
        }

        if (!isset($value['_createdAt'])) {
            $value['_createdAt'] = date('Y-m-d H:i:s');
        }

        if (!isset($value['_updatedAt'])) {
            $value['_updatedAt'] = date('Y-m-d H:i:s');
        }

        return \update_option(self::NAME, json_encode($value), 'no');
    }

    /**
     * @param string $key
     * @param array $value
     */
    public static function setByPath($key = '', $value = array())
    {
        self::$instance = self::get();;
        ArrayHelper::setValue(self::$instance, $key, $value);
        self::set(self::$instance);
    }

    /**
     * @return mixed
     */
    public static function remove()
    {
        return delete_option(self::NAME);
    }
}