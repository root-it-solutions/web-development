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
                    <b>Erfolgsfaktor Innovation</b></p>
            <p>Unternehmen werden immer wieder vor fast unl&ouml;sbare Fragen 
                    gestellt. Aktuell m&uuml;ssten z.B. viele Unternehmen ihre 
                    Preise anheben, da die Rohstoff- bzw. Produktionskosten angestiegen 
                    sind. Auf der anderen Seite erwarten Kunden in den Zeiten 
                    von &quot;Geiz ist geil&quot;, dass alles st&auml;ndig billiger 
                    wird und wandern zum billigeren Anbieter ab. Was ist also 
                    zu tun, wenn sich zwei Ziele auszuschlie&szlig;en scheinen. 
                  </p>
                  <p>Genau hier setzt die Methode der Widerspruchsorientierten 
                    Innovationsstrategie ein. Es ist erstaunlich, welche Kreativit&auml;t 
                    freigesetzt wird, wenn der Widerspruch zum Gegenstand des 
                    L&ouml;sungsprozesses wird. Die Beispiele aus der aktuellen 
                    Anwendung dieser Methode sind beeindruckend und f&uuml;r die 
                    Unternehmen, die sie realisiert haben, &auml;u&szlig;erst 
                    lukrativ.</p>
                  <p>Im Kreise der Pluspunkt-Partner konnten wir schon einen ersten 
                    Eindruck von dieser Methode bekommen, mit der wir jetzt bisher 
                    unl&ouml;sbare Aufgaben analysieren und l&ouml;sen.</p>
                  <p>Unser Partner Intectum hat diese Methode in die Beratungskompetenz 
                    mit aufgenommen und stellt sie jetzt auf einem Workshop am 
                    18. Februar 2005 in Paderborn vor. Wer ein Unternehmen leitet 
                    oder mit entsprechenden Kompetenzen ausgestattet ist, kann 
                    sich hierzu &uuml;ber das Internet anmelden [<a href="http://www.intectum.de/intectum/WorkshopInnovation.html" target="_blank">Link</a>]. 
                    Die Teilnahmegeb&uuml;hr betr&auml;gt Euro 190.<br>
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
