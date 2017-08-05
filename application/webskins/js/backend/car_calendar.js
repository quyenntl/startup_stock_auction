$(document).ready(function(){
    $('.date-picker').datepicker().on('changeDate', function(ev){
		$(this).datepicker('hide');
	});
    $('.create-car-cal').click(function(){
        var time_start  = $('#time_create_begin').val();
        var time_end    = $('#time_create_end').val();
        if(time_start && time_end){
            $.ajax({
               url: 'ajax/admin_course/gen_car_calendar',
               type: 'get',
               dataType: 'json',
               data:{'time_start':time_start,'time_end':time_end},
               success: function(data){
                 alert(data.msg);
                 location.reload();   
               } 
            });
        }
    });
});