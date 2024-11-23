<?php  
// Inhalt: Klasse zum Erstellen von Thumbnails 
// Autor:  Reitinger Matthias a.k.a. reima (plz give proper credit) 

class thumb 
{ 
    var $im = 0; 

    function thumb($file=0, $width=0, $height=0) 
    { 
        if ($file && $width && $height) { 
            $this->create($file, $width, $height); 
        } 
    } 

    function create($file, $width=0, $height=0, $resample=0) 
    { 
        if ($this->im) $this->clear(); 

        list($src_width, $src_height, $src_type) = getimagesize($file); 
        if ($src_type != 2) return false; // kein jpeg => abbrechen 
         
        if ($width == 0) { 
            $width = round($height * ($src_width/$src_height)); 
        } 
        if ($height == 0) { 
            $height = round($width * ($src_height/$src_width)); 
        } 
         
        $src_im = imagecreatefromjpeg($file); 
        $this->im = imagecreatetruecolor($width, $height); 
         
        if ($resample) { 
            imagecopyresampled($this->im, $src_im, 0, 0, 0, 0, 
                $width, $height, $src_width, $src_height); 
        } else { 
            imagecopyresized($this->im, $src_im, 0, 0, 0, 0, 
                $width, $height, $src_width, $src_height); 
        } 
         
        imagedestroy($src_im); 
                 
        return true; 
    } 

    function savetofile($file, $quality=75) 
    { 
        imagejpeg($this->im, $file, $quality); 
    } 

    function output($quality=75) 
    { 
        header("Content-type: image/jpeg"); 
        imagejpeg($this->im, "", $quality); 
    } 

    function clear() 
    { 
        imagedestroy($this->im); 
        $this->im = 0; 
    } 
} 
?>
