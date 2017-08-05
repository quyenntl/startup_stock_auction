jQuery(document).ready(function() {

    var productID = $('#product_id').val();
    // show list comment in item detail
    $(function() {
             $.ajax({
                url: 'ajax/frontend/items_detail_ajax/list_comment',
                type: 'get',
                data: { id: productID},
                sync: false,
                global: false,
                dataType: 'json',
                success:function(data){
                	if(data.code == 1)
                    {
                        $('#list_coment').html(data.html);
                    }
                }
            });
            return false;
    });
    
    $('.page_ajax').livequery('click',function(e){
        id      = $(this).attr('id');
        page    = $(this).attr('rel');
        $.ajax({
            url: 'ajax/frontend/items_detail_ajax/list_comment',
            type: 'get',
            data: { id: id, page : page},
            sync: false,
            global: false,
            dataType: 'json',
            success:function(data){
            	if(data.code == 1)
                {
                    $('#list_coment').html(data.html);
                }
            }
        });
        return false;
    });
    
    $("textarea").keydown(function(e){
        // Enter was pressed without ctrl key
        if (e.keyCode == 13 && e.ctrlKey)
        {
            $('textarea').val($('textarea').val() + '\n');
            // prevent default behavior
            e.preventDefault();
            return false;
        }
        else if(e.keyCode == 13)
        {
            return false;
        }
    });
    
    // call editor comment
   $('.reply_comment').livequery('click',function(e){
        id      = $(this).attr('id');
        parent  = $(this).attr('parent');
        editor  = $('#editor_comment').html();
        if($('#form_comment_' + id).html())
        {
            $('#form_comment_' + id).html('').hide();
        }
        else
        {
            $('.reply_comment_html').html('').hide();
            $('#form_comment_' + id).html(editor);
            $('#form_comment_' + id).find('textarea').css('width','100%');
            $('#form_comment_' + id).find('.send_comment').attr('rel',parent);
            $('#form_comment_' + id).show();
        }
        return false;
   }); 
   
   // delete comment
   $('.delete_comment').livequery('click',function(e){
        e.stopPropagation();
        id = $(this).attr('id');
        $.ajax({
            url: 'ajax/frontend/items_detail_ajax/delete_comment',
            type: 'get',
            data: {id : id},
            sync: false,
            global: false,
            dataType: 'json',
            success:function(data){
            	if(data.code == 1)
                {
                    $('#list_coment').html(data.html);
                }
            }
        });
        return false;
   });
   // post comment
   $('.send_comment').livequery('click',function(e){
            e.stopPropagation();
            if(!$(this).parents('form').find('textarea').val())
            {
                $(this).parents('form').find('textarea').focus();
            }
            else
            {
                //datapost = $('#comment_form').serialize();
                datapost = $(this).parents('form').serialize();
                reply_id = $(this).attr('rel');
                $.ajax({
                    url: 'ajax/frontend/items_detail_ajax/post_comment?id=' + productID + '&reply=' + reply_id,
                    type: 'POST',
                    data: datapost,
                    sync: false,
                    global: false,
                    dataType: 'json',
                    success:function(data){
                    	if(data.code == 1)
                        {
                            $('#list_coment').html(data.html);
                            $('textarea').val('');
                        }
                    }
                });
            }
            return false;
    });
    
});