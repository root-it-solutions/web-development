<?php

namespace zw\utils;

use Exception;

class FileCache
{

    /**
     * The path to the cache file folder
     *
     * @var string
     */
    private $cachePath = 'cache/';

    /**
     * The name of the default cache file
     *
     * @var string
     */
    private $cacheName = 'default';

    /**
     * The cache file extension
     *
     * @var string
     */
    private $extension = '.bin';

    /**
     * Default constructor
     *
     * @param string|array [optional] $config
     * @return void
     */
    public function __construct($config = null)
    {
        if (true === isset($config)) {
            if (is_string($config)) {
                $this->setCache($config);
            } else if (is_array($config)) {
                $this->setCache($config['name']);
                $this->setCachePath($config['path']);
                $this->setExtension($config['extension']);
            }
        }
    }

    /**
     * Check whether data accociated with a key
     * @param $key
     * @return bool
     * @throws Exception
     */
    public function isCached($key)
    {
        if (false != $this->loadCache()) {
            $cachedData = $this->loadCache();
            return isset($cachedData[$key]['data']);
        }
    }

    /**
     * Store data in the cache
     * @param $key
     * @param $data
     * @param int $expiration
     * @return $this
     * @throws Exception
     */
    public function store($key, $data, $expiration = 0)
    {
        $storeData = array(
            'time' => time(),
            'expire' => $expiration,
            'data' => json_encode($data)
        );
        $dataArray = $this->loadCache();
        if (true === is_array($dataArray)) {
            $dataArray[$key] = $storeData;
        } else {
            $dataArray = array($key => $storeData);
        }
        $cacheData = json_encode($dataArray);
        file_put_contents($this->getCacheDir(), $cacheData);
        return $this;
    }

    /**
     * Retrieve cached data by its key
     * @param $key
     * @param bool $timestamp
     * @return mixed|null
     * @throws Exception
     */
    public function retrieve($key, $timestamp = false)
    {
        $cachedData = $this->loadCache();
        (false === $timestamp) ? $type = 'data' : $type = 'time';
        if (!isset($cachedData[$key][$type])) return null;
        return json_decode($cachedData[$key][$type], true);
    }

    /**
     * Retrieve all cached data
     * @param bool $meta
     * @return array|bool|mixed
     * @throws Exception
     */
    public function retrieveAll($meta = false)
    {
        if ($meta === false) {
            $results = array();
            $cachedData = $this->loadCache();
            if ($cachedData) {
                foreach ($cachedData as $k => $v) {
                    $results[$k] = json_decode($v['data'], true);
                }
            }
            return $results;
        }
        return $this->loadCache();
    }

    /**
     *  Erase cached entry by its key
     * @param $key
     * @return $this
     * @throws Exception
     */
    public function erase($key)
    {
        $cacheData = $this->loadCache();
        if (true === is_array($cacheData)) {
            if (true === isset($cacheData[$key])) {
                unset($cacheData[$key]);
                $cacheData = json_encode($cacheData);
                file_put_contents($this->getCacheDir(), $cacheData);
            }
            throw new Exception("Error: erase() - Key '{$key}' not found.");
        }
        return $this;
    }

    /**
     * Erase all expired entries
     * @return int
     * @throws Exception
     */
    public function eraseExpired()
    {
        $cacheData = $this->loadCache();
        if (true === is_array($cacheData)) {
            $counter = 0;
            foreach ($cacheData as $key => $entry) {
                if (true === $this->checkExpired($entry['time'], $entry['expire'])) {
                    unset($cacheData[$key]);
                    $counter++;
                }
            }
            if ($counter > 0) {
                $cacheData = json_encode($cacheData);
                file_put_contents($this->getCacheDir(), $cacheData);
            }
            return $counter;
        }
    }

    /**
     * Erase all cached entries
     * @return $this
     * @throws Exception
     */
    public function eraseAll()
    {
        $cacheDir = $this->getCacheDir();
        if (true === file_exists($cacheDir)) {
            $cacheFile = fopen($cacheDir, 'w');
            fclose($cacheFile);
        }
        return $this;
    }


    /**
     * Load appointed cache
     * @return bool|mixed
     * @throws Exception
     */
    private function loadCache()
    {
        if (true === file_exists($this->getCacheDir())) {
            $file = file_get_contents($this->getCacheDir());
            return json_decode($file, true);
        }
        return false;
    }

    /**
     * Get the cache directory path
     * @return string
     * @throws Exception
     */
    public function getCacheDir()
    {
        if (true === $this->_checkCacheDir()) {
            $filename = $this->getCache();
            $filename = preg_replace('/[^0-9a-z\.\_\-]/i', '', strtolower($filename));
            return $this->getCachePath() . $this->_getHash($filename) . $this->getExtension();
        }
        return null;
    }

    /**
     *  Get the filename hash
     * @param string $filename
     * @return string
     */
    private function _getHash($filename = '')
    {
        return sha1($filename);
    }

    /**
     * Check whether a timestamp is still in the duration
     *
     * @param integer $timestamp
     * @param integer $expiration
     * @return boolean
     */
    private function checkExpired($timestamp, $expiration)
    {
        $result = false;
        if ($expiration !== 0) {
            $timeDiff = time() - $timestamp;
            ($timeDiff > $expiration) ? $result = true : $result = false;
        }
        return $result;
    }

    /**
     * Check if a writable cache directory exists and if not create a new one
     * @return bool
     * @throws Exception
     */
    private function _checkCacheDir()
    {
        if (!is_dir($this->getCachePath()) && !mkdir($this->getCachePath(), 0775, true)) {
            throw new Exception('Unable to create cache directory ' . $this->getCachePath());
        } elseif (!is_readable($this->getCachePath()) || !is_writable($this->getCachePath())) {
            if (!chmod($this->getCachePath(), 0775)) {
                throw new Exception($this->getCachePath() . ' must be readable and writeable');
            }
        }
        return true;
    }

    /**
     * Cache path Setter
     *
     * @param string $path
     * @return object
     */
    public function setCachePath($path)
    {
        $this->cachePath = $path;
        return $this;
    }

    /**
     * Cache path Getter
     *
     * @return string
     */
    public function getCachePath()
    {
        return $this->cachePath;
    }

    /**
     * Cache name Setter
     *
     * @param string $name
     * @return object
     */
    public function setCache($name)
    {
        $this->cacheName = $name;
        return $this;
    }

    /**
     * Cache name Getter
     * @return string
     */
    public function getCache()
    {
        return $this->cacheName;
    }

    /**
     * Cache file extension Setter
     *
     * @param string $ext
     * @return object
     */
    public function setExtension($ext)
    {
        $this->extension = $ext;
        return $this;
    }

    /**
     * Cache file extension Getter
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }
}
