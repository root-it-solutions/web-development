<?php
###################################################################################################################
## USER 
###################################################################################################################
/*function userinfo($userID)
{
    // HTML Output 
    global $db;

    $aData = "SELECT * FROM " . DB_USER . " WHERE id='" . $userID . "' ";
    $qData = $db->sql_query($aData);
    $Data = $db->sql_fetch_object($qData);

    $birthday = explode('-', $Data->birthday);
    $birthday = $birthday[2] . '.' . $birthday[1] . '.' . $birthday[0];

    //$aDataAdress = "SELECT * FROM ".DB_ADRESSES." WHERE user_id='".$Data->id."' AND type='main' ";
    //$qDataAdress = $db->sql_query($aDataAdress);
    //$DataAdress = $db->sql_fetch_object($qDataAdress);

    $salutation = $Data->anrede == 'm' ? 'Herr' : 'Frau';

    $imageExist = file_exists(BASE_DIR . '/uploads/user_images/' . $Data->id . '.jpg') ? '1' : '0';
    $image = file_exists(BASE_DIR . '/uploads/user_images/' . $Data->id . '.jpg') ? '/uploads/user_images/' . $Data->id . '.jpg' : '/template/images/noImage_' . $Data->gender . '.gif';
    $imageSmall = file_exists(BASE_DIR . '/uploads/user_images/' . $Data->id . '.jpg') ? '/uploads/user_images/' . $Data->id . '-small.jpg' : '/template/images/noImage_' . $Data->gender . '_20.gif';

    //$aDataUserClient = "SELECT * FROM ".DB_CLIENTS." WHERE id='".$Data->client_id."' ";
    // $qDataUserClient = $db->sql_query($aDataUserClient);
    // $DataUserClient = $db->sql_fetch_object($qDataUserClient);

    $user = [
        "id"                => $Data->id,
        "company_id"        => $Data->company_id,
        "client_id"         => $Data->client_id,
        "client_cryptname"  => $DataUserClient->cryptname,
        "client_name"       => $DataUserClient->name,
        "client_name_short" => $DataUserClient->nameShort,
        "type"              => $Data->type,
        "usermail"          => $Data->usermail,
        "password"          => $Data->password,
        "login"             => $Data->login,
        "gender"            => $Data->gender,
        "salutation"        => $salutation,
        "firstname"         => $Data->firstname,
        "name"              => $Data->name,
        "nameINI"           => $Data->nameINI,
        "address1"          => $DataAdress->address1,
        "address2"          => $DataAdress->address2,
        "zipcode"           => $DataAdress->zipcode,
        "city"              => $DataAdress->city,
        "country"           => $DataAdress->country,
        "phone"             => $DataAdress->phone,
        "mobile"            => $DataAdress->mobile,
        "fax"               => $DataAdress->fax,
        "email"             => $DataAdress->email,
        "web"               => $DataAdress->web,
        "birthday"          => $birthday,
        "position"          => $Data->position,
        "status"            => $Data->status,
        "imageExist"        => $imageExist,
        "image"             => $image,
        "imageSmall"        => $imageSmall,
        "lastlogin"         => $Data->lastlogin,
        "newsince"          => $Data->newsince,
        "lastchange"        => $Data->lastchange
    ];

    return $user;
}*/

