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
                    <p><b>Die Kosten</b></p>
                    <p>Die Komfort-Version kostet &euro; 20.000. hierf&uuml;r
                      erhalten Sie 50 DVDs in Ihrem Corporate Design in einer
                      ansprechenden Verpackung, einen Trainerleitfaden und eine
                      eint&auml;gige Einweisung Ihrer Multiplikatoren.<br>
                      Zus&auml;tzlich k&ouml;nnen Sie auch ein Videostatement
                      von Ihnen als Vorspann erhalten. Hierf&uuml;r werden weitere
                      &euro; 3.000 berechnet.<br>
                      F&uuml;r die Produktion eines schwungvollen Video-trailers,
                      den Sie auch bei anderen Pr&auml;sentationen nutzen k&ouml;nnen,
                      berechnen wir &euro; 7.500.</p>
                  </div>
                  </td>
              </tr>              
              <tr bgcolor="#76797B">
                <td>
                      <p><b>Lesen Sie mehr</b>:</p>
                      <p>
                      <a href="dvd-trainer-die-inhalte.php">Die Inhalte</a><br>
                      <a href="dvd-trainer-funktionsweise.php">Funktionsweise</a><br>
                      <a href="dvd-trainer-vorteile.php">Vorteile</a><br>
                      <a href="dvd-trainer-kosten.php">Kosten</a><br>
                      <a href="dvd-trainer-trainerleitfaden.php">Trainerleitfaden</a><br>
                      </p>
                </td>
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