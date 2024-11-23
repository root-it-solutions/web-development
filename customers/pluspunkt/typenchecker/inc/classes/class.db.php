<?
################################################################################################
#----------------------------------------------------------------------------------------------#
# Konstruktor c_db                                                                             #
#                                                                                              #
# Datenbankverbindung aufbauen                                   #
#----------------------------------------------------------------------------------------------#
#                                                #
# linkarena.com                                          #
# filename: -> c_db.class.php                                        #
# author:   -> unknown                                       #
# function: -> built database connection                             #
# done:     -> unknown                                       #
#                                                #
################################################################################################

class c_db
{
    var $connid;
    var $erg;
    var $fehler;

    public function __construct($Server, $User, $Passwort, $Database)
    {
        if (!$this->connid = mysqli_connect($Server, $User, $Passwort))
        {
            echo('Datenbankverbindung fehlgeschlagen...');
        }
        if (!mysqli_select_db($this->connid, $Database))
        {
            echo('Datenbankauswahl fehlgeschlagen...');
        }
        mysqli_query($this->connid, "SET NAMES 'utf8'");         //Rich
        mysqli_query($this->connid, "SET CHARACTER SET 'utf8'"); //Rich
        return $this->connid;
    }

    function last_insert_id()
    {
        return mysqli_insert_id($this->connid);
    }

    function sql_query($sql)
    {
        if (!$this->erg = mysqli_query($this->connid, $sql))
        {
            echo("<br />Fehler bei Abfrage");
            $fehler = mysqli_error($this->connid);
            echo("$fehler");
        }
        return $this->erg;
    }

    function sql_fetch_object($sql)
    {
        if (!$this->erg = mysqli_fetch_object($sql))
        {
            $fehler = mysqli_error($this->connid);
            echo("$fehler");
        }
        return $this->erg;
    }

    function sql_fetch_array($sql)
    {
        if (!$this->erg = mysqli_fetch_all($sql, MYSQLI_ASSOC))
        {
            $fehler = mysqli_error($this->connid);
            echo("$fehler");
        }
        return $this->erg;
    }

    function sql_fetch_field($sql)
    {
        if (!$this->erg = mysqli_fetch_field($sql))
        {
            $fehler = mysqli_error($this->connid);
            echo("$fehler");
        }
        return $this->erg;
    }

    function sql_num_rows($sql)
    {
        if (!$this->erg = mysqli_num_rows($sql))
        {
            $fehler = mysqli_error($this->connid);
            echo("$fehler");
        }
        return $this->erg;
    }

    function sql_fetch_row($sql)
    {
        if (!$this->erg = mysqli_fetch_row($sql))
        {
            $fehler = mysqli_error($this->connid);
            echo("$fehler");
        }
        return $this->erg;
    }

    function sql_real_escape_string($sql)
    {
        return mysqli_real_escape_string($this->connid, $sql);
    }

    function escape($sql)
    {
        return mysqli_real_escape_string($this->connid, $sql);
    }
}

################################################################################################
#----------------------------------------------------------------------------------------------#
# end of file: c_db.inc.php -------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------#
################################################################################################
?>