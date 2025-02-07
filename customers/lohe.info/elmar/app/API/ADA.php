<?php

namespace App\API;

use App\AssetsHelper;
use GuzzleHttp\Client;

class ADA extends AssetsHelper
{
    protected const BASE_URI = 'https://cardano-mainnet.blockfrost.io';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([ 'base_uri' => self::BASE_URI ]);
    }

    public function getBalances(array $addresses, $coin = 'ada')
    {
        $balance = 0;
        $coin = strtolower($coin);

        foreach ($addresses as $address)
        {
            if (str_contains($address, 'stake'))
            {
                $response = json_decode($this->httpClient->request('GET', '/api/v0/accounts/' . $address, [ 'headers' => [ "project_id" => $_ENV['config']['explorerAPIKeys']['blockfrost'] ] ])->getBody()->getContents());
                $balance += balanceFormat($coin, $response->controlled_amount);
            }
            else
            {
                $response = json_decode($this->httpClient->request('GET', '/api/v0/addresses/' . $address, [ 'headers' => [ "project_id" => $_ENV['config']['explorerAPIKeys']['blockfrost'] ] ])->getBody()->getContents());
                if('' !== $response->stake_address)
                {
                    $response = json_decode($this->httpClient->request('GET', '/api/v0/accounts/' . $response->stake_address, [ 'headers' => [ "project_id" => $_ENV['config']['explorerAPIKeys']['blockfrost'] ] ])->getBody()->getContents());
                    $balance += balanceFormat($coin, $response->controlled_amount);
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