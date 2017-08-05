$(document).ready(function(){ 
         
	$('#submit_login').click(function(){
	   
	   $(this).html('<img src="' + $('#url_img').val() + '/loading_small.gif" border="0">');

	   var data = $('#form_login').serialize();
       
       var comeback =  $('#comeback_url').val();
       
       $.ajax({
          url: 'ajax.php/user_ajax/login',
          type:"post",
          data: data,
          global: false,
          sync: false,
          dataType: "json",
          success: function(data) 
          {
            if(data.code == 1){
                if(comeback!='')
                    window.location.href=comeback;
                else
                    window.location.href=$('#current_url').val();
            }
            else{
                $('#alerts').html(data.html).fadeIn();
                $('#submit_login').html('Login');
            }
          }
        });
       
       return false;
	});
		
		
		
}); 