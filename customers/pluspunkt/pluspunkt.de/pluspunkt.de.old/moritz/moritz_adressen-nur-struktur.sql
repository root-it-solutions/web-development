# phpMyAdmin MySQL-Dump
# version 2.4.0
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Erstellungszeit: 29. September 2003 um 16:26
# Server Version: 3.23.49
# PHP-Version: 4.0.4pl1
# Datenbank: `DBd29fdff0bd6a`
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `moritz_adressen`
#

CREATE TABLE moritz_adressen (
  aid int(11) NOT NULL auto_increment,
  name text NOT NULL,
  vorname text NOT NULL,
  strasse text NOT NULL,
  plz varchar(5) NOT NULL default '',
  wohnort text NOT NULL,
  tel_vor varchar(5) NOT NULL default '',
  tel_nr varchar(15) NOT NULL default '',
  fax_vor varchar(5) NOT NULL default '',
  fax_nr varchar(15) NOT NULL default '',
  mobil_vor varchar(4) NOT NULL default '',
  mobil_nr varchar(9) NOT NULL default '',
  email text NOT NULL,
  homepage text NOT NULL,
  kommentar text NOT NULL,
  bid int(11) NOT NULL default '0',
  geb_datum date NOT NULL default '0000-00-00',
  PRIMARY KEY  (aid)
) TYPE=MyISAM;

