( function( $ ) {

function scrollNext(container, remove){

    var scrollNext = '.'+container;

    jump(scrollNext, {
      duration: 750,
      callback: function(){ remove ? $(scrollNext).removeClass(container) : ''; }
    });
};


$(document).ready(function(){


	$('.js-signup').on('click', function(e){
		e.preventDefault();
		$('.js-footer-subscribe').fadeIn(400);
		$('body').addClass('no-scroll');
	});

	$('.js-subscribe-close').on('click', function(){
		$('.js-footer-subscribe').fadeOut(400);
		$('body').removeClass('no-scroll');
	});

	$('.js-share').on('click', function(e){
		e.preventDefault();

		if(!$(this).hasClass('is-active')){
			$(this).siblings('.js-social-share').fadeIn(400);
			$(this).addClass('is-active');
		}else {
			$(this).siblings('.js-social-share').fadeOut(400);
			$(this).removeClass('is-active')
		}
		
		
	})


	if($('body').hasClass('page-home')){

		$('.js-nav-upcoming-events').on('click', function(e){
			e.preventDefault();

			mainMenu.isUpcoming();
			mainMenu.closeMenu();
			
		});
	}

	function setNav() {
		var d = 'null',//c.attr("id");
		e = $('body').hasClass('invert');//c.data("menu-invert");

		mainMenu.switchNavigationGroup(d, e);
	   
	}

	!function(a, b, c) {
	    "use strict";

	    a.fn.menu = function(b) {
	        
	        function d(a) {
	            window.console.log(f + ": " + a)
	        }

	        function e() {
	            k.on("click", function(a) {
	                a.preventDefault(),
	                n ? v() : u()
	            }),
	            d("toggle button click registration")
	        }

	        var f = "jquery.menu"
	          , g = a.extend({
		            navigationDuration: .4,
		            menuDuration: 1.2,
		            stagger: .15,
		            easing: Power2,
		            debug: !1,
		            activeOnClick: !0,
		            onNavigationClick: function(a, b) {}
		        }, b)
	          , h = (a(window), a(this))
	          , i = h.find('body')
	          , k = h.find(".js-nav-menu")
	          , l = h.find(".js-main-menu")
	          , m = !0
	          , n = !1
	          , o = !1
	          , p = function(a) {
	            if (m) {
	                
	            }
	        }
	          , q = function(a) {
	            if (!m) {
	                
	            }
	            if(upcoming){
	            	scrollNext('js-upcoming-events');
	            	upcoming = false;
	            }
	        }
	          , r = function(a, b) {
	            function c(a) {
	                
	            }
	            !m || n ? c(a) : p({
	                onComplete: function() {
	                    // c(a)
	                }
	            })
	            b ? w() : x();
	        }
	          , s = function(a) {
	            c.to(h, g.menuDuration / 2, {
	                alpha: 0,
	                top: -h.height(),
	                display: "none",
	                delay: void 0 !== a ? a : 0,
	                ease: g.easing.easeInOut
	            })
	        }
	          , t = function(a) {
	            c.to(h, g.menuDuration / 2, {
	                alpha: 1,
	                top: "0",
	                display: "block",
	                delay: void 0 !== a ? a : 0,
	                ease: g.easing.easeInOut
	            })
	        }
	          , u = function() {
	            var a = l.find("li");
	            n || (n = !0,
	            k.addClass("js-has-menu"),
	            h.addClass("no-scroll"),
	            p(),
	            c.set(l, {
	                css: {
	                    display: "block",
	                    alpha: 0
	                }
	            }),
	            c.set(a, {
	                alpha: 1,
	                // scale: 1
	            }),
	            c.to(l, g.menuDuration / 2, {
	                alpha: 1,
	                delay: g.menuDuration / 4,
	                ease: g.easing.easeIn,
	                onComplete: function() {
	                    o && i.removeClass("invert");
	                }
	            }),
	            c.staggerFrom(a, g.menuDuration / 2, {
	                alpha: 0,
	                // scale: 1.2,
	                delay: g.menuDuration / 2,
	                ease: g.easing.easeInOut
	            }, g.stagger),
	            d("menu opening"))
	        }
	          , v = function() {
	            var a = l.find("li");
	            n && (n = !1,
	            k.removeClass("js-has-menu"),
	            h.removeClass("no-scroll"),
	            c.staggerTo(a, g.menuDuration / 2, {
	                alpha: 0,
	                // scale: .8,
	                ease: g.easing.easeInOut
	            }, g.stagger),
	            c.to(l, g.menuDuration / 2, {
	                alpha: 0,
	                delay: g.menuDuration / 2,
	                display: "none",
	                ease: g.easing.easeIn,
	                onStart: function() {
	                    o && i.addClass("invert");
	                },
	                onComplete: function() {
	                    q()
	                }
	            }),
	            d("menu closing"))
	        }
	          , w = function() {
	            o = !0,
	            i.addClass("invert");
	        }
	          , x = function() {
	            o = !1,
	            i.removeClass("invert");
	        }
	          , y = function(a) {
	            var b = j.find("a")
	              , c = b.filter(".active");
	            c.attr("href") !== a && (c.removeClass("active"),
	            b.filter("[href=" + a + "]").addClass("active"))
	        }
	          , z = function() {
	            return n
	        }
	          , A = function() {
	            return m
	        }
	          , B = function(a, b) {
	            h.on(a, b)
	        }
	          , C = function(a, b) {
	            h.one(a, b)
	        }
	          , D = function(a) {
	            h.off(a)
	        }, upcoming = false

	        , setUpcoming = function() {
	        	upcoming = true;
	        };
	        return e(),
	        {
	            target: this,
	            hideNavigation: p,
	            showNavigation: q,
	            switchNavigationGroup: r,
	            openMenu: u,
	            closeMenu: v,
	            isOpen: z,
	            isNavigationOpen: A,
	            invertColors: w,
	            resetColors: x,
	            setActive: y,
	            hide: s,
	            show: t,
	            on: B,
	            one: C,
	            off: D,
	            isUpcoming: setUpcoming
	        }
	    }
	}($, Modernizr, TweenMax);

	var _debug = !1,
		mainMenu = $("html").menu({
		    debug: _debug,
		    activeOnClick: !1
		});
	
	setNav();
});

}( jQuery3_3_1 ) );