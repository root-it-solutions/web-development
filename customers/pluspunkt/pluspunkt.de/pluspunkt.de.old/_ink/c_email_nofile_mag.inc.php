<?php 
//
// Begin der Email!!!!
//
  $header = "From: $Absender <$Abs_email>";
  $header  .= "\nReply-To: $Absender <$Abs_email>";
//  $header .= "\nBCC: $bcc";

  $header .= "\r\nContent-Type: text/html;\r\n\tcharset=\"iso-8859-1\"";
  $header .= "\r\nContent-Transfer-Encoding: quoted-printable";
  $header  .= "\r\n".$this->quote_printable($text);				// Text z.B. aus einem Formular in umgewandelt in HTML

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
