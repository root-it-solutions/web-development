<?php

include "includes/config.php";
include "includes/php-dbi.php";
include "includes/functions.php";
include "includes/$user_inc";
include "includes/site_extras.php";
include "includes/validate.php";
include "includes/connect.php";

load_global_settings ();
load_user_preferences ();

include "includes/translate.php";

$do_override = false;
$old_id = -1;
if ( ! empty ( $override ) && ! empty ( $override_date ) ) {
  // override date specified.  user is going to create an exception
  // to a repeating event.
  $do_override = true;
  $old_id = $id;
}


// Input time format "235900", duration is minutes
function add_duration ( $time, $duration ) {
  $hour = (int) ( $time / 10000 );
  $min = ( $time / 100 ) % 100;
  $minutes = $hour * 60 + $min + $duration;
  $h = $minutes / 60;
  $m = $minutes % 60;
  $ret = sprintf ( "%d%02d00", $h, $m );
  //echo "add_duration ( $time, $duration ) = $ret <BR>";
  return $ret;
}

// check to see if two events overlap
// time1 and time2 should be an integer like 235900
// duration1 and duration2 are integers in minutes
function times_overlap ( $time1, $duration1, $time2, $duration2 ) {
  //echo "times_overlap ( $time1, $duration1, $time2, $duration2 )<BR>";
  $hour1 = (int) ( $time1 / 10000 );
  $min1 = ( $time1 / 100 ) % 100;
  $hour2 = (int) ( $time2 / 10000 );
  $min2 = ( $time2 / 100 ) % 100;
  // convert to minutes since midnight
  // remove 1 minute from duration so 9AM-10AM will not conflict with 10AM-11AM
  if ( $duration1 > 0 )
    $duration1 -= 1;
  if ( $duration2 > 0 )
    $duration2 -= 1;
  $tmins1start = $hour1 * 60 + $min1;
  $tmins1end = $tmins1start + $duration1;
  $tmins2start = $hour2 * 60 + $min2;
  $tmins2end = $tmins2start + $duration2;
  //echo "tmins1start=$tmins1start, tmins1end=$tmins1end, tmins2start=$tmins2start, tmins2end=$tmins2end<BR>";
  if ( $tmins1start >= $tmins2start && $tmins1start <= $tmins2end )
    return true;
  if ( $tmins1end >= $tmins2start && $tmins1end <= $tmins2end )
    return true;
  if ( $tmins2start >= $tmins1start && $tmins2start <= $tmins1end )
    return true;
  if ( $tmins2end >= $tmins1start && $tmins2end <= $tmins1end )
    return true;
  return false;
}

// Make sure this user is really allowed to edit this event.
// Otherwise, someone could hand type in the URL to edit someone else's
// event.
// Can edit if:
//   - new event
//   - user is admin
//   - user created event
//   - user is participant
$can_edit = false;
if ( empty ( $id ) ) {
  // New event...
  $can_edit = true;
} else if ( $is_admin ) {
  $can_edit = true;
} else {
  // event owner?
  $sql = "SELECT cal_create_by FROM webcal_entry WHERE cal_id = '$id'";
  $res = dbi_query($sql);
  if ($res) {
    $row = dbi_fetch_row ( $res );
    if ( $row[0] == $login )
      $can_edit = true;
    dbi_free_result ( $res );
  }
}
if ( ! $can_edit ) {
  // is user a participant of that event ?
  $sql = "SELECT cal_id FROM webcal_entry_user WHERE cal_id = '$id' " .
    "AND cal_login = '$login' AND cal_status IN ('W','A')";
  $res = dbi_query ( $sql );
  if ($res) {
    $row = dbi_fetch_row ( $res );
    if ( ! empty( $row[0] ) )
      $can_edit = true; // is participant
    dbi_free_result ( $res );
  }
}

if ( ! $can_edit && empty ( $error ) )
  $error = translate ( "You are not authorized" );

// If display of participants is disabled, set the participant list
// to the event creator.  This also works for single-user mode.
// Basically, if no participants were selected (because there
// was no selection list available in the form or because the user
// refused to select any participant from the list), then we will
// assume the only participant is the current user.
if ( ! strlen ( $participants[0] ) )
  $participants[0] = $login;

$duration = ( $duration_h * 60 ) + $duration_m;
if ( strlen ( $hour ) > 0 ) {
  if ( $TIME_FORMAT == '12' ) {
    $ampmt = $ampm;
    //This way, a user can pick am and still
    //enter a 24 hour clock time.
    if ($hour > 12 && $ampm == 'am') {
      $ampmt = 'pm';
    }
    $hour %= 12;
    if ( $ampmt == 'pm' )
      $hour += 12;
  }
}

