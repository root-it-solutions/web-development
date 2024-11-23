<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Administration";
$titel = "abonnenten";
$hauptmenue=0;
$submenue=0;

require_once($cfg['pfad1']."c_db.class.php");
require_once($cfg['pfad1']."c_datum.class.php");

$db = new c_db($cfg['SQL_Database']['Server'],$cfg['SQL_Database']['User'],$cfg['SQL_Database']['Passwort'],$cfg['SQL_Database']['Name']);
$datum = new c_datum;


IF ($_POST[todo] == "anmelden")
{
	$aCheck = "SELECT COUNT(id) AS Anzahl FROM ".$tab['mis']['newsletter_abo']." WHERE email='$_POST[email]'";
	$qCheck = $db->sql_query($aCheck);
	$Check = $db->sql_fetch_object($qCheck);

	IF ($Check->Anzahl == "0")	{
		$aSpeichern = "INSERT INTO ".$tab['mis']['newsletter_abo']." (ansprache,anrede,name,firma,email,registriert) VALUES ('$_POST[ansprache]','$_POST[anrede]','$_POST[name]','$_POST[firma]','$_POST[email]',NOW())";
		$qSpeichern = $db->sql_query($aSpeichern);
		$user_id = mysql_insert_id();
		$error[] = "<p><b>Ihre Emailadresse wurde in den Verteiler aufgenommen!</b></p>";
	}
	ELSE
	{
		$error[] = "<p><b>Die Emailadresse ist bereits in der Datenbank vorhanden.</b></p>";
	}
}



IF (isset($_POST[id]) && $_POST[todo] == "edit")
{
	$aAbonennt = "UPDATE ".$tab['mis']['newsletter_abo']." SET ansprache='$_POST[ansprache]',anrede='$_POST[anrede]',name='$_POST[name]',firma='$_POST[firma]',email='$_POST[email]' WHERE id='$_POST[id]'";
	$qAbonennt = $db->sql_query($aAbonennt);

	header("Location: $_SERVER[PHP_SELF]");
}

IF (isset($_GET[id]) && $_GET[todo] == "delete")
{
	$aAbonennt = "DELETE FROM ".$tab['mis']['newsletter_abo']." WHERE id='$_GET[id]'";
	$qAbonennt = $db->sql_query($aAbonennt);

	header("Location: $_SERVER[PHP_SELF]");
}

?>
<html>
<head>
<title><?php echo "$seitentitel";?></title>
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
                  <p><b>Newsletter-Abonnenten</b></p>
                  <p>Hier k&ouml;nnen Sie neue Abonnenten der Liste hinzuf&uuml;gen 
                    - oder vorhandene editieren bzw. l&ouml;schen.</p>
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    <tr> 
                      <td> 
<?php 
IF (isset($_GET[id]) && $_GET[todo] == "edit")
{
	$aAbonennten = "SELECT id,ansprache,anrede,name,firma,email FROM ".$tab['mis']['newsletter_abo']." WHERE id='$_GET[id]'";
	$qAbonennten = $db->sql_query($aAbonennten);
	$Abonennten = $db->sql_fetch_object($qAbonennten);
?>
                        <form name="editieren" method="post" action="<?php echo $_SERVER[PHP_SELF];?>">
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr> 
                              <td width="20%"><b>Ansprache:</b></td>
                              <td> 
                                <input type="text" name="ansprache" value="<?php echo $Abonennten->ansprache;?>" size="35">
                              </td>
                            </tr>
                            <tr> 
                              <td width="20%"><b>Anrede:</b></td>
                              <td> 
                                <input type="text" name="anrede" value="<?php echo $Abonennten->anrede;?>" size="35">
                              </td>
                            </tr>
                            <tr> 
                              <td width="20%"><b>Name:</b></td>
                              <td> 
                                <input type="text" name="name" value="<?php echo $Abonennten->name;?>" size="35">
                              </td>
                            </tr>
                            <tr> 
                              <td><b>Firma:</b></td>
                              <td> 
                                <input type="text" name="firma" value="<?php echo $Abonennten->firma;?>" size="35">
                              </td>
                            </tr>
                            <tr> 
                              <td><b>Emailadresse:</b></td>
                              <td> 
                                <input type="text" name="email" value="<?php echo $Abonennten->email;?>" size="35">
                              </td>
                            </tr>
                            <tr> 
                              <td>&nbsp;</td>
                              <td> <br>
                                <input type="submit" name="Abschicken" value="Speichern">
                                <input type="hidden" name="todo" value="edit">
                                <input type="hidden" name="id" value="<?php echo $_GET[id];?>">
                              </td>
                            </tr>
                          </table>
                        </form>
                        <br>
                        <br>
<?php 
}
?>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr> 
                            <td width="35%"><b>Name</b></td>
                            <td width="30%"> 
                              <p><b>Firma</b></p>
                            </td>
                            <td colspan="2"><b>Registriert am:</b> </td>
                          </tr>
                          <tr bgcolor="#666666"> 
                            <td colspan="4" height="1"></td>
                          </tr>
                          <?php 
