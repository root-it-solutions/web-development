<?php 
include("../_inc/db_zugang.inc"); 

IF (!$vid)
{
  header("Location: vortraege.php");
}

IF ($todo == "kontakt")
{
  $empfaenger = "info@dimento.de";
  $betreff = "$betreff";
  $nachricht = "Folgender Besucher ist an einem Vortrag interessiert.<br><br><b>Name:</b> $name<br><b>Firma:</b> $firma<br><b>Telefon:</b> $telefon<br><b>Email:</b> $email<br><b>Kommentar:</b> $kommentar<br><br><hr size=1>Diese Email wurde über die Vortragsseite (- das entsprechende Vortrag steht im Betreff -) versandt!";
  $header  = "From: $email ($name)\n";
  $header .= "Content-Type: text/html\nContent-Transfer-Encoding: 8bit\n";
  $header .= "X-Mailer: PHP ". phpversion();

  mail($empfaenger,$betreff,$nachricht,$header);
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

<body bgcolor="#76797B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="" background="../_images/hg.jpg">
<?php 
$vortraege = mysql_query("SELECT id,thema,inhalte,zielgruppe,dauer,referent,datum,externinfo,externpic,externlink FROM vortraege WHERE id='$vid'",$db);
$vortraege_ok = mysql_fetch_array($vortraege);
?>
<table width="608" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td colspan="2" height="24">&nbsp;</td>
  </tr>
  <tr> 
    <td width="219" valign="top"> 
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="die-pluspunkt-partnerschaft.php" target="_self">Die Pluspunkt 
        Partnerschaft</a><br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="broeker.php" target="_self">br&ouml;ker Catering &amp; Event GmbH</a>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="dimento.php" target="_self">Dimento Design</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="immergruen.php" target="_self">Immergr&uuml;n</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="intectum.php" target="_self">Intectum</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="kleegraefe.php" target="_self">Kleegr&auml;fe &amp; Strothmann</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="markplan.php" target="_self">Markplan</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="reha-klinik.php" target="_self">Reha Klinik Reinhardsquelle</a> 
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="rothenberger.php" target="_self">Rothenberger Gastronomie</a> 
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="schlotmann.php" target="_self">Schlotmann und Partner</a>
         <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle">
        &nbsp;<a href="partner-seminare.php" target="_self">Seminare Partner</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten-2.gif" width="20" height="17" align="absmiddle">
        &nbsp;<a href="partner-vortraege.php" target="_self">Vorträge Partner</a></p>

      <?php 
IF ($vortraege_ok["externinfo"] != "0")
{
?>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php  echo $vortraege_ok["externlink"];?>"><img src="<?php  echo $vortraege_ok["externpic"];?>" width="80" height="80" border="0"></a></p>
      <?php 
}
?>
    </td>
    <td width="389" valign="top" bgcolor="#D6D6D6"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr bgcolor="#76797B"> 
          <td> 
            <p><b><img src="../_images/vortraege.gif" width="68" height="22"></b></p>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr> 
                <td><b>Thema der Veranstaltung:</b> </td>
              </tr>
              <tr> 
                <td> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr> 
                      <td width="15%">&nbsp;</td>
                      <td> 
                        <?php  echo $vortraege_ok["thema"];?>
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
                        <?php  echo $vortraege_ok["inhalte"];?>
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
                        <?php  echo $vortraege_ok["zielgruppe"];?>
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
                        <?php  echo $vortraege_ok["dauer"];?>
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
                        <?php  echo $vortraege_ok["referent"];?>
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
                        <?php  echo $vortraege_ok["datum"];?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <p><b><br>
              <img src="../_images/kontakt.gif" width="63" height="15"></b></p>
            <form name="kontakt" method="post" action="<?php  echo $PHP_SELf;?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr> 
                  <td width="35%"><b>Ihr Name:</b></td>
                  <td> 
                    <input type="text" name="name">
                  </td>
                </tr>
                <tr> 
                  <td><b>Firma:</b></td>
                  <td> 
                    <input type="text" name="firma">
                  </td>
                </tr>
                <tr> 
                  <td><b>Telefon:</b></td>
                  <td> 
                    <input type="text" name="telefon">
                  </td>
                </tr>
                <tr> 
                  <td><b>Email:</b></td>
                  <td> 
                    <input type="text" name="email">
                  </td>
                </tr>
                <tr> 
                  <td><b>Betrifft:</b></td>
                  <td> 
                    <input type="text" name="betreff" value="Vortrag: <?php  echo $vortraege_ok["thema"];?>">
                  </td>
                </tr>
                <tr> 
                  <td valign="top"><b>Kommentar:</b></td>
                  <td> 
                    <textarea name="kommentar" rows="6" cols="33"></textarea>
                  </td>
                </tr>
                <tr> 
                  <td valign="top">&nbsp;</td>
                  <td> 
                    <input type="submit" name="kontakt" value="Absenden" onClick="return alle_felder_pruefen()">
                    <input type="hidden" name="todo" value="kontakt">
                    <input type="hidden" name="vid" value="<?php  echo $vid;?>">
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
