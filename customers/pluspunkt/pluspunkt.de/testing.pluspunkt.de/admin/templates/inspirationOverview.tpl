<script type="text/javascript">
$(document).ready(function()
{
    /* hide the all of the element with class contentBox */
    $(".contentBox").hide();
    /* toggle the componenet with class contentTitle */
    $(".contentTitle").click(function()
    {
        if($(this).attr("class") == "contentTitle")
        {
            $(this).removeClass("contentTitle");
            $(this).addClass("contentTitleOpen");
        }
        else
        {
            $(this).removeClass("contentTitleOpen");
            $(this).addClass("contentTitle");
        }
        $(this).next(".contentBox").slideToggle(600);
    });
    $(".various").fancybox({
        maxWidth    : 550,
        maxHeight   : 300,
        fitToView   : false,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });
});
</script>

                    <div class="siteOptions">
                        <a href="/admin/csv">CSV Downloaden</a>
                    </div>
                    <h2>Teilnehmer &Uuml;bersicht</h2>

                    <div class="list">
                        <ul>
                            <li class="headline insp">
                                <div style="width:170px">Optionen:</div>
                                <div style="width:55px;">Anzahl<br />Kinder:</div>
                                <div style="width:80px;">Anzahl<br />Erwachsene:</div>
                                <div style="width:200px;">E-Mail:</div>
                                Name:
                            </li>
                            [ inspirationList ]
                        </ul>
                    </div>
