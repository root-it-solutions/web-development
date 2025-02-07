<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class BTCBCH extends AssetsHelper
{
    protected const BASE_URI = 'https://api.haskoin.com';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([ 'base_uri' => self::BASE_URI ]);
    }

    public function getBalances(string $addresses, $coin = 'btc')
    {
        $balance = 0;
        $normalAddresses = [];
        $normalResponse = [];
        $coin = strtolower($coin);

        if (str_contains($addresses, 'xpub'))
        {
            foreach (explode(',', $addresses) as $address)
            {
                if (str_contains($address, 'xpub'))
                {
                    $response = json_decode($this->httpClient->request('GET', '/' . $coin . '/xpub/' . $address . '?derive=segwit')->getBody()->getContents());
                    if (0 < $response->balance->confirmed)
                    {
                        $balance += balanceFormat($coin, $response->balance->confirmed);
                    }

                }
                else
                {
                    $normalAddresses[] = $address;
                }
            }
            $normalAddresses = implode(',', $normalAddresses);

            if (!IsNullOrEmptyString($normalAddresses))
            {
                $normalResponse = json_decode($this->httpClient->request('GET', '/' . $coin . '/address/balances?addresses=' . $normalAddresses)->getBody()->getContents());
            }
        }
        else
        {
            $normalResponse = json_decode($this->httpClient->request('GET', '/' . $coin . '/address/balances?addresses=' . $addresses)->getBody()->getContents());
        }
        foreach ($normalResponse as $response)
        {
            if (0 < $response->confirmed)
            {
                $balance += balanceFormat($coin, $response->confirmed);
            }
        }

        return $balance;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}