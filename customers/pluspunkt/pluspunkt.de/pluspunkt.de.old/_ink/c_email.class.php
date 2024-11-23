<?php
class c_email
{
    function Vorbereiten($Absender, $Abs_email, $text, $betreff, $dateiname, $dateititel)
    {
	global $cfg;
	$pfad1 = $cfg['pfad1'];
	$pfad2 = $cfg['pfad2'];

	$boundary1 = "BOUNDARY1";
	$boundary2 = "BOUNDARY2";
	$boundary3 = "BOUNDARY3";

	$this->status("Newsletterversand am ".date("d.m.Y")." um ".date("H:i:s")." Uhr\n");


	IF ($Absender == "") { exit; }
	IF ($text == "") { exit; } ELSE { $text = stripslashes($text); }
	IF ($betreff == "") { exit; } ELSE { $betreff = stripslashes($betreff); }
	IF (!isset($_POST[briefpapier]))
	{
		include($pfad1."c_email_briefpapier.class.php");
	}
	ELSE
	{
		include($pfad1."c_email_briefpapier.".$_POST[briefpapier].".class.php");
	}


	IF ($_POST[art] == "magazin" || $_GET[art] == "magazin")
	{
		IF (isset($dateiname) && $dateiname != "") { require($pfad1."c_email_file_mag.inc.php"); } ELSE { require($pfad1."c_email_nofile_mag.inc.php");  }    
	}
	ELSEIF ($_POST[art] == "text" || $_GET[art] == "text")
	{
		IF (isset($dateiname) && $dateiname != "") { require($pfad1."c_email_file_txt.inc.php"); } ELSE { require($pfad1."c_email_nofile_txt.inc.php");  }    
	}
	ELSEIF ($_POST[art] == "html" || $_GET[art] == "html")
	{
		$html1 = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"><html><head><META http-equiv=\"Content-Type\" content=\"text/html\"; charset=\"iso-8859-1\"><STYLE type=\"text/css\"><!-- BODY { FONT-FAMILY: Arial } td { FONT-SIZE: 10pt; COLOR: $schrift_farbe; FONT-FAMILY: Arial } //--></STYLE></head><body bgcolor=\"$hg_farbe\"><table width=\"610\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";
		$html2 = "</td></tr></table></body></html>";

		IF (isset($dateiname) && $dateiname != "") { require($pfad1."c_email_file_html.inc.php"); } ELSE { require($pfad1."c_email_nofile_html.inc.php");  }    
	}
	ELSE
	{
		$html1 = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"><html><head><META http-equiv=\"Content-Type\" content=\"text/html\"; charset=\"iso-8859-1\"><STYLE type=\"text/css\"><!-- BODY { BACKGROUND-POSITION: left top; MARGIN-TOP: $schrift_top; MARGIN-LEFT: $schrift_left; BACKGROUND-REPEAT: no-repeat; FONT-FAMILY: Arial } td { FONT-SIZE: 10pt; COLOR: $schrift_farbe; FONT-FAMILY: Arial } //--></STYLE></head><body bgcolor=\"$hg_farbe\" background=\"cid:BILD1\"><table width=\"610\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";
		$html2 = "</td></tr></table></body></html>";

		IF (isset($dateiname) && $dateiname != "") { require($pfad1."c_email_file.inc.php"); } ELSE { require($pfad1."c_email_nofile.inc.php");  }    
	}
    }


    function Senden($Abs_email, $Empf_email)
    {
	global $cfg;
	$pfad1 = $cfg['pfad1'];
	$pfad2 = $cfg['pfad2'];

	$Header = $this->datenauslesen($pfad2."_temp/_header.txt");
	$Betreff  = $this->datenauslesen($pfad2."_temp/_betreff.txt");
	$Text = $this->datenauslesen($pfad2."_temp/_text.txt");

	IF($this->check_email($Empf_email))
	{
		$this->status("\tNewsletter verschickt an: $Empf_email\n");
		mail("$Empf_email", "$Betreff", "", "$Header");
//		mail("$Empf_email", "$Betreff", "", "$Header", "-fenwhp@bkk-bv.de");
	}
	ELSE
	{
		$this->status("\tNewsletter _NICHT_ verschickt an: $Empf_email\n");
	}
    }


