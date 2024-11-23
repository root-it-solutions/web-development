<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Administration";
$titel = "archiv";
$hauptmenue=0;
$submenue=0;

require_once($cfg['pfad1']."c_db.class.php");
require_once($cfg['pfad1']."c_datum.class.php");

$db = new c_db($cfg['SQL_Database']['Server'],$cfg['SQL_Database']['User'],$cfg['SQL_Database']['Passwort'],$cfg['SQL_Database']['Name']);
$datum = new c_datum;
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
                  <p><b>Newsletter-Archiv</b></p>
                  <p>Auf der linken Seiten k&ouml;nnen Sie w&auml;hlen, ob Sie 
                    einen Newsletter versenden, das Newsletter-Archiv einsehen 
                    oder die Newsletter-Abonnenten ansehen/bearbeiten m&ouml;chten.</p>
                  <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    <tr> 
                      <td> 
<?php 
IF (isset($_GET[id]))
{
	$aArchiv = "SELECT id,betreff,newsletter,empf_anz,DATE_FORMAT(datum,'%d.%m.%Y') AS tag, DATE_FORMAT(datum,'%H:%i') AS uhrzeit FROM ".$tab['mis']['newsletter_archiv']." WHERE id='$_GET[id]'";
	$qArchiv = $db->sql_query($aArchiv);
	$Archiv = $db->sql_fetch_object($qArchiv);
?>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr> 
                            <td width="15%"><b>Datum:</b></td>
                            <td><?php  echo $Archiv->tag;?> • <?php  echo $Archiv->uhrzeit;?> Uhr</td>
                          </tr>
                          <tr> 
                            <td><b>Betreff:</b></td>
                            <td><?php  echo $Archiv->betreff;?></td>
                          </tr>
                          <tr> 
                            <td valign="top"> <b>Newsletter:</b></td>
                            <td><?php  echo nl2br($Archiv->newsletter);?></td>
                          </tr>
                          <tr> 
                            <td valign="top"><b>Empf&auml;nger:</b></td>
                            <td><?php  echo nl2br($Archiv->empf_anz);?></td>
                          </tr>
                        </table>
                        <br>
                        <br>
<?php 
}
?>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr> 
                            <td width="60%"><b>Betreff:</b></td>
                            <td><b>Datum:</b></td>
                          </tr>
                          <tr bgcolor="#666666"> 
                            <td colspan="2" height="1"></td>
                          </tr>
<?php 
$aArchiv = "SELECT id,betreff,DATE_FORMAT(datum,'%d.%m.%Y') AS tag, DATE_FORMAT(datum,'%H:%i') AS uhrzeit FROM ".$tab['mis']['newsletter_archiv']." ORDER BY datum DESC";
$qArchiv = $db->sql_query($aArchiv);
WHILE ($Archiv = $db->sql_fetch_object($qArchiv))
{
?>
                          <tr> 
                            <td><a href="<?php  echo $_SERVER[PHP_SELF];?>?id=<?php  echo $Archiv->id;?>"><?php  echo $Archiv->betreff;?></a></td>
                            <td><?php  echo $Archiv->tag;?> • <?php  echo $Archiv->uhrzeit;?> Uhr</td>
                          </tr>
<?php 
}
?>
                        </table>
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
