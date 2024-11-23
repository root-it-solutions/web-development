<html>
</head>
	<title>DVD Trainer Demo Video</title>
</head>
<body style="margin:0;padding:0;">

<?php 
if($_GET['player'] == 'wmp' || !strlen($_GET['player'])) {
	?>
<object id=MediaPlayer classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715" width="320" height="309" standby="Video wird geladen" type="application/x-mplayer2">
 <param name=FileName VALUE="rtsp://streaming1.domainfactory.de/771/Pluspunkt_<?php echo $_GET[video];?>.wmv">
 <param name=TransparentAtStart value="true"><param name=AutoStart value="true">
 <param name=AnimationatStart value="false">
 <param name=ShowStatusBar value="true">
 <param name=ShowControls value="true">
 <param name=autoSize value="false">
 <param name=displaySize value="false">
 <param name=ShowAudioControls value="false">
 <param name=ShowPositionControls value="true">
 <embed type="application/x-mplayer2" pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" src="Pluspunkt_<?php echo $_GET[video];?>.wmv" Name="MediaPlayer" width="320" height="309" transparentAtStart="1" autostart="1" animationAtStart="0" ShowControls="1" ShowAudioControls="0" autoSize="0" ShowStatusBar="1" displaySize="false"></embed>
</object>
	<?php 
}
else {
	?>
	<EMBED SRC="<?php echo $_GET[video];?>" TYPE="audio/x-pn-realaudio-plugin" CONTROLS="ImageWindow,ControlPanel,StatusBar" width="320" height="309">
	<?php 
}
?>

<div style="text-align:center;">
	<a href="javascript:;" onClick="self.close();">Fenster schliessen</a>
	<!--<a href="show-video.php?video=<?php echo $_GET[video];?>&player=rm">Real Player</a>
	<a href="show-video.php?video=<?php echo $_GET[video];?>&player=wmp">Windows Media</a>-->
	<?php /*?><a href="javascript:;" onClick="alert('Die Videos sind derzeit nur als Real Media Dateien verfügbar!');">Windows</a><?php */?>
</div>
</body>
</html>
