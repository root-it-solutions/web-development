<?php

    define("mysql_server","mysql");    // Adresse der Datenbank
    define("mysql_name","db199475_2");    // Datenbankname
    define("mysql_user","db199475_2");    // Datenbankbenutzer
    define("mysql_pass","h2T6B3w6yH");    // Zugriffspasswort
    
    $db = new mysqli(mysql_server,mysql_user,mysql_pass,mysql_name);

    if(mysqli_connect_errno())
    {
        echo "db error";
        exit;
    }
    $GLOBALS["db"]->query("SET NAMES utf8;");
    $GLOBALS["db"]->query("SET character_set_connection = utf8;");
    $GLOBALS["db"]->query("SET character_set_client = utf8;");
    $GLOBALS["db"]->query("SET character_set_result = utf8;");
?>
