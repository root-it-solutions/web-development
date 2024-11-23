<?php
    
    $teAppointment = new TemplateEngine;

    $teAppointment->assign("imagesdir",IMAGESDIR);
    $teAppointment->assign("cssdir",CSSDIR);
    $teAppointment->assign("jsdir",JSDIR);
    $teAppointment->assign("HTTP_REFERER",$_SERVER["HTTP_REFERER"]);
    setOnsite($teAppointment);

    $privilegeName = $_SESSION["user"]->privilege;

    if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
    {
        if($_REQUEST["todo"] === 'insert')
        {
            $myAppointment_class = new AppointmentClass;
            $mySeminar_class = new SeminarClass;
            $myStartDate = new DateTime($_REQUEST["startDate"]);
            $myEndDate = new DateTime($_REQUEST["endDate"]);

            $mySeminar_class->getSeminarById($_REQUEST["seminar_id"]);

            $myAppointment_class->name = $mySeminar_class->name;
            $myAppointment_class->description = $_REQUEST["description"];
            $myAppointment_class->startDate = $myStartDate->format('Y-m-d');
            $myAppointment_class->endDate = $myEndDate->format('Y-m-d');
            $myAppointment_class->seminar_id = $_REQUEST["seminar_id"];
            $myAppointment_class->visible = $_REQUEST["visible"];
            $myAppointment_class->insert();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/appointment/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/appointment/edit/'.$myAppointment_class->id);
                exit;
            }/* else */
        }// if($_REQUEST["todo"] === 'insert')
        if($_REQUEST["todo"] === 'update')
        {
            $myAppointment_class = new AppointmentClass;
            $mySeminar_class = new SeminarClass;
            $myStartDate = new DateTime($_REQUEST["startDate"]);
            $myEndDate = new DateTime($_REQUEST["endDate"]);

            $myAppointment_class->getAppointmentById($_REQUEST["id"]);
            $mySeminar_class->getSeminarById($_REQUEST["seminar_id"]);

            $myAppointment_class->name = $mySeminar_class->name;
            $myAppointment_class->description = $_REQUEST["description"];
            $myAppointment_class->startDate = $myStartDate->format('Y-m-d');
            $myAppointment_class->endDate = $myEndDate->format('Y-m-d');
            $myAppointment_class->seminar_id = $_REQUEST["seminar_id"];
            $myAppointment_class->visible = $_REQUEST["visible"];
            $myAppointment_class->update();

            if(isset($_REQUEST["savePageBack"]))
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/appointment/overview/');
                exit;
            }/* if(isset($_REQUEST["savePageBack"])) */
            else
            {
                header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/appointment/edit/'.$myAppointment_class->id);
                exit;
            }/* else */
        }// if($_REQUEST["todo"] === 'update')
	if($_REQUEST["two"] === 'delete')
	{
        $myAppointment_class = new AppointmentClass;
        $myAppointment_class->getAppointmentById($_REQUEST["three"]);
        if(0 < $myAppointment_class->id)
        {
            $myAppointment_class->delete();
            header('Location: http://'.$_SERVER["HTTP_HOST"].'/admin/appointment/overview/');
            exit;
        }// if(0 < $myAppointment_class->id)
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
                $teAppointment->assign("subMenu",$teAppointment->display($GLOBALS[$_SESSION["one"]."SubMenuTemplate"]));
            }
        }/*if($_SESSION["one"] != "") */
