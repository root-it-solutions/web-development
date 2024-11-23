<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Bildergalerie Inspiration 2006";
$titel = "Assessment";
$rub = "Assessment";
$hauptmenue=0;
$submenue=1;
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#999999" vlink="#999999" alink="#999999">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<table width="640" border="0" cellspacing="0" cellpadding="0" align="center" name="content">
  <tr> 
    <td bgcolor="#77787C" width="628">
      <table width="608" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td colspan="2" height="24">&nbsp;</td>
        </tr>
        <tr> 
          <td width="219" valign="top"> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
            &nbsp;<a href="javascript:history.go(-1);" target="_self">Zur&uuml;ck</a></td>
          <td width="500" valign="top" bgcolor="#D6D6D6"> 
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr bgcolor="#76797B" valign="top"> 
                <td bgcolor="#000000" height="350"> 
                  <p align="center"><br>
                    <a href="javascript:history.go(-1);"><img src="../_images/inspiration-2006/gr/Inspiration-<?php  echo $_GET[bild]?>.jpg" border="1" alt="Zur&uuml;ck zur Galerie"></a></p>
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