// first check for any schedule conflicts
if ( $allow_conflicts != "Y" && empty ( $confirm_conflicts ) &&
  strlen ( $hour ) > 0 ) {
  $date = mktime ( 2, 0, 0, $month, $day, $year );
  $str_cal_date = date ( "Ymd", $date );
  if ( strlen ( $hour ) > 0 )
    $str_cal_time = sprintf ( "%02d%02d00", $hour, $minute );
  if ( ! empty ( $rpt_end_use ) )
    $endt = mktime ( 2, 0, 0, $rpt_month, $rpt_day,$rpt_year );
  else
    $endt = 'NULL';

  if ($rpt_type == 'weekly') {
    $dayst = ( $rpt_sun ? 'y' : 'n' )
      . ( $rpt_mon ? 'y' : 'n' )
      . ( $rpt_tue ? 'y' : 'n' )
      . ( $rpt_wed ? 'y' : 'n' )
      . ( $rpt_thu ? 'y' : 'n' )
      . ( $rpt_fri ? 'y' : 'n' )
      . ( $rpt_sat ? 'y' : 'n' );
  } else {
    $dayst = "nnnnnnn";
  }

  // Load exception days... but not for a new event (which can't have
  // exception dates yet)
  $ex_days = array ();
  if ( ! empty ( $id ) ) {
    $res = dbi_query ( "SELECT cal_date FROM webcal_entry_repeats_not " .
      "WHERE cal_id = $id" );
    while ( $row = dbi_fetch_row ( $res ) ) {
      $ex_days[] = $row[0];
    }
    dbi_free_result ( $res );
  }

  $dates = get_all_dates ( $date, $rpt_type, $endt, $dayst,
    $ex_days, $rpt_freq );

  //echo $id . "<BR>";
  $overlap = overlap ( $dates, $duration, $hour, $minute, $participants,
    $login, empty ( $id ) ? 0 : $id );

}
if ( empty ( $error ) && ! empty ( $overlap ) ) {
  $error = translate("The following conflicts with the suggested time") .
    ":<UL>$overlap</UL>";
}


$msg = "";

