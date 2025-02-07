<?php

namespace App\API;

use GuzzleHttp\Client;

class Bybit
{
    protected const BASE_URI = 'https://api.bybit.com';
    private $timestamp;
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->timestamp = time() * 1000;
        $this->httpClient = $client ?: new Client([
            'base_uri'           => self::BASE_URI,
            'X-BAPI-API-KEY'     => $_ENV['config']['assets']['exchanges']['bybit']['apiKey'],
            'X-BAPI-TIMESTAMP'   => $this->timestamp,
            'X-BAPI-RECV-WINDOW' => 5000,
            'X-BAPI-SIGN-TYPE' => 2
        ]);
    }

    public function getBalances()
    {
        $endpoint = '/v5/asset/transfer/query-account-coins-balance';
        $params = 'accountType=SPOT';
        $params_for_signature = $this->timestamp . $_ENV['config']['assets']['exchanges']['bybit']['apiKey'] . "5000" . $params;
        $signature = hash_hmac('sha256', $params_for_signature, $_ENV['config']['assets']['exchanges']['bybit']['secret']);
        $response = json_decode($this->httpClient->request('GET', $endpoint . '&' . $params, [ 'X-BAPI-SIGN' => $signature ])->getBody()->getContents());
        var_dump($response);exit;
        return $response;
    }

}