<?php
/*
if ($_SERVER['REMOTE_ADDR'] === '185.55.75.180')
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
*/
const mysql_server = '127.0.0.1';                              // Adresse der Datenbank
const mysql_name = 'defi-info';                                // Datenbankname
const mysql_user = 'root';                                     // Datenbankbenutzer
const mysql_pass = '2wsxdr5';

$db = new mysqli(mysql_server, mysql_user, mysql_pass, mysql_name);

if (mysqli_connect_errno())
{
    echo "db error";
    exit;
}

$version = '0.2';

require_once 'RewardReduction.php';
require_once 'MasternodeInfo.php';
require_once 'DeFiChain.php';
require_once 'MnTmBlockCount.php';

$ownerAuthAddress = '8HTgnmGVwpAwD5HqmC4fkhi6h1GAZpuzdj';
##########################################################################
try
{
    $mn = new MasternodeInfo($ownerAuthAddress, 4);
    $rr = new RewardReduction();
    $mnTmBlockCount = new MnTmBlockCount($ownerAuthAddress);
} catch (Exception $e)
{
    var_dump($e);
    exit;
}
##########################################################################
if (!isset($_REQUEST["node"]))
{
    $nodeID = '1f14855989e59b7cf8469483f5cc3782cac7ba4ccb350413a72bf3d815d015fa';
}
elseif ($_REQUEST["node"] === 'test')
{
    $nodeID = '';
}

#########################################################################
// Calculate next reduction
$rr->getActualRewardReductionInfo($mn->getLastBlockNumber());
$rewardReductionPercent = 1.658;
$rewardReductionBlocks = 32690;
$nextRewardDfi = $rr->reward * ((100 - $rewardReductionPercent) / 100);
$nextBlockRewardReduction = $rr->block + $rewardReductionBlocks;
$blocksRemainingUntilReduction = $nextBlockRewardReduction - $mn->getLastBlockNumber();
$timeUntilNextReduction = $blocksRemainingUntilReduction * 30;
$dtF = new DateTime('@0');
$dtT = new DateTime("@$timeUntilNextReduction");
########################################################################

$rand = mt_rand();
echo '<!doctype html>';
echo <<<HTML
<head lang="de">
<meta charset="utf-8">
<title>DeFi Masternode Monitor v$version</title>
<link href="defi.css?ver=$rand" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
<link rel="stylesheet" href="https://material-icons.github.io/material-icons-font/css/all.css" />
</head>
<body>
HTML;
echo '<div class="card"><h6><i class="material-icons md-36 md-grid_view"></i> Minted Blocks</h6><h2>' . $mn->getMintedBlocks() . '</h2>';
echo '<h6>Last minted Block</h6><h2>' . $mn->getLastMintedBlock() . '</h2><span class="smallText">Time Last minted Block ' . $mn->getLastMintedBlockTime()->format('d.m.Y H:i:s') . '</span>';
echo '</div>';
echo '<div class="card"><h6>Target Multiplier (TM)</h6>';
echo '<h2 class="tm">' . $mn->getTm1Height() . ' | ' . $mn->getTm2Height() . ' | ' . $mn->getTm3Height() . ' | ' . $mn->getTm4Height() . '</h2>';
echo '<span class="smallText">&#216; ' . number_format(($mn->getTm1Height() + $mn->getTm2Height() + $mn->getTm3Height() + $mn->getTm4Height()) / 4, 1) . ' / Count: ' . ($mn->getTm1Height() + $mn->getTm2Height() + $mn->getTm3Height() + $mn->getTm4Height()) . '</span>';
echo '<h6>Blocks per TM</h6>';
echo '<h2 class="time">' . $mnTmBlockCount->tm1 . ' | ' . $mnTmBlockCount->tm2 . ' | ' . $mnTmBlockCount->tm3 . ' | ' . $mnTmBlockCount->tm4 . '</h2>';
echo '</div>';
echo '<div class="card"><h6><i class="material-icons md-36 md-emoji_events"></i> Rewards</h6><h2 class="time">' . number_format($mn->getTotalRewards(), 2, ',', '.') . ' DFI</h2>';
echo '<span class="smallText">' . number_format(($mn->getTotalRewards() / 20011) * 100, 2, ',', '.') . '% from 20.011 DFI</span>';
echo '<h6>per Owner</h6><h2 class="time">' . number_format(($mn->getTotalRewards() / 4), 2, ',', '.') . ' DFI</h2></div>';
echo '<div style="clear:both"></div>';

