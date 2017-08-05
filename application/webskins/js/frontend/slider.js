jQuery(document).ready(function() {
	var asyncslider = $(".slider_container");
		
	asyncslider.asyncSlider({
		direction: 'horizontal',
		minTime: 500,
        maxTime: 100,
        random: true,
        autoswitch: 5000,
        slidesNav: true,
    	slidesNav: $(".slider_buttons_env")
	});
});