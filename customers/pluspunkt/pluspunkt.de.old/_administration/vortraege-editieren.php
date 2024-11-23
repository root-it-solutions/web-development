<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Administration";
$titel = "vortraege";
$hauptmenue=0;
$submenue=0;

IF (!$_GET[vid])
{
  header("Location: vortraege-admin.php");
}

IF ($_POST[todo] == "edit")
{
  $speichern = mysql_query("UPDATE vortraege SET thema='$_POST[thema]',inhalte='$_POST[inhalte]',zielgruppe='$_POST[zielgruppe]',dauer='$_POST[dauer]',referent='$_POST[referent]',datum='$_POST[datum]',externinfo='$_POST[externinfo]',externpic='$_POST[externpic]',externlink='$_POST[externlink]',status='$_POST[status]' WHERE id='$_POST[vid]'",$db);
}

$vortraege = mysql_query("SELECT id,thema,inhalte,zielgruppe,dauer,referent,datum,externinfo,externpic,externlink,status FROM vortraege WHERE id='$_GET[vid]'",$db);
$vortraege_ok = mysql_fetch_array($vortraege);
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
<script language=JavaScript> 
function alle_felder_pruefen() 
{ 
	voll=true;
	anzahlFelder=5; 
	for(n=0; n < anzahlFelder; n++) 
	{
	if(window.document.kontakt.elements[n].value== "") 
	voll=false;
	}
	if(!voll)alert("Bitte alle Felder ausfüllen!"); 
	return voll; 
} 
</script>
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<table width="640" border="0" cellspacing="0" cellpadding="0" align="center" name="content">
  <tr> 
    <td bgcolor="#77787C" width="628">
      <table width="608" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td colspan="2" height="24">&nbsp;</td>
        </tr>
        <tr> 
          <td width="219" valign="top"> 
            <?php  require "../_inc/submenue-$submenue.inc.php"; ?>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B" valign="top"> 
                <td> 
                  <p><img src="../_images/rub-admin.gif" width="266" height="20"></p>
                  <p><b><img src="../_images/vortraege.gif" width="68" height="22"> 
                    </b></p>
                  <form method="post" name="edit" action="<?php  echo $SERVER[PHP_SELF];?>">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr> 
                        <td><b>Referent:</b> </td>
                      </tr>
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
<?php 
IF ($vortraege_ok["status"] == "1")
{
  echo "                    <select name=\"status\">
                            <option value=\"1\" selected>Pluspunkt</option>
                            <option value=\"2\">Partner</option>
                          </select>";
}
ELSE
{
  echo "                    <select name=\"status\">
                            <option value=\"1\">Pluspunkt</option>
                            <option value=\"2\" selected>Partner</option>
                          </select>";
}
?>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td><b>Thema der Veranstaltung:</b> </td>
                      </tr>
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="thema" value="<?php  echo $vortraege_ok["thema"];?>" size="43">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td width="93%"><b>Inhalte:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="inhalte" value="<?php  echo $vortraege_ok["inhalte"];?>" size="43">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top" width="93%"><b>Zielgruppe:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="zielgruppe" value="<?php  echo $vortraege_ok["zielgruppe"];?>">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top" width="93%"><b>Dauer:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="dauer" value="<?php  echo $vortraege_ok["dauer"];?>">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top" width="93%"><b>Referent:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="referent" value="<?php  echo $vortraege_ok["referent"];?>">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top" width="93%"><b>Datum:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="datum" value="<?php  echo $vortraege_ok["datum"];?>">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top" width="93%"><b>Weitere Informationen?:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <select name="externinfo">
<?php 
IF ($vortraege_ok["externinfo"] == "1")
{
  echo "                    <option value=\"$vortraege_ok[externinfo]\" selected>Aktuell: Ja</option>\n";
}
ELSE
{
  echo "                    <option value=\"$vortraege_ok[externinfo]\" selected>Aktuell: Nein</option>\n";
}
?>
                                  <option value="<?php  echo $vortraege_ok["externinfo"];?>">------------</option>
                                  <option value="1">Ja</option>
                                  <option value="0">Nein</option>
                                </select>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top" width="93%"><b>Pfad des Bildes:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="externpic" value="<?php  echo $vortraege_ok["externpic"];?>">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top" width="93%"><b>Link f&uuml;r das Bild:</b></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="text" name="externlink" value="<?php  echo $vortraege_ok["externlink"];?>">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
                                <input type="submit" name="Abschicken" value="Speichern">
                                <input type="hidden" name="todo" value="edit">
                                <input type="hidden" name="vid" value="<?php  echo $_GET[vid];?>">
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </form>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td width="219" valign="top">&nbsp;</td>
          <td width="389" valign="top"> 
            <?php  include "../_inc/submenue.inc"; ?>
          </td>
        </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table>
<?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
