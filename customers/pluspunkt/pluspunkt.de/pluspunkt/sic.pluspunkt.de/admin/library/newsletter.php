<?php
    
    $teNewsletter = new TemplateEngine;

    $teNewsletter->assign("imagesdir",IMAGESDIR);
    $teNewsletter->assign("cssdir",CSSDIR);
    $teNewsletter->assign("jsdir",JSDIR);
    $teNewsletter->assign("HTTP_REFERER",$_SERVER["HTTP_REFERER"]);
    setOnsite($teNewsletter);

    $privilegeName = $_SESSION["user"]->privilege;

    if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
    {
        if($_SESSION["two"] === 'newsletterCategory' && $_REQUEST["todo"] === 'insert')
        {
            $myNewsletterCategory_class = new NewsletterCategoryClass;

            $myNewsletterCategory_class->lang = 'de';
            $myNewsletterCategory_class->name = $_REQUEST["name"];
            $myNewsletterCategory_class->description = $_REQUEST["description"];
            $myNewsletterCategory_class->position = $_REQUEST["position"];
            $myNewsletterCategory_class->insert();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/newsletterCategory/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/newsletterCategory/edit/'.$myNewsletterCategory_class->id);
                exit;
            }/* else */
        }// if($_SEESION["two"] === 'newsletterCategory' && $_REQUEST["todo"] === 'insert')
        if($_SESSION["two"] === 'newsletterCategory' && $_REQUEST["todo"] === 'update')
        {
            $myNewsletterCategory_class = new NewsletterCategoryClass;

            $myNewsletterCategory_class->getNewsletterCategoryById($_REQUEST["id"]);

            $myNewsletterCategory_class->lang = 'de';
            $myNewsletterCategory_class->name = $_REQUEST["name"];
            $myNewsletterCategory_class->description = $_REQUEST["description"];
            $myNewsletterCategory_class->position = $_REQUEST["position"];
            $myNewsletterCategory_class->update();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/newsletterCategory/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/newsletterCategory/edit/'.$myNewsletterCategory_class->id);
                exit;
            }/* else */
        }// if($_SEESION["two"] === 'newsletterCategory' && $_REQUEST["todo"] === 'insert')
        if($_SESSION["two"] !== 'newsletterCategory' && $_REQUEST["todo"] === 'insert')
        {
            $myNewsletter_class = new NewsletterClass;
            $myPublicDate = new DateTime($_REQUEST["publicDate"]);

            $myNewsletter_class->title = $_REQUEST["title"];
            $myNewsletter_class->teaser = $_REQUEST["teaser"];
            $myNewsletter_class->author = $_REQUEST["author"];
            $myNewsletter_class->article = $_REQUEST["article"];
            $myNewsletter_class->publicDate = $myPublicDate->format('Y-m-d');
            $myNewsletter_class->newsletter_category_id = $_REQUEST["newsletter_category_id"];
            $myNewsletter_class->insert();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/edit/'.$myNewsletter_class->id);
                exit;
            }/* else */
        }// if($_REQUEST["todo"] === 'insert')
        if($_SESSION["two"] !== 'newsletterCategory' && $_REQUEST["todo"] === 'update')
        {
            $myNewsletter_class = new NewsletterClass;
            $myPublicDate = new DateTime($_REQUEST["publicDate"]);

            $myNewsletter_class->getNewsletterById($_REQUEST["id"]);

            $myNewsletter_class->title = $_REQUEST["title"];
            $myNewsletter_class->teaser = $_REQUEST["teaser"];
            $myNewsletter_class->author = $_REQUEST["author"];
            $myNewsletter_class->article = $_REQUEST["article"];
            $myNewsletter_class->publicDate = $myPublicDate->format('Y-m-d');
            $myNewsletter_class->newsletter_category_id = $_REQUEST["newsletter_category_id"];
            $myNewsletter_class->update();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/edit/'.$myNewsletter_class->id);
                exit;
            }/* else */
        }// if($_REQUEST["todo"] === 'update')
        if($_SESSION["two"] === 'switchVisible' && $_SESSION["three"] != '')
        {
            $myNewsletter_class = new NewsletterClass;
            $myNewsletter_class->getNewsletterById($_SESSION["three"]);
            $myNewsletter_class->switchVisible();
            header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/overview/');
            exit;
        }
//######################################################################################################################
//######################################################################################################################
//######################################################################################################################
        if($_SESSION["one"] != "")
        {
            if(file_exists($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]))
            {
                $teNewsletter->assign("subMenu",$teNewsletter->display($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]));
            }
        }/*if($_SESSION["one"] != "") */
//######################################################################################################################
//##### OVERVIEW #######################################################################################################
//######################################################################################################################
        if($_SESSION["two"] == "" || $_SESSION["two"] === 'overview')
        {
            $myNewsletter_class = new NewsletterClass;
            $myNewsletterCategory_class = new NewsletterCategoryClass;

            $newsletterList_tmp = '';
            foreach($myNewsletterCategory_class->getNewsletterCategories(LANG) as $Category)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign('newsletterCategoryName', $Category->name);

                $myTE->assign('newsletterList', getNewsletterTpl($Category->id));
                $newsletterList_tmp .= $myTE->display($GLOBALS["newsletterOverviewCategoryTemplate"]);

            }// foreach($myNewsletter_class->getAppointmnets() as $myNewsletter)

            $teNewsletter->assign('newsletterList', $newsletterList_tmp);
            $teNewsletter->assign('contentContent', $teNewsletter->display($GLOBALS["newsletterOverviewTemplate"]));
        }// if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
