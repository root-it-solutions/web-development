<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Administration";
$titel = "seminare";
$hauptmenue=0;
$submenue=0;

IF ($_POST[todo] == "neu")
{
  $speichern = mysql_query("INSERT INTO seminare (art,name,teilnehmer,vorraussetzungen,ziele,inhalte,dozent,dauer,datum,ort,kosten,weitereinfos,externinfo,externpic,externlink,reihenfolge) VALUES ('$_POST[art]','$_POST[name]','$_POST[teilnehmer]','$_POST[vorraussetzungen]','$_POST[ziele]','$_POST[inhalte]','$_POST[dozent]','$_POST[dauer]','$_POST[datum]','$_POST[ort]','$_POST[kosten]','$_POST[weitereinfos]','$_POST[externinfo]','$_POST[externpic]','$_POST[externlink]','$_POST[reihenfolge]')",$db);
}

IF ($_POST[todo] == "del")
{
  $loeschen = mysql_query("DELETE FROM seminare WHERE id='$_GET[sid]'",$db);
}
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
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
                  <p>
                    <?php 
$seminare = mysql_query("SELECT id,name FROM seminare ORDER BY name ASC",$db);
WHILE ($seminare_ok = mysql_fetch_array($seminare))
{
?>
                  </p>
                  <p>&middot; <a href="seminare-editieren.php?sid=<?php  echo $seminare_ok["id"];?>"><?php  echo $seminare_ok["name"];?></a>&nbsp;[<a href="<?php  echo $_SERVER[PHP_SELF]?>?todo=del&sid=<?php  echo $seminare_ok["id"];?>" onClick="return confirm('Seminar wirklich löschen?')"><font color="#CC0000">L&ouml;schen</font></a>]</p>
<?php 
}
?>
                  <br>
                  <br>
                  <form name="neu" method="post" action="<?php  echo $_SERVER[PHP_SELF];?>">
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
                                <input type="text" name="art">
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
                                <input type="text" name="name">
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
                                <input type="text" name="teilnehmer" size="43">
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
                                <textarea name="vorraussetzungen" cols="45" rows="5"></textarea>
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
                                <textarea name="ziele" cols="45" rows="5"></textarea>
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
                                <textarea name="inhalte" cols="45" rows="5"></textarea>
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
                                <textarea name="weitereinfos" cols="45" rows="5"></textarea>
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
                                <input type="text" name="dozent">
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
                                <input type="text" name="dauer">
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
                                <input type="text" name="datum">
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
                                <input type="text" name="ort">
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
                                <input type="text" name="kosten">
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
                                  <option value="1">Ja</option>
                                  <option value="0" selected>Nein</option>
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
                                <input type="text" name="externpic">
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
                                <input type="text" name="externlink">
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
                                <input type="submit" name="Abschicken" value="Online stellen">
                                <input type="hidden" name="todo" value="neu">
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
