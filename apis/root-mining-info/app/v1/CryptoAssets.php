<?php

namespace v1;

use ccxt\binance;
use ccxt\ExchangeError;
use JetBrains\PhpStorm\Pure;

class CryptoAssets
{
    private $binancePriceTicker;
    private $binancePriceTickerArray;

    public function __construct()
    {
        $this->binancePriceTicker = (new binance([
            'apiKey' => $_ENV['BINANCE_API_KEY'],
            'secret' => $_ENV['BINANCE_API_SECRET'],
        ]))->fetch_tickers();
        $this->makeTickerArray();
    }

    private function getClassVars(): array
    {
        return array_keys(get_object_vars($this));
    }

    public function showCryptoAssetsCoinListForZabbixDiscovery()
    {
        $exchanges_array = $this->getEnvArrayValues('EXCHANGES');
        $exchanges_array_count = count($exchanges_array);
        $array[] = ['{#COINNAME}' => 'total'];
        for ($i = 0; $i < $exchanges_array_count; ++$i)
        {
            $exchange = $this->getExchangeApiConnection($exchanges_array[$i]);
            if (is_object($exchange))
            {
                $balances = $exchange->fetch_total_balance();
                foreach ($balances as $key => $value)
                {
                    if ($value > 0)
                    {
                        $coin = strtolower($key);
                        if (strlen($key) > 3 && str_starts_with($key, 'LD'))
                        {
                            $coin = strtolower(substr($key, 2));
                        }
                        if (!isset($this->$coin))
                        {
                            $this->$coin = 0;
                            $array[] = ['{#COINNAME}' => $coin];
                        }
                    }
                }
            }
        }
        return $array;
    }

    public function showCryptoAssetsBalances(): array
    {
        $exchanges_array = $this->getEnvArrayValues('EXCHANGES');
        $exchanges_array_count = count($exchanges_array);
        for ($i = 0; $i < $exchanges_array_count; ++$i)
        {
            $exchange = $this->getExchangeApiConnection($exchanges_array[$i]);
            if (is_object($exchange))
            {
                $balances = $exchange->fetch_total_balance();
                foreach ($balances as $key => $value)
                {
                    if ($value > 0)
                    {
                        $value = number_format($value, 8, '.', '');
                        if (strlen($key) > 3 && str_starts_with($key, 'LD'))
                        {
                            $coin = strtolower(substr($key, 2));
                            if (isset($this->$coin))
                            {
                                $this->$coin += $value;
                            }
                            else
                            {
                                $this->$coin = $value;
                            }
                        }
                        else
                        {
                            $coin = strtolower($key);
                            if (isset($this->$coin))
                            {
                                $this->$coin += $value;
                            }
                            else
                            {
                                $this->$coin = $value;
                            }
                        }
                    }
                }
            }// if (isset($_ENV[strtoupper($exchanges_array[$i]) . '_API_KEY']) && $_ENV[strtoupper($exchanges_array[$i]) . '_API_KEY'] != '' && isset($_ENV[strtoupper($exchanges_array[$i]) . '_API_SECRET']) && $_ENV[strtoupper($exchanges_array[$i]) . '_API_SECRET'] != '')
        }// for ($i = 0; $i < $exchanges_array_count; ++$i)
        return $this->toArray();
    }

    private function getExchangeApiConnection($exchangeName)
    {
        $exchange = '';
        if (isset($_ENV[strtoupper($exchangeName) . '_API_KEY']) && $_ENV[strtoupper($exchangeName) . '_API_KEY'] != '' && isset($_ENV[strtoupper($exchangeName) . '_API_SECRET']) && $_ENV[strtoupper($exchangeName) . '_API_SECRET'] != '')
        {
            $ccxtClass = "ccxt\\" . $exchangeName;
            $exchange = new $ccxtClass([
                'apiKey' => $_ENV[strtoupper($exchangeName) . '_API_KEY'],
                'secret' => $_ENV[strtoupper($exchangeName) . '_API_SECRET'],
            ]);
        }
        return $exchange;
    }

