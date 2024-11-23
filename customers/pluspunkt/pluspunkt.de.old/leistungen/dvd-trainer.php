<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - DVD-Trainer";
$titel = "dvdtrainer";
$hauptmenue=2;
$submenue=2;
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
    <td bgcolor="#77787C" width="628" valign="top">
      <table width="608" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td colspan="2" height="24">&nbsp;</td>
        </tr>
        <tr>
          <td width="219" valign="top">
            <?php  require "../_inc/submenue-$submenue.inc.php"; ?>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6">
            <!-- start -->
			<table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B">
                <td valign="top">
                  <p><b><img src="../_images/rub-dvdtrainer.gif" width="266" height="20"></b></p>
                  <div class=Section1>
                    <p><b>Interaktives Lehren und Lernen</b></p>
                    <p>Das gr&ouml;&szlig;te Problem von Trainingsveranstaltungen
                      ist ein ver&auml;ndertes Verhalten nachhaltig zu erzeugen.
                      Pr&auml;senztrainings haben hier nur einen begrenzten Erfolg.
                      Viel wirkungsvoller sind Ma&szlig;nahmen, die die Umsetzung
                      des Gelernten in der Praxis sicherstellen. Um diesem Anspruch
                      gerecht zu werden, haben wir zusammen mit <a href="http://www.christoph-niederberger.de" target="_blank">Christoph
                      Niederberger</a> und <a href="http://www.unternehmens.tv" target="_blank">Harald
                      Ortlieb</a> ein interaktives Trainingsprogramm entwickelt,
                      das vom <a href="http://www.wbv.de" target="_blank">W.
                      Bertelsmann Verlag</a> vertrieben wird. Wir haben hierin
                      unsere guten Erfahrungen mit unserer ersten Schulungs-DVD,
                      die wir f&uuml;r die Edeka Minden-Hannover bereits vor vier
                      Jahren produziert haben, einflie&szlig;en lassen.</p>
                      <p><b>Lesen Sie hierzu mehr</b>:</p>
                      <p>
                      <a href="dvd-trainer-die-inhalte.php">Die Inhalte</a><br>
                      <a href="dvd-trainer-funktionsweise.php">Funktionsweise</a><br>
                      <a href="dvd-trainer-vorteile.php">Vorteile</a><br>
                      <a href="dvd-trainer-kosten.php">Kosten</a><br>
                      <a href="dvd-trainer-trainerleitfaden.php">Trainerleitfaden</a><br>
                      <a href="dvd-trainer-presse.php">Presseveröffentlichungen</a><br>
                      <a href="../dvd-trainer-videos.php">Beispielvideos</a><br>
                      </p>
                      <p>
                      <b>Nähere Informationen und Kontakt</b>:<br/><br/>
                      Ralf Lohe<br/>
                      Tel. 02597 - 95 53<br/>
                      E-Mail. <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#108;&#111;&#104;&#101;&#64;&#112;&#108;&#117;&#115;&#112;&#117;&#110;&#107;&#116;&#46;&#100;&#101;">&#108;&#111;&#104;&#101;&#64;&#112;&#108;&#117;&#115;&#112;&#117;&#110;&#107;&#116;&#46;&#100;&#101;</a>
                      </p>
                  </div>
                 </td>
              </tr>
              <tr bgcolor="#76797B">
                <td>&nbsp;</td>
              </tr>
            </table>
			<!-- ende -->
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