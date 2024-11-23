<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Kleegräfe & Strothmann";
$titel = "strothmann";
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
                  <p><b><img src="../_images/rub-kleegraefe.gif" width="266" height="20"></b></p>
                  <p align="left"><img src="_img/kleegraefe.jpg" width="85" height="66"></p>
                  <p> <b>Die Couturies Kleegräfe + Strothmann GmbH & Co.KG<br>
                    </b>Mode und Handwerk </p>
                  <p> Haller Straße 117 <br>
                    33334 Gütersloh / Isselhorst <br>
                    <br>
                    Fon: 0 52 41/68 88 88 <br>
                    Fax: 0 52 41/68 88 87 </p>
                  <ul>
                    <li> Businessmode für Sie und Ihn</li>
                    <li>Maßfertigung für alle Anlässe<br>
                    </li>
                  </ul>
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
