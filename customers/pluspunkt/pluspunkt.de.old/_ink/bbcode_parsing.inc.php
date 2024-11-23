<?php 
require_once($cfg['pfad1']."c_bbcode.class.php");
require_once($cfg['pfad1']."c_bbcode_urlcheck.php");

		$bbcode = new BBCode ();
		
		// Funktion zum Überprüfen der URL Syntax
		function do_bbcode_url ($tag_name, $attrs, $elem_contents, $func_param, $openclose) {
			// Tag hatte nicht das default-Attribut
			if ($openclose == 'all') {
				// invalid url
				if (check_url ($elem_contents, array ('http', 'ftp', 'mailto')) === false) {
					return false;
				}
				return '<a href="'.htmlspecialchars($elem_contents).'">'.htmlspecialchars($elem_contents).'</a>';
			// Tag hatte das default-Attribut und das hier ist der öffnende Tag
			} else if ($openclose == 'open') {
				// invalid url
				if (check_url ($attrs['default'], array ('http', 'ftp', 'mailto')) === false) {
					return false;
				}
				return '<a href="'.htmlspecialchars($attrs['default']).'">';
			// Tag hatte das default-Attribut und das hier ist der schließende Tag
			} else if ($openclose == 'close') {
				return '</a>';
			// Irgendwas seltsames geht vor sich
			} else {
				// Fehler
				return false;
			}
		}

		// Nur für nicht-Listen
		$bbcode->addParser ('htmlspecialchars', array ('block', 'inline', 'link', 'listitem'));

		// [b], [i], [u]
		$bbcode->addCode ('b', 'simple_replace', null, array ('<b>', '</b>'),
						  'inline', array ('listitem', 'block', 'inline', 'link'), array ());
		$bbcode->addCode ('i', 'simple_replace', null, array ('<i>', '</i>'),
						  'inline', array ('listitem', 'block', 'inline', 'link'), array ());
		$bbcode->addCode ('u', 'simple_replace', null, array ('<u>', '</u>'),
						  'inline', array ('listitem', 'block', 'inline', 'link'), array ());
		
		// [url]http://...[/url], [url=http://...]Text[/url]
		$bbcode->addCode ('url', 'usecontent?', 'do_bbcode_url', array ('default'),
						  'link', array ('listitem', 'block', 'inline'), array ('link'));
?>
