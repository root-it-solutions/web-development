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
                    <p><b>Wie funktioniert das Programm ?</b></p>
                    <p>Auf einer DVD finden Sie zu den o.g. Themen jeweils eine
                      eingespielte Szene. Hierzu finden Sie dann eine Menge Informationen,
                      &uuml;ber die ein Coaching erfolgen kann. Mehr Informationen
                      zu den Inhalten erhalten Sie <a href="dvd-trainer-die-inhalte.php">hier</a>.</p>
                    <p>Eine Gruppe von F&uuml;hrungskr&auml;ften Ihres Unternehmens
                      wird als Multiplikatoren innerhalb eines eint&auml;gigen
                      Workshops auf ihre Arbeit vorbereitet. Danach sind sie in
                      der Lage mit der DVD und selber vorbereitet und unterst&uuml;tzt
                      durch den ausf&uuml;hrlichen <a href="#inhalt">Trainerleitfaden</a>
                      alle Ihre Mitarbeiter individuell zu allen <a href="#themen">Themen
                      auf dieser DVD</a> zu schulen. Hierf&uuml;r entstehen Ihnen
                      keine Kosten f&uuml;r Trainer, Schulungsr&auml;ume und Organisation.
                      Ihre Multiplikatoren sorgen dann f&uuml;r die Nachhaltigkeit
                      des Erlernten, wodurch Sie eine tats&auml;chlich wirksame
                      Verhaltens&auml;nderung erzielen.</p>
                  </div></td>
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