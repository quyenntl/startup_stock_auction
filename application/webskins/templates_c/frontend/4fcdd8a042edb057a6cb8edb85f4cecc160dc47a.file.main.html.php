<?php /* Smarty version Smarty-3.0.7, created on 2013-10-25 00:11:47
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/main.html" */ ?>
<?php /*%%SmartyHeaderCode:1014283679526954d350ad73-21251970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fcdd8a042edb057a6cb8edb85f4cecc160dc47a' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/main.html',
      1 => 1382634704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1014283679526954d350ad73-21251970',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_money_format')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.money_format.php';
?><div class="products">
    <?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
?>
        <div class="col col_14 product_gallery <?php if ($_smarty_tpl->tpl_vars['one']->value['i']%3==0){?>no_margin_product<?php }else{ ?> <?php }?>">
            <a href="<?php echo detail_product($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['name']);?>
"><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['one']->value['img_url'];?>
"></a>
            <a href="<?php echo detail_product($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['name']);?>
"><h3><?php echo $_smarty_tpl->tpl_vars['one']->value['name'];?>
</h3></a>
            <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['one']->value['description'],30);?>
</p>
            <p class="product_price"><b>Giá : <?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['one']->value['price']);?>
 VNĐ</b></p>
        </div>
    <?php }} ?>
</div>