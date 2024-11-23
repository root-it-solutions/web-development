<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Assessment";
$titel = "Assessment";
$rub = "Assessment";
$hauptmenue=0;
$submenue=1;

require_once($cfg['pfad1']."c_email.class.php");

$email = new c_email;


IF ($_POST[todo] == "kontakt")
{
	$empfaenger = "lohe@pluspunkt.de";
	$betreff = "pluspunkt.de: Einladung";
	$text  = "<b>Name:</b> $_POST[name]\n";
	$text .= "<b>Personennzahl:</b> $_POST[anzahl]\n";
	$text .= "<b>Telefon:</b> $_POST[telefon]\n\n";
	$text .= "<b>Nachricht:</b>\n";
	$text .= htmlentities($_POST[nachricht]);

	$email->Vorbereiten("Pluspunkt.de","lohe@pluspunkt.de","$text","$betreff","","");
	$email->Senden("$empfaenger","$empfaenger");
}
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
<script language="JavaScript">
<!--
function chkForm()
{
	var_name  = document.einladung.name;
	var_anzahl = document.einladung.anzahl;

	if(var_name.value==""){
		alert("Bitte geben Sie Ihren Namen ein.");
		var_name.focus();
		return false
	}

	if(var_anzahl.value==""){
		alert("Bitte geben Sie die Anzahl der Personen ein.");
		var_anzahl.focus();
		return false
	}

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
          <td width="219" valign="top"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
            &nbsp;<a href="einladung.php" target="_self">Anmeldeformular</a><br>
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
            &nbsp;<a href="galerie.php" target="_self">Fotogalerie 2003</a><br>
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
            &nbsp;<a href="../home/index.php" target="_top">Zur Startseite</a><br>
            <br>
            <br>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6"> <img src="einladung2.jpg" width="389" height="202"><br>
            <?php /*?><table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B" valign="top"> 
                <td> 
                  <p><b>Anmeldung Inspiration 2004</b></p>
                  <p>
                    <?php 
IF (!isset($_POST[todo]))
{
?>
                    2.10. Inspration 2004<br>
                    Event-Mix und let the party go!<br>
                    Start 17.30 Uhr</p>
                  <p>An den Speichern 10<br>
                    48157 M&uuml;nster</p>
                  <p>All inclusive pro Person 125,- &euro;.<br>
                    Anmeldungen, gerne bis zum 10. 09. 2004.</p>
                  <p><b><span class="title">Anmeldeformular</span></b> </p>
                  <form name="einladung" method="post" action="<?php  echo $_SERVER[PHP_SELF];?>">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td colspan="2" height="1"><img src="../_images/trans.gif" width="1" height="1"></td>
                      </tr>
                      <tr> 
                        <td width="32%" height="32">Name</td>
                        <td width="68%" height="32"> 
                          <input type="text" name="name" size="30">
                          * </td>
                      </tr>
                      <tr> 
                        <td width="32%" height="32">Personenanzahl</td>
                        <td width="68%" height="32"> 
                          <input type="text" name="anzahl" size="3">
                        </td>
                      </tr>
                      <tr> 
                        <td width="32%" height="32">Telefon</td>
                        <td width="68%" height="32"> 
                          <input type="text" name="telefon" size="15">
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="1"><img src="../_images/trans.gif" width="1" height="1"></td>
                      </tr>
                      <tr> 
                        <td width="32%" valign="top"><br>
                          Ihre Nachricht</td>
                        <td width="68%" height="100" valign="top"> <img src="../_images/trans.gif" width="1" height="8"><br>
                          <textarea name="nachricht" cols="40" rows="12">Hallo Pluspunkt Team,

hiermit möchte ich mich für das 2te Inspiration Event bei Euch anmelden.

Lieben Gruß</textarea>
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="1"><img src="../_images/trans.gif" width="1" height="1"></td>
                      </tr>
                      <tr> 
                        <td width="32%" height="32">&nbsp;</td>
                        <td width="68%" height="32"> <br>
                          <input type="submit" name="Abschicken" value="Abschicken" onClick="return chkForm()">
                          &nbsp; 
                          <input type="hidden" name="todo" value="kontakt">
                          * Pflichtfelder</td>
                      </tr>
                    </table>
                  </form>
                  <?php 
}
ELSEIF ($_POST[todo] == "kontakt")
{
?>
                  <p><b>Ihre Nachricht wurde versandt.</b></p>
                  <p>Vielen Dank. 
                    <?php 
}
?>
                  </p>
            <p>&nbsp;</p>
                  </td>
              </tr>
            </table><?php */?>
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B" valign="top"> 
                <td> 
                  <p>Ab Montag, den 04.10.2004 finden Sie an dieser Stelle die 
                    aktuellen Bilder der 'Inspiration 2004'.</p>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td colspan="2" valign="top">&nbsp; </td>
        </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table>
<?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
