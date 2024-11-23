<script type="text/javascript" src="[ jsdir ]/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="[ jsdir ]/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="[ jsdir ]/jquery.ui.datepicker-de.js"></script>
<link media="screen" href="[ cssdir ]/datepicker/jquery-ui-1.8.16.custom.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
</script>

<form action="" method="post" name="" enctype="multipart/form-data">
    <input type="hidden" name="todo" value="[ todo ]" />
    <input type="hidden" name="id" value="[ id ]" />
    <!-- siteOptions begin -->
    <div class="siteOptions">
        <a href="[ HTTP_REFERER ]" title="Zur&uuml;ck" class="buttonBack">Zur&uuml;ck</a>
        <input name="savePage" id="savePage" type="submit" value="Speichern" />
        <input name="savePageBack" id="savePageBack" type="submit" value="Speichern und Zur&uuml;ck" />
    </div>
    <!-- siteOptions end -->
    <h2><span class="coloredGrey">Termine:</span> [ todoHeadline ]</h2>

    <div class="contentTitle">Seiteninhalt</div>
    <div class="contentBox">
        <label for="name">Name:</label><input id="name" name="name" type="text" value="[ name ]" />
        <div class="formClear"></div>
        <label for="street">Stra&szlig;e:</label><input id="street" name="street" type="text" value="[ street ]" />
        <div class="formClear"></div>
        <label for="zipCodeCity">PLZ / Ort:</label><input id="zipCodeCity" name="zipCodeCity" type="text" value="[ zipCodeCity ]" />
        <div class="formClear"></div>
        <label for="fon">Telefon:</label><input id="fon" name="fon" type="text" value="[ fon ]" />
        <div class="formClear"></div>
        <label for="email">E-Mail:</label><input id="email" name="email" type="text" value="[ email ]" />
        <div class="formClear"></div>
        <label for="amountParents">Anzahl Erwachsene:</label><input id="amountParents" name="amountParents" type="text" value="[ amountParents ]" />
        <div class="formClear"></div>
        <label for="amountChildren">Anzahl Kinder:</label><input id="amountChildren" name="amountChildren" type="text" value="[ amountChildren ]" />
        <div class="formClear"></div>
        <label for="ageChildren">Alter der Kinder:</label><input id="ageChildren" name="ageChildren" type="text" value="[ ageChildren ]" />
        <div class="formClear"></div>
    </div>
</form>
