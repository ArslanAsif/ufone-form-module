/**
 * cbpAnimatedHeader.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
var cbpAnimatedHeader = (function() {

	var docElem = document.documentElement,
		header = document.querySelector( '.navbar-default' ),
		didScroll = false,
		changeHeaderOn = 170;

	function init() {
		window.addEventListener( 'scroll', function( event ) {
			if( !didScroll ) {
				didScroll = true;
				setTimeout( scrollPage, 250 );
			}
		}, false );
	}

	function scrollPage() {
		var sy = scrollY();
        var i = 0;
        var j = 0;
		if ( sy >= changeHeaderOn ) {
			classie.add( header, 'navbar-shrink' );
            document.getElementsByClassName("navbar-nav")[i].style.display = 'block';
            i++
		}
		else {
			classie.remove( header, 'navbar-shrink' );
            document.getElementsByClassName("navbar-nav")[j].style.display = 'none';
            j++;
		}
		didScroll = false;
	}

	function scrollY() {
		return window.pageYOffset || docElem.scrollTop;
	}

	init();

})();