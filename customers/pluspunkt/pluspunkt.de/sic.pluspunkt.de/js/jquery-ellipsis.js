/**
 * jQuery Ellipsis Plugin
 *
 * Copyright 2011 Tim Savage - Sakura Sky
 */
(function($) {
    $.fn.ellipsis = function(options) {
        options = $.extend({
            'ellipsis': '<span class="more">...(mehr)</span>',
            'multilineClass': 'multiline',
            'trimFunction': $.fn.ellipsis.trimToWord
        }, options);

        return this.each(function() {
            var el = $(this);

            console.log($(this).css('overflow'));
            if (el.css("overflow") === "hidden") {
                // Clone current background and get content
                var text = el.html(),
                    multiline = el.hasClass(options.multilineClass),
                    t = $(this.cloneNode(true))
                        .hide()
                        .width(multiline ? el.width() : 'auto')
                        .height(multiline ? 'auto' : el.height());
                el.after(t);

                // Calculate size of content
                function height() { return t.height() > el.height(); }
                function width() { return t.width() > el.width(); }
                var func = multiline ? height : width;

                // Fit content to panel
                //console.log('Text length: '+text.length);
                while (text.length > 0 && func()) {
                    text = text.substr(0, text.lastIndexOf(' '));
                    //text = text.substr(0, text.length - 10);
                    t.html(text + options.ellipsis);
                }

                // Setup content, clean up.
                //el.html(options.trimFunction(t.html()));
                //t.remove();
                t.attr('id', 'shortText');
                t.height('456px');
                el.height('auto');
                t.show();
                el.hide();
            }
        });
    };

    // Trim the text to length (will remove extra spaces etc)
    $.fn.ellipsis.trimToLength = function (text) {
        return $.trim(text);
    };

    // Trim the text that fits to a word boundary.
    $.fn.ellipsis.trimToWord = function (text) {
        return $.trim(text);
    };
})(jQuery);
