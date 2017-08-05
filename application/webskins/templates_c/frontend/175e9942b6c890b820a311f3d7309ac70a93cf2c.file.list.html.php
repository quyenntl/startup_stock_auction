<?php /* Smarty version Smarty-3.0.7, created on 2013-10-25 00:14:08
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/news/list.html" */ ?>
<?php /*%%SmartyHeaderCode:394642763526955604c9200-40346780%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '175e9942b6c890b820a311f3d7309ac70a93cf2c' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/news/list.html',
      1 => 1382634846,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '394642763526955604c9200-40346780',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
?><div class="products">
    <?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
?>
        <div class="col col_14 product_gallery <?php if ($_smarty_tpl->tpl_vars['one']->value['i']%3==0){?>no_margin_product<?php }else{ ?> <?php }?>">
            <a href="<?php echo detail_new($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['title']);?>
"><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['one']->value['img_url'];?>
"></a>
            <a href="<?php echo detail_new($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['title']);?>
"><h3><?php echo $_smarty_tpl->tpl_vars['one']->value['title'];?>
</h3></a>
            <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['one']->value['description'],30);?>
</p>
        </div>
    <?php }} ?>
    <div class="paging">
        <?php echo $_smarty_tpl->getVariable('pagging')->value;?>

    </div>
</div>