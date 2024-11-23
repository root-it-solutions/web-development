<?php 

    function getPHPSESSID($url)
    {
        $url = str_replace("/index.php","",$url);
        return ($url."/?SID=".session_id());
    }
    function getTemp($filename)
    {
        if(is_file($filename))
        {
            $f = fopen($filename, "r");
            $text = fread($f,filesize($filename));
            return $text;
        }
        else
        {
            echo "File: ".$filename." not found<br />";
            return false;
        }
    }

    function getLanguageLabels(&$teLang,$lang)
    {
        include "includes/locale/".$lang.".php";
    }

    function getHeaderJsFiles($start_dir = "js/")
    {
        $files = array();
        if(is_dir($start_dir))
        {
            $fh = opendir($start_dir);
            while(false !== ($file = readdir($fh)))
            {
                // loop through the files, skipping . and .., and recursing if necessary
                if(preg_match("/\.js/",$file))
                {
                    $filepath = $start_dir."/".$file;
                    if(is_dir($filepath))
                    {
                        $files = array_merge($files, listdir($filepath));
                    }
                    else
                    {
                        $name = substr($file, 0, -4)."Template";
                        $files[$name] = $start_dir."/".$file;
                        //echo $name."!<br>";
                    }
                }
            }
            closedir($fh);
            return $files;
        }
    }

    function listdir($start_dir = "")
    {
        $files = array();
        if(is_dir($start_dir))
        {
            $fh = opendir($start_dir);
            while(false !== ($file = readdir($fh)))
            {
                // loop through the files, skipping . and .., and recursing if necessary
                if ($file != "." && $file != ".." && !preg_match("/\.css/",$file) && !preg_match("/\.jpg/",$file) && !preg_match("/\.gif/",$file) && !preg_match("/\.png/",$file))
                {
                    $filepath = $start_dir."/".$file;
                    if(is_dir($filepath))
                    {
                        $files = array_merge($files, listdir($filepath));
                    }
                    else
                    {
                        $name = substr($file, 0, -4)."Template";
                        $files[$name] = $start_dir."/".$file;
                        //echo $name."!<br>";
                    }
                }
            }
            closedir($fh);
            return $files;
        }
    }

    function sendEmail($to,$bcc,$subject,$message,$from,$reply)
    {
        if($bcc === "")
        {
            $header = "From: ".$from."\r\n"."Reply-To: ".$replay."\r\n";
        }
        else
        {
            $header = "From: ".$from."\r\n"."Reply-To: ".$replay."\r\n"."Bcc: ".$bcc."\r\n";
        }
        $header .= "Content-Type:text/html\n";
        $header .= "Content-Transfer-Encoding: 8bit\n";

//        $message = "";
        mail($to,$subject,$message,$header);
    }
    function makeEmailKontakt($to,$from,$bcc,$subject,$reply)
    {

        $emailHeader = gettemp($GLOBALS["emailHeaderTemplate"]);

        $emailBody = gettemp($GLOBALS["emailBodyTemplate"]);

        $emailFooter = gettemp($GLOBALS["emailFooterTemplate"]);

        $emailBody = str_replace("[ name ]",$_REQUEST["name"],$emailBody);
        $emailBody = str_replace("[ strasse ]",$_REQUEST["srasse"],$emailBody);
        $emailBody = str_replace("[ hsnr ]",$_REQUEST["hsnr"],$emailBody);
        $emailBody = str_replace("[ plz ]",$_REQUEST["plz"],$emailBody);
        $emailBody = str_replace("[ ort ]",$_REQUEST["ort"],$emailBody);
        $emailBody = str_replace("[ telefon ]",$_REQUEST["telefon"],$emailBody);
        $emailBody = str_replace("[ email ]",$_REQUEST["email"],$emailBody);
        $emailBody = str_replace("[ nachricht ]",$_REQUEST["nachricht"],$emailBody);

        $message = $emailHeader.$emailBody.$emailFooter;

        sendEmail($to,$bcc,$subject,$message,$from,$reply);
    }

    function replaceSpecialCharacter($string)
    {
        return str_replace($GLOBALS["array_search"],$GLOBALS["array_replace"],utf8_decode($string));
    }
    function getUrlFriendlyText($string)
    {
        $search = $GLOBALS["array_url_search"];
        $replace = $GLOBALS["array_url_replace"];

        // <br> durch - ersetzen
        $validUrl  = preg_replace("/<br>/i","-",$string);
        $validUrl  = preg_replace("/<br \/>/i","-",$string);

        // HTML Tags entfernen
        $validUrl  = strip_tags($validUrl);

        // Schrägstriche entfernen
        $validUrl  = preg_replace("/\//","-",$validUrl);

        // Definierte Zeichen entfernen (Arraydefinition)
        $validUrl  = preg_replace($search,$replace,$validUrl);

        // Die nun noch (komisch aussehenden) doppelten Bindestriche entfernen
        $validUrl  = preg_replace("/(-){2,}/","-",$validUrl);

        // Nun alles entfernen, was nicht [a-Z][0-9] oder ein Bindestrich ist
        $validUrl = preg_replace("/[^a-z0-9-]/i", "", $validUrl);

        $validUrl = strtolower($validUrl);

        // String URL-codieren
        $validUrl  = urlencode($validUrl);

        return($validUrl);
    }

    function checkStandardPrivilege($project_id)
    {
        $privlegeName = $_SESSION["user"]->getPrivilegeName($project_id);

        if($privlegeName === "admin" || $privlegeName === "agency_admin" || $privlegeName === "webmaster" || $privlegeName === "editor")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function switchProject($project_id)
    {
        if(checkStandardPrivilege($project_id))
        {
            $_SESSION["activeProject"]->getProjectById($project_id);
            $_SESSION["activeProjectModules"] = new ModuleClass;
            $_SESSION["activeProjectModules"] = $_SESSION["activeProjectModules"]->getProjectModules($_SESSION["activeProject"]->id);
            return true;
        }
        else
        {
            return false;
        }
    }

    function sendPasswordRememberEmail($username)
    {
        return true;
    }

    function checkRight()
    {
        $privlegeName = $_SESSION["user"]->getPrivilegeName($_SESSION["activeProject"]->id);

        if($privlegeName === "admin")
        {
            return true;
        }//if($privlegeName === "admin")
        else
        {
            if(!$_SESSION["three"]) // if three is empty
            {
                if($_SESSION["two"] === "dashboard" || $_SESSION["two"] === "content" || $_SESSION["two"] === "marketing" || $_SESSION["two"] === "system" || $_SESSION["two"] === "support" || $_SESSION["two"] === "getprice")
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }//if(!$_SESSION["three"])
            else
            {
                // ###########################################################################################################
                // ##### SYSTEM #####
                // ###########################################################################################################
                if($_SESSION["two"] === "system")
                {
                    if($_SESSION["three"] === "user" && ($privlegeName === "agency_admin" || $privlegeName === "webmaster"))
                    {
                        if($_SESSION["four"] === "overview" || $_SESSION["four"] === "new")
                        {
                            return true;
                        }//if($_SESSION["four"] === "overview")
                        elseif(($_SESSION["four"] === "edit" || $_SESSION["four"] === "config") || $_REQUEST["todo"] === "update")
                        {
                            $myUser_class = new UserClass;
                            
                            if($myUser_class->checkUserByIdAndProjectId($_SESSION["five"],$_SESSION["activeProject"]->id,$privlegeName))
                            {
                                return true;
                            }//if($myUser_class->checkUserByIdAndProjectId($_SESSION["five"],$_SESSION["activeProject"]->id,$privlegeName))
                            else
                            {
                                return false;
                            }//else
                        }//elseif($_SESSION["four"] === "edit" || $_REQUEST["todo"] === "update"
                    }//if($_SESSION["three"] === "user" && ($privlegeName === "agency_admin" || $privlegeName === "webmaster"))
                    elseif($_SESSION["three"] === "user" && $privlegeName === "user")
                    {
                        if(($_SESSION["four"] === "edit" || $_SESSION["four"] === "config") || $_REQUEST["todo"] === "update")
                        {
                            $myUser_class = new UserClass;
                            $myUser_class->getUserById($_SESSION["five"]);
                            if($myUser_class->u_id === $_SESSION["user"]->u_id)
                            {
                                return true;
                            }//if($myUser_class->u_id === $_SESSION["user"]->u_id)
                            else
                            {
                                return false;
                            }//else
                        }
                    }//elseif($_SESSION["three"] === "user" && $privlegeName === "user")
                    elseif($_SESSION["three"] === "project")
                    {
                        if($_SESSION["four"] === "settings" && ($privlegeName === "agency_admin" || $privlegeName === "webmaster"))
                        {
                            return true;
                        }
                        elseif($_SESSION["four"] === "new" && $privlegeName === "agency_admin")
                        {
                            return true;
                        }
                    }
                    else
                    {
                        return false;
                    }//else
                }//if($_SESSION["two"] === "system")
                // ###########################################################################################################
                // ##### CONTENT #####
                // ###########################################################################################################
                elseif($_SESSION["two"] === "content")
                {
                    if($_SESSION["three"] === "pages" && $_SESSION["four"] === "overview")
                    {
                        return true;
                    }//if($_SESSION["three"] === "pages" && $_SESSION["four"] === "overview")
                }//elseif($_SESSION["two"] === "content")
                // ###########################################################################################################
                // ##### GETPRICE #####
                // ###########################################################################################################
                elseif($_SESSION["two"] === "getprice")
                {
                    return true;
                }//elseif($_SESSION["two"] === "getprice")
            }//else
        }//else
    }//function checkRight()
?>
