<?php
/**
 * Grundeinstellungen für WordPress
 *
 * Diese Datei wird zur Erstellung der wp-config.php verwendet.
 * Du musst aber dafür nicht das Installationsskript verwenden.
 * Stattdessen kannst du auch diese Datei als „wp-config.php“ mit
 * deinen Zugangsdaten für die Datenbank abspeichern.
 *
 * Diese Datei beinhaltet diese Einstellungen:
 *
 * * Datenbank-Zugangsdaten,
 * * Tabellenpräfix,
 * * Sicherheitsschlüssel
 * * und ABSPATH.
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Datenbank-Einstellungen - Diese Zugangsdaten bekommst du von deinem Webhoster. ** //
/**
 * Ersetze datenbankname_hier_einfuegen
 * mit dem Namen der Datenbank, die du verwenden möchtest.
 */
define( 'DB_NAME', 'db199475_26' );

/**
 * Ersetze benutzername_hier_einfuegen
 * mit deinem Datenbank-Benutzernamen.
 */
define( 'DB_USER', 'db199475_26' );

/**
 * Ersetze passwort_hier_einfuegen mit deinem Datenbank-Passwort.
 */
define( 'DB_PASSWORD', 'guftjA2qRE_q' );

/**
 * Ersetze localhost mit der Datenbank-Serveradresse.
 */
define( 'DB_HOST', 'mysql' );

/**
 * Der Datenbankzeichensatz, der beim Erstellen der
 * Datenbanktabellen verwendet werden soll
 */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Der Collate-Type sollte nicht geändert werden.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden untenstehenden Platzhaltertext in eine beliebige,
 * möglichst einmalig genutzte Zeichenkette.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle Schlüssel generieren lassen.
 *
 * Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten
 * Benutzer müssen sich danach erneut anmelden.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3MwoA&3z7nNm|-h2$7k|*5*&SvNHynYr7m%jcToRTu|S-E&K53d8]G[@L=A(5^[=' );
define( 'SECURE_AUTH_KEY',  'Tky(bzOH;64X{Wi[iJaXf+{s}Uc|5nJp5%:v9, n@{s}2s$oqb53|Gfv>kBI1SdP' );
define( 'LOGGED_IN_KEY',    'DL#_[*E%_$nMrL&0(E4CH1KC${he.VDP8<BVzRP%&hZyGmx&CG|31GUF~`+x_cEw' );
define( 'NONCE_KEY',        ',_(6Y]nT:AL=IM|4Ck{{^/VY^2_b|k mTD&EzwQE1BhavwGrI36II+@KM9Z@3]+8' );
define( 'AUTH_SALT',        'tz8kn.zn%)26wX~]t58acrD4M18<0Up*gV*a~+svm[~~bTs+%RwzhYS(N@z+v:8b' );
define( 'SECURE_AUTH_SALT', 'iZ#-v3}.)50Q_|Izo-x,nPuJQWXB!|&/p672zB8rTyjZQT=kLQN<52L;DC)t<x3U' );
define( 'LOGGED_IN_SALT',   '6]{|x36V30p}zju~WEF$tlPvS$W?Mb/eCK@>)f,L>SSW^VD6Bt(rD*Fv(KmZ6H-3' );
define( 'NONCE_SALT',       '4NI%2QzrucebOT0HQM0hE58yze4mi^(lB0x,&1QW<h2VOq`bY9C}GN$f}!>0KF6G' );

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 * Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 * verschiedene WordPress-Installationen betreiben.
 * Bitte verwende nur Zahlen, Buchstaben und Unterstriche!
 */
$table_prefix = 'wp_dev_';

/**
 * Für Entwickler: Der WordPress-Debug-Modus.
 *
 * Setze den Wert auf „true“, um bei der Entwicklung Warnungen und Fehler-Meldungen angezeigt zu bekommen.
 * Plugin- und Theme-Entwicklern wird nachdrücklich empfohlen, WP_DEBUG
 * in ihrer Entwicklungsumgebung zu verwenden.
 *
 * Besuche den Codex, um mehr Informationen über andere Konstanten zu finden,
 * die zum Debuggen genutzt werden können.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Füge individuelle Werte zwischen dieser Zeile und der „Schluss mit dem Bearbeiten“ Zeile ein. */



/* Das war’s, Schluss mit dem Bearbeiten! Viel Spaß. */
/* That's all, stop editing! Happy publishing. */

/** Der absolute Pfad zum WordPress-Verzeichnis. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Definiert WordPress-Variablen und fügt Dateien ein.  */
require_once ABSPATH . 'wp-settings.php';
