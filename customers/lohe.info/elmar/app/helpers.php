<?php
date_default_timezone_set('Europe/Berlin');

function removeHeaderForNoCaching(): void
{
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
}

function IsNullOrEmptyString(string|null $str): bool
{
    return $str === NULL || trim($str) === '';
}

function balanceFormat($coin, $balance)
{
    $coin = strtoupper($coin);

    if ($coin === 'BTC' || $coin === 'ARK' || $coin === 'HYDRA')
    {
        $balance = str_pad($balance, 9, '0', STR_PAD_LEFT);

        return substr_replace($balance, '.', (strlen($balance) - 8), 0);
    }
    elseif ($coin === 'ETH' || $coin === 'ETC')
    {
        $balance = str_pad($balance, 19, '0', STR_PAD_LEFT);

        return substr_replace($balance, '.', (strlen($balance) - 18), 0);
    }
    elseif ($coin === 'ADA' || $coin === 'TRX')
    {
        $balance = str_pad($balance, 7, '0', STR_PAD_LEFT);

        return substr_replace($balance, '.', (strlen($balance) - 6), 0);
    }
    elseif ($coin === 'SC')
    {
        $balance = sprintf("%.0f", $balance);
        $balance = mb_substr($balance, 0, strlen($balance) - 12);

        return substr_replace($balance, '.', (strlen($balance) - 12), 0);
    }
    elseif ($coin === 'SOL')
    {
        $balance = str_pad($balance, 10, '0', STR_PAD_LEFT);

        return substr_replace($balance, '.', (strlen($balance) - 9), 0);
    }
    else
    {
        return $balance;
    }
}