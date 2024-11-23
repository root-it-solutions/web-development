<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Führung";
$titel = "fuehrung";
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
                              <p><b><img src="../_images/rub-fuehrung.gif" width="266" height="20"></b></p>
                              <p>Wir vermitteln Ihnen das Rüstzeug für das Führen 
                                von Menschen, die ergebnisorientiert und verantwortlich 
                                Leistungen erbringen. <br>
                                <br>
                                Für Einzelpersonen nutzen Sie unser <img src="../_images/link.gif" width="12" height="10" align="absmiddle"> 
                                <a href="../leistungen/index-seminare.php" target="_top">Seminarangebot</a>. 
                                Für Unternehmen entwickeln wir Ihnen ein maßgeschneidertes 
                                Konzept auf der Basis unserer langjährigen Erfahrungen. 
                              </p>
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
