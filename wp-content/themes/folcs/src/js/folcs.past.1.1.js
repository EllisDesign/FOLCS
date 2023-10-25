( function( $ ) {

$(document).ready(function(){

  var queryString = window.location.search,
      urlParams = new URLSearchParams(queryString),
      eventSeries = urlParams.get('es');

  if(eventSeries != null){
    $('.filter-'+eventSeries).addClass('is-active');
  }else{
    $('.filter-all').addClass('is-active');
  }


  $('.js-past-events').on('click', function(e){
    e.stopPropagation();

    if(!$('.js-past-events').hasClass('is-active')){

      $('.js-past-events').addClass('is-active');
      $('.js-past-event-filters').fadeIn(200);

      $('body').on('click', function(){
        $('.js-past-events').removeClass('is-active');
        $('.js-past-event-filters').fadeOut(200);
        $('body').off('click');
      })

    }else {
      $('.js-past-events').removeClass('is-active');
      $('.js-past-event-filters').fadeOut(200);
    }
  });


  $('.js-past-event-filters').on('click', 'li', function(e){

    if(!$(this).hasClass('is-active')){
      
      var filter = $(this).data('filter');

      if(filter == 'all'){
        // window.location.href = window.location.href.split("?")[0];
        window.location.href = '/past-events/';
      }else{
        // window.location.href = window.location.href.replace( /[\?#].*|$/, '?es='+filter );
        window.location.href = '/past-events/?es='+filter;
      }
    }
  });

});

$(window).resize(function() {
  $('.js-past-events').removeClass('is-active');
  $('.js-past-event-filters').fadeOut(200);
});

}( jQuery3_3_1 ) );