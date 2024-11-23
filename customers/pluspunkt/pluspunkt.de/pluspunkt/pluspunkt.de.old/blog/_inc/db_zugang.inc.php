<?php 
@$db = mysql_connect("localhost","db63755_3","20dimento04");
@mysql_select_db("db63755_3",$db);
if (!$db) die ("<br>Leider funktioniert der Datenbank Zugriff derzeit nicht - bitte versuchen Sie den Zugriff später erneut!");
# Serverpfade
$cfg['pfad1'] = '/var/www/pluspunkt.de/html/pluspunkt.de/_ink/';
$cfg['pfad2'] = '/var/www/pluspunkt.de/html/pluspunkt.de/';
# Datenbankeinstellungen
$cfg['SQL_Database']['Type']		= 'mySQL';		// Art der Datenbank (mySQL)
$cfg['SQL_Database']['Server']		= 'localhost';		// Adresse der Datenbank
$cfg['SQL_Database']['Name']		= 'db63755_3';		// Datenbankname
$cfg['SQL_Database']['User']		= 'db63755_3';	// Datenbankbenutzer
$cfg['SQL_Database']['Passwort']	= '20dimento04';		// Zugriffspasswort
$sql['prefix'] = 'pp_';
# Tabellen
$tab['mis']['newsletter_abo']		= 'mis_newsletter_abo';
$tab['mis']['newsletter_archiv']		= 'mis_newsletter_archiv';
$tab['mis']['newsletter_kat']		= 'mis_newsletter_kat';
define('__table_blog__', $sql['prefix'] . 'blog');
define('__table_comment__', $sql['prefix'] . 'blog_comment');
define('__table_category__', $sql['prefix'] . 'blog_category');
define('__table_image__', $sql['prefix'] . 'blog_image');
define('__table_user__', $sql['prefix'] . 'blog_user');
define('__table_setting__', $sql['prefix'] . 'blog_setting');

function word_substr($text, $zeichen, $kolanz=3, $punkte=0) {
    if(strlen($text) < $zeichen+$kolanz)
        return $text;
    $wort = explode(" ",$text);
    $newstr = "";
    $i = 0;
    while(strlen($newstr)<=$zeichen &&
          strlen($newstr.$wort[$i])<=($zeichen+$kolanz)) {
        $newstr .= $wort[$i]." ";
        $i++;
    }
    $newstr .= str_repeat(".",$punkte);
    $newstr .= "...";
    return $newstr;
}

function ping_weblog($url, $url_to_content, $title) {
	#http://rpc.weblogs.com/pingSiteForm?name=dasblogt&url=http%3A%2F%2Fwww.kris0.org&changesUrl=http%3A%2F%2Fwww.kris0.org
	$fp = fsockopen("rpc.weblogs.com", 80, &$errno, &$errstr);
	if($fp) {
	  fputs($fp,"HEAD /pingSiteForm?name=".rawurlencode($title)."&url=".rawurlencode($url)."&changesUrl=".rawurlencode($url_to_content)." HTTP/1.0\nHost: rawurlencode($url)\n\n");
	  fclose($fp);
	}
}
?>
