<?php  
    date_default_timezone_set('Europe/Berlin');

#ini_set('include_path', ini_get('include_path') . ':' . dirname(__FILE__) . '../library');
session_start();

require "../_inc/db_zugang.inc.php";

$seitentitel = "Pluspunkt Unternehmensentwicklung - Anschrift";
$titel = "anschrift";
$hauptmenue=5;
$submenue=5;
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
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr bgcolor="#76797B" valign="top"> 
                <td height="300" bgcolor="#76797B"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="20">
                    <tr bgcolor="#76797B" valign="top"> 
                      <td> 
                        <p><b><img src="../_images/rub-anschrift.gif" width="266" height="20"></b></p>
                        <p><b>Pluspunkt GmbH </b><br>
                          Ostereckern 9<br>
                          59387 Ascheberg<br>
                          <br>
                          Tel: 02593 - 95 888 0 <br>
                          Fax: 02593 - 95 888 01 <br>
                          <br>
                          <span onclick="javascript:linkTo_UnCryptMailto('rfnqEuqzxuzspy3ij');" style="cursor:pointer; display:block; width:148px; background:url('../_images/a.gif') right bottom no-repeat;">E-Mail:</span><br>
                          http://<a href="http://www.pluspunkt.de" target="_blank">www.pluspunkt.de</a></p>
                        <p>&nbsp;</p>
                        <p><img src="../_images/rub-ansprechpartner.gif" width="266" height="20"></p>
                        <p><b>Manfred Rumi </b><br>
                          Kapellenstraﬂe 20 <br>
                          48317 Rinkerode <br>
                          <br>
                          Telefon: 02538 -9 51 97 <br>
                          Fax: 02538 - 9 51 98 <br>
                          <br>
                          <span onclick="javascript:linkTo_UnCryptMailto('rwzrnEuqzxuzspy3ij');" style="cursor:pointer; display:block; width:160px; background:url('../_images/b.gif') right bottom no-repeat;">E-Mail:</span></p>
                        <p><b>Ralf Lohe</b><br>
                          Ostereckern 9<br>
                          59387 Ascheberg<br>
                          <br>
                          Tel: 02593 - 95 888 0 <br>
                          Fax: 02593 - 95 888 01 <br>
                          <br>
                          <span onclick="javascript:linkTo_UnCryptMailto('qtmjEuqzxuzspy3ij');" style="cursor:pointer; display:block; width:148px; background:url('../_images/c.gif') right bottom no-repeat;">E-Mail:</span>
                        </p>
            </td>
                    </tr>
                  </table>
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
