<?php

$seconds = 300;
//$from     = new \DateTime('@0');
//$to       = new \DateTime("@$seconds");
//$interval = $from->diff($to);
//var_dump($interval);
//$interval->format('%d days') . ' - ' . $interval->format('%H:%I:%S h')."\n";

$dtF = new \DateTime('@0');
$dtT = new \DateTime("@$seconds");
echo $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');