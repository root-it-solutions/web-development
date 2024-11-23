<?
include("./_inc/db_zugang.inc");
if ( $_GET[del] == '1' ) {
	$db_del = mysql_query("delete from moritz_adressen where aid = '$_GET[aid]'",$db);
}
?>
<html>
	<head>
	<title>Adressen</title>
	<link rel="stylesheet" href="kv.css" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="JavaScript">
function windowopen(url) { //v2.0
  MeinFenster = window.open(url,'anzeige','width=800,height=500,menubar=no,location=no,scrollbars=no,resizable=no');
  MeinFenster.focus();
}
</script>
</head>
	
	
<body bgcolor="#999999">
<table width="780" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#eeeeee"> 
       <table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
        <tr> 
          <td height="30" bgcolor="#000000" colspan="3"><font color="#CCCC00" size="3">&nbsp;&nbsp;<b>Adressen</b></font></td>
        </tr>
        <tr> 
          <td bgcolor="#003333" valign="middle" align="left"><a href="index.php">&nbsp;&nbsp;&nbsp;Home</a></td>
		  <td bgcolor="#003333" valign="middle" align="left"><a href="javascript:windowopen('anzeigen.php?insert=1')" id="tgrey" class="tgrey">&nbsp;&nbsp;&nbsp;Neue Adresse einf&uuml;gen</a></td>
		  <td bgcolor="#003333" valign="middle" align="left"><a href="index.php?anzeigen=a">&nbsp;&nbsp;&nbsp;Alle anzeigen</a></td>
        </tr>
<?		
		if ($_GET[anzeigen] == 'a') {
								$buchstabe = mysql_query ("SELECT bid,buchstabe FROM elmar_buchstabe ORDER BY buchstabe ASC",$db);
								while ($buchstabe_rows = mysql_fetch_array($buchstabe)) {
									$adresse_vorhanden = mysql_query ("SELECT aid,name FROM moritz_adressen WHERE bid='$buchstabe_rows[bid]' ORDER BY name ASC",$db);
									$adresse_vorhanden_anz = mysql_num_rows ($adresse_vorhanden);
									if ($adresse_vorhanden_anz != '0') {
?>
										<tr>
											<td bgcolor="#01304B"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="94%">&nbsp;<font color="#DEA16E"><?=$buchstabe_rows[buchstabe]?></font></td>
														<td width="6%"><div align="right"><img src="_images/pfeil.gif" width="8" height="8">&nbsp;&nbsp;</div></td>
													</tr>
												</table>
											</td>
											<td  bgcolor="#01304B" colspan="2"></td>
										</tr>
<?
									}
									$adresse = mysql_query ("SELECT * FROM moritz_adressen WHERE bid='$buchstabe_rows[bid]' ORDER BY name ASC",$db);
									while ($adresse_rows = mysql_fetch_array($adresse))  {
?>
										<tr>
											<td bgcolor="#01304B"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td width="73%">&nbsp;<a href="javascript:windowopen('anzeigen.php?aid=<?=$adresse_rows[aid]?>&anzeigen=1')" id="tgrey" class="tgrey"><?=$adresse_rows[name]?>&nbsp;&nbsp;&nbsp;<?=$adresse_rows[vorname]?></a></td>
														<td width="6%" valign="bottom"><div align="right"><a href="javascript:windowopen('anzeigen.php?aid=<?=$adresse_rows[aid]?>&edit=1')" id="tgrey" class="tgrey"><img src="_images/edit.gif" border="0" alt="Edit"></a>&nbsp;<a href="<?$_SERVER["PHP_SELF"]?>?del=1&aid=<?=$adresse_rows[aid]?>" onClick="return(confirm('Wollen Sie diesen Eintrag wirklich l&ouml;schen?'))"><img src="_images/delete.gif" border="0"></a>&nbsp;</div></td>
													</tr>
												</table>
											</td>
											<td  bgcolor="#01304B" colspan="2"></td>
										</tr>
<? 
									}
								}
							}
?>		
		
		
        <tr> 
          <td bgcolor="#444444" colspan="3">&nbsp;&nbsp;&nbsp;<font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#999999">Made by lohe-net.de</font></td>
        </tr>
		
      </table>
    </td>
  </tr>
</table>
</body>
</html>