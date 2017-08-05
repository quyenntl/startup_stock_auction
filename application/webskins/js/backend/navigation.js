    
    function pageload(hash) {
		// hash doesn't contain the first # character.
            string  = hash.split("/");
        var id_menu = string[string.length-1];
        
		if(id_menu) {
			$.ajax({
              url: 'ajax/navigation_ajax/get_one',
              data: { id: id_menu },
              dataType: "json",
              success: function(data) 
              {
                if(data.code == 1){
                    $('#addmenu').html('<i class="icon-pencil icon-white"></i> &nbsp;Edit menu');
                    $('#id_edit').val(id_menu);
                    $('#name').val(data.name);
                    $('#order').val(data.order);
                    $('#link').val(data.url);
                    $('#category option[value='+data.parent+']').attr('selected', 'selected');
                    $('html, body').animate({scrollTop:$('#khung-edit').offset().top - 20},1000);
                }
                else{
                    alert('Error!');
                }
              }
            });
		}
	}
    
	$(document).ready(function(){
        var local = location.hash;
        if(local)
        {
            str = local.split('/');
            if(str[1] == 'edit' && str[2] > 0) {
                pageload(local);
            } 
        }
        
		$("a.js_edit").click(function(e){
			// 
            e.stopPropagation(); 
            
            var hash    = this.href;
                string  = hash.split("/");
            var id_menu = string[string.length-1];
            $.ajax({
              url: 'ajax/navigation_ajax/get_one',
              data: { id: id_menu },
              dataType: "json",
              success: function(data) 
              {
                if(data.code == 1){
                    $('#addmenu').html('<i class="icon-pencil icon-white"></i> &nbsp;Edit menu');
                    $('#id_edit').val(id_menu);
                    $('#name').val(data.name);
                    $('#order').val(data.order);
                    $('#link').val(data.url);
                    $('#category option[value='+data.parent+']').attr('selected', 'selected');
                    $('html, body').animate({scrollTop:$('#khung-edit').offset().top - 20},1000);
                }
                else{
                    alert('Error!');
                }
              }
            });
            
            
            $.history.load(id_menu); 
			return false;
		});
	});