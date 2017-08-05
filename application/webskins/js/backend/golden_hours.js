$(function() {
	$('#end_time_add').datepicker().on('changeDate', function(ev){
		$(this).datepicker('hide');
	});
	$('#end_time').livequery(function(){
		$(this).datepicker().on('changeDate', function(ev){
			$(this).datepicker('hide');
		});
	})
	$('#type_add').change(function(){
		var elem = $(this);
		if(elem.val() == 1)
		{
			$('.fileinput-button').removeClass('disabled');
			$('#banner_add').removeAttr('disabled');
		}
		else
		{
			$('.fileinput-button').addClass('disabled');
			$('#banner_add').attr('disabled', 'disabled');
		}
	})
	$('#type').livequery('change', function(){
		var elem = $(this);
		if(elem.val() == 1)
		{
			$('.fileinput-button').removeClass('disabled');
			$('#banner').removeAttr('disabled');
		}
		else
		{
			$('.fileinput-button').addClass('disabled');
			$('#banner').attr('disabled', 'disabled');
		}
	})
	$('.change-input').livequery('click', function(){
		$('.input-name, .input-id').toggleClass('hide');
		if($('.input-id').hasClass('hide'))
		{
			$('.input_type').val('name');
		}
		else
		{
			$('.input_type').val('id');	
		}
		return false;
	});

	$("#banner_add").change(function(e){
		var id_notice = 'upload-notice';
	    ajaxUpload(this.form,'ajax/backend/golden_hours_ajax/upload_banner', id_notice,'<div>Đang tải...</div>','Có lỗi xảy ra, bạn hãy kiểm tra lại ảnh');
        
        return false;
    });
    $("#banner").livequery('change', function(e){
		var id_notice = 'upload-notice-edit';
	    ajaxUpload(this.form,'ajax/backend/golden_hours_ajax/upload_banner_edit', id_notice,'<div>Đang tải...</div>','Có lỗi xảy ra, bạn hãy kiểm tra lại ảnh');
        
        return false;
    });

	$('#item_name_add').typeahead({
		source : function(query, process) {
			if($('#item_name_add').val().length > 1)
			{
			    $.ajax({
		            url: "ajax/backend/golden_hours_ajax/suggest_item",
		            type: "GET",
		            data: {
		                limit: 4,
		                query: query,
		            },
		            success: function(data) {
		                return process(JSON.parse(data));
		            }
		        });
			}
		},
		updater:function (item) {
	        $.get('ajax/backend/golden_hours_ajax/filter_id', {
		        item : item
		    }, function(data) {
		        $('#item_id_add').val(data);
		    });
		    return item;
	    }
	});

	$('.add-click').click(function(){
		var time_out;
    	$.validator.addMethod("valueNotEquals", function(value, element, arg){
	      	return arg != value;}, "Value must not equal arg.");   	
    	$('#form-add').validate({
	        rules: {
	            type_add  : { valueNotEquals: "0" },
	        },
	        messages: {
	            type_add  : { valueNotEquals: "Bạn hãy chọn loại golden." }
	        }
	    });
		
		var res = $("#form-add").valid();

		if(res == false)
		{
			return false;
		}
		else
		{
			var elem = $(this);
			var data = $('#form-add').serialize();
			$.ajax({
	            beforeSend: function(){
	            	elem.addClass('disabled');
	            	elem.attr('disabled', 'disabled');
	            },
	            url: 'ajax/backend/golden_hours_ajax/add',
	            global: false,
	            type: "post",
	            data: data,
	            dataType: "json",
	            success: function(data){
	            	elem.removeClass('disabled');
	            	elem.removeAttr('disabled');
	            	if(data.err == 0)
	            	{
	            		$('.result-add').hide().html(data.msg).fadeIn(200);
	            		window.clearTimeout(time_out);
	            		time_out = setTimeout(function(){
						      location.reload();
						},800);
	            	}
	            	else
	            	{
	            		$('.result-add').hide().html(data.msg).fadeIn(200);
	            		return false;
	            	}
	            }
	        });
		}
		return false;
	});

	$('.edit-click').livequery('click', function(){
		var time_out;
    	$.validator.addMethod("valueNotEquals", function(value, element, arg){
	      	return arg != value;}, "Value must not equal arg.");   	
    	$('#form-edit').validate({
	        rules: {
	            type_add  : { valueNotEquals: "0" },
	        },
	        messages: {
	            type_add  : { valueNotEquals: "Bạn hãy chọn loại golden." }
	        }
	    });
		
		var res = $("#form-edit").valid();

		if(res == false)
		{
			return false;
		}
		else
		{
			var elem = $(this);
			var data = $('#form-edit').serialize();
			$.ajax({
	            beforeSend: function(){
	            	elem.addClass('disabled');
	            	elem.attr('disabled', 'disabled');
	            },
	            url: 'ajax/backend/golden_hours_ajax/edit',
	            global: false,
	            type: "post",
	            data: data,
	            dataType: "json",
	            success: function(data){
	            	elem.removeClass('disabled');
	            	elem.removeAttr('disabled');
	            	if(data.err == 0)
	            	{
	            		$('#upload-notice-edit').hide().html(data.msg).fadeIn(200);
	            		return false;
	            	}
	            	else
	            	{
	            		$('#upload-notice-edit').hide().html(data.msg).fadeIn(200);
	            		return false;
	            	}
	            }
	        });
		}
		return false;
	});
	
	$('.del-data').livequery('click', function(e){
        e.preventDefault();
        var r = confirm("Bạn có chắc chắn muốn?");
        if (r == true)
        {
            var elem   = $(this);
            var data_id = elem.data('id');
            $.ajax({
                url: 'ajax/backend/golden_hours_ajax/del_data',
                global: false,
                type: "get",
                data: {'data_id': data_id},
                dataType: "json",
                success: function(data){
                    if(data.err == 0)
                    {
                        elem.parent().parent().remove();
                    }
                }
            });
            return false;
        }
        else
        {   
            return false;
        }
    });
    $('.lock-cat').livequery('click', function(e){
        var elem       = $(this);
        var cat_id     = elem.data('id');
        var cat_status = elem.data('status');
        $.ajax({
            url: 'ajax/backend/golden_hours_ajax/block_cat',
            global: false,
            type: "get",
            data: {'cat_id': cat_id, 'cat_status': cat_status},
            dataType: "json",
            success: function(data){
                if(data.err == 0)
                {
                    if(data.new_status == 0)
                    {
                        elem.data('status', 0);
                        elem.removeClass('btn-success');
                        elem.addClass('btn-danger');
                    }
                    else if(data.new_status == 1)
                    {
                        elem.data('status', 1);
                        elem.removeClass('btn-danger');
                        elem.addClass('btn-success');
                    }
                }
            }
        });
        return false
    });
	$('.update-modal').click(function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		var url = 'ajax/backend/golden_hours_ajax/load_info';
		var data = {'id':id};
		if (url.indexOf('#') == 0) {
			$(url).modal('open');
		} else {
			$.get(url, data, function(data) {
				$('<div class="modal remove">' + data + '</div>').modal();
			}).success(function() { $('input:text:visible:first').focus(); });
		}
	});
});