echo '<div class="card"><h6>&#216; time to find a Block</h6><h2>' . number_format($mn->getAvgTimeToFindBlock(), 2, ',', '.') . ' h</h2>';
echo '<h2>' . number_format($mn->getAvgTimeToFindBlock() / 24, 2, ',', '.') . ' d</h2>';
echo $mn->getLastMintedBlockTime()->add(new DateInterval('PT' . number_format($mn->getAvgTimeToFindBlock(), 0) . 'H'))->format('d.m.Y H:i:s');
echo '</div>';
echo '<div class="card"><h6>&#216; Blocks per Day</h6><h2>' . number_format($mn->getBlocskPerDay(), 2, ',', '.') . '</h2>';
echo '<table class="blocksPerDay"><thead><tr><th>7 Days</th><th>30 Days</th><th>1 Year</th></tr></thead>';
echo '<tbody><tr><td>' . number_format(($mn->getBlocskPerDay() * 7), 2, ',', '.') . '</td>';
echo '<td>' . number_format(($mn->getBlocskPerDay() * 30.5), 2, ',', '.') . '</td>';
echo '<td>' . number_format(($mn->getBlocskPerDay() * 365), 2, ',', '.') . '</td>';
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '<div class="card"><h6>Beta APR prognose</h6>("Avg. DFI per Year" / 20011 DFI) * 100<h2>' . number_format($mn->getApr(), 2, ',', '.') . ' %</h2></div>';

echo '<div style="clear:both"></div>';

echo '<div class="card"><h6><i class="material-icons md-36 md-trending_down"></i> Reward Reduction</h6>';
echo '<table class="rewardReduction">';
echo '<tr><td>Blocks Remaining</td><td class="alignright">' . number_format($blocksRemainingUntilReduction, 0, ',', '.') . ' <br /><span class="smallText">(' . $dtF->diff($dtT)->format('%d d, %H:%I:%S') . ')</span></td></tr>';
echo '<tr><td>At Block</td><td class="alignright">' . number_format($nextBlockRewardReduction, 0, ',', '.') . '</td></tr>';
echo '<tr><td>Current Reward</td><td class="alignright">' . number_format($rr->reward, 4, ',', '.') . ' DFI</td></tr>';
echo '<tr><td>Next Reward</td><td class="alignright">' . number_format($nextRewardDfi, 4, ',', '.') . ' DFI</td></tr>';
echo '</table></div>';

echo '<div style="clear:both"></div>';

echo '<div class="card"><h6><i class="material-icons md-36 md-rocket"></i> time Masternode</h6><h2 class="time">' . $mn->getCreationTime()->format('d.m.Y H:i:s') . '</h2></div>';
echo '<div class="card"><h6><i class="material-icons md-36 md-rocket"></i> block Masternode</h6><h2>' . $mn->getCreationBlock() . '</h2></div>';
echo '<div class="card"><h6><i class="material-icons md-36 md-history"></i> Masternode lifetime</h6><h2 class="time">' . $mn->getMasternodeLifetime()->format('%a days') . '<br />' . $mn->getMasternodeLifetime()->format('%H:%I:%S h') . '</h2></div>';

echo '<div style="clear:both"></div>';

echo '<div>If you like the service you can buy me a coffee:<br />';
echo 'DFI: dJCNjz9k46mcuLP4d3Br1G3dbEdP36gZrG<br />';
echo 'Sign Up on <a href="https://app.cakedefi.com" target="_blank">Cake DeFi</a> using my Referral (188056)<br />';
echo '<script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button" data-slug="elmarlovecoffee" data-color="#5F7FFF" data-emoji="" data-font="Cookie" data-text="Buy me a coffee" data-outline-color="#000000" data-font-color="#ffffff" data-coffee-color="#FFDD00" ></script></div>';
echo '</body>';
echo '</html>';

