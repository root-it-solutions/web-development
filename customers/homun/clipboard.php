<?php

$lastSaved = '';
$clipboardContent = '';
$filename = 'clipboard.txt';

if ($_REQUEST["clip"] != '')
{

    $fileHandle = fopen($filename, 'w');
    fputs($fileHandle, $_REQUEST["clip"]);
    fclose($fileHandle);

}

if (file_exists($filename))
{
    $lastSaved = date('d.m.Y H:i:s.', filemtime($filename));
    $fileHandle = fopen($filename, 'r');
    $clipboardContent = str_replace([ '<', "\n" ], [ '&lt;', "<br />" ], stripslashes(fread($fileHandle, filesize($filename))));
    fclose($fileHandle);
}

echo '<div class="clipboard">
        <form name="clipForm" id="clipForm" action="" accept-charset="utf-8" method="post" enctype="multipart/form-data" autocomplete="off">
        <textarea name="clip" id="clip" cols="50" rows="10" onchange="document.getElementById(\'clipForm\').submit();"></textarea>
        <!-- <input type="text" name="email" class="emailInput" /> -->
        </form>
    <div class="lastSaved">' . $lastSaved . '</div>
    <div class="clipContent">' . $clipboardContent . '</div>
</div><!-- div class="links" -->
<div class="clear"></div>
<script>
    $(document).ready(function() {
        $(\'#clip\').change(function(){
            $.ajax({
                type: "POST",
                url: "/clipboard.php",
                data: $(\'#clip\').serialize(),
                success: function(response){
                    //window.location.href = response;
                    //alert(response);
                    location.reload();
                }//success
            });//$.ajax({
            return false;
        });
    });
</script>';

