<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Typisch!";
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
                        <p><b><font size="2">Typisch!</font></b></p>
                        <p>Durch den t&auml;glichen Umgang mit Kunden, dem st&auml;ndigen 
                          Erfahrungsaustausch mit Kollegen und unz&auml;hligen 
                          Fortbildungsveranstaltungen hat sich Frau Jutta Schmidt 
                          (SCHLAFKULTUR, Bielefeld) umfangreiches Wissen zum Thema 
                          &quot;Gesund schlafen in angenehmer Optik&quot; angeeignet. 
                          Ihr interessanter Beitrag &quot;Nutze die Nacht, um 
                          den Tag zu genie&szlig;en&quot; ist nun in dem Buch: 
                          Typisch! erschienen. Zw&ouml;lf Autoren ganz unterschiedlicher 
                          Branchen schreiben in ihrem Stil &uuml;ber verschiedene 
                          Themen der Kommunikation, in denen sie sich spezialisiert 
                          haben. Die Lekture lohnt sich.<br>
                          <br>
                          wbv W. Bertelsmann Verlag<br>
                          ISBN 3-7639-3087-6<br>
                        </p>
                        <p></p>
                        <hr size="1" noshade>
                        <b><font color="#FFFFFF">MZE-Aktuell<br>
                        </font></b><font color="#FFFFFF">Ausgabe 04/2003 (Dezember/2003)</font></td>
                    </tr>
                    <tr valign="top"> 
                      <td>&nbsp;</td>
                      <td align="right"><a href="presse_5_druck.php" target="_blank">Druckversion</a></td>
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
