<?php /**
 * @return void
 */

//if ($_SERVER['REMOTE_ADDR'] === '185.55.75.180')
//if ($_SERVER['REMOTE_ADDR'] === '109.43.112.76')
//{
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//}

require "vendor/autoload.php";

removeHeaderForNoCaching();

use App\API\Bybit;
use App\Assets;
use App\API\BTCBCH;
use App\ExchangeAssets;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

use MultipleChain\SolanaSDK\Connection;
use MultipleChain\SolanaSDK\SolanaRpcClient;

// Load all configuration options in Global $_ENV Variable
/** @var array $config */
$_ENV['config'] = require __DIR__ . '/config.php';

$cgc = new CoinGeckoClient();

//$bla = [];
//$test = new ExchangeAssets($_ENV['config']['assets']['exchanges'],$bla);
//$test->bybit();
//exit;
//$test = new HasKoinClient();
////var_dump($test->getBalances('xpub6CSURMs5EsTmUrgNBtGzxsJSBPrRjLXBKSrbKTjYetD8zcNy9KkugB2SZMz5zczjjCfLgWw6potbqkbaR8xSoD4a77YrvzGPCH9J5W13NzF', 'btc'));
////exit;
//var_dump($test->getBalances('xpub6CSURMs5EsTmUrgNBtGzxsJSBPrRjLXBKSrbKTjYetD8zcNy9KkugB2SZMz5zczjjCfLgWw6potbqkbaR8xSoD4a77YrvzGPCH9J5W13NzF,bc1qxp5tkfa3n5lhyc78ej5rz2ph48t87e7zxmwjuh,bc1q3d4s4lz6s4xvdtjznqvn47alea4774unux8aa9', 'btc'));
//////var_dump($test->getBalances('bc1qxp5tkfa3n5lhyc78ej5rz2ph48t87e7zxmwjuh', 'btc'));
//exit;
/*//######################################################################################################################
// Coinbase
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;

$coinbase = Coinbase::withApiKey($_ENV['config']['assets']['exchanges']['coinbase']['apiKey'], $_ENV['config']['assets']['exchanges']['coinbase']['secret']);
echo 'Balance: ' . $coinbase->getBalance() . '<br>';
exit;
//######################################################################################################################*/

//######################################################################################################################
$balances = [
    'SHIB' => [
        'amount' => 2311442, //ByBit Earn
        'cgName' => 'shiba-inu',
    ],
    'DOGE' => [
        'amount' => 1896.83, //ByBit Earn
        'cgName' => 'dogecoin',
    ],
    'SOL' => [
        'amount' => 1.74480786, // Blockchain.com
        'cgName' => 'solana',
    ],
    'ETH' => [
        'amount' => 0.04616509, // Blockchain.com
        'cgName' => 'ethereum',
    ]
];
$assets = new Assets($balances);

//echo implode(',', array_values($_ENV['config']['cgCoinMapping']));exit;
//var_dump($assets->getBalances($_ENV['config']['assets']['wallets'], $_ENV['config']['assets']['exchanges']));
//exit;

$cgCoinSymbols = 'bitcoin,ethereum,defichain,ethereum-classic,solana,pluton,cardano,dogecoin,litecoin,siacoin,kaspa,ark,hydra,tron';

$marina = 0.09693437;

//$cryptoAssets = [
////    'btc'   => [
////        'wallets' => [
////            'bc1qxp5tkfa3n5lhyc78ej5rz2ph48t87e7zxmwjuh',
////        ],
////        'amount'  => (0.35134237 + 0.00464358 + 0.00041379),
////        'cgName'  => 'bitcoin',
////    ],
////    'etc'   => [
////        'wallets' => [
////            '',
////        ],
////        'amount'  => 15 + 27.17877301,
////        'cgName'  => 'ethereum-classic',
////    ],
////    'eth'   => [
////        'wallets' => [
////            '',
////        ],
////        'amount'  => 0.00638006 + 0.04289475 + 0.00314482,
////        //        'amount'  => 0.2370112,
////        'cgName'  => 'ethereum',
////    ],
////'ltc'   => [
////    'wallets' => [
////        '',
////    ],
////    'amount'  => 2.34873,
////    'cgName'  => 'litecoin',
////],
////'sol'   => [
////    'wallets' => [
////        '',
////    ],
////    'amount'  => 23.2706 + 0.19636986 + 1.54079391 + 0.352468693,
////    'cgName'  => 'solana',
////],
////    'ada'   => [
////        'wallets' => [
////            '',
////        ],
////        'amount'  => 772.092,
////        'cgName'  => 'cardano',
////    ],
////'doge'  => [
////    'wallets' => [
////        '',
////    ],
////    'amount'  => (972.878 + 1899.83),
////    'cgName'  => 'dogecoin',
////],
//'plu' => [
//    'wallets' => [
//        '',
//    ],
//    'amount'  => (500.267 + 58 + 367.76),
//    'cgName'  => 'pluton',
//],
//'kas' => [
//    'wallets' => [
//        '',
//    ],
//    'amount'  => 3457.51 + 107.915,
//    'cgName'  => 'kaspa',
//],
////'sc'    => [
////    'wallets' => [
////        '',
////    ],
////    'amount'  => 98624.5678,
////    'cgName'  => 'siacoin',
////],
////    'ark'   => [
////        'wallets' => [
////            'Aei4J7ceReK8DKq5fj1zZ5z36VprBXysoP',
////        ],
////        'amount'  => 2074,
////        'cgName'  => 'ark',
////    ],
////'hydra' => [
////    'wallets' => [
////        '',
////    ],
////    'amount'  => 1527.73,
////    'cgName'  => 'hydra',
////],
////'trx'   => [
////    'wallets' => [
////        '',
////    ],
////    'amount'  => 722,
////    'cgName'  => 'tron',
////],
//];
$eurAmountTotal = 0;


$cgPrices = $cgc->simple()->getPrice(implode(',', array_values($_ENV['config']['cgCoinMapping'])), 'usd,eur,btc');
//foreach ($cgc->coins()->getList() as $coin)
//{
//    if ($coin['symbol'] == 'amp')
//    {
//        var_dump($coin);
//    }
//}
//exit;
//$cgPrices = $cgc->simple()->getPrice('xrp', 'usd,eur,btc');
//var_dump($cgPrices);
//exit;

$dataPointsArray_str = '';
$tableContent_str = '';

foreach ($assets->getBalances($_ENV['config']['assets']['wallets'], $_ENV['config']['assets']['exchanges']) as $coin => $info)
{
    $coinUpper = strtoupper($coin);
    if(array_key_exists($info['cgName'], $cgPrices))
    {
        $eurValue = $info['amount'] * $cgPrices[$info['cgName']]['eur'];
    }
    else
    {
        $eurValue = 0;
    }
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