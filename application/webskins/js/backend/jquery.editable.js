/**
*Edit by huandt
*/
(function($){
$.fn.editable = function(options){
	var defaults = {
		onEdit: null,
		onSubmit: null,
		onCancel: function(){$('.editable').show();},
		editClass: null,
		submit: null,
		cancel: null,
		type: 'text', //text, textarea or select
		submitBy: 'blur', //blur,change,dblclick,click
		editBy: 'click',
		inputClass :'text',
		options: null,
		objEdit: false
	}
	if(options=='disable')
		return this.unbind(this.data('editable.options').editBy,this.data('editable.options').toEditable);
	if(options=='enable')
		return this.bind(this.data('editable.options').editBy,this.data('editable.options').toEditable);
	if(options=='destroy')
		return  this.unbind(this.data('editable.options').editBy,this.data('editable.options').toEditable)
					.data('editable.previous',null)
					.data('editable.current',null)
					.data('editable.options',null);
		
	var options = $.extend(defaults, options);
	//$this = $(this);
	options.toEditable = function(){        
		var check = $(this).attr('rel'); 
                       
		if(typeof(check) != 'undefined'){		  
			$this = $("#"+$(this).attr('rel'));            
		}else{
			$this = $(this)
		}
		if($this.hasClass('editable-current')) 
		{
			return;	
		}                
        
		$this.addClass('editable-current ' + options.inputClass);
		$this.data('editable.current',$this.html());
		opts = $this.data('editable.options');
		$.editableFactory[opts.type].toEditable($this.empty(),opts);
		// Configure events,styles for changed content
		$this.data('editable.previous',$this.data('editable.current'))
			 .children()
				 .focus()
				 .addClass(opts.editClass);
		// Submit Event
		if(opts.submit){
			$('<button class="saveIcon" />').appendTo($this)
						.html(opts.submit)
						.one('mouseup',function(){opts.toNonEditable($(this).parent(),true)});                                                
		}else                       
			$this.one(opts.submitBy,function(){opts.toNonEditable($(this),true)})
				 .children()
				 	.one(opts.submitBy,function(){opts.toNonEditable($(this).parent(),true)});                    
        
		// Cancel Event
		if(opts.cancel)
			$('<button class="delIcon" />').appendTo($this)
						.html(opts.cancel)
						.one('mouseup',function(){opts.toNonEditable($(this).parent(),false)});
            
                            
		// Call User Function
		if($.isFunction(opts.onEdit)){		      
			opts.onEdit.apply($this,
									[{
										current:$this.data('editable.current'),
										previous:$this.data('editable.previous')
									}]
								);
		}
	}
	options.toNonEditable = function($this,change){	   
		opts = $this.data('editable.options');
		// Configure events,styles for changed content
		$this.one(opts.editBy,opts.toEditable)
			 .data( 'editable.current',
				    change 
						?$.editableFactory[opts.type].getValue($this,opts)
						:$this.data('editable.current')
					);
               	
		// Call User Function		
		var func = null, success = false;
		if($.isFunction(opts.onSubmit)&&change==true)
			func = opts.onSubmit;
			
		else if($.isFunction(opts.onCancel)&&change==false)
			func = opts.onCancel;
        
		if(func!=null){
			success = func.apply($this,
						[{
							current:$this.data('editable.current'),
							previous:$this.data('editable.previous')
						}]
					);
		}
		// Kiem tra function user return true or false
		if(success == true)
		 	$this.html(
				opts.type=='password'
					?'*****'
					:$this.data('editable.current')
				);
		 else
			$this.html(
				opts.type=='password'
					?'*****'
					:$this.data('editable.previous')
				);
		
		$this.removeClass('editable-current');
	}
	this.data('editable.options',options);

	return  this.bind(options.editBy,options.toEditable);
}
$.editableFactory = {
	'text': {
		toEditable: function($this,options){
		    if($this.attr('id')=='seller-nick-ym-add' || $this.attr('id')=='seller-nick-skype-add' ||$this.attr('id')=='phone' || $this.attr('id')=='user-phone')
                $('<input/>').appendTo($this).val('');
            else
			$('<input/>').appendTo($this)
						 .val($this.data('editable.current'));
                                   
            var edits = $('.editable');         		
            edits.each(function()
			{
				if($(this).attr('rel') == $this.attr('id'))
					$(this).css('display','none');                    
			});
		},
		getValue: function($this,options){
			return $this.children("input").val();
		}
	},
	'password': {
		toEditable: function($this,options){
			$this.data('editable.current',$this.data('editable.password'));
			$this.data('editable.previous',$this.data('editable.password'));
			$('<input type="password"/>').appendTo($this)
										 .val($this.data('editable.current'));
		},
		getValue: function($this,options){
			$this.data('editable.password',$this.children().val());
			return $this.children("input").val();
		}
	},
	'textarea': {
		toEditable: function($this,options){
			$('<textarea/>').appendTo($this)
							.val($this.data('editable.current'));
		},
		getValue: function($this,options){
			return $this.children("textarea").val();
		}
	},
	'select': {
		toEditable: function($this,options){
			$select = $('<select/>').appendTo($this);
			$.each( options.options,
					function(key,value){
						$('<option/>').appendTo($select)
									.html(value)
									.attr('value',key);
					}
				   )
			$select.children().each(
				function(){
					var opt = $(this);
					if(opt.text()==$this.data('editable.current'))
						return opt.attr('selected', 'selected').text();
				}
			)
		},
		getValue: function($this,options){
			var item = null;
			$('select', $this).children().each(
				function(){
					if($(this).attr('selected'))
						return item = $(this).text();
				}
			)
			return item;
		}
	}
}
})(jQuery);
$(document).ready(function(){
    Boxy.DEFAULTS.title = '<div class="title-box-alert" style="font-size:15px !important; padding-left: 1px !important;">Thông báo</div>';
	$(".editable").editable({
		type:'text',
		submit:'Lưu lại',
		cancel:'Bỏ qua',
		editClass:'resultItem',
		onSubmit:function(content){
		  var html = '';         
		  $.ajax({
				type:'get',
				async:false,
				data:{'text_current':content.current,'text_prev':content.previous},
				url:$(this).attr('lang'),
                success : function(data){
                    html = data;                    
                }
			});
			html = $.trim(html);
                        
            $('#edit-'+$(this).attr('id')).css('display','block');
                          
            //result update phone number
            if(html == 'PHONE_INVALID'){
                //Boxy.alert("Số điện thoại không hợp lệ!");
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Số điện thoại không hợp lệ!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }else if(html=='ERROR'){
                //Boxy.alert("Có lỗi trong quá trình thực hiện!");
                $("div.notice-info-acc").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_acc").html('Có lỗi trong quá trình thực hiện!');
                setTimeout("$('div.notice-info-acc').slideUp()",3000);               
                return false;
            }else if(html=='PHONE_IS_NULL'){
                //Boxy.alert("Số điện thoại không được để trống!");
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Số điện thoại không được để trống!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }else if(html=='PHONE_NOT_CHANGE'){               
                return false;
            }else if(html=='PHONE_ACC_IS_NULL'){
                //Boxy.alert("Số điện thoại không được để trống!");
                $("div.notice-info-acc").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_acc").html('Số điện thoại không được để trống!');
                setTimeout("$('div.notice-info-acc').slideUp()",3000);
                return false;
            }
            else if(html=='PHONE_ACC_INVALID'){
                //Boxy.alert("Số điện thoại không được để trống!");
                $("div.notice-info-acc").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_acc").html('Số điện thoại không hợp lệ!');
                setTimeout("$('div.notice-info-acc').slideUp()",3000);
                return false;
            }
            //result update fullname
            else if(html=='FULLNAME_NOT_CHANGE'){                            
                return false;
            }else if(html=='FULLNAME_IS_NULL'){
                //Boxy.alert("Tên người dùng không được để trống");
                $("div.notice-info-acc").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_acc").html('Tên người dùng không được để trống!');
                setTimeout("$('div.notice-info-acc').slideUp()",3000);
                return false;
            }else if(html=='NAMECT_IS_NULL'){
                //Boxy.alert("Tên người dùng không được để trống");
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Tên công ty không được để trống!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }
            //cap nhat nick skype
            else if(html=='SKYPE_INVALID'){
                //Boxy.alert("Nick skype không hợp lệ");
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Nick skype không hợp lệ!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }else if(html=='UPDATE_SUCCESS'){                
                //Boxy.alert("Cập nhật thành công!");
                //$("div.notice-info-acc").removeClass('resetPassError').addClass('resetPassSussce').css('display','block');
//                 $("span.notice_view_acc").html('Nick yahoo không hợp lệ!');
//                 setTimeout("$('div.notice-info-acc').slideUp()",3000);
                return true;
            }else if(html=='NICK_IS_NULL'){
                //Boxy.alert('Tên nick không được để trống');
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Tên nick không được để trống!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }
            //Cap nhat nick yahoo
            else if(html=='YM_INVALID'){
                 //Boxy.alert("Nick yahoo không hợp lệ");
                 $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Nick yahoo không hợp lệ!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }
            //chinh sua email
            else if(html == 'NOT_CHANGE'){
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Email không thay đổi được!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }
            else if(html == 'EMAIL_INVALID'){
                //Boxy.alert("Email không hợp lệ");
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Email không hợp lệ!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }
            else if(html == 'EMAIL_IS_NULL'){
                //Boxy.alert('Email không được để trống');
                $("div.notice-info-contact").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_contact").html('Email không được để trống!');
                setTimeout("$('div.notice-info-contact').slideUp()",3000);
                return false;
            }else if(html=='USER_UPDATE_PHONE_SUCCESS'){
                $('#user-phone-status').removeClass('btnEnablePhone').addClass('btnDisablePhone');
                var str = '<label>Nhập mã xác minh:</label>'+
                        '<input type="text" class="enter-type" style="width:60px" id="input_verify_code" size="6" />&nbsp;&nbsp;'+
                        '<input type="button" class="btNganluong" id="bt_check_verify_code"  value="Gửi" />';
                    $('#box_verify_mobile').html(str).css('display','block');
                // Trong payment
                if(parseInt($('.check_next_step').val()) != 1){
                    $('#hidden-btnextStep').show();
                    $('#hidden-btnextStep').html('<p><a href="javascript:;" id="get-order-link" class="nextStep">Tiếp tục</a></p>');
                }
                return true;
            }else if(html == 'MAX_CHANGE_MOBILE'){
                $("div.notice-info-acc").removeClass('resetPassSussce').addClass('resetPassError').css('display','block');
                $("span.notice_view_acc").html('Bạn thay đổi số điện thoại quá 5 lần trong ngày. Sau 24h bạn mới có thể thực hiện tiếp! ');
                setTimeout("$('div.notice-info-acc').slideUp()",3000);                
                return false;
            }
		},
		objEdit: true
	});			   
});