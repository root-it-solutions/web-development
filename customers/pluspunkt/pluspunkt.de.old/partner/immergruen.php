<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Immergrün";
$titel = "immergruen";
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
                  <p><b><img src="../_images/rub-immergruen.gif" width="266" height="20"></b></p>
                  <p align="left"><img src="_img/immergruen.jpg" width="85" height="66"></p>
                  <p> <b>Immergrün</b></p>
                  <p> Unter dem Kehlberg 19 <br>
                    58675 Hemer <br>
                    <br>
                    Fon: 0 23 72/ 1 40 42 <br>
                    Fax: 0 23 72/ 46 16</p>
                  <ul>
                    <li>Immergrün nutzt die Kraft der Natur. Ob in der Gestaltung 
                      von Außenanlagen, der Pflanzenproduktion, der sinnvollen 
                      Regenwassernutzung oder durch die durchdachte Erzeugung 
                      von Strom und Wärme. <br>
                    </li>
                  </ul>
                  <p> <img src="../_images/link.gif" width="12" height="10" align="absmiddle"> 
                    <a href="http://www.immergruen.de" target="_blank">www.immergruen.de</a></p>
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
