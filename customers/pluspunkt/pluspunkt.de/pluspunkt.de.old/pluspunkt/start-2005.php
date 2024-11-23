<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Bildergalerie Inspiration 2004";
$titel = "Assessment";
$rub = "Assessment";
$hauptmenue=0;
$submenue=1;
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#999999" vlink="#999999" alink="#999999">
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
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle">
              &nbsp;<a href="galerie-2004.php" target="_self">Fotogalerie 2004<br>
              <br>
              </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle">
              &nbsp;<a href="galerie.php" target="_self">Fotogalerie 2003</a><br>
              <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle">
              &nbsp;<a href="../home/index.php" target="_top">Zur Startseite</a><br>
              <br>
              <br>
            </p>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6">
            <img src="einladung3.jpg" width="389" height="200"><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B" valign="top">
                <td>
                  <p><b>Das n&auml;chste Running Dinner wird am 23.09.2005 stattfinden.</b> <br>
                    <br>
                  <b>Anmeldung Inspiration 2005</b></p>
                  <p>
<?php 
IF (!isset($_POST[todo]) || (!is_numeric($_POST[anzahl]) || !strlen($_POST[name]) || !strlen($_POST[email])))
{
?>
                    <br>
                    23.09. Inspration 2005<br>
                    Event-Mix und let the party go!<br>
                    Start 17.30 Uhr</p>
                  <p>In bröker's Speicher No. 10</p>
                  <p>All inclusive pro Person 125,- &euro;.<br><br>
                     <?php /*?>
                    Finden Sie hier <a href="http://www.patoga.de/ergebnis.php?Land=DE&Region=&Ort=&Plz=481" target="_blank">Hotels in M&uuml;nster</a>. </p>
                  	<?php */?>
                  	<strong>Hotels</strong>:<br>
                  	<a href="http://www.parkhotel-hohenfeld.de" target="_blank">Parkhotel Schloss Hohenfeld</a><br>
                 	<a href="http://www.wienburg.de" target="_blank">Hotel Haus Wienburg</a>
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
                          <input type="text" name="anzahl" size="3"> *
                        </td>
                      </tr>
                      <tr>
                        <td width="32%" height="32">Telefon</td>
                        <td width="68%" height="32">
                          <input type="text" name="telefon" size="15">
                        </td>
                      </tr>
                      <tr>
                        <td width="32%" height="32">Email</td>
                        <td width="68%" height="32">
                          <input type="text" name="email" size="15"> *
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

hiermit möchte ich mich für das 3te Inspiration Event bei Euch anmelden.

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
                          <br>
                          <br>
                          * Pflichtfelder. Diese Felder müssen ausgefüllt werden.</td>
                      </tr>
                    </table>
                  </form>
                  <?php 
}
ELSEIF ($_POST[todo] == "kontakt")
{
    $headers .= "From:Anmeldeformular Inspiration 2005<".$_POST[email].">\n";
    $headers .= "Reply-To:" . $_POST[email] . "\n";
    $headers .= "X-Mailer: PHP/" . phpversion(). "\n";
    $headers .= "X-Sender-IP: $REMOTE_ADDR\n";
    $headers .= "Content-type: text/html\n";
    $text = "<b>Anmeldung für Inspiration 2005</b><br><br>";
    $text .= "Name: ".$_POST[name]."<br>";
    $text .= "Telefon: ".$_POST[telefon]."<br>";
    $text .= "Email: ".$_POST[email]."<br>";
    $text .= "Personenanzahl: ".$_POST[anzahl]."<br>";
    $text .= "<br>Nachricht:<br>";
    $text .= htmlentities($_POST[nachricht]);
    $text .= "<hr>";
    $text .= "Diese Email wurde am ".strftime("%d.%m.%Y - %H:%M Uhr",time())." gesendet.";
	if(@mail("lohe@pluspunkt.de","Anmeldung Inspiration 2005 via pluspunkt.de",$text,$headers)) {
?>
                  <p><b>Ihre Nachricht wurde versandt.</b></p>
                  <p>Vielen Dank.
                    <?php 
	}
	else {
		echo "Ihre Anmeldung konnte nicht verschickt werden. Bitte versuchen Sie es nochmals !";
	}
}
?>
                  </p>
            <p>&nbsp;</p>                </td>
              </tr>
          </table>          </td>
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