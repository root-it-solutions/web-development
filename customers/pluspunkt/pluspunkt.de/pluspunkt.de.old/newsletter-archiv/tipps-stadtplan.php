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
            <p>Tipps<br>
              <br>
              <b>Stadtplan.de</b><b><br>
              </b><br>
              Solange noch nicht jeder ein Navigationsgr&auml;t im Auto hat, sind 
              wir noch auf Karten und Stadtpl&auml;ne angewiesen. Was aber, wenn 
              wir den passenden Stadtplan nicht zur Hand haben. Dann k&ouml;nnen 
              Sie diesen im Internet aufrufen und sich das Reiseziel auch ausdrucken. 
              Die meisten deutschen St&auml;dte (vor allem die Gr&ouml;&szlig;eren) 
              finden Sie schnell under <a href="http://www.stadtplan.de" target="_blank">stadtplan.de</a>. 
              Wenn Ihnen diese Service gef&auml;llt, vergessen Sie nicht ein Lesezeichen 
              zu setzen.<br>
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
