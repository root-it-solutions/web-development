<?php
    sessionStart();

    function sessionStart()
    {
        /*
        if(isset($_REQUEST["PHPSESSID"]) && $_REQUEST["PHPSESSID"] == "")
        {
            sessionStop();
        }
        */
        session_start();

        // Überprüfen ob der User noch von der Selben IP kommt. Wenn nicht ist die SessionID warscheinlich geklaut. -> sessionstop
        if(isset($_SESSION["ip"]))
        {
            if($_SESSION["ip"] != $_SERVER["REMOTE_ADDR"] || $_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"])
            {
                sessionStop();
            }
        }
        else
        {
            $_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
            $_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
        }
        if(0 < $_SESSION["user"]->id)
        {
            $_SESSION["flag"] = "active";
        }
        else
        {
            if($_REQUEST["username"] !== "" && $_REQUEST["password"] !== "" && $_REQUEST["login"])
            {
                if(isset($_COOKIE[session_name()]))
                {
                    $myUser = new UserClass;

                    $myUser->getUser($_REQUEST["username"],$_REQUEST["password"]);

                    if(0 < $myUser->id)
                    {
                        if($myUser->active)
                        {
                            $_SESSION["user"] = $myUser;
                            $_SESSION["user"]->set_lastlogin();
                            $_SESSION["user"]->resetLoginAttempts();
                            $_SESSION["flag"] = "login_ok";
                        }
                        else
                        {
                            $_SESSION["flag"] = "disabled";
                        }
                    }
                    else
                    {
                        $myUser->setLoginAttempts($_REQUEST["username"]);
                        $_SESSION["flag"] = "login_error";
                    }
                }
                else
                {
                    $_SESSION["flag"] = "cookie_error";
                }
            }
            else
            {
                if(!isset($_REQUEST["username"]) && !isset($_REQUEST["password"]))
                {
                    $_SESSION["flag"] = "login_new";
                }
                elseif($_REQUEST["rememberPassword"])
                {
                    $_SESSION["flag"] = "login_remember";
                }
                else
                {
                    $_SESSION["flag"] = "login_error";
                }
            }
        }

    }

    function sessionStop()
    {
        $_SESSION = array();     // Session Daten mit Leerwerten füllen (sicheres beenden)
        //unset($_SESSION);    // Session nochmals leeren
        session_destroy();    // Session ID selbst zerstören (weil jede Session ID einmalig ist.)
        header("Location: http://".$_SERVER["SERVER_NAME"]."/admin");
        exit;
    }
?>
