<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Tutorials";
$titel = "tutorials";
$hauptmenue=2;
$submenue=2;
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
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
              <tr bgcolor="#76797B"> 
                <td height="300"> 
                  <p><b><img src="../_images/tutorials.gif" width="74" height="15"></b></p>
                  <p>In dieser Rubrik werden Sie von Pluspunkt erstellte &Uuml;bungen 
                    und Veranschaulichungen zu verschiedenen Themen finden. Wir 
                    bitten um Ihr Verst&auml;ndnis, dass diese nicht zum download 
                    bereitgestellt werden. Das Copyright liegt bei Pluspunkt.</p>
                  <p><img src="../_images/link.gif" width="12" height="10"> <a href="#" onClick="MM_openBrWindow('tutorial-praesentation/pass.php','','scrollbars=yes,width=700,height=400')">Pr&auml;sentationstraining</a> 
                    <font color="#CCCCCC"> Autor: Ralf Lohe</font></p>
                  <p>&nbsp;</p>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
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