    function Senden_newsmag($Abs_email, $Empf_email)
    {
	global $cfg;
	$pfad1 = $cfg['pfad1'];
	$pfad2 = $cfg['pfad2'];

	$Header = $this->datenauslesen($pfad2."_temp/_header.txt");
	$Betreff  = $this->datenauslesen($pfad2."_temp/_betreff.txt");
	$Text = $this->datenauslesen($pfad2."_temp/_text.txt");

	IF($this->check_email($Empf_email))
	{
//		$Header = str_replace("%%ANREDE%%","$anrede", $Header);
//		$Header = str_replace("%%NAME%%","$name", $Header);
//		$Header = str_replace("%%email%%","$email", $Header);

		mail("$Empf_email", "$Betreff", "", "$Header");
//		mail("$Empf_email", "$Betreff", "", "$Header", "-fenwhp@bkk-bv.de");
		$this->status("\tNewsletter verschickt an: $Empf_email\n");
	}
	ELSE
	{
		$this->status("\tNewsletter _NICHT_ verschickt an: $Empf_email\n");
	}
   }



    function PresseSenden($Abs_email, $Empf_email, $anrede, $name, $email)
    {
	global $cfg;
	$pfad1 = $cfg['pfad1'];
	$pfad2 = $cfg['pfad2'];

	$Header = $this->datenauslesen($pfad2."_temp/_header.txt");
	$Betreff  = $this->datenauslesen($pfad2."_temp/_betreff.txt");
	$Text = $this->datenauslesen($pfad2."_temp/_text.txt");

	IF($this->check_email($Empf_email))
	{
		$Header = str_replace("%%ANREDE%%","$anrede", $Header);
		$Header = str_replace("%%NAME%%","$name", $Header);
		$Header = str_replace("%%EMAIL%%","$email", $Header);

		mail("$Empf_email", "$Betreff", "", "$Header", "-f$Abs_email");

		$this->status("\tNewsletter verschickt an: $Empf_email\n");
	}
	ELSE
	{
		$this->status("\tNewsletter _NICHT_ verschickt an: $Empf_email\n");
	}
    }


//
// Email Funktionen für die Klasse - brauchen nicht verändert zu werden!!!!
//

function status($str)
{
    global $cfg;
    $pfad1 = $cfg['pfad1'];
    $pfad2 = $cfg['pfad2'];

    $datei = fopen($pfad2."_temp/_log.txt", "a");		
    fwrite($datei, $str);
    fclose($datei);
}

function sonderzeichen($str)
{
	$data = preg_replace("/ü/", "&uuml;", $str);
	$data = preg_replace("/ä/", "&auml;", $str);
	$data = preg_replace("/ö/", "&ouml;", $str);
	$data = preg_replace("/Ü/", "&Uuml;", $str);
	$data = preg_replace("/Ä/", "&Auml;", $str);
	$data = preg_replace("/Ö/", "&Ouml;", $str);
	$data = preg_replace("/ß/", "&szlig;", $str);
	return $data;
}

function urlumwandlung($str)
{
	$pattern = '#(^|[^\"=]{1})(http://|ftp://|mailto:|news:)([^\s<>]+)([\s\n<>]|$)#sm';
	return preg_replace($pattern,"\\1<a href=\"\\2\\3\">\\2\\3</a>\\4",$str);
}

function datenauslesen($datei)
{
	$handle = fopen($datei, "r");
	$data = fread ($handle, filesize("$datei"));
	fclose ($handle);

	return $data;
}

function briefpapier($str)
{
	$handle = fopen("$str", "r");
	$data = fread ($handle, filesize("$str"));
	fclose ($handle);
	return $data;
}

function check_email($email)
{
	$nonascii      = "\x80-\xff"; # Non-ASCII-Chars are not allowed

	$nqtext        = "[^\\\\$nonascii\015\012\"]";
	$qchar         = "\\\\[^$nonascii]";

	$protocol      = '(?:mailto:)';

	$normuser      = '[a-zA-Z0-9][a-zA-Z0-9_.-]*';
	$quotedstring  = "\"(?:$nqtext|$qchar)+\"";
	$user_part     = "(?:$normuser|$quotedstring)";

	$dom_mainpart  = '[a-zA-Z0-9][a-zA-Z0-9._-]*\\.';
	$dom_subpart   = '(?:[a-zA-Z0-9][a-zA-Z0-9._-]*\\.)*';
	$dom_tldpart   = '[a-zA-Z]{2,5}';
	$domain_part   = "$dom_subpart$dom_mainpart$dom_tldpart";

	$regex         = "$protocol?$user_part\@$domain_part";

	return preg_match("/^$regex$/",$email);
}

function split_line($zeile)
  {
  $text_cols = 72;   // Anz Spalten im <TEXTAREA>
  if (!($t = file("rfc822-syntax.txt"))) die ("rfc822-syntax fehlt!");
  for ($i = 0; $i < sizeof($t); $i++)  // >
    $rfc_syntax .= trim($t[$i]);

// global $text_cols;

      while (strlen($zeile) > $text_cols)
        { $i = $j = -1;
          while ($j < $text_cols) // >
            {
              $i = $j;
              $j = strpos($zeile, " ", $i + 1);
              if ($j == 0 && $zeile[$j] != " ") $j = strlen($zeile);
            }
          if ($i == -1)   // Wort zu lang
            { $i = $j;
            }
          $t[] = substr($zeile, 0, $i + 1);  // ZR gehoert dazu
          $zeile = substr($zeile, $i + 1);
        }
      $t[] = $zeile;
      return join("\n", $t);
    }


function format_text($text)
   { $t = explode("\n", ($text=str_replace("\r", "", $text)));
      for ($i = 0; $i < sizeof($t); $i++)   // >
        $t[$i] = $this->split_line($t[$i]);
      return join("\r\n", $t);
    }


