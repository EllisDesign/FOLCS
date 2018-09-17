( function( $ ) {

$(document).ready(function(){

	if($('.no-mobile').first().css('display') != 'none'){

		$('body').addClass('is-scroll');
	    var controller = new ScrollMagic.Controller();

	    $('.js-opacity').each(function() {

	    	var el = $('.js-opacity');
	    	var trigger = $('.js-trigger');
	    	var triggerHook = 'onEnter';

		    var fadeOut = new TweenMax.fromTo(el, 1, 
	    		{opacity: 1},
	    		{opacity: 0,
	    		ease: Power1.easeInOut}
	    		);
		    

		    new ScrollMagic.Scene({ triggerElement: trigger, triggerHook: triggerHook, duration: '100%' })
				.setTween(fadeOut)
				.addTo(controller);

		});
	}

})

}( jQuery3_3_1 ) );