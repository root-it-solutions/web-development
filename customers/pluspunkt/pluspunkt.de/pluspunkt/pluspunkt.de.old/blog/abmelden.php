<?php 
session_start();
require "_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Blog";
$titel = "login";
$hauptmenue=2;
$submenue = 6;
require_once($cfg['pfad1']."c_db.class.php");
require_once($cfg['pfad1']."upload.class.php");
$db = new c_db($cfg['SQL_Database']['Server'],$cfg['SQL_Database']['User'],$cfg['SQL_Database']['Passwort'],$cfg['SQL_Database']['Name']);

?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="plus-style.css" type="text/css">
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  require "_inc/header-$hauptmenue.inc.php"; ?>

<table width="640" border="0" cellspacing="0" cellpadding="0" align="center" name="content">
  <tr>
    <td bgcolor="#77787C" width="628" valign="top">
      <table width="608" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td colspan="2" height="24">&nbsp;</td>
        </tr>   
        <tr>
          <td width="219" valign="top">
            <?php  require "_inc/submenue-$submenue.inc.php"; ?>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6">
            <!-- start -->  
			<table width="100%" border="0" cellspacing="0" cellpadding="20">
			<form method="post" action="anmelden.php">
              <tr bgcolor="#76797B">
                <td valign="top" height="200"> 
                <?php 
				unset($_SESSION['user_id']);
                ?>
                <p>Benutzername<br>
                <input type="text" name="user" size="60"></p>
                <p>Passwort<br>
                <input type="password" name="pass" size="60"></p>
                <p><input type="submit" name="do" value="Anmelden" size="60"></p>
                </td>
              </tr>
              </form>
            </table>
			<!-- ende -->
          </td>
        </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table>
<?php  require "_inc/footer.inc.php"; ?>
</body>
</html>
