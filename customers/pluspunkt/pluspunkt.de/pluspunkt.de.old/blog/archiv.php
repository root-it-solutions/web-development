<?php 
require "_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Blog";
$titel = "archiv";
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
              <tr bgcolor="#76797B">
                <td height="240" valign="top">
                <?php 
                	$sql = "SELECT
                				b.`blog_id`,
                				b.`blog_title`,
                				b.`blog_date`,
                				u.`user_full_name`
                			FROM
                				`" .  __table_blog__ . "` AS `b`
                			LEFT JOIN
                				`" . __table_user__ . "` AS `u`
                			ON
                				u.`user_id` = b.`blog_author` 
                			ORDER BY
                				`blog_date` DESC;";
                	$query = $db->sql_query($sql);
                	
                	while( $result = $db->sql_fetch_object($query) ) {
                ?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr> 
					    <td width="80%" height="18px"><em><a href="index.php?id=<?php  echo $result->blog_id;?>"><?php  echo stripslashes($result->blog_title); ?></a></em></td>
					    <td><?php  echo date('d.m.Y', $result->blog_date);  ?></td>
					  </tr>
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
