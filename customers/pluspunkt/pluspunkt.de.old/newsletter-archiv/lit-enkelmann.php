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
              <b>C. Enkelmann<br>
              </b><br>
              Boris Becker sagte unl&auml;ngst in einem Interview nach seiner 
              Scheidung, dass Frauen und M&auml;nner nicht zueinander passen. 
              In der Tat sind Frauen und M&auml;nner sehr verschieden. Zum einen 
              liegt gerade hierin der besondere Reiz, zum anderen birgt dies auch 
              den Z&uuml;ndstoff f&uuml;r Konflikte. Claudia Enkelmann hat sich 
              diesem Thema angenommen und unter dem Titel Mit Liebe, Lust und 
              Leidenschaft ein H&ouml;rbuch im Aufsteiger Verlag ver&ouml;ffentlicht. 
              Neben vielen Hinweisen zum Ursprung der Unterschiede, die es einem 
              erm&ouml;glichen, seinen Lebenspartner besser zu verstehen, gibt 
              es sehr hilfreiche &Uuml;bungen, die praktiziert, die Partnerschaft 
              beleben. Dank der Ausgewogenheit zwischen Theorie und Praxis reiht 
              sich dieses H&ouml;rbuch qualitativ neben Dale Carnegie ein. <br>
              <br>
              ISBN 3-905357-12-7 &euro; 50,-. [<a href="http://www.amazon.de/exec/obidos/ASIN/3905357127/qid%3D1056358943/302-9401713-9280832" target="_blank">Amazon.de</a>]</p>
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
