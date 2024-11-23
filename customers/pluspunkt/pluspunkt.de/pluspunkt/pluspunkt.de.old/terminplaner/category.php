<?php

include "includes/config.php";
include "includes/php-dbi.php";
include "includes/functions.php";
include "includes/$user_inc";
include "includes/validate.php";
include "includes/connect.php";

load_global_settings ();
load_user_preferences ();
load_user_categories (1);

include "includes/translate.php";

if ( ! $is_admin )
  $user = $login;

if ( $categories_enabled == "N" ) {
  do_redirect ( "$STARTVIEW.php" );
  exit;
}

?>
<HTML>
<HEAD>
<TITLE><?php etranslate($application_name)?></TITLE>
<?php include "includes/styles.php"; ?>
</HEAD>
<BODY BGCOLOR="<?php echo $BGCOLOR;?>" CLASS="defaulttext">

<H2><FONT COLOR="<?php echo $H2COLOR;?>"><?php etranslate("Categories")?></FONT></H2>

<?php

// Adding/Editing category
if ( ( $add == '1' ) || ( isset ( $id ) ) ) {
  $button = translate("Add");
  ?>
  <FORM ACTION="category_handler.php" METHOD="POST">
  <?php
  if ( isset ( $id ) ) {
    echo "<INPUT NAME=\"id\" TYPE=\"hidden\" VALUE=\"$id\">";
    $button = translate("Save");
    $catname = $categories[$id];
  }
  ?>
  <?php etranslate("Category Name")?>: <INPUT NAME="catname" SIZE="20" VALUE="<?php echo htmlspecialchars ( $catname ); ?>"><BR><BR>
  <INPUT TYPE="submit" NAME="action" VALUE="<?php echo $button;?>">
  <?php if ( isset ( $id ) ) {  ?>
    <INPUT TYPE="submit" NAME="action" VALUE="<?php etranslate("Delete");?>" ONCLICK="return confirm('<?php etranslate("Are you sure you want to delete this entry?"); ?>')">
  <?php }  ?>
  </FORM>
  <?php
} else {
  // Displaying Categories
  if ( ! empty ( $categories ) ) {
    echo "<UL>";
    foreach ( $categories as $K => $V ) {
      echo "<LI><A HREF=\"category.php?id=$K\">$V</A></LI>\n";
    }
    echo "</UL>";
  }
  echo "<P><A HREF=\"category.php?add=1\">" . translate("Add New Category") . "</A></P><BR>\n";
}
?>

<?php include "includes/trailer.php"; ?>
</BODY>
</HTML>
