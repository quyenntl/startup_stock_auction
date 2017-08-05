<?php /* Smarty version Smarty-3.0.7, created on 2013-10-25 14:56:26
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/news/detail.html" */ ?>
<?php /*%%SmartyHeaderCode:2090236902526a242aec1898-61855513%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc397058812ad235ba5a9ee3e70f839bbcb19f4d' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/news/detail.html',
      1 => 1382687275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2090236902526a242aec1898-61855513',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.date_format.php';
?><?php  $_smarty_tpl->tpl_vars['detail'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('info_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['detail']->key => $_smarty_tpl->tpl_vars['detail']->value){
?>
    <h2><?php echo $_smarty_tpl->tpl_vars['detail']->value['title'];?>
</h2>
    <div class="col col_13">
        <a href="javascript:;"><img width="350" height="200" src="<?php echo $_smarty_tpl->tpl_vars['detail']->value['img_url'];?>
" alt=""></a>
    </div>
    <div class="description"><b>Mô tả : <br/></b><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['detail']->value['description'],200);?>
</div>
    <div class="cleaner h30"></div>
    <?php echo $_smarty_tpl->tpl_vars['detail']->value['content'];?>

    <div class="cleaner h50"></div>
<?php }} ?>
<h5><strong>Các tin tức khác</strong></h5>
<ul class="other_news">
    <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('other_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value){
?>
	<li><?php echo $_smarty_tpl->tpl_vars['news']->value['i'];?>
/ <a href="<?php echo detail_new($_smarty_tpl->tpl_vars['news']->value['id'],$_smarty_tpl->tpl_vars['news']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a> (<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['time_create'],"%d/%m/%y %H:%M:%S");?>
)</li>
    <?php }} ?>
</ul>