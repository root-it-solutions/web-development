<?php

namespace App;

use App\API\ADA;
use App\API\ARK;
use App\API\ETHETC;
use App\API\BTCBCH;
use App\API\HYDRA;
use App\API\OKLink;
use App\API\SC;
use App\API\SOL;
use App\API\TRX;

class WalletAssets extends AssetsHelper
{
    private array $balances = [];
    private array $wallets;

    public function __construct($wallets, &$balances)
    {
        $this->wallets = $wallets;
        $this->balances = &$balances;
    }

    public function getBalances(): void
    {
        foreach ($this->wallets as $coin => $wallets)
        {
            if (method_exists($this, 'get' . strtoupper($coin) . 'Balance') && is_callable($this->{'get' . strtoupper($coin) . 'Balance'}($wallets)))
            {
                $this->{'get' . strtoupper($coin) . 'Balance'}($wallets);
            }
        }
    }

    private function getBTCBalance(array $wallets): void
    {
        $result = (new BTCBCH())->getBalances($wallets, 'BTC');
        $this->balances = $this->addBalanceToArray('BTC', $result, $this->balances);
    }

    private function getARKBalance(array $wallets): void
    {
        $result = (new ARK())->getBalances($wallets, 'ARK');
        $this->balances = $this->addBalanceToArray('ARK', $result, $this->balances);
    }

    private function getETHBalance(array $wallets): void
    {
        $result = (new ETHETC())->getBalances($wallets, 'ETH', $this->balances);
        $this->balances = $this->addBalanceToArray('ETH', $result, $this->balances);
    }

    private function getETCBalance(array $wallets): void
    {
        $result = (new ETHETC())->getBalances($wallets, 'ETC', $this->balances);
        $this->balances = $this->addBalanceToArray('ETC', $result, $this->balances);
    }

    private function getADABalance(array $wallets): void
    {
        $result = (new ADA())->getBalances($wallets, 'ADA');
        $this->balances = $this->addBalanceToArray('ADA', $result, $this->balances);
    }

    private function getSCBalance(array $wallets): void
    {
        $result = (new SC())->getBalances($wallets, 'SC');
        $this->balances = $this->addBalanceToArray('SC', $result, $this->balances);
    }

    private function getDOGEBalance(array $wallets): void
    {
        $result = (new OKLink())->getBalances($wallets, 'DOGE');
        $this->balances = $this->addBalanceToArray('DOGE', $result, $this->balances);
    }

    private function getLTCBalance(array $wallets): void
    {
        $result = (new OKLink())->getBalances($wallets, 'LTC');
        $this->balances = $this->addBalanceToArray('LTC', $result, $this->balances);
    }

    private function getTRXBalance(array $wallets): void
    {
        $result = (new TRX())->getBalances($wallets, 'TRX');
        $this->balances = $this->addBalanceToArray('TRX', $result, $this->balances);
    }

    private function getSOLBalance(array $wallets): void
    {
        $result = (new SOL())->getBalances($wallets, 'SOL');
        $this->balances = $this->addBalanceToArray('SOL', $result, $this->balances);
    }

    private function getHYDRABalance(array $wallets): void
    {
        $result = (new HYDRA())->getBalances($wallets, 'HYDRA');
        $this->balances = $this->addBalanceToArray('HYDRA', $result, $this->balances);
    }
}