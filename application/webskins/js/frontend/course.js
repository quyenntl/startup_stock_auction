$(document).ready(function(){
    $('.reg-course').click(function(){
        $('#form_reg_cost').validate({
	        rules: {
	            name : { required: true},
                cmt : {required: true,number:true,minlength:9},
	            phone     : { required: true,number: true,minlength: 6 }	            
	        },
	        messages: {
	            name:{
                    required: "Bạn chưa nhập họ tên" 
                }, 
                cmt:{
                    required: 'Bạn chưa nhập số chứng minh thư',
                    number: 'Ký tự không hợp lệ',
                    minlenght: 'Chứng minh thư phải có ý nhất 9 ký tự'
                },
                phone: {
                    required: 'Bạn chưa nhập số điện thoại',
                    number: 'Ký tự không hợp lệ',
                    minlength: 'Số điện thoại phải có ít nhất 6 số'
                }
	        }
	    });
        
        var res = $("#form_reg_cost").valid();
		if(res == false)
		{
			return false;
		}else{
		  var data = $('#form_reg_cost').serializeArray();
		  $.ajax({
		      url: 'ajax/course/reg_course',
              type: 'POST',
              data: data,
              dataType: 'json',
              success: function(data){
                if(data.code == 1){
                    $('.result-reg-form').addClass('resetPassSussce').removeClass('resetPassError').show();
                    $('#msg-result').html(data.msg);
                }else{
                    $('.result-reg-form').addClass('resetPassError').removeClass('resetPassSussce').show();
                    $('#msg-result').html(data.msg);
                }
                return false;
              }
		  });
		}
        return false; 
    });
    
    $('.reg-len-car').click(function(){
        $('#form_reg_len').validate({
	        rules: {
	            name : { required: true},
                cmt : {required: true,number:true,minlength:9},
	            phone     : { required: true,number: true,minlength: 6},
                day: {required:true},
                time_start:{required:true},
                time_end:{required:true}
	        },
	        messages: {
	            name:{
                    required: "(*)" 
                }, 
                cmt:{
                    required: '(*)',
                    number: 'Ký tự không hợp lệ',
                    minlenght: 'Chứng minh thư phải có ý nhất 9 ký tự'
                },
                phone: {
                    required: '(*)',
                    number: 'Ký tự không hợp lệ',
                    minlength: 'Số điện thoại phải có ít nhất 6 số'
                },
                day:{
                    required: '(*)'                    
                },
                time_start:{
                    required: '(*)',
                },
                time_end:{
                    required: '(*)',
                }
	        }
	    });
        
        var res = $("#form_reg_len").valid();
		if(res == false)
		{
			return false;
		}else{
		  var check_reg_len   = $('#check_reg_len').val();
          if(check_reg_len == 0){
                $('.result-reg-form').addClass('resetPassError').removeClass('resetPassSussce').show();
                $('#msg-result').html($('#msg-result').html());
          }
		  var data = $('#form_reg_len').serializeArray();
		  $.ajax({
		      url: 'ajax/course/reg_len_car',
              type: 'POST',
              data: data,
              dataType: 'json',
              success: function(data){
                if(data.code == 1){
                    $('.result-reg-form').addClass('resetPassSussce').removeClass('resetPassError').show();
                    $('#msg-result').html(data.msg);
                }else{
                    $('.result-reg-form').addClass('resetPassError').removeClass('resetPassSussce').show();
                    $('#msg-result').html(data.msg);
                }
                return false;
              }
		  });
		}
        return false; 
    });
    $('input.date-picker').datepicker({ 
        dateFormat: 'dd/mm/yy',
        showOn: "both",
		buttonImage: $('#base_url').val()+ "/webskins/skins/frontend/images/calendarIcon.png",
		buttonImageOnly: true
     });
    //scroll
    //$("#boxscroll").niceScroll({touchbehavior:false,cursorcolor:"#0000FF",cursoropacitymax:0.6,cursorwidth:8});
    $('#boxscroll').livequery(function(){
        $(this).niceScroll({
            //autohidemode: false,
            cursorborder: '0px',
            cursorwidth: '12px',
            cursorcolor: '#406ea9',
            background: '#c4c4c4',
            dblclickzoom: false,
            railpadding:{top:5,right:0,left:0,bottom:5},
            //touchbehavior: true
        }); 
    });    
    $('.filter-bt').click(function(){
        var url = $('#thue_xe_url').val()+ '?cmd=search';
        var day_search  = $('#day_search').val();
        var time_type   = $('#filter-time-type').val();
        var type_car    = $('#type_car').val();
        $.ajax({
            beforeSend: function(){
                $('.loading-img').show();
            },
            url: 'ajax/course/view_cal',
            data: {'time':time_type,'type_car':type_car,'day':day_search},
            type: 'get',
            dataType: 'json',
            success: function(data){
                $('.loading-img').hide();
                $('.result-html').html(data.html);
            }    
        });         
    });
    $('#reg_type_car').change(function(){
        var car_type = $(this).val();
        if(car_type == '0'){
            $('.list-all-car').hide();
            return false;
        }
        $.ajax({
            url: 'ajax/course/get_list_car',
            data: {'car_type':car_type},
            dataType: 'json',
            success: function(data){
                if(data.code == 1){
                    $('.list-all-car').show().html(data.html);
                }else{
                    $('.result-reg-form').addClass('resetPassError').removeClass('resetPassSussce').show();
                    $('#msg-result').html(data.msg);
                    $('.list-all-car').hide();
                }
            }
            
        }); 
    });
    $('.c-check-calendar').livequery('change',function(){
        var time_start = $('#time_start').val();
        var time_end   = $('#time_end').val(); 
        var car_id     = $('#car_id').val();
        var day        = $('#day').val(); 
        if(time_start && time_end && car_id && day){
            $.ajax({
                url: 'ajax/course/check_car_status',
                type: 'get',
                data: {'time_start':time_start,'time_end':time_end,'car_id':car_id,'day':day},
                dataType: 'json',
                success: function(data){
                    if(data.code == 0){
                        $('.result-reg-form').addClass('resetPassError').removeClass('resetPassSussce').show();
                        $('#msg-result').html(data.msg);
                        $('#check_reg_len').val(0);
                    }else{
                        $('#check_reg_len').val(1);
                    }
                    return;
                }                
            });
        }else{return false;} 
    });    
});

$(function() {
$(document ).tooltip({
items: "img, [data-geo], [title]",
content: function() {
    var element = $( this );    
    if ( element.is( "[data-geo]" ) ) {
        var text = element.text();        
        return "<img class='map' src='"+$(this).attr('rel')+"'>";
    }    
}
});
});