###################################################################################################################
## KUNDE
###################################################################################################################
/*function clientinfo($clientID)
{
    // HTML Output
    global $db;

    $aData = "SELECT * FROM " . DB_CLIENTS . " WHERE id='" . $clientID . "' ";
    $qData = $db->sql_query($aData);
    $Data = $db->sql_fetch_object($qData);

    $aDataAdress = "SELECT * FROM " . DB_ADRESSES . " WHERE client_id='" . $Data->id . "' and type='main' ";
    $qDataAdress = $db->sql_query($aDataAdress);
    $DataAdress = $db->sql_fetch_object($qDataAdress);

    $nameShort = $Data->nameShort != '' ? $Data->nameShort : $Data->name;

    $char = strtolower($Data->name[0]);

    $sepa_iban_coded = $Data->sepa_iban;

    $clientID = str_pad($Data->clientID, 5, '0', STR_PAD_LEFT);

    $client = [
        "id"              => $Data->id,
        "company_id"      => $Data->company_id,
        "clientID"        => $clientID,
        "cryptname"       => $Data->cryptname,
        "name"            => $Data->name,
        "nameShort"       => $nameShort,
        "nameAddon"       => $Data->nameAddon,
        "char"            => $char,
        "info"            => $Data->info,
        "stundensatz"     => $Data->stundensatz,
        "ap_name"         => $Data->ap_name,
        "ap_firstname"    => $Data->ap_firstname,
        "ap_phone"        => $Data->ap_phone,
        "ap_email"        => $Data->ap_email,
        "ap_gender"       => $Data->ap_gender,
        "bills_receiver"  => $Data->bills_receiver,
        "bills_name"      => $Data->bills_name,
        "bills_firstname" => $Data->bills_firstname,
        "bills_gender"    => $Data->bills_gender,
        "bills_email"     => $Data->bills_email,
        "bills_type"      => $Data->bills_type,
        "bills_intervall" => $Data->bills_intervall,
        "bills_postway"   => $Data->bills_postway,
        "sepa_name"       => $Data->sepa_name,
        "sepa_iban"       => $Data->sepa_iban,
        "sepa_iban_coded" => $sepa_iban_coded,
        "sepa_bic"        => $Data->sepa_bic,
        "sepa_bank"       => $Data->sepa_bank,
        "address1"        => $DataAdress->address1,
        "address2"        => $DataAdress->address2,
        "zipcode"         => $DataAdress->zipcode,
        "city"            => $DataAdress->city,
        "county"          => $DataAdress->county,
        "county_name"     => $array_bundeslaender[$DataAdress->county],
        "country"         => $DataAdress->country,
        "country_name"    => $array_laender[$DataAdress->country],
        "phone"           => $DataAdress->phone,
        "fax"             => $DataAdress->fax,
        "email"           => $DataAdress->email,
        "web"             => $DataAdress->web,
        "user"            => $client_user,
        "newsince"        => $Data->newsince,
        "lastchange"      => $Data->lastchange
    ];

    return $client;
}*/

###################################################################################################################
## JOB
###################################################################################################################

/*function client_crypt($cn)
{
    // HTML Output
    global $db;

    $aData = "SELECT * FROM " . DB_CLIENTS . " WHERE cryptname='" . $cn . "' ";
    $qData = $db->sql_query($aData);
    $Data = $db->sql_fetch_object($qData);

    $return = $Data->id;

    return $return;
}

function user_crypt($cn)
{
    // HTML Output
    global $db;

    $aData = "SELECT * FROM " . DB_USER . " WHERE cryptname='" . $cn . "' ";
    $qData = $db->sql_query($aData);
    $Data = $db->sql_fetch_object($qData);

    $return = $Data->id;

    return $return;
}*/

/*function attachmentInfo($attachment_id)
{
    global $db;

    $aData = "SELECT * FROM " . DB_ATTACHMENTS . " WHERE id='" . $attachment_id . "' ";
    $qData = $db->sql_query($aData);
    $Data = $db->sql_fetch_object($qData);

    $path = UPLOAD_DIR . '/attachments/' . $Data->file_url;
    $url = 'http://my.createoceans.com/uploads/attachments/' . $Data->file_url;
    $preview_60_url = file_exists(UPLOAD_DIR . '/attachments/cover/' . $Data->id . '-60.png') ? 'http://my.createoceans.com/uploads/attachments/cover/' . $Data->id . '-60.png' : 'http://my.createoceans.com/template/images/preview60.png';
    $preview_200_url = file_exists(UPLOAD_DIR . '/attachments/cover/' . $Data->id . '-200.png') ? 'http://my.createoceans.com/uploads/attachments/cover/' . $Data->id . '-200.png' : 'http://my.createoceans.com/template/images/preview200.png';
    $preview_900_url = file_exists(UPLOAD_DIR . '/attachments/cover/' . $Data->id . '-900.png') ? 'http://my.createoceans.com/uploads/attachments/cover/' . $Data->id . '-900.png' : 'http://my.createoceans.com/template/images/preview900.png';

    $documentExits = file_exists($path) ? 1 : 0;

    if ($Data->id >= 1 and $documentExits == 1)
    {

        $size = filesize($path);

        $extension = explode('.', $Data->file_url);
        $extension = strtolower($extension[1]);

        $file_date = date("Y-m-d H:i:s", filemtime($path));

        if ($extension == 'jpg' or $extension == 'gif' or $extension == 'png' or $extension == 'jpeg' or $extension == 'bmp' or $extension == 'pdf')
        {
            $preview_button = '<a href="' . $preview_900_url . '" title="' . $Data->file_name . ' (' . $extension . ', ' . dateigroesse($size) . ')" class="preview_button button preview"></a>';
        }
        else
        {
            $preview_button = '';
        }

        $document = [
            "id"              => $Data->id,
            "comment_id"      => $Data->comment_id,
            "client_id"       => $Data->client_id,
            "file_url"        => $Data->file_url,
            "file_name"       => $Data->file_name,
            "file_date"       => $file_date,
            "file_size"       => dateigroesse($size),
            "file_extension"  => $extension,
            "url"             => $url,
            "url_full"        => $url_full,
            "preview_60_url"  => $preview_60_url,
            "preview_200_url" => $preview_200_url,
            "preview_900_url" => $preview_900_url,
            "preview_button"  => $preview_button,
            "path"            => $path,
            "newsince"        => datetimeFull($Data->newsince)
        ];

    }

    return $document;
}*/

