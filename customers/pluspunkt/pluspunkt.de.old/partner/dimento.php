<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - dimento.com INTERNET KOMMUNIKATION";
$titel = "dimento";
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
                  <p><b><img src="../_images/rub-dimento.gif" width="266" height="20"></b></p>
                  <p align="left"><img src="_img/dimento.jpg" width="85" height="66"></p>
                  <p><b>Internetagentur</b><br>
                  </p>
                  <ul>
                    <li>&nbsp;Entwicklung und Programmierung von<br>
                      &nbsp;Portalen und&nbsp;Internetpr&auml;senzen</li>
                    <li> &nbsp;Internetmarketing</li>
                    <li>&nbsp;Corporate Identity</li>
                  </ul>
                  <p>Hammer Strasse 59<br>
                    48153 Münster <br>
                    <br>
                    Fon: 0 25 1/322 65 44 - 0<br>
                    Fax: 0 25 1/322 65 44 - 99</p>
                  <p> <img src="../_images/link.gif" width="12" height="10" align="absmiddle">
                    <a href="http://www.dimento.com" target="_blank">www.dimento.com</a></p>
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