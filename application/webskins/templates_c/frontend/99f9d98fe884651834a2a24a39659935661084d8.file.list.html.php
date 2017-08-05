<?php /* Smarty version Smarty-3.0.7, created on 2013-07-30 22:08:10
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/news/list.html" */ ?>
<?php /*%%SmartyHeaderCode:123693511251f7d6dac0b380-08808705%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99f9d98fe884651834a2a24a39659935661084d8' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/news/list.html',
      1 => 1375196886,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123693511251f7d6dac0b380-08808705',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/stdpr/CDT20/system/plugins/modifier.truncate.php';
?><div class="post">
    <p class="subtitle">Danh sách</p>
    <?php  $_smarty_tpl->tpl_vars['arr'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_new')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['arr']->key => $_smarty_tpl->tpl_vars['arr']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['arr']->key;
?>
    <div class="box-style" style="float:left;margin:10px 0 10px 0;border-bottom:1px dashed #7D7D7D;">
        <a href="<?php echo detail_new($_smarty_tpl->tpl_vars['arr']->value['id'],$_smarty_tpl->tpl_vars['arr']->value['title']);?>
"><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['arr']->value['img_url'];?>
" height="130" style="width:23%;float:left;"></a>
        <h3 style="float:left;margin-left:20px;color:#7D7D7D;font-size:16px;font-weight:bold;" class="new-title"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['arr']->value['title'],50);?>
</h3><br/>
        <p style="margin-left:20px;margin-top: 5px;float:left;height:auto;width:650px;"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['arr']->value['description'],250);?>
</p>
        <p class="button-style2" style="margin-left:20px;float:left;width:200px;margin-top: -11px;"><a href="<?php echo detail_new($_smarty_tpl->tpl_vars['arr']->value['id'],$_smarty_tpl->tpl_vars['arr']->value['title']);?>
">Chi tiết</a></p>
    </div>
    <?php }} ?>
</div>
<div style="margin:25px 0px 25px;" class="line_2"></div>  
<?php if ($_smarty_tpl->getVariable('pagging')->value){?>
<div class="block_pager">
    <div class="pagging" style="width: 100%;" >
      <?php echo $_smarty_tpl->getVariable('pagging')->value;?>
      
    </div>
</div>
<?php }?>
