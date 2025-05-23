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

include "includes/translate.php";

$error = "";

$updating_public = false;;
if ( $is_admin && ! empty ( $public ) && $public_access == "Y" ) {
  $updating_public = true;
  $prefuser = "__public__";
} else {
  $prefuser = "$login";
}

while ( list ( $key, $value ) = each ( $HTTP_POST_VARS ) ) {
  $setting = substr ( $key, 5 );
  if ( strlen ( $setting ) > 0 ) {
    $sql =
      "DELETE FROM webcal_user_pref WHERE cal_login = '$prefuser' " .
      "AND cal_setting = '$setting'";
    dbi_query ( $sql );
    if ( strlen ( $value ) > 0 ) {
      $sql = "INSERT INTO webcal_user_pref " .
        "( cal_login, cal_setting, cal_value ) VALUES " .
        "( '$prefuser', '$setting', '$value' )";
      if ( ! dbi_query ( $sql ) ) {
        $error = "Unable to update preference: " . dbi_error () .
          "<P><B>SQL:</B> $sql";
        break;
      }
    }
  }
}

if ( empty ( $error ) ) {
  if ( $updating_public )
    do_redirect ( "pref.php?public=1" );
  else
    do_redirect ( "pref.php" );
}

?>
<HTML>
<HEAD><TITLE><?php etranslate($application_name)?></TITLE>
<?php include "includes/styles.php"; ?>
</HEAD>
<BODY BGCOLOR="<?php echo $BGCOLOR; ?>" CLASS="defaulttext">

<H2><FONT COLOR="<?php echo $H2COLOR;?>"><?php etranslate("Error")?></FONT></H2>

<?php etranslate("The following error occurred")?>:
<BLOCKQUOTE>
<?php echo $error; ?>
</BLOCKQUOTE>

<?php include "includes/trailer.php"; ?>

</BODY>
</HTML>
