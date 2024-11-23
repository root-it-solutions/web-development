<?php

$remoteIP = getUserIpAddr();
//echo 'IP: ' . $remoteIP . '<br />';
//echo 'Host: ' . gethostbyaddr($remoteIP) . '<br />';

echo '<!DOCTYPE html>
<html>
<head>
    <title>Homun</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="author" content="Elmo">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
        #left-col {
            float: left;
            margin-left: 2.5%;
            width: 46.5%;
            text-align: justify;
        }

        #right-col {
            float: right;
            margin-right: 2.5%;
            width: 46.5%;
            text-align: justify;
        }
    </style>
</head>
<body classes="bodyclass">
<div id="left-col">
    <h3>IP Address</h3>
    <p>' . $remoteIP . '</p>
</div>
<div id="right-col">
    <h3>Host</h3>
    <p>' . gethostbyaddr($remoteIP) . '</p>
</div>
</body>
</html>';
function getUserIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}