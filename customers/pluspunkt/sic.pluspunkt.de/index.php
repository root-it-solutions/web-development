<?php
    include_once 'includes/redirects.php';
    ob_start("ob_gzhandler");
    date_default_timezone_set('Europe/Berlin');

    session_start();

    include_once 'includes/config.php';

    $te = new TemplateEngine;

//#####################################################################################################
    //echo var_dump($_REQUEST);
    if(isset($_REQUEST["captcha_code"]) && $_REQUEST["captcha_code"] != '')
    {
        include_once INCLUDESDIR.'/securimage.php';
        $securimage = new Securimage();

        if($securimage->check($_REQUEST['captcha_code']) == true)
        {
            if(!isset($_REQUEST["todo"]))
            {
                $domain = str_replace('www.', '', $_SERVER["HTTP_HOST"]);
                $empfaenger = 'brumi@pluspunkt.de,mail@pluspunkt.de';
                $betreff = 'Kontakt: '.$domain;
                $from = 'Kontaktformular '.$domain.'<kontaktformular@'.$domain.'>';
                $reply = 'noreply@'.$domain;
                $bcc = '';

                $messagemail .= 'Nachrichteneingang: ';
                $messagemail .= '<br />';
                $messagemail .= '<br />Name: '.utf8_decode($_REQUEST["name"]);
                $messagemail .= '<br />Strasse: '.utf8_decode($_REQUEST["strasse"]);
                $messagemail .= '<br />Ort: '.utf8_decode($_REQUEST["plzCity"]);
                $messagemail .= '<br />Telefon: '.utf8_decode($_REQUEST["telefon"]);
                $messagemail .= '<br />E-Mail: '.utf8_decode($_REQUEST["email"]);
                $messagemail .= '<br />';
                $messagemail .= '<br />Nachricht: '.utf8_decode($_REQUEST["nachricht"]);

                $header .= "MIME-Version: 1.0\n";
                $header .= "From: ".$from."\n";
                $header .= "Reply-To: ".$reply."\n"."Bcc: ".$bcc."\n";
                $header .= "Content-Type:text/html;\n";
                $header .= "Content-Transfer-Encoding: 8bit\n\n";

                /* additional headers */ 
                //$header .= "To: Mary <mary@example.com>, Kelly <kelly@example.com>rn"; 
                //$header .= "Cc: [email]birthdayarchive@example.com[/email]rn"; 
                //$header .= "Bcc: [email]birthdaycheck@example.com[/email]rn";
                //$header = "From: ".$from."\r\n"."Reply-To: ".$reply."\r\n"."Bcc: ".$bcc."\r\n";

                mail($empfaenger, $betreff, $messagemail, $header);
                if($_REQUEST["selfMail"] == '1')
                {
                    mail(utf8_decode($_REQUEST["email"]), $betreff, $messagemail, $header);
                }

                $te->assign('successMessage', '<strong>Vielen Dank f&uuml;r Ihre Nachricht.</strong> Ihre Nachricht wurde erfolgreich gesendet.');
                $te->assign('message', $te->display($GLOBALS["messageSuccessTemplate"]));
            }
            elseif($_REQUEST["todo"] === 'inspirationRegistration')
            {
                $domain = str_replace('www.', '', $_SERVER["HTTP_HOST"]);
                //$empfaenger = 'elmar@homun.de';
                $empfaenger = 'brumi@pluspunkt.de,mail@pluspunkt.de';
                $betreff = 'Inspiration: '.$domain;
                $from = 'Inspiration Anmeldung '.$domain.'<inspirationformular@'.$domain.'>';
                $reply = 'noreply@'.$domain;
                $bcc = '';
                $myRegistration = new InspirationClass;
                $myRegistration->name = utf8_decode($_REQUEST["name"]);
                $myRegistration->street = utf8_decode($_REQUEST["strasse"]);
                $myRegistration->zipCodeCity = utf8_decode($_REQUEST["plzCity"]);
                $myRegistration->fon = utf8_decode($_REQUEST["telefon"]);
                $myRegistration->email = utf8_decode($_REQUEST["email"]);
                $myRegistration->amountParents =  utf8_decode($_REQUEST["adult"]);
                $myRegistration->amountChildren = utf8_decode($_REQUEST["children"]);
                $myRegistration->ageChildren = utf8_decode($_REQUEST["childrenAge"]);
                $myRegistration->insert();

                $messagemail .= 'Nachrichteneingang: ';
                $messagemail .= '<br />';
                $messagemail .= '<br />Name: '.utf8_decode($_REQUEST["name"]);
                $messagemail .= '<br />Strasse: '.utf8_decode($_REQUEST["strasse"]);
                $messagemail .= '<br />Ort: '.utf8_decode($_REQUEST["plzCity"]);
                $messagemail .= '<br />Telefon: '.utf8_decode($_REQUEST["telefon"]);
                $messagemail .= '<br />E-Mail: '.utf8_decode($_REQUEST["email"]);
                $messagemail .= '<br />Anzahl Erwachsene: '.utf8_decode($_REQUEST["adult"]);
                $messagemail .= '<br />Anzahl Kinder: '.utf8_decode($_REQUEST["children"]);
                $messagemail .= '<br />Alter der Kinder: '.utf8_decode($_REQUEST["childrenAge"]);

                $header .= "MIME-Version: 1.0\n";
                $header .= "From: ".$from."\n";
                $header .= "Reply-To: ".$reply."\n"."Bcc: ".$bcc."\n";
                $header .= "Content-Type:text/html;\n";
                $header .= "Content-Transfer-Encoding: 8bit\n\n";

                /* additional headers */ 
                //$header .= "To: Mary <mary@example.com>, Kelly <kelly@example.com>rn"; 
                //$header .= "Cc: [email]birthdayarchive@example.com[/email]rn"; 
                //$header .= "Bcc: [email]birthdaycheck@example.com[/email]rn";
                //$header = "From: ".$from."\r\n"."Reply-To: ".$reply."\r\n"."Bcc: ".$bcc."\r\n";

                mail($empfaenger, $betreff, $messagemail, $header);

                $te->assign('successMessage', '<strong>Vielen Dank f&uuml;r Ihre Anmeldung.</strong> Ihre Nachricht wurde erfolgreich gesendet.');
                $te->assign('message', $te->display($GLOBALS["messageSuccessTemplate"]));
            }
            elseif($_REQUEST["todo"] === 'newsletterSignin')
            {
                $myNewsletterSubscriber_class = new NewsletterSubscriberClass;
                $myNewsletterSubscriber_class->firstname = $_REQUEST["firstname"];
                $myNewsletterSubscriber_class->lastname = $_REQUEST["lastname"];
                $myNewsletterSubscriber_class->email = $_REQUEST["email"];
                $myNewsletterSubscriber_class->gender = $_REQUEST["gender"];
                $myNewsletterSubscriber_class->html = $_REQUEST["html"];
                $myNewsletterSubscriber_class->auth = md5($_REQUEST["email"].md5($_REQUEST["firstname"].$_REQUEST["lastname"]));
                $myNewsletterSubscriber_class->authLinkClicked = 0;
                $myNewsletterSubscriber_class->insert();
                //echo var_dump($myNewsletterSubscriber_class);
                
                $domain = str_replace(array('www.', 'testing.'), array('', ''), $_SERVER["HTTP_HOST"]);
                $from = 'Newsletter '.$domain.'<newsletter@'.$domain.'>';
                $reply = 'noreply@'.$domain;
                $bcc = '';
                $subject = 'Newsletter Anmeldung';

                $te->assign('firstname', $myNewsletterSubscriber_class->firstname);
                $te->assign('lastname', $myNewsletterSubscriber_class->lastname);
                $te->assign('email', $myNewsletterSubscriber_class->email);
                $te->assign('url', 'http://www.pluspunkt.de/home/newsletter/submit/'.$myNewsletterSubscriber_class->auth);
                $message = $te->display($GLOBALS["emailNewsletterSubscriberSubmitTextTemplate"]);

                sendHTMLImageMailTpl('logo-email.jpg', 'images/', $message, 'emailMessageTemplate', $te, $myNewsletterSubscriber_class->email, $from, $reply, $bcc, $subject, $myNewsletterSubscriber_class);

                $te->assign('successMessage', '<strong>Vielen Dank f&uuml;r die Anmeldung zum Newsletter.</strong> Sie erhalten in k&uuml;rze eine E-Mail mit einem Best&auml;tigungslink. Erst nach dem Sie den Link angeclickt haben erhalten Sie zuk&uuml;nftig den Newsletter.');
                $te->assign('message', $te->display($GLOBALS["messageSuccessTemplate"]));
            }
        }
        elseif(!isset($_REQUEST["todo"]))
        {
            setContactFormValues($te);
        }// elseif(!isset($_REQUEST["todo"])
        elseif($_REQUEST["todo"] === 'newsletterSignin')
        {
            setNewsletterSigninFormValues($te);
        }// elseif($_REQUEST["todo"] === 'newsletterSignin')
    }//if($_REQUEST["kontaktFormSend"] === 1)
    elseif(isset($_REQUEST["captcha_code"]) && $_REQUEST["captcha_code"] == '' && !isset($_REQUEST["todo"]))
    {
        setContactFormValues($te);
    }
    elseif(isset($_REQUEST["captcha_code"]) && $_REQUEST["captcha_code"] == '' && $_REQUEST["todo"] === 'newsletterSignin')
    {
        setNewsletterSigninFormValues($te);
    }

