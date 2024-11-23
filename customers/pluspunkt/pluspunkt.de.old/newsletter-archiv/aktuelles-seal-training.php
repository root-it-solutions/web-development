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
                  <p>Aktuelles<br><br>
                   <b>Selbstbestimmung</b><br>
                    Von Ralf Lohe
                    <br>
                   </p>
                   <p>
                   Wenn Sie das Gefühl haben, dass Sie in Ihrem Leben noch nicht glücklich genug sind, dann überprüfen Sie doch mal welche der folgenden Aussagen für Sie zutreffen.
                   </p>
				<ul>
					<li>Ich habe häufig das Gefühl, dass ich nicht richtig voran komme, weil ich darauf warten muss, dass andere mir den Weg bereiten.</li>
					<li>Ich traue mir nicht so viel Neues zu und weiß nicht, welche Potenziale noch in mir schlummern.</li>
					<li>Ich habe immer wieder das Gefühl mich für andere zu verbiegen.</li>
					<li>Ich wüsste gerne, wie ich mein Leben positiv beeinflussen könnte.</li>
					<li>Manchmal habe ich das Gefühl nur Symptome zu behandeln und an die eigentlichen Wurzeln meiner Probleme nicht heran zu kommen.</li>
					<li>Viele Entscheidungen empfinde ich als schlechten Kompromiss.</li>
					<li>Ich wüsste gerne, wie ich in meinem Leben zu Glück und Wohlstand gelangen kann.</li>
				</ul>
                  <p>
					Wenn Sie sich hier wieder finden, sollten wir miteinander reden. Die Antworten auf Ihre Fragen, wie Sie aus diesen Situationen heraus kommen, liegen in Ihnen. Sie beruhen auf der Erkenntnis, dass die Verantwortung für unser Leben nur bei uns liegt. Wir helfen Ihnen an Ihre Antworten heranzukommen durch unser SEAL-Training. 
				</p>
				<p>
					SEAL Steht für 
				
				</p>
				<ol>
					<li>Sinngebung für das eigene Leben</li>
					<li>Entwicklung der Persönlichkeit</li>
					<li>Anpassung der Rahmenbedingungen und</li>
					<li>Lernen aus Erfolgen und Misserfolgen</li>
				</ol>
				<p>
				Mehr zum Training erfahren Sie <a href="/leistungen/seal-training.php">hier</a>.
					Sprechen Sie mit uns, ob eine Teilnahme für Sie den gewünschten Erfolg bringen kann. Wir beraten Sie gerne.
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
