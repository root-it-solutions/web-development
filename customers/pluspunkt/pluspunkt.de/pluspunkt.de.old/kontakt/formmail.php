<?php

#ini_set('include_path', ini_get('include_path') . ':' . dirname(__FILE__) . '/../library');
#echo ini_get('include_path');

require_once 'Zend/View.php';
require_once 'Zend/Captcha/Figlet.php';
$view = new Zend_View();

// Originating request:
$captcha = new Zend_Captcha_Figlet(array(
    'name' => 'foo',
    'wordLen' => 6,
    'timeout' => 300,
));
$id = $captcha->generate();

// On subsequent request:
// Assume captcha setup as before, and $value is the submitted value:
/*if ($captcha->isValid($_POST['foo'], $_POST)) {
    // Validated!
}*/


$target="formular.php";

$error="";

if (isset($_GET[gesendet])) {
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
#var_dump($session->rechen_captcha_spam);

/*if(isset($session->rechen_captcha_spam) AND $sicherheits_eingabe == $session->rechen_captcha_spam){
	unset($session->rechen_captcha_spam);
} else {
   	$error = ' Rechenaufgabe,';
}*/
//
//
//Hier kommt das ursprüngliche Script hin.
//
//


  if ($_GET[name]=="") { $error .=" Name,";}
  if ($_GET[email]=="") { $error .=" eMail-Adresse,";}
  if ($_GET[plz]=="") { $error .=" PLZ,";}
  if ($_GET[ort]=="") { $error .=" Ort,";}
  if ($_GET[strasse]=="") { $error .=" Straße,";}
  // if ($_GET[telefon]=="") { $error .=" Telefonnummer,";}
  if ($_GET[comment]=="") { $error .=" Ihre Nachricht,";}

  // if (! isset($_GET[kontakt_1])) {$kontakt_1=0;}
  // if (! isset($_GET[kontakt_2])) {$kontakt_2=0;}
  // if ($_GET[kontakt_1]==0 && $_GET[kontakt_2]==0 ) { $error .= " Die gewünschte Art der Kontaktaufnahme,"; }


  if ($error=="") {

    $kontakt_per="  Informieren Sie mich :\n";
    if ($kontakt_1==1) { $kontakt_per .="      per email\n"; }
    if ($kontakt_2==1) { $kontakt_per .="      telefonisch\n"; }
    $kontakt_per .="\n";

    $Nachricht = "Kontakt von:\n";
    $Nachricht .= "  Kanzlei:   $_GET[kanzlei]\n";
    $Nachricht .= "  Name:      $_GET[name]\n";
    $Nachricht .= "  PLZ / Ort: $_GET[plz] $_GET[ort]\n";

    $Nachricht .= "  Strasse:   $_GET[strasse]\n";
    $Nachricht .= "  eMail:     $_GET[email]\n";
    $Nachricht .= "  Telefon:   $_GET[telefon]\n\n";
    $Nachricht .= $kontakt_per;
    $Nachricht .= "Inhalt der Nachricht:\n\n";
    $Nachricht .= "$_GET[comment]\n";

    $Domain=eregi_replace(".*\.([a-z0-9\-]*)\.([a-z]*)$","\\1.\\2",getenv("SERVER_NAME"));
    $Empfaenger = "lohe@pluspunkt.de";

    $subject = "Pluspunkt Kontaktformular";
    
    $subject = strlen($_GET['subject']) ? $_GET['subject'] : $subject;

    $Header = "From: Kontaktformular Pluspunkt.de <lohe@pluspunkt.de>\n";

    mail($Empfaenger,$subject,$Nachricht,$Header);
    
?>

<table cellspacing=0 cellpadding=0 border=0 width="100%">
  <tr>

    <td>Wir bedanken uns für Ihr Interesse, Ihre Nachricht wird von uns in Kürze
      bearbeitet.</td>
      </tr>
    </table>

<?php
  // ENDE: if ($error=="")
  }
// ENDE: if gesendet
}
?>



