<?php

$array_search = array(
    'ä',
    'ü',
    'ö',
    'ß',
    'Ä',
    'Ü',
    'Ö',
    '\'',
    '\''
);
$array_replace = array(
    '&auml;',
    '&uuml;',
    '&ouml;',
    '&szlig;',
    '&Auml;',
    '&Uuml;',
    '&Ouml;',
    '&quot;',
    '\''
);
$array_language = array(
    'de' => 'Deutsch',
    'en' => 'Englisch',
    'es' => 'Spanisch',
    'fr' => 'Franz&ouml;sisch',
    'ru' => 'Russisch',
    'nl' => 'Niederl&auml;ndisch',
    'pl' => 'Polnisch',
    'tr' => 'T&uuml;rkisch',
    'fi' => 'Finnisch',
    'dk' => 'D&auml;nisch',
    'pt' => 'Portugisisch',
    'ch' => 'Chinesisch',
    'jp' => 'Japanisch',
    'gr' => 'Griechisch'
);
        
$array_wochentage = array(
    '1'=>'Sonntag',
    '2'=>'Montag',
    '3'=>'Dienstag',
    '4'=>'Mittwoch',
    '5'=>'Donnerstag',
    '6'=>'Freitag',
    '7'=>'Samstag'
);
        
$array_letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0');

$array_month = array(
    '1' => 'Januar',
    '2' => 'Februar',
    '3' => 'M&auml;rz',
    '4' => 'April',
    '5' => 'Mai',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'August',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Dezember'
);
$array_url_search = array(
    "'\s&\s'",          // remove ampersant
    "'[\r\n\s]+'",      // strip out white space
    "'&(quot|#34);'i",      // replace html entities
    "'&(auml|#228);'i",
    "'&(Auml|#196);'i",
    "'&(uuml|#252);'i",
    "'&(Uuml|#220);'i",
    "'&(ouml|#246);'i",
    "'&(Ouml|#214);'i",
    "'&(amp|#38);'i",
    "'&(lt|#60);'i",
    "'&(gt|#62);'i",
    "'&(nbsp|#160);'i",
    "'&(iexcl|#161);'i",
    "'&(cent|#162);'i",
    "'&(pound|#163);'i",
    "'&(copy|#169);'i",
    "'&'",              // ampersant in + konvertieren
    "'%'",              //-- % entfernen
    "/[\[\({]/",        //--�ffnende Klammern nach Bindestriche entfernen
    "/[\)\]\}]/",       //--schliessende Klammern entfernen
    "/ß/",              //--Umlaute entfernen
    "/ä/",
    "/ü/",
    "/ö/",
    "/Ä/",
    "/Ü/",
    "/Ö/",
    "/'|\"|´|`/",       //--Anführungszeichen entfernen
    "/[:,\.!?\*\+]/",   //--Doppelpunkte, Komma, Punkt, asterisk entfernen
);
$array_url_replace = array(
    "-",
    "-",
    "\"",
    "ae",
    "Ae",
    "ue",
    "Ue",
    "oe",
    "Oe",
    "-",
    "<",
    ">",
    "",
    chr(161),
    chr(162),
    chr(163),    // pfund symbol
    chr(169),    // copyright symbol
    "-",
    "+",
    "-",
    "",
    "ss",
    "ae",
    "ue",
    "oe",
    "Ae",
    "Ue",
    "Oe",
    "",
    ""
);

?>
