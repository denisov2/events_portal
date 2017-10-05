(function($){
	'use strict';
	
	$(window).scroll(function(){
		if ($(window).scrollTop() >= 300) {
			$('.header-style-1').addClass('fixed-header-class');
			$('.mobile-header').addClass('fixed-header-class');
		}
		else {
			$('.header-style-1').removeClass('fixed-header-class');
			$('.mobile-header').removeClass('fixed-header-class');
		}
	});

} )( jQuery );