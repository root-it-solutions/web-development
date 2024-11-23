<?php

const BASE_DIR = __DIR__;

include BASE_DIR . "/inc/config.inc.php";
include BASE_DIR . "/inc/functions.inc.php";

$_SESSION["checkID"] = $_GET["userID"] != '' ? $_GET["userID"] : $_SESSION["userID"];
$_SESSION["checkIP"] = $_GET["userName"] != '' ? $_GET["userName"] : $_SESSION["userName"];

if ($urlOne == 'rl1144_X')
{
    include "tpl/admin.php";
}
else
{
    include "tpl/frontend.php";
}