if ( empty ( $error ) ) {
  $newevent = true;
  // now add the entries
  if ( empty ( $id ) || $do_override ) {
    $res = dbi_query ( "SELECT MAX(cal_id) FROM webcal_entry" );
    if ( $res ) {
      $row = dbi_fetch_row ( $res );
      $id = $row[0] + 1;
      dbi_free_result ( $res );
    } else {
      $id = 1;
    }
  } else {
    $newevent = false;
    // save old status values of participants
    $sql = "SELECT cal_login, cal_status, cal_category FROM webcal_entry_user " .
      "WHERE cal_id = $id ";
    $res = dbi_query ( $sql );
    for ( $i = 0; $tmprow = dbi_fetch_row ( $res ); $i++ ) {
      $old_status[$tmprow[0]] = $tmprow[1];
      $old_category[$tmprow[0]] = $tmprow[2];
    }
    dbi_free_result ( $res );
    dbi_query ( "DELETE FROM webcal_entry WHERE cal_id = $id" );
    dbi_query ( "DELETE FROM webcal_entry_user WHERE cal_id = $id" );
    dbi_query ( "DELETE FROM webcal_entry_repeats WHERE cal_id = $id" );
    dbi_query ( "DELETE FROM webcal_site_extras WHERE cal_id = $id" );
    $newevent = false;
  }

  if ( $do_override ) {
    $sql = "INSERT INTO webcal_entry_repeats_not ( cal_id, cal_date ) " .
      "VALUES ( $old_id, $override_date )";
    $res = dbi_query ( $sql );
    if ( ! $res ) {
      $error = "Unable to add entry: " . dbi_error () . "<P><B>SQL:</B> $sql";
    }
  }

  $sql = "INSERT INTO webcal_entry ( cal_id, " .
    ( $old_id > 0 ? " cal_group_id, " : "" ) .
    "cal_create_by, cal_date, " .
    "cal_time, cal_mod_date, cal_mod_time, cal_duration, cal_priority, " .
    "cal_access, cal_type, cal_name, cal_description ) " .
    "VALUES ( $id, " .
    ( $old_id > 0 ? " $old_id, " : "" ) .
    "'$login', ";

  $date = mktime ( 2, 0, 0, $month, $day, $year );
  $sql .= date ( "Ymd", $date ) . ", ";
  if ( strlen ( $hour ) > 0 ) {
    $sql .= sprintf ( "%02d%02d00, ", $hour, $minute );
  } else
    $sql .= "-1, ";
  $sql .= date ( "Ymd" ) . ", " . date ( "Gis" ) . ", ";
  $sql .= sprintf ( "%d, ", $duration );
  $sql .= sprintf ( "%d, ", $priority );
  $sql .= "'$access', ";
  if ( $rpt_type != 'none' )
    $sql .= "'M', ";
  else
    $sql .= "'E', ";

  if ( strlen ( $name ) == 0 )
    $name = translate("Unnamed Event");
  $sql .= "'" . $name .  "', ";
  if ( strlen ( $description ) == 0 )
    $description = $name;
  $sql .= "'" . $description . "' )";

  $error = "";
  if ( ! dbi_query ( $sql ) )
    $error = "Unable to add entry: " . dbi_error () . "<P><B>SQL:</B> $sql";
  $msg .= "<B>SQL:</B> $sql<P>";

  // log add/update
  activity_log ( $id, $login, $login,
    $newevent ? $LOG_CREATE : $LOG_UPDATE, "" );

  if ( $single_user == "Y" ) {
    $participants[0] = $single_user_login;
  }

  // check if participants have been removed and send out emails
  if ( ! $newevent ) {  // nur bei Update!!!
    while ( list ( $old_participant, $dummy ) = each ( $old_status ) ) {
      $found_flag = false;
      for ( $i = 0; $i < count ( $participants ); $i++ ) {
        if ( $participants[$i] == $old_participant ) {
          $found_flag = true;
          break;
        }
      }
      if ( !$found_flag ) {
        // only send mail if their email address is filled in
        $do_send = get_pref_setting ( $old_participants, "EMAIL_EVENT_DELETED" );
        user_load_variables ( $old_participant, "temp" );
        if ( $old_participant != $login && strlen ( $tempemail ) &&
          $do_send == "Y" && $send_email != "N" ) {
          $fmtdate = sprintf ( "%04d%02d%02d", $year, $month, $day );
          $msg = translate("Hello") . ", " . $tempfullname . ".\n\n" .
            translate("An appointment has been canceled for you by") .
            " " . $login_fullname .  ". " .
            translate("The subject was") . " \"" . $name . "\"\n\n" .
            translate("The description is") . " \"" . $description . "\"\n" .
            translate("Date") . ": " . date_to_str ( $fmtdate ) . "\n" .
            translate("Time") . ": " .
              display_time ( ( $hour * 10000 ) + ( $minute * 100 ) ) . "\n\n\n";
          // add URL to event, if we can figure it out
          if ( ! empty ( $server_url ) ) {
            $url = $server_url .  "view_entry.php?id=" .  $id;
            $msg .= $url . "\n\n";
          }
          if ( strlen ( $login_email ) )
            $extra_hdrs = "From: $login_email\nX-Mailer: " . translate("Title");
          else
            $extra_hdrs = "From: $email_fallback_from\nX-Mailer: " . translate("Title");
          mail ( $tempemail,
            translate($application_name) . " " . translate("Notification") . ": " . $name,
            $msg, $extra_hdrs );
          activity_log ( $id, $login, $old_participant, $LOG_NOTIFICATION,
            "User removed from participants list" );
        }
      }
    }
  }

  // now add participants and send out notifications
  for ( $i = 0; $i < count ( $participants ); $i++ ) {
    // if public access, always require approval
    if ( $login == "__public__" )
      $status = "W";
    else if ( ! $newevent ) {
      // keep the old status if no email will be sent
      $send_user_mail = ( $old_status[$participants[$i]] == '' || $entry_changed ) ?
        true : false;
      $tmp_status = ( $old_status[$participants[$i]] && ! $send_user_mail ) ?
        $old_status[$participants[$i]] : "W";
      $status = ( $participants[$i] != $login && $require_approvals == "Y" ) ?
        $tmp_status : "A";
      $tmp_cat = ( ! empty ( $old_category[$participants[$i]]) ) ? $old_category[$participants[$i]] : 'NULL';
      $cat_id = ( $participants[$i] != $login ) ? $tmp_cat : $cat_id;
    } else {
      $send_user_mail = true;
      $status = ( $participants[$i] != $login && $require_approvals == "Y" ) ?
        "W" : "A";
      $cat_id = ( $participants[$i] != $login ) ? 'NULL' : $cat_id;
    }
    if ( empty ( $cat_id ) ) $cat_id = 'NULL';
    $sql = "INSERT INTO webcal_entry_user " .
      "( cal_id, cal_login, cal_status, cal_category ) VALUES ( $id, '" .
      $participants[$i] . "', '$status', $cat_id )";
    $msg .= "<br><B>SQL:</B> $sql\n";
    if ( ! dbi_query ( $sql ) ) {
      $error = "Unable to add to webcal_entry_user: " . dbi_error () .
        "<P><B>SQL:</B> $sql";
      break;
    } else {
      $from = $user_email;
      if ( empty ( $from ) && ! empty ( $email_fallback_from ) )
        $from = $email_fallback_from;
      // only send mail if their email address is filled in
      $do_send = get_pref_setting ( $participants[$i],
         $newevent ? "EMAIL_EVENT_ADDED" : "EMAIL_EVENT_UPDATED" );
      user_load_variables ( $participants[$i], "temp" );
      if ( $participants[$i] != $login && strlen ( $tempemail ) &&
        $do_send == "Y" && $send_user_mail && $send_email != "N" ) {
        $fmtdate = sprintf ( "%04d%02d%02d", $year, $month, $day );
        $msg = translate("Hello") . ", " . $tempfullname . ".\n\n";
        if ( $newevent || $old_status[$participants[$i]] == '' )
          $msg .= translate("A new appointment has been made for you by");
        else
          $msg .= translate("An appointment has been updated by");
        $msg .= " " . $login_fullname .  ". " .
          translate("The subject is") . " \"" . $name . "\"\n\n" .
          translate("The description is") . " \"" . $description . "\"\n" .
          translate("Date") . ": " . date_to_str ( $fmtdate ) . "\n" .
          translate("Time") . ": " .
          display_time ( ( $hour * 10000 ) + ( $minute * 100 ) ) . "\n\n\n";
          translate("Please look on") . " " . translate($application_name) . " " .
          ( $require_approvals == "Y" ?
          translate("to accept or reject this appointment") :
          translate("to view this appointment") ) . ".";
        // add URL to event, if we can figure it out
        if ( ! empty ( $server_url ) ) {
          $url = $server_url .  "view_entry.php?id=" .  $id;
          $msg .= "\n\n" . $url;
        }
        if ( strlen ( $from ) )
          $extra_hdrs = "From: $from\nX-Mailer: " . translate("Title");
        else
          $extra_hdrs = "X-Mailer: " . translate("Title");
        mail ( $tempemail,
          translate($application_name) . " " . translate("Notification") . ": " . $name,
          $msg, $extra_hdrs );
        activity_log ( $id, $login, $participants[$i], $LOG_NOTIFICATION, "" );
      }
    }
  }

  // add site extras
  for ( $i = 0; $i < count ( $site_extras ); $i++ ) {
    $sql = "";
    $extra_name = $site_extras[$i][0];
    $extra_type = $site_extras[$i][2];
    $extra_arg1 = $site_extras[$i][3];
    $extra_arg2 = $site_extras[$i][4];
    $value = $$extra_name;
    //echo "Looking for $extra_name... value = " . $value . " ... type = " .
    // $extra_type . "<BR>\n";
    if ( strlen ( $$extra_name ) || $extra_type == $EXTRA_DATE ) {
      if ( $extra_type == $EXTRA_URL || $extra_type == $EXTRA_EMAIL ||
        $extra_type == $EXTRA_TEXT || $extra_type == $EXTRA_USER ||
        $extra_type == $EXTRA_MULTILINETEXT  ) {
        $sql = "INSERT INTO webcal_site_extras " .
          "( cal_id, cal_name, cal_type, cal_data ) VALUES ( " .
          "$id, '$extra_name', $extra_type, '$value' )";
      } else if ( $extra_type == $EXTRA_REMINDER ) {
        $remind = ( $value == "1" ? 1 : 0 );
        if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_DATE ) > 0 ) {
          $yname = $extra_name . "year";
          $mname = $extra_name . "month";
          $dname = $extra_name . "day";
          $edate = sprintf ( "%04d%02d%02d", $$yname, $$mname, $$dname );
          $sql = "INSERT INTO webcal_site_extras " .
            "( cal_id, cal_name, cal_type, cal_remind, cal_date ) VALUES ( " .
            "$id, '$extra_name', $extra_type, $remind, $edate )";
        } else if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_OFFSET ) > 0 ) {
          $dname = $extra_name . "_days";
          $hname = $extra_name . "_hours";
          $mname = $extra_name . "_minutes";
          $minutes = ( $$dname * 24 * 60 ) + ( $$hname * 60 ) + $$mname;
          $sql = "INSERT INTO webcal_site_extras " .
            "( cal_id, cal_name, cal_type, cal_remind, cal_data ) VALUES ( " .
            "$id, '$extra_name', $extra_type, $remind, '" . $minutes . "' )";
        } else {
          $sql = "INSERT INTO webcal_site_extras " .
          "( cal_id, cal_name, cal_type, cal_remind ) VALUES ( " .
          "$id, '$extra_name', $extra_type, $remind )";
        }
      } else if ( $extra_type == $EXTRA_DATE )  {
        $yname = $extra_name . "year";
        $mname = $extra_name . "month";
        $dname = $extra_name . "day";
        $edate = sprintf ( "%04d%02d%02d", $$yname, $$mname, $$dname );
        $sql = "INSERT INTO webcal_site_extras " .
          "( cal_id, cal_name, cal_type, cal_date ) VALUES ( " .
          "$id, '$extra_name', $extra_type, $edate )";
      }
    }
    if ( strlen ( $sql ) ) {
      //echo "SQL: $sql<BR>\n";
      $res = dbi_query ( $sql );
    }
  }

  // clearly, we want to delete the old repeats, before inserting new...
  dbi_query ( "DELETE FROM webcal_entry_repeats WHERE cal_id = $id");
  // add repeating info
  if ( strlen ( $rpt_type ) && $rpt_type != 'none' ) {
    $freq = ( $rpt_freq ? $rpt_freq : 1 );
    if ( $rpt_end_use )
      $end = sprintf ( "%04d%02d%02d", $rpt_year, $rpt_month, $rpt_day );
    else
      $end = 'NULL';
    if ($rpt_type == 'weekly') {
      $days = ( $rpt_sun ? 'y' : 'n' )
        . ( $rpt_mon ? 'y' : 'n' )
        . ( $rpt_tue ? 'y' : 'n' )
        . ( $rpt_wed ? 'y' : 'n' )
        . ( $rpt_thu ? 'y' : 'n' )
        . ( $rpt_fri ? 'y' : 'n' )
        . ( $rpt_sat ? 'y' : 'n' );
    } else {
      $days = "nnnnnnn";
    }

    $sql = "INSERT INTO webcal_entry_repeats ( cal_id, " .
      "cal_type, cal_end, cal_days, cal_frequency ) VALUES " .
      "( $id, '$rpt_type', $end, '$days', $freq )";
    dbi_query ( $sql );
    $msg .= "<B>SQL:</B> $sql<P>";
  }
}

