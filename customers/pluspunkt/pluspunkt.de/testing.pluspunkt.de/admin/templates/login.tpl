<!DOCTYPE html>
<html lang="de">
    <head>
        <title>[ sitetitle ]</title>
        <meta charset="utf-8" />
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

		<LINK REL="SHORTCUT ICON" HREF="[ imagesdir ]/favicon.ico">
        <link media="screen" href="[ cssdir ]/reset.css" type="text/css" rel="stylesheet">
        <link media="screen" href="[ cssdir ]/login.css" type="text/css" rel="stylesheet">
        <!--[if IE]>
            <link media="screen" href="[ cssdir ]/ieHack.css" type="text/css" rel="stylesheet">
        <![endif]-->

		<script type="text/javascript" src="[ jsdir ]/jquery.js"></script>
        <script type="text/javascript" src="[ jsdir ]/functions.js"></script>
        
		<script>
			$(document).ready(function()
			{ $(".rememberBox").hide();
				$("a[rel]").click(function() {
					if($(".rememberBox").is(":hidden")) { $(".loginBox").slideToggle("slow",function() {$(".rememberBox").slideToggle("slow")}); }
					else { $(".rememberBox").slideToggle("slow",function() {$(".loginBox").slideToggle("slow")}); }
				}); });
		</script>
    </head>
	<body onkeydown="checkkeycode(event);" onLoad="onloadInit();">
		<div id="container" class="roundedTopCornersBig">
			<div id="top"></div>
            <div id="content" class="roundedCornersBig">
                <div class="loginBox">
                    <h1>Anmeldung zum Administrationsbereich</h1>
                    <noscript>
                    	<div class="noscript">Um diese Seite nutzen zu k&ouml;nnen muss Java-Script aktiviert sein!!<br /><br /></div>
                	</noscript>
	                [ message ]
                    <br />
                    <form action="" accept-charset="utf-8" method="post" name="loginForm" id="loginForm">
                        <input name="login" type="hidden" value="1" />
                        <label>Benutzername:</label>
                        <input id="username" name="username" type="text" value="" class="roundedCorners" /><br />
                        <label>Passwort:</label>
                        <input id="password" name="password" type="password" value="" class="roundedCorners" /><br />
                        <label>&nbsp;</label>
                        <input name="einloggen" id="einloggen" type="button" value="Anmelden" onClick="checkForm(this);" class="roundedCorners" /><br />
                        <label>&nbsp;</label>
                    </form>
                    <a href="javascript:void(0);" title="Passwort vergessen?" rel="#overlay">Passwort vergessen?</a>
                </div><!-- div class="loginBox" -->

                <div class="rememberBox">
                    <h1>Sie haben Ihr Passwort vergessen?</h1>
                    <br />
                    <form action="" accept-charset="utf-8" method="post" name="rememberForm" id="rememberForm">
                        <input name="rememberPassword" type="hidden" value="1" />
                        <label for="username">Benutzername:</label>
                        <input name="username" id="username" type="text" value="" class="roundedCorners" /><br />
                        <label for="senden">&nbsp;</label>
                        <input name="senden" id="senden" type="button" value="Passwort zusenden" onClick="checkForm(this);" class="roundedCorners" /><br />
                        <label>&nbsp;</label>
                    </form>
                    <a href="javascript:void(0);" title="Zur&uuml;ck" rel="#overlay">&laquo; Zur&uuml;ck</a>
                </div><!-- div class="rememberBox" -->
            </div>
		</div>
        <div id="footer" class="roundedBottomCornersBig">
            <strong>&copy; [ year ] </strong> <a href="http://www.root-services.de" title="root Computer &amp; Internet" target="_blank">root Computer &amp; Internet</a>.
        </div><!-- id="footer" -->
        <div class="viewText">
            Diese Seite ist optimiert für die Ansicht in den Browsern <a href="http://www.opera.com/" target="_blank" title="Opera Browser" rel="nofollow">Opera</a> und <a href="http://www.mozilla-europe.org/" target="_blank" title="Firefox Browser" rel="nofollow">Firefox</a>.
        </div>
	</body>
</html>
