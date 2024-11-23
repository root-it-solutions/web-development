<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Newsletter Archiv";
$titel = "newsletter-archiv";
$hauptmenue=2;
$submenue=2;
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
</head>
<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" ">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<table width="640"border="0" cellspacing="0" cellpadding="0" align="center" name="content">
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
        <tr bgcolor="#76797B"> 
          <td bgcolor="#76797B"> 
            <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b><font size="1">[ <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> ]</font></p>
                  <p>Literaturempfehlungen<br>
                    <br>
                    <b>Judith C. Wirth: Sozialkompetenzen gezielt f�rdern � eine Schritt-f�r-Schritt-Anleitung f�r F�hrungskr�fte</b><br>
                    von: Ralf Lohe</p>
					<p>
						keine langweilige Theorie, keine langen Einleitungen, stattdessen ein erfrischend praktisches Buch aus der Feder einer Praktikerin. Es eignet sich sowohl zum Lesen von vorne nach hinten, als auch als Nachschlagewerk und f�r die gezielte Vorbereitung auf Mitarbeitergespr�che.
						Was mir besonders gef�llt ist, dass Judith Wirth genau so wie wir der Meinung ist, dass Sozialkompetenz entwickelt werden kann und dass F�hrungskr�fte hierzu einen Auftrag haben. Anhand von Beispielen werden zahlreiche Coachingssituationen besprochen und der obtimale Ablauf beschrieben, so dass dies so nachgearbeitet werden kann. Dabei verweist die Autorin auch auf die Grenzen der Coachingm�glichkeiten durch Vorgesetzte. 
						Auch wenn es hier nur um die Entwicklung von Mitarbeitern geht, wird die aufmerksame F�hrungskraft erkennen, welches Ma� der Selbssteuerung notwendig ist, um ein Coaching erfolgreich zu gestalten. Allein dadurch wird auch die F�hrungskraft zum Lernenden und geht aus den Coachinggespr�chen ebenfalls gest�rkt hervor. Also Grund genug, sofort loszulegen. Am besten machen Sie sich sofort eine Liste mit welchem Sozialverhalten Ihrer Mitarbeiter Sie unzufrieden sind. Dann ins Buch schauen und lesen, wie in diesem Fall zu verfahren ist.
					</p>
						Orell f�ssli Verlag AG, Z�rich<br>ISBN: 978-3-280-05223-5, Euro 24,- <br>
                  </p>
                  <p><img src="../../_images/link.gif" width="12" height="10" align="absmiddle"> 
              <a href="javascript:history.go(-1);">Zur&uuml;ck</a></p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table><?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
