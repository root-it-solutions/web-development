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
            <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b><font size="1">[ <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> ]</font></p>
                  <p>Aktuelles<br>
                    <br>
                    <b>Rhetorik spezial </b></p>
            <p>Es sind die Leistungstr&auml;ger eines Unternehmens, die es im Fahrwasser der Konjunktur halten. Grund genug einmal „danke sch&ouml;n“ zu sagen. Unser Angebot hierzu lautet <em><a href="http://www.pluspunkt.de/leistungen/rhetorikspezial.php">Rhetorik spezial</a></em>. </p>
                  <p><em>Rhetorik spezial </em> bedeutet eine Woche zusammen mit netten Leuten in einer inspirierenden Umgebung etwas f&uuml;r die eigene Weiterentwicklung tun und dabei noch zu entspannen. Aufgrund extrem guter Konditionen durch den Robinson Club Cala Serena auf Mallorca k&ouml;nnen wir eine Woche Rhetorik- und Kommunikationstraining inklusive Clubaufenthalt mit Vollverpflegung und Steuern unter 1.000 EURO anbieten. <br>
                  Mehr hierzu lesen Sie <a href="http://www.pluspunkt.de/leistungen/rhetorikspezial.php">hier</a>. </p>
                  <p>Achtung: Anmeldeschluss ist der <strong>15. August 2005 </strong><a href="http://www.pluspunkt.de/leistungen/rhetorikspezial.php"><br>
                  Zur Anmeldung</a> <br>
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
