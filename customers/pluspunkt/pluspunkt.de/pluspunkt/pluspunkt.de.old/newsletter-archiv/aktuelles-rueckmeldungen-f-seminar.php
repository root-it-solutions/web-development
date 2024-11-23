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
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
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
            <p><b><img src="../../_images/rub-newsletter-archiv.gif" width="266" height="20"> 
              </b><font size="1">[ <a href="../leistungen/newsletter-anmeldung.php">Anmeldung</a> 
              ]</font></p>
            <p>Aktuelles<br>
              <br>
              <b>R&uuml;ckmeldungen zum F&uuml;hrungsseminar <a href="../javascript:;" onClick="MM_openBrWindow('../top-seminar/index.php','','toolbar=yes,width=640,height=400')">[Infos]</a></b></p>
            <p>Ob ein Seminar die Investition wert ist, erweist sich immer erst
              im Nachhinein. In einer zeitlichen Distanz von mindestens einem
              Jahr haben wir Teilnehmer unseres F&uuml;hrungsseminars befragen
              lassen. In den Anworten ist deutlich zu sp&uuml;ren, wie individuell
              das Seminar wahrgenommen wurde und die Inhalte umgesetzt wurden.
              Die kritischen Antworten helfen uns, uns und das Seminar weiter
              zu entwickeln. Die gro&szlig;e Zufriedenheit mit dem Seminarergebnis
              best&auml;rkt uns in unserem Tun.<br>
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
