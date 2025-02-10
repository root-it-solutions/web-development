<?php

namespace App\API;

use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;

class Coinbase
{
    protected const BASE_URI = 'https://api.coinbase.com';
//    protected const BASE_URI = 'https://api.cdp.coinbase.com';
    private Client $httpClient;

    public function __construct(?Client $client = NULL)
    {
        $this->httpClient = $client ?: new Client([
            'base_uri' => self::BASE_URI,
        ]);
    }

    public function getBalance()
    {
//        $this->httpClient->setDefaultOption(
//            'headers' => [
//            'Authorization' => 'Bearer ' . $this->buildJwt('/api/v3/brokerage/portfolios'),
//        ]);
        $portfolios = json_decode(
            $this->httpClient->request('GET', '/api/v3/brokerage/portfolios',
                [ 'headers' => [ 'Authorization' => 'Bearer ' . $this->buildJwt('/api/v3/brokerage/portfolios') ] ]
            )->getBody()->getContents(),
        );

//        var_dump($portfolios);
//        exit;

        $positions = [];
        foreach ($portfolios->portfolios as $portfolio)
        {
//            var_dump($portfolio);exit;
            $accounts = json_decode(
                $this->httpClient->request('GET', '/api/v3/brokerage/portfolios/'.$portfolio->uuid,
                    [ 'headers' => [ 'Authorization' => 'Bearer ' . $this->buildJwt('/api/v3/brokerage/portfolios/'.$portfolio->uuid) ] ]
                )->getBody()->getContents(),
            );
            $positions = array_merge($positions, $accounts->breakdown->spot_positions);
//            var_dump($accounts->breakdown->spot_positions);
        }
//        exit;
//        return json_decode($this->httpClient->request('GET', '/api/v3/brokerage/accounts/2a99ae60-ec7d-5b18-9c89-e6c3e1e417ec')->getBody()->getContents());
//        return json_decode($this->httpClient->request('GET', '/api/v3/brokerage/accounts?limit=250')->getBody()->getContents());
//        return json_decode($this->httpClient->request('GET', '/api/v3/brokerage/accounts/2d397664-1a8e-5046-8a7f-396900204b6f')->getBody()->getContents());
        return $positions;
    }

    private function buildJwt($request_path)
    {
        $keyName = $_ENV['config']['assets']['exchanges']['coinbase']['apiKey'];
        $keySecret = str_replace('\\n', "\n", $_ENV['config']['assets']['exchanges']['coinbase']['secret']);
        $request_method = 'GET';
        $url = 'api.coinbase.com';
//        $url = 'api.cdp.coinbase.com';
//        $request_path = '/api/v3/brokerage/portfolios';
//        $request_path = '/api/v3/brokerage/portfolios';

        $uri = $request_method . ' ' . $url . $request_path;
        $privateKeyResource = openssl_pkey_get_private($keySecret);
        if (!$privateKeyResource)
        {
            throw new Exception('Private key is not valid');
        }
        $time = time();
        $nonce = bin2hex(random_bytes(16));  // Generate a 32-character hexadecimal nonce
        $jwtPayload = [
            'sub' => $keyName,
            'iss' => 'cdp',
            'nbf' => $time,
            'exp' => $time + 120,  // Token valid for 120 seconds from now
            'uri' => $uri,
        ];
        $headers = [
            'typ'   => 'JWT',
            'alg'   => 'ES256',
            'kid'   => $keyName,  // Key ID header for JWT
            'nonce' => $nonce,  // Nonce included in headers for added security
        ];
        $jwtToken = JWT::encode($jwtPayload, $privateKeyResource, 'ES256', $keyName, $headers);

        return $jwtToken;
    }
}