<?
class c_db
{
    var $connid;
    var $erg;
    var $fehler;

#----------------------------------------------------------------------------------------------
# Konstruktor c_db
#
# Datenbankverbindung aufbauen, Benutzer einloggen
#----------------------------------------------------------------------------------------------

    function c_db($Server, $User, $Passwort, $Database)
    {
      if(!$this->connid=mysql_connect($Server, $User, $Passwort)) { echo('Datenbankverbindung fehlgeschlagen...'); }
      if(!mysql_select_db($Database, $this->connid)) { echo('Datenbankauswahl fehlgeschlagen...'); }
      return $connid;
    }

    function sql_query($sql)
    {
      if(!$this->erg=mysql_query($sql, $this->connid)) { echo("<br />Fehler bei Abfrage"); $fehler=mysql_error(); echo("$fehler"); }
      return $this->erg;
    }

     function sql_fetch_object($sql)
    {
      if(!$this->erg=mysql_fetch_object($sql)) { $fehler=mysql_error(); echo("$fehler"); }
      return $this->erg;
    }

     function sql_num_rows($sql)
    {
      if(!$this->erg=mysql_num_rows($sql)) { $fehler=mysql_error(); echo("$fehler"); }
      return $this->erg;
    }
    
     function sql_fetch_row($sql)
    {
      if(!$this->erg=mysql_fetch_row($sql)) { $fehler=mysql_error(); echo("$fehler"); }
      return $this->erg;
    }
}
?>
