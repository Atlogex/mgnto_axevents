/**
 * Atlogex
 */

jQuery(function ($) {

	/* Slider */
	// Использую обычно Slick, но раз нужен самописный то будет по минимуму
	jQuery(document).ready(function () {
		axSliderEvents();
	});

	var sliderWrapper = '.m__ae_slider';
	var sliderWrapperUnit = '.m__ae_slider .m__aes_unit';
	var sliderWrapperFirst = '.m__ae_slider .m__aes_unit:first';
	var sliderStatus = true;
	var sliderCount = 1; // Нулевой уже показывается
	var sliderMSec = 3000;

	var sliderTimer = setInterval(nextSlide, sliderMSec);

	function axSliderEvents() {
		$(sliderWrapper).hover(function () {
			clearInterval(sliderTimer);
		}, function () {
			sliderTimer = setInterval(nextSlide, sliderMSec);
		});
	}

	function nextSlide() {
		if (sliderStatus) {
			$(sliderWrapperUnit).fadeOut();
			if (!$('div').is(sliderWrapperUnit + ':eq(' + sliderCount + ')')) sliderCount = 0;
			$(sliderWrapperUnit + ':eq(' + sliderCount + ')').fadeIn();
			sliderCount++;
		}
	}

	/* /Slider */
});