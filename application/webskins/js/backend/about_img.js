$(document).ready(function(){
    /*$.ajaxSetup({
        url: 'ajax/news/update_img',
        type: 'GET',
        async: false,
        timeout: 500
    });
   // call inlineEdit
    $('.editable').inlineEdit({
        //value: $.ajax({ data: { 'action': 'get' } }).responseText,
        save: function(event, data) {
            var check = 0;
            var html = $.ajax({
               data: {'action': 'save', 'value': data.value,'id':$(this).attr('lang')}               
            }).responseText;
            if(html != 'OK')
                alert(html);
            location.reload();                
            //return html === 'OK' ? true : false;
        }        
    });*/
    
     $('.update-config').click(function(e) {
        var tmp_num_stock = $('#tmp_num_stock').val()  ;
        if (!tmp_num_stock) {
            alert('Please check data input');
            return;
        }
        $.ajax({
            url: 'ajax.php/user_ajax/update_config',
            type: 'get',
            data: {
                'tmp_num_stock': $('#tmp_num_stock').val()                
            },
            dataType: 'json',
            success: function(data) {
                if (data.code == 1) // Add
                {
                    alert(data.msg);
                    window.location.reload();
                } else if (data.code == 2) // Del
                {
                   alert(data.msg);
                } 
            }
        });
    });
});