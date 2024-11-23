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

					<form action="/admin/list/add" method="post">
                    <div class="siteOptions">
                        <input name="newList" id="newList" type="submit" value="Neue Liste anlegen" />
                    </div>
                    </form>
                    <h2>Listen &Uuml;bersicht</h2>

                    <div class="list">
                        <ul>
                            <li class="headline">
                                <div style="width:190px">Optionen:</div>
                                <div style="width:320px;">Beschreibung:</div>
                                Name:
                            </li>
                            [ listList ]
                        </ul>
                    </div>
