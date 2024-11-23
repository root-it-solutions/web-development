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
                  <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"></b><font size="1">[ 
                    <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> 
                    ]</font></p>
                  <p>Aktuelles<br>
                    <br>
                    <b>Insights MDI - Pr&auml;ferenzanalyse</b></p>
                  <p>Effektive Teambildung, treffsichere Bewerberauswahl, individuelles 
                    Coaching - Pluspunkt unterst&uuml;tzt Sie bei der Umsetzung 
                    professionell!<br>
                    <br>
                    Im besten Fall arbeiten Ihre Projektteams und Abteilungen 
                    ergebnisorientiert und reibungslos, Prozesse laufen wie &quot;geschmiert&quot; 
                    und Sie besetzen freie Stellen ausnahmslos mit den richtigen 
                    Leuten. Doch mal Hand aufs Herz: Ist das so einfach, ist das 
                    die Alltags-Realit&auml;t? Normalerweise ist es doch so, dass 
                    es &uuml;berall, wo verschiedene Menschen aufeinander treffen, 
                    auch mal zu Schwierigkeiten kommt. Das m&uuml;ssen nicht immer 
                    massive Probleme sein. Es reicht oft schon, dass es beispielsweise 
                    durch ein Missverst&auml;ndnis unter den Kollegen zu Lieferengp&auml;ssen 
                    bei Ihrem Kunden kommt. Oder in einem Team ist die Stimmung 
                    schlecht und keiner kann richtig erkl&auml;ren, was los ist.<br>
                    <br>
                    Mit dem Analyseverfahren  
                    <a href="../leistungen/insights-methode.php">Insights&reg; 
                    MDI</a> stellen wir Ihnen eine M&ouml;glichkeit zur Verfügung, mit der wir 
                    Sie kompetent bei diesen Themen unterst&uuml;tzen k&ouml;nnen:</p>
                  <ul>
                    <li>Teams effektiv zusammen stellen</li>
                    <li>Die richtigen Bewerber einstellen</li>
                    <li>Spannungen in Arbeitsgruppen beseitigen<br>
                    </li>
                    <li>Entwicklungspotenziale bei Mitarbeitern aufzudecken<br>
                      <br>
                    </li>
                  </ul>
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
