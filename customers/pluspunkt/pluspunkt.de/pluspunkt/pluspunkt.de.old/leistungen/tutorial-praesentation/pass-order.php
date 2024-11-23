<?php  include("../../_inc/db_zugang.inc");


IF ($_POST[pass] == "plustuto03")
{
  header("Location: http://www.pluspunkt.de/leistungen/tutorial-praesentation/index.php");
}
?>
<html>
<head>
<title>Pluspunkt Unternehmensentwicklung</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../plus-style.css">
<script language="JavaScript">
<!--
function click() {
if (event.button==2)
  window.external.AddFavorite('http://www.pluspunkt.de','Pluspunkt Unternehmensentwicklung GmbH');
}
document.onmousedown=click
// -->
</script>
</head>
<body bgcolor="#76797B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="" background="../../_images/hg-tutorial.jpg">
<table width="649" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td colspan="2" height="24">&nbsp;</td>
  </tr>
  <tr> 
    <td width="215" valign="top"> 
      <p>&nbsp;</p>
      </td>
    <td width="424" valign="top" bgcolor="#D6D6D6"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr bgcolor="#76797B" valign="top"> 
          <td height="300"> 
            <p><img src="../../_images/rub-praesentationstraining.gif" width="266" height="20"></p>
			<?php  include "formmail-passwort.php"; ?>
            </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<p>&nbsp;</p></body>
</html>
