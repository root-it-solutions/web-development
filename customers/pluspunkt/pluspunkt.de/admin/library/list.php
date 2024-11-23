<?php
    
    $teList = new TemplateEngine;

    $teList->assign("imagesdir",IMAGESDIR);
    $teList->assign("cssdir",CSSDIR);
    $teList->assign("jsdir",JSDIR);
    $teList->assign("HTTP_REFERER",$_SERVER["HTTP_REFERER"]);
    setOnsite($teList);

    $privilegeName = $_SESSION["user"]->privilege;

    if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
    {
//######################################################################################################################
//######################################################################################################################
        if(isset($_REQUEST["two"]) && $_REQUEST["two"] !== 'listEntries')
        {
            if($_REQUEST["todo"] === 'insert')
            {
                $myList_class = new ListClass;

                $myList_class->lang = LANG;
                $myList_class->name = $_REQUEST["name"];
                $myList_class->description = $_REQUEST["description"];
                $myList_class->insert();

                if(isset($_REQUEST["savePageBack"]))
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/overview/');
                    exit;
                }/* if(isset($_REQUEST["savePageBack"])) */
                else
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/edit/'.$myList_class->id);
                    exit;
                }/* else */
            }// if($_REQUEST["todo"] === 'insert')
            if($_REQUEST["todo"] === 'update')
            {
                $myList_class = new ListClass;

                $myList_class->getListById($_REQUEST["id"]);

                $myList_class->name = $_REQUEST["name"];
                $myList_class->description = $_REQUEST["description"];
                $myList_class->update();

                if(isset($_REQUEST["savePageBack"]))
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/overview/');
                    exit;
                }/* if(isset($_REQUEST["savePageBack"])) */
                else
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/edit/'.$myList_class->id);
                    exit;
                }/* else */
            }// if($_REQUEST["todo"] === 'update')
        }// if($_REQUEST["two"] !== 'listEntries')
        elseif(isset($_REQUEST["two"]) && $_REQUEST["two"] === 'listEntries')
        {
            if(isset($_REQUEST["todo"]) && $_REQUEST["todo"] === 'insert')
            {
                $myListEntry_class = new ListEntryClass;

                $myListEntry_class->title = $_REQUEST["title"];
                $myListEntry_class->teaser = $_REQUEST["teaser"];
                $myListEntry_class->text = $_REQUEST["text"];
                $myListEntry_class->link = $_REQUEST["link"];
                $myListEntry_class->linkTarget = $_REQUEST["linkTarget"];
                $myListEntry_class->list_id = $_REQUEST["list_id"];
                $myListEntry_class->insert();

                if(isset($_REQUEST["savePageBack"]))
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/listEntries/'.$_REQUEST["list_id"].'/overview/');
                    exit;
                }/* if(isset($_REQUEST["savePageBack"])) */
                else
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/listEntries/'.$_REQUEST["list_id"].'/edit/'.$myListEntry_class->id);
                    exit;
                }/* else */
            }// if($_REQUEST["todo"] === 'insert')
            if(isset($_REQUEST["todo"]) && $_REQUEST["todo"] === 'update')
            {
                $myListEntry_class = new ListEntryClass;

                $myListEntry_class->getListEntryById($_REQUEST["id"]);

                $myListEntry_class->title = $_REQUEST["title"];
                $myListEntry_class->teaser = $_REQUEST["teaser"];
                $myListEntry_class->text = $_REQUEST["text"];
                $myListEntry_class->link = $_REQUEST["link"];
                $myListEntry_class->linkTarget = $_REQUEST["linkTarget"];
                $myListEntry_class->list_id = $_REQUEST["list_id"];
                $myListEntry_class->update();

                if(isset($_REQUEST["savePageBack"]))
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/listEntries/'.$_REQUEST["list_id"].'/overview/');
                    exit;
                }/* if(isset($_REQUEST["savePageBack"])) */
                else
                {
                    header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/list/listEntries/'.$_REQUEST["list_id"].'/edit/'.$myListEntry_class->id);
                    exit;
                }/* else */
            }// if($_REQUEST["todo"] === 'update')
        }// if($_REQUEST["two"] !== 'listEntries')
//######################################################################################################################
//######################################################################################################################
 
//######################################################################################################################
//##### OVERVIEW #######################################################################################################
//######################################################################################################################
        if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
        {
            $myLists_class = new ListClass;

            $listList_tmp = '';
            foreach($myLists_class->getLists() as $myList)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign($myList, '');

                $listList_tmp .= $myTE->display($GLOBALS["listOverviewListItemTemplate"]);

            }// foreach($myLists_class->getAppointmnets() as $myList)

            $teList->assign('listList', $listList_tmp);
            $teList->assign('contentContent', $teList->display($GLOBALS["listOverviewTemplate"]));
        }// if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