//#####################################################################################################
    $te->assign('imagesdir', IMAGESDIR);
    $te->assign('imagesMotiveDir', IMAGESMOTIVEDIR);
    $te->assign('cssdir', CSSDIR);
    $te->assign('jsdir', JSDIR);

    $te->assign('menu', getMenuContent('0', 'de', '', $te));

    if($_REQUEST["one"] === 'home' && $_REQUEST["two"] === 'termine')
    {
        include_once LIBRARYDIR.'/appointment.php';
    }
    elseif($_REQUEST["one"] === 'home' && ($_REQUEST["two"] === 'newsletter' || $_REQUEST["two"] === 'newsletterarchiv'))
    {
        include_once LIBRARYDIR.'/newsletter.php';
    }
    elseif($_REQUEST["one"] === 'home' && $_REQUEST["two"] === 'sitemap')
    {
        include_once LIBRARYDIR.'/sitemap.php';
    }
    elseif($_REQUEST["one"] === 'kunden')// && $_REQUEST["two"] === 'kunden')
    {
        include_once LIBRARYDIR.'/kunden.php';
    }
    else
    {
        include_once LIBRARYDIR.'/content.php';
    }

    include_once LIBRARYDIR.'/boxes/appointment.php';

    $te->assign('siteTitle', $siteTitle);
    $te->assign('robots', 'INDEX,FOLLOW');
    $te->assign('keywords', 'Pluspunkt Unternehmensentwicklung GmbH, Pluspunkt GmbH, Pluspunkt, Unternehmensentwicklung, Ralf Lohe, Manfred Rumi, '.STANDARD_META_KEYWORDS);
    $te->assign('description', $metaDescription);
    $te->assign('urlName', $urlName);
    $te->assign('content', $content);
    $te->assign('contentBoxRight', $contentBoxRight);
    $te->assign('year', date('Y'));

    $hoverStyle_tpl = '';
    $hoverJS_tpl = '';
    if(file_exists(str_replace('/', '', IMAGESDIR).'/motive/'.$urlName.'-hover-tl.jpg'))
    {
        $myTE = new TemplateEngine;
        $myTE->assign('urlName', $urlName);
        $myTE->assign('positionUpper', 'TL');
        $myTE->assign('position', 'tl');
        $myTE->assign('linkTo', $myContent_class->motiveLinkTL);
        $hoverJS_tpl .= $myTE->display($GLOBALS["hoverJSTemplate"]);
        $hoverStyle_tpl .= $myTE->display($GLOBALS["hoverStyleTemplate"]);
        unset($myTE);
    }
    if(file_exists(str_replace('/', '', IMAGESDIR).'/motive/'.$urlName.'-hover-tr.jpg'))
    {
        $myTE = new TemplateEngine;
        $myTE->assign('urlName', $urlName);
        $myTE->assign('positionUpper', 'TR');
        $myTE->assign('position', 'tr');
        $myTE->assign('linkTo', $myContent_class->motiveLinkTR);
        $hoverJS_tpl .= $myTE->display($GLOBALS["hoverJSTemplate"]);
        $hoverStyle_tpl .= $myTE->display($GLOBALS["hoverStyleTemplate"]);
        unset($myTE);
    }
    if(file_exists(str_replace('/', '', IMAGESDIR).'/motive/'.$urlName.'-hover-bl.jpg'))
    {
        $myTE = new TemplateEngine;
        $myTE->assign('urlName', $urlName);
        $myTE->assign('positionUpper', 'BL');
        $myTE->assign('position', 'bl');
        $myTE->assign('linkTo', $myContent_class->motiveLinkBL);
        $hoverJS_tpl .= $myTE->display($GLOBALS["hoverJSTemplate"]);
        $hoverStyle_tpl .= $myTE->display($GLOBALS["hoverStyleTemplate"]);
        unset($myTE);
    }
    if(file_exists(str_replace('/', '', IMAGESDIR).'/motive/'.$urlName.'-hover-br.jpg'))
    {
        $myTE = new TemplateEngine;
        $myTE->assign('urlName', $urlName);
        $myTE->assign('positionUpper', 'BR');
        $myTE->assign('position', 'br');
        $myTE->assign('linkTo', $myContent_class->motiveLinkBR);
        $hoverJS_tpl .= $myTE->display($GLOBALS["hoverJSTemplate"]);
        $hoverStyle_tpl .= $myTE->display($GLOBALS["hoverStyleTemplate"]);
        unset($myTE);
    }

    $te->assign('hoverJS', $hoverJS_tpl);
    $te->assign('hoverStyle', $hoverStyle_tpl);
    $main = $te->display($GLOBALS["mainTemplate"]);

    echo $main;

