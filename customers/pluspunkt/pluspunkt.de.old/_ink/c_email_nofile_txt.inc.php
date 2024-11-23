<?php 
//
// Begin der Email!!!!
//
  $header = "From: $Absender <$Abs_email>";
  $header  .= "\nReply-To: $Absender <$Abs_email>";
//  $header .= "\nBCC: $bcc";

  $header  .= "\nMIME-Version: 1.0";
  $header  .= "\nContent-Type: text/plain; \n\tcharset=\"iso-8859-1\"";	// Die Email als TEXT-Version
  $header  .= "\nContent-Transfer-Encoding: 8bit";
  $text_text = strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
  $text_text = $this->quote_printable($text_text);				// Text wird nach X Zeichen umgebrochen damit die Email korrekt dargestellt wird
  $header  .= "\n\n".$text_text;

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