###################################################################################################################
## E-MAIL SENDEN
/*function sendSMTP($receiverMail, $receiverName, $bccMails, $mailSubject, $mailContent, $template, $attachment)
{
    global $db;
    $header_img = SMTP_HEADER_IMG != '' ? '<tr>
			<td style="background-color:#fff;"><img src="' . SMTP_HEADER_IMG . '" alt="" /></td>
		</tr>' : '';
    $message = '
		<html>
		<head><title>' . $mailSubject . '</title></head>
		<style type="text/css">
		<!--
		body { color:#555; font-family: Arial, Verdana, Helvetica, sans-serif; font-size:12px; line-height:18px; }
	   	h1 { padding:0; margin:0 0 18px 0; font-size:16px; color:#555; font-weight:bold; }
		h2 { padding:0; margin:0 0 18px 0; font-size:14px; color:#666; font-weight:bold; }
		table.content { font-family: Arial, Verdana, Helvetica, sans-serif; width:560px; border:none; border-collapse:collapse; table-layout:fixed; }
		table.content td { vertical-align: top; text-align: left; padding:3px 0; margin:0; line-height:18px; border-bottom:1px solid #aaa; font-size:12px; }
		table.content td.first { width:200px; }
		a { color:#0033cc; font-weight:normal; text-decoration:none; outline:none; }
		a:hover { text-decoration: underline; }
		.small { font-size:11px; line-height:15px; color:#aaa; }
		-->
		</style>
		<body style="background:#e9f1f9; padding:20px;">
		<table width="600" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; ">
		' . $header_img . '
		<tr>
			<td style="background-color:#fff; padding:20px; ">' . $mailContent . '</td>
		</tr>
		<tr>
			<td style="background-color:#fff; padding:20px; ">
			<span class="small">
			This is a PRIVATE message. If you are not the intended recipient, please delete without copying and kindly advise us by e-mail of the mistake in delivery. Many thanks!
		</span></td>
		</tr>
		</table>
		
		</body>
		</html>';
    if ($bccMails != '')
    {
        $bccMail = explode(',', $bccMails);
    }
    $receiverName = '=?utf-8?B?' . base64_encode($receiverName) . '?=';
    $senderName = '=?utf-8?B?' . base64_encode($senderName) . '?=';
    $mailSubject = '=?utf-8?B?' . base64_encode($mailSubject) . '?=';
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    try
    {
        if (SMTP_SSL == 1)
        {
            $mail->SMTPSecure = 'ssl';
        }
        $mail->Host = SMTP_SERVER;
        $mail->SMTPDebug = 1;            // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;          // enable SMTP authentication
        $mail->Port = SMTP_PORT;         // set the SMTP port for the GMAIL server
        $mail->Username = SMTP_USER;     // SMTP account username
        $mail->Password = SMTP_PASSWORD; // SMTP account password
        $mail->CharSet = 'utf-8';
        $mail->AddAddress($receiverMail, $receiverName);
        if (count($bccMail >= 1))
        {
            if (is_array($bccMail))
            {
                foreach ($bccMail as $one)
                {
                    $mail->AddBCC($one, $one);    // BCC
                }
            }
        }
        $mail->SetFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->AddReplyTo(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->Subject = $mailSubject;
        $mail->AltBody = 'Um diese Nachricht zu senden, benutzen Sie ein HTML-kompatibles E-Mail-Programm!';
        $mail->MsgHTML($message);
        if ($attachment != '')
        {
            $mail->AddAttachment($attachment);
        }
        $mail->Send();
    } catch (phpmailerException $e)
    {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e)
    {
        echo $e->getMessage(); //Boring error messages from anything else!
    }
    return true;
}*/

