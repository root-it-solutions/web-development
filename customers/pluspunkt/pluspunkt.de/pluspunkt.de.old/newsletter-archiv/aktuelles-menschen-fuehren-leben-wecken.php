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
                  <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b><font size="1">[<a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a>]</font></p>
                  <p>
                  		Aktuelles<br><br>
	                    <b>Anselm Gr�n: Menschen f�hren �Leben wecken</b>
	                    <br />
	                    Von: Ralf Lohe
                  </p>
                  <p>
                 	Wer schon mal einen Aufsatz geschrieben hat, wei� wie schwierig es ist, etwas auf den Punkt zu bringen. Anselm Gr�n bringt es auf den Punkt. In 
                 	weniger als einer Stunde verr�t er uns, wie die F�hrungskraft zu sein hat. Und obwohl diese Erkenntnisse schon durch den Heiligen Benedikt verfasst 
                 	wurden, sind sie heute noch genau so aktuell. Anselm Gr�n nennt die F�hrungskraft den Verantwortlichen und beschreibt seine Eigenschaften. Und das 
                 	hat dann wieder viel mit Werten zu tun. Wenn F�hrung heute etwas braucht, dann ist es Werthaftigkeit. Respekt und Toleranz im Umgang miteinander 
                 	selbst da (oder gerade da), wo Kritik oder Meinungsverschiedenheiten vorherrschen. Das H�rbuch ist absolut h�renswert. Das Einzige, was mich gest�rt 
                 	hat, ist der Sprecher. Da Anselm Gr�n das H�rbuch selber bespricht, kann man ihn zwar akustisch wahrnehmen, doch er ist nicht der beste Vorleser. 
                 	Und so vermisste ich die Betonungen, die ich von Schauspielern gewohnt bin.
                  </p>
					<p>
						Verlag: Vier-T�rme-Verlag, ISBN 3-87868-978-0, 14,90 Euro
					</p>


                  
                  <p><br> <br></p>
                  <p><img src="../../_images/link.gif" width="12" height="10" align="absmiddle"><a href="javascript:history.go(-1);">Zur&uuml;ck</a></p>
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
