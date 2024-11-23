<?php 
session_start();
ob_clean();
require "_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Blog";
$titel = "add_image";
$hauptmenue=2;
$submenue= (session_is_registered('user_id')) ? 7 : 6;
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
			<form enctype="multipart/form-data" method="post" action="bild_hochladen.php">
              <tr bgcolor="#76797B">
                <td valign="top" height="200"> 
                <?php 
                if(session_is_registered('user_id')) {
				if(empty($_POST['do'])) {
				?>
                <p>Bildquelle (nur .jpg, .gif, .png und maximal 2MB)<br>
                <input type="file" name="bild" size="50"></p>
                <p>Alternativtext (optional)<br>
                <input type="text" name="alt" size="60"></p>
                <p>
                <input type="submit" name="do" value="Hochladen"></p>
                <?php 
				} else {
                $sql = "INSERT INTO
							`" . __table_image__ . "`
							(`image_name`)
						VALUES
							('" . $_FILES['bild']['name'] . "');";
				$query = $db->sql_query($sql);
				$bild_id = mysql_insert_id();
				$i_class = new image($_FILES['bild'], '_images/', 100, $bild_id);
				$i_class->thumb(75, '_tn/');
				$i_class->resize(300);
				$i_class->chmod(0777);  
				$bildName = $i_class->getFileName();
				$sql = "UPDATE
							`" . __table_image__ . "`
						SET
							`image_path` = '_images/" . $bildName . "',
							`image_alt` = '" . mysql_escape_string($_POST['alt']) . "',
							`image_author` = '" . $_SESSION['user_id'] . "',
							`image_thumb` = '_images/_tn/" . $bildName . "'
						WHERE
							`image_id` = " . $bild_id . ";";
				$query = $db->sql_query($sql);
                
				?>
				Das Bild wurde erfolgreich hochgeladen.<br>
				<a href="bild_hochladen.php">Klicken Sie hier, um ein weiteres Bild hochzuladen.</a>
                <?php 
				}
                } else {
				  ?>
				  Sie sind nicht berechtigt diesen Bereich aufzurufen.
				  <?php 
                  }
				  ?>
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
