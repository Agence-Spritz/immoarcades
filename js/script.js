(function (window, document, $) {
	"use strict";
	
	$(window).on('load', function () {
		/* dropdown menus */
		menu_touched_side();
		
		/* popup video */
		autoPlayYouTubeModal();
		$('.popup-video-wrap .modal').appendTo('body');
		
		/* loader */
		$(".noo-spinner").fadeOut(500, function(){
            $(".noo-spinner").remove();
        });
	});
	
	$(window).on('resize', function (event, ui) {
		menu_touched_side();
	});
	
	$(document).ready(function($) {
		var mobileTest;
		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
			mobileTest = true;
			$("html").addClass("mobile");
		}
		else {
			mobileTest = false;
			$("html").addClass("no-mobile");
		}
		
		/* check mobile screen. */
		mobile_menu();
							   
		/* pretty photo */
		if($("a.prettyphoto").length > 0) {
			$("a[data-rel^='prettyPhoto']").prettyPhoto();
		    $("a.prettyphoto").prettyPhoto();
		    $("a[data-rel^='prettyPhoto']").prettyPhoto({hook:"data-rel",social_tools:!1,theme:"pp_default",horizontal_padding:20,opacity:.8,deeplinking:!1});
		}
		
		/* fullscreen section */
		fullScreenHeight();
		
		/* google map */
		GoogleMap();
		
		/* init revolution slider */
		if ($("#rev_slider").length > 0) {
			RevolutionInit();
		}
		
		if ($("#rev_slider_2").length > 0) {
			RevolutionInitWider();
		}
		
		if ($("#rev_slider_3").length > 0) {
			RevolutionInitVideo();
		}
		
		if ($("#rev_slider_4").length > 0) {
			RevolutionInitMini();
		}
		
		if ($("#rev_slider_5").length > 0) {
			RevolutionInitSidebar();
		}
		
		if ($("#rev_slider_6").length > 0) {
			RevolutionInitFashion();
		}
		
		/* countdown */
		Countdown();
		
		//Onepage navigation
		if ($('#anchor').length > 0) $('#anchor').singlePageNav({ 'offset': 0, 'filter': '.onepage' });
		if ($('.restaurant-filter').length > 0) $('.restaurant-filter').singlePageNav({ 'offset': 0, 'filter': '.onepage' });
		if ($('.onepage-menu').length > 0) $('.onepage-menu').singlePageNav({ 'offset': 0, 'filter': '.onepage' });
		
		//Show/hide popup
		$("body").on("click", function(e) {
			var c = $(e.target);
			0 != c.parents(".mini-tools").length || c.hasClass("mini-search") || $(".mini-search,.mini-cart,.tools").removeClass("active").hide();
		}), $(".mini-search,.mini-cart,.mini-tools").on("click", function(e) {
			e.stopPropagation();
		}), $(".header-popup [data-display]").on("click", function(e) {
			var c = $(this).parents(".header-popup");
			e.stopPropagation();
			var d = $(this);
			var I = d.attr("data-display"); 
			var J = d.attr("data-no-display");
			if (I, J, $(I, c).css({
				right: 0
			}), $(I, c).hasClass("active")) $(I, c).removeClass("active").hide(); else {
				$(I, c).addClass("active").show().css("display", "block"), $(J, c).removeClass("active").hide();
				var e = $(I, c).offset().left + $(I).outerWidth() - $(window).width();
				e > 0 ? $(I, c).css({
					left: 0 - e
				}) : $(I, c).css({
					right: 0
				});
			}
		}), $(".header-popup .header-icon").on("click", function() {
			$(".popup .searchform .s").focus();
		});
		
		//Toggle Accordion
		$(document).on('show.bs.collapse hide.bs.collapse', '.accordion', function(e) {
			var $target = $(e.target)
			if (e.type == 'show')
				$target.prev('.accordion-heading').addClass('active');
			if (e.type == 'hide')
				$target.prev('.accordion-heading').removeClass('active');
		});
		
		/* carousel slider */
		owlCarousel();
		
		$(window).scroll(function() {
			if ($(this).scrollTop() > 500) {
				$("#backtotop").addClass("on");
			} else {
				$("#backtotop").removeClass("on");
			}
			if ($(this).scrollTop() > 150) {
				$('.header-scroll').addClass('header-sticky');
			} else {
				$('.header-scroll').removeClass('header-sticky');
			}
		});
		
		$('body').on('click', '#backtotop', function() {
			$("html, body").animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
		/* progress bars */
		$('.group-progressbar').each(function() {
			var $this = $(this);
			var waypoint = $this.waypoint({
				handler: function(direction) {
					$this.find('.progressbar').progressbar({ display_text: 'center' });
				},
				offset: "80%"
			});
		});
		
		/* count to */
		if ($('.counter-wraper').length > 0) {
			$('.counter-wraper').each(function(index) {
				var $this = $(this);
				var waypoint = $this.waypoint({
					handler: function(direction) {
						$this.find('.counter-digit:not(.counted)').countTo().addClass('counted');
					},
					offset: "90%"
				});
			});
		}
		
		/* split slider */
		if($('#multiScroll').length > 0) {
			if ($(window).width() > 768) {
				$('#multiScroll').multiscroll({
					sectionsColor: [],
					menu: false,
					navigation: true,
					loopBottom: true,
					loopTop: true
				});
				$('#multiscroll-nav > ul > li ').each(function(index) {
					$(this).children('a').attr('href', 'javascript:void()');
				});
			}
		}
		
		$('.banner-carousel .slide-item').each(function() {
			$(this).css('background-image', 'url("' + $(this).attr("data-src") + '")');
		});
		
		$('.portfolio-grid .masonry-item').each(function() {
			if($(this).attr("data-src") !== undefined ) {
				$(this).css('background-image', 'url("' + $(this).attr("data-src") + '")');
			}
		});
		
		$(".menu-mobile, .mobile-close").on("click", function() {
			$(".header-mobile .navigation").toggleClass("open");
		});
		$(".header-mobile .menu-toggle").on("click", function() {
			$(this).siblings("ul").toggleClass("submenu-open");
			$(this).toggleClass("open");
		});
		
		/* equal heights */
		if ($('.equalheight').length > 0) $('.equalheight').equalHeights();
		
		/* parallax */
		if (($(window).width() >= 1024) && (mobileTest == false) && $(".parallax").length > 0) {
			$('.parallax').each(function(index) {
				$(this).parallax("50%", $(this).attr("data-ratio"));
			});
        }
	});

})(window, document, jQuery);


/*=================================================================
	mobile menu function
===================================================================*/
function mobile_menu() {
	var window_width = $(window).width();
	var nav_left = $('.navigation-left').find('.main-navigation ul').html();
	var nav_right =	$('.navigation-right').find('.main-navigation ul').html();
	
	if (window_width <= 1024) {
		/* Default Header */
		$('.header-not-mobile-default').addClass("header-mobile");
		$('.navigation').addClass("mobile-nav");
		
		if($('.navigation-left').length > 0 && $('.navigation-right').length > 0) {
			$('.navigation').find('.main-navigation ul').html(nav_left + nav_right);
		}
	} else {
		/* Default Header */
		$('.header-not-mobile-default').removeClass("header-mobile");
		$('.navigation').removeClass("mobile-nav");
		
		if($('.navigation-left').length > 0 && $('.navigation-right').length > 0) {
			$('.navigation.navigation-right').find('.main-navigation ul').html(nav_right);
		}
	}
}

/*=================================================================
	fullscreen section function
===================================================================*/
function fullScreenHeight() {
	var wh = $(window).height();
	$('.section-fullscreen').css({ height: wh });
}

/*=================================================================
	countdown function
===================================================================*/
function Countdown() {
	if ($(".pl-clock").length > 0) {
		$(".pl-clock").each(function() {
			var time = $(this).attr("data-time");
			$(this).countdown(time, function(event) {
				var $this = $(this).html(event.strftime('' + '<div class="countdown-item"><div class="countdown-item-value">%D</div><div class="countdown-item-label">Days</div></div>' + '<div class="countdown-item"><div class="countdown-item-value">%H</div><div class="countdown-item-label">Hours</div></div>' + '<div class="countdown-item"><div class="countdown-item-value">%M</div><div class="countdown-item-label">Minutes</div></div>' + '<div class="countdown-item"><div class="countdown-item-value">%S</div><div class="countdown-item-label">Seconds</div></div>'));
			});
		});
	}
}

/*=================================================================
	fullscreen section function
===================================================================*/
function menu_touched_side(){
	var $menu = $('.main-navigation');
	$menu.children('ul').children('li').each(function(){
		var $submenu = $(this).children('ul');
		if($submenu.length > 0){
			if($submenu.offset().left + $submenu.width() > $(window).width()){
				$submenu.addClass('back');
			} else if($submenu.offset().left < 0){
				$submenu.addClass('back');
			}
		}            
	});
}

/*=================================================================
	owl carousel slider function
===================================================================*/
function owlCarousel(){
	if ($(".project-carousel").length > 0) {
		$(".project-carousel").each(function(){
			$(this).owlCarousel({
				items: 2,
				loop: true,
				mouseDrag: false,
				navigation: true,
				dots: false,
				pagination: false,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				itemsDesktop: [1199, 2],
				itemsDesktopSmall: [979, 2],
				itemsTablet: [768, 1],
				itemsMobile: [479, 1],
				addClassActive: true
			});
		});
		
		changeFirstLast();
		
		$(".project-carousel .owl-prev, .project-carousel .owl-next").on("click", function(event) {
			changeFirstLast();
		});
	}
	
	if ($(".client-carousel").length > 0) {
		$(".client-carousel").each(function(){
			var autoplay = ($(this).attr("data-auto-play") === "true") ? true : false;
			$(this).owlCarousel({
				items: $(this).attr("data-desktop"),
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: false,
				pagination: false,
				autoPlay: autoplay,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, $(this).attr("data-desktop")],
				itemsDesktopSmall: [979, $(this).attr("data-laptop")],
				itemsTablet: [768, $(this).attr("data-tablet")],
				itemsMobile: [479, $(this).attr("data-mobile")]
			});
		});
	}
	
	if ($(".team-carousel").length > 0) {
		$(".team-carousel").each(function(){
			var autoplay = ($(this).attr("data-auto-play") === "true") ? true : false;
			$(this).owlCarousel({
				items: $(this).attr("data-desktop"),
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: false,
				pagination: false,
				autoPlay: autoplay,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, $(this).attr("data-desktop")],
				itemsDesktopSmall: [979, $(this).attr("data-laptop")],
				itemsTablet: [768, $(this).attr("data-tablet")],
				itemsMobile: [479, $(this).attr("data-mobile")]
			});
		});
	}
	
	if ($(".testimonial-carousel").length > 0) {
		$(".testimonial-carousel").each(function(){
			$(this).owlCarousel({
				items: 1,
				loop: true,
				mouseDrag: true,
				navigation: true,
				dots: false,
				pagination: false,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				navigationText: ['<i class="pe-7s-left-arrow"></i>', '<i class="pe-7s-right-arrow"></i>'],
				itemsDesktop: [1199, 1],
				itemsDesktopSmall: [979, 1],
				itemsTablet: [768, 1],
				itemsMobile: [479, 1]
			});
		});
	}
	
	if ($(".portfolio-carousel").length > 0) {
		$(".portfolio-carousel").each(function(){
			var autoplay = ($(this).attr("data-auto-play") === "true") ? true : false;
			$(this).owlCarousel({
				items: $(this).attr("data-desktop"),
				loop: true,
				mouseDrag: true,
				navigation: true,
				dots: false,
				pagination: false,
				autoPlay: autoplay,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				itemsDesktop: [1199, $(this).attr("data-desktop")],
				itemsDesktopSmall: [979, $(this).attr("data-laptop")],
				itemsTablet: [768, $(this).attr("data-tablet")],
				itemsMobile: [479, $(this).attr("data-mobile")]
			});
		});
	}
	
	if ($(".banner-carousel").length > 0) {
		$(".banner-carousel").each(function(){
			$(this).owlCarousel({
				items: 1,
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: false,
				pagination: false,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, 1],
				itemsDesktopSmall: [979, 1],
				itemsTablet: [768, 1],
				itemsMobile: [479, 1],
				transitionStyle : "fadeUp",
			});
			
			$('.next').on("click", function() {
                $(".banner-carousel").trigger('owl.next');
            })
            $('.prev').on("click", function() {
                $(".banner-carousel").trigger('owl.prev');
            })
		});
	}
	
	if ($(".process-carousel").length > 0) {
		$(".process-carousel").each(function(){
			var autoplay = ($(this).attr("data-auto-play") === "true") ? true : false;
			$(this).owlCarousel({
				items: $(this).attr("data-desktop"),
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: true,
				pagination: true,
				autoPlay: autoplay,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, $(this).attr("data-desktop")],
				itemsDesktopSmall: [979, $(this).attr("data-laptop")],
				itemsTablet: [768, $(this).attr("data-tablet")],
				itemsMobile: [479, $(this).attr("data-mobile")]
			});
		});
	}
	
	if ($(".relate-blog-carousel").length > 0) {
		$(".relate-blog-carousel").each(function(){
			$(this).owlCarousel({
				items: 3,
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: true,
				pagination: false,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, 3],
				itemsDesktopSmall: [979, 3],
				itemsTablet: [768, 2],
				itemsMobile: [479, 1]
			});
		});
	}
	
	if ($(".blog-carousel").length > 0) {
		$(".blog-carousel").each(function(){
			$(this).owlCarousel({
				items: 3,
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: true,
				pagination: true,
				autoPlay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, 3],
				itemsDesktopSmall: [979, 3],
				itemsTablet: [768, 2],
				itemsMobile: [479, 1]
			});
		});
	}
}

