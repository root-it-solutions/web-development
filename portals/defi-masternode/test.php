<?php
const mysql_server = '127.0.0.1';    // Adresse der Datenbank
const mysql_name = 'defi-info';                                // Datenbankname
const mysql_user = 'root';                                // Datenbankbenutzer
const mysql_pass = '2wsxdr5';

$db = new mysqli(mysql_server, mysql_user, mysql_pass, mysql_name);

if (mysqli_connect_errno())
{
    echo "db error";
    exit;
}


require_once 'RewardReduction.php';
require_once 'MasternodeInfo.php';
require_once 'DeFiChain.php';
require_once 'MnTmBlockCount.php';

$mn = new MnTmBlockCount('8HTgnmGVwpAwD5HqmC4fkhi6h1GAZpuzdj');

/*
// Fill reward reduction table
$startBlock = 926690;
$startReward = 132.7615348;
$blocksUntilNextReduction = 32690;
$percentageReduction = 1.658;

do
{
    echo $startBlock.' - '.$startReward."\n";
    $rr = new RewardReduction();
    $rr->block = $startBlock;
    $rr->reward = $startReward;
    $rr->insert();
    $startBlock += $blocksUntilNextReduction;
    $startReward = $startReward * ((100 - $percentageReduction) / 100);
} while ($startReward > 1);
*/


try
{
    $mn = new MasternodeInfo('8HTgnmGVwpAwD5HqmC4fkhi6h1GAZpuzdj', 4);
 //   $rr = new RewardReduction();
 //   echo $rr->getActualReward($mn->getLastMintedBlock())."\n";
 //   exit;
}
catch (Exception $e)
{
    var_dump($e);
    exit;
}
var_dump($mn);