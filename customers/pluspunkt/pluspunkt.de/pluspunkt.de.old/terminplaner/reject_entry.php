<?php

include "includes/config.php";
include "includes/php-dbi.php";
include "includes/functions.php";
include "includes/$user_inc";
include "includes/validate.php";
include "includes/connect.php";

load_global_settings ();
load_user_preferences ();

include "includes/translate.php";

$error = "";

// Allow administrators to approve public events
if ( $public_access == "Y" && ! empty ( $public ) && $is_admin )
  $app_user = "__public__";
else
  $app_user = $login;

if ( $id > 0 ) {
  if ( ! dbi_query ( "UPDATE webcal_entry_user SET cal_status = 'R' " .
    "WHERE cal_login = '$app_user' AND cal_id = $id" ) ) {
    $error = translate("Error approving event") . ": " . dbi_error ();
  } else {
    activity_log ( $id, $login, $app_user, $LOG_REJECT, "" );
  }

  // Email participants to notify that it was rejected.
  // Get list of participants
  $sql = "SELECT cal_login FROM webcal_entry_user WHERE cal_id = $id and cal_status = 'A'";
  //echo $sql."<BR>";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) )
      $partlogin[] = $row[0];
    dbi_free_result($res);
  }

  // Get the name of the event
  $sql = "SELECT cal_name FROM webcal_entry WHERE cal_id = $id";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    $name = $row[0];
    dbi_free_result ( $res );
  }

  for ( $i = 0; $i < count ( $partlogin ); $i++ ) {
    // does this user want email for this?
    $send_user_mail = get_pref_setting ( $partlogin[$i],
      "EMAIL_EVENT_REJECTED" );
    user_load_variables ( $partlogin[$i], "temp" );
    if ( $send_user_mail == "Y" && strlen ( $tempemail ) &&
      $send_email != "N" ) {
      $fmtdate = sprintf ( "%04d%02d%02d", $year, $month, $day );
      $msg = translate("Hello") . ", " . $tempfullname . ".\n\n" .
        translate("An appointment has been rejected by") .
        " " . $login_fullname .  ". " .
        translate("The subject was") . " \"" . $name . " \"\n" .
        translate("The description is") . " \"" . $description . "\"\n" .
        translate("Date") . ": " . date_to_str ( $fmtdate ) . "\n" .
        translate("Time") . ": " .
        display_time ( ( $hour * 10000 ) + ( $minute * 100 ) ) . "\n\n\n";
      if ( ! empty ( $server_url ) ) {
        $url = $server_url .  "view_entry.php?id=" .  $id;
        $msg .= "\n\n" . $url;
      }
 
      $from = $email_fallback_from;
      if ( strlen ( $login_email ) )
        $from = $login_email;

      $extra_hdrs = "From: $from\nX-Mailer: " . translate("Title");

      mail ( $tempemail,
        translate($application_name) . " " . translate("Notification") . ": " . $name,
        $msg, $extra_hdrs );
      activity_log ( $id, $login, $partlogin[$i], $LOG_NOTIFICATION,
        "Event rejected by $app_user" );
    }
  }
  

}

if ( $ret == "list" )
  do_redirect ( "list_unapproved.php" );
else
  do_redirect ( "view_entry.php?id=$id" );
?>