/*=================================================================
	youtube popup function
===================================================================*/
function autoPlayYouTubeModal() {
	var trigger = $("body").find('[data-toggle="modal"]');
	trigger.click(function () {
		var theModal = $(this).data("target"),
			videoSRC = $(this).attr("data-theVideo"),
			videoSRCauto = videoSRC + "?autoplay=1";
			$(theModal + ' iframe').attr('src', videoSRCauto);
			$(theModal + ' button.close').click(function () {
			  $(theModal + ' iframe').attr('src', videoSRC);
			});
	});
	$("body").on('hidden.bs.modal', function () {
		$('body iframe').removeAttr('src');
	});
}

/*=================================================================
	google map function
===================================================================*/
function GoogleMap() {
	// When the window has finished loading create our google map below
	var marker_image = "../images/map-marker.png";

	if ($('#map').length > 0) {
		if ($('#map').attr('data-marker-image') != undefined) {
			marker_image = $('#map').attr('data-marker-image')
		}
		google.maps.event.addDomListener(window, 'load', init);
	}

	function init() {
		// Basic options for a simple Google Map
		// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
		var mapOptions = {
			// How zoomed in you want the map to start at (always required)
			zoom: 11,
			scrollwheel: false,

			// The latitude and longitude to center the map (always required)
			center: new google.maps.LatLng(40.6000, -73.9400), // New York

			// How you would like to style the map.
			// This is where you would paste any style found on Snazzy Maps.
			styles: [{
				"featureType": "all",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"saturation": 36
					},
					{
						"color": "#000000"
					},
					{
						"lightness": 40
					}
				]
			},
			{
				"featureType": "all",
				"elementType": "labels.text.stroke",
				"stylers": [
					{
						"visibility": "on"
					},
					{
						"color": "#000000"
					},
					{
						"lightness": 16
					}
				]
			},
			{
				"featureType": "all",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 20
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 17
					},
					{
						"weight": 1.2
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 20
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 21
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 17
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 29
					},
					{
						"weight": 0.2
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 18
					}
				]
			},
			{
				"featureType": "road.local",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 16
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 19
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 17
					}
				]
			}]
		};

		// Get the HTML DOM element that will contain your map
		// We are using a div with id="map" seen below in the <body>
		var mapElement = document.getElementById('map');
		// Create the Google Map using our element and options defined above
		var map = new google.maps.Map(mapElement, mapOptions);

		// Let's also add a marker while we're at it
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(40.6000, -73.9400),
			map: map,
			title: 'Location 1',
			icon: marker_image
		});

	}
}

