
<?php
$target="pass-order.php";

$error="";

if ( isset($_GET[gesendet])) {
  if ($_GET[vorname]=="") { $error .=" Vorname,";}
  if ($_GET[name]=="") { $error .=" Name,";}
  if ($_GET[email]=="") { $error .=" eMail-Adresse,";}
  // if ($_GET[plz]=="") { $error .=" PLZ,";}
  // if ($_GET[ort]=="") { $error .=" Ort,";}
  // if ($_GET[strasse]=="") { $error .=" Straße,";}
  // if ($_GET[telefon]=="") { $error .=" Telefonnummer,";}
  //if ($_GET[comment]=="") { $error .=" Ihre Nachricht,";}

  // if (! isset($kontakt_1)) {$kontakt_1=0;}
  // if (! isset($kontakt_2)) {$kontakt_2=0;}
  // if ($_GET[kontakt_1]==0 && $_GET[kontakt_2]==0 ) { $error .= " Die gewünschte Art der Kontaktaufnahme,"; }

  
  if ($error=="") {

    $Nachricht = "Passwort Präsentationtraining angefordert von:\n";
    $Nachricht .= "  $geschlecht $_GET[vorname] $_GET[name]\n";
    $Nachricht .= "  E-Mail:     $_GET[email]\n";

    $Domain=eregi_replace(".*\.([a-z0-9\-]*)\.([a-z]*)$","\\1.\\2",getenv("SERVER_NAME"));
    $Empfaenger = "mail@pluspunkt.de";

    $subject = "Passwort Tutorial";

    $Header = "From: Tutorial Pluspunkt.net <info@pluspunkt.de>\n";

    mail($Empfaenger,$subject,$Nachricht,$Header);
?>
    
<table cellspacing=0 cellpadding=0 border=0 width="313">
  <tr>
        
    <td>
      <p>Wir bedanken uns für Ihr Interesse an unserem Pr&auml;sentationstraining 
        Tutorial. </p>
      <p>Kennwort:<b> entwicklung</b></p>
      <p><a href="pass.php" target="_self">Zur&uuml;ck</a></p>
      </td>
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
        <input type="text" name="vorname" value="<?php if (isset($_GET[vorname])) {echo $_GET[vorname];}?>" size="17" >
      </td>
      <td width="63%"> 
        <input type="text" name="name" value="<?php if (isset($_GET[name])) {echo $_GET[name];}?>" size="17" >
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
          <input type="text" name="email" value="<?php if (isset($_GET[email])) {echo $_GET[email];}?>" size="17" >
        </div>
      </td>
    </tr>
    <tr> 
      <td width="3%" height="57">&nbsp;</td>
      <td colspan="2" align="center" height="57"> 
        <div align="left"><br>
          <input type="submit" value="Abschicken">
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
