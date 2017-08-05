$(document).ready(function(){
    $('.add-car').click(function(){        
    	var time_out;
    	$.validator.addMethod("valueNotEquals", function(value, element, arg){
	      	return arg != value;}, "Value must not equal arg.");
        if($("#type_staff").val() == 0){
            alert('Bạn chưa chọn chức vụ');return false;
        }        
    	$('#add-car-form').validate({
	        rules: {
	            car_id      : { required: true},
	            phone     : { required: true,number: true,minlength: 6},	            
	            car_reg_id     : { required: true},	            
                car_type      : {valueNotEquals:'0'},
                ordering :{number:true},                    
	        },
	        messages: {	
	           car_id: "(*)",
               phone: "(*)",
               car_reg_id: "(*)",
               car_type: "(*)",
               ordering: "(*)"
	        }
	    });
		
		var res = $("#add-car-form").valid();

		if(res == false)
		{
			return false;
		}
		else
		{
			var elem = $(this);
			var data = $('#add-car-form').serialize();
			$.ajax({
	            beforeSend: function(){
	            },
	            url: 'ajax/admin_car/add',
	            global: false,
	            type: "post",
	            data: data,
	            dataType: "json",
	            success: function(data){	            	
	            	if(data.code == 0){	            	
	            		alert(data.msg);
	            	}else if(data.code == 1){
	            	    alert(data.msg);
                        location.reload();
	            	}	            	
	            }
	        });
		}
		return false;
    });
    $('.update-click').livequery('click', function(){
    	var time_out;
    	$.validator.addMethod("valueNotEquals", function(value, element, arg){
	      	return arg != value;}, "Value must not equal arg.");
        if($("#car_type_e").val() == 0){
            alert('Bạn chưa chọn loại xe');return false;
        }        
    	$('#update-car-form').validate({
	        rules: {
	            car_id      : { required: true},
	            phone     : { required: true,number: true,minlength: 6},	            
	            car_reg_id     : { required: true},	            
                car_type      : {valueNotEquals:'0'},
                ordering :{number:true},                    
	        },
	        messages: {	
	           car_id: "(*)",
               phone: "(*)",
               car_reg_id: "(*)",
               car_type: "(*)",
               ordering: "(*)"
	        }
	    });
		
		var res = $("#update-car-form").valid();
        
		if(res == false)
		{
			return false;
		}
		else
		{
	    	var elem = $(this);
	    	var data = $('#update-car-form').serialize();
	    	$.ajax({
				beforeSend: function(){
					elem.addClass('disabled');
					elem.attr('disabled', 'disabled');
	            },
	            url: 'ajax/admin_car/update_info',
	            type: 'post',
	            data: data,
	            dataType: 'json',
	            success:function(data){
	            	elem.removeClass('disabled');
					elem.removeAttr('disabled');
	            	if(data.err == 0)
	            	{
	            		$('.result-update').hide().html(data.msg).fadeIn(200);
	            	}
	            	else
	            	{
	            		$('.result-update').hide().html(data.msg).fadeIn(200);
	            	}
                    location.reload();
	            }
	        });
	    }
    	return false;
    });
    
    $('.update-modal').click(function(e) {
		e.preventDefault();
		var user_id = $(this).attr('rel');
		var url = 'ajax/admin_car/load_info';
		var data = {'car_id':user_id};
		if (url.indexOf('#') == 0) {
			$(url).modal('open');
		} else {
			$.get(url, data, function(data) {
				$('<div class="modal remove" style="width:800px;margin-left:-400px;">' + data + '</div>').modal();
			}).success(function() { $('input:text:visible:first').focus(); });
		}
	});
})