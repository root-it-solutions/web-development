<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Administration";
$titel = "vortraege";
$hauptmenue=0;
$submenue=0;

IF ($_POST[todo] == "neu")
{
  $speichern = mysql_query("INSERT INTO vortraege (thema,inhalte,zielgruppe,dauer,referent,datum,externinfo,externpic,externlink,status) VALUES ('$_POST[thema]','$_POST[inhalte]','$_POST[zielgruppe]','$_POST[dauer]','$_POST[referent]','$_POST[datum]','$_POST[externinfo]','$_POST[externpic]','$_POST[externlink]','$_POST[status]')",$db);
}

IF ($_GET[todo] == "del")
{
  $loeschen = mysql_query("DELETE FROM vortraege WHERE id='$_GET[vid]'",$db);
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
                  <p><b><img src="../_images/rub-vortraege.gif" width="266" height="20"></b><br>
                    <br>
                    <?php 
$vortraege = mysql_query("SELECT id,thema FROM vortraege WHERE status=1 ORDER BY thema ASC",$db);
WHILE ($vortraege_ok = mysql_fetch_array($vortraege))
{
?>
                  </p>
                  <p>&middot; <a href="vortraege-editieren.php?vid=<?php  echo $vortraege_ok["id"];?>"><?php  echo $vortraege_ok["thema"];?></a>&nbsp;[<a href="<?php  echo $_SERVER[PHP_SELF]?>?todo=del&vid=<?php  echo $vortraege_ok["id"];?>" onClick="return confirm('Vortrag wirklich löschen?')"><font color="#CC0000">L&ouml;schen</font></a>]</p>
<?php 
}
?>
                  <p><b><img src="../_images/rub-vortraege-partner.gif" width="266" height="20"></b></p>
<?php 
$vortraege = mysql_query("SELECT id,thema FROM vortraege WHERE status=2 ORDER BY thema ASC",$db);
WHILE ($vortraege_ok = mysql_fetch_array($vortraege))
{
?>
                  <p>&middot; <a href="vortraege-editieren.php?vid=<?php  echo $vortraege_ok["id"];?>"><?php  echo $vortraege_ok["thema"];?></a>&nbsp;[<a href="<?php  echo $_SERVER[PHP_SELF]?>?todo=del&vid=<?php  echo $vortraege_ok["id"];?>" onClick="return confirm('Vortrag wirklich löschen?')"><font color="#CC0000">L&ouml;schen</font></a>]</p>
<?php 
}
?>
                  <p>&nbsp;</p>
                  <p><b><img src="../_images/neuervortrag.gif" width="150" height="22"></b></p>
                  <form name="neu" method="post" action="<?php  echo $_SERVER[PHP_SELF];?>">
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
                                <select name="status">
                                  <option value="1">Pluspunkt</option>
                                  <option value="2">Partner</option>
                                  <option value="1" selected>Bitte ausw&auml;hlen</option>
                                </select>
                              </td>
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
                                <input type="text" name="thema" size="43">
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
                                <input type="text" name="inhalte" size="43">
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
                                <input type="text" name="zielgruppe">
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
                                <input type="text" name="dauer">
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
                                <input type="text" name="referent">
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
                                <input type="text" name="datum">
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
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="15%">&nbsp;</td>
                              <td> 
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
