$(function() {
    $('.editor')
        .elrte({
        'height': 400,
        toolbar: 'maxi', // 'compact',
        fmOpen: function(callback) {
            $('<div />')
                .dialogelfinder({
                url: 'webskins/FileManager/connector.php',
                commandsOptions: {
                    getfile: {
                        onlyURL: true,
                        multiple: false,
                        folders: false,
                        oncomplete: 'close'
                    }
                },
                onlyMimes: ["image"],
                rememberLastDir: false,
                commands : [
    'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook', 'rm', 'mkdir', 'upload', 'search',  'view'],
                getFileCallback: callback // pass callback to file manager
            });
        }
    });

    $('#form_guide_edit').validate({
        rules: {
            title    : { required: true},
            slug     : { required: true},
            content : { required: true}
        },
        messages: {
            title: {
                required : "Bạn phải nhập tiêu đề"
            },
            slug: {
                required : "Bạn phải nhập đường dẫn thân thiện"
            },
            content   : {
                required : "Bạn phải nhập nội dung"
              
            }
        }
    });
    
    
    $('.add-cat-click').click(function(){
        var elem = $(this);
        $('#form_cat').validate({
            rules: {
                cat_name    : { required: true},
                cat_slug     : { required: true}
            },
            messages: {
                cat_name: {
                    required : "Bạn phải nhập tiêu đề"
                },
                cat_slug: {
                    required : "Bạn phải nhập đường dẫn thân thiện"
                }
            }
        });
        var res = $("#form_cat").valid();

        if(res == false)
        {
            return false;
        }
        else
        {
            data = $('#form_cat').serialize();
            $.ajax({
                beforeSend: function(){
                    elem.addClass('disabled');
                    elem.attr('disabled', 'disabled');
                },
                url: 'ajax/backend/guide_ajax/add_cat',
                global: false,
                type: "post",
                data: data,
                dataType: "json",
                success: function(data){
                    elem.removeClass('disabled');
                    elem.removeAttr('disabled');
                    if(data.err == 0)
                    {
                        $('.result-update').hide().html(data.msg).fadeIn(200);
                        $('.cat-guide-tbody').prepend(data.new_line);
                    }
                    else
                    {
                        $('#cat_name').focus();
                        $('.result-update').hide().html(data.msg).fadeIn(200);
                    }
                }
            });
        }
        return false;
    });
    
    $('.edit-guide-cat').livequery('dblclick', function(){
        var elem = $(this);
        var cat_id = elem.data('id');
        var value = elem.html();
        var type_edit = elem.data('type-edit');
        var width_input = '';
        if(type_edit == 'position')
        {
            width_input = 'style="width:25px;"';
        }
        elem.parent().html('<input type="text" value="'+value+'" class="input-edit" data-id="'+cat_id+'" data-value="'+value+'" data-type-edit="'+type_edit+'" '+width_input+'>');
        return false;
    });
    $('.input-edit').livequery('focusout', function(){
        var elem      = $(this);
        var new_value = elem.val();
        var cat_id    = elem.data('id');
        var old_value = elem.data('value');
        var type_edit = elem.data('type-edit');
        if(old_value == new_value)
        {
            elem.parent().html('<a href="javascript:;" class="edit-guide-cat" data-id="'+cat_id+'" data-type-edit="'+type_edit+'">'+new_value+'</a>');
            return false;
        }
        else
        {
            if(new_value == '')
            {
                elem.focus();
                elem.css('border', '1px solid red');
                return false;
            }
            $.ajax({
                url: 'ajax/backend/guide_ajax/edit_cat',
                global: false,
                type: "get",
                data: {'new_value': new_value, 'cat_id': cat_id, 'type_edit': type_edit},
                dataType: "json",
                success: function(data){
                    if(data.err == 0)
                    {
                        elem.parent().html('<a href="javascript:;" class="edit-guide-cat" data-id="'+cat_id+'" data-type-edit="'+type_edit+'">'+new_value+'</a>');
                    }
                }
            });
        }
    });

    $('.del-cat').livequery('click', function(e){
        e.preventDefault();
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r == true)
        {
            var elem   = $(this);
            var cat_id = elem.data('id');
            $.ajax({
                url: 'ajax/backend/guide_ajax/del_cat',
                global: false,
                type: "get",
                data: {'cat_id': cat_id},
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
        else
        {   
            return false;
        }
    });

    $('.lock-cat').livequery('click', function(e){
        var elem       = $(this);
        var cat_id     = elem.data('id');
        var cat_status = elem.data('status');
        $.ajax({
            url: 'ajax/backend/guide_ajax/block_cat',
            global: false,
            type: "get",
            data: {'cat_id': cat_id, 'cat_status': cat_status},
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
                    url: 'ajax/backend/guide_ajax/del_guide',
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

    $('#title').keyup(function(){
        var title = $('#title').val();
        var slug = generate_slug(title);
        $('#slug').val(slug);
    });

    $('#slug').focus(function(){
        var title = $('#title').val();
        var slug = generate_slug(title);
        $(this).val(slug);
    });

    $('#cat_name').keyup(function(){
        var title = $('#cat_name').val();
        var slug = generate_slug(title);
        $('#cat_slug').val(slug);
    });

    $('#cat_slug').focus(function(){
        var title = $('#cat_name').val();
        var slug = generate_slug(title);
        $(this).val(slug);
    });

    function generate_slug(str) {
        var str = str.replace(/^\s+|\s+$/g, '');
        var from = "ÁÀẠẢÃĂẮẰẶẲẴÂẤẦẬẨẪáàạảãăắằặẳẵâấầậẩẫóòọỏõÓÒỌỎÕôốồộổỗÔỐỒỘỔỖơớờợởỡƠỚỜỢỞỠéèẹẻẽÉÈẸẺẼêếềệểễÊẾỀỆỂỄúùụủũÚÙỤỦŨưứừựửữƯỨỪỰỬỮíìịỉĩÍÌỊỈĨýỳỵỷỹÝỲỴỶỸĐđÑñÇç·/_,:;";
        var to   = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaooooooooooooooooooooooooooooooooooeeeeeeeeeeeeeeeeeeeeeeuuuuuuuuuuuuuuuuuuuuuuiiiiiiiiiiyyyyyyyyyyddnncc------";
        
        for (var i = 0, l = from.length ; i < l; i++) {
            str = str.replace(new RegExp(from[i], "g"), to[i]);
        }
        str = str.replace(/[^a-zA-Z0-9 -]/g, '').replace(/\s+/g, '-').toLowerCase();
        return str;
    }
});
$('.input-edit').livequery('keypress', function(e) {
    if (e.which == 13)
    {   
        e.preventDefault();
        var elem      = $(this);
        var new_value = elem.val();
        var cat_id    = elem.data('id');
        var old_value = elem.data('value');
        var type_edit = elem.data('type-edit');
        if(old_value == new_value)
        {
            elem.parent().html('<a href="javascript:;" class="edit-guide-cat" data-id="'+cat_id+'" data-type-edit="'+type_edit+'">'+new_value+'</a>');
            return false;
        }
        else
        {
            if(new_value == '')
            {
                elem.focus();
                elem.css('border', '1px solid red');
                return false;
            }
            $.ajax({
                url: 'ajax/backend/guide_ajax/edit_cat',
                global: false,
                type: "get",
                data: {'new_value': new_value, 'cat_id': cat_id, 'type_edit': type_edit},
                dataType: "json",
                success: function(data){
                    if(data.err == 0)
                    {
                        elem.parent().html('<a href="javascript:;" class="edit-guide-cat" data-id="'+cat_id+'" data-type-edit="'+type_edit+'">'+new_value+'</a>');
                    }
                }
            });
        }
    }
});