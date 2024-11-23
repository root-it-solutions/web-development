<?php

ini_set('include_path', ini_get('include_path') . ':' . dirname(__FILE__) . '/../library');
require_once 'Zend/Session/Namespace.php';
$session = new Zend_Session_Namespace();

unset($session->rechen_captcha_spam);
$zahl1 = rand(10,20); //Erste Zahl 10-20
$zahl2 = rand(1,10);  //Zweite Zahl 1-10
$operator = rand(1,2); // + oder -

if($operator == "1"){
   $operatorzeichen = " + ";
   $ergebnis = $zahl1 + $zahl2;
}else{
   $operatorzeichen = " - ";
   $ergebnis = $zahl1 - $zahl2;
}

function encrypt($string, $key) {
$result = '';
for($i=0; $i<strlen($string); $i++) {
   $char = substr($string, $i, 1);
   $keychar = substr($key, ($i % strlen($key))-1, 1);
   $char = chr(ord($char)+ord($keychar));
   $result.=$char;
}
return base64_encode($result);
}

$session->rechen_captcha_spam = encrypt($ergebnis, "jkl134891hj"); //Key
$session->rechen_captcha_spam = str_replace("=", "", $session->rechen_captcha_spam);
        
$rechnung = $zahl1.$operatorzeichen.$zahl2." = ?";
$img = imagecreatetruecolor(80,15);
$schriftfarbe = imagecolorallocate($img,13,28,91);
$hintergrund = imagecolorallocate($img,162,162,162);
imagefill($img,0,0,$hintergrund);
imagestring($img, 3, 2, 0, $rechnung, $schriftfarbe);
header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?> 