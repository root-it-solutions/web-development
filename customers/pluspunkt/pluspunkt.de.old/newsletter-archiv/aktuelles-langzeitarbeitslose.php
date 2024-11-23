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
          <td  height="260"> 
            <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b>
            <font size="1">[ <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> ]</font>
            </p>
                 <p>
				Aktuelles
			</p>
            <p>
					<strong>Langzeitarbeitslose ? wir benötigen Ihre Hilfe!</strong>
                 </p>

                 <p>
					Wir haben uns zur Aufgabe gemacht, ein Konzept zu verwirklichen, durch das Langzeitarbeitslose wieder in den ersten Arbeitsmarkt gelangen können. Dabei werden wir besonders die seelischen, gesundheitlichen und kommunikativen Voraussetzungen berücksichtigen und geeignete Maßnahmen ergreifen, die zu mehr Selbstvertrauen, einer positiven und zuversichtlichen Grundeinstellung, gesunder Lebensführung und Fitness führen. Wir suchen deshalb im ganzen Bundesgebiet Langzeitarbeitslose, die wieder in den ersten Arbeitsmarkt wollen und die sich durch die Angebote der Arbeitsagenturen (ARGEN) bzw. der so genannten Optionskommunen nicht ausreichend unterstützt fühlen. Die Kontaktaufnahme zu uns kann per Mail oder Telefon (02597-9553) erfolgen. Bitte stellen Sie uns den Kontakt her. Herzlichen Dank im Voraus.
				</p>
                 <p>
					PS. Bitte leiten Sie diese Information an Menschen weiter, die uns auch den Zugang zu Langzeitarbeitslosen herstellen können. Herzlichen Dank.
                 </p>
            	<p><img src="../../_images/link.gif" width="12" height="10" align="absmiddle"> 
                    <a href="javascript:history.go(-1);">Zur&uuml;ck</a><br>
                    <br>
                    <br>
                    <br>
                    <br>
                  </p>
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
