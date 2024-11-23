<?php
    $myAppointment_class = new AppointmentClass;
    $myActAppointmentIDs_class = new AppointmentClass;
    $myActAppointmentIDs_array = $myActAppointmentIDs_class->getActAppointmentIDs('LIMIT 5');

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
            if(in_array($Appointment->id, $myActAppointmentIDs_array))
            {
                $myStartDate = new DateTime($Appointment->startDate);
                $myEndDate = new DateTime($Appointment->endDate);
                $te->assign('startDate', $myStartDate->format('d.m.'));
                $te->assign('endDate', $myEndDate->format('d.m.Y'));
                $tpl .= $te->display($GLOBALS["appointmentBoxDateItemTemplate"]);
            }
        }
        if($tpl !== '')
        {
            $te->assign('appointmentList', $tpl);
            $appointment_tpl .= $te->display($GLOBALS["appointmentBoxItemTemplate"]);
        }
    }

    $te->assign('appointmentList', $appointment_tpl);
    $contentBoxRight = $te->display($GLOBALS["appointmentBoxTemplate"]);;
?>
