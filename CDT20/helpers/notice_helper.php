<?php
 if(!function_exists('success')){
    function success($msg){
        return '<div class="alert alert-success">'.$msg.'</div>';
    }
 }
 /**
  * hàm thông báo thực hiện lỗi
  */
 if(!function_exists('error')){
    function error($msg){
        return '<div class="alert alert-danger">'.$msg.'</div>';
    }
 }
 /**
  * hàm thông báo thực hiện chờ
  */
 if(!function_exists('warning')){
    function warning($msg) {
        return '<div class="alert alert-warning">'.$msg.'</div>';
    }
 }
 /**
  * hàm đưa ra một thông báo với người dung
  */
 if(!function_exists('information')){
    function information($msg){
      return '<div class="alert alert-info">'.$msg.'</div>';
    }
 }
?>