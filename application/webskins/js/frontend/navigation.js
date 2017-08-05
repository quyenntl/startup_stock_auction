/* i do this work for my favorite... not for the fame */

var min_angle   = 60;
var coordinates = [{'x': 0, 'y': 0}];
var mousestep   = 10;

$(function() {
	//Function create flyout menu smooth like amazon...coz i almost copy that 0_O
	var great_dad   = $('#flyout');
	var parent_cat  = $('#wrap-parent');
	var sub_cat     = $('#wrap-child');
	var nav_timeout;
	var flyoutcomplete = function(){		
		
	}
	var flyout = function(){
		sub_cat.show();
		sub_cat.stop().animate({
            width: 528
        }, {
            duration: "fast",
            //complete: flyoutcomplete
        }).css({'overflow': 'visible'});
	}
	var hide_all = function(mode){
		sub_cat.css({width: 0});
		sub_cat.hide();
	}
	//add step
	$('.sub-level1').mousemove(function(e){
        add_coordinates({'x': e.pageX, 'y': e.pageY});
   	});
   	//Xúc
	$("#wrap-parent li.par_cat").hover(function() {
		window.clearTimeout(nav_timeout);
		var match = /^nav_cat_(.+)/.exec(this.id);
		var cat   = (match ? match[1] : "");
		var angle = get_angel(coordinates[0], coordinates[coordinates.length - 1]);
		//console.log(angle);
		if(angle <= 90 && angle >= min_angle )
		{			
        	$('.sub-level2').hide();
			$('#sub_cat_' + cat + ', #sub_cat_' + cat +' .sub-level2').show();
			$('#sub_cat_' + cat).addClass('sub_active');
        	//$(this).addClass('nav_active');
		}
		else
		{
			nav_timeout = setTimeout(function(){
				$('.sub-level2').hide();
				$('#sub_cat_' + cat + ', #sub_cat_' + cat +' .sub-level2').show();
				$('#sub_cat_' + cat).addClass('sub_active');
	        	//$(this).addClass('nav_active');
			}, 250)
		}
    },function(){
    	window.clearTimeout(nav_timeout);
    });

    $('.wrap-sub, .sub-level2').hover(function(e) {
    	$(this).show();
	},function(){
		//$(this).hide();
	});
		//Call anything u want here
	$('.par_cat').mouseenter(flyout);
	$('#flyout').mouseleave(hide_all);

	//explore navigation 
	var tm;
	$('#big-daddy').hover(function(){
		if($(this).hasClass('active'))
		{
			return false;
		}
		$('.viewall-item').addClass('active');
		$('#flyout').addClass('active');
	}, function(){
		if($(this).hasClass('active'))
		{
			return false;
		}
		$('.viewall-item').removeClass('active');
		$('#flyout').removeClass('active');
	});
});
function add_coordinates(coordinates_value) {
    coordinates.push(coordinates_value);
    if (coordinates.length > mousestep)
        coordinates.shift();
}

function get_angel(coordinates1, coordinates2)
{
    var dx = coordinates1.x - coordinates2.x;
    var dy = coordinates1.y - coordinates2.y;
    //return (Math.atan2(dx,  dy) / Math.PI * 180);
    return Math.acos(dx/Math.sqrt(dx*dx + dy*dy)) * (180/Math.PI);
}