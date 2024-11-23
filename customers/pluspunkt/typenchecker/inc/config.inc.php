<?php
ob_start();
session_start();

setlocale(LC_MONETARY, 'de_DE');

$_SERVER["SCRIPT_URL"] = explode('?', $_SERVER["REQUEST_URI"]);
$_SERVER["SCRIPT_URL"] = $_SERVER["SCRIPT_URL"][0];

# DATENBANK
const mysql_server = 'mysql';
const mysql_name = 'db199475_4';
const mysql_user = 'db199475_4';
const mysql_pass = 'L3gV:jqjHjKw';

const PRAEFIX = 'typenchecker';
const DB_FRAGEN = PRAEFIX . '_fragen';
const DB_ANTWORTEN = PRAEFIX . '_antworten';

const UPLOAD_DIR = BASE_DIR . '/uploads';
const TEMP_DIR = BASE_DIR . '/uploads/tmp';

require_once(BASE_DIR . '/inc/classes/class.phpmailer.php');
require_once(BASE_DIR . '/inc/classes/class.smtp.php');
require_once(BASE_DIR . '/inc/classes/class.db.php');
$db = new c_db(mysql_server, mysql_user, mysql_pass, mysql_name);

######################################################################################################
## URL auslesen

//var_dump($_REQUEST);
// Get $_REQUEST["one"]
$urlOne = explode('.', $_REQUEST["one"]);
$urlOne = $urlOne[0];

// Get $_REQUEST["two"]
$urlTwo = explode('.', $_REQUEST["two"]);
$urlTwo = $urlTwo[0];

// Get $_REQUEST["three"]
$urlThree = explode('.', $_REQUEST["three"]);
$urlThree = $urlThree[0];

// Get $_REQUEST["four"]
$urlFour = explode('.', $_REQUEST["four"]);
$urlFour = $urlFour[0];

// Get $_REQUEST["five"]
$urlFive = explode('.', $_REQUEST["five"]);
$urlFive = $urlFive[0];

######################################################################################################
## Config auslesen

const SMTP_SERVER = 'sslout.df.eu';
const SMTP_PORT = '465';
const SMTP_USER = 'smtp@createoceans.com';
const SMTP_SSL = 'ssl';
const SMTP_PASSWORD = 'NJ;Yr!3c';
const SMTP_FROM_NAME = 'smtp@createoceans.com';
const SMTP_FROM_EMAIL = 'smtp@createoceans.com';
const SMTP_HEADER_IMG = '';
const BCC_MAILS = 'bcc@createoceans.com';

######################################################################################################
## Message
######################################################################################################

if (isset($_SESSION['success']))
{
    $show_success = '
<div class="alert alert-success" role="alert">
<strong><i class="fas fa-thumbs-up"></i></strong> | 
' . $_SESSION['success'] . '
</div>
';
    unset($_SESSION['success']);
}
if (isset($_SESSION['error']))
{
    $show_error = '
<div class="alert alert-danger" role="alert">
<strong><i class="fas fa-thumbs-down"></i></strong> | 
' . $_SESSION['error'] . '
</div>
';
    unset($_SESSION['error']);
}
$show_message = $show_success . $show_error;

$array_days["Mon"] = 'MO';
$array_days["Tue"] = 'DI';
$array_days["Wed"] = 'MI';
$array_days["Thu"] = 'DO';
$array_days["Fri"] = 'FR';
$array_days["Sat"] = 'SA';
$array_days["Sun"] = 'SO';

$array_hours[] = "06";
$array_hours[] = "07";
$array_hours[] = "08";
$array_hours[] = "09";
$array_hours[] = "10";
$array_hours[] = "11";
$array_hours[] = "12";
$array_hours[] = "13";
$array_hours[] = "14";
$array_hours[] = "15";
$array_hours[] = "16";
$array_hours[] = "17";
$array_hours[] = "18";
$array_hours[] = "19";
$array_hours[] = "20";
$array_hours[] = "21";

$array_pause[] = "15";
$array_pause[] = "30";
$array_pause[] = "45";
$array_pause[] = "60";
$array_pause[] = "75";
$array_pause[] = "90";
$array_pause[] = "105";
$array_pause[] = "120";

$array_posten[] = "Schule";
$array_posten[] = "Lehrgang";
$array_posten[] = "Lehrbauhof";
$array_posten[] = "Baustelle";
$array_posten[] = "Feiertag";
$array_posten[] = "Krankheit";
$array_posten[] = "Urlaub";
$array_posten[] = "Freistellung";
$array_posten[] = "Pause";
$array_posten[] = "Sonstiges";

$array_zeiten[] = "06:00";
$array_zeiten[] = "06:15";
$array_zeiten[] = "06:30";
$array_zeiten[] = "06:45";
$array_zeiten[] = "07:00";
$array_zeiten[] = "07:15";
$array_zeiten[] = "07:30";
$array_zeiten[] = "07:45";
$array_zeiten[] = "08:00";
$array_zeiten[] = "08:15";
$array_zeiten[] = "08:30";
$array_zeiten[] = "08:45";
$array_zeiten[] = "09:00";
$array_zeiten[] = "09:15";
$array_zeiten[] = "09:30";
$array_zeiten[] = "09:45";
$array_zeiten[] = "10:00";
$array_zeiten[] = "10:15";
$array_zeiten[] = "10:30";
$array_zeiten[] = "10:45";
$array_zeiten[] = "11:00";
$array_zeiten[] = "11:15";
$array_zeiten[] = "11:30";
$array_zeiten[] = "11:45";
$array_zeiten[] = "12:00";
$array_zeiten[] = "12:15";
$array_zeiten[] = "12:30";
$array_zeiten[] = "12:45";
$array_zeiten[] = "13:00";
$array_zeiten[] = "13:15";
$array_zeiten[] = "13:30";
$array_zeiten[] = "13:45";
$array_zeiten[] = "14:00";
$array_zeiten[] = "14:15";
$array_zeiten[] = "14:30";
$array_zeiten[] = "14:45";
$array_zeiten[] = "15:00";
$array_zeiten[] = "15:15";
$array_zeiten[] = "15:30";
$array_zeiten[] = "15:45";
$array_zeiten[] = "16:00";
$array_zeiten[] = "16:15";
$array_zeiten[] = "16:30";
$array_zeiten[] = "16:45";
$array_zeiten[] = "17:00";
$array_zeiten[] = "17:15";
$array_zeiten[] = "17:30";
$array_zeiten[] = "17:45";
$array_zeiten[] = "18:00";
$array_zeiten[] = "18:15";
$array_zeiten[] = "18:30";
$array_zeiten[] = "18:45";
$array_zeiten[] = "19:00";
$array_zeiten[] = "19:15";
$array_zeiten[] = "19:30";
$array_zeiten[] = "19:45";
$array_zeiten[] = "20:00";
$array_zeiten[] = "20:15";
$array_zeiten[] = "20:30";
$array_zeiten[] = "20:45";
$array_zeiten[] = "21:00";
$array_zeiten[] = "21:15";
$array_zeiten[] = "21:30";
$array_zeiten[] = "21:45";