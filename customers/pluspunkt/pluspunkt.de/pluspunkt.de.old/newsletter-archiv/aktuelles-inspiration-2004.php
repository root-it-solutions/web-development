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
                    <b>Inspration 2004</b></p>
                  <p>Der Event der Pluspunkt GmbH am 2. Oktober 2004 war ein voller 
                    Erfolg. Das Running-Dinner bescherte uns viel Spa&szlig; bei 
                    der gemeinsamen Zubereitung der Speisen - nat&uuml;rlich unter 
                    fachm&auml;nnischer Anleitung der K&ouml;che. Herzlichen Dank 
                    Wolfgang Stein f&uuml;r die gelungene Vorbereitung. <br>
                    Unter der Leitung von Christiana Diallo-Morick entstand ein 
                    Bild, in dem sich alle Teilnehmer verewigten. Hierf&uuml;r 
                    wurde zu Gunsten der Franziskanerinnen St. Mauritz, die ein 
                    Hospiz f&uuml;r aidserkrankte Menschen in Berlin unterhalten, 
                    &uuml;ber 1.500 Euro ersteigert. <br>
                    <br>
                    Heinz Wagner aus Saarburg stellte sein Rieslingweine vor, 
                    die unser Men&uuml; vortrefflich erg&auml;nzten.<br>
                    <br>
                    <a href="http://www.finest-food.de/" target="_blank">Hilde 
                    Pfau</a> kredenzte uns Kulinarisches vom Wild gepaart mit 
                    exotischen Dipps. <br>
                    <br>
                    Aber <a href="http://www.pluspunkt.de/pluspunkt/galerie-2004.php" target="_blank">sehen 
                    Sie selbst</a>.<br>
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
