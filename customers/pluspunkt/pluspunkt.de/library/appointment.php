<?php
    $myContent_class = new ContentClass;
    $myMenu_class = new MenuClass;

    $myMenu_class->getMenuByUrlName($_REQUEST["two"]);
    $myContent_class->getContentById($myMenu_class->content_id);

    $siteTitle = $myContent_class->title;

    $myAppointment_class = new AppointmentClass;
    $mySeminar_class = new SeminarClass;

    $myAppointment_class->setOldAppointmentsUnvisible();

    $appointment_tpl = '';

    foreach($myAppointment_class->getSeminar() as $seminar_id)
    {
        $mySeminar_class->getSeminarById($seminar_id);
        $te->assign('seminarName', $mySeminar_class->name);

        if($mySeminar_class->name === 'Inspiration')
        {
            $te->assign('url', '/inspiration/anmeldung');
        }
        else
        {
            $te->assign('url', '/loesungen/persoenliche/'.getUrlFriendlyText($mySeminar_class->name));
        }
        $te->assign('urlTitle', $mySeminar_class->name);

        $tpl = '';
        foreach($myAppointment_class->getAppointmentBySeminarId($seminar_id) as $Appointment)
        {
            $myStartDate = new DateTime($Appointment->startDate);
            $myEndDate = new DateTime($Appointment->endDate);
            $te->assign('startDate', $myStartDate->format('d.m.'));
            $te->assign('endDate', $myEndDate->format('d.m.Y'));
            $tpl .= $te->display($GLOBALS["appointmentDateItemTemplate"]);
        }
        $te->assign('appointmentList', $tpl);
        $appointment_tpl .= $te->display($GLOBALS["appointmentItemTemplate"]);
    }

    $te->assign('title', $myContent_class->title);
    $te->assign('appointmentList', $appointment_tpl);
    $te->assign('content', $te->display($GLOBALS["appointmentTemplate"]));
    $te->assign('motive_id', $myContent_class->motive_id);
    $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."Template"]);
    $te->assign('motive_id', 'noimage');
?>
