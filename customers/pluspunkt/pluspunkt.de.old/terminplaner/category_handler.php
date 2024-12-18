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

// does the category belong to the user?
$is_my_event = false;
if ( empty ( $id ) ) {
  $is_my_event = true; // new event
} else {
  $res = dbi_query ( "SELECT cat_id FROM webcal_categories " .
    "WHERE cat_owner = '$login' AND cat_id = $id" );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    if ( $row[0] == $id )
      $is_my_event = true;
    dbi_free_result ( $res );
  } else {
    $error = translate("Database error") . ": " . dbi_error ();
  }
}

if ( ! $is_my_event )
  $error = translate ( "You are not authorized" ) . ".";


if ( empty ( $error ) &&
  ( $action == "Delete" || $action == translate ("Delete") ) ) {
  // delete this category
  if ( ! dbi_query ( "DELETE FROM webcal_categories " .
    "WHERE cat_id = $id AND cat_owner = '$login'" ) )
    $error = translate ("Database error") . ": " . dbi_error();
      
  // Set any events in this category to NULL
  if ( ! dbi_query ( "UPDATE webcal_entry_user SET cal_category = NULL " .
    "WHERE cal_category = $id AND cal_login = '$login'" ) )
    $error = translate ("Database error") . ": " . dbi_error();
} else if ( empty ( $error ) ) {
  if ( ! empty ( $id ) ) {
    # update
    if ( ! dbi_query ( "UPDATE webcal_categories SET cat_name = '$catname' " .
      "WHERE cat_id = $id AND cat_owner = '$login'" ) ) {
      $error = translate ("Database error") . ": " . dbi_error();
    }
  } else {
    // add new category
    // get new id
    $res = dbi_query ( "SELECT MAX(cat_id) FROM webcal_categories" );
    if ( $res ) {
      $row = dbi_fetch_row ( $res );
      $id = $row[0] + 1;
      dbi_free_result ( $res );
      $sql = "INSERT INTO webcal_categories " .
        "( cat_id, cat_owner, cat_name ) " .
        "VALUES ( $id, '$login', '$catname' )";
      if ( ! dbi_query ( $sql ) ) {
        $error = translate ("Database error") . ": " . dbi_error();
      }
    } else {
      $error = translate ("Database error") . ": " . dbi_error();
    }
  }
}
if ( empty ( $error ) )
  do_redirect ( "category.php" );

?>
<HTML>
<HEAD>
<TITLE><?php etranslate($application_name)?></TITLE>
<?php include "includes/styles.php"; ?>
</HEAD>
<BODY BGCOLOR="<?php echo $BGCOLOR;?>" CLASS="defaulttext">

<H2><FONT COLOR="<?php echo $H2COLOR;?>"><?php etranslate("Error")?></FONT></H2>

<BLOCKQUOTE>
<?php echo $error; ?>
</BLOCKQUOTE>

<?php include "includes/trailer.php"; ?>
</BODY>
</HTML>
