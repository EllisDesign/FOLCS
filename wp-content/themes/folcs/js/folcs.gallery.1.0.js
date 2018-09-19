( function( $ ) {

if($('.js-gallery')){

  var $gallery = $('.js-gallery');
  var $status = $('.js-gallery-status');
  var $total = $('.js-gallery-total');

  $gallery.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
    //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
    var i = (currentSlide ? currentSlide : 0) + 1;
    $status.text(i);
    $total.text(slick.slideCount);
  });

  $gallery.slick({
    speed: 750
  });

}

$('.js-multi-gallery').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 640,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

// $('.responsive').slick({
//   dots: true,
//   infinite: false,
//   speed: 300,
//   slidesToShow: 4,
//   slidesToScroll: 4,
//   responsive: [
//     {
//       breakpoint: 1024,
//       settings: {
//         slidesToShow: 3,
//         slidesToScroll: 3,
//         infinite: true,
//         dots: true
//       }
//     },
//     {
//       breakpoint: 600,
//       settings: {
//         slidesToShow: 2,
//         slidesToScroll: 2
//       }
//     },
//     {
//       breakpoint: 480,
//       settings: {
//         slidesToShow: 1,
//         slidesToScroll: 1
//       }
//     }
//     // You can unslick at a given breakpoint now by adding:
//     // settings: "unslick"
//     // instead of a settings object
//   ]
// });

// if($('.js-gallery')){

  // $slickElement.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
  //     //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
  //     var i = (currentSlide ? currentSlide : 0) + 1;
  //     $status.text(i + '/' + slick.slideCount);
  // });

  // var $gallery = $('.single-item');
  // var slideCount = null;

  // $gallery.on('init', function(event, slick){
  //   slideCount = slick.slideCount;
  //   setSlideCount();
  //   setCurrentSlideNumber(slick.currentSlide);
  // });

  // $gallery.on('beforeChange', function(event, slick, currentSlide, nextSlide){
  //   setCurrentSlideNumber(nextSlide);
  // });

  // function setCurrentSlideNumber(currentSlide) {
  //   var $el = $('.slide-count-wrap').find('.current');
  //   $el.text(currentSlide + 1);
  // }
// }

}( jQuery3_3_1 ) );