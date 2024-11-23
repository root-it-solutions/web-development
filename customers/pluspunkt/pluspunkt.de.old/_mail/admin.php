<?php 
	include("_inc/db_zugang.inc");
	$Zeilen_pro_Seite = 20;
	if (!isset($seite))
	        { $seite = 0; }
	if ( $del == '1' ) {
		$db_del = mysql_query("delete from pp_mail where mid = '$_GET[mid]'",$db);
		header ("Location: ./admin.php");
	}
	if ($update == '1') {
		$sql_update = mysql_query ("update pp_mail set name='$name', vorname='$vorname', email='$email' where mid='$mid'",$db);
		header ("Location: ./admin.php");
	}
$name = mysql_query ("SELECT * FROM pp_mail ORDER BY name ASC LIMIT $seite,$Zeilen_pro_Seite",$db);
$name1 = mysql_query("select mid from pp_mail",$db);
$Anzahl = mysql_num_rows($name1);
?>
<html>
<head>
<title>Untitled Document</title>
</head>

<body>
<?php 
	if($edit != '1') {
?>
            <table width="600" border="0" cellspacing="1" cellpadding="2">
<?php 
			  
			  while ($name_rows = mysql_fetch_array($name)) {
?>
			   <tr>
                <td> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>
                      <td width="5%"><?php  echo $name_rows[name]?></td>
                      <td width="5%"><?php  echo $name_rows[vorname]?></td>
					  <td width="5%"><?php  echo $name_rows[email]?></td>
					  <td width="6%" valign="bottom"><div align="right"><a href="<?php $_SERVER["PHP_SELF"]?>?edit=1&mid=<?php  echo $name_rows[mid]?>">Edit</a>&nbsp;<a href="<?php $_SERVER["PHP_SELF"]?>?del=1&mid=<?php  echo $name_rows[mid]?>" onClick="return(confirm('Wollen Sie diesen Eintrag wirklich l&ouml;schen?'))">Delete</a>&nbsp;</div></td>
                    </tr>
				  	<hr>
                  </table>
                </td>
              </tr>
<?php 
			  }
?>
			  <tr>
			  	<td>
<?php 			  												if($seite > 0) {
                                                                            echo "<a href='admin.php?seite=0'> <<  </a>   ";
                                                                            $back=$seite-$Zeilen_pro_Seite;
                                                                            if($back < 0) {
                                                                                     $back = 0;
                                                                            }
                                                                            echo "<a href=\"admin.php?seite=$back\"> <  </a>   ";
                                                            }
                                                            if($Anzahl>$Zeilen_pro_Seite) {
                                                                            $Seiten=intval($Anzahl/$Zeilen_pro_Seite);
                                                                            if($Anzahl%$Zeilen_pro_Seite) {
                                                                                      $Seiten++;
                                                                            }
                                                            }
                                                            for ($i=1;$i<=$Seiten;$i++) {
                                                                            $fwd=($i-1)*$Zeilen_pro_Seite;
                                                                            echo "<a href=\"admin.php?seite=$fwd\">$i</a>   ";
                                                            }
                                                            if($seite < $Anzahl-$Zeilen_pro_Seite) {
                                                                            $fwd=$seite+$Zeilen_pro_Seite;
                                                                            echo "<a href=\"admin.php?seite=$fwd\">  > </a>   ";
                                                                            $fwd=$Anzahl-$Zeilen_pro_Seite;
                                                                            echo "<a href=\"admin.php?seite=$fwd\">  >> </a>";
                                                            }
?>
				</td>
			  </tr>
			</table>
<?php 
	}
	else {
		$edit = mysql_query ("SELECT * FROM pp_mail where mid='$mid'",$db);
?>
		<table>
			<form action="<?php $_SERVER["PHP_SELF"]?>" method="post" name="update">
			<input type="hidden" name="update" value="1">
<?php 
				while ($edit_rows = mysql_fetch_array($edit)) {
?>
			<tr>
				<input type="hidden" name="id" value="<?php  echo $edit_rows[id]?>">
				<td width="15">Name:</td><td><input type="text" width="30" name="name" value="<?php  echo $edit_rows[name]?>"></td>
			</tr>
			<tr>
				<td>Vorname:</td><td><input type="text" width="30" name="vorname" value="<?php  echo $edit_rows[vorname]?>"></td>
			</tr>
			<tr>
				<td>E-Mail:</td><td><input type="text" width="30" name="email" value="<?php  echo $edit_rows[email]?>"></td>
			</tr>
<?php 
				}
?>
			<tr>
				<td><input type="submit" name="Speichern" value="Speichern"></td>
			</tr>
			</form>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td><a href="javascript:history.back()" id="tgrey" class="tgrey">Zurück</a></td>
			</tr>
		</table>
<?php 
}
?>
</body>
</html>
