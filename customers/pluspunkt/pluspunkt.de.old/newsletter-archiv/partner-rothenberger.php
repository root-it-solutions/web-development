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
            <p>Partner<br>
              <br>
              <b>Rothenberger</b><br>
              <br>
              Viele Veranstaltungen, die wir mit Hotels organisieren und besuchen, 
              laufen nur durchschnittlich. Sicherlich k&ouml;nnen Sie diese Erfahrung 
              best&auml;tigen. Nur allzu selten gelingt es dem Partner uns mit 
              seiner Idee zu begeistern und uns zugleich so einzubinden, dass 
              wir uns wohl f&uuml;hlen. Und ohne professionelle Hilfe wird dies 
              ebenso unwahrscheinlich sein, wie ein Fu&szlig;ballspiel ohne Torwart 
              zu gewinnen.<br>
              <br>
              Unser Berater in Fragen rund um die Veranstaltung ist Bernhard Rothenberger. 
              Als Betriebswirt ist er Garant daf&uuml;r, dass man nicht schon 
              im Vorfeld falsch kalkuliert, um sp&auml;ter das Nachsehen zu haben. 
              Zudem vermag er durch seine Erfahrung in der Event-Organisation 
              an alle Details zu denken, die bei einer noch so gro&szlig;en Veranstaltung 
              zu ber&uuml;cksichtigen sind. So achtet er immer darauf, dass alle 
              Sinne angesprochen werden. Als Gastgeber habe ich den Vorteil, dass 
              meine G&auml;ste zufrieden sind, unabh&auml;ngig davon, welches 
              Sinnesorgan bei ihnen besonders ausgepr&auml;gt entwickelt ist.<br>
              <br>
              Wer das Au&szlig;ergew&ouml;hnliche sucht, um sich ein wenig abzusetzen, 
              ist bei Bernhard Rothenberger an der richtigen Adresse. Fragen Sie 
              ihn. Er gestaltet Ihre Veranstaltung oder Ihren Aufenthalt im <a href="http://www.parkhotel-hohenfeld.de" target="_blank">Parkhotel 
              Schloss Hohenfeld</a> nach Ihren W&uuml;nschen und den W&uuml;nschen 
              Ihrer G&auml;ste.<br>
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
