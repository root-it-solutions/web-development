<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Selfcoaching";
$titel = "selfcoaching";
$hauptmenue=2;
$submenue=2;

IF (!$_REQUEST["sid"])
{
  header("Location: seminare.php");
}

IF ($_POST['todo'] == "kontakt")
{
	
function encrypt($string, $key) {
$result = '';
for($i=0; $i<strlen($string); $i++) {
   $char = substr($string, $i, 1);
   $keychar = substr($key, ($i % strlen($key))-1, 1);
   $char = chr(ord($char)+ord($keychar));
   $result.=$char;
}
return base64_encode($result);
}
$sicherheits_eingabe = encrypt($_POST["sicherheitscode"], "jkl134891hj");
$sicherheits_eingabe = str_replace("=", "", $sicherheits_eingabe);
if(isset($_SESSION['rechen_captcha_spam']) AND $sicherheits_eingabe == $_SESSION['rechen_captcha_spam']){
unset($_SESSION['rechen_captcha_spam']);

  $empfaenger = "lohe@pluspunkt.de";
  $betreff = "$betreff";
  $nachricht = "Folgender Besucher ist an einem Seminare interessiert.<br><br><b>Name:</b> $name<br><b>Firma:</b> $firma<br><b>Telefon:</b> $telefon<br><b>Email:</b> $email<br><b>Kommentar:</b> $kommentar<br><br><hr size=1>Diese Email wurde �ber die Seminarseite (- das entsprechende Seminar steht im Betreff -) versandt!";
  $header  = "From: $email ($name)\n";
  $header .= "Content-Type: text/html\nContent-Transfer-Encoding: 8bit\n";
  $header .= "X-Mailer: PHP ". phpversion();

  mail($empfaenger,$betreff,$nachricht,$header);
  
  } 
}
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
<script language=JavaScript>
<!--
function alle_felder_pruefen()
{
voll=true;
anzahlFelder=5;
for(n=0; n < anzahlFelder; n++)
{
if(window.document.kontakt.elements[n].value== "")
voll=false;
}
if(!voll)alert("Bitte alle Felder ausf�llen!");
return voll;
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<?php 
$seminare = mysql_query("SELECT id,art,name,teilnehmer,vorraussetzungen,ziele,inhalte,dozent,dauer,datum,ort,kosten,weitereinfos,externinfo,externpic,externlink FROM seminare WHERE id='".$_REQUEST["sid"]."'",$db);
$seminare_ok = mysql_fetch_array($seminare);
?>
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
            <br><?php 
IF ($seminare_ok["externinfo"] != "0")
{
?>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.fuehrungsseminar.net" target="_blank"><img src="<?php  echo $seminare_ok["externpic"];?>" width="80" height="80" border="0"></a></p>
<?php 
}

IF ($seminare_ok["weitereinfos"] != "")
{
?>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="seminare-anzeigen2.php?sid=<?php  echo $_REQUEST["sid"];?>"><img src="../_images/k-weitereinfos.jpg" width="80" height="80" border="0"></a></p>
<?php 
}
?>
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6">
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B">
                <td>
                  <p><b><img src="../_images/seminare.gif" width="74" height="15"></b></p>
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="45%"><b>Art der Veranstaltung:</b></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td>
                              <?php  echo $seminare_ok["art"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Name der Veranstaltung:</b></td>
                    </tr>
                    <tr>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td>
                              <?php  echo $seminare_ok["name"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top"><b>Teilnehmer:</b></td>
                    </tr>
                    <tr>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td>
                              <?php  echo $seminare_ok["teilnehmer"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
<?php
                    if($seminare_ok["vorraussetzungen"] !== '')
                    {
?>
                    <tr>
                      <td valign="top"><b>Voraussetzungen:</b></td>
                    </tr>
                    <tr>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td>
                              <?php  echo nl2br($seminare_ok["vorraussetzungen"]);?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
<?php
                    }
?>
                    <tr>
                      <td valign="top"><b>Ziele:</b></td>
                    </tr>
                    <tr>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td>
                              <?php  echo nl2br($seminare_ok["ziele"]);?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
<?php
                    if($seminare_ok["inhalte"] !== '')
                    {
?>
                    <tr>
                      <td valign="top"><b>Inhalte:</b></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td width="85%">
                              <?php  echo nl2br($seminare_ok["inhalte"]);?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
<?php
                    }
?>
                    <tr>
                      <td><b>Dozent:</b></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td width="85%">
                              <?php  echo $seminare_ok["dozent"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Dauer:</b></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td width="85%">
                              <?php  echo $seminare_ok["dauer"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Datum:</b></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td width="85%">
                              <?php  echo $seminare_ok["datum"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Ort:</b></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td width="85%">
                              <?php  echo $seminare_ok["ort"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Investition:</b></td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="15%">&nbsp;</td>
                            <td width="85%">
                              <?php  echo $seminare_ok["kosten"];?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <p><b><br>
                    <img src="../_images/kontakt.gif" width="63" height="15"></b></p>
                  <form name="form1" method="post" action="">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="35%"><b>Ihr Name:</b></td>
                        <td>
                          <input type="text" name="name">
                        </td>
                      </tr>
                      <tr>
                        <td><b>Firma:</b></td>
                        <td>
                          <input type="text" name="firma">
                        </td>
                      </tr>
                      <tr>
                        <td><b>Telefon:</b></td>
                        <td>
                          <input type="text" name="telefon">
                        </td>
                      </tr>
                      <tr>
                        <td><b>Email:</b></td>
                        <td>
                          <input type="text" name="email">
                        </td>
                      </tr>
                      <tr>
                        <td><b>Betrifft:</b></td>
                        <td>
                          <input type="text" name="betreff" value="Seminar: <?php  echo $seminare_ok["name"];?>">
                        </td>
                      </tr>
                      <tr>
                        <td valign="top"><b>Kommentar:</b></td>
                        <td>
                          <textarea name="kommentar" rows="6" cols="33"></textarea>
                        </td>
                      </tr>
                      <tr>
                        <td valign="top">&nbsp;</td>
                        <td>
<?php 
	echo '<img src="rechen-captcha.php"><input style="margin-left:5px;" type="text" name="sicherheitscode" size="5"><br><br>';
?>
                          <input type="submit" name="kontakt" value="Absenden" onClick="return alle_felder_pruefen()">
                          <input type="hidden" name="todo" value="kontakt">
                          <input type="hidden" name="sid" value="<?php  echo $$_REQUESt["sid"];?>">
                        </td>
                      </tr>
                    </table>
                  </form>
                  <p>&nbsp;</p>
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
