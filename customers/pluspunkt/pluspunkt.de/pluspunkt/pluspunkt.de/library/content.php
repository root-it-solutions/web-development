<?php

    $myContent_class = new ContentClass;
    $myMenu_class = new MenuClass;

    if(isset($_REQUEST["four"]) && $_REQUEST["four"] != '')
    {
        $myMenu_class->getMenuByUrlName($_REQUEST["four"]);
        $urlName = $myMenu_class->urlName;
    }
    elseif(isset($_REQUEST["three"]) && $_REQUEST["three"] != '')
    {
        $myMenu_class->getMenuByUrlName($_REQUEST["three"]);
        $urlName = $myMenu_class->urlName;
    }
    elseif(isset($_REQUEST["two"]) && $_REQUEST["two"] != '')
    {
        $myMenu_class->getMenuByUrlName($_REQUEST["two"]);
        $urlName = $myMenu_class->urlName;
        if($_REQUEST["two"] === 'anmeldung' && $_REQUEST["one"] === 'inspiration')
        {
            $myMenu_class->getInvisibleMenuByUrlName($_REQUEST["two"]);
            $urlName = $myMenu_class->urlName;
        }
    }
    elseif($_REQUEST["one"] != '')
    {
        if($_REQUEST["one"] === 'impressum')
        {
            $myMenu_class->getInvisibleMenuByUrlName($_REQUEST["one"]);
        }
        else
        {
            $myMenu_class->getMenuByUrlName($_REQUEST["one"]);
        }
        $urlName = $myMenu_class->urlName;
    }
    else
    {
        $myMenu_class->getMenuByFirstPosition();
        $myContent_class->getContentById($myMenu_class->content_id);
        $urlName = $myMenu_class->urlName;

        //$siteTitle = ' - '.$myContent_class->title;
        $logoText = $myContent_class->logoText;

        $te->assign($myMenu_class, '');
        $te->assign('menucolor', $myMenu_class->color);
        $te->assign($myContent_class, '');

        $metaDescription = $myContent_class->metaDescription;
        $metaKeywords = $myContent_class->metaKeywords;
        $metaAdditional = $te->display($GLOBALS["homeMetaTemplate"]);
        if(0 == $myContent_class->motive_id)
        {
             $te->assign('motive_id', 'noimage');
        }// if(0 === $myContent_class->motive_id)
        else
        {
            $myMotive = new MotiveClass($myContent_class->motive_id);
            $te->assign('motiveName', $myMotive->name);
            $te->assign('motiveTitle', $myMotive->title);
            $te->assign('motiveAlt', $myMotive->alt);
        }

        if($myContent_class->contentShort != '')
        {
            $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."ShortTemplate"]);
        }
        else
        {
            $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."Template"]);
        }
    }


    if($_REQUEST["one"] != '')
    {
        if(0 < $myMenu_class->id)
        {
            $myContent_class->getContentById($myMenu_class->content_id);

            if($myContent_class->id != 27)
            {
                if($myContent_class->siteTitle != '')
                {
                    $siteTitle = $myContent_class->siteTitle.' - ';
                }
                else
                {
                    $siteTitle = $myContent_class->title.' - ';
                }
            }

            $logoText = $myContent_class->logoText;

            $te->assign($myMenu_class, '');
            $te->assign('menucolor', $myMenu_class->color);
            $te->assign($myContent_class, '');
            if(0 == $myContent_class->motive_id)
            {
                 $te->assign('motive_id', 'noimage');
            }// if(0 === $myContent_class->motive_id)
            else
            {
                $myMotive = new MotiveClass($myContent_class->motive_id);
                $te->assign('motiveName', $myMotive->name);
                $te->assign('motiveTitle', $myMotive->title);
                $te->assign('motiveAlt', $myMotive->alt);
            }

            /*
            if($myMenu_class->urlName === 'kunden')
            {
                $te->assign('content', $te->display($GLOBALS["referenceTemplate"]));
            }//if($myMenu_class->urlName === 'kontakt')
            */
            if($myMenu_class->urlName === 'kontakt')
            {
                $te->assign('content', $te->display($GLOBALS["contactTemplate"]));
            }//elseif($myMenu_class->urlName === 'kontakt')
            elseif($myMenu_class->urlName === 'anmeldung')
            {
                $te->assign('menucolor', $myMenu_class->color);
                $te->assign('content', $te->display($GLOBALS["registrationTemplate"]));
            }//elseif($myMenu_class->urlName === 'anmeldung')

            $metaDescription = $myContent_class->metaDescription;
            $metaKeywords = $myContent_class->metaKeywords;
            if($myContent_class->contentShort != '')
            {
                $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."ShortTemplate"]);
            }
            else
            {
                $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."Template"]);
            }
            //Meta File lesen
            if(is_file(substr(TEMPLATESDIR, 1, strlen(TEMPLATESDIR))."/".$myMenu_class->urlName."Meta.tpl"))
            {
                $te->assign('dcDescription', $myContent_class->dcDescription);
                $metaAdditional = $te->display($GLOBALS[$myMenu_class->urlName."MetaTemplate"]);
            }
        }
        else
        {
            header('Location: http://'.$_SERVER["HTTP_HOST"]);
            exit;
        }
    }
?>
