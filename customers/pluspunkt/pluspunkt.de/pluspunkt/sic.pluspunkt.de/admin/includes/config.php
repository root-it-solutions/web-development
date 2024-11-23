<?php

    define("INCLUDESDIR","includes/");

    define("TEMPLATESDIR","templates");
    define("LIBRARYDIR","library/");
    define("CLASSDIR","class/");
    define("JSDIR","/admin/js");
    define("IMAGESDIR","/admin/images");
    define("CSSDIR","/admin/css");
    define("LANG","de");

    require_once INCLUDESDIR."connection.php";

    /* Benötigte Klassen Datei autmoatisch laden */
    function __autoload($class_name)
    {
        require_once CLASSDIR."class_".str_replace("Class","",$class_name).".php";
    }

    require_once INCLUDESDIR."arrays.php";
    require_once INCLUDESDIR."functions.php";
    require_once INCLUDESDIR."fileupload.php";

    require_once INCLUDESDIR."session.php";

    foreach(listdir(preg_replace("/^\//", "", TEMPLATESDIR)) as $key => $val)
    {
        $$key = $val;
        //echo $key." - ".$val."<br />";
    }

?>
