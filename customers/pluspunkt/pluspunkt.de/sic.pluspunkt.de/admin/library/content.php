<?php
    
    $teContent = new TemplateEngine;

    $teContent->assign('imagesdir',IMAGESDIR);
    $teContent->assign('cssdir',CSSDIR);
    $teContent->assign('jsdir',JSDIR);
    $teContent->assign('HTTP_REFERER', '/admin/content/overview');
    setOnsite($teContent);

    $privilegeName = $_SESSION["user"]->privilege;

    if(($privilegeName === 'admin' || $privilegeName === 'agency_admin' || $privilegeName === 'webmaster'  || $privilegeName === 'user'))
    {
        if($_REQUEST["todo"] === 'insert')
        {
            $myContent_class = new ContentClass;
            $myMenu_class = new MenuClass;
            $myMenuParent_class = new MenuClass;

            $myMenu_class->lang = 'de';
            $myContent_class->title = $_REQUEST["title"];
            $myContent_class->motive_id = $_REQUEST["motive_id"];
            $myContent_class->content = str_replace("'", "\'", $_REQUEST["content"]);
            $myContent_class->phpFile = $_REQUEST["phpFile"];
            $myContent_class->user_id = $_SESSION["user"]->id;
            $myContent_class->insert();

            if(0 < $_REQUEST["menu_id"])
            {
                $myMenuParent_class->getMenuById($_REQUEST["menu_id"]);
                $myMenu_class->color = $myMenuParent_class->color;
            }
            $myMenu_class->name = $_REQUEST["name"];
            $myMenu_class->urlName = getUrlFriendlyText($_REQUEST["urlName"]);
            $myMenu_class->parent_id = $_REQUEST["menu_id"];
            $myMenu_class->position = $_REQUEST["position"];
            $myMenu_class->content_id = $myContent_class->id;
            $myMenu_class->template_id = $_REQUEST["template_id"];
            $myMenu_class->visible = $_REQUEST["visible"];
            $myMenu_class->insert();

            //echo var_dump($myContent_class);exit;
            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/content/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/content/edit/'.$myContent_class->id);
                exit;
            }/* else */
        }
        if($_REQUEST["todo"] === 'update' && $_REQUEST["id"] != '')
        {
            $myContent_class = new ContentClass;
            $myContent_class->getContentById($_REQUEST["content_id"]);
            $myMenu_class = new MenuClass;
            $myMenu_class->getMenuById($_REQUEST["id"]);

            $myContent_class->title = $_REQUEST["title"];
            $myContent_class->motive_id = $_REQUEST["motive_id"];
            $myContent_class->content = str_replace("'", "\'", $_REQUEST["content"]);
            $myContent_class->metaSitetitle = $_REQUEST["metaSitetitle"];
            $myContent_class->metaKeywords = $_REQUEST["metaKeywords"];
            $myContent_class->metaDescription = $_REQUEST["metaDescription"];
            $myContent_class->phpFile = $_REQUEST["phpFile"];
            $myContent_class->update();

            $myMenu_class->lang = 'de';
            $myMenu_class->name = $_REQUEST["name"];
            $myMenu_class->urlName = getUrlFriendlyText($_REQUEST["urlName"]);
            $myMenu_class->parent_id = $_REQUEST["menu_id"];
            $myMenu_class->position = $_REQUEST["position"];
            $myMenu_class->visible = $_REQUEST["visible"];
            $myMenu_class->template_id = $_REQUEST["template_id"];
            $myMenu_class->update();


            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/content/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
                exit;
            }/* else */
        }
        if(($_SESSION["two"] === 'positionUp' || $_SESSION["two"] === 'positionDown') && $_SESSION["three"] != '')
        {
            $myMenu_class = new MenuClass;
            $myMenu_class->getMenuById($_SESSION["three"]);
            if(0 != $myMenu_class->parent_id)
            {
                $myMenu_class->positionUpDown($_SESSION["two"]);
            }
            header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/content/overview/');
            exit;
        }
        if($_SESSION["two"] === 'switchVisible' && $_SESSION["three"] != '')
        {
            $myMenu_class = new MenuClass;
            $myMenu_class->getMenuById($_SESSION["three"]);
            if(0 != $myMenu_class->parent_id)
            {
                $myMenu_class->switchVisible();
            }
            header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/content/overview/');
            exit;
        }
        if($_SESSION["one"] != "")
        {
            if(file_exists($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]))
            {
                $teContent->assign("subMenu",$teContent->display($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]));
            }
        }/*if($_SESSION["one"] != "") */