###################################################################################################################
## USER 
###################################################################################################################
/*function getLang($lang)
{
    // HTML Output 
    global $db;
    $aDatenLang = "SELECT * FROM " . DB_LANG . " WHERE company_id='1' ORDER BY name_area,name ASC";
    $qDatenLang = $db->sql_query($aDatenLang);
    $rDatenLang = $db->sql_num_rows($qDatenLang);
    if ($rDatenLang >= 1)
    {
        while ($DatenLang = $db->sql_fetch_object($qDatenLang))
        {
            $value = $lang == 'de' ? $DatenLang->value_de : $DatenLang->value_en;
            $arrayLang[$DatenLang->name_area . '-' . $DatenLang->name] = $value;
        }
    }

    return $arrayLang;
}*/

###################################################################################################################
## SONSTIGES
###################################################################################################################
## URL filtern #############################################################
function urlfilter($internetadresse)
{
    if (substr($internetadresse, 0, 7) == "http://")
    {
        $url = substr_replace($internetadresse, '', 0, 7);
    }
    else
    {
        $url = $internetadresse;
    }

    return $url;
}

## Dateiname filtern #############################################################
function dateinamefilter($dateiname)
{
    $dateiname = strtolower($dateiname);                                                    // Buchstaben klein schreiben
    $umlaute = ["/ä/", "/ö/", "/ü/", "/Ä/", "/Ö/", "/Ü/", "/ß/"];
    $replace = ["ae", "oe", "ue", "ae", "oe", "ue", "ss"];
    $dateiname = preg_replace($umlaute, $replace, $dateiname);                                // Umlaute ersetzen
    $dateiname = str_replace(" ", "-", $dateiname);                                           // Leerzeichen durch - ersetzen
    $dateiname = str_replace("_", "-", $dateiname);                                           // Unterstriche durch - ersetzen
    $dateiname = explode('.', $dateiname);                                                    // Endung entfernen
    $dateiname = preg_replace("/[^a-zA-Z0-9-]/", "", $dateiname[0]);                          // Sonderzeichen entfernen

    return $dateiname;
}

## URL filtern #############################################################
function seourlfilter($dateiname)
{
    $dateiname = strtolower($dateiname);                                                    // Buchstaben klein schreiben
    $umlaute = ["/ä/", "/ö/", "/ü/", "/Ä/", "/Ö/", "/Ü/", "/ß/"];
    $replace = ["ae", "oe", "ue", "ae", "oe", "ue", "ss"];
    $dateiname = preg_replace($umlaute, $replace, $dateiname);                                    // Umlaute ersetzen
    $dateiname = trim($dateiname);                                                                // Leerzeichen vorne und hinten entfernen
    $dateiname = str_replace(" ", "-", $dateiname);                                               // Leerzeichen durch - ersetzen
    $dateiname = str_replace("_", "-", $dateiname);                                               // Unterstriche durch - ersetzen
    $dateiname = str_replace(".", "", $dateiname);                                                // Punkt durch - ersetzen
    $dateiname = preg_replace("/[^a-zA-Z0-9-]/", "", $dateiname);                                 // Sonderzeichen entfernen
    $dateiname = str_replace("---", "-", $dateiname);                                             // Trennstriche ersetzen
    $dateiname = str_replace("--", "-", $dateiname);                                              // Trennstriche ersetzen
    if (substr($dateiname, -1) == '-')
    {                                                                // Letztes Zeichen "-" entfernen
        $dateiname = substr($dateiname, 0, -1);
    }

    return $dateiname;
}

