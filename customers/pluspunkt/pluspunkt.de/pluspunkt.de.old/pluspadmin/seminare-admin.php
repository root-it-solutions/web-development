<?php 
include("../_inc/db_zugang.inc.php");

IF ($todo == "neu")
{
  $speichern = mysql_query("INSERT INTO seminare (art,name,teilnehmer,vorraussetzungen,ziele,inhalte,dozent,dauer,datum,ort,kosten,weitereinfos,externinfo,externpic,externlink,reihenfolge) VALUES ('$art','$name','$teilnehmer','$vorraussetzungen','$ziele','$inhalte','$dozent','$dauer','$datum','$ort','$kosten','$weitereinfos','$externinfo','$externpic','$externlink','$reihenfolge')",$db);
}

IF ($todo == "del")
{
  $loeschen = mysql_query("DELETE FROM seminare WHERE id='$sid'",$db);
}
?>
<html>
<head>
<title>Pluspunkt Unternehmensentwicklung</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../plus-style.css">
</head>
<body bgcolor="#76797B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="" background="../_images/hg.jpg">
<table width="608" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td colspan="2" height="24">&nbsp;</td>
  </tr>
  <tr> 
    <td width="219" valign="top"> 
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten-2.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="seminare-admin.php" target="_self">Die Seminare</a><br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="vortraege-admin.php" target="_self">Vortr&auml;ge</a><br>
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
$seminare = mysql_query("SELECT id,name FROM seminare ORDER BY name ASC",$db);
WHILE ($seminare_ok = mysql_fetch_array($seminare))
{
?>
            <p>&middot; <a href="seminare-editieren.php?sid=<?php  echo $seminare_ok["id"];?>"> 
              <?php  echo $seminare_ok["name"];?></a>&nbsp;[<a href="<?php  echo $PHP_SELF?>?todo=del&sid=<?php  echo $seminare_ok["id"];?>" onClick="return confirm('Seminar wirklich löschen?')"><font color="#CC0000">L&ouml;schen</font></a>]</p>
<?php 
}
?>
            <p>&nbsp;</p>
            <p><b><img src="../_images/neuesseminare.gif" width="119" height="15"></b></p>
            <form name="neu" method="post" action="<?php  echo $PHP_SELF;?>">
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
<p>&nbsp;</p></body>
</html>
