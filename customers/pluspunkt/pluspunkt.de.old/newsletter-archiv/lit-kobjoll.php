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
              <b>K. Kobjoll<br>
              </b><br>
              auf Empfehlung von Peter Wehrmann habe ich mir das H&ouml;rbuch 
              Motivaction von Klaus Kobjoll angeh&ouml;rt. Diese H&ouml;rbuch 
              ist hervorragend geeignet f&uuml;r alle F&uuml;hrungskr&auml;fte, 
              die die Motivation ihrer Mitarbeiter steigern wollen. Doch wenn 
              man nicht bereit ist, seinen Mitarbeitern zu vertrauen und nicht 
              loslassen kann, dann lohnt sich das Geld f&uuml;r das H&ouml;rbuch 
              nicht. Alle andern werden von den Beispielen Kobjolls begeistert 
              sein und gute Inspirationen erhalten, um vom Macher um Bewirker 
              zu werden. Vielleicht k&ouml;nnen auch Sie sich zum Management by 
              walking around entwickeln. <br>
              <br>
              Unter der ISBN-Nr.: 3-907595-40-8 gibt es im Rusch Verlag direkt 
              zwei H&ouml;rb&uuml;cher in einem. Dabei handelt es sich um das 
              Buch Motivaction, Begeisterung ist &uuml;bertragbar und das Buch 
              Motivaction 2, Virtuoses Marketing. Hier die Daten von <a href="http://www.amazon.de/exec/obidos/ASIN/3907595408/qid=1019630658/sr=1-7/ref=sr_1_3_7/028-7907961-7920530" target="_blank">Amazon</a>. 
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