/*=================================================================
	revolution slider function
===================================================================*/
function RevolutionInit() {
	var overlay = $("#rev_slider").attr("data-overlay");
	$("#rev_slider").show().revolution({
		sliderType:"standard",
		sliderLayout:"fullscreen",
		dottedOverlay:"twoxtwo",
		delay:9000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			touch:{
				touchenabled:"on",
				swipe_threshold: 75,
				swipe_min_touches: 1,
				swipe_direction: "horizontal",
				drag_block_vertical: false
			}
			,
			arrows: {
				style:"nito-agency-03",
				enable:true,
				hide_onmobile:false,
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				tmp:'<div class="tp-arr-allwrapper">	<div class="tp-arr-iwrapper">				<div class="tp-arr-titleholder"></div>		<div class="tp-arr-subtitleholder"></div>	</div></div>',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:20,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:20,
					v_offset:0
				}
			}
		},
		visibilityLevels:[1240,1024,778,480],
		gridwidth:1240,
		gridheight:868,
		lazyType:"none",
		parallax: {
			type:"mouse",
			origo:"enterpoint",
			speed:400,
			levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
			type:"mouse",
		},
		shadow:0,
		spinner:"spinner4",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		fullScreenAutoWidth:"off",
		fullScreenAlignForce:"off",
		fullScreenOffsetContainer: "",
		fullScreenOffset: "",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}

