jQuery(document).ready(function ($) {

    var $cookie_popup_close = Cookies.get('gutenix_pro_popup_closed');

    if( 'do-not-show' != $cookie_popup_close && jQuery('#gutenix_pro-subscribe_popup').length > 0 ) {

        setTimeout( function(){
            jQuery('body').addClass('is-overlay').addClass('gutenix_pro-subscribe_popup_active');
        }, 5000 );

        jQuery('#gutenix_pro-subscribe_popup input[type="checkbox"]').on('click', function(){
            Cookies.set('gutenix_pro_popup_closed','do-not-show',{expires:7,path:'/'});
        });

        jQuery('.gutenix_pro-subscribe_popup-overlay, .gutenix_pro-subscribe_popup-close').on('click', function(){
            jQuery('body').removeClass('is-overlay').removeClass('gutenix_pro-subscribe_popup_active');
        });
    }
});