//######################################################################################################################
//##### ADD ############################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'add')
        {
            $teList->assign('todo', 'insert');
            $teList->assign('todoHeadline', 'Hinzuf&uuml;gen');
            $teList->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/list/overview/');
            $teList->assign('contentContent', $teList->display($GLOBALS["listDetailTemplate"]));
        }// elseif($_SESSION["two"] === 'add')
//######################################################################################################################
//##### EDIT ###########################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'edit')
        {
            $myList_class = new ListClass;

            $myList_class->getListById($_REQUEST["three"]);
            
            $teList->assign($myList_class, '');
            $teList->assign('todo', 'update');
            $teList->assign('todoHeadline', 'Bearbeiten');
            $teList->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/list/overview/');
            $teList->assign('contentContent', $teList->display($GLOBALS["listDetailTemplate"]));
        }// elseif($_SESSION["two"] === 'edit')
//######################################################################################################################
//##### EDIT ENTRIES ###################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'listEntries' && $_SESSION["three"] !== '')
        {
            if($_SESSION["four"] === 'overview')
            {
                $myList_class = new ListClass;
                $myListEntries_class = new ListEntryClass;

                $myList_class->getListById($_REQUEST["three"]);
                
                $listEntries_tpl = '';

                foreach($myListEntries_class->getEntriesByListId($myList_class->id) as $Entry)
                {
                    $myTE = new TemplateEngine;
                    $myTE->assign("imagesdir",IMAGESDIR);
                    $myTE->assign("cssdir",CSSDIR);
                    $myTE->assign("jsdir",JSDIR);
                    
                    $myTE->assign($Entry, '');

                    $myTE->assign('list_id', $myList_class->id);
                    $listEntries_tpl .= $myTE->display($GLOBALS["listEntriesOverviewListItemTemplate"]);
                }

                $teList->assign('listName', $myList_class->name);
                $teList->assign('list_id', $myList_class->id);
                $teList->assign('listEntriesList', $listEntries_tpl);
                $teList->assign('contentContent', $teList->display($GLOBALS["listEntriesOverviewTemplate"]));
            }// if($_SESSION["four"] === 'overview')
            elseif($_SESSION["four"] === 'edit')
            {
                $myList_class = new ListClass;
                $myListEntries_class = new ListEntryClass;

                $myList_class->getListById($_REQUEST["three"]);
                $myListEntries_class->getListEntryById($_REQUEST["five"]);

                $teList->assign($myListEntries_class, '');
                $teList->assign('selected'.$myListEntries_class->linkTarget, 'selected="selected"');
                $teList->assign('todo', 'update');
                $teList->assign('todoHeadline', 'Bearbeiten');
                $teList->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/list/listEntries/'.$myList_class->id.'/overview/');
                $teList->assign('contentContent', $teList->display($GLOBALS["listEntriesDetailTemplate"]));
            }// elseif($_SESSION["four"] === 'edit')
            elseif($_SESSION["four"] === 'add')
            {
                $myList_class = new ListClass;
                $myList_class->getListById($_REQUEST["three"]);

                $teList->assign('list_id', $myList_class->id);
                $teList->assign('list_id', $myList_class->id);
                $teList->assign('todo', 'insert');
                $teList->assign('todoHeadline', 'Hinzuf&uuml;gen');
                $teList->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/list/listEntries/'.$myList_class->id.'/overview/');
                $teList->assign('contentContent', $teList->display($GLOBALS["listEntriesDetailTemplate"]));
            }// elseif($_SESSION["four"] === 'add')
        }// elseif($_SESSION["two"] === 'edit')
//######################################################################################################################
//######################################################################################################################
//######################################################################################################################
        if($_SESSION["one"] != "")
        {
            if(isset($GLOBALS[$_SESSION["two"]."SubMenuTemplate"]) && file_exists($GLOBALS[$_SESSION["two"]."SubMenuTemplate"]))
            {
                $teList->assign("subMenu",$teList->display($GLOBALS[$_SESSION["two"]."SubMenuTemplate"]));
            }
            elseif(file_exists($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]))
            {
                $teList->assign("subMenu",$teList->display($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]));
            }
        }/*if($_SESSION["one"] != "") */
//######################################################################################################################
        $teList->assign('subMenuTitle', '&nbsp;');
        $content = $teList->display($GLOBALS["contentTemplate"]);
//######################################################################################################################
    }//if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
?>
