jQuery(document).ready(function ($) {

    // for removing unnecessary p tags from frontend
    $('.gutenix_pro_comment_votes-like-dislike-wrapper p').filter(function () {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
    }).remove()
    // for removing unnecessary br tags from frontend
    $('.gutenix_pro_comment_votes-like-dislike-wrapper').find('br').remove()
    
    // For like/Dislike and total counter
    $('.gutenix_pro_comment_votes-like-dislike-trigger').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var comment_id = $(this).data('comment-id');
        var trigger_type = $(this).data('trigger-type');
        
        if (trigger_type == 'like') {
            var current_count = $this.closest('.gutenix_pro_comment_votes-common-wrap').find('.gutenix_pro_comment_votes-like-count-wrap').html();
            var end_character = current_count.slice(-1);
            if ($this.hasClass("already-liked")){
                if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T") {
                    new_count = current_count;
                } else{
                    var new_count = parseInt(current_count) - 1;
                }
            }
            else{
                if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T"){
                    new_count = current_count;
                } else{
                    var new_count = parseInt(current_count) + 1;
                }
            }
        }
        else {
            var current_count = $this.closest('.gutenix_pro_comment_votes-common-wrap').find('.gutenix_pro_comment_votes-dislike-count-wrap').html();
            var end_character = current_count.slice(-1);
            if ($this.hasClass("already-disliked")){
                if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T") {
                    new_count = current_count;
                } else{
                    var new_count = parseInt(current_count) - 1;
                }
            } else{
                if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T") {
                    new_count = current_count;
                } else{
                    var new_count = parseInt(current_count) + 1;
                }
            }
        }

        var selector = $(this);
        var user_id = gutenix_pro_comment_likes_obj.user_id;
        var user_ip = gutenix_pro_comment_likes_obj.user_ip;
        var restriction = gutenix_pro_comment_likes_obj.restriction_check;
        var logged_in = gutenix_pro_comment_likes_obj.logged_in;
        var message = gutenix_pro_comment_likes_obj.error_message;
        var number_format = gutenix_pro_comment_likes_obj.number_format;
        
        if (logged_in == '1') {
            if ($this.hasClass('gutenix_pro_comment_votes-like-trigger')) {
                $this.toggleClass("already-liked");
                $this.parent().toggleClass("have-liked");
                $('.gutenix_pro_comment_votes-dislike-trigger', $this.closest(".gutenix_pro_comment_votes-like-dislike-wrapper")).removeClass("already-disliked");
                $this.parent().siblings().removeClass("have-disliked");
            }
            if ($this.hasClass('gutenix_pro_comment_votes-dislike-trigger')) {
                $this.toggleClass("already-disliked");
                $this.parent().toggleClass("have-disliked");
                $('.gutenix_pro_comment_votes-like-trigger', $this.closest(".gutenix_pro_comment_votes-like-dislike-wrapper")).removeClass("already-liked");
                $this.parent().siblings().removeClass("have-liked");
            }
            
            //for Immediate Change in Counts
            if (trigger_type == 'like') {
                $('#gutenix_pro_comment_votes-like-count-' + comment_id).html(new_count);
            } else {
                $('#gutenix_pro_comment_votes-dislike-count-' + comment_id).html(new_count);
            }

            gutenix_pro_comment_likes_callRating_loggedIn(comment_id, user_id, logged_in, trigger_type, new_count, number_format, $this );
        } else {
            //not logged-in check
            $('#gutenix_pro_comment_votes-message-' + comment_id).html(gutenix_pro_comment_likes_obj.error_message).show();
            setTimeout(function () {
                $('#gutenix_pro_comment_votes-message-' + comment_id).fadeOut();
            }, 2000);
        }
    });

    /*
     * Only Logged In Users
     */
    function gutenix_pro_comment_likes_callRating_loggedIn(comment_id, user_id, logged_in, trigger_type, new_count, number_format, $this) {
        $.ajax({
            type: 'post',
            url: gutenix_pro_comment_likes_obj.ajax_url,
            data: {
                comment_id: comment_id,
                user_id: user_id,
                logged_in: logged_in,
                action: 'gutenix_pro_comment_votes_comment_ajax_action',
                type: trigger_type,
                number_format: number_format,
                _wpnonce: gutenix_pro_comment_likes_obj.ajax_nonce
            },
            beforeSend: function (xhr) {
            },
            success: function (res) {
                res = $.parseJSON(res);
                var latest_count = res.latest_count;
                var latest_like_count = res.latest_like_count;
                var latest_dislike_count = res.latest_dislike_count;
                if (trigger_type == 'like') {
                    $('#gutenix_pro_comment_votes-like-loader-' + comment_id).hide();
                    $('#gutenix_pro_comment_votes-like-count-' + comment_id).html(latest_count);
                    $('#gutenix_pro_comment_votes-dislike-count-' + comment_id).html(latest_dislike_count);
                }
                else {
                    $('#gutenix_pro_comment_votes-dislike-loader-' + comment_id).hide();
                    $('#gutenix_pro_comment_votes-dislike-count-' + comment_id).html(latest_count);
                    $('#gutenix_pro_comment_votes-like-count-' + comment_id).html(latest_like_count);
                }
            }
        });
    }
});