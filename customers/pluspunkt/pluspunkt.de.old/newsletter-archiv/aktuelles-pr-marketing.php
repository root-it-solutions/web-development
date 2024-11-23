<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Newsletter Archiv";
$titel = "newsletter-archiv";
$hauptmenue=2;
$submenue=2;
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
</head>
<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" ">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<table width="640"border="0" cellspacing="0" cellpadding="0" align="center" name="content">
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
              <tr bgcolor="#76797B"> 
                <td bgcolor="#76797B"> 
                  <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b><font size="1">[ 
                    <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> 
                    ]</font></p>
                  <p>Aktuelles<br>
                    <br>
                    <b>PR-Marketing</b></p>
                  <p>Kommunikation ist unsere St&auml;rke - das wissen unsere 
                    Kunden.<br>
                    Und deshalb st&auml;rken wir auch deren Kommunikationsf&auml;higkeit.<br>
                    Das wollen wir jetzt auch mit einem weiteren Angebot tun:</p>
                  <p>Als Unternehmer oder leitende F&uuml;hrungskraft m&ouml;chten 
                    Sie Ihren Betrieb und sich auch in der &Ouml;ffentlichkeit 
                    darstellen. Dazu gibt es verschiedene Anl&auml;sse und dabei 
                    k&ouml;nnen wir Sie durch professionelle Pressearbeit unterst&uuml;tzen. 
                    Sie geben uns einige Eckdaten, wir machen daraus eine Pressemitteilung 
                    f&uuml;r Ihre lokalen Medien. <a href="http://www.pluspunkt.de/pluspunkt/presse.php" target="_blank">Beispiele 
                    gef&auml;llig?</a></p>
                  <p>Oder Sie sind manchmal gefordert, eine Ansprache, ein Gru&szlig;wort 
                    oder eine Rede zu halten. Auch das ist &Ouml;ffentlichkeitsarbeit 
                    - und auch dabei k&ouml;nnen wir Sie unterst&uuml;tzen.</p>
                  <p>Fragen Sie uns an, zu welchem Anlass Sie sich eine Unterst&uuml;tzung 
                    von uns vorstellen k&ouml;nnen, und wir unterbreiten Ihnen 
                    ein detailliertes Angebot. Wir freuen uns auf Ihre <a href="http://www.pluspunkt.de/kontakt/formular.php" target="_self">Anfragen</a>.<br>
                    <br>
                  </p>
                  <p><img src="../../_images/link.gif" width="12" height="10" align="absmiddle"> 
                    <a href="javascript:history.go(-1);">Zur&uuml;ck</a></p>
                </td>
        </tr>
      </table>
    </td>
  </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table><?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
