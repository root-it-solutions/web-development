<?php

    $myContent_class = new ContentClass;
    $myMenu_class = new MenuClass;

    if($_REQUEST["four"] != '')
    {
        $myMenu_class->getMenuByUrlName($_REQUEST["four"]);
        $urlName = $myMenu_class->urlName;
    }
    elseif($_REQUEST["three"] != '')
    {
        $myMenu_class->getMenuByUrlName($_REQUEST["three"]);
        $urlName = $myMenu_class->urlName;
    }
    elseif($_REQUEST["two"] != '')
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

        $siteTitle = $myContent_class->title;

        $te->assign($myMenu_class, '');
        $te->assign('menucolor', $myMenu_class->color);
        $te->assign($myContent_class, '');

        $metaDescription = $myContent_class->metaDescription;
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

            $siteTitle = $myContent_class->title;

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
            if($myContent_class->contentShort != '')
            {
                $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."ShortTemplate"]);
            }
            else
            {
                $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."Template"]);
            }
        }
        else
        {
            header('Location: http://'.$_SERVER["HTTP_HOST"]);
            exit;
        }
    }
?>
