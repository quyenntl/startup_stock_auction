<?php /* Smarty version Smarty-3.0.7, created on 2017-07-18 09:20:16
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/login.html" */ ?>
<?php /*%%SmartyHeaderCode:1744474416596d70603352a3-84787668%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2d85003e3710878607995ca1bb768143f769930' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/login.html',
      1 => 1500344414,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1744474416596d70603352a3-84787668',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form class="form-signin">
    <h2 class="form-signin-heading">Mời bạn đăng nhập</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input id="inputEmail" class="form-control" placeholder="Nhập email của bạn.." required="" autofocus="" type="text"><br>
    <input id="inputCode" class="form-control" placeholder="Nhập mã của bạn.." required="" autofocus="" type="text">
    <div class="checkbox">
        <label>
            <input value="remember-me" type="checkbox"> Remember me
          </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="login">Log in</button>
    <br>
    <div id="err"></div>
</form>