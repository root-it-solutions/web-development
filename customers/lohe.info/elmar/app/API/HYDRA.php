<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class HYDRA extends AssetsHelper
{
    protected const BASE_URI = 'https://explorer.hydrachain.org';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([ 'base_uri' => self::BASE_URI ]);
    }

    public function getBalances(array $addresses, $coin = 'sc')
    {
        $balance = 0;
        $coin = strtolower($coin);

        foreach ($addresses as $address)
        {
            $response = json_decode($this->httpClient->request('GET', '/api/address/' . $address. '/balance')->getBody()->getContents());
//            var_dump($response);exit;
            if(0 < $response)
            {
                $balance += balanceFormat($coin, $response);
            }
        }
        return $balance;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}