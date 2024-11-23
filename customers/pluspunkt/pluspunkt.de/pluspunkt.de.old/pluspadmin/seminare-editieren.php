<?php 
include("../_inc/db_zugang.inc"); 

foreach($_GET as $key => $value) {
$$key = $value;
}
foreach($_POST as $key => $value) {
$$key = $value;
}

IF (!$sid)
{
  header("Location: seminare-admin.php");
}

IF ($todo == "edit")
{
  $speichern = mysql_query("UPDATE seminare SET art='$art',name='$name',teilnehmer='$teilnehmer',vorraussetzungen='$vorraussetzungen',ziele='$ziele',inhalte='$inhalte',dozent='$dozent',dauer='$dauer',datum='$datum',ort='$ort',kosten='$kosten',weitereinfos='$weitereinfos',externinfo='$externinfo',externpic='$externpic',externlink='$externlink' WHERE id='$sid'",$db);
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
if(!voll)alert("Bitte alle Felder ausf�llen!"); 
return voll; 
} 
</script>
</head>

<body bgcolor="#76797B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="" background="../_images/hg.jpg">
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
            <p><b><img src="../_images/seminare.gif" width="74" height="15"></b></p>
            <?php 
$seminare = mysql_query("SELECT id,art,name,teilnehmer,vorraussetzungen,ziele,inhalte,dozent,dauer,datum,ort,kosten,weitereinfos,externinfo,externpic,externlink FROM seminare WHERE id='$sid'",$db);
$seminare_ok = mysql_fetch_array($seminare);
?>
            <form method="post" name="edit" action="<?php  echo $PHP_SELF;?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr> 
                  <td width="45%"><b>Art der Veranstaltung:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td> 
                          <input type="text" name="art" value="<?php  echo $seminare_ok["art"];?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td><b>Name der Veranstaltung:</b></td>
                </tr>
                <tr> 
                  <td valign="top"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td> 
                          <input type="text" name="name" value="<?php  echo $seminare_ok["name"];?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><b>Teilnehmer:</b></td>
                </tr>
                <tr> 
                  <td valign="top"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td> 
                          <input type="text" name="teilnehmer" value="<?php  echo $seminare_ok["teilnehmer"];?>" size="43">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><b>Voraussetzungen:</b></td>
                </tr>
                <tr> 
                  <td valign="top"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td> 
                          <textarea name="vorraussetzungen" cols="45" rows="5"><?php  echo nl2br($seminare_ok["vorraussetzungen"]);?></textarea>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><b>Ziele:</b></td>
                </tr>
                <tr> 
                  <td valign="top"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td> 
                          <textarea name="ziele" cols="45" rows="5"><?php  echo nl2br($seminare_ok["ziele"]);?></textarea>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><b>Inhalte:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <textarea name="inhalte" cols="45" rows="5"><?php  echo $seminare_ok["inhalte"];?></textarea>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><b>Weitere Informationen:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <textarea name="weitereinfos" cols="45" rows="8"><?php  echo $seminare_ok["weitereinfos"];?></textarea>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td><b>Dozent:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <input type="text" name="dozent" value="<?php  echo $seminare_ok["dozent"];?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td><b>Dauer:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <input type="text" name="dauer" value="<?php  echo $seminare_ok["dauer"];?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td><b>Datum:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <input type="text" name="datum" value="<?php  echo $seminare_ok["datum"];?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td><b>Ort:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <input type="text" name="ort" value="<?php  echo $seminare_ok["ort"];?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td><b>Investition:</b></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <input type="text" name="kosten" value="<?php  echo $seminare_ok["kosten"];?>">
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
IF ($seminare_ok["externinfo"] == "1")
{
  echo "                    <option value=\"$seminare_ok[externinfo]\" selected>Aktuell: Ja</option>\n";
}
ELSE
{
  echo "                    <option value=\"$seminare_ok[externinfo]\" selected>Aktuell: Nein</option>\n";
}
?>
                            <option value="<?php  echo $seminare_ok["externinfo"];?>">------------</option>
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
                          <input type="text" name="externpic" value="<?php  echo $seminare_ok["externpic"];?>">
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
                          <input type="text" name="externlink" value="<?php  echo $seminare_ok["externlink"];?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="15%">&nbsp;</td>
                        <td width="85%"> 
                          <input type="submit" name="Abschicken" value="Speichern">
                          <input type="hidden" name="todo" value="edit">
                          <input type="hidden" name="sid" value="<?php  echo $sid;?>">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </form>
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
<p>&nbsp;</p>
</body>
</html>
