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
				<p>
					<img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20">
					<font size="1">[ <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> ]</font>
				</p>
				<p>
					Tipps
					<br />
					<br />
					<strong>Atmosfair</strong> 
					<br /><br />von: Ralf Lohe
				</p>
				<p>
					Dass das Verbrennen fossiler Brennstoffe für unser Klima nicht gut ist, wissen wir schon länger. Die Frage, ob der Einzelne durch einen anderen Umgang mit Energie etwas bewegen kann wurde zwar mit „ja“ beantwortet. Doch mit der Argumentation, dass die Wirkung nur gering und global gesehen unbedeutend ist, folgte meist kein Handeln.
				</p>
				<p>
					Nachdem ich die Gelegenheit genutzt habe, mir auf Einladung von Klaus Hölcke (<a href="http://www.immergruen.de">www.immergruen.de</a>) den Film „Eine unbequeme Wahrheit“ von El Gore anzuschauen, stellt sich für mich diese Frage nicht mehr. An diese Stelle ist ein Aussagesatz getreten. Wenn wir unseren Kindern einen bewohnbaren Planeten hinterlassen wollen, kann es nur noch heißen: Ab sofort muss jeder alles in seiner Macht stehende unternehmen, um den Ausstoß von CO² zu reduzieren und wo immer es geht dafür sorgen, dass CO² gebunden wird.
				</p>
				<p>
					Zwar ist mir klar, dass die jetzt geforderte Veränderung unseres Verhaltens nicht einfach zu realisieren ist. Doch als wertebewusster Mensch ist es jetzt eine Verpflichtung für mich, mein Verhalten zu überdenken und nach und nach zu verändern.
				</p>
				<p>
					Für Pluspunkt bedeutet es auch die Reisen nach Spanien, die alle mit dem Flugzeug unternommen werden, einer kritischen Prüfung zu unterziehen. Da wir aus mehreren Gründen derzeit nicht auf die bewährten Veranstaltungsorte in der Sonne verzichten können, bietet sich an, für die durch den Flug verursachte Umweltverschmutzung eine Art Wiedergutmachung zu betreiben.
				</p>
				<p>
					Hierzu bietet die gemeinnützige Atmosfair GmbH (<a href="http://www.atmosfair.de">www.atmosfair.de</a>) eine Möglichkeit. Auf der Website lässt sich der persönliche Anteil an CO²-Ausstoß für jeden Flug berechnen. Über eine Spende an Atmosfair kann dann jeder dazu beitragen, dass Projekte in den Bereichen Solarenergie, Wasserkraft, Biomasse oder Energieeinsparung durchgeführt werden; und das weltweit.
				</p>
				<p>
					<img src="../../_images/link.gif" width="12" height="10" align="absmiddle"> 
					<a href="javascript:history.go(-1);">Zur&uuml;ck</a>
				</p>
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
