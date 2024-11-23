<?php  
require "../_inc/db_zugang.inc.php";
$seitentitel = "Pluspunkt Unternehmensentwicklung - Seminare";
$titel = "seminare";
$hauptmenue=2;
$submenue=2;
?>
<html>
<head>
<title><?php  echo "$seitentitel";?></title>
<?php  require "../_inc/meta.inc.php"; ?>
<link rel="stylesheet" href="../plus-style.css" type="text/css">
<script language="JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
//-->
</script>
</head>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('../_images/k-topseminar.jpg')">
<?php  require "../_inc/header-$hauptmenue.inc.php"; ?>
<table width="640" border="0" cellspacing="0" cellpadding="0" align="center" name="content">
  <tr> 
    <td bgcolor="#77787C" width="628">
      <table width="608" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td colspan="2" height="24">&nbsp;</td>
        </tr>
        <tr> 
          <td width="219" valign="top"> 
            <?php  require "../_inc/submenue-$submenue.inc.php"; ?>
            <br>
            <a href="http://www.fuehrungsseminar.net" target="_blank" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image31','','../_images/k-topseminar.jpg',1)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img name="Image31" border="0" src="../_images/k-topseminar-1.jpg" width="80" height="80" alt="Das Pluspunkt Top-Seminar"></a> 
          </td>
          <td width="389" valign="top" bgcolor="#D6D6D6"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="20" valign="top">
              <tr bgcolor="#76797B"> 
                <td valign="top"> <img src="../_images/seminare.gif" width="74" height="15"><br>
                  <table width="100%" border="0" cellspacing="1" cellpadding="1" valign="top">
                    <tr> 
                      <td colspan="2">&middot;&nbsp;&nbsp;<a href="seminare-anzeigen1.php"><b>Ma&szlig;geschneiderte 
                        Inhouse-Seminare</b></a></td>
                    </tr>
                    <tr> 
                      <td width="3">&nbsp;</td>
                      <td><font size="1">auf Anfrage</font></td>
                    </tr>
                    <?php 
$seminare = mysql_query("SELECT * FROM seminare WHERE status='Pluspunkt' AND visible = 1 ORDER BY reihenfolge DESC",$db);
WHILE ($seminare_ok = mysql_fetch_array($seminare))
{
if ($seminare_ok["name"] == "<b>Rhetorik-Spezial</b>"){$link = "rhetorikspezial.php";}
if ($seminare_ok["name"] == "<b>SEAL-Training</b>"){$link = "seal-training.php";}
if ($seminare_ok["name"] == "<b>Führungsseminar</b>"){$link = "fuehrungsseminar.php";}
if ($seminare_ok["name"] == "<b>Präsentationstraining</b>"){$link = "praesentationstraining.php";}
if ($seminare_ok["name"] == "<b>Leadershiptraining</b>"){$link = "leadershiptraining.php";}
if ($seminare_ok["name"] == "<b>Kommunikationstraining</b>"){$link = "kommunikationstraining.php";}
if ($seminare_ok["name"] == "<b>Kommunikationstraining für Singles</b>"){$link = "kommunikationstraining-singles.php";}  
?>
                    <tr valign="top"> 
                      <td colspan="2" height="20">&middot;&nbsp;&nbsp;<a href="<?php  echo $link;?>">
                        <?php  echo $seminare_ok["name"];?>
                        </a> 
                        <?php 
				if ($seminare_ok["teilnehmer"] == "999999"){echo "<br>&nbsp;&nbsp;&nbsp;&middot;&nbsp;".$seminare_ok["vorraussetzungen"]."<br><br>";}
				?>
                      </td>
                    </tr>
                    <?php 
if ($seminare_ok["datum"] != "")
	{
?>
                    <tr> 
                      <td width="3" valign="top">&nbsp;</td>
                      <td valign="top"><font size="1"><a href="<?php  echo ($seminare_ok["datum"] == "21. - 25.01.2008") ? "rhetorikspezial.php" : "seminare-anzeigen.php?sid=" . $seminare_ok["id"];?>">
                        <?php  echo $seminare_ok["datum"];?>
                        </a><br>
                        &nbsp;</font></td>
                    </tr>
                    <?php 
	}
}
?>
                    <br>
                    <br>
                    <br>
                  </table>
                  <p>&nbsp;</p>
                  <br>
                  <br>
                  <br>
                  <br>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td bgcolor="454545" width="12">&nbsp;</td>
  </tr>
</table>
<?php  require "../_inc/footer.inc.php"; ?>
</body>
</html>
