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
					<strong>Führung heute</strong> 
					<br /><br />von: Ralf Lohe
				</p>
				<p>
					Immer mehr Firmen klagen, dass gute Kräfte kaum noch auf dem Arbeitsmarkt zu finden sind. In der Tat besteht die Gefahr, dass zukünftig Aufträge nicht mehr angenommen werden können, weil die passenden Mitarbeiter nicht zur Verfügung stehen und die bestehende Mannschaft schon völlig ausgelastet ist.
				</p>
				<p>
					Um dieses Phänomen nicht zu einem immerwährenden Problem zu machen und darunter zu leiden, ist es erforderlich eine Führungskultur zur entwickeln, die dieser Entwicklung des Marktes entgegenwirken kann.
				</p>
				<p>
					Führung bedeutet heute folglich immer mehr auch Ausbildung und Entwicklung von Mitarbeitern, Bindung der guten Mitarbeiter an das Unternehmen und dafür zu sorgen, dass über ein perfektes Image das Unternehmen interessant für externe Bewerber wird.
				</p>
				<p>
					In unserem Führungsseminar überprüfen und entwickeln Sie Ihre persönliche Führungskompetenz, lernen konsequent zu führen, Ihren Verantwortungsbereich an Ihren Werten auszurichten und werden zum Personalentwickler und Coach für die Ihnen anvertrauten Mitarbeiter. So können Sie getrost in die Zukunft schauen und diese mit gestalten.
				</p>
				<p>
					Nehmen Sie Kontakt mit uns auf und lassen sich hinsichtlich der Entwicklung Ihrer Führungskompetenz von uns beraten. Oder buchen Sie unser Führungsseminar.
				</p>
				<p>
					Nächster Termin: 28.04. – 05.05.2007.
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
