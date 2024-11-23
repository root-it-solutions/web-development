<html>
<head>
<title>Pluspunkt F&uuml;hrungsseminar</title>
<?php include("../_inc/meta.inc");?>
<?php include("../_inc/db.inc.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../seminar.css" type="text/css">
</head> 

<body bgcolor="#7697B0" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" background="../_images/hg-content.gif">
-
<table width="779" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="2" width="23"><img src="../_images/trans.gif" width="1" height="1"></td>
    <td width="756" valign="top" height="6">
      <table width="740" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td rowspan="3" width="20">&nbsp;</td>
          <td height="20" valign="bottom" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td height="10" width="524"><b class="titel">Termine &amp; Informationen</b><br>
            <img src="../_images/trans-weiss.gif" width="524" height="1"></td>
          <td valign="top" height="1" rowspan="2" width="203">
            <div align="right"><img src="../_images/trans.gif" width="202" height="8"></div>
          </td>
        </tr>
        <tr>
          <td valign="top" height="6" width="524">
            <p><br>
            </p>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="submenue">
              <tr valign="top">
                <td width="28%">
                  <p><img src="../_images/trans-hellgrau.gif" width="4" height="8">
                    <a href="javascript:history.go(-1);">Zur&uuml;ck</a></p>
                  </td>
                <td width="72%" valign="top">
                  <table width="100%" border="0" cellspacing="1" cellpadding="1" valign="top" class="text">
                    <tr valign="top">
                      <td colspan="2" height="20" valign="middle"><b class="titel">Führungsseminar</b>
                      </td>
                    </tr>
                    <tr>
                      <td width="3" valign="top">&nbsp;</td>
                      <td valign="top">
<?php
$seminare = mysql_query("SELECT * FROM seminare WHERE id = 1 ",$db);
WHILE ($seminare_ok = mysql_fetch_array($seminare))
{
    echo $seminare_ok["datum"];
}
?>
                      <br>
                      </td>
                    </tr>
                  <!--  <tr valign="top">
                      <td colspan="2" height="20" valign="middle"><b class="titel">SEAL-Training</b>
                      </td>
                    </tr>
                    <tr>
                      <td width="3" valign="top">&nbsp;</td>
                      <td valign="top">
                        	 03.07. - 09.07.2010 
                        <br>
                      </td>
                    </tr>-->
                    <tr valign="top">
                      <td colspan="2" height="20" valign="middle"><b class="titel">Präsentationstraining</b>
                      </td>
                    </tr>
                    <tr>
                      <td width="3" valign="top">&nbsp;</td>
                      <td valign="top"> 
<?php
$seminare = mysql_query("SELECT * FROM seminare WHERE id = 2 ",$db);
WHILE ($seminare_ok = mysql_fetch_array($seminare))
{
    echo $seminare_ok["datum"];
}
?>
                        <br></td>
                    </tr>
                    <tr valign="top">
                      <td colspan="2" height="20" valign="middle"><b class="titel">Rhetorik Spezial</b>
                      </td>
                    </tr>
                    <tr>
                      <td width="3" valign="top">&nbsp;</td>
                      <td valign="top">
                        <br></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                      <td><b class="titel">Kontakt</b></td>
                    </tr>
                    <tr>
                      <td><a name="form"></a>
<?php 
$fail=false;
IF (isset($_POST[todo])) {
	if(strlen($_POST[name]) > 3){}else{$fail=true;$err[] = "Bitte geben Sie Ihren Namen an.";}
	if(strlen($_POST[kommentar]) > 5){}else{$fail=true;$err[] = "Bitte geben Sie einen Kommentar/Text an.";}
	if(ereg("@",$_POST[email])){}else{$fail=true;$err[] = "Bitte geben Sie Ihre Emailadresse an.";}
}
IF (!isset($_POST[todo]) || $fail)
{
?>
                       <form name="kontakt" method="post" action="<?php  echo $_SERVER[PHP_SELF];?>#form">
                          <table width="100%" border="0" cellspacing="0" cellpadding="2">
                            <?php if($fail && isset($_POST[todo])){?>
							<tr>
                              <td colspan="2"><?php for($i=0;$i<count($err);$i++){echo $err[$i]."<br>";}?></td>
                            </tr>
							<?php }?>
                            <tr>
                              <td width="30%"><b>* Name:</b></td>
                              <td>
                                <input type="text" name="name" size="40" value="<?php  echo $_POST[name];?>">
                              </td>
                            </tr>
                            <tr>
                              <td width="30%"><b>Firma:</b></td>
                              <td>
                                <input type="text" name="firma" size="40" value="<?php  echo $_POST[firma];?>">
                              </td>
                            </tr>
                            <tr>
                              <td width="30%"><b>Telefon:</b></td>
                              <td>
                                <input type="text" name="telefon" size="40" value="<?php  echo $_POST[telefon];?>">
                              </td>
                            </tr>
                            <tr>
                              <td width="30%"><b>* Email:</b></td>
                              <td>
                                <input type="text" name="email" size="40" value="<?php  echo $_POST[email];?>">
                              </td>
                            </tr>
                            <tr>
                              <td width="30%"><b>Betrifft:</b></td>
                              <td>
                                <input type="text" name="betreff" size="40" value="<?php  echo $_POST[betreff];?>">
                              </td>
                            </tr>
                            <tr>
                              <td width="30%" valign="top"><b>* Nachricht:</b></td>
                              <td>
                                <textarea name="kommentar" cols="40" rows="6"><?php  echo stripslashes($_POST[kommentar]);?></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td width="30%" valign="top">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="30%" valign="top">&nbsp;</td>
                              <td>
                                <input type="submit" name="Abschicken" value="Absenden">
                                <input type="hidden" name="todo" value="send">
                              </td>
                            </tr>
                          </table>
                        </form>
<?php 
}
ELSE
{
	$empfaenger = "lohe@pluspunkt.de";
	##$empfaenger = "info.at.pluspunkt.de@easht.de";
	$betreff = "$_POST[betreff]";
	$nachricht = "Folgender Besucher ist an einem Seminar interessiert.<br><br><b>Name:</b> $_POST[name]<br><b>Firma:</b> $_POST[firma]<br><b>Telefon:</b> $_POST[telefon]<br><b>Email:</b> $_POST[email]<br><b>Kommentar:</b> $_POST[kommentar]<br><br><hr size=1>Diese Email wurde ï¿½ber die Seminarseite versandt!";
	$header  = "From: $_POST[email] ($_POST[name])\n";
	$header .= "Content-Type: text/html\nContent-Transfer-Encoding: 8bit\n";
	$header .= "X-Mailer: PHP ". phpversion();
	mail($empfaenger,$betreff,$nachricht,$header);
?>
<p><b>Vielen Dank.</b><br>Ihre Anfrage wurde versandt.</p>
<?php 
}
?>
                      </td>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>
            <p>&nbsp;</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="756" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