//######################################################################################################################
//##### OVERVIEW #######################################################################################################
//######################################################################################################################
        if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
        {
            $myMenu_class = new MenuClass;
            $myContents_class = new ContentClass;

            $contentMenuList_tmp = '';
            foreach($myMenu_class->getLanguages() as $myLang)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign('lang', $GLOBALS["array_language"][$myLang]);
                $myTE->assign('menuList', getMenuContent(0, $myLang));
                $contentMenuList_tmp .= $myTE->display($GLOBALS["contentMenuOverviewLangTemplate"]);

            }// foreach($myMenu_class->getLanguages() as $myLang)

            /*
            $contentList_tmp = '';
            foreach($myMenu_class->getMenuParent() as $Menu)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                $myTE->assign($Menu, '');
                $myTE->assign('switchVisibleUrl', 'javascript:void(0);');
                //$myTE->assign('show', 'style="display:none;"');

                $myChilds_class = new ContentClass;
                $myChilds_array = $myChilds_class->getContentChilds($Content->id);
                $myChilds_count = count($myChilds_array);

                if(0 < $myChilds_count)
                {
                    $childs_tmp = '<ul>';
                    for($i = 0; $i < $myChilds_count; $i++)
                    {
                        $myChildsTE = new TemplateEngine;
                        $myChildsTE->assign("imagesdir",IMAGESDIR);
                        $myChildsTE->assign("cssdir",CSSDIR);
                        $myChildsTE->assign("jsdir",JSDIR);
                        $myChildsTE->assign($myChilds_array[$i], '');
                        $myChildsTE->assign('switchVisibleUrl', '/admin/content/switchVisible/'.$myChilds_array[$i]->id);
                        $myChildsTE->assign('positionUpUrl', '/admin/content/positionUp/'.$myChilds_array[$i]->id);
                        $myChildsTE->assign('positionDownUrl', '/admin/content/positionDown/'.$myChilds_array[$i]->id);
                        $childs_tmp .= $myChildsTE->display($GLOBALS["contentOverviewListItemTemplate"]);
                    }
                    $childs_tmp .= '</ul>';
                }
                else
                {
                    $childs_tmp = '';
                }
                $myTE->assign('childList', $childs_tmp);
                $contentList_tmp .= $myTE->display($GLOBALS["contentOverviewListItemTemplate"]);
            }
            */
            $teContent->assign('contentMenuList', $contentMenuList_tmp);
            $teContent->assign('contentContent', $teContent->display($GLOBALS["contentOverviewTemplate"]));
            $content = $teContent->display($GLOBALS["contentTemplate"]);
        }/*if($_SESSION["two"] == "" || $_SESSION["two"] === 'overview') */
//######################################################################################################################
//##### EDIT ###########################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === "edit" && $_SESSION["three"] != '')
        {
            $myMenu_class = new MenuClass;
            $myMenu_class->getMenuById($_SESSION["three"]);
            $myContent_class = new ContentClass;
            $myContent_class->getContentById($myMenu_class->content_id);
            $myMotive_class = new MotiveClass;
            $myTemplate_class = new TemplateClass;
            $menu_tmp = '';
            $motive_tmp = '';
            $template_tmp = '';

            foreach($myTemplate_class->getTemplates() as $Template)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                $myTE->assign('value', $Template->id);
                $myTE->assign('text', $Template->name);
                if($Template->id == $myMenu_class->template_id)
                {
                    $myTE->assign('selected', 'selected="selected"');
                } 
                $template_tmp .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }
            $teContent->assign('templateList', $template_tmp);

            $teContent->assign('menuList', str_replace('select'.$myMenu_class->parent_id.'>', 'selected="selected">', getMenuContentForSelect(0, 'de', '')));

            foreach($myMotive_class->getMotive() as $Motive)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                $myTE->assign('value', $Motive->id);
                $myTE->assign('text', $Motive->name);
                if($Motive->id == $myContent_class->motive_id)
                {
                    $myTE->assign('selected', 'selected="selected"');
                }
                $motive_tmp .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }
            $teContent->assign('motiveList', $motive_tmp);

            $teContent->assign($myContent_class, '');
            $teContent->assign('content_id', $myContent_class->id);
            $teContent->assign($myMenu_class, '');
            $teContent->assign('visibleSelected'.$myMenu_class->visible, 'selected="selected"');
            $teContent->assign('todo', 'update');
            $teContent->assign('todoHeadline', 'Bearbeiten');
            $teContent->assign('contentContent', $teContent->display($GLOBALS["contentDetailTemplate"]));
            $content = $teContent->display($GLOBALS["contentTemplate"]);
        }/*elseif($_SESSION["two"] === "pages") */
