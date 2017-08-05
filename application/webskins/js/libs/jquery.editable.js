/*Edit inline*/
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
	$(".editable").editable({
		type:'text',
		submit:'Lưu lại',
		cancel:'Bỏ qua',
		editClass:'resultItem',
		onSubmit:function(content){
		  var html = '';
          
          var item_str  = $(this).parents().find('.editable ').attr('id');
          
          var array_str = item_str.split("-"); 
          var check ;
		  $.ajax({
				type:'get',
				async:false,
				data:{'text_current':content.current,'text_prev':content.previous,'id':array_str[1]},
				url:$(this).attr('lang'),
                dataType: 'json',
                success : function(data){
                    if(data.code == 1){
                       check    = 1;
                    }else{
                        alert(data.notice);
                    }
                }
			});			                        
            $('#edit-'+$(this).attr('id')).css('display','block');
            if(check == 1){
                return true;
            }else return false;
		},
		objEdit: true
	});			   
});