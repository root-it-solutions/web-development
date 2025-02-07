<?php

namespace App;

abstract class AssetsHelper
{
    /**
     * @param $asset
     * @param $balance
     * @param array $balances
     * @return array
     */
    public function addBalanceToArray($asset, $balance, array $balances): array
    {
        $asset = strtoupper($asset);
        if ('USDT' !== $asset || 'EUR' !== $asset)
        {
            if (array_key_exists($asset, $balances))
            {
                $balances[$asset]['amount'] += $balance;
            }
            else
            {
                $balances[$asset]['amount'] = $balance;
                if(array_key_exists(strtolower($asset), $_ENV['config']['cgCoinMapping']))
                {
                    $balances[$asset]['cgName'] = $_ENV['config']['cgCoinMapping'][strtolower($asset)];
//                    var_dump($balances);exit;
                }
                else {
                    $balances[$asset]['cgName'] = '';
                }
            }
        }

        return $balances;
    }
}
//'btc'   => [
//        'wallets' => [
//            'bc1qxp5tkfa3n5lhyc78ej5rz2ph48t87e7zxmwjuh',
//        ],
//        'amount'  => (0.35134237 + 0.00464358 + 0.00041379),
//        'cgName'  => 'bitcoin',
//    ],