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
                    required: "Chưa nhập" 
                }, 
                cmt:{
                    required: 'Chưa nhập',
                    number: 'Ký tự không hợp lệ',
                    minlenght: 'CMND có tối thiểu 9 ký tự'
                },
                phone: {
                    required: 'Chưa nhập',
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
    
    $('#reg_city').change(function(){
        $.ajax({
           url: 'ajax/course/get_district',
           type: 'GET',
           data:{'city_id':$(this).val()},
           dataType: 'html',
           success:function(data){
            
                $('#reg_district').html(data);
           } 
        });
    });
    $("input:radio[name=type_cost]").click(function() {
        var value = $(this).val();       
        if(value == 1){
            $('#hang_xe_info').html("(Ô tô chở người đến 9 chỗ, ô tô tải, máy kéo có trọng tải < 3.5 tấn)");
        }else{
            $('#hang_xe_info').html("(Ô tô tải, máy kéo có trọng tải từ 3.5 tấn trở lên và các loại xe như hạng B2)");
        }
    });  
});
