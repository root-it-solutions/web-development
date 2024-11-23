<?php 
$next_event = mysql_query("SELECT * FROM seminar_termine ORDER BY id DESC LIMIT 1",$db);
$next_event_array = mysql_fetch_array($next_event);
?>
<table width="250" border="0" cellspacing="0" cellpadding="0" height="63">
  <tr>
    <td align="right" valign="top" class="bolddark">N&auml;chster Termin:&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top" class="boldnorm"><?php  echo $next_event_array[art];?>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top" class="boldnorm"><?php  echo $next_event_array[datum];?>&nbsp;<?php  echo $next_event_array[ort];?>&nbsp;&nbsp;</td>
  </tr>
</table>
