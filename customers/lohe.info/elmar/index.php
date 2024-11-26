<?php

require "vendor/autoload.php";

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use MultipleChain\SolanaSDK\Connection;
use MultipleChain\SolanaSDK\SolanaRpcClient;

$cgMappingCoinSymbol = [
    'etc'  => 'ethereum-classic',
    'eth'  => 'ethereum',
    'btc'  => 'bitcoin',
//    'dfi'  => 'defichain',
    'sol'  => 'solana',
    'ltc'  => 'litecoin',
    'ada'  => 'cardano',
    'doge' => 'dogecoin',
    'plu'  => 'pluton',
];

$amountBTC = 0.678361 - 0.32703037 + (0.0623551 / 2);
$amountETC = 15;
$amountETH = 0.2370112;
$amountADA = 769.005;
$amountDOGE = 972.878;
$amountLTC = 2.34873;
$amountSOL = 22.946;
$amountPLU = 500.267 + 58;

$cgc = new CoinGeckoClient();
$cgPrices = $cgc->simple()->getPrice($cgMappingCoinSymbol['plu'] . ',' . $cgMappingCoinSymbol['doge'] . ',' . $cgMappingCoinSymbol['etc'] . ',' . $cgMappingCoinSymbol['eth'] . ',' . $cgMappingCoinSymbol['ltc'] . ',' . $cgMappingCoinSymbol['ada'] . ',' . $cgMappingCoinSymbol['sol'] . ',' . $cgMappingCoinSymbol['btc'], 'usd,eur,btc');

$eurAmountBTC = $amountBTC * $cgPrices[$cgMappingCoinSymbol['btc']]['eur'];
$eurAmountETC = $amountETC * $cgPrices[$cgMappingCoinSymbol['etc']]['eur'];
$eurAmountETH = $amountETH * $cgPrices[$cgMappingCoinSymbol['eth']]['eur'];
$eurAmountADA = $amountADA * $cgPrices[$cgMappingCoinSymbol['ada']]['eur'];
$eurAmountDOGE = $amountDOGE * $cgPrices[$cgMappingCoinSymbol['doge']]['eur'];
$eurAmountLTC = $amountLTC * $cgPrices[$cgMappingCoinSymbol['ltc']]['eur'];
$eurAmountSOL = $amountSOL * $cgPrices[$cgMappingCoinSymbol['sol']]['eur'];
$eurAmountPLU = $amountPLU * $cgPrices[$cgMappingCoinSymbol['plu']]['eur'];

$eurAmountTotal = $eurAmountBTC + $eurAmountETC + $eurAmountETH + $eurAmountADA + $eurAmountDOGE + $eurAmountLTC + $eurAmountSOL + $eurAmountPLU;
//var_dump($cgPrices);
//echo $cgPrices['solana']['eur'].PHP_EOL;
//exit;
//$sdk = new Connection(new SolanaRpcClient(SolanaRpcClient::MAINNET_ENDPOINT));
//$accountInfo = $sdk->getBalance('6PkSHmbvTHSfaXb2DhHijhwkX7VsoFFVBvR3WBCaUJFd');
//$sdk->getasds
//var_dump($accountInfo);
echo '<html><head></head>';
echo '<body>';

foreach ($cgMappingCoinSymbol as $coin => $cgCoin)
{
    $coinUpper = strtoupper($coin);
    echo $coinUpper . ': ' . ${'amount' . $coinUpper};
    echo '<br />';
    echo number_format(${'eurAmount' . $coinUpper}, 2, ',', '.') . 'EUR';
    echo '<br />';
}
//echo 'ETH: ' . $amountETH . ' ETH';
//echo '<br />';
//echo number_format($eurAmountETH, 2, ',', '.') . 'EUR';
//echo '<br /><br />';
echo 'Total: ' . number_format($eurAmountTotal, 2, ',', '.') . ' EUR';
echo '<br />';
echo '</body></html>';