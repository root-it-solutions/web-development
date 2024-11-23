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
});
</script>

					<form action="/admin/list/listEntries/[ list_id ]/add" method="post">
                    <div class="siteOptions">
                        <a href="/admin/list" title="Zur&uuml;ck" class="buttonBack">Zur&uuml;ck</a>
                        <input name="newListEntry" id="newListEntry" type="submit" value="Neuen Eintrag anlegen" />
                    </div>
                    </form>
                    <h2>[ listName ] - Listeneintr&auml;ge &Uuml;bersicht</h2>

                    <div class="list">
                        <ul>
                            <li class="headline">
                                <div style="width:130px">Optionen:</div>
                                <div style="width:370px;">Teaser:</div>
                                Titel:
                            </li>
                            [ listEntriesList ]
                        </ul>
                    </div>
