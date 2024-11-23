<?php 
class c_passwort
{
	function passwort($laenge)
	{
		$pass_len = $laenge;
		$passwort = "";
		mt_srand ((double) microtime() * 1000000);
		while (strlen($passwort)<$pass_len)	{
	 	 $c = chr(mt_rand (0,255));
	 	 if (eregi("^[a-z0-9]$", $c)) $passwort = $passwort.$c;};

		return $passwort;
	}
}
?>
