<?php 
include("_inc/db_zugang.inc");
?>
<html>
<head>
<title>Untitled Document</title>
</head>

<body>
<?php 
	if ($send == '1') {
		$sql_mail = mysql_query("SELECT * FROM pp_mail",$db);
		$email_to="elohe@gmx.de";
		$email_body='<html><body><table><tr><td>'.$body.'</td></tr><tr><td><a href="'.$link.'" target="_blank">google</a></td></tr></table></body></html>';
//		$anz= mysql_num_rows($sql_mail);
//		echo "$anz";
		while ($mail_rows = mysql_fetch_array($sql_mail)) {
		$email_to_bcc .="$mail_rows[email], ";
		}
		$header="From:Ralf Lohe<lohe@pluspunkt.de>\n";
		$header .= "Reply-To: lohe@pluspunkt.de\n";
		$header .= "Bcc: $email_to_bcc\n";
		$header .= "Content-Type: text/html";
		mail($email_to,$email_betreff,$email_body,$header);
	}
	else {
?>
		<table width="500">
			<form action="<?php  echo $_SERVER["PHP_SELF"];?>" method="post">
			<input type="hidden" name="send" value="1">
			<tr>
				<td align="left" valign="top">Betreff:</td><td align="left" valign="top"><input type="text" name="email_betreff" size="20"></td>
			</tr>
			<tr>
				<td align="left" valign="top">Link:</td><td align="left" valign="top"><input type="text" name="link" size="20" value="http://"></td>
			</tr>
			<tr>
				<td align="left" valign="top">Text:</td><td align="left" valign="top"><textarea cols="50" rows="30" name="body"></textarea></td>
			</tr>
			<tr align="left" valign="top">
				<td><input type="submit" name="Email Senden" value="send"></td>
			</tr>
			</form>
		</table>
<?php 
	}
?>
</body>
</html>