function sonderzeichenSet($string)
{
    $umlaute = ["/ä/", "/ö/", "/ü/", "/Ä/", "/Ö/", "/Ü/", "/ß/"];
    $replace = ["&auml;", "&ouml;", "&uuml;", "&Auml;", "&Ouml;", "&Uuml;", "&szlig;"];
    // Umlaute ersetzen
    return preg_replace($umlaute, $replace, $string);
}

function sonderzeichenGet($string)
{
    $umlaute = ["/&auml;/", "/&ouml;/", "/&uuml;/", "/&Auml;/", "/&Ouml;/", "/&Uuml;/", "/&szlig;/"];
    $replace = ["ä", "ö", "ü", "Ä;", "Ö", "Ü", "ß"];
    // Umlaute ersetzen
    return preg_replace($umlaute, $replace, $string);
}


## Dateiendung ermittlen #############################################################
/*function dateiendung($dateiname)
{
    $dateiendung = explode('.', $dateiname);                // Endung ermitteln
    $dateiendung = strtolower($dateiendung[1]);             // Alles Kleinbuchstaben

    return $dateiendung;
}*/

## ZUFALLSPASSWORT ERZEUGEN #########################################################################

/*function zufallspasswort()
{
    $passwort = "";
    $pool = "qwertzupasdfghkyxcvbnm";
    $pool .= "WERTZUPLKJHGFDSAYXCVBNM";
    $pool .= "23456789";
    $pool .= ";!,.$%/§()[]#";
    srand((double)microtime() * 1000000);
    for ($index = 0; $index < 8; $index++) // Hier die länge des Passwortes eintragen
    {
        $passwort .= substr($pool, (rand() % (strlen($pool))), 1);
    }

    return utf8_decode($passwort);

}*/


## Bildname filtern #############################################################
/*function bildnamefilter($bildname)
{
    $bildname = split("[.]", $bildname);
    $bildname = strtolower($bildname[0]);
    $bildname = preg_replace("/[^a-zA-Z0-9]/", "", $bildname);
    $bildname = date("Ymd-His") . "-" . $bildname . ".jpg";

    return $bildname;
}*/

## Dateigröße ermitteln #############################################################
/*function Dateigroesse($size)
{
    $Groesse = $size;

    if ($Groesse < 1000)
    {
        return number_format($Groesse, 0, ",", ".") . " Bytes";
    }
    elseif ($Groesse < 1000000)
    {
        return number_format($Groesse / 1024, 1, ",", ".") . " KB";
    }
    else
    {
        return number_format($Groesse / 1048576, 2, ",", ".") . " MB";
    }
}*/

## Dateitypen prüfen #############################################################
/*function getFirstChar($string)
{
    $char = $string[0];
    $char = strtoupper($char);
    if (is_numeric($char))
    {
        $char = '#';
    }
    return $char;
}*/

## Dateitypen prüfen #############################################################
/*function Dateitypen($dateityp)
{
    $dateipfad = BACKEND_DIR . "/template/_images/types/" . $dateityp . ".gif";
    if (file_exists($dateipfad))
    {
        $datei = $dateityp;
    }
    else
    {
        $datei = "no";
    }

    return $datei;
}*/

## Nummer 0 voran setzen #############################################################
/*function add_leading_zero($value, $threshold = 2)
{
    return sprintf('%0' . $threshold . 's', $value);
}*/

## Date umformatieren #############################################################
/*function dateFull($var)
{
    $date = explode('-', $var);
    $date = $date[2] . '.' . $date[1] . '.' . $date[0];

    return $date;
}*/

## Datetime umformatieren #############################################################
/*function datetimeFull($datetime)
{
    $datetime = explode(' ', $datetime);
    $date = explode('-', $datetime[0]);
    $time = explode(':', $datetime[1]);

    $datetime = $date[2] . '.' . $date[1] . '.' . $date[0] . ' ' . $time[0] . ':' . $time[1] . ' Uhr';

    return $datetime;
}*/

## Datetime umformatieren #############################################################
/*function datetimeDate($datetime)
{
    $datetime = explode(' ', $datetime);
    $date = explode('-', $datetime[0]);

    $datetime = $date[2] . '.' . $date[1] . '.' . $date[0];

    return $datetime;
}*/

