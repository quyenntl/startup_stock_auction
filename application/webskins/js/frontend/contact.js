$(document).ready(function(){
    // $('ul.pagination li a').livequery('click',function(){
    //     page = parseInt($(this).attr('rel'));               
    //     if($(this).hasClass('active')){
    //         return false;
    //     }
    //     $.ajax({
    //         beforeSend:function(){
    //             $('.content-cb').html('<center><img src="./webskins/skins/global/images/ajax-loader.gif" align="center" /></center>');
    //         },
    //         url: 'ajax/contact/pagbing_cb',
    //         type: 'get',
    //         dataType: 'json',
    //         data: {'page':page},
    //         success: function(data){
    //             if(data.code == 1){
    //                 $('.content-cb').html(data.html);                     
    //             }else{
    //                 return false;
    //             }
    //         }
    //     });
    // });      
    //gui lien he
    $('#send').click(function(){
        name      = $('#name').val();
        email      = $('#email').val();
        phone      = $('#phone').val();
        title      = $('#title').val();
        content      = $('#content').val();
        if(name == ''){
            $('#fname').show();return;
        }
        if(email == ''){
            $('#femail').show();return;
        }
        if(phone == ''){
            $('#fphone').show();return;
        }
        $.ajax({
            beforeSend:function(){
                $('.content-cb').html('<center><img src="./webskins/skins/global/images/ajax-loader.gif" align="center" /></center>');
            },
            url: 'ajax/contact/sendingContact',
            type: 'get',
            dataType: 'json',
            data: {'name':name,'email':email,'phone':phone,'title':title,'content':content},
            success: function(data){
                if(data.code == 1){
                    $('.content-cb').html('<center><div style="background: #33ffcc;width: 256px;">Bạn đã gửi thành công!</div></center>');
                }else{
                    return false;
                }
            }
        });
    });
});