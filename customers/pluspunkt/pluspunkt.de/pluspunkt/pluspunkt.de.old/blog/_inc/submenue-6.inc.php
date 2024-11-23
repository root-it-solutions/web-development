<p>
  <img src="../_images/trans.gif" width="1" height="5"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/<?php  if ($titel=="blog") echo "w-kasten-2.gif"; ELSE echo "w-kasten.gif"; ?>" width="13" height="10" align="absmiddle">&nbsp;
  <a href="index.php" target="_self">Blog</a> <br>
  <img src="../_images/trans.gif" width="1" height="5"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/<?php  if ($titel=="login") echo "w-kasten-2.gif"; ELSE echo "w-kasten.gif"; ?>" width="13" height="10" align="absmiddle">&nbsp;
  <a href="anmelden.php" target="_self">Anmelden</a> <br>
  <img src="../_images/trans.gif" width="1" height="5"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/<?php  if ($titel=="archiv") echo "w-kasten-2.gif"; ELSE echo "w-kasten.gif"; ?>" width="13" height="10" align="absmiddle">&nbsp;
  <a href="archiv.php" target="_self">Archiv</a> <br>
</p>
<br />
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle">
  &nbsp;Letzten 5 Artikel<br>
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
			`blog_date` DESC
		LIMIT
			1, 5;";
$query = $db->sql_query($sql);
while( $result = $db->sql_fetch_object($query) ) {
?>
<img src="../_images/trans.gif" width="1" height="5"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="../_images/w-kasten.gif" width="13" height="10" align="absmiddle">
  &nbsp;<a href="index.php?id=<?php  echo $result->blog_id;?>" target="_self"><?php  echo word_substr($result->blog_title,24);?></a><br>
<?php
}
?>
</p>
