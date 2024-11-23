<script src="[ jsdir ]/jquery.validationEngine-de.js" type="text/javascript" charset="utf-8"></script>
<script src="[ jsdir ]/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function()
{
    $("#contactForm").validationEngine();
});
</script>

<div class="formular">
    <form name="contactForm" id="contactForm" action="" method="post">
         <table>
             <tr>
                 <td class="first">Vorname / Name *</td>
                 <td class="wert"><input name="name" id="name" type="text" value="[ formName ]" class="validate[required] text-input" /></td>
             </tr>
             <tr>
                 <td class="first">Stra&szlig;e / Nr.</td>
                 <td class="wert"><input name="strasse" type="text" value="[ formStrasse ]" class="short"  /></td>
             </tr>
             <tr>
                 <td class="first">PLZ / Ort</td>
                 <td class="wert"><input name="plzCity" type="text" class="veryShort"  value="[ formPlzCity ]" /></td>
             </tr>
             <tr>
                 <td class="first">Telefon</td>
                 <td class="wert"><input name="telefon" type="text" value="[ formTelefon ]" /></td>
             </tr>
             <tr>
                 <td class="first">E-Mail *</td>
                 <td class="wert"><input name="email" id="email" type="text" value="[ formEmail ]" class="validate[required,custom[email]]" /></td>
             </tr>
             <tr>
                 <td class="first">Nachricht *</td>
                 <td class="wert"><textarea name="nachricht" id="nachricht" rows="4" class="validate[required] text-input">[ formNachricht ]</textarea></td>
             </tr>
             <tr>
                <td class="first">&nbsp;</td>
                <td class="wert"><input type="checkbox" name="selfMail" value="1" /> Kopie an Ihre Mailadresse
             </tr>
             <tr>
                <td class="first">
                    Bitte geben Sie die angezeigten Zeichen ein.<br />
                    <img id="captcha" src="[ imagesdir ]/securimage_show.php" alt="CAPTCHA Image" />
                    <br /><a href="#" onclick="document.getElementById('captcha').src = '[ imagesdir ]/securimage_show.php?' + Math.random(); return false">Bild neuladen.</a>
                </td>
                <td class="wert"><br /><br /><br /><input type="text" name="captcha_code" id="captcha_code" size="10" maxlength="6" class="validate[required] text-input" /><a href="#" onclick="document.getElementById('captcha').src = '[ imagesdir ]/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a></td>
             </tr>
             <tr>
                <td class="first" style="text-align:right;"><input type="checkbox" name="datenschutz" class="validate[required] checkbox" id="datenschutz" value="1" /></td>
                <td class="wert" style="width:70px;"><a href="https://www.pluspunkt.de/impressum/datenschutz">&quot;Ich stimme zu, dass meine Angaben aus dem Kontaktformular zur Beantwortung meiner Anfrage erhoben und verarbeitet werden. Die Daten werden nach abgeschlossener Bearbeitung Ihrer Anfrage gel&ouml;scht. Hinweis: Sie k&ouml;nnen Ihre Einwilligung jederzeit f&uuml;r die Zukunft per E-Mail an datenschutz@pluspunkt.de widerrufen. Detaillierte Informationen zum Umgang mit Nutzerdaten finden Sie in unserer Datenschutzerkl&auml;rung&quot;</a><br /><br />
             </tr>
             <tr>
                 <td class="first">&nbsp;</td>
                 <td class="wert">* Pflichtfelder<br /><input type="submit" value="Senden" id="submit" /></td>
             </tr>
         </table>
    </form>
</div><!-- div class="formular" -->
<div class="contact">B&uuml;ro Ascheberg:<br /><span style="padding-left:95px;">Tel: 02593 - 95 888 0</span><br /><br />B&uuml;ro Rinkerode:<br /><span style="padding-left:95px;">Tel: 02538 - 95 19 7</span></div>
<div class="formularAddress" style="display:none;">
    <h6>Ihr Weg zu uns:</h6>
    Pluspunkt Unternehmensentwicklung GmbH<br />
    Ostereckern 9<br />
    59387 Ascheberg<br /><br />
    <iframe width="325" height="380" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.de/maps?f=q&amp;source=s_q&amp;hl=de&amp;geocode=&amp;q=Pluspunkt+Unternehmensentwicklung+GmbH,+Ostereckern+9,+59387,+Ascheberg&amp;aq=0&amp;oq=Ostereckern%2B9,%2B59387%2BAscheberg+(Pluspunkt+Unternehmensentwicklung+GmbH)&amp;sll=51.79967,7.65638&amp;sspn=0.008891,0.022724&amp;g=Ostereckern%2B9,%2B59387%2BAscheberg%2B&amp;ie=UTF8&amp;hq=Pluspunkt+Unternehmensentwicklung+GmbH,&amp;hnear=Ostereckern+9,+59387+Ascheberg,+M%C3%BCnster,+Nordrhein-Westfalen&amp;t=m&amp;cid=3968230523347800869&amp;ll=51.807076,7.654209&amp;spn=0.020167,0.027895&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.de/maps?f=q&amp;source=embed&amp;hl=de&amp;geocode=&amp;q=Pluspunkt+Unternehmensentwicklung+GmbH,+Ostereckern+9,+59387,+Ascheberg&amp;aq=0&amp;oq=Ostereckern%2B9,%2B59387%2BAscheberg+(Pluspunkt+Unternehmensentwicklung+GmbH)&amp;sll=51.79967,7.65638&amp;sspn=0.008891,0.022724&amp;g=Ostereckern%2B9,%2B59387%2BAscheberg%2B&amp;ie=UTF8&amp;hq=Pluspunkt+Unternehmensentwicklung+GmbH,&amp;hnear=Ostereckern+9,+59387+Ascheberg,+M%C3%BCnster,+Nordrhein-Westfalen&amp;t=m&amp;cid=3968230523347800869&amp;ll=51.807076,7.654209&amp;spn=0.020167,0.027895&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Gr&ouml;&szlig;ere Kartenansicht</a></small>
</div><!-- div class="formularAddress" -->
<div class="clear"></div>
