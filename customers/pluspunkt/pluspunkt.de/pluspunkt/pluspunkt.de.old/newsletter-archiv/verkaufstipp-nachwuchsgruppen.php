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
                  <p>Tipps<br>
                    <br>
                    <b>Verkaufstipp - Nachwuchsgruppe </b><br>
                    Von Pluspunkt </p>
                  <p>Immer wieder brechen F&uuml;hrungskr&auml;fte weg (Umzug, Babypause, K&uuml;ndigung etc.) oder es entsteht ein Mangel bei der Er&ouml;ffnung einer weiteren Filiale. Am besten ist es, wenn diese Stellen mit Mitarbeitern aus dem eigenen Haus besetzt werden k&ouml;nnen. Diese sollten aber bereits vorher auf ihre Aufgabe vorbereitet sein. </p>
                  <p>Hier empfiehlt sich die Einrichtung einer Nachwuchsgruppe, die in kontinuierlichen Abst&auml;nden durch gezielte Fortbildung gef&ouml;rdert wird. </p>
                  <p>Gleichzeitig werden die Mitglieder dieser Nachwuchsgruppe durch ihre direkten Vorgesetzten gef&ouml;rdert, indem sie besondere Aufgaben bekommen und so in ihrer Arbeit auf ein sehr hohes Niveau gebracht werden. </p>
                  <p>Dadurch erh&auml;lt man deren hohe Motivation &uuml;ber einen sehr langen Zeitraum und kann auf personelle Engp&auml;sse immer schnell und qualitativ reagieren. </p>
                  <p>Hier ein paar exemplarische Ideen, wodurch die Entwicklung beschleunigt werden kann:</p>
                  <ul>
                    <li>&Uuml;bertragung von tempor&auml;ren Aufgaben und Projekten <br>
                    </li>
                    <li>Zeitweilige Teilnahme an F&uuml;hrungskr&auml;ftebesprechungen <br>
                    </li>
                    <li>Exkursionen zu Lieferanten <br>
                    </li>
                    <li>Beobachtungen beim Wettbewerb (Benchmark vorbereiten) <br>
                    </li>
                    <li>Leitung eines Ideen-pools f&uuml;r Verbesserungen <br>
                    </li>
                    <li>Schulungen (interne, externe – fachlich, menschlich) </li>
                  </ul>                  <p><img src="../../_images/link.gif" width="12" height="10" align="absmiddle"> 
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
