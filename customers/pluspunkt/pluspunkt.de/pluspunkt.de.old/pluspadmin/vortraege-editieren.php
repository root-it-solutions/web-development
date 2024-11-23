<?php 
include("../_inc/db_zugang.inc"); 

IF (!$vid)
{
  header("Location: vortraege.php");
}

IF ($todo == "edit")
{
  $speichern = mysql_query("UPDATE vortraege SET thema='$thema',inhalte='$inhalte',zielgruppe='$zielgruppe',dauer='$dauer',referent='$referent',datum='$datum',externinfo='$externinfo',externpic='$externpic',externlink='$externlink',status='$status' WHERE id='$vid'",$db);
}
?>
<html>
<head>
<title>Pluspunkt Unternehmensentwicklung</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../plus-style.css">
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

<body bgcolor="#76797B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" background="../_images/hg.jpg">
<?php 
$vortraege = mysql_query("SELECT id,thema,inhalte,zielgruppe,dauer,referent,datum,externinfo,externpic,externlink,status FROM vortraege WHERE id='$vid'",$db);
$vortraege_ok = mysql_fetch_array($vortraege);
?>
<table width="608" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td colspan="2" height="24">&nbsp;</td>
  </tr>
  <tr> 
    <td width="219" valign="top"> 
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="seminare-admin.php">Seminare</a></p>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="vortraege-admin.php">Vortr&auml;ge</a><br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle">&nbsp; 
        <a href="../kontakt/impressum.php" target="_self">Loggout</a> </p>
    </td>
    <td width="389" valign="top" bgcolor="#D6D6D6"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr bgcolor="#76797B"> 
          <td> 
            <p><b><img src="../_images/vortraege.gif" width="68" height="22"></b></p>
            <form method="post" name="edit">
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
                          <input type="hidden" name="vid" value="<?php  echo $vid;?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </form>
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
<p>&nbsp;</p>
</body>
</html>
