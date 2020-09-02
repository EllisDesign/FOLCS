( function( $ ) {

$(document).ready(function(){

  $('.js-filter').on('click', function(e){
    e.stopPropagation();

    if(!$('.js-filters').hasClass('is-active')){
      var offset = $(this).offset();
      var width = $(this).outerWidth();
      var height = $(this).outerHeight();
      var top = offset.top + height;

      $('.js-filters').css({ top: top, left: offset.left, width: width }).addClass('is-active').fadeIn(200);

      $('body').on('click', function(){
        $('.js-filters').removeClass('is-active').fadeOut(200);
        $('body').off('click');
      })
    }else {
      $('.js-filters').removeClass('is-active').fadeOut(200);
    }
  });

  $('.js-filter-search').on('click', function(e){
    e.stopPropagation();
    $('.js-filters').removeClass('is-active').fadeOut(200);
    var filter = $(this).data('filter');

    if(filter === 'featured'){
      window.location.href = '/past-events/';
    }else{
      $('#qseries').val(filter);
      $('#searchform').submit();
    }

  });

});

$(window).resize(function() {
  $('.js-filters').removeClass('is-active').fadeOut(200);
});

}( jQuery3_3_1 ) );