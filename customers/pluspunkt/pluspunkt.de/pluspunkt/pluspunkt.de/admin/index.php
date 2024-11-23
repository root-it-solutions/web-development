<?php
    // Gibt an welche PHP-Fehler Ã¼berhaupt angezeigt werden
    //error_reporting(E_ALL | E_STRICT);
    // Um die Fehler auch auszugeben, aktivieren wir die Ausgabe
    //ini_set('display_errors', 1);

    //echo var_dump($_REQUEST);
    ob_start("ob_gzhandler");
    date_default_timezone_set('Europe/Berlin');
    header("content-type: text/html; charset=utf-8");

    include("includes/config.php");

    setSessionVariablen();

    switch($_SESSION["flag"])
    {
        case "login_new":
                    showLogin();
                    break;
        case "login_remember":
                    if(sendPasswordRememberEmail($_REQUEST["username"]))
                    {
                        $_SESSION["flag"] = "login_remember_success";
                    }
                    else
                    {
                        $_SESSION["flag"] = "login_remember_error";
                    }
                    showLogin();
                    break;
        case "login_error":
        case "cookie_error":
        case "disabled":
                    showLogin();
                    break;
        case "login_ok":
        case "active":
                    loginOk();
                    break;
        default:
                    showLogin();
                    break;
    }

    function loginOk()
    {
        if($_SESSION["one"] === "csv")
        {
            $myInspiration = new InspirationClass;
            //echo var_dump($myInspiration->getInspirationArray());exit;

            header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename=inspiration.csv');
            $out = fopen('php://output', 'w');
            $myInspiration->getInspirationToCSV($out);
            fclose($out);
        }
        else
        {
            $te = new TemplateEngine;

            setOnsite($te);
            
            $te->assign("imagesdir",IMAGESDIR);
            $te->assign("cssdir",CSSDIR);
            $te->assign("jsdir",JSDIR);
            $te->assign('today',strftime('%d. %B %G %H:%M',time()));
            getLanguageLabels($te,'de');
            if(preg_match('/Opera/', $_SESSION['browser']))
            {
                $te->assign("operacssfile",'<link media="screen" href="'.CSSDIR.'/opera.css" type="text/css" rel="stylesheet">');
            }

            if(isset($_SESSION["successMessage"]) && $_SESSION["successMessage"] !== '')
            {
                $te->assign("successMessage", $_SESSION["successMessage"]);
                $te->assign("message",$te->display($GLOBALS["messageSuccessTemplate"]));
            }
            elseif(isset($_SESSION["errorMessage"]) && $_SESSION["errorMessage"] !== '')
            {
                $te->assign("errorMessage", $_SESSION["errorMessage"]);
                $te->assign("message",$te->display($GLOBALS["messageErrorTemplate"]));
            }

            unset($_SESSION["successMessage"]);
            unset($_SESSION["errorMessage"]);

            $mainMenuTemplate = $te->display($GLOBALS["mainMenuTemplate"]);
            $te->assign("mainMenu", $mainMenuTemplate);

            /*############################################################################################*/
            if($_SESSION["one"] === "logout")
            {
                sessionStop();
            }
            elseif($_SESSION["one"] === "content")
            {
                include_once LIBRARYDIR."/content.php";
            }
            elseif($_SESSION["one"] === "appointment")
            {
                include_once LIBRARYDIR."/appointment.php";
            }
            elseif($_SESSION["one"] === "newsletter")
            {
                include_once LIBRARYDIR."/newsletter.php";
            }
            elseif($_SESSION["one"] === "list")
            {
                include_once LIBRARYDIR."/list.php";
            }
            elseif($_SESSION["one"] === "inspiration")
            {
                include_once LIBRARYDIR."/inspiration.php";
            }
            else
            {
                include_once LIBRARYDIR."/content.php";
            }
            /*############################################################################################*/

            $te->assign("content",$content);
            $te->assign("year",date("Y",time()));
            $main = $te->display($GLOBALS["mainTemplate"]);

            echo $main;
        }
    }

    function showLogin()
    {
        $te = new TemplateEngine;

        $te->assign("imagesdir",IMAGESDIR);
        $te->assign("cssdir",CSSDIR);
        $te->assign("jsdir",JSDIR);

        $te->assign("year",date("Y",time()));
        getLanguageLabels($te,'de');

        if($_SESSION["flag"] === "login_error")
        {
            $te->assign("errorMessage", $te->getVar("errorUserPassWrongLabel"));
            $te->assign("message",$te->display($GLOBALS["messageErrorTemplate"]));
        }
        elseif($_SESSION["flag"] === "disabled")
        {
            $te->assign("errorMessage", $te->getVar("errorUserPassWrongLabel"));
            $te->assign("message",$te->display($GLOBALS["messageErrorTemplate"]));
        }
        elseif($_SESSION["flag"] === "login_remember_success")
        {
            $te->assign("successMessage", $te->getVar("messagePasswordRememberSendSuccessLabel"));
            $te->assign("message",$te->display($GLOBALS["messageSuccessTemplate"]));
        }
        elseif($_SESSION["flag"] === "login_remember_error")
        {
            $te->assign("errorMessage", $te->getVar("messagePasswordRememberSendErrorLabel"));
            $te->assign("message",$te->display($GLOBALS["messageErrorTemplate"]));
        }
        else
        {
            $te->assign("message", "");
        }

        if($_SESSION["flag"] === "cookie_error")
        {
            $login = $te->display($GLOBALS["noCookieTemplate"]);
        }
        else
        {
            $login = $te->display($GLOBALS["loginTemplate"]);
        }

        echo $login;
    }

    function setSessionVariablen()
    {
        if(isset($_REQUEST["one"]) && $_REQUEST["one"] !== "")
        {
            $_SESSION["one"] = $_REQUEST["one"];
        }
        else
        {
            $_SESSION["one"] = "content";
        }
        if(isset($_REQUEST["two"]) && $_REQUEST["two"] !== "")
        {
            $_SESSION["two"] = $_REQUEST["two"];
        }
        else
        {
            if($_SESSION["one"] === 'content')
            {
                $_SESSION["two"] = "overview";
            }
            else
            {
                $_SESSION["two"] = "";
            }
        }
        if(isset($_REQUEST["three"]) && $_REQUEST["three"] !== "")
        {
            $_SESSION["three"] = $_REQUEST["three"];
        }
        else
        {
            $_SESSION["three"] = "";
        }
        if(isset($_REQUEST["four"]) && $_REQUEST["four"] !== "")
        {
            $_SESSION["four"] = $_REQUEST["four"];
        }
        else
        {
            $_SESSION["four"] = "";
        }
        if(isset($_REQUEST["five"]) && $_REQUEST["five"] !== "")
        {
            $_SESSION["five"] = $_REQUEST["five"];
        }
        else
        {
            $_SESSION["five"] = "";
        }
        if(isset($_REQUEST["six"]) && $_REQUEST["six"] !== "")
        {
            $_SESSION["six"] = $_REQUEST["six"];
        }
        else
        {
            $_SESSION["six"] = "";
        }
    }

    function setOnsite(&$te)
    {
        if($_SESSION["one"] === "")
        {
            $te->assign('onCatContent', 'class="onCat roundedTopCorners"');
        }
        elseif($_SESSION["one"] !== "")
        {
            $te->assign('onCat'.ucfirst(str_replace($GLOBALS["array_search"], $GLOBALS["array_replace"], $_SESSION["one"])), 'class="onCat roundedTopCorners"');
        }

        /* Sub Menue */
        if($_SESSION["two"] === "")
        {
            $te->assign('onSiteOverview', 'class="onSite"');
        }
        elseif($_SESSION["two"] !== "")
        {
            $te->assign('onSite'.ucfirst(str_replace($GLOBALS["array_search"], $GLOBALS["array_replace"], $_SESSION["two"])), 'class="onSite"');
        }
    }
?>
