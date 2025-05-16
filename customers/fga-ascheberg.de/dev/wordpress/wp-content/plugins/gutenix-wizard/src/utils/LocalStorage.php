<?php


namespace zw\utils;


use zw\helpers\ArrayHelper;

class LocalStorage
{
    public static $storage = array();

    /**
     * Set value
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key = '', $value = null)
    {
        ArrayHelper::setValue(self::$storage, $key, $value);
    }

    /**
     * @param $key
     * @param null $defaultValue
     * @return mixed|null
     */
    public static function get($key = '', $defaultValue = null)
    {
        return ArrayHelper::getValue(self::$storage, $key, $defaultValue);
    }

    /**
     * Get content storage
     * @return array
     */
    public static function getAll()
    {
        return self::$storage;
    }

    /**
     * Clean all storage
     * @return array
     */
    public static function dispose()
    {
        self::$storage = array();
    }
}