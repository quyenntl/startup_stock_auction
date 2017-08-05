$(document).ready(function(){    
    $('.date-picker').datepicker().on('changeDate', function(ev){
		$(this).datepicker('hide');
	});
    $('.accept-modal').click(function(){
        var r=confirm("Bạn có chắc chắn muốn duyệt?");
        if(r){
            var id = $(this).attr('u-id');
            $.ajax({
                url:'ajax/admin_course/accept_reg_car',
                dataType: 'json',
                type: 'GET',
                data: {'id':id},
                success: function(data){
                    alert(data.msg,'Thông báo');
                    window.location.reload(); 
                }
            });
        } 
    });
    $('.un-accept-modal').click(function(){
        var r=confirm("Bạn có chắc chắn muốn bỏ duyệt?");
        if(r){
            var id = $(this).attr('u-id');
            $.ajax({
                url:'ajax/admin_course/un_accept_reg_car',
                dataType: 'json',
                type: 'GET',
                data: {'id':id},
                success: function(data){
                    alert(data.msg,'Thông báo');
                    window.location.reload(); 
                }
            });
        } 
    });
    $('.update-reg-car').click(function(){
        $.ajax({
            url: 'ajax/admin_course/update_len_car',
            dataType: 'json',
            type: 'GET',
            data:{'id':$(this).attr('rel')},
            success: function(data){
                alert(data.msg);
                location.reload();
            }
        });
        
    });
});