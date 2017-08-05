$(document).ready(function(){
    $('#quantity').change(function(){
        var quantity    = parseInt($(this).val());
        var price       = parseInt($('#item_price').val());
        var discount    = $('#discount').val();
        if(discount == ''){
            discount = 0;
        }        
        var total_money = quantity*price;        
        $('#item_total_money').val(total_money);
        $('.item-total-money,.result_total_money').html($.number(total_money,0,'.','.') + ' VNĐ');        
        $('.result_total_money_end').html($.number((total_money-discount) ,0,'.','.') + ' VNĐ');
    });
    /*Su dung ma phieu giam gia*/
    $('.use-coupon').click(function(){        
        var coupon_code     = $("#coupon-code").val();
        var item_id         = $('#category_id').val();
        var category_id     = $('#category_id').val();
        $.ajax({
           beforeSend:function(){
                $('.item-coupon-loading').show();
           },           
           url: 'ajax/frontend/payment/use_coupon',
           type: 'GET',
           data: {'code':coupon_code,'item_id':item_id, 'category_id':category_id},
           dataType: 'json',
           success: function(data){
                $('.loading-process').hide();                
                if(data.status == 1){//Truong hop thanh cong                    
                    var discount    = 0;                    
                    if(data.type_sharing == 1){//Theo gia tri
                        discount    = data.value;
                    }else{
                        discount    = parseInt(data.value*$('#item_price').val()/100); 
                    }                    
                    $('.coupon-discount').html($.number(discount,0,'.','.') + ' VNĐ');
                    $('#discount').val(discount);
                    $('.result-coupon-check').show();
                    $('.notice-error').hide();
                    //Tính lại phí
                    $('#quantity').change();
                }else{
                    $('.notice-error').html(data.notice).show();
                }
           }
        });
    });
    $('.btpay-step1').click(function(){
        var quantity    = $('#quantity').val();
        var step2_url   = $('#step2_url').val();
        window.location.href   = step2_url+'?quantity='+quantity; 
    });
    $('#to_city_id').change(function(){		
		var zone_id = $(this).val();
		$.ajax({			
            url: 'ajax/location_ajax/load_district',
            type: 'get',
            data: {'zone_id':zone_id},
            success:function(data){
            	$('#to_district_id').html(data);
            }
       });
	});
    //Tinh phi van chuyen cua shipchung
    $('#to_district_id,#to_city_id').change(function(){        
        var district_id = $('#to_district_id').val();
        var city_id     = $('#to_city_id').val();
        var quantity    = parseInt($('#quantity').val());
        var item_weight = parseInt($('#item_weight').val());
        var weight      = quantity*item_weight; 
        var seller_id   = $('#seller_id').val();
        var item_id     = $('#item_id').val();        
        $.ajax({
           beforeSend:function(){
                $('.shipping_fee').html("<div style='text-align:center'><image src='./webskins/skins/frontend/images/loading1.gif'></div>");
           }, 
           url: 'ajax/frontend/payment/caculate_shipping',
           type: 'get',           
           data: {'to_city_id':city_id,'to_district_id':district_id,'seller_id':seller_id,'quantity':quantity,'item_id':item_id},
           dataType: 'json',
           success: function(data){
                if(data.code == 1){
                    var select_method   = $('input[name=select_method]:checked').val();
                    $('#_suggest_shipping_cod').val(data.carrier_min_cod);
                    $('#suggest_shipping_fee').val(data.price_min);
                    $('#_suggest_shipping_fee').val(data._price_min);
                    if(select_method == 1){
                        $('.shipping_fee').html($.number(data._price_min,0,'.','.') + ' VNĐ');
                        var total_money = data._price_min + quantity*$('#item_price').val();
                        if(data._support_cod == 2){
                            $('.cod-support').removeClass('cod-disable');
                            $('.cod-create-order').show();
                            if(quantity*$('#item_price').val() < 200000){
                                $('._result_cod_fee').html($.number(data.carrier_min_cod,0,'.','.') + ' VNĐ');
                            }else{
                                $('._result_cod_fee').html('Miễn phí CoD');
                            }
                        }else{
                            $('.cod-support').addClass('cod-disable');
                            $('.cod-create-order').hide();
                            $('.cod-support').find('input[name=select_method]').attr('checked',false);
                            $('._result_cod_fee').html("Không hỗ trợ");                        
                        }
                    }else{                                       
                        $('.shipping_fee').html($.number(data.price_min,0,'.','.') + ' VNĐ');
                        var total_money = data.price_min + quantity*$('#item_price').val();
                        if(data._support_cod == 2){
                            $('.cod-support').removeClass('cod-disable');
                            $('.cod-create-order').show();
                            if(quantity*$('#item_price').val() < 200000){
                                $('._result_cod_fee').html($.number(data.carrier_min_cod,0,'.','.') + ' VNĐ');
                            }else{
                                $('._result_cod_fee').html('Miễn phí CoD');
                            } 
                        }else{
                            $('.cod-support').addClass('cod-disable');
                            $('.cod-create-order').hide();
                            $('.cod-support').find('input[name=select_method]').attr('checked',false);
                            $('._result_cod_fee').html("Không hỗ trợ");                         
                        }
                    }
                }else{
                    $('.shipping_fee').html('___');
                    $('.cod-support').addClass('cod-disable');
                    $('.cod-support').find('input[name=select_method]').attr('checked',false);
                    $('.cod-create-order').hide();
                    var total_money = quantity*$('#item_price').val();
                }
                total_money = total_money - $('#discount').val();                
                $('.total-money').html($.number(total_money ,0,'.','.') + ' VNĐ');      
           }  
        });
    });
    
    /*Lựa chọn hình thức thanh toán CoD hay Pas*/
    $('.select-method').click(function(){
        if($(this).hasClass('cod-disable')){
            return false;
        }
        $(this).find('input[name=select_method]').attr('checked','checked');
        var select_method   = $('input[name=select_method]:checked').val();               
        if(select_method == 2){//Not COD       
            $('.shipping_fee').html($.number($('#suggest_shipping_fee').val(),0,'.','.') + ' VNĐ');     
            $('.pas-second').slideDown(100);
            $('.pas-first').slideUp();
            $('.cod-next-class').slideUp();
        }else{//Cod            
            $('.shipping_fee').html($.number($('#_suggest_shipping_fee').val(),0,'.','.') + ' VNĐ');
            $('.cod-next-class').slideDown(100);
            $('.pas-second').slideUp();
            $('.pas-first').slideDown();
            $('#payment-type').val(7);
        }
    });
    
    
    /*Pas : lua chon hinh thuc thanh toan*/
    $('.select-payment-type').click(function(){        
        $(this).find('input[name=payment_type]').attr('checked','checked');        
        var select_payment  = $(this).find('input[name=payment_type]:checked').val();                
        $('.sub-payment').slideUp();
        $('.show-payment-'+select_payment).slideDown();
        $('#payment-type').val(select_payment);
    });
    /*Chon ngan hang*/
    $('div.lst-slBank .bankIcon').click(function(){
        var bank_code   = $(this).attr('rel');
        $('div.lst-slBank .bankIcon').removeClass('active');
        $(this).addClass('active');
        $('#bank-code').val(bank_code);
    });
    
    /*Chọn hình thức ngân hàng*/
    $('.select-bank-method').click(function(){
        $(this).find('input[name=bank_type]').attr('checked','checked');
        var rel = $(this).find('input[name=bank_type]:checked').val();               
        if(rel == 'NH_OFF'){
            $('.box-bank-account').show();            
        }else{
            $('.box-bank-account').hide();
        }
        if(rel == '_NH_OFF'){
            rel = 'NH_OFF';
        }
        $('#bank-method').val(rel);//NH_ON or NH_OFF  
    });
    $('.select-bank-icon').click(function(){
        $(this).next().find('input[name=bank_type]').attr('checked','checked');
        var rel = $(this).next().find('input[name=bank_type]').val();
        
        if(rel == 'NH_OFF'){            
            $('.box-bank-account').show();            
        }else{
            $('.box-bank-account').hide();
        }
        if(rel == '_NH_OFF'){
            rel = 'NH_OFF';
        }
        $('#bank-method').val(rel);//NH_ON or NH_OFF
    });    
    /*Dang nhap ngan luong*/
    $('.login-nganluong').livequery('click',function(){
        var arr_data = $("#form_login_nl").serializeArray();        
        $.ajax({           
            beforeSend:function(){
                $('.loading-login-nl').html("<div style='text-align:center'><image src='./webskins/skins/global/images/loading.gif'></div>").show();
            },
            url:'ajax/frontend/payment/login_nganluong',
            type:'post',
            data: arr_data,
            dataType:'json',
            success:function(data){
                $('.loading-login-nl').html('').hide();
                if(data.code == 1){//Đăng nhập thành công                    
                    $('.form-result-login').html(data.html);
                    if(data.next == 1){
                        $('.next-step-nganluong-payment').show();
                    }else{                        
                        return false;
                    }                    
                }else{
                    $('.login-msg-content').html(data.msg);
                    $('.login-nl-error').show();                    
                    setTimeout("$('.login-nl-error').hide()",3000);    
                }
            }
        });   
    });
    $(".input-password-nl").livequery('keypress',function(event){        
        if(event.which == 13){
            $('.login-nganluong').click();
        }       
    });
     
    /*Doi tai khoan ngan luong*/
    $(".change-account-nganluong").click(function(){        
        $('.form-view-info').html($('.form-hidden').html());
        $('.form-hidden').html('');
    });
      
    
    /*Tiep tuc sang step 2*/
    /*Thanh toan qua ngan luong*/
    $('.bt-next-nganluong').click(function(){
        if(validate_form() == false){
            return;
        }                        
        var arr_data    = $("#form_create_order").serializeArray();
        $.ajax({
            beforeSend:function(){
                $('.nganluong-loading').show();
            },
            url: 'ajax/frontend/payment/add_order',
            type: 'POST',
            dataType: 'json',
            data: arr_data,
            success: function(data){
                $('.loading-process').hide();
                if(data.code == 1){
                    $('.show-payment-1').html(data.html);                    
                }else{                    
                    draw_notice(data.notice);               
                }
            }
        });
    });
    /*Click button tao giao dich CoD*/
    $('.cod-create-order').click(function(){
        if(validate_form() == false){
            return;
        }                       
        var arr_data    = $("#form_create_order").serializeArray();        
        $.ajax({
            beforeSend:function(){
                $('.cod-loading').show();
            },
            url: 'ajax/frontend/payment/add_order',
            type: 'POST',
            dataType: 'json',
            data: arr_data,
            success: function(data){
                $('.loading-process').hide();
                if(data.code == 1){
                    location.href   = data.url; 
                }else{                    
                    draw_notice(data.notice);               
                }
            }
        });
    });
    
    $('.next-bank-payment').click(function(){
        if(validate_form() == false){
            return;
        }
        var bank_code       = $('#bank-code').val();
        var bank_method     = $('#bank-method').val(); 
        if(bank_method == "NH_OFF"){            
            $('#bank_number').val($('#p_bank_number').val());             
        }       
        var arr_data        = $("#form_create_order").serializeArray();                
        
        if(bank_code != '' && bank_method != ''){
            $.ajax({
                beforeSend:function(){
                    $('.bank-loading').show();
                },
                url: 'ajax/frontend/payment/add_order',
                type: 'POST',
                dataType: 'json',
                data: arr_data,
                success: function(data){
                    $('.loading-process').hide();
                    if(data.code == 1){
                        location.href   = data.url; 
                    }else{
                        draw_notice(data.notice); 
                    }
                }
            });                   
        }else{
            alert('Bạn chưa cập nhật đầy đủ thông tin');
            return;
        }
    });
    /*Thanh toan qua dung the visa*/
    $('.next-visa-payment').click(function(){
        if(validate_form() == false){
            return;
        }
        var arr_data    = $("#form_create_order").serializeArray();
        $.ajax({
            beforeSend:function(){
                $('.visa-loading').show();
            },
            url: 'ajax/frontend/payment/add_order',
            type: 'POST',
            dataType: 'json',
            data: arr_data,
            success: function(data){
                $('.loading-process').hide();
                if(data.code == 1){
                    location.href   = data.url; 
                }else{
                    draw_notice(data.notice); 
                }
            }
        });   
    });
    /*Thu tien tai van phong*/
    $('.next-office-payment').click(function(){        
        if(validate_form() == false){
            return;
        }        
        var arr_data    = $("#form_create_order").serializeArray();
        $.ajax({
            beforeSend:function(){
                $('.office-loading').show();
            },
            url: 'ajax/frontend/payment/add_order',
            type: 'POST',
            dataType: 'json',
            data: arr_data,
            success: function(data){
                $('.loading-process').hide();
                if(data.code == 1){
                    location.href   = data.url; 
                }else{
                    draw_notice(data.notice); 
                }
            }
        });
    });        
    /*ngan luong*/
    $('.next-nganluong-payment').click(function(){
        if(validate_form() == false){
            return;
        }
        var arr_data    = $("#form_create_order").serializeArray();
        $.ajax({
            beforeSend:function(){
                $('.nganluong-loading').show();
            },
            url: 'ajax/frontend/payment/add_order',
            type: 'POST',
            dataType: 'json',
            data: arr_data,
            success: function(data){
                $('.loading-process').hide();
                if(data.code == 1){
                    location.href   = data.url; 
                }else{
                    draw_notice(data.notice);                    
                }
            }
        });
    });
    $('.verify-otp').livequery('click',function(){
        var otp_code        = $('#otp-code').val();
        var transaction_id  = $('#transaction_id').val();
        if(otp_code != '' && transaction_id != ''){           
            $.ajax({
                beforeSend:function(){
                    $('. show-payment-1').html("<div style='text-align:center'><image src='./webskins/skins/global/images/ajax-loader.gif'></div>");
                },
                url: 'ajax/frontend/payment/veryfy_otp',
                type: 'GET',
                dataType: 'json',
                data: {'otp_code':otp_code,'transaction_id':transaction_id},
                success: function(data){
                    $('. show-payment-1').html('');
                    if(data.code == 1){
                        location.href   = data.url; 
                    }else{
                        draw_notice(data.notice);                    
                    }
                }
            });
        }else{
            alert('Bạn chưa nhập mã OTP');
            return;
        }
    });
});

