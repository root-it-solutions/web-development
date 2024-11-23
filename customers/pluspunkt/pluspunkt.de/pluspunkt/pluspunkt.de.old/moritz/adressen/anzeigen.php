<?
include("./_inc/db_zugang.inc");
if ( $_POST[save] == '1' ) {
	$db_update = mysql_query("update moritz_adressen set name='$_POST[name]', vorname='$_POST[vorname]', strasse='$_POST[strasse]', plz='$_POST[plz]', wohnort='$_POST[wohnort]', tel_vor='$_POST[tel_vor]', tel_nr='$_POST[tel_nr]', fax_vor='$_POST[fax_vor]', fax_nr='$_POST[fax_nr]', mobil_vor='$_POST[mobil_vor]', mobil_nr='$_POST[mobil_nr]', email='$_POST[email]', homepage='$_POST[homepage]', kommentar='$_POST[kommentar]',geb_datum='$_POST[geb_jahr]-$_POST[geb_monat]-$_POST[geb_tag]'  where aid='$_POST[aid]' ",$db);
	header ("Location: anzeigen.php?anzeigen=1&aid=$_POST[aid]");
}
if ( $_POST[insert] == '1' ) {
	$db_insert = mysql_query("INSERT INTO moritz_adressen (name,vorname,strasse,plz,wohnort,tel_vor,tel_nr,fax_vor,fax_nr,mobil_vor,mobil_nr,email,homepage,kommentar,bid,geb_datum) VALUES ('$_POST[name]','$_POST[vorname]','$_POST[strasse]','$_POST[plz]','$_POST[wohnort]','$_POST[tel_vor]','$_POST[tel_nr]','$_POST[fax_vor]','$_POST[fax_nr]','$_POST[mobil_vor]','$_POST[mobil_nr]','$_POST[email]','$_POST[homepage]','$_POST[kommentar]','$_POST[bid]','$_POST[geb_jahr]-$_POST[geb_monat]-$_POST[geb_tag]') ",$db);
}
?>
<html>
	<head>
	<title>Adressen</title>
	<link rel="stylesheet" href="kv.css" type="text/css">
</head>
	
	
<body bgcolor="#999999">
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#eeeeee"> 
        
      <table width="780" border="0" cellspacing="1" cellpadding="3" align="center">
        <tr> 
          <td bgcolor="#444444" colspan="5"> 
            <table width="98%" cellpadding="3" cellspacing="1" align="center">
