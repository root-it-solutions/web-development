(function($){
	$.fn.stickUp = function( options ) {

		var getOptions = {
			correctionSelector: '.correctionSelector',
			listenSelector: '.listenSelector',
			active: false,
			pseudo: true,
			effectOffset: 100
		};
		$.extend(getOptions, options);

		var _this = $( this ),
			_window = $( window ),
			_document = $( document ),
			isSticky = false,
			thisOffsetTop = 0,
			thisOuterHeight = 0,
			thisMarginTop = 0,
			thisPaddingTop = 0,
			documentScroll = 0,
			pseudoBlock,
			lastScrollValue = 0,
			scrollDir = '',
			tmpScrolled,
			effectOffset = getOptions.effectOffset,
			correctionSelector = $( getOptions.correctionSelector ),
			listenSelector = $( getOptions.listenSelector );

		if ( _this.length !== 0 ) {
			init();
		}

		function init() {
			thisOffsetTop = parseInt( _this.offset().top );
			thisMarginTop = parseInt( _this.css( "margin-top" ) );
			thisOuterHeight = parseInt( _this.outerHeight( true ) );

			if ( getOptions.pseudo ) {
				$( '<div class="pseudoStickyBlock"></div>' ).insertAfter( _this );
				pseudoBlock = $( '.pseudoStickyBlock' );
			}

			if ( getOptions.active ) {
				addEventsFunction();
			}
		}//end init

		function addEventsFunction() {
			_window.on( 'scroll.stickUp', function() {
				tmpScrolled = $( this ).scrollTop();
				if ( tmpScrolled > lastScrollValue ) {
					scrollDir = 'down';
				} else {
					scrollDir = 'up';
				}
				lastScrollValue = tmpScrolled;

				if ( correctionSelector.length !== 0 ) {
					correctionValue = correctionSelector.outerHeight( true );
				} else {
					correctionValue = 0;
				}

				documentScroll = parseInt( _window.scrollTop() );
				if ( thisOffsetTop + thisOuterHeight - correctionValue < documentScroll ) {
					_this.addClass( 'is-sticky' );
					listenSelector.addClass( 'is-sticky' );
					_this.css( { position: "fixed", top: correctionValue } );
					if ( getOptions.pseudo ) {
						pseudoBlock.css( { "height": thisOuterHeight } );
					}
					isSticky = true;
				} else {
					unsticky();
				}

				if ( thisOffsetTop + thisOuterHeight + effectOffset - correctionValue < documentScroll ) {
					_this.addClass( 'is-sticky-transition' );
					_this.addClass( 'is-sticky-effect' );
				} else {
					_this.removeClass( 'is-sticky-effect' );
				}
			} ).trigger( 'scroll.stickUp' );

			_window.on( 'resize.stickUp', function() {
				if ( _this.hasClass( 'is-sticky' ) ) {
					if ( thisOffsetTop !== parseInt( pseudoBlock.offset().top ) ) thisOffsetTop = parseInt( pseudoBlock.offset().top );
				} else {
					if ( thisOffsetTop !== parseInt( _this.offset().top ) ) thisOffsetTop = parseInt( _this.offset().top );
				}
			} )
		}

		function unsticky() {
			_this.removeClass( 'is-sticky' );
			_this.removeClass( 'is-sticky-transition' );
			listenSelector.removeClass( 'is-sticky' );
			_this.css( { position: "", top: "" } );
			if ( getOptions.pseudo ) {
				pseudoBlock.css( { "height": 0 } );
			}
			isSticky = false;
		}

		this.destroy = function() {
			if ( isSticky ) {
				unsticky();
			}

			_window.off( 'scroll.stickUp' );
			_window.off( 'resize.stickUp' );
		};

		return this;
	}//end StickUp function
})(jQuery);