//######################################################################################################################
//##### OVERVIEW #######################################################################################################
//######################################################################################################################
        if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
        {
            $myAppointments_class = new AppointmentClass;
            $mySeminar_class = new SeminarClass;

            $myAppointments_class->setOldAppointmentsUnvisible();

            $appointmentMenuList_tmp = '';
            foreach($myAppointments_class->getAppointment() as $myAppointment)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign($myAppointment, '');
                $myStartDate = new DateTime($myAppointment->startDate);
                $myEndDate = new DateTime($myAppointment->endDate);
                $myTE->assign('startDate', $myStartDate->format('d.m.Y'));
                $myTE->assign('endDate', $myEndDate->format('d.m.Y'));

                $mySeminar_class->getSeminarById($myAppointment->seminar_id);
                $myTE->assign('seminarName', $mySeminar_class->name);
                $appointmentList_tmp .= $myTE->display($GLOBALS["appointmentOverviewListItemTemplate"]);

            }// foreach($myAppointments_class->getAppointmnets() as $myAppointment)

            $teAppointment->assign('appointmentList', $appointmentList_tmp);
            $teAppointment->assign('contentContent', $teAppointment->display($GLOBALS["appointmentOverviewTemplate"]));
        }// if($_SESSION["two"] === "" || $_SESSION["two"] === 'overview')
//######################################################################################################################
//##### ADD ############################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'add')
        {
            $mySeminar_class = new SeminarClass;

            $seminar_tpl = '';
            foreach($mySeminar_class->getSeminar() as $Seminar)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign('value', $Seminar->id);
                $myTE->assign('text', $Seminar->name);
                $seminar_tpl .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }
            $teAppointment->assign('seminarList', $seminar_tpl);
            $teAppointment->assign('todo', 'insert');
            $teAppointment->assign('todoHeadline', 'Hinzuf&uuml;gen');
            $teAppointment->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/appointment/overview/');
            $teAppointment->assign('contentContent', $teAppointment->display($GLOBALS["appointmentDetailTemplate"]));
        }// elseif($_SESSION["two"] === 'add')
//######################################################################################################################
//##### EDIT ###########################################################################################################
//######################################################################################################################
        elseif($_SESSION["two"] === 'edit')
        {
            $myAppointments_class = new AppointmentClass;
            $mySeminar_class = new SeminarClass;

            $myAppointments_class->getAppointmentById($_REQUEST["three"]);
            $myStartDate = new DateTime($myAppointments_class->startDate);
            $myEndDate = new DateTime($myAppointments_class->endDate);
            
            $seminar_tpl = '';
            foreach($mySeminar_class->getSeminar() as $Seminar)
            {
                $myTE = new TemplateEngine;
                $myTE->assign("imagesdir",IMAGESDIR);
                $myTE->assign("cssdir",CSSDIR);
                $myTE->assign("jsdir",JSDIR);
                
                $myTE->assign('value', $Seminar->id);
                $myTE->assign('text', $Seminar->name);
                if($Seminar->id === $myAppointments_class->seminar_id)
                {
                    $myTE->assign('selected', 'selected="selected"');
                }
                $seminar_tpl .= $myTE->display($GLOBALS["selectOptionTemplate"]);
            }

            $teAppointment->assign($myAppointments_class, '');
            $teAppointment->assign('startDate', $myStartDate->format('d.m.Y'));
            $teAppointment->assign('endDate', $myEndDate->format('d.m.Y'));
            $teAppointment->assign('visibleSelected'.$myAppointments_class->visible, 'selected="selected"');
            $teAppointment->assign('seminarList', $seminar_tpl);
            $teAppointment->assign('todo', 'update');
            $teAppointment->assign('todoHeadline', 'Bearbeiten');
            $teAppointment->assign("HTTP_REFERER",'http://'.$_SERVER["HTTP_HOST"].'/admin/appointment/overview/');
            $teAppointment->assign('contentContent', $teAppointment->display($GLOBALS["appointmentDetailTemplate"]));
        }// elseif($_SESSION["two"] === 'edit')
        $teAppointment->assign('subMenuTitle', '&nbsp;');
        $content = $teAppointment->display($GLOBALS["contentTemplate"]);
    }//if(($privilegeName === "admin" || $privilegeName === "agency_admin" || $privilegeName === "webmaster"  || $privilegeName === "user"))
?>
