<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - DVD-Trainer";
$titel = "dvdtrainer";
$hauptmenue=2;
$submenue=2;
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
    <td bgcolor="#77787C" width="628" valign="top">
      <table width="608" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td colspan="2" height="24">&nbsp;</td>
        </tr>
        <tr>
          <td width="219" valign="top">
            <?php  require "../_inc/submenue-$submenue.inc.php"; ?>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6">
            <!-- start -->
			<table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B">
                <td valign="top">
                  <p><b><img src="../_images/rub-dvdtrainer.gif" width="266" height="20"></b></p>

                    <p><b>Die Themen</b>:</p>
                  Motivierende Gespr&auml;che:<br>
                  <ul>
                    <li>&nbsp;<a href="dvd-trainer-inhalt.php#analysemeeting">Das Analyse-Meeting</a></li>
                    <li>&nbsp;<a href="dvd-trainer-inhalt.php#kritikgespraech">Das Kritik-Gespr&auml;ch</a></li>
                    <li>&nbsp;<a href="dvd-trainer-inhalt.php#kreativmeeting">Das Kreativ-Meeting</a></li>
                    <li>&nbsp;<a href="dvd-trainer-inhalt.php#delegationsgespraech">Das Delegations-Gespr&auml;ch</a></li>
                  </ul>
				</td>
              </tr>
              <tr bgcolor="#76797B">
                <td>&nbsp;</td>
              </tr>
              <tr bgcolor="#76797B">
                <td>&nbsp;</td>
              </tr>
              <tr bgcolor="#76797B">
                <td>&nbsp;</td>
              </tr>
            </table>
			<!-- ende -->
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