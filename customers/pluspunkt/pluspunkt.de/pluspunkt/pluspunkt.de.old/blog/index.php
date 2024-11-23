<?php 
require "_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Blog";
$titel = "blog";
$hauptmenue=2;
$submenue=6;
require_once($cfg['pfad1']."c_db.class.php");
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
              <tr height="240px" bgcolor="#76797B">
                <td valign="top">
                <?php 
                	$sql = "SELECT COUNT(*) AS `count` FROM `" . __table_blog__ . "`;";
                	$query = $db->sql_query($sql);
                	$result = $db->sql_fetch_object($query);
                	$blog_count = $result->count;
                	if( $_GET['page'] == 0 ) {
                		if( $blog_count == 1 ) {
	                		$blog_page = '<tr> 
										    <td valign="top">&nbsp;</td>
										    <td align="center" valign="top">&nbsp;</td>
										    <td align="center" valign="top">&nbsp;</td>
										    <td valign="top">&nbsp;</td>
										  </tr>';
                		} else {
                			$blog_page = '<tr> 
									    <td valign="top">&nbsp;</td>
									    <td align="center" valign="top">&nbsp;</td>
									    <td align="center" valign="top"><a href="?page=1">&Auml;ltere Artikel &raquo;</a></td>
									    <td valign="top">&nbsp;</td>
									  </tr>';
                		}
                	} else {
                		if( $_GET['page'] < ($blog_count - 1) ) {
	                		$blog_page = '<tr> 
										    <td valign="top">&nbsp;</td>
										    <td align="center" valign="top"><a href="?page=' . ($_GET['page'] - 1) . '">&laquo; Neuere Artikel</a></td>
										    <td align="center" valign="top"><a href="?page=' . ($_GET['page'] + 1) . '">&Auml;ltere Artikel &raquo;</a></td>
										    <td valign="top">&nbsp;</td>
										  </tr>';
                		} else {
                			$blog_page = '<tr> 
										    <td valign="top">&nbsp;</td>
										    <td align="center" valign="top"><a href="?page=' . ($_GET['page'] - 1) . '">&laquo; Neuere Artikel</a></td>
										    <td align="center" valign="top">&nbsp;</td>
										    <td valign="top">&nbsp;</td>
										  </tr>';
                		}
                	}
                	$start = (int)$_GET['page'];
                	$stop = 1;
                	$where = (!empty($_GET['id']) ) ? "WHERE `blog_id` = '" . mysql_escape_string($_GET['id']) . "'" : "";
                	$sql = "SELECT
                				b.`blog_title`,
                				b.`blog_date`,
                				b.`blog_content`,
                				u.`user_full_name`
                			FROM
                				`" .  __table_blog__ . "` AS `b`
                			LEFT JOIN
                				`" . __table_user__ . "` AS `u`
                			ON
                				u.`user_id` = b.`blog_author` 
                			" . $where . "
                			ORDER BY
                				`blog_date` DESC
                			LIMIT
                				" . $start . ", " . $stop . ";";
                	$query = $db->sql_query($sql);
                	while( $result = $db->sql_fetch_object($query) ) {
                ?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
					    <td colspan="4"><em><?php  echo stripslashes($result->blog_title); ?></em> &middot; <?php  echo date('d. F Y H:i', $result->blog_date);  ?></td>
					  </tr>
					  <tr> 
					    <td width="5%" valign="top"><font size="+4">&#8220;</font></td>
					    <td width="90%" colspan="2" valign="top" class="content"><br>
					    <?php  echo nl2br(stripslashes($result->blog_content)); ?>&nbsp;</td>
					    <td width="5%" valign="bottom"><font size="+4">&#8222;</font></td>
					  </tr>
					  <tr> 
					    <td colspan="4" valign="top">&nbsp;</td>
					  </tr>
					  <?php 
					  echo ( empty($where) ) ? $blog_page : '';
					  ?>
					</table>
				<?php 
             		}
            	?>
                 </td>
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
<?php  require "_inc/footer.inc.php"; ?>
</body>
</html>
