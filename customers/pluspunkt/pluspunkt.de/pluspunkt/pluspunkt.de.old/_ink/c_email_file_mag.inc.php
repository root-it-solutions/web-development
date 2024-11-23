<?php 
//
// Begin der Email!!!!
//
  $pfad = $pfad2."_upload/$dateiname";
  $datei_content = fread(fopen($pfad,"r"),filesize($pfad));
  $datei_content = chunk_split(base64_encode($datei_content));

  $header = "From: $Absender <$Abs_email>";
  $header  .= "\nReply-To: $Abs_email";
//  $header .= "\nBCC: $bcc";

   $header .= "\nMIME-Version: 1.0";
   $header .= "\nContent-Type: multipart/mixed; boundary=$boundary1";
   $header .= "\n\nThis is a multi-part message in MIME format  --  Dies ist eine mehrteilige Nachricht im MIME-Format";

   $header .= "\n--$boundary1";
   $header .= "\nContent-Type: text/html; \n\tcharset=\"iso-8859-1\"";
   $header .= "\nContent-Transfer-Encoding: quoted-printable";
   $header .= "\n\n".$this->quote_printable($text);	

   $header .= "\n--$boundary1";
   $header .= "\nContent-Type: application/octet-stream; name=\"$dateititel\"";
   $header .= "\nContent-Transfer-Encoding: base64";
   $header .= "\nContent-Disposition: attachment; filename=\"$dateititel\"";
   $header .= "\n\n$datei_content";
   $header .= "\n--$boundary1--";

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
