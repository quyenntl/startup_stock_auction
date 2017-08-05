$(function() {
    $("#login").click(function() {
        codem = $("#inputCode").val();
        email = $("#inputEmail").val();
        link = $("#base").attr("href");
        $.ajax({
            url: 'ajax.php/user_ajax/login_fe',
            type: 'get',
            data: { 'codebm123': codem, 'email': email },
            dataType: 'json',
            success: function(data) {
                if (data.code == 1) {
                    $('#err').html(data.html);
                    window.location.href = link;
                } else {
                    $('#err').html(data.html);
                }
            }
        });
        return false;
    });
    //
    $(".showhd").mouseover(function() {
        $("#show").show();
    }).mouseout(function() {
        $("#show").hide();
    });
    //
    $(".logout").click(function() {
        link = $("#base").attr("href");
        $.ajax({
            url: 'ajax.php/user_ajax/log_out_fe',
            type: 'get',
            data: {},
            dataType: 'json',
            success: function(data) {
                if (data.code == 1) {
                    window.location.href = link;
                }
            }
        });
    });
    //click bid
   $('#price_fix1').click(function() {
        $("#price").prop('disabled', true);
        $("#quantity").prop('disabled', true);
        $("#price").val('-');
        $("#quantity").val('-');
   });
   
    $('#price_fix').change(function() {      
      if ($(this).prop('checked')) {
            $("#price").prop('disabled', true);
            $("#quantity").prop('disabled', true);
            $("#price").val('-');
            $("#quantity").val('-');
            $('#investment_val').html(0);
      }else {
            $("#price").prop('disabled', false);
            $("#quantity").prop('disabled', false);    
                   
      }
    });
    
    $("#bid").click(function() {
        var price = $("#price").val();
        var quantity = $("#quantity").val();        
                 
        $.ajax({
            url: 'ajax.php/user_ajax/actionBid',
            type: 'get',
            data: {'price': price, 'quantity': quantity,'price_fix': $('#price_fix').prop('checked')},
            dataType: 'json',
            success: function(data) {
                if (data.code == 1) {
                    $(".notice").html(data.html);
                    setTimeout(function() {
                        window.location.reload();
                        }, 3000);
                } else {
                    $(".notice").html(data.html);
                }
            }
        });
    });
    
   
});