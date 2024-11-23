<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Presse";
$titel = "Presse";
$hauptmenue=1;
$submenue=1;
function fs_convert($file, $decimals = 0) {
    $size = filesize($file);
    if($size >= 1024*1024*1024) {
        return round($size/(1024*1024*1024), $decimals)." GB";
    }
    if($size >= 1024*1024) {
        return round($size/(1024*1024), $decimals)." MB";
    }
    if($size >= 1024) {
        return round($size/(1024), $decimals)." KB";
    }
    return $size." byte";
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
                  <p><b><img src="../_images/rub-presse.gif" width="266" height="20"></b></p>
                  <table width="352" border="0" cellspacing="1" cellpadding="3">
                  
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Norddeutsches Handwerk</strong><br>
                        </b>Mai 2010<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_32.php">Erfolg zu haben ist kein Zufall</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                  
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Deutsches Handwerksblatt</strong><br>
                        </b>Mai 2009<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_31.php">Zum Schluss kommt Hummer auf den Tisch </a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Handwerk im Münsterland</strong><br>
                        </b>Ausgabe 08/Dez. 08<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_30.php">Vier Stunden Starthilfe</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                  
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Westfälische Nachrichten</strong><br>
                        </b>Ausgabe vom 18.11.08<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_29.php">Vier Stunden Starthilfe</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Hallo am Sonntag</strong><br>
                        </b>Ausgabe vom 02.03.08<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_28.php">Wertvoll für Chefs und Arbeitnehmer</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Nordwest Zeitung</strong><br>
                        </b>Ausgabe vom 12.02.08<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_27.php">Personal leistungsorientiert fördern und motivieren</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Diepholzer Kreisblatt</strong><br>
                        </b>Ausgabe vom 09.02.08<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_26.php">Mitarbeiter motivieren: Aber wie?</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Deutsches Handwerksblatt</strong><br>
                        </b>Ausgabe vom 13.09.07<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_25.php">Zur Motivation nach Mallorca</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Kreiskurier</strong><br>
                        </b>28.02.2007<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_24.php">Unter der Sonne des Südens</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Handwerk Magazin</strong><br>
                        </b>Dezember 2005<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_23.php">Weiterbildung unter südlicher Sonne</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                  	<tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b><strong>Allgemeine 
                        B&auml;cker-Zeitung</strong><br>
                        </b>Ausgabe vom 03.09.05<br> <img src="../_images/trans.gif" width="1" height="5"><br>
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_22.php">Weit 
                        weg vom betrieblichen Alltag</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Nordeutsches Handwerk<br>
                        </b>Ausgabe vom 01.09.05<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_21.php">Weiterbildung 
                        unter s&uuml;dlicher Sonne</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Antenne M&uuml;nster<br>
                        </b>Sendung vom 03.09.2005 - 9:10 Uhr<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/mpg.gif" width="16" height="15" align="absmiddle">&nbsp;<a href="media.php?file=Lohe_03-09.mpg">Interview 
                        mit Ralf Lohe</a> <font size="1">(~ 
                        <?php  echo fs_convert("./Lohe_03-09.mpg", 2);?>
                        )</font></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Antenne M&uuml;nster<br>
                        </b>Sendung vom 31.08.2005 - 19:45 Uhr<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/mpg.gif" width="16" height="15" align="absmiddle">&nbsp;<a href="media.php?file=Lohe_31-08.mpg">Interview 
                        mit Ralf Lohe</a> <font size="1">(~ 
                        <?php  echo fs_convert("./Lohe_31-08.mpg", 2);?>
                        )</font></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Deutsches Handwerksblatt<br>
                        </b>Ausgabe vom 25.08.05<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_20.php">Weiterbildung 
                        auf Fuerteventura</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Weser-Kurier<br>
                        </b>Ausgabe vom 31.07.05<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_19.php">Verantwortung 
                        motiviert </a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Allgemeine B&auml;cker-Zeitung<br>
                        </b>Ausgabe vom 16.07.05<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_18.php">Basis 
                        st&auml;rker eingebunden</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>M&uuml;nstersche Zeitung<br>
                        </b>Ausgabe vom 16.05.05<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_17.php">Weiterbildung 
                        unter südlicher Sonne </a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Emslandkurier<br>
                        </b><br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_16.php">Neue 
                        Impulse für die Unternehmensführung</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Westf&auml;lische Nachrichten<br>
                        </b>Ausgabe vom 20.12.04<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_15.php">Inspiration</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Deutsches Handelsblatt<br>
                        </b>Ausgabe Nr. 22 vom 25.11.04<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_14.php">Die 
                        eigenen Werte gezielt erkennen</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>M&uuml;nstersche Zeitung<br>
                        </b>Ausgabe Nr. 233 vom 05.10.04<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_13.php">Kochen 
                        und zwar gemeinsam</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Allgemeine Fleischer 
                        Zeitung <br>
                        </b>Ausgabe vom 28.07.04<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_12.php">Inhaber 
                        sollte eigene Werte erkennen</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Chemie Technik<br>
                        </b>Ausgabe Nr. 6 / 2004<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_9.php">Geschlechtsspezifische 
                        Unterschiede verstehen und<br>
                        richtig einsetzen</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Chemie Technik / Pharma+Food 
                        <br>
                        </b>Ausgabe Nr. 03/2004<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="chemietechnik_gutemotivation.pdf" target="_blank">Gute 
                        Motivation lässt sich für den Prozess nutzen</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Deutsches Handwerksblatt 
                        <br>
                        </b>Ausgabe vom 19.02.04<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_8.php">Als 
                        Unternehmer eigene Werte sehen</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Deutsches Handwerksblatt 
                        <br>
                        </b>Ausgabe vom 05.02.04<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_7.php">Neues 
                        Handeln f&uuml;r Unternehmen lernen</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Westf&auml;lische Nachrichten 
                        (WN) <br>
                        </b>Ausgabe vom14.01.04<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_6.php">Motivation 
                        f&uuml;r Unternehmer</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>MZE-Aktuell<br>
                        </b>Ausgabe Nr. 04/2003<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_5.php">Typisch!</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Chemie Technik<br>
                        </b>Ausgabe Nr. 01/02 2004<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_11.php">F&uuml;hrung 
                        will gelernt sein: Gute Motivation l&auml;sst sich f&uuml;r 
                        den Prozess nutzen</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F" height="55"><b>Allgemeine 
                        Hotel- und Gastst&auml;tten - Zeitung (AHGZ)<br>
                        </b>Ausgabe vom 27.09.03<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_4.php">Parkhotel 
                        Schloss Hohenfeld lie&szlig; sich &quot;proberaten&quot;</a></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>M&uuml;nsterische Zeitung 
                        (MZ) </b><br>
                        Ausgabe vom 30.08.03<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_3.php">Proberating 
                        im Parkhotel</a> </td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="#6A6B6F"><b>Allgemeine B&auml;cker-Zeitung 
                        (ABZ) </b><br>
                        Ausgabe 3 vom 17.01.03<br> <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_1.php">&quot;Konstruktives 
                        und produktives Betriebsklima f&ouml;rdern&quot;</a><br> 
                        <img src="../_images/trans.gif" width="1" height="5"><br> 
                        <img src="../_images/link.gif" width="12" height="10" align="absmiddle">&nbsp;<a href="presse_2.php">&quot;Bei 
                        uns hat sich durch die Schulung einiges getan&quot;</a> 
                      </td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2"><img src="../_images/trans.gif" width="1" height="5"></td>
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