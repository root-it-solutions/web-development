<?php include("../_inc/db_zugang.inc"); ?>
<html>
<head>
<title>Pluspunkt Unternehmensentwicklung</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../plus-style.css">
</head>

<body bgcolor="#76797B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="" background="../_images/hg.jpg">
<table width="608" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td colspan="2" height="24">&nbsp;</td>
  </tr>
  <tr> 
    <td width="219" valign="top"> 
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="die-pluspunkt-partnerschaft.php" target="_self">Die Pluspunkt 
        Partnerschaft</a><br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="broeker.php" target="_self">br&ouml;ker Catering &amp; Event GmbH</a>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="dimento.php" target="_self">Dimento Design</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="immergruen.php" target="_self">Immergr&uuml;n</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="intectum.php" target="_self">Intectum</a>
        <br>
       <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="kleegraefe.php" target="_self">Kleegr&auml;fe &amp; Strothmann</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="markplan.php" target="_self">Markplan</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="reha-klinik.php" target="_self">Reha Klinik Reinhardsquelle</a> 
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="rothenberger.php" target="_self">Rothenberger Gastronomie</a> 
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle"> 
        &nbsp;<a href="schlotmann.php" target="_self">Schlotmann und Partner</a>
         <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten-2.gif" width="20" height="17" align="absmiddle">
        &nbsp;<a href="partner-seminare.php" target="_self">Seminare Partner</a>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../_images/w-kasten.gif" width="20" height="17" align="absmiddle">
        &nbsp;<a href="partner-vortraege.php" target="_self">Vorträge Partner </a></p>
    </td>
    <td width="389" valign="top" bgcolor="#D6D6D6"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr bgcolor="#76797B" valign="top"> 
          <td>
          <p><b><img src="../_images/rub-seminare-partner.gif" width="266" height="20"></b></p>
          <table border="0">
<?php 
$seminare = mysql_query("SELECT id,name,datum FROM seminare WHERE status='Partner' ORDER BY reihenfolge DESC",$db);
WHILE ($seminare_ok = mysql_fetch_array($seminare))
{
?>
              <tr valign="top"> 
                <td colspan="2" height="20">&middot; <a href="seminare-anzeigen.php?sid=<?php  echo $seminare_ok["id"];?>"> 
                  <?php  echo $seminare_ok["name"];?>
                  </a></td>
              </tr>
              <tr> 
                <td width="3" valign="top">&nbsp;</td>
                <td valign="top"><font size="1"> 
                  <?php  echo $seminare_ok["datum"];?>
                  <br>
                  &nbsp; </font></td>
              </tr>
<?php 
}
?>
</table>
            </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td width="219" valign="top">&nbsp;</td>
    <td width="389" valign="top"><?php  include "../_inc/submenue.inc"; ?></td>
  </tr>
</table>
<p>&nbsp;</p></body>
</html>
