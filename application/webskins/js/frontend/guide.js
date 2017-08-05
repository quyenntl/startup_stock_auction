$(function() {
	if (!!$('.dscroll').offset()) { 
	    var stickyTop = $('.dscroll').offset().top;	 
	    $(window).scroll(function(){	 
	      	var windowTop = $(window).scrollTop();
	 		var footerTop = $('.footer').offset().top;		                	
            var stickyHeight = $('.dscroll').height();
            var limit = footerTop - stickyHeight;

	      	if (stickyTop <= windowTop+5){
	       		$('.dscroll').css({ position: 'fixed', top: 5 });
	      	}
	      	else {
	        	$('.dscroll').css('position','static');
	      	}
	      	if (limit < windowTop + 60) {
                var diff = limit - windowTop - 60;
                $('.dscroll').css({top: diff});
            }
	    });	 
	}
});