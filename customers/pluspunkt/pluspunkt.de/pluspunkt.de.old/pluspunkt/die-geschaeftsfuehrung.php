<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Die Geschäftsführung";
$titel = "geschaeftsfuehrung";
$hauptmenue=1;
$submenue=1;
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
                  <p><b><img src="../_images/rub-geschaeftsfuehrung.gif" width="266" height="20"></b></p>
                  <p><b>Die Pluspunkt GmbH</b> wird von den zwei geschäftsführenden 
                    Gesellschaftern </p>
                  <p><img src="../_images/link.gif" width="12" height="10" align="absmiddle"> 
                    <a href="die-geschaeftsfuehrung-lohe.php" target="_self">Ralf 
                    Lohe</a> und <br>
                    <br>
                    <img src="../_images/link.gif" width="12" height="10" align="absmiddle"> 
                    <a href="die-geschaeftsfuehrung-rumi.php" target="_self">Manfred 
                    Rumi</a> geleitet.</p>
                  <p>&nbsp;</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td colspan="2" valign="top">&nbsp; </td>
        </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table>
<?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
