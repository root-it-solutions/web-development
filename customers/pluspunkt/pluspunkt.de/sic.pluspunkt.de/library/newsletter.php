<?php
    $myContent_class = new ContentClass;
    $myMenu_class = new MenuClass;

    $myMenu_class->getMenuByUrlName($_REQUEST["two"]);
    $myContent_class->getContentById($myMenu_class->content_id);

    $siteTitle = $myContent_class->title;

    $myNewsletter_class = new NewsletterClass;
    $myNewsletterCategory_class = new NewsletterCategoryClass;

    if($_REQUEST["three"] == '')
    {
        $newsletter_tpl = '';

        $te->assign('checkedHtml1', 'checked="checked"');
        $te->assign('checkedGender0', 'checked="checked"');
        $newsletter_tpl .= $te->display($GLOBALS["newsletterSigninButtonTemplate"]);

        foreach($myNewsletterCategory_class->getNewsletterCategories(LANG) as $Category)
        {
            if($_REQUEST["two"] === 'newsletter' && $Category->name === 'Aktuelles')
            {
                $te->assign('newsletterCategoryName', $Category->name);

                $tpl = '';
                foreach($myNewsletter_class->getNewsletterByCategoryIdFE($Category->id) as $Newsletter)
                {
                    $te->assign($Newsletter, '');
                    $te->assign('url', '/home/newsletter/'.$Newsletter->id.'/'.getUrlFriendlytext($Newsletter->title).'.html');
                    $tpl .= $te->display($GLOBALS["newsletterListItemTemplate"]);
                }
                $te->assign('newsletterList', $tpl);
                $newsletter_tpl .= $te->display($GLOBALS["newsletterTemplate"]);
            }
            if($_REQUEST["two"] === 'newsletterarchiv' && $Category->name !== 'Aktuelles')
            {
                $te->assign('newsletterCategoryName', $Category->name);

                $tpl = '';
                foreach($myNewsletter_class->getNewsletterByCategoryIdFE($Category->id) as $Newsletter)
                {
                    $te->assign($Newsletter, '');
                    $te->assign('url', '/home/newsletterarchiv/'.$Newsletter->id.'/'.getUrlFriendlytext($Newsletter->title).'.html');
                    $tpl .= $te->display($GLOBALS["newsletterListItemTemplate"]);
                }
                $te->assign('newsletterList', $tpl);
                $newsletter_tpl .= $te->display($GLOBALS["newsletterTemplate"]);
            }
        }
    }// if($_SESSION["three"] == '')
    elseif($_REQUEST["three"] === 'submit' && $_REQUEST["four"] != '')
    {
        $myContent_class->title = 'Newsletter Anmeldung';
        $siteTitle = $myContent_class->title;
        $myNewsletterSubscriber_class = new NewsletterSubscriberClass;

        if($myNewsletterSubscriber_class->activateSubscriber($_REQUEST["four"]))
        {
            $newsletter_tpl = $te->display($GLOBALS["newsletterRegistrationSuccessTemplate"]);
        }
        else
        {
            $newsletter_tpl = $te->display($GLOBALS["newsletterRegistrationErrorTemplate"]);
        }
    }
    else
    {
        $myNewsletter_class = new NewsletterClass;

        $myNewsletter_class->getNewsletterById($_REQUEST["three"]);

        if(0 < $myNewsletter_class->id)
        {
            $te->assign($myNewsletter_class, '');
            if($myNewsletter_class->author !== '')
            {
                $te->assign('authorHeadline', $te->display($GLOBALS["newsletterAuthorTemplate"]));
            }
            $newsletter_tpl = $te->display($GLOBALS["newsletterDetailTemplate"]);
            $siteTitle = $myNewsletter_class->title.' - '.$myContent_class->title;
        }
        else
        {
            header('Location: http://'.$_SERVER["HTTP_HOST"].'/home/newsletter');
            exit;
        }
    }

    $te->assign('title', $myContent_class->title);
    $te->assign('content', $newsletter_tpl);
    $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."Template"]);
    $te->assign('motive_id', 'noimage');
?>
