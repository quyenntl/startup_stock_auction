jQuery(document).ready(function() {
    $('.btn-up-click').click(function(){
        $('#product_image').click();
    });
    var productID       = $('#product_id').val();
    // bo soan thao Full
    $('.editor')
        .elrte({
        'height': 400,
        toolbar: 'normal', // 'compact',
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
    
    // bo soan thao Tiny
    $('.editor_small')
        .elrte({
        'height': 200,
        toolbar: 'easy', // 'compact',
        fmOpen: function(callback) {
            $('<div />')
                .dialogelfinder({
                rememberLastDir: false,
                onlyMimes: ["image"], 
                commands : [
	'open', 'reload', 'home', 'up', 'back', 'forward', 'quicklook', 'rm', 'mkdir', 'search',  'view',
	'resize', 'sort'],
                getFileCallback: callback // pass callback to file manager
            });
        }
    });
    
    // Giới hạn ký tự tiêu đề dài
    $('input[name^="long_name"]').bind('keyup keydown',function() {  
        len             = this.value.length;
        max_length      = 200;
        div_span        = '#max_long_name';
        if (len >= max_length) {  
            this.value = this.value.substring(0, max_length);
            if(len == max_length)
            {
                $(div_span).text(0);
            } 
        }
        else $(div_span).text(max_length - len);
    });
    
    // Giới hạn ký tự tiêu đề ngắn
    $('input[name^="short_name"]').bind('keyup keydown',function() {  
        len             = this.value.length;
        max_length      = 70;
        div_span        = '#max_short_name';
        if (len >= max_length) {
            this.value = this.value.substring(0, max_length);
            if(len == max_length)
            {
                $(div_span).text(0);
            } 
        }
        else $(div_span).text(max_length - len);
    });
    
    $("#product_image").change(function(e){
        ajaxUpload(this.form,'ajax/frontend/product_ajax/load_image','upload-notice','<div>Loading...','');
        
        return false;
    });
    
    $('#crop-area').livequery(function(){
        $(this).Jcrop({
            aspectRatio: 12 / 13,
            minSize: [ 480,520 ],
            setSelect: [ 60, 70, 480, 520 ],
            onSelect: updateCoords
        });        
    });
    
    function updateCoords(c)
    {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };

    function checkCoords()
    {
        if (parseInt($('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
    };
    
    $('.crop-click').click(function(){
        var elem = $(this);
        checkCoords();
        var data = $('#form-crop-final').serialize();
        $.ajax({
            beforeSend: function(){
                elem.addClass('disabled');
                elem.attr('disabled', 'disabled');
            },
            url: 'ajax/frontend/product_ajax/crop',
            type: 'post',
            data: data,
            dataType: 'json',
            success:function(data){
                if(data.err == 0)
                {
                    elem.removeClass('disabled');
                    elem.removeAttr('disabled');
                    $('#modal-crop-img').modal('hide');
                    $('#show-croped-img').hide().html('<img src="' + data.img_croped + '" width="360" height="390" class="img-polaroid">').fadeIn(200);
                }
            }
        });
        return false;
    });

    $('a.btn-upDeal').click(function(){
      
        var res = $("#form_save").valid();

        if(res == false)
        {
            return false;
        }
        else
        {
            var elem = $(this);
            $('textarea').elrte('updateSource');
            var data = $('#form_save').serialize();
            action = $('#product_code').attr('rel');
        
            var typeAction = (action == 'edit') ? 'edit' : 'accept';
            
            $.ajax({
                beforeSend: function(){
                    elem.addClass('disabled');
                    elem.attr('disabled', 'disabled');
                },
                url: 'ajax/frontend/product_ajax/save?action=' + typeAction,
                type: 'post',
                data: data,
                dataType: 'json',
                success:function(data){
                    if(data.error == 1)
                    {                            
                        elem.removeClass('disabled');
                        elem.removeAttr('disabled');
                        $('#result-action').hide().html(data.html).fadeIn(200);
                        
                        $('html, body').animate({scrollTop:$('#result-action').offset().top - 20},300);
                        
                        if(data.url != '')
                        {
                            setTimeout(function(){
                                window.location = data.url;
                            },1000);
                        }
                        
                    }
                    else
                    {
                        elem.removeClass('disabled');
                        elem.removeAttr('disabled');
                        $('#result-action').hide().html(data.html).fadeIn(200);
                        $('html, body').animate({scrollTop:$('#result-action').offset().top - 20},500);
                    }
                }
            });
        }
        return false;
    });
   
   
    setInterval(autoSaveData, 30000); 
    
	function autoSaveData() {
        
        $('textarea').elrte('updateSource');    
        var data = $('#form_save').serialize();
        
        action = $('#product_code').attr('rel');
        
        typeAction = (action == 'edit') ? 'edit' : 'save';
        
        $.ajax({
            url: 'ajax/frontend/product_ajax/save?action=' + typeAction,
            type: 'post',
            data: data,
            dataType: 'json',
            success:function(data){
                if(data.error == 1)
                {   if(data.code){
                        $('#product_code').val(data.code);
                    }  
                }
            }
        });

    }; 
                       
});