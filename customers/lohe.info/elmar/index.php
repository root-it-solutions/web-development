<?php

// remove header for no caching
header_remove('ETag');
header_remove('Pragma');
header_remove('Cache-Control');
header_remove('Last-Modified');
header_remove('Expires');

// set header
header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

require "vendor/autoload.php";

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use MultipleChain\SolanaSDK\Connection;
use MultipleChain\SolanaSDK\SolanaRpcClient;

$cgCoinSymbols = 'bitcoin, ethereum, defichain, ethereum-classic, solana, pluton, cardano, dogecoin, litecoin, siacoin';

$marina = 0.09693437;

$cryptoAssets = [
    'btc'  => [
        'wallets' => [
            'bc1qxp5tkfa3n5lhyc78ej5rz2ph48t87e7zxmwjuh',
        ],
        'amount'  => (0.44826493 - $marina + (0.0623551 / 2)),
        'cgName'  => 'bitcoin',
    ],
    'etc'  => [
        'wallets' => [
            '',
        ],
        'amount'  => 15,
        'cgName'  => 'ethereum-classic',
    ],
    'eth'  => [
        'wallets' => [
            '',
        ],
        'amount'  => 0.2370112,
        'cgName'  => 'ethereum',
    ],
    'ltc'  => [
        'wallets' => [
            '',
        ],
        'amount'  => 2.34873,
        'cgName'  => 'litecoin',
    ],
    'sol'  => [
        'wallets' => [
            '',
        ],
        'amount'  => 22.946,
        'cgName'  => 'solana',
    ],
    'ada'  => [
        'wallets' => [
            '',
        ],
        'amount'  => 769.005,
        'cgName'  => 'cardano',
    ],
    'doge' => [
        'wallets' => [
            '',
        ],
        'amount'  => (972.878 + 1896),
        'cgName'  => 'dogecoin',
    ],
    'plu'  => [
        'wallets' => [
            '',
        ],
        'amount'  => (500.267 + 58 + 307),
        'cgName'  => 'pluton',
    ],
    'kas'  => [
        'wallets' => [
            '',
        ],
        'amount'  => 3457,
        'cgName'  => 'kaspa',
    ],
    'sc'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 95513,
        'cgName'  => 'siacoin',
    ],
];
$eurAmountTotal = 0;

$cgc = new CoinGeckoClient();
$cgPrices = $cgc->simple()->getPrice($cgCoinSymbols, 'usd,eur,btc');

$dataPointsArray_str = '';
$tableContent_str = '';

foreach ($cryptoAssets as $coin => $info)
{
    $coinUpper = strtoupper($coin);
    $eurValue = $info['amount'] * $cgPrices[$info['cgName']]['eur'];
    $eurAmountTotal += $eurValue;
//    $eurValue = number_format(($info['amount'] * $cgPrices[$info['cgName']['eur']]), 2, ',', '.');
    $dataPointsArray_str .= '{ y: ' . number_format($eurValue, 2, '.', '') . ', name: "' . $coinUpper . '" },';
    $tableContent_str .= '<tr><td>' . $coinUpper . '</td><td>' . number_format($eurValue, 8) . '</td><td>' . number_format($eurValue, 2, ',', '.') . ' &euro;</td></tr>';
}
/*
$amountBTC = 0.44826493 - $marina + (0.0623551 / 2);
$amountETC = 15;
$amountETH = 0.2370112;
$amountADA = 769.005;
$amountDOGE = 972.878 + 1896;
$amountLTC = 2.34873;
$amountSOL = 22.946;
$amountPLU = 500.267 + 58 + 307;
$amountKAS = 3457;


$eurAmountBTC = $amountBTC * $cgPrices[$cgMappingCoinSymbol['btc']]['eur'];
$eurAmountETC = $amountETC * $cgPrices[$cgMappingCoinSymbol['etc']]['eur'];
$eurAmountETH = $amountETH * $cgPrices[$cgMappingCoinSymbol['eth']]['eur'];
$eurAmountADA = $amountADA * $cgPrices[$cgMappingCoinSymbol['ada']]['eur'];
$eurAmountDOGE = $amountDOGE * $cgPrices[$cgMappingCoinSymbol['doge']]['eur'];
$eurAmountLTC = $amountLTC * $cgPrices[$cgMappingCoinSymbol['ltc']]['eur'];
$eurAmountSOL = $amountSOL * $cgPrices[$cgMappingCoinSymbol['sol']]['eur'];
$eurAmountPLU = $amountPLU * $cgPrices[$cgMappingCoinSymbol['plu']]['eur'];

$eurAmountTotal = $eurAmountBTC + $eurAmountETC + $eurAmountETH + $eurAmountADA + $eurAmountDOGE + $eurAmountLTC + $eurAmountSOL + $eurAmountPLU;
*/
//var_dump($cgPrices);
//echo $cgPrices['solana']['eur'].PHP_EOL;
//exit;
//$sdk = new Connection(new SolanaRpcClient(SolanaRpcClient::MAINNET_ENDPOINT));
//$accountInfo = $sdk->getBalance('6PkSHmbvTHSfaXb2DhHijhwkX7VsoFFVBvR3WBCaUJFd');
//$sdk->geasdfas
//var_dump($accountInfo);
$body = '<br />';
/*
foreach ($cgMappingCoinSymbol as $coin => $cgCoin)
{
    $coinUpper = strtoupper($coin);
    $eurValue = number_format(${'eurAmount' . $coinUpper}, 2, ',', '.');
//    $body .= $coinUpper . ': ' . ${'amount' . $coinUpper};
//    $body .= ' - ';
//    $body .=  $eurValue. ' EUR';
//    $body .= '<br /><br />';
    $dataPointsArray_str .= '{ y: ' . number_format(${'eurAmount' . $coinUpper}, 2, '.', '') . ', name: "' . $coinUpper . '" },';
    $tableContent_str .= '<tr><td>' . $coinUpper . '</td><td>' . number_format(${'amount' . $coinUpper}, 8) . '</td><td>' . $eurValue . ' &euro;</td></tr>';

}
*/
$tableContent_str .= '<tr class="total"><td>Total</td><td></td><td>' . number_format($eurAmountTotal, 2, ',', '.') . ' &euro;</td></tr>';
//$body .= 'Total: ' . number_format($eurAmountTotal, 2, ',', '.') . ' EUR';
//$body .= '<br />';
//$body .= '</body></html>';

$path_to_file = 'main.html';
$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace("{[[dataPointsArray]]}", $dataPointsArray_str, $file_contents);
$file_contents = str_replace("{[[tableContent]}}", $tableContent_str, $file_contents);
$file_contents = str_replace("{[[body]]}", $body, $file_contents);
echo $file_contents;
//echo $body;
