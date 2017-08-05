$(document).ready(function(){
   $('.del-guide').click(function(e){
        e.preventDefault();        
        var elem    = $(this);
        bootbox.confirm("Bạn có muốn xóa bài này vĩnh viễn?", function(confirmed) {
            if(confirmed == false)
            {
                return false;
            }
            else
            {
                var id = elem.data('id');
                $.ajax({
                    url: 'ajax/guide_ajax/del_guide',
                    global: false,
                    type: "get",
                    data: {'id': id},
                    dataType: "json",
                    success: function(data){
                        if(data.err == 0)
                        {
                            elem.parent().parent().remove();
                        }
                    }
                });
                return false;
            }
        });      
    });

    $('.lock-guide').livequery('click', function(e){
        var elem       = $(this);
        var id     = elem.data('id');
        var status = elem.data('status');
        $.ajax({
            url: 'ajax/guide_ajax/block_guide',
            global: false,
            type: "get",
            data: {'id': id, 'status': status},
            dataType: "json",
            success: function(data){
                if(data.err == 0)
                {
                    if(data.new_status == 0)
                    {
                        elem.data('status', 0);
                        elem.removeClass('btn-success');
                        elem.addClass('btn-danger');
                    }
                    else if(data.new_status == 1)
                    {
                        elem.data('status', 1);
                        elem.removeClass('btn-danger');
                        elem.addClass('btn-success');
                    }
                }
            }
        });
        return false
    });
    
    $('.set-hot').livequery('click', function(e){
        var elem       = $(this);
        var id     = elem.data('id');
        var status = elem.data('status');
        $.ajax({
            url: 'ajax/guide_ajax/set_hot',
            global: false,
            type: "get",
            data: {'id': id, 'status': status},
            dataType: "json",
            success: function(data){
                if(data.err == 0)
                {
                    if(data.new_status == 0)
                    {
                        elem.data('status', 0);
                        elem.removeClass('btn-success');
                        elem.addClass('btn-danger');
                    }
                    else if(data.new_status == 1)
                    {
                        elem.data('status', 1);
                        elem.removeClass('btn-danger');
                        elem.addClass('btn-success');
                    }
                }
            }
        });
        return false
    });
    
    $.ajaxSetup({
        url: 'ajax/news/update',
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
        
    });
    
});