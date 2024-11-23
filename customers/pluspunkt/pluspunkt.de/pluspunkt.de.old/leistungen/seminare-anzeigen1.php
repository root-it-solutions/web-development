<?php 
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Selfcoaching";
$titel = "selfcoaching";
$hauptmenue=2;
$submenue=2;

IF ($_REQUEST["todo"] == "kontakt")
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
$sicherheits_eingabe = encrypt($_GET["sicherheitscode"], "jkl134891hj");
$sicherheits_eingabe = str_replace("=", "", $sicherheits_eingabe);
if(isset($_SESSION['rechen_captcha_spam']) AND $sicherheits_eingabe == $_SESSION['rechen_captcha_spam']){
unset($_SESSION['rechen_captcha_spam']);

  $empfaenger = "lohe@pluspunkt.de";
  $betreff = "$betreff";
  $nachricht = "Folgender Besucher ist an einem Seminare interessiert.<br><br><b>Name:</b> $name<br><b>Firma:</b> $firma<br><b>Telefon:</b> $telefon<br><b>Email:</b> $email<br><b>Kommentar:</b> $kommentar<br><br><hr size=1>Diese Email wurde über die Seminarseite (- das entsprechende Seminar steht im Betreff -) versandt!";
  $header  = "From: $email <$name>\n";
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
function alle_felder_pruefen()
{
voll=true;
anzahlFelder=5;
for(n=0; n < anzahlFelder; n++)
{
if(window.document.kontakt.elements[n].value== "")
voll=false;
}
if(!voll)alert("Bitte alle Felder ausfüllen!");
return voll;
}
</script>
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<?php 
$seminare = mysql_query("SELECT id,art,name,teilnehmer,vorraussetzungen,ziele,inhalte,dozent,dauer,datum,ort,kosten,externinfo,externpic,externlink FROM seminare WHERE id='".$_REQUESt["sid"]."'",$db);
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
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6">
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr bgcolor="#76797B">
                <td>
                  <p><b><img src="../_images/seminare.gif" width="74" height="15"></b></p>
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="45%">Die meisten Anl&auml;sse f&uuml;r eine Weiterbildung
                        ergeben sich aus beruflichen Rahmenbedingungen, die zugleich
                        mehrere Personen betreffen. Hier bietet sich an, die Weiterbildung
                        mit allen Betroffenen durchzuf&uuml;hren. Der geschlossene
                        Rahmen (Training nur f&uuml;r ein Unternehmen) bietet
                        die M&ouml;glichkeit, die Weiterbildung inhaltlich und
                        organisatorisch an die Ziele des Unternehmens und die
                        Gegebenheiten und W&uuml;nsche der Teilnehmer anzupassen.
                        Unsere Kompetenz finden Sie in folgenden Trainingsbereichen:
                        <span class="text">
                        <ul>
                          <li>F&uuml;hrungstraining</li>
                          <br>
                          <li>Kommunikationstraining</li>
                          <br>
                          <li>Kundenbeziehungstraining</li>
                          <br>
                          <li>Pers&ouml;nlichkeitstraining</li>
                          <br>
                          <li>Pr&auml;sentationstraining</li>
                          <br>
                          <li>Teamtraining</li>
                          <br>
                          <li>Verkaufstraining</li>
                        </ul>
                        </span> <span class="text">Unsere Methodenkompetenz umfasst
                        folgende Bereiche:</span> <span class="text">
                        <ul>
                          <li>Beratungen</li>
                          <br>
                          <li>Coachings</li>
                          <br>
                          <li>Projektmanagement (tempor&auml;r)</li>
                          <br>
                          <li>Seminare</li>
                          <br>
                          <li>Training</li>
                          <br>
                          <li>Workshops</li>
                        </ul>
                        </span> <span class="text">Unsere Vorgehensweise erfolgt
                        in folgenden Schritten:</span> <span class="text">
                        <ol>
                          <li>Bedarfsanalyse mit Gesch&auml;ftsf&uuml;hrern und
                            Vorgesetzten</li>
                          <br>
                          <li>Bedarfsanalyse mit den betroffenen Mitarbeitern</li>
                          <br>
                          <li>Konzeptentwicklung</li>
                          <br>
                          <li>Vorstellung des Konzepts vor Gesch&auml;ftsf&uuml;hrung
                            und Vorgesetzten</li>
                          <br>
                          <li>Vorstellung des Konzepts vor betroffenen Mitarbeitern</li>
                          <br>
                          <li>Durchf&uuml;hrung der Qualifikation</li>
                          <br>
                          <li>Evaluation</li>
                        </ol>
                        </span> <span class="text">Beratung EUR 1.280,- zzgl.
                        MwSt.<br>
                        Training EUR 2.560,- zzgl. MwSt.</span> </td>
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
                          <input type="text" name="betreff" value="Seminar: Ma&szlig;geschneiderte Inhouse-Seminare">
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
                          <input type="hidden" name="sid" value="<?php  echo $_REQUEST["sid"];?>">
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
