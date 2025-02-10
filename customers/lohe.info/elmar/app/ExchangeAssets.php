<?php

namespace App;

use App\API\Coinbase;
use ByBit\SDK\ByBitApi;
use KuCoin\SDK\Exceptions\HttpException;
use KuCoin\SDK\Exceptions\InvalidApiUriException;
use KuCoin\SDK\Auth;
use KuCoin\SDK\Exceptions\BusinessException;
use KuCoin\SDK\PrivateApi\Account;
use Binance\Spot as Binance;

class ExchangeAssets extends AssetsHelper
{
    private array $balances = [];
    private array $exchangeAPIKeys;

    public function __construct($exchangeAPIKeys, &$balances)
    {
        $this->exchangeAPIKeys = $exchangeAPIKeys;
        $this->balances = &$balances;
    }

    public function getBalances(): void
    {
        foreach ($this->exchangeAPIKeys as $exchange => $apiKey)
        {
            if ($apiKey['apiKey'] !== '')
            {
//                echo method_exists($this, $exchange);exit;
                if (method_exists($this, $exchange))
                {
                    $this->$exchange();
                }
            }
        }
    }

    private function binance(): void
    {
//        echo 'Exchange: Binance' . PHP_EOL;
        // Binance
        $client = new Binance(
            [
                'key'    => $this->exchangeAPIKeys['binance']['apiKey'],
                'secret' => $this->exchangeAPIKeys['binance']['secret'],
            ]
        );
        foreach ($client->account()['balances'] as $balance)
        {
            if ($balance['free'] > 0)
            {
                if (strlen($balance['asset']) > 3 && str_starts_with($balance['asset'], 'LD'))
                {
                    $balance['asset'] = substr($balance['asset'], 2);
                }
                $this->balances = $this->addBalanceToArray($balance['asset'], $balance['free'], $this->balances);
            }
        }
    }

    public function bybit(): void
    {// ByBit without Earnings Wallet - Bybit Does not support this
//        echo 'Exchange: Bybit' . PHP_EOL;
        // Binance
        $client = new ByBitApi(
            $this->exchangeAPIKeys['bybit']['apiKey'],
            $this->exchangeAPIKeys['bybit']['secret'],
        );
        $resultAsset = $client->assetApi()->getAllCoinsBalance([ 'accountType' => 'FUND' ]);
        $resultAccount = $client->accountApi()->getWalletBalance([ 'accountType' => 'UNIFIED' ]);

        foreach ($resultAsset['balance'] as $balance)
        {
            if ($balance['walletBalance'] > 0 && 'EUR' !== $balance['coin'])
            {
                $this->balances = $this->addBalanceToArray($balance['coin'], $balance['walletBalance'], $this->balances);
            }
        }
        foreach ($resultAccount['list'][0]['coin'] as $balance)
        {
            if ($balance['walletBalance'] > 0 && 'EUR' !== $balance['coin'])
            {
                $this->balances = $this->addBalanceToArray($balance['coin'], $balance['walletBalance'], $this->balances);
            }
        }
    }

    private function kucoin(): void
    {
//        echo 'Exchange: Kucoin' . PHP_EOL;
        // KuCoin
        $auth = new Auth(
            $this->exchangeAPIKeys['kucoin']['apiKey'],
            $this->exchangeAPIKeys['kucoin']['secret'],
            $this->exchangeAPIKeys['kucoin']['passphrase'],
            Auth::API_KEY_VERSION_V2);
        $api = new Account($auth);

        try
        {
            foreach ($api->getList([ 'type' => 'main' ]) as $balance)
            {
                if ($balance['balance'] > 0)
                {
                    $this->balances = $this->addBalanceToArray($balance['currency'], $balance['balance'], $this->balances);
                }
            }
        } catch (HttpException|BusinessException|InvalidApiUriException $e)
        {
            var_dump($e->getMessage());
        }
    }

    private function coinbase(): void
    {
        $coinbase = new Coinbase();
//        var_dump($coinbase->getBalance());exit;
        foreach ($coinbase->getBalance() as $account)
        {
//            var_dump($account);exit;
//            if($account->currency == 'SOL')
//            {
//                var_dump($account);exit;
//            }
//            echo $account->currency.PHP_EOL;
//            echo $account->available_balance->value.' - '.$account->hold->value.PHP_EOL;
//            $balance = $account->available_balance->value + $account->hold->value;
            if ($account->total_balance_crypto > 0)
            {
                $this->balances = $this->addBalanceToArray($account->asset, $account->total_balance_crypto, $this->balances);
            }
        }
    }
}