<?php

    define('ADMINDIR', 'admin');
    define('INCLUDESDIR', 'includes');
    define('TEMPLATESDIR', '/templates');
    define('IMAGESDIR', '/images');
    define('IMAGESMOTIVEDIR', IMAGESDIR.'/motive');
    define('CSSDIR', '/css');
    define('LIBRARYDIR', 'library');
    define('CLASSDIR', 'class');
    define('JSDIR', '/js');
    define('GLOB_SEARCH_STRING', '*.jpg,*.JPG,*.gif,*.GIF,*.png,*.PNG,*.tif,*.TIF');
    define("LANG","de");

    require_once ADMINDIR.'/'.INCLUDESDIR.'/connection.php';

    /* Benötigte Klassen Datei autmoatisch laden */
    function __autoload($class_name)
    {
        require_once 'admin/'.CLASSDIR.'/class_'.str_replace('Class', '', $class_name).'.php';
    }

    require_once INCLUDESDIR.'/arrays.php';
    require_once INCLUDESDIR.'/functions.php';

    foreach(listdir(preg_replace("/^\//", "", TEMPLATESDIR)) as $key => $val)
    {
        $$key = $val;
        //echo $key." - ".$val."<br />";
    }

    define('STANDARD_META_KEYWORDS', 'Inspiration, Running Dinner, Erbdrostenhof M&uuml;nster, Personalentwicklung, Unternehmensentwicklung, ESB, eigene Stellenbeschreibung, Stellenbeschreibung, Teambildung, Vision, Visionsentwicklung, Kommunikation, Training, Menschenf&uuml;hrung, Mitarbeiterf&uuml;hrung, Erfolg, Kreativit&auml;t, Begeisterung, Personalentwicklung, Prozessmanagement, Management, F&uuml;hrung, Vision, Motivation, Coaching, Personalberatung,Seminar f&uuml;r F&uuml;hrung, F&uuml;hrungstraining, F&uuml;hrungsmethoden, F&uuml;hrungsseminare, Unternehmenskultur, Verkaufstraining, F&uuml;hrungsseminar, Soft Skills, Seminar, F&uuml;hrungsseminar, Beratung, Betriebsberatung, Motivation, Unternehmen, Mitarbeiter, Motivation, Verantwortung, Unternehmensnachfolge, Seminare, Fuerteventura, Potenzialanalyse, Self Coaching, Pr&auml;sentationsseminare, Typisch Buch, Tutorials, Assessment, Beratung, Coaching, Kommunikation, Meditation, Motivaton, Moderation, Outplacement, Personalentwicklung, Potenzialentwicklung, Pr&auml;sentation, Teamentwicklung, Basel II, Bankenrating, Rating, Bankengespr&uuml;ch, Analyse, F&uuml;hrung, F&uuml;hrungsseminar, Seal Training, Beratung f&uuml;r den Mittelstand, pluspunkt, Ascheberg, Rumi, Lohe, soft skills, Unternehmensenwicklung, Beratung, Unternehmensenwicklung, Schulung, B&auml;cker, B&auml;ckerei, B&auml;ckerei-Betrieb, Betrieb, Maler, Schreiner, Koch, Handwerk, Handwerker, Handwerksbetrieb, Konfliktmoderation, Konflikt, Konflikte, Konfliktl&ouml;sung, Konfliktregelung, Unternehmensenwicklung, Mediation, Mediator, mittelst&auml;ndische Unternehmen, Manager, F&uuml;hrungskraft, F&uuml;hrungskr&auml;fte, Mitarbeiter,Krisenmanagement, Krisen, Manager, Management,Unternehmensberatung, F&uuml;hrungskr&auml;fte, Nachfolgeregelung, Generationswechsel im Betrieb, Unternehmen, Kommunikation, Nachfolger, Juniorchef, Seniorchef, Unternehmensgr&uuml;nder');
?>
