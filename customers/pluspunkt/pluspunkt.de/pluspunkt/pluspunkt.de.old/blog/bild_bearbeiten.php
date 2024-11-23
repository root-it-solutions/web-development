<?php 
session_start();
ob_clean();
require "_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Blog";
$titel = "edit_image";
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
			<form enctype="multipart/form-data" method="post" action="bild_bearbeiten.php">
              <tr bgcolor="#76797B">
                <td valign="top" height="200">               
                <?php 
                if(session_is_registered('user_id')) {
                if(empty($_POST['do'])) {
                ?>
                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                <?php 
                $sql = "SELECT
                			`image_id`,
                			`image_alt`,
                			`image_path`,
                			`image_thumb`
                		FROM
                			`" . __table_image__ . "`
                		ORDER BY
                			`image_id` DESC;";
                $query = $db->sql_query($sql);
                while($result = $db->sql_fetch_object($query)) {
				?>
				  <tr>
				    <td rowspan="3"><img src="<?php  echo $result->image_thumb; ?>" alt="<?php  echo $result->image_alt; ?>"></td>
				    <td>L&ouml;schen?</td>
				    <td><input type="checkbox" name="delete_image[]" value="<?php echo $result->image_id;?>"></td>
				  </tr>
				  <tr> 
				    <td>Alternativtext</td>
					<td><input type="text" name="alt[]" value="<?php  echo $result->image_alt; ?>" size="28">
					<input type="hidden" name="ids[]" value="<?php  echo $result->image_id; ?>"></td>			  
				  </tr>
				  <tr>
				    <td>Bildpfad</td>
				  	<td><input type="text" name="pfad" value="<?php  echo 'http://' . $_SERVER['HTTP_HOST'] . '/blog/'. $result->image_path; ?>" size="28"></td>
				  </tr>
				  <tr>
				  	<td>&nbsp;</td>
				  	<td>&nbsp;</td>
				  </tr>
				<?php 
                }
                ?>
                <tr>
				  	<td colspan="2"><input type="submit" value="Speichern" name="do"></td>
				</tr>
				</table>
                <?php 
                } else {
                	for($i = 0; $i < count($_POST['ids']); $i++) {
                		$sql = "UPDATE
                					`" . __table_image__ . "`
                				SET
                					`image_alt` = '" . mysql_escape_string($_POST['alt'][$i]) . "'
                				WHERE
                					`image_id` = '" . mysql_escape_string($_POST['ids'][$i]) . "';";
                		$query = $db->sql_query($sql);
                	}
                	if($_POST['delete_image'] != NULL) {
	                	foreach($_POST['delete_image'] as $image_id) {
		                	$sql = "SELECT
		                				`image_path`,
		                				`image_thumb`
		                			FROM
		                				`" . __table_image__ . "`
		                			WHERE
		                				`image_id` = '" . mysql_escape_string($image_id) . "';";
		                	$query = $db->sql_query($sql);
		                	$result = $db->sql_fetch_object($query);
		                	if(file_exists($result->image_path)) {
		                		unlink($result->image_path);
		                	}
		                	if(file_exists($result->image_thumb)) {
		                		unlink($result->image_thumb);
		                	}
		                	$sql = "DELETE FROM
		                				`" . __table_image__ . "`
		                			WHERE
		                				`image_id` = '" . mysql_escape_string($image_id) . "';";
		                	$query = $db->sql_query($sql);
	                	}
                	}
				?>
				Die Bilder wurden erfolgreich gespeichert.<br>
				<a href="bild_bearbeiten.php">Klicken Sie hier, um zur &Uuml;bersicht zu gelangen.</a>
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
