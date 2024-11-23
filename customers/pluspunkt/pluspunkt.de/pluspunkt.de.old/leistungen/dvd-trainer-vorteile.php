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
                    <p><b>Was sind die Vorteile des DVD-Trainers</b></p>
                  </div>
                  <ul>
                    <li>&nbsp;Sie erhalten f&uuml;r alle vier Themen eine sogenannte
                      &quot;K&ouml;nigsl&ouml;sung&quot;, die ein optimales Verhalten
                      beschreibt und somit zum Leitbild f&uuml;r Ihr Unternehmen
                      wird.<br>
                      <br>
                    </li>
                    <li>&nbsp;Die professionelle Herstellung (nach Drehbuch mit
                      professionellen Schauspielern; modernste Programmiertechnik)
                      wirken die Szenen wie im Kino und erreichen den Betrachter
                      auch emotional. Dadurch werden im Lernvorgang beide Gehirnh&auml;lften
                      angesprochen, was nachweislich zu besseren Lernergebnissen
                      f&uuml;hr.<br>
                      <br>
                    </li>
                    <li>&nbsp;Sie erhalten mindestens 50 DVD, die sowohl &auml;u&szlig;erlich
                      als auch durch die Gestaltung der internen Screen an Ihr
                      CD angepasst sind. Dies garantiert Ihnen eine hohe Akzeptanz
                      durch Ihre Mitarbeiter.<br>
                      <br>
                    </li>
                    <li>&nbsp;Das Programm kann &uuml;berall dort eingesetzt werden,
                      wo ein DVD-Player oder ein DVD-Laufwerk in einem PC zur
                      Verf&uuml;gung steht. Die Einsatzm&ouml;glichkeiten sind
                      somit nahezu unbegrenzt.<br>
                      <br>
                    </li>
                    <li>&nbsp;Sie erreichen durch das individuelle Coaching auch
                      alle Mitarbeiter. Selbst Mitarbeiter, die erst in der Zukunft
                      eingestellt werden, k&ouml;nnen dann schnell unabh&auml;ngig
                      von Trainern oder Trainingszeiten geschult werden.<br>
                      <br>
                    </li>
                    <li>&nbsp;Die sich selbst erkl&auml;rende einfache Menuef&uuml;hrung
                      erm&ouml;glicht auch das autodidaktische Lernen.</li>
                  </ul>
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