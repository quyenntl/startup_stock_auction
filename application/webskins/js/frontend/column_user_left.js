jQuery(document).ready(function() {
    $(window).scroll(function () {
        var s = $(window).scrollTop();
        var thiss = $('.main');
        var info = $(".navCreat");
        if (thiss.offset().top < s + 55 && s < thiss.offset().top + thiss.height()) {
            if (s + 40 + info.height() < thiss.offset().top + thiss.height()) {
                info.css({ position: "fixed", top: "60px" });
            } else {
                var h =  thiss.height() - info.height()-55;
                info.css({ position: "relative", top: h });
            }
        } 
    });
                       
});