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

    public function getBalances(array $addresses, $coin = 'btc')
    {
        $balance = 0;
        $normalAddresses = [];
        $normalResponse = [];
        $coin = strtolower($coin);

//        echo implode(',', $addresses);exit;
//        var_dump(array_key_exists('3HVjNLMocGfcmsWZahiyiKauGC4Z2mUHsN', $_ENV['config']['assets']['multiplikator']));exit;
        if (str_contains(implode(',', $addresses), 'xpub'))
        {
            foreach ($addresses as $address)
            {
                if (str_contains($address, 'xpub'))
                {
                    $response = json_decode($this->httpClient->request('GET', '/' . $coin . '/xpub/' . $address . '?derive=segwit')->getBody()->getContents());
                    if (0 < $response->balance->confirmed)
                    {
                        if (array_key_exists($address, $_ENV['config']['assets']['multiplikator']))
                        {
                            $balance += balanceFormat($coin, $response->balance->confirmed * $_ENV['config']['assets']['multiplikator'][$address]);
                        }
                        else
                        {
                            $balance += balanceFormat($coin, $response->balance->confirmed);
                        }
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
            $normalResponse = json_decode($this->httpClient->request('GET', '/' . $coin . '/address/balances?addresses=' . implode(',',$addresses))->getBody()->getContents());
        }
        foreach ($normalResponse as $response)
        {
            if (0 < $response->confirmed)
            {
                if (array_key_exists($response->address, $_ENV['config']['assets']['multiplikator']))
                {
                    $balance += balanceFormat($coin, $response->confirmed * $_ENV['config']['assets']['multiplikator'][$response->address]);
                }
                else
                {
                    $balance += balanceFormat($coin, $response->confirmed);
                }
            }
        }

        return $balance;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}