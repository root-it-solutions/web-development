<div class="contentHalfTextShort" id="shortText">[ contentShort ]&nbsp;<span class="more">...(mehr)</span></p></div>
<div class="contentHalfText" id="completeText">[ content ]</div>
<div class="contentHalfImage" title="[ motiveName ]"><img src="[ imagesMotiveDir ]/[ motive_id ].jpg" alt="[ motiveAlt ]" title="[ motiveTitle ]"/></div>
<div class="clear"></div>
<script type="text/javascript">
    pp_jQuery(document).ready(function() {
        if(pp_jQuery(".contentHalfImage").attr("title") != 'Insights Teamrad')
        {
//        console.log('1: '+pp_jQuery('#completeText').css('overflow'));
        var orgHeight = pp_jQuery("#completeText").height();
        pp_jQuery("#completeText").hide();
        //pp_jQuery("#completeText").height( 456 );//pp_jQuery(".contentHalfImage").height() );
        //pp_jQuery('.ellipsis').ellipsis();
        //console.log('ContentJS');

        function expandDiv(event) {
            pp_jQuery("#shortText").hide();
            pp_jQuery("#completeText").show();
            return false;
        }

        if(orgHeight > pp_jQuery(".contentHalfImage").height())
        {
            pp_jQuery(".more").click(expandDiv);
        }
        }
        else
        {
            pp_jQuery("#shortText").hide();
        }
    });
</script>