//#####################################################################################################
    function getMenuContent($parent_id, $myLang = 'de', $parentUrl = '', &$te)
    {
        $myMenu_class = new MenuClass;
        $myMenu_array = $myMenu_class->getMenuByParentIdF($parent_id, $myLang);
        $myMenu_count = count($myMenu_array);

        $content_tmp = '';

        for($i = 0; $i < $myMenu_count; $i++)
        {
            $myChildsTE = new TemplateEngine;
            $myChildsTE->assign('imagesdir',IMAGESDIR);
            $myChildsTE->assign('cssdir',CSSDIR);
            $myChildsTE->assign('jsdir',JSDIR);
            $myChildsTE->assign($myMenu_array[$i], '');
            if($parentUrl !== '')
            {
                $myMenu_array[$i]->urlName = $parentUrl.'/'.$myMenu_array[$i]->urlName;
                $myChildsTE->assign('urlName', $myMenu_array[$i]->urlName);
            }
            if($myMenu_array[$i]->urlName === $_REQUEST["one"])
            {
                $myChildsTE->assign('onCat', 'class="onCat"');
                $te->assign('menucolor', $myMenu_array[$i]->color);
            }
            if($i === 0 && 0 < $myMenu_array[$i]->parent_id)
            {
                $myChildsTE->assign('class', 'class="first"');
            }
            $content_tmp .= $myChildsTE->display($GLOBALS["menuListItemTemplate"]);
            if($myMenu_array[$i]->checkForchilds())
            {
                $content_tmp = substr($content_tmp, 0, -6);
                $content_tmp .= '<ul>';
                $content_tmp .= getMenuContent($myMenu_array[$i]->id, $myLang, $myMenu_array[$i]->urlName, $te);
                $content_tmp .= '</ul></li>';
            }
        }
        return $content_tmp;
    }
    function setContactFormValues(&$te)
    {
        $te->assign('formName', $_REQUEST["name"]);
        $te->assign('formStrasse', $_REQUEST["strasse"]);
        $te->assign('formPlzCity', $_REQUEST["plzCity"]);
        $te->assign('formTelefon', $_REQUEST["telefon"]);
        $te->assign('formEmail', $_REQUEST["email"]);
        $te->assign('formNachricht', $_REQUEST["nachricht"]);
        $te->assign('errorMessage', 'Der eingebene Code ist falsch. Bitte probieren Sie es nochmal.');
        $te->assign('message', $te->display($GLOBALS["messageErrorTemplate"]));
    }
    function setNewsletterSigninFormValues(&$te)
    {
        $te->assign('formFirstname', $_REQUEST["firstname"]);
        $te->assign('formLastname', $_REQUEST["lastname"]);
        $te->assign('formEmail', $_REQUEST["email"]);
        if('1' === $_REQUEST["html"])
        {
            $te->assign('checkedHtml1', 'checked="checked"');
        }
        if(isset($_REQUEST["gender"]))
        {
            $te->assign('checkedGender'.$_REQUEST["gender"], 'checked="checked"');
        }
        $te->assign('errorMessage', 'Der eingebene Code ist falsch. Bitte probieren Sie es nochmal.');
        $te->assign('message', $te->display($GLOBALS["messageErrorTemplate"]));
    }
?>
