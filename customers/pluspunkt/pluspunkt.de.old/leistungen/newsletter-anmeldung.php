<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Newsletter Anmeldung";
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
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<table width="640" border="0" cellspacing="0" cellpadding="0" align="center" name="content">
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
                  <p><b><img src="../_images/rub-newsletter-anmeldung.gif" width="266" height="20"></b></p>
                  <p>Sehr geehrter Besucher,</p>
                  <p>wir bieten Ihnen diesen Newsletter an, damit Sie zuk&uuml;nftig 
                    aktuelle Mitteilungen einfach per E-mail erreichen. Folgende 
                    Inhalte sind Bestandteil eines Pluspunkt Newsletters:</p>
                  <ul>
                    <li>Literaturempfehlungen</li>
                    <li>Berichte aus den Unternehmen</li>
                    <li>Tipps rund ums F&uuml;hren einer Unternehmung</li>
                    <li>News von unseren Partnern</li>
                    <li>Neue Seminartermine</li>
                  </ul>
                  <p> 
                    <?php  include "formmail.php"; ?>
                  </p>
                  <p><br>
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
</table>
<?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
