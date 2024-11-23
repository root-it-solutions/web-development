<?php 
session_start();
require "_inc/db_zugang.inc.php";
require "_inc/weblogpinger.php";
$seitentitel = "Pluspunkt Blog";
$titel = "add_blog";
$hauptmenue=2;
$submenue= (session_is_registered('user_id')) ? 7 : 6;
require_once($cfg['pfad1']."c_db.class.php");
$db = new c_db($cfg['SQL_Database']['Server'],$cfg['SQL_Database']['User'],$cfg['SQL_Database']['Passwort'],$cfg['SQL_Database']['Name']);

?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	theme : "advanced",
	mode : "textareas",
	theme_advanced_toolbar_location : "top",
	language : "de"
});
</script>
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
			<form method="post" action="artikel_hinzufuegen.php">
              <tr bgcolor="#76797B">
                <td valign="top" height="200"> 
                  <?php 
                  if(session_is_registered('user_id')) {
                  if(empty($_POST['do'])) {
				  ?>
                  <p>Titel<br>
                  <input type="text" name="title" size="60"></p>
                  Inhalt<br>
                  <textarea name="content" cols="70" rows="20">&nbsp;</textarea>
                  <p><input type="submit" value="Eintragen" name="do"></p>
                  <?php 
                  } else {
                  	$sql = "INSERT INTO
                  				`" . __table_blog__ . "`
                  				(`blog_title`, `blog_author`, `blog_date`, `blog_content`)
                  			VALUES
                  				('" . mysql_escape_string($_POST['title']) . "', '" . $_SESSION['user_id'] . "', '" . time() . "', '" . mysql_escape_string($_POST['content']) . "');";
				  	$query = $db->sql_query($sql);
				  	$insert_id = mysql_insert_id();
				  	$pinger = new Weblog_Pinger();
				  	$pinger->ping_ping_o_matic("Pluspunkt - " . $_POST['title'], "http://www.pluspunkt.de/blog/index.php?id=".$insert_id, "http://www.pluspunkt.de/blog");
					$pinger->ping_all("Pluspunkt - " . $_POST['title'], "http://www.pluspunkt.de/blog/index.php?id=".$insert_id, "http://www.pluspunkt.de/blog");
                  ?>
				  Der Eintrag wurde erfolgereich gespeichert.<br>
				  <a href="index.php">Der Artikel kann hier angezeigt werden.</a>
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
