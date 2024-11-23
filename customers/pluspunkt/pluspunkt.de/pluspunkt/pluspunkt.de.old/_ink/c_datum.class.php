<?php
class c_datum
{
  function monat($zahl)
  {
    switch($zahl)
    {
      case "01": $erg = "Januar"; break;
      case "02": $erg = "Februar"; break;
      case "03": $erg = "März"; break;
      case "04": $erg = "April"; break;
      case "05": $erg = "Mai"; break;
      case "06": $erg = "Juni"; break;
      case "07": $erg = "Juli"; break;
      case "08": $erg = "August"; break;
      case "09": $erg = "September"; break;
      case "10": $erg = "Oktober"; break;
      case "11": $erg = "November"; break;
      case "12": $erg = "Dezember"; break;
    }
  return $erg;
  }


  function tag($tag)
  {
    switch($tag)
    {
      case "Monday": $erg = "Montag"; break;
      case "Tuesday": $erg = "Dienstag"; break;
      case "Wednesday": $erg = "Mittwoch"; break;
      case "Thursday": $erg = "Donnerstag"; break;
      case "Friday": $erg = "Freitag"; break;
      case "Saturday": $erg = "Samstag"; break;
      case "Sunday": $erg = "Sonntag"; break;
    }
  return $erg;
  }
}
?>