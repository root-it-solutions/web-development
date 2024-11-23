<?php

use ccxt\binance;
use ccxt\ExchangeError;

require_once __DIR__ . '/vendor/autoload.php';

$version = '0.1';

$rand = mt_rand();

$binance_api_key = 'mxLwIwRLSUC007mmZBefl8WaeVPx19I8dcSG5Kr6uZkkiAHIX01y81sAF6qJB4bJ';
$binance_secret_key = 'M5puPxOxOU0Nu45BHAHxQTPlzmydc5TRpfKAPvGGf69qGiHmc5NubfOFco5pUbdS';
try
{
    $url = 'https://api.root-it.solutions/v1/cryptoAssets';

    //Kontext für file_get_contents setzen und somit self signed Zertifikate erlauben
    $context = [
        'http' => [
            'method' => 'GET'
        ],
        'ssl'  => [
            'verify_peer'       => true,
            'allow_self_signed' => true
        ]
    ];
    $context = stream_context_create($context);

    $obj = json_decode(@file_get_contents($url, false, $context));
    $html = '';
    foreach ($obj as $key => $value)
    {
        if($key !== 'total')
        {
            $html .= '<tr><td>' . $key . '</td><td class="textRight paddingLeft">' . number_format($value->balance, 2, ',', '.') . '</td><td>Binance</td><td class="textRight paddingLeft">' . number_format($value->eur, 2, ',', '.') . ' EUR</td></tr>';
        }
    }
//    $html .= '<tr><td>BTC</td><td class="textRight paddingLeft">' . number_format(0.08017576, 2, ',', '.') . '</td><td>Ledger</td><td class="textRight paddingLeft">' . number_format((0.08017576 * $price_ticker['BTC/EUR']['ask']), 2, ',', '.') . ' EUR</td></tr>';
//    $html .= '<tr><td>ETH</td><td class="textRight paddingLeft">' . number_format(7.05724356, 2, ',', '.') . '</td><td>Ledger</td><td class="textRight paddingLeft">' . number_format((7.05724356 * $price_ticker['ETH/EUR']['ask']), 2, ',', '.') . ' EUR</td></tr>';

//    $price_eur_total += (0.08017576 * $price_ticker['BTC/EUR']['ask']);
//    $price_eur_total += (7.05724356 * $price_ticker['ETH/EUR']['ask']);
//    echo 'Total in EUR: '.number_format($price_eur_total, 2, ',','.').PHP_EOL;
    $table_total = '<tfoot><tr class="total"><td></td><td></td><th scope="row" class="textRight">Total in EUR</th><td class="textRight paddingLeft">' . number_format($obj->total->eur, 2, ',', '.') . ' EUR</td></tr></tfoot>';

    echo '<!doctype html>';
    echo <<<HTML
<head lang="de">
<meta charset="utf-8">
<title>root Crypto Assets v$version</title>
<link href="style.css?ver=$rand" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
<link rel="stylesheet" href="https://material-icons.github.io/material-icons-font/css/all.css" />
</head>
<body>
<table class="blueTable">
<thead><tr><th>Coin</th><th>Amount</th><th>Location</th><th>Amount EUR</th></tr></thead>
<tbody>
HTML;

    echo $html;
    echo '</tbody>' . $table_total . '</table></body>';
    echo '</html>';
//    var_dump($exchange->fetch_total_balance());
} catch (ExchangeError $e)
{
    var_dump($e);
}