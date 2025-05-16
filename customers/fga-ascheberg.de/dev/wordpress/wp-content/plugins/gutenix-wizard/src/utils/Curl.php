<?php

namespace zw\utils;

class Curl
{
    private $curl;
    private $options;

    /**
     * constructor.
     * @param null $url
     */
    public function __construct($url = null)
    {
        $this->curl = curl_init();
        $this->url = $url;
        $this->options = array();

        if ($url != null) {
            $this->setURL($url);
        }
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $this->options['CURLOPT_FOLLOWLOCATION'] = true;
        $this->options['CURLOPT_RETURNTRANSFER'] = true;
        $this->ignoreSSL();
    }

    /**
     * Ignoring SSL verification
     */
    public function ignoreSSL()
    {
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        $this->options['CURLOPT_SSL_VERIFYHOST'] = false;
        $this->options['CURLOPT_SSL_VERIFYPEER'] = false;
    }

    /**
     *
     */
    public function __destruct()
    {
        curl_close($this->curl);
    }

    /**
     * @param $proxy
     */
    public function setProxy($proxy = null)
    {
        curl_setopt($this->curl, CURLOPT_PROXY, $proxy);
        $this->options['CURLOPT_PROXY'] = $proxy;
    }

    /**
     * @param $url
     */
    public function setURL($url = '')
    {
        $this->options['CURLOPT_URL'] = $url;
        $this->url = $url;
        curl_setopt($this->curl, CURLOPT_URL, $url);
    }

    /**
     * @return array $result
     */
    public function execute()
    {
        $result = curl_exec($this->curl);
        return $result;
    }


    /**
     * @return void
     * @var bool $value
     */
    public function setCURLOPT_POST($value = '')
    {
        $this->options['CURLOPT_POST'] = $value;
        curl_setopt($this->curl, CURLOPT_POST, $value);
    }

    /**
     * @return void
     * @var string $value
     */
    public function setCURLOPT_POSTFIELDS($value = '')
    {
        $this->options['CURLOPT_POSTFIELDS'] = $value;
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $value);
    }


    /**
     * @return void
     * @var bool $value
     */
    public function setCURLOPT_HEADER($value = '')
    {
        $this->options['CURLOPT_HEADER'] = $value;
        curl_setopt($this->curl, CURLOPT_HEADER, $value);
    }

    /**
     * @return void
     * @var int $value
     */
    public function setCURLOPT_TIMEOUT($value = '')
    {
        $this->options['CURLOPT_TIMEOUT'] = $value;
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $value);
    }

    /**
     * @return void
     * @var int $value
     */
    public function setCURLOPT_CONNECTTIMEOUT($value = '')
    {
        $this->options['CURLOPT_CONNECTTIMEOUT'] = $value;
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $value);
    }

    /**
     * @return void
     * @var array $value
     */
    public function setCURLOPT_HTTPHEADER($value)
    {
        $this->options['CURLOPT_HTTPHEADER'] = $value;
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $value);
    }


    /**
     * @return array
     * @var int $index
     */
    public function getCurlInfo($index = null)
    {
        if ($index == null) {
            return curl_getinfo($this->curl);
        }
        return curl_getinfo($this->curl, $index);
    }

    /**
     * @return int
     */
    public function getCurlErrno()
    {
        $errno = curl_errno($this->curl);
        return $errno;
    }

    /**
     * @return string
     */
    public function getCurlError()
    {
        return curl_error($this->curl);
    }
}
