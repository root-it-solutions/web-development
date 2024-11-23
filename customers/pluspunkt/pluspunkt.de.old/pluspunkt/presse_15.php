<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Inspiration";
$titel = "Presse";
$hauptmenue=1;
$submenue=1;
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
                  <p><b><img src="../_images/rub-presse.gif" width="266" height="20"></b></p>
                  <table width="352" border="0" cellspacing="1" cellpadding="3">
                    <tr valign="top"> 
                      <td colspan="2"> 
                        <p><b>Inspiration</b></p>
                        <p><b>Inspiration</b> hie&szlig; die Veranstaltung, bei 
                          der die &quot;Pluspunkt&quot;-Unternehmensentwicklung 
                          mit Kunden und G&auml;sten gemeinsam ein Bild in M&uuml;nster 
                          malte und amerikanisch versteigerte. Den Erl&ouml;s 
                          von knapp 1600 Euro erhielt vor wenigen Tagen der &quot;Hospizdienst 
                          Tauwerk e.V.&quot; in Berlin, eine Dependance der Franziskanerinnen 
                          St.Mauritz aus M&uuml;nster, in der Aidskranke betreut 
                          werden.<br>
                        </p>
                        <hr size="1" noshade>
                        <b>Westf&auml;lische Nachrichten<br>
                        </b> vom 20.12.04<br>
                        <b>M&uuml;nsterische Zeitung</b><br>
                        Ausgabe 299 vom 21.12.04</td>
                    </tr>
                    <tr valign="top"> 
                      <td>&nbsp;</td>
                      <td align="right"><a href="presse_15_druck.php" target="_blank">Druckversion</a></td>
                    </tr>
                  </table>
                  <p>&nbsp; </p>
                  <p>&nbsp;</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td colspan="2" valign="top">&nbsp; </td>
        </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table>
<?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
