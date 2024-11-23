<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Kontaktformular";
$titel = "kontaktformular";
$hauptmenue=5;
$submenue=5;
ini_set('include_path', ini_get('include_path') . ':' . dirname(__FILE__) . '/../library');
require_once 'Zend/Session/Namespace.php';
$session = new Zend_Session_Namespace();
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
                        <p><b><img src="../_images/rub-e-mail-formular.gif" width="266" height="20"></b></p>
                        <p>
                          <?php  include "formmail.php"; ?>
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
