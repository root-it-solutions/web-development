<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - dimento.com INTERNET KOMMUNIKATION";
$titel = "morethanwork";
$hauptmenue=4;
$submenue=4;
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
                  <p><b><img src="../_images/rub-morethanwork.gif" width="266" height="20"></b></p>
                  <p align="left"><img src="_img/morethanwork.jpg" width="85" height="66"></p>
                  <p><b>more than work GmbH<br>
                    Personaldienstleistungen</b><br>
                    <br>
                    <i>&quot;Eine richtige Personaldienstleistung ist mehr als 
                    ein Pflichtprogramm.&quot;</i></p>
                  <p><ul>
                    <li>Personalleasing,</li>
                    <li>Personalberatung</li>
                    <li>Personaladministration</li>
                    <li>Outsourcing</li>
                    <li>Externe Personalleitung</li><br><br>
					
                  <ul>
				  <li>Unsere Zielgruppe: Handwerk, Industrie sowie kaufm&auml;nnische, verwaltungstechnische, kreative und soziale Bereiche</li>
                  <li>Unser Spezialgebiet: Vermittlung von Fachkr&auml;ften</li>
                  <li>Unser Standard: &Uuml;berlassung nach gesetzlichem Tarifvertrag</li>
                  <li>Unsere Garantie: Individuelle Abstimmung von Qualifikation und Pers&ouml;nlichkeit des Bewerbers</li>
                  <li>Unsere Basis: Vertrauen, denn der Mensch steht im Vordergrund</li>
                  <li>IHR Gewinn: Flexibilit&auml;t und Kraft durch flexible Kr&auml;fte</li>
                  <li>Unsere Philosophie: Wir vermitteln Zufriedenheit</li>
				  </ul></ul>
                  <p>Wienkamp links 21<br>
                    46354 S&uuml;dlohn</p>
                  <p>
                  	Tel. 02862 / 4174 - 0<br>
                    Fax. 02862 / 4174 - 29<br>
                    Mobil. 0172 / 28 25 666<br>
                  </p>
                  <p> <img src="../_images/link.gif" width="12" height="10" align="absmiddle"> 
                    <a href="http://www.more-than-work.de" target="_blank">www.more-than-work.de</a></p>
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