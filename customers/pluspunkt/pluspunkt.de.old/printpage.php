<?php 
IF (!$_SERVER["HTTP_REFERER"])
{
  header("Location: http://www.pluspunkt.de");
}
?>
<html>
<head>
<style type="text/css">
 @page { size:21.0cm 29.7cm; }
td {  font-size: 12px; font-family: Arial, Helvetica, sans-serif}
</style>

<script language="JavaScript" type="text/javascript">
<!--
/*
if((navigator.userAgent.indexOf("Mozilla/4")!=-1) && (navigator.userAgent.indexOf("MSIE 5")!=-1)){
  document.write("<link rel=stylesheet type=\"text/css\" href=\"http://www.enwhp.org/enwhp.css\">");
}
else {

  if((navigator.userAgent.indexOf("Mozilla/4")!=-1) && (navigator.userAgent.indexOf("MSIE 6")!=-1)){
    document.write("<link rel=stylesheet type=\"text/css\" href=\"http://www.enwhp.org/enwhp.css\">");
  }
  else{

    if((navigator.userAgent.indexOf("Mozilla/4")!=-1) && (navigator.userAgent.indexOf("MSIE 4")!=-1)){
      document.write("<link rel=stylesheet type=\"text/css\" href=\"http://www.enwhp.org/enwhp.css\">");
    }
    else{

      if((navigator.userAgent.indexOf("Mozilla/4")!=-1) && (navigator.userAgent.indexOf("MSIE 4")==-1)){
        document.write("<link rel=stylesheet type=\"text/css\" href=\"http://www.enwhp.org/enwhp-ns4.css\">");
      }
      else{
        if((navigator.userAgent.indexOf("Mozilla/5")!=-1) && (navigator.userAgent.indexOf("Netscape6")!=-1)){
          document.write("<link rel=stylesheet type=\"text/css\" href=\"http://www.enwhp.org/enwhp-ns4.css\">");
        }
        else{
*/
    document.write("<link rel=stylesheet type=\"text/css\" href=\"plus-style.css\">");
/*
        }
      }
    }
  }
}
 */
-->
</script>
</head>
<body onLoad="window.print()">

<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top" bgcolor="#FFFFFF">
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
          <td width="25%" align="center" valign="middle"><br>
            <img src="_images/k-logo.jpg" width="80" height="80"></td>
          <td width="75%"><span style="color:#fff;"><b>Pluspunkt Unternehmensentwicklung</b><br>
            <br>
            Pluspunkt Gmbh<br>
            Ostereckern 9<br>
            D-59387 Ascheberg<br>
            Tel: +49 (2593) 95 888 00<br>
            Fax: +49 (2593) 95 888 01<br>
            eMail: &#108;&#111;&#104;&#101;&#64;&#112;&#108;&#117;&#115;&#112;&#117;&#110;&#107;&#116;&#46;&#100;&#101;<br>
            http://www.pluspunkt.de</span></td>
        </tr>
      </table>
      <br>
      <img src="_images/trans-grau.gif" width="650" height="1"></td>
  </tr>
  <tr>
    <td>
      <p><br>
        <?php 
$inhalt = file_get_contents($_SERVER["HTTP_REFERER"]);
$inhalt = str_replace(array("\r", "\n"), array("",""), $inhalt);
preg_match("/<!-- start -->(.*)<!-- ende -->/", $inhalt, $printing);
if($printing[1] != '')
{
//  $printing[1] = eregi_replace( "<IMG SRC=[^>]*>", "", $printing[1] );
  $printing[1] = preg_replace( "/background=[^>]/i", "", $printing[1] );
    $printing[1] = preg_replace( "/bgcolor=[^>]/i", "", $printing[1] );
//  $printing[1] = eregi_replace( "height=[^>]", "", $printing[1] );
//  $printing[1] = eregi_replace( "<font[^>]*>", "", $printing[1] );
//  $printing[1] = eregi_replace( "</font>", "", $printing[1] );
//  $printing[1] = eregi_replace( "<tr[^>]*>", "<li>", $printing[1] );
//  $printing[1] = eregi_replace( "<td[^>]*>", "", $printing[1] );
//  $printing[1] = eregi_replace( "</tr>", "", $printing[1] );
//  $printing[1] = eregi_replace( "</td>", "", $printing[1] );

  $text = $printing[1];
}

echo $text;
?>
      </p>
      <p>&nbsp;</p>
    </td>
  </tr>
  <tr valign="bottom" bgcolor="#FFFFFF">
    <td>
      <p><img src="_images/trans-grau.gif" width="650" height="1"><br>
        Datum:
        <?php  echo date("d.m.Y"); ?>
        <br>
        URL:
        <?php  echo $_SERVER["HTTP_REFERER"]; ?>
        <br>
            Copyright &copy; 2003/<?php echo date('Y'); ?> Pluspunkt</p>
      </td>
  </tr>
</table>

</body>
</html>
