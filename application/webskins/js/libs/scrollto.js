$(function(){ // document ready
    if (!!$('#shareBar').length) { // make sure ".sticky" element exists
    
        var el = $('#shareBar');
        var stickyTop = $('#shareBar').offset().top; // returns number
        var footerTop = $('.stop-here').offset().top; // returns number
        var stickyHeight = $('#shareBar').height();
        var limit = footerTop - 20;
        //var limit = footerTop - stickyHeight - 20;
        
        $(window).scroll(function(){ // scroll event
        var topBillHeight = $('.topBill').height();
        var windowTop = $(window).scrollTop(); // returns number
            
            if (stickyTop < windowTop){
                        if(topBillHeight)
                        {
                            el.css({ position: 'fixed', top: topBillHeight+20 });
                        }
                        else
                        {
                            el.css({ position: 'fixed', top: 5 });
                        }
                    }
                    else {
                        if(topBillHeight)
                        {
                            el.css({ position: 'absolute', top: 337 });
                        }
                        else
                        {
                            el.css('position','absolute');
                        }
                        
                    }
            if (limit < windowTop) {
                var diff = limit - windowTop;
                el.css({top: diff});
            }        
        });    
    }
});