/*Ham draw thong bao loi*/
function draw_notice(html){
    scroll_notice('icon-methPay');
    $('.notice-result').html(html);
    $('.msg-result').slideDown(100);    
    return false; 
}
/*process create transaction beforesend*/
function process_create_transaction(obj){
    console.log(obj.parent().html());return;
}
/*process create transaction aftersend*/
function after_process_create_transaction(){
    
}
function validate_form(){    
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
      	return arg != value;}, "Value must not equal arg.");            
    $('#form_create_order').validate({
        rules: {	            
            buyer_name : {required: true},
            to_city_id  : {valueNotEquals: "0"},
            
            to_address: {required:true},               
            buyer_mobiphone: {required:true,number:true},
            
            payment_type: {valueNotEquals: "0"}
        },
        messages: {
            buyer_name:{
                required: "Bạn chưa nhập họ tên" 
            },                   
            to_city_id:{
                valueNotEquals:'Bạn chưa chọn Tỉnh thành'
            },            
            buyer_mobiphone: {
				required : "Bạn chưa nhập điện thoại.",
                number   : "Số điện thoại sai định dạng."					
            },               
            to_address   : {	                
				required : "Bạn chưa nhập địa chỉ."   				
            }              
        }
    });
    var res = $("#form_create_order").valid();
    if(res == false){
        scroll_notice('form-validate');
        return false;
    }       
}