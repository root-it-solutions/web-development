<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Weiterbildung auf Fuerteventura";
$titel = "Presse";
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
                  <p><b><img src="../_images/rub-presse.gif" width="266" height="20"></b></p>
                  <table width="352" border="0" cellspacing="1" cellpadding="3">
                    <tr valign="top">
                      <td colspan="2"> 
                        <p><b>Zur Motivation nach Mallorca</b></p>
                        <p>
							Gute Mitarbeiter zu halten und an das Unternehmen zu binden ist die wirkungsvollste 
							Methode, einem Fachkräftemangel vorzubeugen. Zur Motivation gehöre eine qualifizierte 
							Weiterbildung, die auch mit Wellness und Freizeit in einer attraktiven Umgebung verbunden 
							sein könne, meint Ralf Lohe, Geschäftsführer der Firma Pluspunkt Unternehmensentwicklung 
							in Senden. Er hat ein spezielles Rhetorik-Training entwickelt, das in einem Club auf 
							Mallorca angeboten wird. Dadurch bekomme die Weiterbildung einen besonderen Charakter, 
							der sich auch auf die Motivation positiv auswirke. Das Angebot eigne sich deshalb besonders 
							als Anerkennung für verdiente Mitarbeiter. Das Seminar wird im Januar durchgeführt und 
							könne, so Lohe, deshalb auch ein besonderes Weihnachtsgeschenk sein. 
						</p>
						<p>
							Infos unter Tel. 02597/ 95 53
						</p>
						<p>
							<a href="http://www.pluspunkt.de">www.pluspunkt.de</a>
						</p>
                        <hr size="1" noshade>
                        <strong>Deutsches Handwerksblatt</strong><br>
                        Ausgabe vom 13.09.07</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td align="right"><a href="presse_25_druck.php" target="_blank">Druckversion</a></td>
                    </tr>
                  </table>
                  <p>&nbsp; </p>
                  <p>&nbsp;</p>
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