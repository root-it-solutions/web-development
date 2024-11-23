<?php

include "includes/config.php";
include "includes/php-dbi.php";
include "includes/functions.php";
include "includes/$user_inc";
include "includes/validate.php";
include "includes/connect.php";

load_global_settings ();
load_user_preferences ();
load_user_layers ();
load_user_categories();

include "includes/translate.php";

$error = "";

// Only proceed if id was passed
if ( $id > 0 ) {

  // double check to make sure user doesn't already have the event
  $is_my_event = false;
  $sql = "SELECT cal_id FROM webcal_entry_user " .
    "WHERE cal_login = '$login' AND cal_id = $id";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    if ( $row[0] == $id ) {
      $is_my_event = true;
      echo "Event # " . $id . " is already on your calendar.";
      exit;
    }
    dbi_free_result ( $res );
  }

  // Now lets make sure the user is allowed to add the event (not private)

  $sql = "SELECT cal_access FROM webcal_entry WHERE cal_id = " . $id;
  $res = dbi_query ( $sql );
  if ( ! $res ) {
    echo translate("Invalid entry id") . ": $id";
    exit;
  }
  $row = dbi_fetch_row ( $res );

  if ( $row[0] == "R" && ! $is_my_event ) {
    $is_private = true;
    etranslate("This is a private event and may not be added to your calendar.");
    exit;
  } else {
    $is_private = false;
  }

  // Select Category if enabled and missing
  if ( $categories_enabled == "Y" && empty ( $cat_id ) && ! empty ( $categories ) ) {
    echo "<HTML>\n<HEAD>\n<TITLE>";
    etranslate( $application_name );
    echo "</TITLE>\n";
    include "includes/styles.php";
    echo "</HEAD>\n<BODY BGCOLOR=\"$BGCOLOR\" CLASS=\"defaulttext\">";

    echo "<form ACTION=\"add_entry.php\" METHOD=\"GET\" NAME=\"SelectCategory\">\n";
    echo "<input type=\"hidden\" NAME=\"id\" VALUE=\"$id\">\n";
    echo "<B>".translate('Select Category').":</B> <select name=\"cat_id\" ONCHANGE=\"document.SelectCategory.submit()\">\n";
    echo "<OPTION VALUE=\"\"> ";
    foreach( $categories as $K => $V ){
      echo "<OPTION VALUE=\"$K\">$V";
    }
    echo "</select>\n</FORM>\n";
    include "includes/trailer.php";
    echo "</BODY>\n</HTML>";
    exit;
  } elseif ( empty ( $cat_id ) ) {
    $cat_id = 'NULL';
  }

   // add the event
  if ( $readonly == "N" && ! $is_my_event && ! $is_private )  {
    if ( ! dbi_query ( "INSERT INTO webcal_entry_user ( cal_id, cal_login, cal_status, cal_category ) VALUES ( $id, '$login', 'A', $cat_id )") ) {
      $error = translate("Error adding event") . ": " . dbi_error ();
    }
  }
}

if ( strlen ( get_last_view() ) ) {
  $url = get_last_view();
} else {
  $url = "$STARTVIEW.php" . ( $thisdate > 0 ? "?date=$thisdate" : "" );
}

do_redirect ( $url );
exit;
?>
