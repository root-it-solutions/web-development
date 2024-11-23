<html>
<head>
<title>Vortragsthemen zum Thema Führung</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../plus-style.css">
<script language="JavaScript">
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
<body bgcolor="#76797B" text="#000000" leftmargin="2" topmargin="0" marginwidth="0" marginheight="0">
<table width="220" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td align="center" valign="top"> 
      <table width="220" border="0" cellspacing="0" cellpadding="0" class="text11">
        <form name="kontakt" method="post" action="pdf_mailer.php#formular">
          <tr align="left"> 
            <td>Vortragsthemen zum Thema &quot;<b>F&uuml;hrung</b>&quot; <br>
              <hr>
              <br>
              Sofern Sie sich auf der rechten Seite f&uuml;r eines, oder mehrere 
              der Themen interessieren, f&uuml;llen Sie dieses Formular aus.<br>
              Wir setzen uns mit Ihnen in Verbindung.<br>
            </td>
          </tr>
          <tr align="left" valign="top"> 
            <td><br>
              Name:<br>
              <input type="text" name="name" size="30" class="text11">
              <br>
              <br>
            </td>
          </tr>
          <tr align="left" valign="top"> 
            <td>Firma:<br>
              <input type="text" name="firma" size="30" class="text11">
              <br>
              <br>
            </td>
          </tr>
          <tr align="left" valign="top"> 
            <td>Telefon:<br>
              <input type="text" name="telefon" size="30" class="text11">
              <br>
              <br>
            </td>
          </tr>
          <tr align="left" valign="top"> 
            <td>Email: <br>
              <input type="text" name="email" size="30" class="text11">
              <br>
              <br>
            </td>
          </tr>
          <tr align="left" valign="top"> 
            <td>Thema:<br>
              <select name="thema" size="1" class="text11">
                <option value="Exzellente Kundenbeziehungen - Grundlage f&uuml;r den besonderen Erfolg">Exzellente 
                Kundenbeziehungen ...</option>
                <option value="Führungskräfte haben keinen Stress (zu haben)">Führungskräfte 
                haben ...</option>
                <option value="Motivierende Zielvereinbarungen">Motivierende Zielvereinbarungen</option>
                <option value="Think big - ängstliche Führungskräfte machen sich überflüssig">Think 
                big - ängstliche ...</option>
                <option value="Unternehmen nach ihren Werten">Unternehmen nach 
                ihren Werten</option>
                <option value="Chancen der Krise">Chancen der Krise</option>
                <option value="Spielregeln fürs miteinander - ohne Sie läufts nicht richtig">Spielregeln 
                fürs miteinander ...</option>
                <option value="managen?">managen?</option>
                <option value="Fallstricke der Visionsentwicklung vermeiden">Fallstricke 
                der Visions ...</option>
                <option value="Personalmarketing">Personalmarketing</option>
                <option value="Halbieren Sie Ihre Arbeitszeit - verdoppeln Sie Ihr Ergebnis">Halbieren 
                Sie Ihre ...</option>
                <option value="Visionen - Fluch oder Chance">Visionen - Fluch 
                oder Chance</option>
                <option value="Mitarbeiter">Mitarbeiter</option>
                <option value="Die Führungskraft als Personalentwickler">Die Führungskraft 
                als ...</option>
                <option value="Voraussetzungen, damit Ihre Mitarbeiter unternehmerisch denken">Voraussetzungen, 
                damit Ihre ...</option>
                <option value="Die richtige Person am richtigen Platz">Die richtige 
                Person am ...</option>
                <option value="Durch Personalentwicklung Verluste vermeiden">Durch 
                Personalentwicklung ...</option>
              </select>
              <br>
              <br>
            </td>
          </tr>
          <tr align="left" valign="top"> 
            <td>Kommentar: <br>
              <textarea name="kommentar" cols="30" rows="5" class="text11"></textarea>
              <input type="hidden" name="todo" value="kontakt">
              <br>
              <br>
            </td>
          </tr>
          <tr align="left" valign="top"> 
            <td> 
              <input type="submit" name="Abschicken" value="Abschicken" onClick="return alle_felder_pruefen()" class="text11">
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
<?php 
IF ($_POST[todo] == "kontakt")
	{
		$empfaenger = "m.rumi@pluspunkt.de";
		$betreff = "Interesse an einem Vortrag über ".$_POST[thema];
		$nachricht = "Folgender Besucher ist an einem Vortragsthema zum Thema Führung ($_POST[thema]) interessiert.<br><br><b>Name:</b> $_POST[name]<br><b>Firma:</b> $_POST[firma]<br><b>Telefon:</b> $_POST[telefon]<br><b>Email:</b> $_POST[email]<br><b>Thema:</b> $_POST[thema]<br><br><b>Kommentar:</b> $_POST[kommentar]<br><br><hr size=1>Diese Email wurde über die Seite: 'Vortragsthemen zum Thema Führung' versandt!";
		$header  = "From: $_POST[email] ($name)\n";
		$header .= "Content-Type: text/html\nContent-Transfer-Encoding: 8bit\n";
		$header .= "X-Mailer: PHP ". phpversion();

		$sended = mail($empfaenger,$betreff,$nachricht,$header);
		if (isset($sended) && isset($_POST[todo]))
			{
				echo "<a name=\"formular\" class=\"text11\">Die Email wurde erfolgreich verschickt !</a>";
			}
	}
?></body>
 </html>
