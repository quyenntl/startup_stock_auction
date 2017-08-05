$(document).ready(function(){
    $('.add-staff').click(function(){        
    	var time_out;
    	$.validator.addMethod("valueNotEquals", function(value, element, arg){
	      	return arg != value;}, "Value must not equal arg.");
        if($("#type_staff").val() == 0){
            alert('Bạn chưa chọn chức vụ');return false;
        }        
    	$('#add-staff-form').validate({
	        rules: {
	            name      	: { required: true,minlength: 3},
	            phone     : { required: true,number: true,minlength: 6},	            
	            
	            address   : { required: true,minlength: 3},
                type      : {valueNotEquals:'0'}                     
	        },
	        messages: {	
	           name: "(*)",
               phone: "(*)",               
               address: "(*)",
               type: "(*)"
	        }
	    });
		
		var res = $("#add-staff-form").valid();

		if(res == false)
		{
			return false;
		}
		else
		{
			var elem = $(this);
			var data = $('#add-staff-form').serialize();
			$.ajax({
	            beforeSend: function(){
	            },
	            url: 'ajax/admin_staff/add',
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
        if($("#type_staff_update").val() == 0){
            alert('Bạn chưa chọn chức vụ');return false;
        }        
    	$('#update-staff-form').validate({
	        rules: {
	            name      	: { required: true,minlength: 3},
	            phone     : { required: true,number: true,minlength: 6},	            
	            
	            address   : { required: true,minlength: 3},
                type      : {valueNotEquals:'0'}                     
	        },
	        messages: {	
	           name: "(*)",
               phone: "(*)",               
               address: "(*)",
               type: "(*)"
	        }
	    });
		
		var res = $("#update-staff-form").valid();
        
		if(res == false)
		{
			return false;
		}
		else
		{
	    	var elem = $(this);
	    	var data = $('#update-staff-form').serialize();
	    	$.ajax({
				beforeSend: function(){
					elem.addClass('disabled');
					elem.attr('disabled', 'disabled');
	            },
	            url: 'ajax/admin_staff/update_info',
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
		var url = 'ajax/admin_staff/load_info';
		var data = {'id':user_id};
		if (url.indexOf('#') == 0) {
			$(url).modal('open');
		} else {
			$.get(url, data, function(data) {
				$('<div class="modal remove" style="width:800px;margin-left:-400px;">' + data + '</div>').modal();
			}).success(function() { $('input:text:visible:first').focus(); });
		}
	});
})