<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Impressum";
$titel = "impressum";
$hauptmenue=5;
$submenue=5;

IF ($pass == "rumilohe")
{
  header("Location: http://www.pluspunkt.de/pluspadmin/index.php");
}
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
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr bgcolor="#76797B" valign="top">
                <td height="300" bgcolor="#76797B">
                  <table width="100%" border="0" cellspacing="0" cellpadding="20">
                    <tr bgcolor="#76797B" valign="top">
                      <td>
                        <p><b><img src="../_images/rub-impressum.gif" width="266" height="20"></b></p>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="2"><b>Herausgeber: </b><br>
                              Pluspunkt GmbH <br>
                              Ostereckern 9<br>
                              59387 Ascheberg<br>
                              Tel: 02593 - 95 888 0 <br>
                              Fax: 02593 - 95 888 01 <br>
                              Web: www.pluspunkt.de<br>
                               <span onclick="javascript:linkTo_UnCryptMailto('rfnqEuqzxuzspy3ij');" style="cursor:pointer; display:block; width:148px; background:url('../_images/a.gif') right bottom no-repeat;">E-Mail:</span><br>
                              Geschäftsführende Gesellschafter: Ralf Lohe, Manfred Rumi
                               <br /><br />Registergericht: <br>
                              Amtsgericht Coesfeld HRB 7283<br>
                              UST-IdNr.: DE 191916553 <br>
                              &nbsp; </td>
                          </tr>
                          <tr>
                            <td colspan="2"><b>Konzept, Realisierung, Screendesign:
                              </b><br>
                              dimento.com<br>
                              INTERNET KOMMUNIKATION<br>
                              Hammer Str. 89<br>
                              48153 M&uuml;nster<br>
                              <br>
                              Tel.: (0251) 3 22 65 44 - 0<br>
                              Fax: (0251) 3 22 65 44 - 99<br>
                              Web: <a href="http://www.dimento.com" title="Werbeagentur / Internetagentur" target="_blank">www.dimento.com</a><br>
                              E-Mail: <a href="mailto:info@dimento.com">info@dimento.com</a></td>
                          </tr>
                          <tr>
                            <td colspan="2"><br>
                              © 2002 - 2012 by Pluspunkt GmbH. Alle Rechte vorbehalten.
                              <p>Die Informationen sind Eigentum der <b>Pluspunkt
                                GmbH</b>. Sie stellen die zum Zeitpunkt der Publikation
                                jeweils neusten Informationen dar. Eine Haftung
                                oder Garantie für die Aktualität, Richtigkeit
                                und Vollständigkeit der zur Verfügung gestellten
                                Informationen und Daten ist ausgeschlossen. Dies
                                gilt ebenso für alle anderen Websites, auf die
                                mittels eines Hyperlinks verwiesen wird. Für den
                                Inhalt solcher Sites ist die <b>Pluspunkt GmbH</b>
                                ebenfalls nicht verantwortlich. </p>
                              <p>Die Informationen auf den Webseiten stellen in
                                keinem Fall rechtliche Zusicherungen dar. Die
                                <b>Pluspunkt GmbH</b> behält sich das Recht vor,
                                bei Bedarf Änderungen oder Ergänzungen der bereitgestellten
                                Informationen oder Daten durchzuführen. Aus den
                                hier beschriebenen Themenbereichen können keine
                                Rechtsansprüche abgeleitet werden. Angebote sind
                                in allen Teilen unverbindlich. </p>
                              <p>Die <b>Pluspunkt GmbH</b> haftet weder für direkte
                                noch indirekte Schäden, die durch die Nutzung
                                der Informationen oder Daten entstehen, die auf
                                dieser Website zu finden sind. Rechte und Pflichten
                                zwischen der <b>Pluspunkt GmbH</b> und dem Nutzer
                                der Website oder Dritten bestehen nicht. </p>
                              <p>Die Inhalte der <b>Pluspunkt GmbH</b> sind urheberrechtlich
                                geschützt. Die Inhalte dürfen weder ganz noch
                                teilweise ohne vorherige schriftliche Genehmigung
                                des Urhebers vervielfältigt und/oder veröffentlicht
                                oder in einem Informationssystem gespeichert werden.
                              </p>
                              <p>Sämtliche Informationen oder Daten, ihre Nutzung
                                sowie sämtliches mit der Website der <b>Pluspunkt
                                GmbH</b> zusammenhängendes Tun, Dulden oder Unterlassen
                                unterliegen ausschließlich deutschem Recht, unter
                                Ausschluss von internationalem Recht. Erfüllungsort
                                und ausschließlicher Gerichtsstand ist L&uuml;dinghausen.
                              </p>
                              <p>Optimiert für Netscape (ab 4.x), Internet Explorer
                                (ab 4.x) und JavaScript bei einer Mindestauflösung
                                von 800x600. </p>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <form name="login" method="post" action="<?php $PHP_SELF;?>">
                                <font color="#CCCCCC"><img src="../_images/trans.gif" width="1" height="6"><br>
                                <br>
                                <input type="text" name="pass" size="16">
                                &nbsp;
                                <input type="submit" name="Button2" value="Login" width="70" style="background-color=#546E8B;color=#ffffff;width=70">
                                </font>
                              </form>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="219" valign="top">&nbsp;</td>
          <td width="389" valign="top">
            <?php  include "../_inc/submenue.inc"; ?>
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
