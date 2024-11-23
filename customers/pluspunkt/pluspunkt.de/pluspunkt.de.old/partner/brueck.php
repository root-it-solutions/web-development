<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Bröker Catering & Event GmbH";
$titel = "brueck";
$hauptmenue=4;
$submenue=4;
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
              <tr bgcolor="#76797B" valign="top">
                <td>
                  <p><b><img src="../_images/rub-silke-brueck.gif" width="266" height="20"></b></p>
                  <p align="left"><img src="_img/partner-logo-brueck.jpg" width="85" height="66"></p>
                  <p> <b>Silke Br&uuml;ck</b></p>
                  <ul>
                    <li>&nbsp;Apothekenberatung</li>
                    <li>&nbsp;Coaching</li>
                    <li>&nbsp;Supervision</li>
                    <li>&nbsp;Antiaging</li>
                    <li>&nbsp;Ern&auml;hrungsberatung</li>
                  </ul>
                  <p>Am Eulenhorst 29<br>
                    81827 M&uuml;nchen <br>
                    <br>
                    Fon: 089/439 72 59 <br>
                    Fax: 089/444 995 84</p>
                  <p> <img src="../_images/link.gif" width="12" height="10" align="absmiddle">
                    <a href="http://www.silke-brueck.de" target="_blank">www.silke-brueck.de</a></p>
                  <p>&nbsp;</p>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="219" valign="top">&nbsp;</td>
          <td width="389" valign="top">
            <?php  include "../_inc/submenue.inc"; ?>
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