<?php /* Smarty version Smarty-3.0.7, created on 2013-07-29 23:12:14
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/header/header.html" */ ?>
<?php /*%%SmartyHeaderCode:175926830551f6945e737575-99708209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96e1dfcbcff66f28d3a20028175bcb66670715c6' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/header/header.html',
      1 => 1375114141,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175926830551f6945e737575-99708209',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<header id="header">
        <div class="5grid-layout">
            <div class="row">
                <div class="4u" id="logo">      
                    <a href="<?php echo site_url();?>
" class="mobileUI-site-name"><img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/images/Logo_INCON.png"></a>
                </div>
                <div class="8u" id="menu">
                    <nav class="mobileUI-site-nav">
                        <ul>
                            <li class="<?php if ($_smarty_tpl->getVariable('local')->value=='home'){?>active<?php }?>">
                                <a href="<?php echo site_url();?>
">Trang chủ</a>
                            </li>
                            <li class="<?php if ($_smarty_tpl->getVariable('local')->value=='about'){?>active<?php }?>">
                                <a href="<?php echo about_url();?>
">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="javascript:;">Sản phẩm Dịch vụ</a>
                                <ul class="children">
                                    <?php  $_smarty_tpl->tpl_vars['service'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cate_service')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['service']->key => $_smarty_tpl->tpl_vars['service']->value){
?>
                                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['service']->value['link_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['service']->value['name'];?>
</a></li>
                                    <?php }} ?>
                                </ul>
                            </li>
                            <li class="<?php if ($_smarty_tpl->getVariable('local')->value=='new'){?>active<?php }?>">
                                <a href="<?php echo site_url('tin-tuc');?>
">Tin tức</a>
                                <ul class="children">
                                    <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cate_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value){
?>
                                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['news']->value['link_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['name'];?>
</a></li>
                                    <?php }} ?>
                                </ul>
                            </li>
                            <li class="<?php if ($_smarty_tpl->getVariable('local')->value=='contact'){?>active<?php }?>"><a href="<?php echo contact_url();?>
">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>