<?php 
@$db = mysql_connect("mysql5.fringe-division.info","db199475_1","Kw6M6Abcch");
@mysql_select_db("db199475_1",$db);
if (!$db) die ("<br>Leider funktioniert der Datenbank Zugriff derzeit nicht - bitte versuchen Sie den Zugriff später erneut!");
# Serverpfade
$cfg['pfad1'] = '/var/www/pluspunkt.de/html/pluspunkt.de/_ink/';
$cfg['pfad2'] = '/var/www/pluspunkt.de/html/pluspunkt.de/';
# Datenbankeinstellungen
$cfg['SQL_Database']['Type']		= 'mySQL';		// Art der Datenbank (mySQL)
$cfg['SQL_Database']['Server']		= 'mysql5.fringe-division.info';		// Adresse der Datenbank
$cfg['SQL_Database']['Name']		= 'db199475_1';		// Datenbankname
$cfg['SQL_Database']['User']		= 'db199475_1';	// Datenbankbenutzer
$cfg['SQL_Database']['Passwort']	= 'Kw6M6Abcch';		// Zugriffspasswort
# Tabellen
$tab['mis']['newsletter_abo']		= 'mis_newsletter_abo';
$tab['mis']['newsletter_archiv']		= 'mis_newsletter_archiv';
$tab['mis']['newsletter_kat']		= 'mis_newsletter_kat';

?>
