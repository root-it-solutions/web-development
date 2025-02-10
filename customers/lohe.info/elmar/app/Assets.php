<?php

namespace App;

use App\ExchangeAssets;
use App\WalletAssets;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class Assets
{
    private CoinGeckoClient $cgc;
    private array $balances = [];

    public function __construct(&$balances, ?CoinGeckoClient $cgc = NULL)
    {
        $this->balances = &$balances;
        $this->cgc = $cgc ?: new CoinGeckoClient();
    }

    public function getBalances(array $wallets, array $exchangeAPIKeys)
    {
        $balancesExchanges = new ExchangeAssets($exchangeAPIKeys, $this->balances);
        $balancesExchanges->getBalances();
//        var_dump($this->balances);exit;
        $balancesWallets = new WalletAssets($wallets, $this->balances);
        $balancesWallets->getBalances();
//        var_dump($this->balances);exit;

        return $this->balances;
    }

    private function getPrices()
    {
//        $prices = $this->cgc->simple()->getPrice(implode(',', array_values($_ENV['config']['cgCoinMapping'])), 'usd,eur,btc');
    }
}