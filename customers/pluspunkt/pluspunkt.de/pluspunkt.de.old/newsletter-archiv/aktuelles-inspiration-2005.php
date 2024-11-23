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
                    <b>Inspration 2005</b></p>
                  <p>Warum sollte man 150 EURO f&uuml;r einen netten Abend aus-geben? Bei zwei Personen nebst &Uuml;bernachtung sind das schnell 400 EURO. </p>
                  <p>Die Antwort lautet: weil es dies wert ist. Inspiration 2005 ist: </p>
                  <ul>
                    <li>Ein Running-Dinner das viele gute Gespr&auml;che verspricht </li>
                    <li>Eine lukullische Kostbarkeit von Wolfgang Stein </li>
                    <li>Ausgew&auml;hlte Weine </li>
                    <li>Inspirationen f&uuml;r alle Sinne </li>
                    <li>Und &Uuml;berraschungen (mehr verraten wir nicht) </li>
                  </ul>
                  <p>Schauen Sie doch mal in unsere <a href="http://www.pluspunkt.de/pluspunkt/galerie-2004.php">Bildergalerie</a>  was so in den letzten Jahren los war. Diesmal findet die Veranstaltung im Zentrum von M&uuml;nster im Erbdrostenhof statt.</p>
                  <p>Anmeldung ausschlie&szlig;lich &uuml;ber das Internet und unsere <a href="http://www.pluspunkt.de/pluspunkt/start-2005.php">Homepage</a>.<br>
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