  function quote_printable($Message)
  {
    /* Build (most polpular) Extended ASCII Char/Hex MAP (characters >127 & <255) */
    for ($i=0; $i<127; $i++) {
        $CharList[$i] = "/".chr($i+128)."/";
        $HexList[$i] = "=".strtoupper(bin2hex(chr($i+128)));
    }

    /* Encode equal sign & 8-bit characters as equal signs followed by their hexadecimal values */
    $Message = str_replace("=", "=3D", $Message);
    $Message = preg_replace($CharList, $HexList, $Message);

    /* Lines longer than 76 characters (size limit for quoted-printable Content-Transfer-Encoding)
        will be cut after character 75 and an equals sign is appended to these lines. */ 
    $MessageLines = split("\n", $Message);
    $Message_qp = "";
    while(list(, $Line) = each($MessageLines)) {
        if (strlen($Line) > 75) {
            $Pointer = 0;        
            while ($Pointer <= strlen($Line)) {
                $Offset = 0;
                if (preg_match("/^=(3D|([8-9A-F]{1}[0-9A-F]{1}))$/", substr($Line, ($Pointer+73), 3))) $Offset=-2;
                if (preg_match("/^=(3D|([8-9A-F]{1}[0-9A-F]{1}))$/", substr($Line, ($Pointer+74), 3))) $Offset=-1;
                $Message_qp.= substr($Line, $Pointer, (75+$Offset))."=\n";
                if ((strlen($Line) - ($Pointer+75)) <= 75) {                
                    $Message_qp.= substr($Line, ($Pointer+75+$Offset))."\n";
                    break 1;
                }
                $Pointer+= 75+$Offset;
            }
        } else {
            $Message_qp.= $Line."\n";
        }
    }        
    return $Message_qp;
  } 
}
?>