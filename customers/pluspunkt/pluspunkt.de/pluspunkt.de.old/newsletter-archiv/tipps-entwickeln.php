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
            <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b><font size="1">[ <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> ]</font></p>
                  <p>Tipps<br>
                    <br>
                    <b>Gehirngerechts Entwickeln von Ideen, Analysen, Vortr&auml;gen 
                    ... </b><br>
                    <br>
                    Sicherlich haben Sie schon etwas von Mindmaps geh&ouml;rt. 
                    Wir haben hierzu eine Software entdeckt, die wir einsetzen 
                    und von der wir sehr positiv &uuml;berrascht sind. Sie ist 
                    einfach zu handhaben, l&auml;sst sich leicht zu Powerpointpr&auml;sentationen 
                    oder zu HTML-Seiten umwandeln. Mehr Informationen und ein 
                    Download zum 3-w&ouml;chentlichen Test finden Sie <a href="http://www.mindjet.de" target="_blank">hier</a>.<br>
                    <br>
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