    private function getEnvArrayValues($envValue): array
    {
        return explode(',', $_ENV[$envValue]);
    }

    private function toArray(): array
    {
        $array = [];
        $totalBTC = 0;
        $totalUSDT = 0;
        $totalEUR = 0;
        foreach ($this->getClassVars() as $cvar)
        {
            if ($cvar !== 'binancePriceTicker' && $cvar !== 'binancePriceTickerArray')
            {
                $stdClass = new \stdClass;
                $stdClass->balance = number_format($this->$cvar, 8, '.', '');
                $coin = strtoupper($cvar);
                $btcPrice = $this->binancePriceTickerArray[$coin]['BTC'] ?? NULL;
                $eurPrice = $this->binancePriceTickerArray[$coin]['EUR'] ?? NULL;
                $usdtPrice = $this->binancePriceTickerArray[$coin]['USDT'] ?? NULL;
                if (is_null($btcPrice))
                {
                    $btcPrice = $this->binancePriceTickerArray['BTC'][$coin] ?? NULL;
                }
                if (is_null($usdtPrice))
                {
                    $usdtPrice = $this->binancePriceTickerArray['USDT'][$coin] ?? NULL;
                }
                if (is_null($eurPrice))
                {
                    $eurPrice = $this->binancePriceTickerArray['EUR'][$coin] ?? NULL;
                }

                $btcPrice = number_format($btcPrice, 8, '.', '');

                $stdClass->btc = floatval(number_format($stdClass->balance * $btcPrice, 8, '.', ''));
                $stdClass->usdt = floatval(number_format($stdClass->balance * $usdtPrice, 2, '.', ''));
                $stdClass->eur = floatval(number_format($stdClass->balance * $eurPrice, 2, '.', ''));
                if (is_null($eurPrice))
                {
                    $stdClass->eur = floatval(number_format($stdClass->usdt / $this->binancePriceTickerArray['EUR']['USDT'], 2, '.', ''));
                }

                if ($cvar === 'btc')
                {
                    $stdClass->btc = $stdClass->balance;
                }
                elseif ($cvar === 'usdt')
                {
                    $stdClass->usdt = floatval(number_format($stdClass->balance, 2, '.', ''));
                    $stdClass->btc = floatval(number_format($stdClass->balance / $btcPrice, 8, '.', ''));
                }
                elseif ($cvar === 'eur')
                {
                    $stdClass->btc = floatval(number_format($stdClass->balance / $btcPrice, 8, '.', ''));
                    $stdClass->eur = $stdClass->balance;
                    $stdClass->usdt = floatval(number_format($stdClass->balance / $usdtPrice, 2, '.', ''));
                }
                $array[$cvar] = $stdClass;
                $totalEUR = bcadd($stdClass->eur, $totalEUR, 2);
//                $diffBalance = bcsub($actualBalance, $walletAddresses_array[$i]->balance, 8);
                $totalBTC = bcadd(number_format($stdClass->btc, 8, '.', ''), $totalBTC, 8);
                $totalUSDT = bcadd($stdClass->usdt, $totalUSDT, 2);
            }
        }// foreach ($this->getClassVars() as $cvar)
        $stdClass = new \stdClass;
        $stdClass->balance = 0;
        $stdClass->btc = floatval(number_format($totalBTC, 8, '.', ''));
        $stdClass->usdt = floatval(number_format($totalUSDT, 2, '.', ''));
        $stdClass->eur = floatval(number_format($totalEUR, 2, '.', ''));
        $array['total'] = $stdClass;
        return $array;
    }

    private function makeTickerArray()
    {
        $array = [];
        foreach ($this->binancePriceTicker as $symbol => $values)
        {
            [$symbol1, $symbol2] = explode('/', $symbol);
            $array[$symbol1][$symbol2] = $values['ask'];
        }
        $this->binancePriceTickerArray = $array;
    }
}
