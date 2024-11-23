<script src="[ jsdir ]/jquery.validationEngine-de.js" type="text/javascript" charset="utf-8"></script>
<script src="[ jsdir ]/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function()
{
    $("#newsletterSigninForm").validationEngine('attach', { relative: true });
    $(".newsletterSigninButton").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'elastic',
        closeEffect : 'elastic',
        isOverflown : 'true'
    });
});
</script>
<div class="newsletter signinButton">
    <a href="#signinFormular" id="newsletterSigninButton" title="Newsletter Anmeldung" class="newsletterSigninButton">Newsletter Anmeldung</a>
</div>
<div class="clear"></div>
<div class="newsletter signinFormular" id="signinFormular">
    <h3>Newsletter Anmeldung</h3>
    <div class="formular">
        <form name="newsletterSigninForm" id="newsletterSigninForm" action="" method="post">
            <input type="hidden" name="todo" value="newsletterSignin" />
             <table>
                 <tr>
                     <td class="first">Vorname *</td>
                     <td class="wert"><input name="firstname" id="firstname" type="text" value="[ formFirstname ]" class="validate[required] text-input" /></td>
                 </tr>
                 <tr>
                     <td class="first">Name *</td>
                     <td class="wert"><input name="lastname" id="lastname" type="text" value="[ formLastname ]" class="validate[required] text-input" /></td>
                 </tr>
                 <tr>
                     <td class="first">E-Mail *</td>
                     <td class="wert"><input name="email" id="email" type="text" value="[ formEmail ]" class="validate[required,custom[email]]" /></td>
                 </tr>
                 <tr>
                     <td class="first">Geschlecht</td>
                     <td class="wert">
                        <input name="gender" id="gender" type="radio" value="0" [ checkedGender0 ]/> m&auml;nnlich&nbsp;<input name="gender" id="gender" type="radio" value="1" [ checkedGender1 ]/> weiblich
                    </td>
                 </tr>
                 <tr>
                     <td class="first">Newsletter als HTML Mail</td>
                     <td class="wert"><input name="html" id="html" type="checkbox" value="1" [ checkedHtml1 ]/></td>
                 </tr>
                 <tr>
                    <td class="first">
                    Bitte geben Sie die angezeigten Zeichen ein. *<br />
                    <img id="captcha" src="[ imagesdir ]/securimage_show.php" alt="CAPTCHA Image" />
                    <br /><a href="#" onclick="document.getElementById('captcha').src = '[ imagesdir ]/securimage_show.php?' + Math.random(); return false">Bild neuladen.</a>
                    </td>
                    <td class="wert"><br /><br /><input type="text" name="captcha_code" id="captcha_code" size="10" maxlength="6" class="validate[required] text-input" /><br /><small>Nach Groß- und Kleinschreibung wird nicht unterschieden.</small>
                    </td>
                 </tr>
                 <tr>
                     <td class="first">&nbsp;</td>
                     <td class="wert"><small>* Pflichtfelder</small><br /><input type="submit" value="Anmelden" id="submit" /></td>
                 </tr>
             </table>
        </form>
    </div><!-- div class="formular" -->
</div><!-- div class="newsletter signinFormular" id="signinFormular" -->
