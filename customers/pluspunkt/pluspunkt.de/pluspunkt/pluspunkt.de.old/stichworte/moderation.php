<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Moderation";
$titel = "moderation";
$hauptmenue=1;
$submenue=3;
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
          <td width="389" valign="top"> 
            <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#d6d6d6" height="114">
              <tr> 
                <td> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#76797b">
                    <tr> 
                      <td valign="top"> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="20" height="173">
                          <tr bgcolor="#76797B" valign="top"> 
                            <td bgcolor="#76797B"> 
                              <p><b><img src="../_images/rub-moderation.gif" width="266" height="20"></b></p>
                              <p>Projektmanagement verlangt Moderation. Wir entwickeln 
                                Projektleiter in fachlicher, methodischer und 
                                sozialer Kompetenz. Bei Bedarf �bernhemen wir 
                                auch tempor�re Projektleitungen. </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
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
