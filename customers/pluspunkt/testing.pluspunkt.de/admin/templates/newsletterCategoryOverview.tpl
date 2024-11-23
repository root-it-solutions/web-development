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

					<form action="/admin/newsletter/newsletterCategory/add" method="post">
                    <div class="siteOptions">
                        <input name="newNewsletterCategory" id="newNewsletterCategory" type="submit" value="Neue Kategorie anlegen" />
                    </div>
                    </form>
                    <h2>Newsletterkategorie &Uuml;bersicht</h2>

                    <div class="list">
                        <ul>
                            <li class="headline">
                                <div style="width:120px">Optionen:</div>
                                <div style="width:70px;">Position:</div>
                                Newsletterkategorie:
                            </li>
                            [ newsletterCategoryList ]
                        </ul>
                    </div>
