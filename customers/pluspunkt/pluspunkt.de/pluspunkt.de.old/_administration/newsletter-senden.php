<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Administration";
$titel = "versenden";
$hauptmenue=0;
$submenue=0;
$Upload_Pfad = "../_upload/";

require_once($cfg['pfad1']."c_db.class.php");
require_once($cfg['pfad1']."c_datum.class.php");
require_once($cfg['pfad1']."c_email.class.php");
require_once($cfg['pfad1']."c_upload.class.php");

$db = new c_db($cfg['SQL_Database']['Server'],$cfg['SQL_Database']['User'],$cfg['SQL_Database']['Passwort'],$cfg['SQL_Database']['Name']);
$datum = new c_datum;
$email = new c_email;
$upload = new c_upload;


IF ($_POST[newsletter] == "ja" || $_GET[newsletter] == "ja")
{
	IF (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != "" && $_FILES['file']['size'] != "0" && $_POST[dateititel] != "")
	{
		$dateiname = $upload->Upload($Upload_Pfad,$_POST[dateititel]);
	}

	IF ($dateiname != "Fehler")
	{
		$emails_versenden = "1";

		$aAnzahl = "SELECT id FROM ".$tab['mis']['newsletter_abo'];
		$qAnzahl = $db->sql_query($aAnzahl);
		$Anzahl_anz = $db->sql_num_rows($qAnzahl);

		IF ($_POST[todo] == "hinzufuegen")
		{
			require($cfg['pfad1']."bbcode_parsing.inc.php");
			$nachricht = $bbcode->parse($_POST[nachricht]);
			$email->Vorbereiten("Pluspunkt Unternehmensentwicklung","j.lipka@dimento.com","$nachricht","$_POST[betreff]","$dateiname","$dateititel");

			$aArchiv = "INSERT INTO ".$tab['mis']['newsletter_archiv']." (betreff,newsletter,datum,empf_anz) VALUES ('$_POST[betreff]','$_POST[nachricht]',NOW(),'$Anzahl_anz')";
			$qArchiv = $db->sql_query($aArchiv);
		}

		IF (!isset($_GET[beginn])) { $von = "0"; } ELSEIF (isset($_GET[beginn])) { $von = "$_GET[beginn]"; }

		$aUser = "SELECT ansprache,anrede,name,email FROM ".$tab['mis']['newsletter_abo']." ORDER BY id ASC LIMIT $von, $emails_versenden";
		$qUser = $db->sql_query($aUser);
		WHILE ($User = $db->sql_fetch_object($qUser))
		{
//			$email->PersonalSenden("$User->email","$User->email", "$User->ansprache", "$User->anrede", "$User->name", "$User->email");
			$email->PersonalSenden("j.lipka@dimento.com","j.lipka@dimento.com", "$User->ansprache", "$User->anrede", "$User->name", "$User->email");
		}
	
		$von = $von + $emails_versenden;
		IF ($von <= $Anzahl_anz) { header("Location: $_SERVER[PHP_SELF]?newsletter=ja&beginn=$von"); }
		$newsletter = "ok";
	}
}
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
<script language="JavaScript">
<!--
function dateiname()
{
	datei = document.newsletter.file;
	dateititel = document.newsletter.dateititel;

	suche = datei.value.lastIndexOf("\\");
	tada = datei.value.substr(suche+1);
	dateititel.value = tada;
}
//-->
</script>
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<table width="640" border="0" cellspacing="0" cellpadding="0" align="center" name="content">
  <tr> 
    <td bgcolor="#77787C" width="628">
      <table width="608" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td colspan="2" height="24">&nbsp;</td>
        </tr>
        <tr> 
          <td width="219" valign="top"> 
            <?php  require "../_inc/submenue-$submenue.inc.php"; ?>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B" valign="top"> 
                <td> 
                  <p><img src="../_images/rub-admin.gif" width="266" height="20"></p>
                  <p><b>Newsletter versenden</b></p>
                  <p>F&uuml;llen Sie die folgenden Felder aus - nach einem Klick 
                    auf &quot;Absenden&quot; wird der Newsletter an alle unter 
                    Abonnenten aufgelisteten Leute geschickt.</p>
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    <tr> 
                      <td> 
<?php 
IF (!isset($_POST[todo]) && !isset($_GET[newsletter]))
{
?>
                        <form name="newsletter" method="post" action="<?php  echo $_SERVER[PHP_SELF];?>" enctype="multipart/form-data">
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td valign="top"><b>Betreff:</b></td>
                            </tr>
                            <tr> 
                              <td valign="top"> 
                                <input type="text" name="betreff" size="60">
                                <br>
                                &nbsp; </td>
                            </tr>
                            <tr> 
                              <td valign="top"><b>Nachricht:</b></td>
                            </tr>
                            <tr>
                              <td valign="top"><font size="1">Um eine pers&ouml;nliche 
                                Ansprach einzubinden, benutzen Sie bitte folgende 
                                Variablen:<br>
                                <br>
                                <b>%%ANSPRACHE%% </b>= Ansprache<br>
                                <b>%%ANREDE%% </b>= Anrede<br>
                                <b>%%NAME%%</b> = Name<br>
                                <b>%%EMAIL%%</b> = Emailadresse</font></td>
                            </tr>
                            <tr> 
                              <td valign="top"> 
                                <textarea name="nachricht" cols="62" rows="15">%%ANSPRACHE%% %%ANREDE%% %%NAME%%,

</textarea>
                                <br>
                                &nbsp; </td>
                            </tr>
                            <tr> 
                              <td><b>Dateianhang:</b></td>
                            </tr>
                            <tr> 
                              <td> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td>Dateiauswahl:</td>
                                    <td> 
                                      <input type="file" name="file" onBlur="dateiname()">
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td valign="top">Dateiname:</td>
                                    <td> 
                                      <input type="text" name="dateititel" size="30">
                                      <br>
                                      <font size="1">Umlaute / Sonderzeichen bitte 
                                      umbennenen/entfernen!!!</font></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <p>&nbsp;</p>
                                <p> 
                                  <input type="submit" name="Abschicken" value="Newsletter versenden">
                                  <input type="hidden" name="newsletter" value="ja">
                                  <input type="hidden" name="todo" value="hinzufuegen">
                                </p>
                              </td>
                            </tr>
                          </table>
                        </form>
<?php 
}
ELSEIF ($newsletter == "ok" || $dateiname != "Fehler")
{
?>
                        <p><b>Der Newsletter wurde versandt.</b><p> 
<?php 
}
ELSE
{
?>
                  <p><b>Eine Datei mit demselben Namen existiert bereits auf dem Server.<br>
                    </b>Bitte <a href="javascript:history.go(-1);">gehen Sie zurück</a> 
                    und wählen Sie einen anderen Dateinamen.</p>
<?php 
}
?>
                      </td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td width="219" valign="top">&nbsp;</td>
          <td width="389" valign="top"> 
            <?php  include "../_inc/submenue.inc"; ?>
          </td>
        </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table>
<?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
