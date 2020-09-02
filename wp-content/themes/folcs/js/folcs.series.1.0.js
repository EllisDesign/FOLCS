( function( $ ) {

$(document).ready(function(){

  $('.js-event-series').on('click', function(e){
    e.stopPropagation();

    if(!$('.js-event-series').hasClass('is-active')){

      $('.js-event-series').addClass('is-active');
      $('.intro').addClass('has-nav');
      $('.js-series-filters').fadeIn(200);

      $('body').on('click', function(){
        $('.js-event-series').removeClass('is-active');
        $('.intro').removeClass('has-nav');
        $('.js-series-filters').fadeOut(200);
        $('body').off('click');
      })

    }else {
      $('.js-event-series').removeClass('is-active');
      $('.intro').removeClass('has-nav');
      $('.js-series-filters').fadeOut(200);
    }
  });

});

$(window).resize(function() {
  $('.js-event-series').removeClass('is-active');
  $('.intro').removeClass('has-nav');
  $('.js-series-filters').fadeOut(200);
});

}( jQuery3_3_1 ) );