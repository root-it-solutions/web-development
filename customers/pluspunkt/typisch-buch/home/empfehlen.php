<?php 
function urlumwandlung($str)
{
	$pattern = '#(^|[^\"=]{1})(http://|ftp://|mailto:|news:)([^\s<>]+)([\s\n<>]|$)#sm';
	return preg_replace($pattern,"\\1<a href=\"\\2\\3\">\\2\\3</a>\\4",$str);
}
?>
<html>
<head>
<title>Potentiale erlebter Kommunikation - das Buch</title>
<?php  include "../_inc/meta.inc"; ?>
<link rel="stylesheet" href="../typisch.css" type="text/css">
</head>

<body bgcolor="#333333" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center"><?php  include "../_inc/header.inc"; ?></div>
<table width="780" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr valign="top"> 
    <td rowspan="2" bgcolor="#E6E6E6" background="../_images/new_left_hg.gif" width="214"> 
      <table width="204" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><?php  include "../_inc/menue.inc"; ?><img src="../_images/trans.gif" width="1" height="85"> </td>
        </tr>
        <tr> 
          <td><img src="../_images/trans.gif" width="2" height="1"><img src="../_images/figuren.jpg" width="197" height="146"><br>
            &nbsp; </td>
        </tr>
      </table>
    </td>
    <td background="../_images/new_right_hg.gif" bgcolor="#E6E6E6" height="448"> 
      <!--start -->
<table width="565" border="0" cellspacing="0" cellpadding="3">
        <tr> 
          <td width="417"> 
            <h1><b>Empfehlen sie diese Website</b></h1>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td colspan="2"> 
                  <?php 
IF ($_POST[todo] == "send")
{
$text = urlumwandlung($text);
  $empfaenger = $emailempfaenger;
  $betreff = "Typisch-Buch.pluspunkt.de von $nameabsender";
  $nachricht = nl2br($text) ."<br><br>Die Email wurde verschickt von: $nameabsender ($emailabsender)<hr size=1>Diese Email wurde durch einen Besucher der Website <a href=\"http://typisch-buch.pluspunkt.de\" target=\"_blank\">typisch-buch.pluspunkt.de</a> versandt.";
  $header  = "From: $nameabsender <$emailabsender>\n";
  $header .= "Content-Type: text/html\nContent-Transfer-Encoding: 8bit\n";
  $header .= "X-Mailer: PHP ". phpversion();

  mail($empfaenger,$betreff,$nachricht,$header, "-finfo@typisch-buch.pluspunkt.de");

  echo "<br><b>Die Empfehlung wurde erfolgreich versandt.</b><br><br>Vielen Dank.";
}
ELSE
{
?>
                  <p><font face="Arial, Helvetica, sans-serif">Wir w&uuml;rden 
                    uns freuen, wenn Sie den Link zu unserer Buchvorstellungs-website 
                    an interssierte Personen weitersenden w&uuml;rden. Dazu brauchen 
                    Sie lediglich das folgende Formular ausf&uuml;llen und absenden.<br>
                    <br>
                    Vielen Dank!</font></p>
                  <form name="versenden" method="post" action="<?php  echo $_SERVER[PHP_SELF];?>">
                    <table width="100%" border="0" cellspacing="1" cellpadding="2">
                      <tr> 
                        <td width="35%"> 
                          <div align="right"><font face="Arial, Helvetica, sans-serif">Ihr 
                            Name:</font></div>
                        </td>
                        <td> <font face="Arial, Helvetica, sans-serif" size="2" color="#CCCCCC"> 
                          <input type="text" name="nameabsender">
                          </font></td>
                      </tr>
                      <tr> 
                        <td> 
                          <div align="right"><font face="Arial, Helvetica, sans-serif">Ihre 
                            E-Mailadresse:</font></div>
                        </td>
                        <td> <font face="Arial, Helvetica, sans-serif" size="2" color="#CCCCCC"> 
                          <input type="text" name="emailabsender">
                          </font></td>
                      </tr>
                      <tr> 
                        <td> 
                          <div align="right"><font face="Arial, Helvetica, sans-serif">Name 
                            des Empf&auml;ngers:</font></div>
                        </td>
                        <td> <font face="Arial, Helvetica, sans-serif" size="2" color="#CCCCCC"> 
                          <input type="text" name="nameempfaenger">
                          </font></td>
                      </tr>
                      <tr> 
                        <td> 
                          <div align="right"><font face="Arial, Helvetica, sans-serif">E-Mailadresse 
                            des Empf&auml;ngers:</font></div>
                        </td>
                        <td> <font face="Arial, Helvetica, sans-serif" size="2" color="#CCCCCC"> 
                          <input type="text" name="emailempfaenger">
                          </font></td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <div align="right"><font face="Arial, Helvetica, sans-serif">Ihre 
                            Nachricht:</font></div>
                        </td>
                        <td> <font face="Arial, Helvetica, sans-serif" size="2" color="#CCCCCC"> 
                          <textarea name="text" cols="40" rows="6">Guten Tag, 

schauen Sie sich einmal 
diese Website an: 
http://typisch-buch.pluspunkt.de</textarea>
                          </font></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                        <td> <font face="Arial, Helvetica, sans-serif" size="2" color="#CCCCCC"> 
                          <input type="submit" name="Abschicken" value="Empfehlung absenden">
                          <input type="hidden" name="todo" value="send">
                          </font></td>
                      </tr>
                    </table>
                  </form>
                  <?php 
}
?>
                </td>
              </tr>
            </table>
            <p>&nbsp;</p>
            </td>
          <td width="136">&nbsp;</td>
        </tr>
        <tr> 
          <td width="417">&nbsp;</td>
          <td width="136">&nbsp;</td>
        </tr>
      </table>
<!--end -->
    </td>
  </tr>
  <tr> 
    <td width="571" bgcolor="#E6E6E6" background="../_images/new_right_hg.gif" height="40" valign="top"><?php  include "../_inc/footer.inc"; ?></td>
  </tr>
  <tr> 
    <td colspan="2"><img src="../_images/new_footer_hg.gif" width="780" height="5"></td>
  </tr>
</table><p>&nbsp;</p>
</body>
</html>
