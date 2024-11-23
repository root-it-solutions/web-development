<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Administration";
$titel = "seminare";
$hauptmenue=0;
$submenue=0;

IF (!$_GET[sid])
{
  header("Location: seminare-admin.php");
}

IF ($_POST[todo] == "edit")
{
  $speichern = mysql_query("UPDATE seminare SET art='$_POST[art]',name='$_POST[name]',teilnehmer='$_POST[teilnehmer]',vorraussetzungen='$_POST[vorraussetzungen]',ziele='$_POST[ziele]',inhalte='$_POST[inhalte]',dozent='$_POST[dozent]',dauer='$_POST[dauer]',datum='$_POST[datum]',ort='$_POST[ort]',kosten='$_POST[kosten]',weitereinfos='$_POST[weitereinfos]',externinfo='$_POST[externinfo]',externpic='$_POST[externpic]',externlink='$_POST[externlink]' WHERE id='$_POST[sid]'",$db);
}
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
                  <p><b><img src="../_images/seminare.gif" width="74" height="15"></b></p>
                  <p></p>
<?php 
$seminare = mysql_query("SELECT id,art,name,teilnehmer,vorraussetzungen,ziele,inhalte,dozent,dauer,datum,ort,kosten,weitereinfos,externinfo,externpic,externlink FROM seminare WHERE id='$_GET[sid]'",$db);
$seminare_ok = mysql_fetch_array($seminare);
?>
                  
                  <form method="post" name="edit" action="<?php  echo $_SERVER[PHP_SELF];?>">
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
                                <textarea name="weitereinfos" cols="45" rows="5"><?php  echo $seminare_ok["weitereinfos"];?></textarea>
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
                                <input type="hidden" name="sid" value="<?php  echo $_GET[sid];?>">
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