<?php
// Formular nur ausgeben wenn noch nicht gesendet worden ist
// oder wenn ein Eingabefehler vorlag
// ==========================================================
if ($error !="" || (! isset($_GET[gesendet])) ) {
  ?>

  <form  action="<?php echo $target; ?>" method=get>
  <input type="hidden" name="gesendet" value="1">

  <table border=0 cellpadding=3 cellspacing=2 width="100%">
    <?php
  // Eingabe-Fehler behandeln
  // -------------------------
  if ($error !="") {
    // Komma am Ende entfernen
    // ========================
    $error=ereg_replace(",$" , "<br>" , $error);
    $error = "Folgende Felder wurde nicht ausgefüllt: <br>\n".$error;
    ?>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><font color="Red"><?php echo $error; ?></font></td>
    </tr>
    <?php
  }
  ?>
    <tr>
      <td>Firma:</td>
      <td>&nbsp;</td>
      <td>
        <div align="right">
          <input type="text" name="kanzlei" value="<?php if (isset($_GET[kanzlei])) {echo $_GET[kanzlei];}?>" size="26" >
        </div>
      </td>
    </tr>
    <tr>
      <td>Ihr Name :</td>
      <td>&nbsp;</td>
      <td>
        <div align="right">
          <input type="text" name="name" value="<?php if (isset($_GET[name])) {echo $_GET[name];}?>" size="26" >
        </div>
      </td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td>&nbsp;</td>
      <td>
        <div align="right">
          <input type="text" name="email" value="<?php if (isset($_GET[email])) {echo $_GET[email];}?>" size="26" >
        </div>
      </td>
    </tr>
    <tr>
      <td>PLZ&nbsp;/&nbsp;Ort:</td>
      <td>
        <input type="text" name="plz" size="5" maxlength="5" value="<?php if (isset($_GET[plz])) {echo $_GET[plz];}?>">
      </td>
      <td>
        <div align="right">
          <input type="text" name="ort" value="<?php if (isset($_GET[ort])) {echo $_GET[ort];}?>" size="26">
        </div>
      </td>
    </tr>
    <tr>
      <td>Stra&szlig;e:</td>
      <td>&nbsp;</td>
      <td>
        <div align="right">
          <input type="text" name="strasse" value="<?php if (isset($_GET[strasse])) {echo $_GET[strasse];}?>" size="26" >
        </div>
      </td>
    </tr>
    <tr>
      <td>Telefon:</td>
      <td>&nbsp;</td>
      <td>
        <div align="right">
          <input type="text" name="telefon" value="<?php if (isset($_GET[telefon])) {echo $_GET[telefon];}?>" size="26" >
        </div>
      </td>
    </tr>
    <tr>
      <td>Kontaktaufnahme:</td>
      <td>&nbsp;</td>
      <td>
        <table cellpadding=0 border=0 width="100%" cellspacing="1">

          <td>
            <input type=checkbox  style="background-color:#76797B;" name="kontakt_1" value="1" <?php if (isset($_GET[kontakt_1])) {if ($_GET[kontakt_1]==1) {echo "CHECKED";}}?>>
          </td>
          <td> Per Email</td>
          <td>
            <input type=checkbox  style="background-color:#76797B;" name="kontakt_2" value="1" <?php if (isset($_GET[kontakt_2])) {if ($_GET[kontakt_2]==1) {echo "CHECKED";}}?>>
          </td>
          <td> Rufen Sie mich an</td>
        </table>
      </td>
    </tr>
    <tr>
      <td>Ihre Nachricht:</td>
      <td colspan="2">
        <div align="right">
          <textarea cols=40 rows=6  name="comment"><?php if (isset($_GET[comment])) {echo $_GET[comment];}?></textarea>
        </div>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="center">
        <div align="right"><br>
        <?php
        
#echo $captcha->render($view);
	#echo '<img src="rechen-captcha.php"><input style="margin-left:5px;" type="text" name="sicherheitscode" size="5"><br><br>';
	?>
	
          <input type="submit" value="Abschicken">
          &nbsp;
          <input type="reset" value="Zurücksetzen">
        </div>
      </td>
    </tr>
  </table>
  </form>
  <?php
}
?>