( function( $ ) {


$(document).ready(function(){


	$('.js-bio').on('click', function(e){
		e.preventDefault();

		var $bio = $('.js-bio-detail'),
			$details = $(this).siblings('.js-bio-details'),
			portrait = $(this).siblings('.js-bio-portrait').data('portrait'),
			name = $details.data('name'),
			title = $details.data('title'),
			details = $(this).siblings('.leadership-bio-data').html();

		
		$bio.find('.leadership-bio-portrait-item').css({ 'background-image' : 'url('+portrait+')' });
		$bio.find('h2').html(name);
		$bio.find('p').html(title);
		$bio.find('.leadership-bio-details').html(details);

		$bio.fadeIn(400);
		$('body').addClass('no-scroll');
	})

	$('.js-bio-close').on('click', function(){
		$('.js-bio-detail').fadeOut(400);
		$('body').removeClass('no-scroll');
	})

});

}( jQuery3_3_1 ) );