//######################################################################################################################
//##### ADD ############################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'add')
        {
            $myNewsletterCategory_class = new NewsletterCategoryClass;

            $newsletterCategory_tpl = '';
            foreach($myNewsletterCategory_class->getNewsletterCategories(LANG) as $Category)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign('value', $Category->id);
                $myTE->assign('text', $Category->name);
                if($Category->id === $myNewsletter_class->newsletter_category_id)
                {
                    $myTE->assign('selected', 'selected="selected"');
                }
                $newsletterCategory_tpl .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }

            $teNewsletter->assign('newsletterCategoryList', $newsletterCategory_tpl);
            $teNewsletter->assign('todo', 'insert');
            $teNewsletter->assign('todoHeadline', 'Hinzuf&uuml;gen');
            $teNewsletter->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/overview/');
            $teNewsletter->assign('contentContent', $teNewsletter->display($GLOBALS["newsletterDetailTemplate"]));
        }// elseif($_SESSION["two"] === 'add')
//######################################################################################################################
//##### EDIT ###########################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'edit')
        {
            $myNewsletter_class = new NewsletterClass;
            $myNewsletterCategory_class = new NewsletterCategoryClass;

            $myNewsletter_class->getNewsletterById($_SESSION["three"]);
            
            $newsletterCategory_tpl = '';
            foreach($myNewsletterCategory_class->getNewsletterCategories(LANG) as $Category)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign('value', $Category->id);
                $myTE->assign('text', $Category->name);
                if($Category->id === $myNewsletter_class->newsletter_category_id)
                {
                    $myTE->assign('selected', 'selected="selected"');
                }
                $newsletterCategory_tpl .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }

            $teNewsletter->assign($myNewsletter_class, '');
            $teNewsletter->assign('newsletterCategoryList', $newsletterCategory_tpl);
            $teNewsletter->assign('todo', 'update');
            $teNewsletter->assign('todoHeadline', 'Bearbeiten');
            $teNewsletter->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/overview/');
            $teNewsletter->assign('contentContent', $teNewsletter->display($GLOBALS["newsletterDetailTemplate"]));
        }// elseif($_SESSION["two"] === 'edit')
//######################################################################################################################
//##### CATEGORY #######################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'newsletterCategory')
        {
            if($_SESSION["three"] === 'overview')
            {
                $myNewsletterCategory_class = new NewsletterCategoryClass;

                $newsletterCategory_tpl = '';
                foreach($myNewsletterCategory_class->getNewsletterCategories(LANG) as $Category)
                {
                    $myTE = new TemplateEngine;
                    $myTE->assign("imagesdir",IMAGESDIR);
                    $myTE->assign("cssdir",CSSDIR);
                    $myTE->assign("jsdir",JSDIR);

                    $myTE->assign($Category, '');
                    $newsletterCategory_tpl .= $myTE->display($GLOBALS["newsletterCategoryOverviewListItemTemplate"]);
                }// foreach($myNewsletterCategory_class->getNewsletterCategories(LANG) as $Category)

                $teNewsletter->assign('newsletterCategoryList', $newsletterCategory_tpl);
                $teNewsletter->assign('contentContent', $teNewsletter->display($GLOBALS["newsletterCategoryOverviewTemplate"]));
            }// if($_SESSION["three"] === 'overview')
            elseif($_SESSION["three"] === 'edit')
            {
                $myNewsletterCategory_class = new NewsletterCategoryClass;

                $myNewsletterCategory_class->getNewsletterCategoryById($_SESSION["four"]);

                $teNewsletter->assign($myNewsletterCategory_class, '');
                $teNewsletter->assign('todo', 'update');
                $teNewsletter->assign('todoHeadline', 'Bearbeiten');
                $teNewsletter->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/newsletterCategory/overview/');
                $teNewsletter->assign('contentContent', $teNewsletter->display($GLOBALS["newsletterCategoryDetailTemplate"]));
            }// elseif($_SESSION["three"] === 'edit')
            elseif($_SESSION["three"] === 'add')
            {
                $teNewsletter->assign('todo', 'insert');
                $teNewsletter->assign('todoHeadline', 'Hinzuf&uuml;gen');
                $teNewsletter->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/newsletter/newsletterCategory/overview/');
                $teNewsletter->assign('contentContent', $teNewsletter->display($GLOBALS["newsletterCategoryDetailTemplate"]));
            }// elseif($_SESSION["three"] === 'add')
        }// elseif($_SESSION["two"] === 'newsletterCategory')
        $teNewsletter->assign('subMenuTitle', '&nbsp;');
        $content = $teNewsletter->display($GLOBALS["contentTemplate"]);
    }//if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
//######################################################################################################################
//##### FUNCTIONS ######################################################################################################
//######################################################################################################################
    function getNewsletterTpl($newsletter_category_id)
    {
        $myNewsletter_class = new NewsletterClass;
        $myNewsletter_array = $myNewsletter_class->getNewsletterByCategoryId($newsletter_category_id);
        $myNewsletter_count = count($myNewsletter_array);

        $content_tmp = '';

        for($i = 0; $i < $myNewsletter_count; $i++)
        {
            $myChildsTE = new TemplateEngine;
            $myChildsTE->assign("imagesdir",IMAGESDIR);
            $myChildsTE->assign("cssdir",CSSDIR);
            $myChildsTE->assign("jsdir",JSDIR);
            $myChildsTE->assign($myNewsletter_array[$i], '');
            $myChildsTE->assign('switchVisibleUrl', '/admin/newsletter/switchVisible/'.$myNewsletter_array[$i]->id);
            $content_tmp .= $myChildsTE->display($GLOBALS["newsletterOverviewListItemTemplate"]);
        }
        return $content_tmp;
    }
?>
