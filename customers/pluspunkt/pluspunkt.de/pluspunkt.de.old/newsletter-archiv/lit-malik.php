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
            <p>Literaturempfehlungen<br>
              <br>
              <b>F. Malik </b><br>
              <br>
              <b>Die Rollende Universit&auml;t </b><br>
              <br>
              nennt J&uuml;rgen H&ouml;ller das Auto, das dank guter H&ouml;rb&uuml;cher 
              f&uuml;r st&auml;ndige Inspirationen sorgt. Unsere Erfahrungen sind: 
            </p>
            <p>In den relativ unproduktiven Fahrtzeiten im Auto bekommen wir Zugang 
              zu jenen Fachb&uuml;chern, f&uuml;r die wir uns zu Hause kaum die 
              Zeit nehmen, sie zu lesen. </p>
            <p>Noch nie haben wir ein Fachbuch zweimal gelesen. Diverse H&ouml;rb&uuml;cher 
              haben wir schon dreimal geh&ouml;rt und dadurch besser verstanden. 
            </p>
            <p>Durch mehrfaches H&ouml;ren beeinflussen wir unser Verhalten; so 
              sind wir z.B. durch zahlreiche Inspirationen ruhiger geworden.</p>
            <p>Hier eine Verlagsauswahl: <br>
              <br>
              Campus verlegt z.B. Covey und Sprenger <br>
              Rusch verlegt Bestseller in Deutsch und Englisch <br>
              H&ouml;rbuchverlag verlegt Dale Carnegie und gute Literatur <br>
              <br>
              H&ouml;rbuchtipp: <br>
              <br>
              Fredmund Malik: Wirksam f&uuml;hren, Ausculta Verlag, ISBN 3-9500680-0-7 
              <br>
              S&uuml;ndhaft teuer (ca. DM 340,-) aber das Geld wert! </p>
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