function RevolutionInitVideo() {
	var overlay = $("#rev_slider_3").attr("data-overlay");
	$("#rev_slider_3").show().revolution({
		sliderType:"standard",
		sliderLayout:"fullwidth",
		dottedOverlay:"twoxtwo",
		delay:9000,
		navigation: {
			onHoverStop:"off",
		},
		visibilityLevels:[1240,1024,778,480],
		gridwidth:1920,
		gridheight:1080,
		lazyType:"none",
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"off",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}

function RevolutionInitWider() {
	var overlay = $("#rev_slider_2").attr("data-overlay");
	$("#rev_slider_2").show().revolution({
		sliderType:"standard",
		sliderLayout:"auto",
		dottedOverlay:"none",
		delay:9000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			arrows: {
				style:"nito-agency-03-3013",
				enable:true,
				hide_onmobile:false,
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				tmp:'<div class="tp-arr-allwrapper">	<div class="tp-arr-iwrapper">				<div class="tp-arr-titleholder"></div>		<div class="tp-arr-subtitleholder"></div>	</div></div>',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:20,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:20,
					v_offset:0
				}
			}
		},
		visibilityLevels:[1240,1024,778,480],
		gridwidth:1920,
		gridheight:996,
		lazyType:"none",
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}

function RevolutionInitMini() {
	var overlay = $("#rev_slider_4").attr("data-overlay");
	$("#rev_slider_4").show().revolution({
		sliderType:"standard",
		sliderLayout:"auto",
		dottedOverlay:"twoxtwo",
		delay:9000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			arrows: {
				style:"nito-agency-03-3846",
				enable:true,
				hide_onmobile:false,
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				tmp:'<div class="tp-arr-allwrapper"><div class="tp-arr-iwrapper"><div class="tp-arr-titleholder"></div>		<div class="tp-arr-subtitleholder"></div></div></div>',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:20,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:20,
					v_offset:0
				}
			}
		},
		visibilityLevels:[1240,1024,778,480],
		gridwidth:1920,
		gridheight:998,
		lazyType:"none",
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}

function RevolutionInitSidebar() {
	var overlay = $("#rev_slider_5").attr("data-overlay");
	$("#rev_slider_5").show().revolution({
		sliderType:"standard",
		sliderLayout:"auto",
		dottedOverlay:"none",
		delay:9000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			arrows: {
				style:"nito-agency-03-0244",
				enable:true,
				hide_onmobile:false,
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				tmp:'<div class="tp-arr-allwrapper">	<div class="tp-arr-iwrapper">				<div class="tp-arr-titleholder"></div>		<div class="tp-arr-subtitleholder"></div>	</div></div>',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:20,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:20,
					v_offset:0
				}
			}
		},
		visibilityLevels:[1240,1024,778,480],
		gridwidth:1543,
		gridheight:1080,
		lazyType:"none",
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}

function RevolutionInitFashion() {
	var overlay = $("#rev_slider_6").attr("data-overlay");
	$("#rev_slider_6").show().revolution({
		sliderType:"standard",
		sliderLayout:"auto",
		dottedOverlay:"twoxtwo",
		delay:9000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			arrows: {
				style:"nito-02",
				enable:true,
				hide_onmobile:false,
				hide_onleave:false,
				tmp:'',
				left: {
					h_align:"left",
					v_align:"bottom",
					h_offset:105,
					v_offset:80
				},
				right: {
					h_align:"left",
					v_align:"bottom",
					h_offset:170,
					v_offset:80
				}
			}
		},
		responsiveLevels:[1240,1024,778,480],
		visibilityLevels:[1240,1024,778,480],
		gridwidth:[1920,1024,778,480],
		gridheight:[1080,768,450,350],
		lazyType:"none",
		minHeight:"100vh",
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}

/*=================================================================
	other functions
===================================================================*/

function changeFirstLast(){
	var index = 0;
	$(".project-carousel .owl-item").each(function(){
		var items = $(this);
		items.removeClass("first").removeClass("init");
		if(items.hasClass("active")) {
			if(index == 0) {
				items.addClass("first");
				index = index + 1;
			}
		}
	});
}

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}