<?php

require "vendor/autoload.php";

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use MultipleChain\SolanaSDK\Connection;
use MultipleChain\SolanaSDK\SolanaRpcClient;

$cgMappingCoinSymbol = [
    'etc' => 'ethereum-classic',
    'eth' => 'ethereum',
    'btc' => 'bitcoin',
    'dfi' => 'defichain',
    'sol' => 'solana',
    'ltc' => 'litecoin',
    'ada' => 'cardano'
];

//$cgc = new CoinGeckoClient();
//$cgPrices = $cgc->simple()->getPrice($cgMappingCoinSymbol['sol'].','.$cgMappingCoinSymbol['btc'], 'usd,eur,btc');
//var_dump($cgPrices);

$sdk = new Connection(new SolanaRpcClient(SolanaRpcClient::MAINNET_ENDPOINT));
$accountInfo = $sdk->getBalance('6PkSHmbvTHSfaXb2DhHijhwkX7VsoFFVBvR3WBCaUJFd');
//$sdk->getasds
//var_dump($accountInfo);