## Date umformatieren (Kalender) #############################################################
/*function getGerDate($date)
{
    $date = explode('-', $date);
    $date = $date[1] . '.' . $date[0] . '.' . $date[2];

    return $date;
}*/

## SEPA IBAN codieren #############################################################
/*function codeIBAN($iban)
{
    $sepa_iban_coded_length = strlen($iban);
    $sepa_iban_coded_length = $sepa_iban_coded_length - 10;
    $sepa_iban_coded_start = substr($iban, 0, 6);
    $sepa_iban_coded_ende = substr($iban, -4);
    $sepa_iban_coded_xxx = '';
    $i = 1;
    while ($i <= $sepa_iban_coded_length)
    {
        $sepa_iban_coded_xxx .= 'X';
        $i++;
    }
    $iban = $sepa_iban_coded_start . $sepa_iban_coded_xxx . $sepa_iban_coded_ende;

    return $iban;
}*/

## Werktage zum Datum addieren#############################################################
/*function plusWerktag($date, $days)
{
    //Wochentagnummer
    $wD = date("w", $date);
    $dateSet = explode('-', $date);

    //neu nummerieren damit Montag 0 ist und das Wochenende bei 5 beginnt
    if ($wD == 0)
    {
        $wD = 6;
    }
    else
    {
        $wD = $wD - 1;
    }
    //Ist das Startdatum im Wochenende?
    if ($wD != 5 and $wD != 6)
    {
        // $pD <= Tage die dazu zuzählen sind
        $pD = 0;
        // liegt das Ergebnis im oder hinter einem Wochenende
        if (($wD + $days) >= 5)
        {
            // wieviele Wochenenden liegen dazwischen? -> anzahl der Wochenendtage auf $pD legen
            $pD = ceil(($wD + $days) / 7) * 2;
            $zD = $pD;
            //sollten durch die hinzugefügten Tage weitere Wochenenden übergangen werden
            while ($zD >= 5)
            {
                $zD = ceil(($zD - 5) / 7) * 2;
                $pD = $pD + $zD;
            }
        }
        //neues Datum berechnen
        $timestamp = mktime(0, 0, 0, $dateSet[1], $dateSet[2], $dateSet[0]);
        $nD = $date + (($days + $pD) * 86400);
        //return!
        $nD = $timestamp + $nD;
        $datum = date("Y-m-d", $nD);
        return $datum;
    }
    else
    {
        //Fehler Startdatum ist kein Wochentag!
        //hier sollte man eine gescheitere Lösung bauen!
        die('das Start Datum ist kein Werktag');
    }
}*/

## Größe Ordner ausgeben ###########################################################
/*function verzeichnis_groesse($verzeichnis, $size)
{

    $directory = openDir($verzeichnis);
    while ($datei = readDir($directory))
    {
        if (preg_match("#^\.{1,2}$#i", $datei))
        {
            continue;
        }
        $size += filesize($verzeichnis . $datei);
    }
    closeDir($directory);
    return $size;
}*/

## Anzahl Dateien im Ordner ausgeben ###########################################################
/*function countfiles($path)
{
    $handle = opendir($path);
    $filecount = 0;
    while ($res = readdir($handle))
    {
        if (is_dir($res))
        {
        }
        else
        {
            $filecount++;
        }
    }
    return $filecount;
}*/

## Date => MySql-Date #############################################################
function getMysqlDate($date)
{
    $date = explode('.', $date);
    $date = $date[2] . '-' . $date[1] . '-' . $date[0] . ' 00:00:00';

    return $date;
}

## String kürzen #############################################################
/*function cutString($string, $counts)
{
    if (strlen($string) >= $counts)
    {
        $return = substr($string, 0, $counts) . '...';
    }
    else
    {
        $return = $string;
    }
    return $return;
}*/

## trumbowyg  #############################################################
/*function textTrumbowyg($string)
{
    $string = addslashes($string);
    $string = preg_replace("(</?span[^>]*\>)i", "", $string);
    $string = str_replace("&nbsp;", " ", $string);
    $string = trim($string);

    return $string;
}*/

?>