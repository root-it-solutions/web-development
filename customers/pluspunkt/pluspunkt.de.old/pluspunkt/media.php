<?php
function download($file , $name) {
    $size = filesize($file);
    header("Content-type: application/octet-stream");
    header("Content-disposition: attachment; filename=".$name);
    header("Content-Length: ".$size);
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile($file);
}

if(!strlen($_GET['file'])) {
	echo "Es wurde keine downloadbare Datei angegeben...";
	echo "<br><a href='javascript:history.back();'>zurück</a>";
}
else {
	if(file_exists($_GET['file'])) {
		download($_GET['file'],$_GET['file']);
	}
	else {
		echo "Die angeforderte Datei (<em>".$_GET['file']."</em>) konnte nicht gefunden werden...";
	echo "<br><a href='javascript:history.back();'>zurück</a>";
	}
}

?> 