<?
			  if ( $_GET[insert] == '1') {
?>
              <form action="<?=$_SERVER["PHP_SELF"]?>" method="post" name="insert">
                <input type="hidden" name="insert" value="1">
                <tr valign="top"> 
                  <td colspan="3" align="left"><input type="submit" name="submit" value="Einfügen"></td>
                </tr>
				<tr>
				  <td width="13%">Buchstabe:</td>
				  <td align="left" colspan="2">
<?
							$buchstabe = mysql_query("select * from elmar_buchstabe order by bid ASC",$db);
?>
							<select name="bid">
<?
				  			while ($buchstabe_rows = mysql_fetch_array($buchstabe)) {
?>
								<option value="<?=$buchstabe_rows[bid]?>"><?=$buchstabe_rows[buchstabe]?></option>
<?
							}
?>
							</select>
				  </td>
				</tr>
                <tr valign="top"> 
                  <td width="13%">Name:</td>
                  <td align="left" colspan="2"><input type="text" size="40" name="name"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Vorname:</td>
                  <td align="left" colspan="2"><input type="text" size="40" name="vorname"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Strasse:</td>
                  <td align="left" colspan="2"><input type="text" size="40" name="strasse"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">PLZ/Wohnort:</td>
                  <td align="left" colspan="2"><input type="text" size="5" name="plz">&nbsp;/&nbsp;<input type="text" size="29" name="wohnort"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Tel:</td>
                  <td align="left" colspan="2"><input type="text" size="5" name="tel_vor">&nbsp;/&nbsp;<input size="15" name="tel_nr"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Fax:</td>
                  <td align="left" colspan="2"><input type="text" size="5" name="fax_vor">&nbsp;/&nbsp;<input size="15" name="fax_nr"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Mobil:</td>
                  <td align="left" colspan="2"> 
                    <select name="mobil_vor">
						<option value="0179">0179</option>
						<option value="0178">0178</option>
						<option value="0177">0177</option>
						<option value="0176">0176</option>
						<option value="0175">0175</option>
						<option value="0174">0174</option>
						<option value="0174">0174</option>
						<option value="0173">0173</option>
						<option value="0172">0172</option>
						<option value="0171">0171</option>
						<option value="0170">0170</option>
						<option value="0166">0166</option>
						<option value="0165">0165</option>
						<option value="0164">0164</option>
						<option value="0163">0163</option>
						<option value="0162">0162</option>
						<option value="0161">0161</option>
						<option value="0160">0160</option>
						<option value="0153">0153</option>
						<option value="0152">0152</option>
						<option value="0151">0151</option>
                        <option value="0150">0150</option>
                    </select>
                    &nbsp;/&nbsp; 
                    <input size="9" name="mobil_nr">
                  </td>
                </tr>
				<tr valign="top">
					<td width="13%">Geburtsdatum:</td>
					<td align="left" colspan="2"> 
                    	<select name="geb_tag">
<?							for ($i=1;$i<=31;$i++) {
								?><option value="<?=$i?>"><?=$i?></option><?
							}
?>
						</select>
						<select name="geb_monat">
<?							for ($i=1;$i<=12;$i++) {
								?><option value="<?=$i?>"><?=$i?></option><?
							}
?>
						</select>
						<select name="geb_jahr">
<?							for ($i=1950;$i<=2003;$i++) {
								?><option value="<?=$i?>"><?=$i?></option><?
							}
?>
						</select>
					</td>							
				</tr>
                <tr valign="top"> 
                  <td width="13%">E-Mail:</td>
                  <td align="left" colspan="2"><input size="40" name="email"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Homepage:</td>
                  <td align="left" colspan="2"><input size="40" name="homepage" value="http://"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Kommentar:</td>
                  <td align="left" colspan="2"><textarea cols="60" rows="6" name="kommentar"></textarea></td>
                </tr>
              </form>
<?
							}
							else {
							if ( $_GET[edit] == '1' ) {
								$kontakt = mysql_query("select * from moritz_adressen where aid=$_GET[aid]",$db);
								while ($kontakt_rows = mysql_fetch_array($kontakt)) { 
										$date=strtotime($kontakt_rows[geb_datum]); 
										$tag=strftime("%d",$date);
										$monat=strftime("%m",$date);
										$jahr=strftime("%Y",$date);
?>
              <form action="<?=$_SERVER["PHP_SELF"]?>" method="post" name="save">
                <input type="hidden" name="aid" value="<?=$kontakt_rows[aid]?>">
                <input type="hidden" name="save" value="1">
                <tr valign="top"> 
                  <td colspan="3" align="left"><input type="submit" name="submit" value="Speichern"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Name:</td>
                  <td align="left" colspan="2"><input type="text" size="40" name="name" value="<?=$kontakt_rows[name]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Vorname:</td>
                  <td align="left" colspan="2"><input type="text" size="40" name="vorname" value="<?=$kontakt_rows[vorname]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Strasse:</td>
                  <td align="left" colspan="2"><input type="text" size="40" name="strasse" value="<?=$kontakt_rows[strasse]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">PLZ/Wohnort:</td>
                  <td align="left" colspan="2"><input type="text" size="5" name="plz" value="<?=$kontakt_rows[plz]?>">&nbsp;/&nbsp;<input type="text" size="29" name="wohnort" value="<?=$kontakt_rows[wohnort]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Tel:</td>
                  <td align="left" colspan="2"><input type="text" size="5" name="tel_vor" value="<?=$kontakt_rows[tel_vor]?>">&nbsp;/&nbsp;<input size="15" name="tel_nr" value="<?=$kontakt_rows[tel_nr]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Fax:</td>
                  <td align="left" colspan="2"><input type="text" size="5" name="fax_vor" value="<?=$kontakt_rows[fax_vor]?>">&nbsp;/&nbsp;<input size="15" name="fax_nr" value="<?=$kontakt_rows[fax_nr]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Mobil:</td>
                  <td align="left" colspan="2"><input type="text" size="4" name="mobil_vor" value="<?=$kontakt_rows[mobil_vor]?>">&nbsp;/&nbsp;<input size="9" name="mobil_nr" value="<?=$kontakt_rows[mobil_nr]?>"></td>
                </tr>
				<tr valign="top">
					<td width="13%">Geburtsdatum:</td>
					<td align="left" colspan="2"> 
                    	<select name="geb_tag">
<?							for ($i=1;$i<=31;$i++) {
								?><option value="<?=$i?>" <? if ( $tag == $i) { ?>selected<? }?>><?=$i?></option><?
							}
?>
						</select>
						<select name="geb_monat">
<?							for ($i=1;$i<=12;$i++) {
								?><option value="<?=$i?>" <? if ( $monat == $i) { ?>selected<? }?>><?=$i?></option><?
							}
?>
						</select>
						<select name="geb_jahr">
<?							for ($i=1950;$i<=2003;$i++) {
								?><option value="<?=$i?>" <? if ( $jahr == $i) { ?>selected<? }?>><?=$i?></option><?
							}
?>
						</select>
					</td>							
				</tr>
                <tr valign="top"> 
                  <td width="13%">E-Mail:</td>
                  <td align="left" colspan="2"><input size="40" name="email" value="<?=$kontakt_rows[email]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Homepage:</td>
                  <td align="left" colspan="2"><input size="40" name="homepage" value="<?=$kontakt_rows[homepage]?>"></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Kommentar:</td>
                  <td align="left" colspan="2"><textarea cols="60" rows="6" name="kommentar"><?=$kontakt_rows[kommentar]?></textarea></td>
                </tr>
              </form>
<?
								}
							}
						}
						
						
						if ( $_GET[anzeigen] == '1' ) {
								$kontakt = mysql_query("select * from moritz_adressen where aid=$_GET[aid]",$db);
								while ($kontakt_rows = mysql_fetch_array($kontakt)) {
										$date=strtotime($kontakt_rows[geb_datum]); 
										$tag=strftime("%d",$date);
										$monat=strftime("%m",$date);
										$jahr=strftime("%Y",$date);
?>
                <tr valign="top"> 
                  <td width="13%">Name:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[name]?></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Vorname:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[vorname]?></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Strasse:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[strasse]?></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">PLZ/Wohnort:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[plz]?>&nbsp;/&nbsp;<?=$kontakt_rows[wohnort]?></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Tel:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[tel_vor]?>&nbsp;/&nbsp;<?=$kontakt_rows[tel_nr]?></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Fax:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[fax_vor]?>&nbsp;/&nbsp;<?=$kontakt_rows[fax_nr]?></td>
                </tr>
                <tr>
                <tr valign="top">
                  <td width="13%">Mobil:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[mobil_vor]?>&nbsp;/&nbsp;<?=$kontakt_rows[mobil_nr]?></td>
                </tr>
				<tr valign="top">
					<td width="13%">Geburtsdatum:</td>
					<td align="left" colspan="2"><?=$tag?>.<?=$monat?>.<?=$jahr?></td>
				</tr>
                <tr valign="top"> 
                  <td width="13%">E-Mail:</td>
                  <td align="left" colspan="2"><a href="mailto:<?=$kontakt_rows[email]?>"><?=$kontakt_rows[email]?></a></td>
                </tr>
                <tr valign="top"> 
                  <td width="13%">Homepage:</td>
                  <td align="left" colspan="2"><a href="<?=$kontakt_rows[homepage]?>" target="_blank"><?=$kontakt_rows[homepage]?></a></td>
                </tr>
				<tr>
                <tr valign="top"> 
                  <td width="13%">Kommentar:</td>
                  <td align="left" colspan="2"><?=$kontakt_rows[kommentar]?></td>
                </tr>
<?
								}
								}
?>
						
            </table>
          </td>
        </tr>
        <tr> 
          <td bgcolor="#444444" colspan="5"> &nbsp;&nbsp;&nbsp;<font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#999999">Made by lohe-net.de</font></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>