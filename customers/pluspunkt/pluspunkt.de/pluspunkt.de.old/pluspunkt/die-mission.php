<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Die Mission";
$titel = "mission";
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
                  <p><b><img src="../_images/rub-mission.gif" width="320" height="20"></b></p>
                  <p><b>Pluspunkt berät </b>Führungskräfte und deren Mitarbeiter 
                    in allen Fragen der Unternehmensleitung und -entwicklung. 
                  </p>
                  <p><b>Pluspunkt schafft </b>die Rahmenbedingungen für Unternehmensentwicklungsleistungen 
                    und koordiniert sie. Wir arbeiten ausschließlich mit ausgewählten 
                    Partnern zusammen. </p>
                  <p><b>Unser Anspruch:</b> wir unterstützen unsere Kunden, indem 
                    wir alle Prozesse ganzheitlich betrachten, Veränderungsprozesse 
                    zusammen mit den Betroffenen entwickeln und die Projektleitung 
                    in der Umsetzungsphase koordinieren. </p>
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
