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
            	<b>Führungstipp – Schulungsbudget</b>
            </p>
            <p>
				Es ist unbestritten, dass uns Lernen lebenslang begleitet. Jedes Unternehmen, das sich im Markt behauptet, schult Mitarbeiter entsprechend den Anforderungen. Bisher war es dabei selbstverständlich, dass die Kosten dafür vom Unternehmen getragen wurden. Überwiegend wurde sogar die Zeit während der Seminare als Arbeitszeit bezahlt. Doch dies ist nicht fair, haben doch die geschulten Mitarbeiter auch einen persönlichen Nutzen, der ihnen beim Ausscheiden aus dem Unternehmen erhalten bleibt. Deshalb hier unser Vorschlag:
            </p>
            <p>
				Vereinbaren Sie mit Mitarbeitern, die Sie neu einstellen, dass ein Teil des Lohnes in einen Weiterbildungsfond gezahlt wird. Der Mitarbeiter hat dann Anspruch auf den Besuch von Seminaren, die ihm vom Unternehmen empfohlen werden, wobei die Kosten hierfür aus dem Fond beglichen werden. 
            </p>
            <p>
				Rechenbeispiel: 
            </p>
            <p>
				Sie vereinbaren pro Arbeitsstunde einen Betrag von 50 Cent in den Fond einzubezahlen, so sind dies im Jahr bereits mehr als € 1.000. Sie können ja als Zeichen der Kooperation die gleiche Summe ebenfalls in den Fond zahlen. Dann verfügen Sie pro Mitarbeiter jährlich über ein Budget von € 2.000. So brauchen Sie auch nicht auf Seminare mit hoher Qualität zu verzichten, nur weil diese preislich teurer sind. Zudem können Sie Vertretungs- oder Reisekosten im Zusammenhang mit den Seminaren ebenfalls über den Fond abrechnen.
            </p>
            <p>
				Ihren bisherigen Mitarbeitern können Sie dann anbieten sich freiwillig an diesem Fond zu beteiligen. Die engagierten und loyalen Mitarbeiter werden dieses Angebot annehmen.
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
