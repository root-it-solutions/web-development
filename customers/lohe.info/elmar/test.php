<?php
require "vendor/autoload.php";

use App\API\OKLink;
use App\API\TRX;
use GuzzleHttp\Client;

/** @var array $config */
$_ENV['config'] = require __DIR__ . '/config.php';

//$client = new Client();
//
//$response = $client->request('GET', 'https://solana-wallet-portfolio-balance-api.p.rapidapi.com/user/total_balance?address=6PkSHmbvTHSfaXb2DhHijhwkX7VsoFFVBvR3WBCaUJFd', [
//    'headers' => [
//        'x-rapidapi-host' => 'solana-wallet-portfolio-balance-api.p.rapidapi.com',
//        'x-rapidapi-key' => 'eb40ec7ddemshc0eabeef5084356p163c58jsnacbdab5449e2',
//    ],
//]);
//
//echo $response->getBody();

//https://rpc.shyft.to?api_key=ZSC7GX72JJ93bHQe

$result = (new TRX())->getBalances(['TBpVJihegutgbrpBPrLmeRob7hmkoaRv27'], 'TRX');