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

					<form action="/admin/newsletter/add" method="post">
                    <div class="siteOptions">
                        <input name="newNewsletter" id="newNewsletter" type="submit" value="Neuen Newsletter anlegen" />
                    </div>
                    </form>
                    <h2>Newsletter &Uuml;bersicht</h2>

                    <div class="list">
                        <!--
                        <ul>
                            <li class="headline">
                                <div style="width:120px">Optionen:</div>
                                <div style="width:90px;">Datum:</div>
                                <div style="width:70px;">Sichtbar:</div>
                                <div style="width:70px;">Up / Down:</div>
                                Name:
                            </li>
                        -->
                            [ newsletterList ]
                        <!--
                        </ul>
                        -->
                    </div>
