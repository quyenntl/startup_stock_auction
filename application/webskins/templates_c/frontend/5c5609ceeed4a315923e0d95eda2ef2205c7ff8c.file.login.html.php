<?php /* Smarty version Smarty-3.0.7, created on 2017-07-27 06:41:50
         compiled from "E:\xampp\htdocs\VP9\application/webskins/templates/frontend/main/login.html" */ ?>
<?php /*%%SmartyHeaderCode:19163597928be9c6f26-70658389%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c5609ceeed4a315923e0d95eda2ef2205c7ff8c' => 
    array (
      0 => 'E:\\xampp\\htdocs\\VP9\\application/webskins/templates/frontend/main/login.html',
      1 => 1501097631,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19163597928be9c6f26-70658389',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form class="form-signin">
    <h2 class="form-signin-heading">Mời bạn đăng nhập</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input id="inputEmail" class="form-control" placeholder="Nhập email của bạn.." required="" autofocus="" type="text"><br>
    <input id="inputCode" class="form-control" placeholder="Nhập mã của bạn.." required="" autofocus="" type="password">
    <div class="checkbox">
        <label>
            <input value="remember-me" type="checkbox"> Remember me
          </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="login">Log in</button>
    <br>
    <div id="err"></div>
</form>