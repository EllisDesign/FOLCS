( function( $ ) {

    var data = {
		'action': 'liverefresh'
	};

	if(isliverefresh){

		function liveRefresh(){
			console.log('waiting');

			$.ajax({
				url : ajax_object.ajaxurl,
				data : data,
				type : 'POST',
				success : function( data ){

					if( data ) { 
						window.history.replaceState(null, null, window.location.href);
						location.reload(true);
					} else {
						setTimeout(liveRefresh, 4000);
					}
				}
			});
		}

		liveRefresh();

	}

	

}( jQuery3_3_1 ) );