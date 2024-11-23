<?php 
//
// Begin der Email!!!!
//
  $header = "From: $Absender <$Abs_email>";
  $header  .= "\nReply-To: $Absender <$Abs_email>";
//  $header .= "\nBCC: $bcc";

  $header  .= "\nMIME-Version: 1.0";
  $header  .= "\nContent-Type: multipart/related; \n\ttype=\"multipart/alternative\"; \n\tboundary=\"$boundary1\"";
  $header  .= "\n\nThis is a multi-part message in MIME format  --  Dies ist eine mehrteilige Nachricht im MIME-Format";

  $header  .= "\n\n--$boundary1";
  $header  .= "\nContent-Type: multipart/alternative; \n\tboundary=\"$boundary2\"";

  $header  .= "\n\n--$boundary2";
  $header  .= "\nContent-Type: text/plain; \n\tcharset=\"iso-8859-1\"";	// Die Email als TEXT-Version
  $header  .= "\nContent-Transfer-Encoding: quoted-printable";
//  $text_text = strip_tags($text);						// Möglichen HTML-Code aus Text entfernen
//  $text_text = $this->format_text($text_text);				// Text wird per Funktion formatiert
  $text_text = strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
  $text_text = $this->quote_printable($text_text);				// Text wird nach X Zeichen umgebrochen damit die Email korrekt dargestellt wird
  $header  .= "\n\n".$text_text;

  $header  .= "\n\n--$boundary2";
  $header  .= "\nContent-Type: text/html; \n\tcharset=\"iso-8859-1\"";	// Die Email als HTML-Version
  $header  .= "\nContent-Transfer-Encoding: quoted-printable";
  $header  .= "\n\n".$this->quote_printable($html1);			// HTML Einleitung
  $text = $this->sonderzeichen($text);
  $text = $this->urlumwandlung($text);
  $header  .= "\n".$this->quote_printable(nl2br($text));			// Text z.B. aus einem Formular in umgewandelt in HTML
  $header  .= "\n".$this->quote_printable($html2);				// HTML Ende
  $header  .= "\n--$boundary2--";

  $header  .= "\n\n--$boundary1";
  $header  .= "\nContent-Type: image/gif; name=\"signet.gif\"";
  $header  .= "\nContent-Transfer-Encoding: base64";
  $header  .= "\nContent-Disposition: inline";
  $header  .= "\nContent-ID: <BILD1>";
  $header  .= "\n\n".$briefpapier;
  $header  .= "\n--$boundary1--";

  $datei = fopen("$pfad2"."_temp/_header.txt", "w");
  fwrite($datei, $header);
  fclose($datei);

  $datei = fopen("$pfad2"."_temp/_betreff.txt", "w");
  fwrite($datei, $betreff);
  fclose($datei);

  $datei = fopen("$pfad2"."_temp/_text.txt", "w");
  fwrite($datei, $text);
  fclose($datei);
?>
