/**jQuery Deeds tips **/
/**
@author Deeds - 18/08/2012.
@email mr.deeds88@gmail.com
@version 0.1.
forlow tutorial at http://andrewhenderson.me/tutorial/jquery-sticky-sidebar/
*/
(function($){
    $.fn.extend({      
        dscroll: function(options) {
            var defaults = {	       
                stopitem: '',
                positionafter: 'static'	                
            }                 
            var options =  $.extend(defaults, options);
            return this.each(function() {
                var o = options;
                var el = $(this);
                var stopdiv = o.stopitem;
                if (!!el.length) {
	                var stickyTop = el.offset().top;
	                if(stopdiv) {
	                	var footerTop = $(stopdiv).offset().top;		                	
		                var stickyHeight = el.height();
		                var limit = footerTop - stickyHeight;
	                }
	                else {
	                	var footerTop = 0;
	                }		                
	                $(window).scroll(function(){           
	                	var windowTop = $(window).scrollTop();             
	                    if (stickyTop < windowTop) {
	                        el.css({ position: 'fixed', top: 10 });
	                    }
	                    else {
	                        el.css('position',o.positionafter);
	                    }	                    
	                    if (limit < windowTop) {
	                        var diff = limit - windowTop;
	                        el.css({top: diff});
	                    }	                
	                });	        
        		}
            });
        }
    });	     
})(jQuery);