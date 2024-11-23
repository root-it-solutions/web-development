<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Ralf Lohe";
$titel = "geschaeftsfuehrung";
$hauptmenue=1;
$submenue=1;
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
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
                  <p><b><img src="../_images/rub-ralf-lohe.gif" width="266" height="20"></b></p>
                  <table width="349" border="0" cellspacing="0" cellpadding="2">
                    <tr valign="top">
                      <td width="207"><b>Kurzbiographie:</b></td>
                      <td rowspan="2" width="134">
                        <div align="right"><img src="ralf-lohe.jpg" width="116" height="348"></div>
                      </td>
                    </tr>
                    <tr valign="top">
                      <td width="207"><br>
                        Jahrgang 1951 <br>
                        <br>
                        Studium der Erziehungswissen-<br>
                        schaften in Bonn und Köln<br>
                        Dipl. - P&auml;dagoge seit 1979<br>
                        <br>
                        Ausbildung als Tischler, Berufserfahrung (3 Jahre) <br>
                        <br>
                        Leitende Positionen in der Berufs-<br>
                        bildung in Berlin und Münster (10 Jahre) <br>
                        <br>
                        Selbständig seit 1990 im Bereich <br>
                        der Personalentwicklung <br>
                        <br>
                        Kursleiter seit 15 Jahren; ca. 2000 Teilnehmer; Ausbildung
                        erfolgte bei der weltweit größten Trainingsorganisation in den Schwer-<br>
                        punkten: Rhetorik, Führung, Verkauf, Präsentation und
                        Teamleitung <br>
                        <br>
                        Geschäftsführer der Unternehmens-<br>
                        entwicklung Pluspunkt GmbH seit 1998<br>
                        <br>
                        <span onclick="javascript:linkTo_UnCryptMailto('qtmjEuqzxuzspy3ij');" style="cursor:pointer; display:block; width:148px; background:url('../_images/c.gif') right bottom no-repeat;">E-Mail:</span></td>
                    </tr>
                    <tr valign="top">
                      <td width="207">&nbsp;</td>
                      <td width="134">&nbsp;</td>
                    </tr>
                  </table>
                  <p><img src="../_images/link.gif" width="12" height="10" align="absmiddle">
                    <a href="die-geschaeftsfuehrung.php" target="_self">Zur&uuml;ck</a>
                    &nbsp;&nbsp;<img src="../_images/link.gif" width="12" height="10" align="absmiddle">
                    <a href="die-geschaeftsfuehrung-rumi.php" target="_self">Zu
                    Manfred Rumi</a></p>
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