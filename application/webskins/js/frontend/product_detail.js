jQuery(document).ready(function() {
    var productID       = $('#product_id').val();
	var max_quantity    = parseInt($('#max-quantity').html());
    $('.upNum').click(function(e){
        sumNum  = 1;
        sumNum += parseInt($('#quantity').val());
        if(sumNum >= max_quantity)
	    {
	       e.stopPropagation();
           $('#quantity').val(max_quantity);
	    }
        else {
            $('#quantity').val(sumNum);
        }
        $('#district_select').change();  
	});
    
    $('.downNum').click(function(e){
        sumNum  = parseInt($('#quantity').val());
        sumNum -= 1;
        if(sumNum > max_quantity)
        {
            e.stopPropagation();
            $('#quantity').val(max_quantity);
        }
        else if(sumNum <= 1)
	    {
	       e.stopPropagation();
           $('#quantity').val(1);
	    }
        else {
            $('#quantity').val(sumNum);
        }
        $('#district_select').change();  
	});
    
    $('a.btn-order').click(function(){
        link = $(this).attr('rel') + '?quantity=' + $('#quantity').val();
        window.location.href = link;
    });
    
    // Show tab detail
    $('#tab-detail').find('li').click(function(){
        link = $(this).find('a').attr('rel');
        $('#tab-detail').find('li').removeClass('active');
        $(this).addClass('active');
        $('#html_item_detail').hide();
        $('#html_item_address').hide();
        $('#html_item_feedback').hide();
        $('#'+link).show();
    });
    
    // Show list District
    $('#zone_select').change(function(){
        city_id = $(this).val();
        if(city_id == 69)
        {
            $('#district_select').html('<option>-- Quận / Huyện ---</option>');
            $('#fee_shipping,#fee_cod').html('0 đ');
            return false;
        }
        
        $.ajax({
            url: 'ajax/location_ajax/load_district',
            type: 'get',
            data: {zone_id : city_id},
            success:function(data){
            	if(data)
                {
                    $('#district_select').html(data);
                }
            }
        });        
        return false;
    });
    
    // Tinh Phi van chuyen
    $('#district_select').change(function(){
        city_id     = $('#zone_select').val();
        district_id = $('#district_select').val();
        quantity    = parseInt($('#quantity').val());
        $('#fee_shipping').html('<img src="webskins/skins/global/images/ajax-loader-smal.gif"/>');
        $.ajax({
            url: 'ajax/shipchung_ajax/fee_shipping',
            type: 'get',
            data: {zone_id : city_id, district_id: district_id, product_id : productID,quantity:quantity},
            dataType: 'json',
            success:function(data){
            	if(data.code == 1)
                {
                    $('#fee_shipping').html(data.fee + ' đ');
                    $(".shipping-fee").html(data.fee + ' đ');
                    $('.tien-hang').html(data.tien_hang + ' đ');
                    $('.tong-tien').html(data.total_money + ' đ');
                    if(data.fee_cod == 0){
                        $('.phi-cod').html('Miễn phí');
                    }else if(data.fee_cod == -1){
                        $('.phi-cod').html('Không hỗ trợ');
                    }else if(data.fee_cod > 0){
                        $('.phi-cod').html(data.fee_cod + ' đ');
                    }
                }
            }
        });
        return false;
    });
    
    if($('#zone_select').val() != 0)
    {
        $('#district_select').change();
    }
    $("#quantity").keyup(function(){
        var quantity    = parseInt($(this).val());        
        var str = new String(quantity);
        
        if(str == 'NaN' || quantity == 0){
            $(this).val('1');           
        }
        if(quantity > parseInt($('#max-quantity').html())){
           quantity = parseInt($('#max-quantity').html());
           $("#quantity").val(quantity);
        }        
        $('#district_select').change();
        return;
        
    });    
    // Show công thức tinh điểm
    $('#show_cong_thuc').hover(
        function(){
            $('#cong_thuc_tinh_point').show();
        },
        function(){
            $('#cong_thuc_tinh_point').hide();
        }
    );
    
    
    
});