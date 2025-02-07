<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class ARK extends AssetsHelper
{
    protected const BASE_URI = 'https://api.ark.io/';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([ 'base_uri' => self::BASE_URI ]);
    }

    public function getBalances(array $addresses, $coin = 'ark')
    {
        $balance = 0;
        $coin = strtolower($coin);

        foreach ($addresses as $address)
        {
            $response = json_decode($this->httpClient->request('GET', '/api/wallets/' . $address)->getBody()->getContents());
            if(0 < $response->data->balance)
            {
                $balance += balanceFormat($coin, $response->data->balance);
            }
        }
        return $balance;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}