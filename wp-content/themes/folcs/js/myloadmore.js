( function( $ ) {

	$('.misha_loadmore').click(function(){
		var button = $(this);

		if(!button.hasClass('is-disabled')){
			
		    var data = {
				'action': 'loadmore',
				'page' : current_pagePress
			};
 
			$.ajax({
				url : ajax_object.ajaxurl, // AJAX handler
				data : data,
				type : 'POST',
				beforeSend : function ( xhr ) {
					button.text('Loading...'); // change the button text, you can also add a preloader image
				},
				success : function( data ){
					if( data ) { 
						button.text( 'More posts' ).before(data); // insert new posts
						current_pagePress++;
	 
						if ( current_pagePress == max_pagePress ) 
							button.addClass('is-disabled'); // if last page, remove the button
	 
						// you can also fire the "post-load" event here if you use a plugin that requires it
						// $( document.body ).trigger( 'post-load' );
					} else {
						button.addClass('is-disabled'); // if no data, remove the button as well
					}
				}
			});
		}
	});

}( jQuery3_3_1 ) );