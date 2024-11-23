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

					<form action="/admin/appointment/add" method="post">
                    <div class="siteOptions">
                        <input name="newAppointment" id="newAppointment" type="submit" value="Neuen Termin anlegen" />
                    </div>
                    </form>
                    <h2>Termin &Uuml;bersicht</h2>

                    <div class="list">
                        <ul>
                            <li class="headline">
                                <div style="width:120px">Optionen:</div>
                                <div style="width:90px;">End Datum:</div>
                                <div style="width:90px;">Start Datum:</div>
                                <div style="width:70px;">Sichtbar:</div>
                                Seminar:
                            </li>
                            [ appointmentList ]
                        </ul>
                    </div>
