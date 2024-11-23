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
                        <p><b>Personal leistungsorientiert fördern und motivieren</b></p>
                        <p><strong>
							Führungskräfte tauschen sich mit Unternehmensberater Ralf Lohe aus</strong>
						</p>
						<p>
							"Den Teilnehmern wurde gezeigt, dass Personalentwicklung auch Spaß machen kann", fasst Andreas Willamowski, stellvertretender Geschäftsführer der Wirtschaftsförderungsgesellschaft des Landkreises Oldenburg (WLO), das Treffen der "Arbeitsgruppe mittelständiger Unternehmen" zusammen.
						</p>
						<p>
							An der Veranstaltung bei Kempermann in Großenkneten nahmen unter anderem Firmen aus den Bereichen Elektrotechnik, Handwerk und Werbung aus Oldenburg und Umgebung teil. Die 25 Vertreter hörten den Vortrag "Delegieren und motivieren –  Die Unternehmensentwicklung fördern", diskutierten anschließend darüber und tauschten sich beim Kohlessen aus. Wie man Mitarbeiter leistungsorientiert fördert und motiviert und somit Arbeit und Produkte verbessern kann, seien die wichtigsten Aspekte der Veranstaltung gewesen, so Willamowski. 
						</p>
						<p>
							Gestaltet wurde der Vortrag von Ralf Lohe, Geschäftsführer von "Pluspunkt Unternehmensentwicklung GmbH". Dem langjährigen Trainer von Führungskräften gehe es darum, das Selbstvertrauen und die Kommunikationsfähigkeit seiner Kunden zu stärken. Erst später beantworte er Fragen über klassische Unternehmensberatung. 
                        </p>
                        <hr size="1" noshade>
                        <strong>Nordwest Zeitung</strong><br>
                        Ausgabe vom 12.02.08</td>
                    </tr>
                    <tr valign="top">
                      <td>&nbsp;</td>
                      <td align="right"><a href="presse_27_druck.php" target="_blank">Druckversion</a></td>
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