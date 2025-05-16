<?php


namespace zw\services;


use zw\utils\Curl;

class SkinService
{
    /**
     *
     * @param string $url
     * @return array
     */
    public function info($skinSlug = '')
    {
        $curl = new Curl();
        $curl->setURL(ZW_API . '/wp-json/zemix-api/v1/skins/info');
        $curl->setProxy('');
        $curl->setCURLOPT_POST(true);
        $curl->setCURLOPT_POSTFIELDS(array(
            '_rnd' => time(),
            'skinSlug' => $skinSlug,
        ));
        $response = $curl->execute();
        $response = json_decode($response, true);
        if (!isset($response['body']['skin'])) {
            return null;
        }
        return $response['body']['skin'];
    }
}