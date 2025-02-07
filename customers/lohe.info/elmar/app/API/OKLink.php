<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class OKLink extends AssetsHelper
{
    protected const BASE_URI = 'https://www.oklink.com';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([ 'base_uri' => self::BASE_URI,
                                                    'headers'  => [
                                                        'OK-ACCESS-KEY' => $_ENV['config']['explorerAPIKeys']['oklink']
                                                    ]]);
    }

    public function getBalances(array $addresses, $coin = 'doge')
    {
        $balance = 0;
        $coin = strtolower($coin);

        foreach ($addresses as $address)
        {

                $response = json_decode($this->httpClient->request('GET', '/api/v5/explorer/address/address-summary?chainShortName='.$coin.'&address='.$address)->getBody()->getContents());
//                var_dump($response);exit;
                if (0 < $response->data[0]->balance)
                {
                    $balance += balanceFormat($coin, $response->data[0]->balance);
                }
        }

        return $balance;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}