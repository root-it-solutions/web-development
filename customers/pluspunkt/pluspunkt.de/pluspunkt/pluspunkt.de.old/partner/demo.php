<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Unsere Partner";
$titel = "partnerschaft";
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
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr bgcolor="#76797B" valign="top"> 
                <td height="300" bgcolor="#76797B"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="20">
                    <tr bgcolor="#76797B" valign="top"> 
                      <td> 
                        <p><b><img src="../_images/rub-partnerschaft.gif" width="266" height="20"></b></p>
                        <p><img src="_images/broeker.jpg" width="90" height="66"><img src="_images/dimento.jpg" width="90" height="66"> 
                          <img src="_images/immergruen.jpg" width="90" height="66"> 
                          <img src="_images/intectum.jpg" width="90" height="66"> 
                          <img src="_images/kleegraefe.jpg" width="90" height="66"> 
                          <img src="_images/markplan.jpg" width="90" height="66"> 
                          <br>
                          <img src="_images/reha-kliniken.jpg" width="90" height="66"> 
                          <img src="_images/rothenberger.jpg" width="90" height="66"> 
                          <img src="_images/schlotmann.jpg" width="90" height="66"> 
                          <br>
                          <img src="_images/schnitgker.jpg" width="90" height="66"> 
                          <br>
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
