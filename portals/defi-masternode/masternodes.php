<?php

define('mysql_server', '127.0.0.1');    // Adresse der Datenbank
define('mysql_name', 'defi-info');                                // Datenbankname
define('mysql_user', 'root');                                // Datenbankbenutzer
define('mysql_pass', '2wsxdr5');

$db = new mysqli(mysql_server, mysql_user, mysql_pass, mysql_name);

if (mysqli_connect_errno())
{
    echo "db error";
    exit;
}

include_once 'class_Masternode.php';

if (PHP_SAPI === 'cli')
{
    $mn = new Masternode;
    //truncate masternode_list_1 table for new data
    $mn->truncate();

    //get all masternodes from blockchain
    $json = shell_exec('/ris/defi/defi-node-001/defi-cli -rpcpassword=1qayse4 -datadir=/ris/defi/defi-node-001 listmasternodes');

    // json to stdobj
    $obj = json_decode($json);

    //Loop over every masternode and write it into the database
    foreach ($obj as $key => $value)
    {
        if ($value->state === 'ENABLED' || $value->state === 'PRE_ENABLED')
        {
            //Get some details from masternode
            $mnJson = shell_exec('/ris/defi/defi-node-001/defi-cli -rpcpassword=1qayse4 -datadir=/ris/defi/defi-node-001 getmasternode ' . $key);
            $mnObj = json_decode($mnJson);

            $mn = new Masternode;
            $mn->id = $key;
            $mn->ownerAuthAddress = $value->ownerAuthAddress;
            $mn->operatorAuthAddress = $value->operatorAuthAddress;
            $mn->creationHeight = $value->creationHeight;
            $mn->resignHeight = $value->resignHeight;
            $mn->state = $value->state;
            $mn->mintedBlocks = $value->mintedBlocks;
            if (isset($mnObj->$key->timelock))
            {
                $mn->timelock = $mnObj->$key->timelock;
            }

            if (isset($value->targetMultipliers))
            {
                $countTargetMultipliers = count($value->targetMultipliers);
                if ($countTargetMultipliers == 1)
                {
                    $mn->targetMultiplier1 = $value->targetMultipliers[0];
                    $mn->targetMultiplier2 = 0;
                    $mn->targetMultiplier3 = 0;
                    $mn->targetMultiplier4 = 0;
                }
                elseif ($countTargetMultipliers == 2)
                {
                    $mn->targetMultiplier1 = $value->targetMultipliers[0];
                    $mn->targetMultiplier2 = $value->targetMultipliers[1];
                    $mn->targetMultiplier3 = 0;
                    $mn->targetMultiplier4 = 0;
                }
                elseif ($countTargetMultipliers == 4)
                {
                    $mn->targetMultiplier1 = $value->targetMultipliers[0];
                    $mn->targetMultiplier2 = $value->targetMultipliers[1];
                    $mn->targetMultiplier3 = $value->targetMultipliers[2];
                    $mn->targetMultiplier4 = $value->targetMultipliers[3];
                }
                elseif ($countTargetMultipliers == 3)
                {
                    $mn->targetMultiplier1 = $value->targetMultipliers[0];
                    $mn->targetMultiplier2 = $value->targetMultipliers[1];
                    $mn->targetMultiplier3 = $value->targetMultipliers[2];
                    $mn->targetMultiplier4 = 0;
                }

            }
            else
            {
                $mn->targetMultiplier1 = 0;
                $mn->targetMultiplier2 = 0;
                $mn->targetMultiplier3 = 0;
                $mn->targetMultiplier4 = 0;
            }

            $mn->insert();
        }
    }// for
    $mn->rename();
}//if(PHP_SAPI === 'cli')
else
{
//         ini_set('display_errors', 1);
//         ini_set('display_startup_errors', 1);
//         error_reporting(E_ALL);

    $mn = new Masternode;
    $mnList_array = $mn->getMasternodes('', 'ORDER BY creationHeight DESC');
//         var_dump($mnList_array);exit;
    $mnList_array_count = count($mnList_array);

    $mnList_html = '';
    $mnCount10 = 0;
    $mnCount5 = 0;
    for ($i = 0; $i < $mnList_array_count; ++$i)
    {
        if ($mnList_array[$i]->ownerAuthAddress === '8HTgnmGVwpAwD5HqmC4fkhi6h1GAZpuzdj')
        {
            $mnList_html .= '<tr class="yellowBG">';
        }
        else
        {
            $mnList_html .= '<tr>';
        }
        if ($mnList_array[$i]->timelock === '10 years')
        {
            ++$mnCount10;
        }
        elseif ($mnList_array[$i]->timelock === '5 years')
        {
            ++$mnCount5;
        }
        $mnList_html .= '<td class="alignleft">' . $mnList_array[$i]->ownerAuthAddress . '</td>';
        $mnList_html .= '<td class="alignleft">' . $mnList_array[$i]->operatorAuthAddress . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->creationHeight . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->resignHeight . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->state . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->mintedBlocks . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->targetMultiplier1 . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->targetMultiplier2 . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->targetMultiplier3 . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->targetMultiplier4 . '</td>';
        $mnList_html .= '<td class="alignright">' . $mnList_array[$i]->timelock . '</td>';
        $mnList_html .= '</tr>';
    }
    $mn_html = <<<EOD
        <!doctype html> 
            <head>
                <title>DeFi Chain Masternode List</title>
EOD;
    $mn_html .= '<link href="defi.css?ver='.mt_rand().'" rel="stylesheet">';
    $mn_html .= '</head>            <body>';

    $mn_html .= '<table>';
    $mn_html .= '<tr><td>Enabled Masternodes: </td><td class="alignright">' . $mnList_array_count . '</td></tr>';
    $mn_html .= '<tr><td>Masternodes locked 10 years: </td><td class="alignright">' . $mnCount10 . '</td></tr>';
    $mn_html .= '<tr><td>Masternodes locked 5 years: </td><td class="alignright">' . $mnCount5 . '</td></tr>';
    $mn_html .= '</table>';
    $mn_html .= '<br /><br />';
    $mn_html .= <<<EOD
        <table class="masternodelist zebra">
            <thead>
                <tr>
                    <th>Owner Address</th>
                    <th>Operator Address</th>
                    <th>Creation Height</th>
                    <th>Resign Height</th>
                    <th>State</th>
                    <th>Minted Blocks</th>
                    <th>TM 1</th>
                    <th>TM 2</th>
                    <th>TM 3</th>
                    <th>TM 4</th>
                    <th>Timelock</th>
                </tr>
            </thead>
            <tbody>
EOD;
    $mn_html .= $mnList_html;
    $mn_html .= '</tbody></table></body></html>';

    echo $mn_html;
}
?>
