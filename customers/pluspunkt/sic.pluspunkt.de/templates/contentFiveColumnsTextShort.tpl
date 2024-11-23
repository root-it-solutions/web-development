<div class="contentFiveColumnsText ellipsis multiline" id="completeText">[ content ]</div>
<div class="contentFiveColumnsTextImage" title="[ motiveName ]"><img src="[ imagesMotiveDir ]/[ motive_id ].jpg" alt="[ motiveAlt ]" title="[ motiveTitle ]"/></div>
<div class="clear"></div>
<script type="text/javascript">
    pp_jQuery(document).ready(function() {
        console.log('ContentJS');
        var orgHeight = pp_jQuery("#completeText").height();
        pp_jQuery("#completeText").height( 456 );//pp_jQuery(".contentFiveColumnsTextImage").height() );
        pp_jQuery('.ellipsis').ellipsis();

        function expandDiv(event) {
            pp_jQuery("#shortText").hide();
            pp_jQuery("#completeText").show();
            return false;
        }

        if(orgHeight > pp_jQuery(".contentFiveColumnsTextImage").height())
        {
            pp_jQuery("#shortText").click(expandDiv);
        }
    });
</script>