#print $msg; exit;

// If we were editing this event, then go back to the last view (week, day,
// month).  If this is a new event, then go to the preferred view for
// the date range that this event was added to.
if ( empty ( $error ) ) {
  if ( strlen ( get_last_view() ) && ! $newevent ) {
    $url = get_last_view();
  } else {
    $url = sprintf ( "%s.php?date=%04d%02d%02d",
      $STARTVIEW, $year, $month, $day );
  }
//  do_redirect ( $url );
  do_redirect ( "view_m.php?id=3" );
}

?>
<HTML>
<HEAD><TITLE><?php etranslate($application_name)?></TITLE>
<?php include "includes/styles.php"; ?>
</HEAD>
<BODY BGCOLOR="<?php echo $BGCOLOR; ?>" CLASS="defaulttext">

<?php if ( strlen ( $overlap ) ) { ?>
<H2><FONT COLOR="<?php echo $H2COLOR;?>"><?php etranslate("Scheduling Conflict")?></H2></FONT>

<?php etranslate("Your suggested time of")?> <B>
<?php
  $time = sprintf ( "%d%02d00", $hour, $minute );
  echo display_time ( $time );
  if ( $duration > 0 )
    echo "-" . display_time ( add_duration ( $time, $duration ) );
?>
</B> <?php etranslate("conflicts with the following existing calendar entries")?>:
<UL>
<?php echo $overlap; ?>
</UL>

<?php
// user can confirm conflicts
  echo "<form name=\"confirm\" method=\"post\">\n";
  while (list($xkey, $xval)=each($HTTP_POST_VARS)) {
    if (is_array($xval)) {
      $xkey.="[]";
      while (list($ykey, $yval)=each($xval)) {
        echo "<input type=\"hidden\" name=\"$xkey\" value=\"$yval\">\n";
      }
    } else {
      echo "<input type=\"hidden\" name=\"$xkey\" value=\"$xval\">\n";
    }
  }
?>
<table>
 <tr>
   <td></td>
   <td><input type="button" value="<?php etranslate("Cancel")?>" onClick="history.back()"><td>
 </tr>
</table>
</form>

<?php } else { ?>
<H2><FONT COLOR="<?php echo $H2COLOR;?>"><?php etranslate("Error")?></H2></FONT>
<BLOCKQUOTE>
<?php echo $error; ?>
</BLOCKQUOTE>

<?php } ?>


<?php include "includes/trailer.php"; ?>

</BODY>
</HTML>