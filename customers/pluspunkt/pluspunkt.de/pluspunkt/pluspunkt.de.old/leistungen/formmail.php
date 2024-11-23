<?php 
$target="newsletter-anmeldung.php";

$error="";

if ( isset($_POST['submit'])) {
  if ($_POST['vorname'] == "") { $error .=" Vorname,";}
  if ($_POST['name'] == "") { $error .=" Name,";}
  if ($_POST['email'] == "") { $error .=" eMail-Adresse,";}
  // if ($plz=="") { $error .=" PLZ,";}
  // if ($ort=="") { $error .=" Ort,";}
  // if ($strasse=="") { $error .=" Straï¿½e,";}
  // if ($telefon=="") { $error .=" Telefonnummer,";}
  //if ($comment=="") { $error .=" Ihre Nachricht,";}

  // if (! isset($kontakt_1)) {$kontakt_1=0;}
  // if (! isset($kontakt_2)) {$kontakt_2=0;}
  // if ($kontakt_1==0 && $kontakt_2==0 ) { $error .= " Die gewünschte Art der Kontaktaufnahme,"; }

  if ($error == "") {

    $Nachricht = "Newsanmeldung von:\n";
    $Nachricht .= $_POST['geschlecht']." ".$_POST['vorname']." ".$_POST['name']."\n";
    $Nachricht .= "E-Mail:  ".$_POST['email']."\n";

    $Domain = eregi_replace(".*\.([a-z0-9\-]*)\.([a-z]*)$","\\1.\\2",getenv("SERVER_NAME"));
    $Empfaenger = "mail@pluspunkt.de";

    $subject = "Newsletter Anmeldung";

    $Header = "From: Newsletter Pluspunkt.de <info@pluspunkt.de>\n";

    mail($Empfaenger,$subject,$Nachricht,$Header);
    mail('d.roesmann@dimento.com',$subject,$Nachricht,$Header);
    
?>
    
<table cellspacing=0 cellpadding=0 border=0 width="313">
  <tr>
        
    <td><strong>Wir bedanken uns für Ihre Newsletter Anmeldung.</strong></td>
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
if ($error !="" || (! isset($gesendet)) ) {
  ?>

  <form  action="<?php echo $target; ?>" method=post>
  <input type="hidden" name="gesendet" value="1">
    
  <table border=0 cellpadding=3 cellspacing=2 width="269">
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
      <td width="3%">&nbsp;</td>
      <td colspan="2"><font color="Red"> 
        <?php echo $error; ?>
        </font></td>
    </tr>

    <?php
  }
  ?>
    
    <tr> 
      <td width="3%">&nbsp;</td>
      <td colspan="2"> 
        <table cellpadding=0 border=0 width="238" cellspacing="1">
          <td width="31"> 
              <input type="radio" name="geschlecht" value="Herr" style="background-color:#76797B">
            </td>
            <td width="69"> Herr</td>
            <td width="32"> 
              <input type="radio" name="geschlecht" value="Frau" style="background-color:#76797B">
            </td>
            <td width="105"> Frau</td>
        </table>
      </td>
    </tr>
    <tr> 
      <td width="3%">&nbsp;</td>
      <td width="34%">Vorname*: </td>
      <td width="63%">Nachname*: </td>
    </tr>
<tr> 
      <td width="3%">&nbsp;</td>
      <td width="34%"> 
        <input type="text" name="vorname" value="<?php if (isset($vorname)) {echo $vorname;}?>" size="17" >
      </td>
      <td width="63%"> 
        <input type="text" name="name" value="<?php if (isset($name)) {echo $name;}?>" size="17" >
      </td>
    </tr>
    <tr> 
      <td width="3%" height="24">&nbsp;</td>
      <td width="34%" height="24">E-mail*:</td>
      <td width="63%" height="24">&nbsp; </td>
    </tr>
    <tr>
      <td width="3%" height="8">&nbsp;</td>
      <td colspan="2" align="center" height="8"> 
        <div align="left">
          <input type="text" name="email" value="<?php if (isset($email)) {echo $email;}?>" size="17" >
        </div>
      </td>
    </tr>
    <tr> 
      <td width="3%" height="57">&nbsp;</td>
      <td colspan="2" align="center" height="57"> 
        <div align="left"><br>
          <input type="submit" name="submit" value="Abschicken">
          &nbsp; 
          <input type="reset" value="Zurücksetzen">
          <br>
          <br>
          * Pflichtangaben</div>
      </td>
    </tr>
  </table>
  </form>
  <?php
}
?>
