(function($){ 
    $.fn.advScroll = function(option) {
        $.fn.advScroll.option = {
            marginTop:0,
            easing:'',
            timer:3000,
        }; 
        option = $.extend({}, $.fn.advScroll.option, option); 
        return this.each(function(){
            var el = $(this);
            $(window).scroll(function(){
                t = parseInt($(window).scrollTop()) + option.marginTop;
                el.stop().animate({marginTop:t},option.timer,option.easing);
            });
        });
    }; 
})(jQuery)