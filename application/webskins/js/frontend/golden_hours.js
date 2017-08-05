function stop_on_mouseover(carousel)
{
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};
$(function() {
	var asyncslider = $(".slider_golden");
		
	asyncslider.asyncSlider({
		direction: 'horizontal',
		minTime: 500,
        maxTime: 100,
        random: true,
        autoswitch: 4000,
        slidesNav: true,
    	slidesNav: $(".slider_buttons_env")
	});
	
	$('ul.slide-hot-pr').jcarousel({
		visible: 3,
		auto: 3,
		wrap: 'last',
		buttonNextHTML:'<a href="javascript:;" class="next-slide">&nbsp;</a>',
		buttonPrevHTML:'<a href="javascript:;" class="prv-slide">&nbsp;</a>',
		initCallback: stop_on_mouseover
	});
    $(".dispImg.ftp").hover(function(){
        $(this).animate({
            height: "333px",
        }, 400 );
    }, function(elem){
        $(this).animate({
            height: "250px",
        }, 400 );
    });
});