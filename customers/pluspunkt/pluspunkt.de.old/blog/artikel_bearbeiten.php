<?php 
session_start();
ob_clean();
require "_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Blog";
$titel = "edit_blog";
$hauptmenue=2;
$submenue= (session_is_registered('user_id')) ? 7 : 6;
require_once($cfg['pfad1']."c_db.class.php");
$db = new c_db($cfg['SQL_Database']['Server'],$cfg['SQL_Database']['User'],$cfg['SQL_Database']['Passwort'],$cfg['SQL_Database']['Name']);

?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="plus-style.css" type="text/css">
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	theme : "advanced",
	mode : "textareas",
	theme_advanced_toolbar_location : "top",
	language : "de"
});
</script>
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
              <tr bgcolor="#76797B">
                <td valign="top" height="200"> 
                  <?php 
                  if(session_is_registered('user_id')) {
                  if($_GET['action'] == 'delete') {
                  	$sql = "DELETE FROM
                  				`" . __table_blog__ . "`
                  			WHERE
                  				`blog_id` = '" . mysql_escape_string($_GET['id']) . "';";
                  	$query = $db->sql_query($sql);
                  	?>
					  Der Eintrag wurde erfolgereich gel&ouml;scht.<br>
					  <a href="artikel_bearbeiten.php">Hier gelangen Sie wieder zur &Uuml;bersicht.</a>
					  <?php 
                  }
                  elseif($_GET['action'] == 'show' AND empty($_POST['do'])) {
              	 $sql = "SELECT
			  			`blog_id`,
			  			`blog_title`,
			  			`blog_content`
			  		FROM
			  			`" . __table_blog__ . "`
			  		WHERE
			  			`blog_id` = '" . mysql_escape_string($_GET['id']) . "';";
				  $query = $db->sql_query($sql);
				  $result = $db->sql_fetch_object($query);	
				  ?>
				  <form method="post" action="artikel_bearbeiten.php?action=show&id=<?php echo $result->blog_id;?>">
                  <p>Titel<br>
                  <input type="text" name="title" size="60" value="<?php  echo $result->blog_title; ?>"></p>
                  Inhalt<br>
                  <textarea name="content" cols="70" rows="20"><?php  echo stripslashes($result->blog_content); ?></textarea>
                  <p><input type="submit" value="Speichern" name="do"></p>
                  <?php 
                  } elseif($_GET['action'] == 'show' AND $_POST['do'] == 'Speichern') {
                  	$sql = "UPDATE
                  				`" . __table_blog__ . "`
                  			SET
                  				`blog_title` = '" . mysql_escape_string($_POST['title']) . "', 
                  				`blog_content` = '" . mysql_escape_string($_POST['content']) . "'
                  			WHERE
                  				`blog_id` = '" . mysql_escape_string($_GET['id']) . "';";
				  	$query = $db->sql_query($sql);
                  ?>
				  Der Eintrag wurde erfolgereich aktualisiert.<br>
				  <a href="artikel_bearbeiten.php">Hier gelangen Sie wieder zur &Uuml;bersicht.</a>
				  <?php 
                  } else {
                  ?>
				  <table width="100%" border="0" cellspacing="2" cellpadding="0">
                  <?php 

				  $sql = "SELECT
				  			b.`blog_id`,
				  			b.`blog_date`,
				  			b.`blog_title`,
				  			u.`user_username`
				  		FROM
				  			`" . __table_blog__ . "` AS `b`
				  		LEFT JOIN
				  			`" . __table_user__ . "` AS `u`
				  		ON
				  			u.`user_id` = b.`blog_author`
				  		ORDER BY
				  			b.`blog_date` DESC;";
				  $query = $db->sql_query($sql);
				  while($result = $db->sql_fetch_object($query)) {			  			
				  ?>
                   <tr> 
				    <td width="18%"><?php  echo date('d.m.y', $result->blog_date); ?></td>
				    <td width="57%"><?php  echo $result->blog_title; ?></td>
				    <td width="15%"><?php  echo $result->user_username; ?></td>
				    <td width="5%">[<a href="artikel_bearbeiten.php?action=show&id=<?php echo $result->blog_id;?>">B</a>]</td>
				    <td width="5%">[<a onclick="return confirm('Diesen Artikel wirklich löschen?')" href="artikel_bearbeiten.php?action=delete&id=<?php echo $result->blog_id;?>">L</a>]</td>
				  </tr>
				  <?php 
				  }
				  ?>
				  </table> 
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
