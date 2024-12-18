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

$cgCoinSymbols = 'bitcoin,ethereum,defichain,ethereum-classic,solana,pluton,cardano,dogecoin,litecoin,siacoin,kaspa,ark,hydra,tron';

$marina = 0.09693437;

$cryptoAssets = [
    'btc'   => [
        'wallets' => [
            'bc1qxp5tkfa3n5lhyc78ej5rz2ph48t87e7zxmwjuh',
        ],
        'amount'  => (0.35134237 + 0.00464142),
        'cgName'  => 'bitcoin',
    ],
    'etc'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 15 + 5 + 27.17877301,
        'cgName'  => 'ethereum-classic',
    ],
    'eth'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 0.00636671 + 0.04279008,
        //        'amount'  => 0.2370112,
        'cgName'  => 'ethereum',
    ],
    'ltc'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 2.34873,
        'cgName'  => 'litecoin',
    ],
    'sol'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 22.946 + 0.350455642 + 1.43750988,
        'cgName'  => 'solana',
    ],
    'ada'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 769.005,
        'cgName'  => 'cardano',
    ],
    'doge'  => [
        'wallets' => [
            '',
        ],
        'amount'  => (972.878 + 1896),
        'cgName'  => 'dogecoin',
    ],
    'plu'   => [
        'wallets' => [
            '',
        ],
        'amount'  => (500.267 + 58 + 307),
        'cgName'  => 'pluton',
    ],
    'kas'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 3457,
        'cgName'  => 'kaspa',
    ],
    'sc'    => [
        'wallets' => [
            '',
        ],
        'amount'  => 96567,
        'cgName'  => 'siacoin',
    ],
    'ark'   => [
        'wallets' => [
            'Aei4J7ceReK8DKq5fj1zZ5z36VprBXysoP',
        ],
        'amount'  => 2046,
        'cgName'  => 'ark',
    ],
    'hydra' => [
        'wallets' => [
            '',
        ],
        'amount'  => 1522,
        'cgName'  => 'hydra',
    ],
    'trx'   => [
        'wallets' => [
            '',
        ],
        'amount'  => 721,
        'cgName'  => 'tron',
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
    $dataPointsArray_str .= '{ y: ' . number_format($eurValue, 2, '.', '') . ', name: "' . $coinUpper . '" },';
    $tableContent_str .= '<tr><td>' . $coinUpper . '</td><td>' . number_format($info['amount'], 8) . '</td><td>' . number_format($eurValue, 2, ',', '.') . ' &euro;</td></tr>';
}

$body = '<br />';
$tableContent_str .= '<tr class="total"><td>Total</td><td></td><td>' . number_format($eurAmountTotal, 2, ',', '.') . ' &euro;</td></tr>';

$path_to_file = 'main.html';
$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace("{[[dataPointsArray]]}", $dataPointsArray_str, $file_contents);
$file_contents = str_replace("{[[tableContent]}}", $tableContent_str, $file_contents);
$file_contents = str_replace("{[[body]]}", $body, $file_contents);
echo $file_contents;