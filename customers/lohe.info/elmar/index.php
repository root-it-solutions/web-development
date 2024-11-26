<?php

// remove header
header_remove('ETag');
header_remove('Pragma');
header_remove('Cache-Control');
header_remove('Last-Modified');
header_remove('Expires');

// set header
header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0',false);
header('Pragma: no-cache');

require "vendor/autoload.php";

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use MultipleChain\SolanaSDK\Connection;
use MultipleChain\SolanaSDK\SolanaRpcClient;

$cgMappingCoinSymbol = [
    'btc'  => 'bitcoin',
    'eth'  => 'ethereum',
//    'dfi'  => 'defichain',
    'etc'  => 'ethereum-classic',
    'sol'  => 'solana',
    'plu'  => 'pluton',
    'ada'  => 'cardano',
    'doge' => 'dogecoin',
    'ltc'  => 'litecoin',
];

$amountBTC = 0.678361 - 0.32703037 + (0.0623551 / 2);
$amountETC = 15;
$amountETH = 0.2370112;
$amountADA = 769.005;
$amountDOGE = 972.878;
$amountLTC = 2.34873;
$amountSOL = 22.946;
$amountPLU = 500.267 + 58 + 307;

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
//$sdk->geasdfas
//var_dump($accountInfo);
$dataPointsArray_str = '';
$tableContent_str = '';
$body = '<br />';

foreach ($cgMappingCoinSymbol as $coin => $cgCoin)
{
    $coinUpper = strtoupper($coin);
    $eurValue = number_format(${'eurAmount' . $coinUpper}, 2, ',', '.');
//    $body .= $coinUpper . ': ' . ${'amount' . $coinUpper};
//    $body .= ' - ';
//    $body .=  $eurValue. ' EUR';
//    $body .= '<br /><br />';
    $dataPointsArray_str .= '{ y: '.number_format(${'eurAmount' . $coinUpper},2, '.', '').', name: "'.$coinUpper.'" },';
    $tableContent_str .= '<tr><td>'.$coinUpper.'</td><td>'.number_format(${'amount' . $coinUpper}, 8).'</td><td>'.$eurValue.' &euro;</td></tr>';

}
$tableContent_str .= '<tr class="total"><td>Total</td><td></td><td>'.number_format($eurAmountTotal, 2, ',', '.').' &euro;</td></tr>';
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
