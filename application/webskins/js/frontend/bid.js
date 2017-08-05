$(document).ready(function(){
	//Number format
	$('#price,#quantity').number( true );
    
    $('#quantity,#price').keyup(function() {       
        var quantity = $('#quantity').val();
        var price = $('#price').val();
        if (quantity && price) {
            result = quantity*price;
        }else {
            result = 0;
        }        
        $('#investment_val').html(result).number(true);        
    });  
    
     $("#getting-started")
        .countdown($('#count_time').val(), function(event) {
    $(this).text(
      event.strftime('%D Ngày %H:%M:%S')
    );
  }); 
});