$aAbonennten = "SELECT id,ansprache,anrede,name,firma,email,DATE_FORMAT(registriert, '%d.%m.%Y') AS datum FROM ".$tab['mis']['newsletter_abo']." ORDER BY name ASC";
$qAbonennten = $db->sql_query($aAbonennten);
WHILE ($Abonennten = $db->sql_fetch_object($qAbonennten))
{
?>
                          <tr> 
                            <td> 
                              <?php echo $Abonennten->ansprache;?>
                              <?php echo $Abonennten->anrede;?>
                              <br>
                              <a href="mailto:<?php echo $Abonennten->email;?>"> 
                              <?php echo $Abonennten->name;?>
                              </a></td>
                            <td> 
                              <?php echo $Abonennten->firma;?>
                            </td>
                            <td width="25%"> 
                              <?php echo $Abonennten->datum;?>
                            </td>
                            <td align="right" width="10%"><a href="<?php echo $_SERVER[PHP_SELF];?>?todo=edit&id=<?php echo $Abonennten->id;?>">E</a> 
                              <a href="<?php echo $_SERVER[PHP_SELF];?>?todo=delete&id=<?php echo $Abonennten->id;?>" onClick="return confirm('Eintrag tatsächlich löschen?')">D</a> 
                            </td>
                          </tr>
                          <tr bgcolor="#999999"> 
                            <td colspan="4" height="1"></td>
                          </tr>
                          <?php 
}
?>
                        </table>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>

                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr>
                            <td><b>Neuer Abonnent</b></td>
                          </tr>
                          <tr> 
                            <td> 
<?php 
IF (empty($_POST[todo]))
{
?>
                              <form name="anmelden" method="post" action="<?php echo $_SERVER[PHP_SELF];?>">
                                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr> 
                                    <td width="25%"><b>Ansprache:</b></td>
                                    <td> 
                                      <input type="text" name="ansprache">
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td width="25%"><b>Anrede:</b></td>
                                    <td> 
                                      <input type="text" name="anrede">
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td width="25%"><b> Name:</b></td>
                                    <td> 
                                      <input type="text" name="name">
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td width="25%"><b>Firma:</b></td>
                                    <td> 
                                      <input type="text" name="firma">
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td width="25%"><b> Emailadresse:</b></td>
                                    <td> 
                                      <input type="text" name="email">
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td width="25%" valign="top">&nbsp;</td>
                                    <td> <br>
                                      <input type="submit" name="Abschicken" value="Anmelden">
                                      <input type="hidden" name="todo" value="anmelden">
                                    </td>
                                  </tr>
                                </table>
                              </form>
<?php 
}
ELSEIF (!empty($_POST[todo]) && $_POST[todo] == "anmelden")
{
	FOR($i=0;$i<=count($error);$i++) { echo $error[$i]; }
}
?>
                              
                            </td>
                          </tr>
                        </table>
                        <p>&nbsp;</p>
                      </td>
                    </tr>
                  </table>
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
