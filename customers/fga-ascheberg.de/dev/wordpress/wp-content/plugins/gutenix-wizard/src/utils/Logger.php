<?php

namespace zw\utils;

use zw\helpers\File;

class Logger
{
    public static $basePath = '';

    /**
     * Add warning message into log.
     *
     * @param string $message Log message.
     * @return void
     */
    public function warning($message = null)
    {
        self::log($message, 'warnings');
    }

    /**
     * Add info message into log.
     *
     * @param string $message Log message.
     * @return void
     */
    public function info($message = null)
    {
        self::log($message, 'info');
    }

    /**
     * Add notice message into log.
     *
     * @param string $message Log message.
     * @return void
     */
    public function notice($message = null)
    {
        self::log($message, 'notice');
    }

    /**
     * Add debug message into log.
     *
     * @param string $message Log message.
     * @return void
     */
    public function debug($message = null)
    {
        self::log($message, 'debug');
    }

    /**
     * Add error message into log.
     *
     * @param string $message Log message.
     * @return void
     */
    public function error($message = null)
    {
        self::log($message, 'error');
    }


    /**
     * @param string $message
     * @param string $type
     * @return null
     */
    public static function log($message = '', $type = 'info')
    {
        $dirLog = self::$basePath;
        $dirLog = File::normalizePath($dirLog);
        try {
            File::createDirectory($dirLog);
        } catch (\Exception $ex) {
            return null;
        }

        $pathFileLog = $dirLog . '/app-' . date('Y-m-d') . '.log';
        $pathFileLog = File::normalizePath($pathFileLog);
        if (!file_exists($pathFileLog)) {
            file_put_contents($pathFileLog, '');
            chmod($pathFileLog, 0755);
        }
        $log = '[' . date('Y-m-d H:i:s') . '] - ' . $type . PHP_EOL . $message . PHP_EOL . PHP_EOL;
        file_put_contents($pathFileLog, $log, FILE_APPEND);
    }
}