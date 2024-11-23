<?php
    
    $teInspiration = new TemplateEngine;

    $teInspiration->assign("imagesdir",IMAGESDIR);
    $teInspiration->assign("cssdir",CSSDIR);
    $teInspiration->assign("jsdir",JSDIR);
    $teInspiration->assign("HTTP_REFERER",$_SERVER["HTTP_REFERER"]);
    setOnsite($teInspiration);

    $privilegeName = $_SESSION["user"]->privilege;

    if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
    {
        if($_REQUEST["todo"] === 'insert')
        {
            $myInspiration_class = new InspirationClass;

            $myInspiration_class->name = $_REQUEST["name"];
            $myInspiration_class->street = $_REQUEST["street"];
            $myInspiration_class->zipCodeCity = $_REQUEST["zipCodeCity"];
            $myInspiration_class->fon = $_REQUEST["fon"];
            $myInspiration_class->email = $_REQUEST["email"];
            $myInspiration_class->amountParents = $_REQUEST["amountParents"];
            $myInspiration_class->amountChildren = $_REQUEST["amountChildren"];
            $myInspiration_class->ageChildren = $_REQUEST["ageChildren"];
            $myInspiration_class->insert();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/inspiration/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/inspiration/edit/'.$myInspiration_class->id);
                exit;
            }/* else */
        }// if($_REQUEST["todo"] === 'insert')
        if($_REQUEST["todo"] === 'update')
        {
            $myInspiration_class = new InspirationClass;

            $myInspiration_class->getInspirationById($_REQUEST["id"]);

            $myInspiration_class->name = $_REQUEST["name"];
            $myInspiration_class->street = $_REQUEST["street"];
            $myInspiration_class->zipCodeCity = $_REQUEST["zipCodeCity"];
            $myInspiration_class->fon = $_REQUEST["fon"];
            $myInspiration_class->email = $_REQUEST["email"];
            $myInspiration_class->amountParents = $_REQUEST["amountParents"];
            $myInspiration_class->amountChildren = $_REQUEST["amountChildren"];
            $myInspiration_class->ageChildren = $_REQUEST["ageChildren"];
            $myInspiration_class->update();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/inspiration/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/inspiration/edit/'.$myInspiration_class->id);
                exit;
            }/* else */
        }// if($_REQUEST["todo"] === 'update')
	if($_REQUEST["two"] === 'delete')
	{
        $myInspiration_class = new InspirationClass;
        $myInspiration_class->getInspirationById($_REQUEST["three"]);
        if(0 < $myInspiration_class->id)
        {
            $myInspiration_class->delete();
            header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/inspiration/overview/');
            exit;
        }// if(0 < $myInspiration_class->id)
        else
        {
            // error behandeln
        }// else
	}// if($_REQUEST["todo"] === 'delete')
//######################################################################################################################
//######################################################################################################################
//######################################################################################################################
        if($_SESSION["one"] != "")
        {
            if(file_exists($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]))
            {
                $teInspiration->assign("subMenu",$teInspiration->display($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]));
            }
        }/*if($_SESSION["one"] != "") */
//######################################################################################################################
//##### OVERVIEW #######################################################################################################
//######################################################################################################################
        if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
        {
            $myInspirations_class = new InspirationClass;

            $inspirationMenuList_tmp = '';
            foreach($myInspirations_class->getInspiration() as $myInspiration)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign($myInspiration, '');
                $myStartDate = new DateTime($myInspiration->startDate);
                $myEndDate = new DateTime($myInspiration->endDate);
                $myTE->assign('startDate', $myStartDate->format('d.m.Y'));
                $myTE->assign('endDate', $myEndDate->format('d.m.Y'));

                $inspirationList_tmp .= $myTE->display($GLOBALS["inspirationOverviewListItemTemplate"]);

            }// foreach($myInspirations_class->getAppointmnets() as $myInspiration)

            $teInspiration->assign('inspirationList', $inspirationList_tmp);
            $teInspiration->assign('contentContent', $teInspiration->display($GLOBALS["inspirationOverviewTemplate"]));
        }// if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
//######################################################################################################################
//##### EDIT ###########################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'edit')
        {
            $myInspirations_class = new InspirationClass;
            $mySeminar_class = new SeminarClass;

            $myInspirations_class->getInspirationById($_REQUEST["three"]);
            $myStartDate = new DateTime($myInspirations_class->startDate);
            $myEndDate = new DateTime($myInspirations_class->endDate);
            
            $seminar_tpl = '';
            foreach($mySeminar_class->getSeminar() as $Seminar)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign('value', $Seminar->id);
                $myTE->assign('text', $Seminar->name);
                if($Seminar->id === $myInspirations_class->seminar_id)
                {
                    $myTE->assign('selected', 'selected="selected"');
                }
                $seminar_tpl .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }

            $teInspiration->assign($myInspirations_class, '');
            $teInspiration->assign('startDate', $myStartDate->format('d.m.Y'));
            $teInspiration->assign('endDate', $myEndDate->format('d.m.Y'));
            $teInspiration->assign('visibleSelected'.$myInspirations_class->visible, 'selected="selected"');
            $teInspiration->assign('seminarList', $seminar_tpl);
            $teInspiration->assign('todo', 'update');
            $teInspiration->assign('todoHeadline', 'Bearbeiten');
            $teInspiration->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/inspiration/overview/');
            $teInspiration->assign('contentContent', $teInspiration->display($GLOBALS["inspirationDetailTemplate"]));
        }// elseif($_SESSION["two"] === 'edit')
        $teInspiration->assign('subMenuTitle', '&nbsp;');
        $content = $teInspiration->display($GLOBALS["contentTemplate"]);
    }//if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
?>
