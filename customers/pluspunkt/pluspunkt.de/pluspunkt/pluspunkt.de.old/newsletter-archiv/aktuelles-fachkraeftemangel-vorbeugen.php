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
          <td  height="260"> 
            <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b><font size="1">[ <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> ]</font></p>
			<p>
				Aktuelles
			</p>
            <p>
				<strong>Fachkräftemangel vorbeugen</strong><br />
				Von: Ralf Lohe
			</p>
			<p>
				Die wirkungsvollste Methode einem Fachkräftemangel vorzubeugen, ist, gute Mitarbeiter zu halten und ans Unternehmen zu binden. Zu den besten Motivatoren gehören dabei:
				<ul>
					<li>herausfordernde Arbeiten übertragen</li>
					<li>qualifizierte Weiterbildung vermitteln und der</li>
					<li>besondere Dank in materieller und/ oder immaterieller Form.</li>
				</ul>
				In der betrieblichen Realität wird dies durch die Konzentration auf die Alltagsprobleme leicht aus dem Auge verloren. Um Sie bei diesem wichtigen Thema zu unterstützen, haben wir das Rhetorik-spezial-Training kreiert. Innerhalb einer Woche nehmen hier Ihre verdienten Mitarbeiter vormittags an einem Kommunikationstraining teil. Nachmittags können sie dann ausspannen, Sport treiben, Wellness genießen oder auf andere Weise ihre Seele baumeln lassen. Durch den Veranstaltungsort Robinson Club Cala Serena auf Mallorca bekommt die Weiterbildung auch einen Incentiv-Charakter, der sehr positiv auf die Motivation wirkt. 
				Buchen Sie jetzt schon Ihre Kontingente für sich und/ oder Ihre Mitarbeiter für den nächsten Termin, damit wir Ihre Zimmer reservieren können. <a href="http://www.pluspunkt.com/leistungen/rhetorikspezial.php">Lesen Sie hier mehr über das Training</a>.
            </p>
            
            <p><img src="../../_images/link.gif" width="12" height="10" align="absmiddle"> 
                    <a href="javascript:history.go(-1);">Zur&uuml;ck</a><br>
                    <br>
                    <br>
                    <br>
                    <br>
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