//######################################################################################################################
//##### ADD ############################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === "add")
        {
            $myMenu_class = new MenuClass;
            $myMotive_class = new MotiveClass;
            $myTemplate_class = new TemplateClass;
            $menu_tmp = '';
            $motive_tmp = '';
            $template_tmp = '';

            foreach($myTemplate_class->getTemplates() as $Template)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                $myTE->assign('value', $Template->id);
                $myTE->assign('text', $Template->name);
                $template_tmp .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }
            foreach($myMotive_class->getMotive() as $Motive)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                $myTE->assign('value', $Motive->id);
                $myTE->assign('text', $Motive->name);
                $motive_tmp .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }
            $teContent->assign('templateList', $template_tmp);
            $teContent->assign('menuList', getMenuContentForSelect(0, 'de', ''));
            $teContent->assign('select1', 'selected="selected"');
            //$teContent->assign('menuList', $menu_tmp);
            $teContent->assign('motiveList', $motive_tmp);
            $teContent->assign('position', '1');
            $teContent->assign('todo', 'insert');
            $teContent->assign('todoHeadline', 'Hinzuf&uuml;gen');
            $teContent->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/content/overview/');
            $teContent->assign('contentContent', $teContent->display($GLOBALS["contentDetailTemplate"]));
        }/*elseif($_SESSION["two"] === "menu") */
        elseif($_SESSION["two"] === "motiveOverview")
        {
            $myMotive_class = new MotiveClass;

            $motive_tmp = '';

            foreach($myMotive_class->getMotive() as $Motive)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign('motiveImage', 'http://'.$_SERVER["HTTP_HOST"].'/images/motive/'.$Motive->id.'.jpg');
                $myTE->assign($Motive, '');
                $motive_tmp .= $myTE->display($GLOBALS["contentMotiveOverviewListItemTemplate"]);
            }// foreach($myMotive_class->getMotive() as $Motive)
            $teContent->assign('contentMotiveList', $motive_tmp);
            $teContent->assign('contentContent', $teContent->display($GLOBALS["contentMotiveOverviewTemplate"]));
        } // elseif($_SESSION["two"] === "motiveOverview")
        $teContent->assign('subMenuTitle', '&nbsp;');
        $content = $teContent->display($GLOBALS["contentTemplate"]);
    }/*if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user") && checkRight()) */
    else
    {
        $content = $teContent->display($GLOBALS["noPrivilegeTemplate"]);
    }/*else */

    function getMenuContentForSelect($parent_id, $myLang, $spacer)
    {
        $myMenu_class = new MenuClass;
        $myMenu_array = $myMenu_class->getMenuByParentId($parent_id, $myLang);
        $myMenu_count = count($myMenu_array);

        $content_tmp = '';

        for($i = 0; $i < $myMenu_count; $i++)
        {
            $myChildsTE = new TemplateEngine;
            $myChildsTE->assign("imagesdir",IMAGESDIR);
            $myChildsTE->assign("cssdir",CSSDIR);
            $myChildsTE->assign("jsdir",JSDIR);
            $myChildsTE->assign($myMenu_array[$i], '');
            $myChildsTE->assign('name', $spacer.$myMenu_array[$i]->name);
            $content_tmp .= $myChildsTE->display($GLOBALS["contentDetailMenuOptionTemplate"]);
            if($myMenu_array[$i]->checkForchilds())
            {
                $spacer .= '-';
                $content_tmp .= getMenuContentForSelect($myMenu_array[$i]->id, $myLang, $spacer);
                $spacer = substr($spacer, 0 ,-1);
            }
        }
        return $content_tmp;
    }
    function getMenuContent($parent_id, $myLang)
    {
        $myMenu_class = new MenuClass;
        $myMenu_array = $myMenu_class->getMenuByParentId($parent_id, $myLang);
        $myMenu_count = count($myMenu_array);

        $content_tmp = '';

        for($i = 0; $i < $myMenu_count; $i++)
        {
            $myChildsTE = new TemplateEngine;
            $myChildsTE->assign("imagesdir",IMAGESDIR);
            $myChildsTE->assign("cssdir",CSSDIR);
            $myChildsTE->assign("jsdir",JSDIR);
            $myChildsTE->assign($myMenu_array[$i], '');
            $myChildsTE->assign('switchVisibleUrl', '/admin/content/switchVisible/'.$myMenu_array[$i]->id);
            $myChildsTE->assign('positionUpUrl', '/admin/content/positionUp/'.$myMenu_array[$i]->id);
            $myChildsTE->assign('positionDownUrl', '/admin/content/positionDown/'.$myMenu_array[$i]->id);
            if(0 == $myMenu_array[$i]->parent_id)
            {
                $myChildsTE->assign('show', 'style="display:none;"');
            }
            $content_tmp .= $myChildsTE->display($GLOBALS["contentOverviewListItemTemplate"]);
            if($myMenu_array[$i]->checkForchilds())
            {
                $content_tmp .= '<ul>';
                $content_tmp .= getMenuContent($myMenu_array[$i]->id, $myLang);
                $content_tmp .= '</ul>';
            }
        }
        return $content_tmp;
    }
?>
