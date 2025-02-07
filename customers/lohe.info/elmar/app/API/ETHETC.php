<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class ETHETC extends AssetsHelper
{
    protected const BASE_URI = 'https://blockscout.com';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([ 'base_uri' => self::BASE_URI ]);
    }

    public function getBalances(array $addresses, $coin = 'eth')
    {
        $balance = 0;
        $coin = strtolower($coin);

        $response = json_decode($this->httpClient->request('GET', '/' . $coin . '/mainnet/api/?module=account&action=balancemulti&address=' . implode(',', $addresses))->getBody()->getContents());
        foreach ($response->result as $address)
        {
            if(0 < $address->balance)
            {
                $balance += balanceFormat($coin, $address->balance);
            }
        }
        return $balance;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}