<?php /* Smarty version Smarty-3.0.7, created on 2013-10-24 11:30:48
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/header/header.html" */ ?>
<?php /*%%SmartyHeaderCode:17941570175268a2785cf7c2-92945462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60f1679f1b07260b833da693289d9404d8387b03' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/header/header.html',
      1 => 1382589046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17941570175268a2785cf7c2-92945462',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="header-wrapper">
    <div id="header">
        <div id="logo">
            <img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/images/banner.png">
        </div>
    </div>
    <div id="menu">
        <ul>
            <li class="current_page_item"><a href="<?php echo site_url();?>
" accesskey="1" title="">Trang chủ</a></li>
            <li><a href="<?php echo about_url();?>
" accesskey="1" title="">Giới thiệu</a></li>
            <li><a href="<?php echo site_url('san-pham');?>
" accesskey="2" title="">Sản phẩm</a></li>
            <li><a href="<?php echo contact_url();?>
" accesskey="3" title="">Liên hệ/ mua ở đâu</a></li>
            <li><a href="<?php echo site_url('tin-tuc');?>
" accesskey="4" title="">Tin tức về Phong thuỷ</a></li>
        </ul>
    </div>
</div>