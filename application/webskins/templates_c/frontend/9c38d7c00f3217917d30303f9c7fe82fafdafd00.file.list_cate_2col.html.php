<?php /* Smarty version Smarty-3.0.7, created on 2013-07-29 10:21:49
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/news/list_cate_2col.html" */ ?>
<?php /*%%SmartyHeaderCode:52114965551f5dfcd6d0813-29856784%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c38d7c00f3217917d30303f9c7fe82fafdafd00' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/news/list_cate_2col.html',
      1 => 1375068105,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52114965551f5dfcd6d0813-29856784',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Danh mục</h2>
<ul class="style1">
	<?php  $_smarty_tpl->tpl_vars['cate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cate_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cate']->key => $_smarty_tpl->tpl_vars['cate']->value){
?>
    	<li class="<?php if ($_smarty_tpl->tpl_vars['cate']->value['i']==1){?>first<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['cate']->value['link_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['cate']->value['name'];?>
</a></li>
	<?php }} ?>
</ul>