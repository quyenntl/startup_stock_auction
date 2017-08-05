<?php /* Smarty version Smarty-3.0.7, created on 2017-02-27 14:17:41
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/header/header.html" */ ?>
<?php /*%%SmartyHeaderCode:30582714858b3d2952483d7-31589232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '954f75c3b57b6740d5b7c3fec2d58ea82c9fc4f5' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/header/header.html',
      1 => 1488179587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30582714858b3d2952483d7-31589232',
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