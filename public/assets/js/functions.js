// Call Main Slider 
jQuery('#main-slider').slippry({
	// general elements & wrapper


	// options
	adaptiveHeight: false, // height of the sliders adapts to current slide
	start: '1', // num (starting from 1), random
	loop: true, // first -> last & last -> first arrows
	captionsSrc: 'li',
	captions: 'custom', // Position: overlay, below, custom, false
	captionsEl: '.external-captions',

	// transitions
	transition: 'fade', // fade, horizontal, kenburns, false
	easing: 'linear', // easing to use in the animation [(see... [jquery www])]
	continuous: false,

	// slideshow
	auto: true
});

// Call Services Slider 
jQuery('#services-slider').slippry({
	// general elements & wrapper


	// options
	adaptiveHeight: false, // height of the sliders adapts to current slide
	start: '1', // num (starting from 1), random
	loop: false, // first -> last & last -> first arrows
	captionsSrc: 'li',
	captions: 'custom', // Position: overlay, below, custom, false
	captionsEl: '.external-captions',

	// transitions
	transition: 'horizontal', // fade, horizontal, kenburns, false
	easing: 'linear', // easing to use in the animation [(see... [jquery www])]
	continuous: true,

	// slideshow
	auto: false
});

// Add smooth scrolling on all links inside the navbar
jQuery(".navbar a").on('click touch', function (event) {
	'use strict';
	// Get a safe height for scrolling to

	// Make sure this.hash has a value before overriding default behavior
	if (this.hash !== "") {

		// Prevent default anchor click behavior
		event.preventDefault();

		// Store hash
		var hash = this.hash;

		// Using jQuery's animate() method to add smooth page scroll
		// The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		$('html, body').animate({
			scrollTop: $(hash).offset().top
		}, 800, function () {

			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		});

	} // End if

});

$(document).ready(function ($) {
	'use strict';
	// Setup variables
	var $window = $(window);
	var $slide = $('.homeSlide');
	var $body = $('body');

	//FadeIn all sections   
	$body.imagesLoaded(function () {
		setTimeout(function () {

			// Resize sections
			adjustWindow();

			// Fade in sections
			$body.removeClass('loading').addClass('loaded');

		}, 800);
	});

	function adjustWindow() {


		if (!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
			skrollr.init({
				forceHeight: false
			});
		}

		// Get window size
		var winH = $window.height();

		// Keep minimum height 500
		if (winH <= 500) {
			winH = 500;
		}

		// Refresh Skrollr after resizing our sections
		s.refresh($('.homeSlide'));

	}

});

(function ($) {
	"use strict";

	function count($this) {
		var current = parseInt($this.html(), 10);
		current = current + 1; /* Where 50 is increment */
		$this.html(++current);
		if (current > $this.data('count')) {
			$this.html($this.data('count'));
		} else {
			setTimeout(function () {
				count($this);
			}, 50);
		}
	}
	$(".stat-count").each(function () {
		$(this).data('count', parseInt($(this).html(), 10));
		$(this).html('0');
		count($(this));
	});
})(jQuery);

window.onscroll = function () {
	'use strict';
	scrollFunction();
};

function scrollFunction() {
	'use strict';
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		document.getElementById("myBtn").style.display = "block";
	} else {
		document.getElementById("myBtn").style.display = "none";
	}
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	'use strict';
	$("html, body").animate({
		scrollTop: 0
	}, 1000);
	document.documentElement.scrollTop = 0; // For IE and Firefox
}

