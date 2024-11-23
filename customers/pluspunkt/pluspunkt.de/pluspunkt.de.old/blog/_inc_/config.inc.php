<?php
	
	// Klassen einbinden
	require_once('_inc/_class/mysql.class.php');
	require_once('_inc/_class/upload.class.php');
	require_once('_inc/_class/template.class.php');
	require_once('_inc/_class/setting.class.php');
	
	// Sonstiges einbinden
	include('_inc/mysql.inc.php');
	include('_inc/define.inc.php');
	
	// Klassen initialisieren
	$tpl = new Template('_tpl');
	$mysql = new mySQL($sql['host'], $sql['user'], $sql['pass'], $sql['db']);
	$setting = new setting($mysql, __table_setting__);
	
	// Einstellungen laden
	$SETTINGS = $setting->get_settings();
	
?>