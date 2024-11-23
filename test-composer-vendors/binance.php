<?php

// Load composer
use ccxt\binance;
use ccxt\ExchangeError;

require_once __DIR__ . '/vendor/autoload.php';

$binance_api_key = 'mxLwIwRLSUC007mmZBefl8WaeVPx19I8dcSG5Kr6uZkkiAHIX01y81sAF6qJB4bJ';
$binance_secret_key = 'M5puPxOxOU0Nu45BHAHxQTPlzmydc5TRpfKAPvGGf69qGiHmc5NubfOFco5pUbdS';
try
{
    $exchange = new binance([
        'apiKey' => $binance_api_key,
        'secret' => $binance_secret_key,
    ]);

    $price_ticker = $exchange->fetch_tickers([ 'ETH/EUR', 'BTC/EUR', 'ETC/EUR', 'RVN/USDT', 'BEAM/USDT', 'EUR/USDT' ]);
    /*
BEAM/USDT - 0.6445
RVN/USDT - 0.11332
BTC/EUR - 46561.75
ETH/EUR - 3118.09
EUR/USDT - 1.167
ETC/EUR - 47.09
     */
//    foreach ($price_ticker as $key => $value)
//    {
//        echo $key .' - '.$value['ask'].PHP_EOL;
//    }
    $balances = $exchange->fetch_total_balance();
/*
ETH - 0,34270000
BNB - 0,00000006
ETC - 115,14396385
RVN - 6.985,61474268
BEAM - 0,94134620
LDBTC - 0,06555500
LDUSDT - 1.370,03695058
LDETH - 0,00005073
LDEUR - 5.289,57941634
 */
    $price_eur_total = 0;
    foreach ($balances as $key => $value)
    {
        if($value > 0)
        {
            $price_eur = 0;
            switch ($key)
            {
                case 'ETH':
                case 'LDETH':
                    $price_eur = $value * $price_ticker['ETH/EUR']['ask'];
                    break;
                case 'ETC':
                    $price_eur = $value * $price_ticker['ETC/EUR']['ask'];
                    break;
                case 'USDT':
                case 'LDUSDT':
                    $price_eur = $value / $price_ticker['EUR/USDT']['ask'];
                    break;
                case 'BTC':
                case 'LDBTC':
                    $price_eur = $value * $price_ticker['BTC/EUR']['ask'];
                    break;
                case 'BEAM':
                    $price_eur = ($value * $price_ticker['BEAM/USDT']['ask']) / $price_ticker['EUR/USDT']['ask'];
                    break;
                case 'RVN':
                    $price_eur = ($value * $price_ticker['RVN/USDT']['ask']) / $price_ticker['EUR/USDT']['ask'];
                    break;
                case 'EUR':
                case 'LDEUR':
                    $price_eur += $value;
                    break;
            }
            echo $key .' - '.number_format($value, 8, ',', '.').' - '.$price_eur.' EUR'.PHP_EOL;
            $price_eur_total += $price_eur;
        }
    }
    echo 'Total in EUR: '.number_format($price_eur_total, 2, ',','.').PHP_EOL;
//    var_dump($exchange->fetch_total_balance());
} catch (ExchangeError $e)
{
    var_dump($e);
}