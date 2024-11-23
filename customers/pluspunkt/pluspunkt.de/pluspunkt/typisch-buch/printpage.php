<?php
date_default_timezone_set('Europe/Berlin');
IF (!$HTTP_SERVER_VARS["HTTP_REFERER"])
{
  header("Location: http://www.typisch-buch.de");
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
          document.write("<link rel=stylesheet type=\"text/css\" href=\"http://www.enwhp.org/enwhp.css\">");
        }
      }
    }
  }
}
-->
</script>
</head>
<body onLoad="window.print()">

<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top" bgcolor="#FFFFFF"> 
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top"> 
          <td width="54%"><img src="/_images/logo-typisch_schwarz.gif" width="300" height="102"></td>
          <td width="46%"><font color="#333333" size="-1" face="Arial, Helvetica, sans-serif"><b>Pluspunkt 
            GmbH </b></font><br>
            <br>
            <font color="#333333" size="-1" face="Arial, Helvetica, sans-serif">Appelh&uuml;lsener 
            Stra&szlig;e 25 <br>
            48308 Senden <br>
            Tel: &nbsp;(02597) 95 53 <br>
            Fax: (02597) 95 54<br>
            Web: <a href="http://www.pluspunkt.de" target="_blank">www.pluspunkt.de</a><br>
            E-Mail: <a href="mailto:info@pluspunkt.de">info@pluspunkt.de</a></font></td>
        </tr>
      </table>
      <br>
      <img src="_images/trans-grau.gif" width="650" height="1"></td>
  </tr>
  <tr> 
    <td><br>
<?php
//$file = fopen("$HTTP_SERVER_VARS[HTTP_REFERER]", "r");
//$inhalt = fread($file, 90000);
//fclose($file);

$inhalt = ("$HTTP_SERVER_VARS[HTTP_REFERER]");
$inhalt = join('', file($inhalt));

if(eregi("<!--start -->(.*)<!--end -->", $inhalt, $printing))
{
//  $printing[1] = eregi_replace( "<IMG SRC=[^>]*>", "", $printing[1] );
  $printing[1] = eregi_replace( "background=[^>]", "", $printing[1] );  
  $printing[1] = eregi_replace( "height=[^>]", "", $printing[1] );   
//  $printing[1] = eregi_replace( "<font[^>]*>", "", $printing[1] ); 
//  $printing[1] = eregi_replace( "</font>", "", $printing[1] ); 
//  $printing[1] = eregi_replace( "<tr[^>]*>", "<li>", $printing[1] );  
//  $printing[1] = eregi_replace( "<td[^>]*>", "", $printing[1] ); 
//  $printing[1] = eregi_replace( "</tr>", "", $printing[1] ); 
//  $printing[1] = eregi_replace( "</td>", "", $printing[1] ); 

  $text = $printing[1];
}

echo $text;
?> </td>
  </tr>
  <tr valign="bottom" bgcolor="#FFFFFF"> 
    <td> 
      <p><img src="_images/trans-grau.gif" width="650" height="1"><br>
        Datum: 
        <?php echo date("d.m.Y"); ?>
        <br>
        URL: 
        <?php echo "$HTTP_SERVER_VARS[HTTP_REFERER]"; ?>
        <br>
        Copyright &copy; 2002 Pluspunkt GmbH</p>
      </td>
  </tr>
</table>

</body>
</html>
