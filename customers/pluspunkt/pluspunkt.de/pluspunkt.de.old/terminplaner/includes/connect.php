<?php

// db settings are in config.php

// Establish a database connection.
$c = dbi_connect ( $db_host, $db_login, $db_password, $db_database );
if ( ! $c ) {
  echo "Error connecting to database:<BLOCKQUOTE>" .
    dbi_error () . "</BLOCKQUOTE>\n";
  exit;
}

// global settings have not been loaded yet, so check for public_access now
$res = dbi_query ( "SELECT cal_value FROM webcal_config " .
  "WHERE cal_setting = 'public_access'" );
$pub_acc_enabled = false;
if ( $res ) {
  if ( $row = dbi_fetch_row ( $res ) ) {
    if ( $row[0] == "Y" )
      $pub_acc_enabled = true;
  }
  dbi_free_result ( $res );
}

// Debugging stuff :-)
//echo "pub_acc_enabled = " . ( $pub_acc_enabled ? "true" : "false" ) . " <br>";
//echo "session_not_found = " . ( $session_not_found ? "true" : "false" ) . " <br>";
//echo "use_http_auth = " . ( $use_http_auth ? "true" : "false" ) . " <br>";
//echo "PHP_AUTH_USER = $PHP_AUTH_USER <br>";
//echo "login = $login <br>";


if ( $pub_acc_enabled && $session_not_found ) {
  $login = "__public__";
  $is_admin =  false;
  $lastname = "";
  $firstname = "";
  $fullname = "Public User";
  $user_email = "";
} else if ( ! $pub_acc_enabled && $session_not_found && ! $use_http_auth ) {
  do_redirect ( "login.php" );
  exit;
}

if ( empty ( $login ) && $use_http_auth ) {
  if ( $public_access == "Y" ) {
  }
  if ( strstr ( $PHP_SELF, "login.php" ) ) {
    // ignore since login.php will redirect to index.php
  } else {
    send_http_login ();
  }
} else if ( ! empty ( $login ) ) {
  // they are already logged in ($login is set in validate.php)
  if ( strstr ( $PHP_SELF, "login.php" ) ) {
    // ignore since login.php will redirect to index.php
  } else if ( $login == "__public__" ) {
    $is_admin =  false;
    $lastname = "";
    $firstname = "";
    $fullname = "Public User";
    $user_email = "";
  } else {
    user_load_variables ( $login, "login_" );
    if ( ! empty ( $login_login ) ) {
      $is_admin =  ( $login_is_admin == "Y" ? true : false );
      $lastname = $login_lastname;
      $firstname = $login_firstname;
      $fullname = $login_fullname;
      $user_email = $login_email;
    } else {
      // Invalid login
      if ( $use_http_auth ) {
        send_http_login ();
      } else {
        // This shouldn't happen since login should be validated in validate.php
        // If it does happen, it means we received an invalid login cookie.
        //echo "Error getting user info for login \"$login\".";
        do_redirect ( "login.php?error=Invalid+session+found." );
      }
    }
  }
}
//else if ( ! $single_user ) {
//  echo "Error(3)! no login info found: " . dbi_error () . "<P><B>SQL:</B> $sql";
//  exit;
//}


// If they are accessing using the public login, restrict them from using
// certain pages.
if ( $login == "__public__" ) {
  if ( strstr ( $PHP_SELF, "views.php" ) ||
    strstr ( $PHP_SELF, "views_w.php" ) ||
    strstr ( $PHP_SELF, "views_m.php" ) ||
    strstr ( $PHP_SELF, "views_edit_handler.php" ) ||
    strstr ( $PHP_SELF, "category.php" ) ||
    strstr ( $PHP_SELF, "category_handler.php" ) ||
    strstr ( $PHP_SELF, "admin.php" ) ||
    strstr ( $PHP_SELF, "admin_handler.php" ) ||
    strstr ( $PHP_SELF, "group_edit_handler.php" ) ||
    strstr ( $PHP_SELF, "pref.php" ) ||
    strstr ( $PHP_SELF, "pref_handler.php" ) ||
    strstr ( $PHP_SELF, "select_user.php" ) ||
    strstr ( $PHP_SELF, "edit_user.php" ) ||
    strstr ( $PHP_SELF, "edit_user_handler.php" ) ||
    strstr ( $PHP_SELF, "approve_entry.php" ) ||
    strstr ( $PHP_SELF, "reject_entry.php" ) ||
    strstr ( $PHP_SELF, "del_entry.php" ) ||
    strstr ( $PHP_SELF, "set_entry_cat.php" ) ||
    strstr ( $PHP_SELF, "list_unapproved.php" ) ||
    strstr ( $PHP_SELF, "layers.php" ) ||
    strstr ( $PHP_SELF, "layer_toggle.php" ) ) {
    $not_auth = true;
  }
}

if ( ! $is_admin ) {
  if ( strstr ( $PHP_SELF, "admin.php" ) ||
    strstr ( $PHP_SELF, "admin_handler.php" ) ||
    strstr ( $PHP_SELF, "groups.php" ) ||
    strstr ( $PHP_SELF, "group_edit.php" ) ||
    strstr ( $PHP_SELF, "group_edit_handler.php" ) ||
    strstr ( $PHP_SELF, "activity_log.php" ) ) {
    $not_auth = true;
  }
}

// We can't call translate() here because translate.php gets loaded
// after this include file :-(
// So, instead of an error message that may be in the wrong language,
// just redirect to some other page.
if ( $not_auth ) {
  /*
  echo "<HTML><HEAD><TITLE>" . translate($application_name) . " " .
    translate("Error") .  "</TITLE></HEAD><BODY>\n";
  echo "<H2>" . translate ( "Error" ) . "</H2>\n" .
    translate ( "You are not authorized" );
  */
  do_redirect ( "week.php" );
}

?>
