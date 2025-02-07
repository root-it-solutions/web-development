<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class SOL extends AssetsHelper
{
    protected const BASE_URI = 'https://api.solanabeach.io';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([
            'base_uri' => self::BASE_URI,
            'headers'  => [
                'Authorization' => 'Bearer ' . $_ENV['config']['explorerAPIKeys']['solanabeach'],
            ],
        ]);
    }

    public function getBalances(array $addresses, $coin = 'sol')
    {
        $balance = 0;
        $coin = strtolower($coin);

        foreach ($addresses as $address)
        {

            $response = json_decode($this->httpClient->request('GET', '/v1/account/' . $address)->getBody()->getContents());
            if (0 < $response->value->base->balance)
            {
                $balance += balanceFormat($coin, $response->value->base->balance);
            }
            $response = json_decode($this->httpClient->request('GET', '/v1/account/' . $address . '/stakes')->getBody()->getContents());
            if (1 == $response->totalPages)
            {
                foreach ($response->data as $stake)
                {
                    $balance += balanceFormat($coin, $stake->lamports);
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