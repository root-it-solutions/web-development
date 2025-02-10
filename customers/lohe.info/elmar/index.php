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

use App\Assets;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;


// Load all configuration options in Global $_ENV Variable
/** @var array $config */
$_ENV['config'] = require __DIR__ . '/config.php';

$cgc = new CoinGeckoClient();

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
    ],
    'LPT' => [
        'amount' => 2.1272887, // Ledger -> Explorer API dont show this Wallet
        'cgName' => 'livepeer',
    ]
];
$assets = new Assets($balances);
//var_dump($assets->getBalances($_ENV['config']['assets']['wallets'], $_ENV['config']['assets']['exchanges']));
//exit;
//$cgCoinSymbols = 'bitcoin,ethereum,defichain,ethereum-classic,solana,pluton,cardano,dogecoin,litecoin,siacoin,kaspa,ark,hydra,tron';

//$marina = 0.09693437;

$cryptoAssets = [
'kas' => [
    'wallets' => [
        '',
    ],
    'amount'  => 3457.51 + 107.915,
    'cgName'  => 'kaspa',
],
];


$cgPrices = $cgc->simple()->getPrice(implode(',', array_values($_ENV['config']['cgCoinMapping'])), 'usd,eur,btc');
//foreach ($cgc->coins()->getList() as $coin)
//{
//    if ($coin['symbol'] == 'kpol')
//    {
//        var_dump($coin);
//    }
//}
//exit;

$eurAmountTotal = 0;
$dataPointsArray_str = '';
$tableContent_str = '';
$tableContentNA_str = '';

foreach ($assets->getBalances($_ENV['config']['assets']['wallets'], $_ENV['config']['assets']['exchanges']) as $coin => $info)
{
    $coinUpper = strtoupper($coin);
    if(array_key_exists($info['cgName'], $cgPrices))
    {
        $eurValue = $info['amount'] * $cgPrices[$info['cgName']]['eur'];
        $eurAmountTotal += $eurValue;
        $dataPointsArray_str .= '{ y: ' . number_format($eurValue, 2, '.', '') . ', name: "' . $coinUpper . '" },';
        $tableContent_str .= '<tr><td>' . $coinUpper . '</td><td>' . number_format($info['amount'], 8) . '</td><td>' . $eurValue. '</td></tr>';
    }
    else
    {
        $eurValue = 'N/A';
        $tableContentNA_str .= '<tr><td>' . $coinUpper . '</td><td>' . number_format($info['amount'], 8) . '</td><td>' . $eurValue. '</td></tr>';
    }
//    $tableContent_str .= '<tr><td>' . $coinUpper . '</td><td>' . number_format($info['amount'], 8) . '</td><td>' . number_format($eurValue, 2, '.', ',') . '</td></tr>';
}

$body = '<br />';
$tableContent_str .= '<tfoot><tr class="total"><td>Total</td><td></td><td>' . number_format($eurAmountTotal, 2, ',', '.') . '</td></tr></tfoot>';

$path_to_file = 'main.html';
$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace("{[[dataPointsArray]]}", $dataPointsArray_str, $file_contents);
$file_contents = str_replace("{[[tableContent]}}", $tableContent_str, $file_contents);
$file_contents = str_replace("{[[tableContentNA]}}", $tableContentNA_str, $file_contents);
$file_contents = str_replace("{[[body]]}", $body, $file_contents);
echo $file_contents;