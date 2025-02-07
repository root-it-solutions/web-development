<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class TRX extends AssetsHelper
{
    protected const BASE_URI = 'https://apilist.tronscanapi.com';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([ 'base_uri' => self::BASE_URI,
                                                    'headers'  => [
                                                        'TRON-PRO-API-KEY' => $_ENV['config']['explorerAPIKeys']['tronscan']
                                                    ]]);
    }

    public function getBalances(array $addresses, $coin = 'trx')
    {
        $balance = 0;
        $coin = strtolower($coin);

        foreach ($addresses as $address)
        {

                $response = json_decode($this->httpClient->request('GET', '/api/accountv2?address='.$address)->getBody()->getContents());

//                echo $response->totalFrozenV2.PHP_EOL;
//                echo $response->balance.PHP_EOL;
//                echo $response->totalFrozenV2 + $response->balance.PHP_EOL;
//                exit;
                if (0 < ($response->totalFrozenV2 + $response->balance))
                {
                    $balance += balanceFormat($coin, ($response->totalFrozenV2 + $response->balance));
                }
        }

        return $balance;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}