$(document).ready(function(){
    $('.date-picker').datepicker().on('changeDate', function(ev){
		$(this).datepicker('hide');
	});
    $('.accept-modal').click(function(){
        var r=confirm("Bạn có chắc chắn muốn duyệt?");
        if(r){
            var id = $(this).attr('u-id');
            $.ajax({
                url:'ajax/admin_course/accept_course',
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
                url:'ajax/admin_course/un_accept_course',
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
});