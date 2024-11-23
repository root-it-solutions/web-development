<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Selfcoaching";
$titel = "selfcoaching";
$hauptmenue=2;
$submenue=2;
?>
<html>
<head>
<title><?php echo "$seitentitel";?></title>
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
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B">
                <td>
                  <p><b><img src="../_images/rub-vortraege.gif" width="266" height="20"></b></p>
                  <p><b><img src="../_images/ico-pdf.gif" width="16" height="16">&nbsp;&nbsp;<a href="pdf_viewer.php?pdf_file=http://www.pluspunkt.de/Vortragsthemen3.pdf" target="_blank">Vortragsthemen
                    F&uuml;hrung</a> </b></p>
                  <p>&quot;K&ouml;nnen Sie bei unserer Veranstaltung nicht mal
                    einen Vortrag halten?&quot;</p>
                  <p>&quot;Ja, gerne, sofern es ein Thema sein soll, von dem wir
                    auch was verstehen.&quot;</p>
                  <p>Manfred Rumi und Ralf Lohe, die Gesch&auml;ftsf&uuml;hrer
                    und Gesellschafter der Pluspunkt Unternehmensentwicklung GmbH
                    halten gerne Vortr&auml;ge zu allen Themen rund um das Thema
                    F&uuml;hren im Unternehmen. Dabei ist es ein besonderes Anliegen
                    den Teilnehmern mit Empfehlungen dienlich zu sein, die umgesetzt
                    zu mehr<br>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#149;&nbsp;&nbsp;Verantwortlichkeit<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#149;&nbsp; unternehmerischen
                    Denken<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#149;&nbsp; Freude an der Arbeit<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#149;&nbsp; Erfolg im Beruf
                    und im privaten Leben<br>
                    <br>
                    F&uuml;hren. </p>
                  <p>Die im Folgenden vorgeschlagenen Themen sollen SIe lediglich
                    inspirieren. Sprechen Sie uns an und wir kreieren Ihnen einen
                    aktuellen Vortrag zu den f&uuml;r Sie und Ihre Zuh&ouml;rer
                    relevanten Themen.</p>
                  <?php 
$vortraege = mysql_query("SELECT id,thema FROM vortraege WHERE status=1 ORDER BY thema ASC",$db);
WHILE ($vortraege_ok = mysql_fetch_array($vortraege))
{
?>
                  <p>&middot; <a href="vortraege-anzeigen.php?vid=<?php echo $vortraege_ok["id"];?>">
                    <?php echo $vortraege_ok["thema"];?>
                    </a></p>
                  <?php 
}
?>
                  <br>
                  <br>
                </td>
              </tr>
            </table>
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
