<script type="text/javascript" src="[ jsdir ]/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
    $(function() {
    $('textarea.tinymce').tinymce({
    // Location of TinyMCE script
    script_url : '[ jsdir ]/tinymce/jscripts/tiny_mce/tiny_mce.js',
    // General options
    language : 'de',
    theme : "advanced",
    oninit : "setPlainText",
    plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "lists/template_list.js",
    external_link_list_url : "lists/link_list.js",
    external_image_list_url : "lists/image_list.js",
    media_external_list_url : "lists/media_list.js",

    });
    });
    function setPlainText() {
        var ed = tinyMCE.activeEditor;

        ed.pasteAsPlainText = true;  

        //adding handlers crossbrowser
        if (tinymce.isOpera || /Firefox\/2/.test(navigator.userAgent)) {
            ed.onKeyDown.add(function (ed, e) {
                if (((tinymce.isMac ? e.metaKey : e.ctrlKey) && e.keyCode == 86) || (e.shiftKey && e.keyCode == 45))
                    ed.pasteAsPlainText = true;
            });
        } else {            
            ed.onPaste.addToTop(function (ed, e) {
                ed.pasteAsPlainText = true;
            });
        }
    }
</script>

<form action="" method="post" name="" enctype="multipart/form-data">
    <input type="hidden" name="todo" value="[ todo ]" />
    <input type="hidden" name="id" value="[ id ]" />
    <input type="hidden" name="content_id" value="[ content_id ]" />
    <!-- siteOptions begin -->
    <div class="siteOptions">
        <a href="[ HTTP_REFERER ]" title="Zur&uuml;ck" class="buttonBack">Zur&uuml;ck</a>
        <input name="savePage" id="savePage" type="submit" value="Speichern" />
        <input name="savePageBack" id="savePageBack" type="submit" value="Speichern und Zur&uuml;ck" />
    </div>
    <!-- siteOptions end -->
    <h2><span class="coloredGrey">Seite:</span> [ todoHeadline ]</h2>

    <div class="contentTitle">Seiteninhalt</div>
    <div class="contentBox">
        <label for="motiv_id">Layout:</label><select id="template_id" name="template_id">[ templateList ]</select>
        <div class="formClear"></div>
        <label for="salutation" [ menuVisible ]>Unterseite von:</label><select name="menu_id" id="menu_id" [ menuVisible ]><option value="0"></option>[ menuList ]</select>
        <div class="formClear"></div>
        <label for="name">Men&uuml;name*:</label><input id="name" name="name" type="text" value="[ name ]" />
        <div class="formClear"></div>
        <label for="urlName">Linkname*:</label><input id="urlName" name="urlName" type="text" value="[ urlName ]" />
        <div class="formClear"></div>
        <label for="title">Title:</label><input id="title" name="title" type="text" value="[ title ]" />
        <div class="formClear"></div>
        <label for="motiv_id">Motiv:</label><select id="motive_id" name="motive_id"><option value="0"></option>[ motiveList ]</select>
        <div class="formClear"></div>
        <label for="content">Inhalt:</label><textarea id="content" name="content" class="tinymce">[ content ]</textarea>
        <div class="formClear"></div>
        <label for="metaSitetitle" [ menuVisible ]>Meta - Seitentitel:</label><input id="metaSitetitle" name="metaSitetitle" type="text" value="[ metaSitetitle ]" [ menuVisible ]/>
        <div class="formClear"></div>
        <label for="metaKeywords" [ menuVisible ]>Meta - Keywords:</label><textarea id="metaKeywords" name="metaKeywords">[ metaKeywords ]</textarea>
        <div class="formClear"></div>
        <label for="metaDescription" [ menuVisible ]>Meta - Beschreibung:</label><textarea id="metaDescription" name="metaDescription">[ metaDescription ]</textarea>
        <div class="formClear"></div>
        <label for="visible" [ menuVisible ]>Sichtbar:</label><select name="visible" id="visible"  [ menuVisible ]><option value="0" [ visibleSelected0 ]>nein</option><option value="1" [ visibleSelected1 ]>ja</option></select>
        <div class="formClear"></div>
        <label for="position" [ menuVisible ]>Position:</label><input type="text" name="position" id="position" value="[ position ]" [ menuVisible ] />
        <div class="formClear"></div>
        <label for="firstname" [ menuVisible ]>Dateiname:</label><input id="linkName" name="linkName" type="text" value="[ linkName ]" [ menuVisible ]/>
        <div class="formClear"></div>
    </div>
</form>
