$(function() {
	$('.close-coupon-popup').click(function(){
		$('.coupon-popup').addClass('hidden');
		return false;
	});

	$('.bgBottom').click(function(){
		$('.coupon-popup').removeClass('hidden');
		return false;
	});

	$('.coupon-popup input[type="text"]').focusin(function(){
		var value_default = $(this).data('val');
		if($(this).val() == value_default)
			$(this).val('');
	}).focusout(function(){
		var value_default = $(this).data('val');
		if($(this).val() == '')
			$(this).val(value_default);
		else
			return false;
	});

	$('.register-coupon').click(function(){
		return false;
	});

	$('.onetop-share').click(function(){
	    // calling the API ...
	    var obj = {
	      	method: 'feed',
	      	link: 'http://www.1top.vn',
	      	picture: 'http://www.1top.vn/webskins/skins/frontend/images/fb-logo.png',
	      	name: '1Top',
	      	caption: 'Khuyến mại mỗi ngày với hàng ngàn sản phẩm chất lượng',
	      	description: 'Sàn khuyến mại, giảm giá nhiều hàng số 1 Việt Nam với hàng ngàn sản phẩm giảm giá mỗi ngày từ những người bán uy tín.'
	    };

	    function callback(response) {
	      	document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
	    }

	    FB.ui(obj, callback);
	});
	$('.register-coupon').click(function(){
		var tm;
		var elem = $(this);
		if(elem.hasClass('disabled'))
			return false;

		var data = $('#coupon_form').serialize();

		$.ajax({
			beforeSend: function() {
				elem.addClass('disabled');
			},
			url: 'ajax/frontend/coupon_ajax/register',
			type: 'POST',
			dataType: 'json',
			data: data,
			success: function(data) {
				elem.removeClass('disabled');
				if(data.err == 1)
				{
					$('.coupon-notice').html(data.msg);
				}
				else
				{
					window.clearTimeout(tm);
					$('.coupon-notice').html(data.msg);
					//$.cookie('coupon_cookie', '1', { expires: 365, path: '/' });
					tm = setTimeout(function(){
						$('.coupon-popup').addClass('hidden');
					}, 2000);
				}
			}
		});		
	});
	function FloatTopDiv()
    {
        startLX = ((document.body.clientWidth -MainContentW)/2)-LeftBannerW-LeftAdjust , startLY = TopAdjust+80;
        startRX = ((document.body.clientWidth -MainContentW)/2)+MainContentW+RightAdjust , startRY = TopAdjust+80;
        var d = document;
        function ml(id)
        {
            var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
            el.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
            el.x = startRX;
            el.y = startRY;
            return el;
        }
        function m2(id)
        {
            var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
            e2.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
            e2.x = startLX;
            e2.y = startLY;
            return e2;
        }
        window.stayTopLeft=function()
        {
            if (document.documentElement && document.documentElement.scrollTop)
                var pY =  document.documentElement;
            else if (document.body)
                var pY =  document.body;
            if (document.body.scrollTop > 30){startLY = 3;startRY = 3;} else {startLY = TopAdjust;startRY = TopAdjust;};
            ftlObj.y += (pY+startRY-ftlObj.y)/16;
            ftlObj.sP(ftlObj.x, ftlObj.y);
            ftlObj2.y += (pY+startLY-ftlObj2.y)/16;
            ftlObj2.sP(ftlObj2.x, ftlObj2.y);
            setTimeout("stayTopLeft()", 1);
        }
        ftlObj = ml("divAdRight");
        //stayTopLeft();
        ftlObj2 = m2("divAdLeft");
        stayTopLeft();
    }
    function ShowAdDiv()
    {
        var objAdDivRight = document.getElementById("divAdRight");
        var objAdDivLeft = document.getElementById("divAdLeft");
        if (document.body.clientWidth < 1000)
        {
            objAdDivRight.style.display = "none";
            objAdDivLeft.style.display = "none";
        }
        else
        {
            objAdDivRight.style.display = "block";
            objAdDivLeft.style.display = "block";
            FloatTopDiv();
        }
    }
});