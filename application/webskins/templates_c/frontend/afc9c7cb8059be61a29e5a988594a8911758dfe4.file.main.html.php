<?php /* Smarty version Smarty-3.0.7, created on 2013-10-25 00:07:12
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/products/main.html" */ ?>
<?php /*%%SmartyHeaderCode:162910339526953c0385db0-04048959%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'afc9c7cb8059be61a29e5a988594a8911758dfe4' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/products/main.html',
      1 => 1382634430,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162910339526953c0385db0-04048959',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_money_format')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.money_format.php';
?><div class="products">
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
        <div class="col col_14 product_gallery <?php if ($_smarty_tpl->tpl_vars['item']->value['i']%3==0){?>no_margin_product<?php }else{ ?> <?php }?>">
            <a href="<?php echo detail_product($_smarty_tpl->tpl_vars['item']->value['id'],$_smarty_tpl->tpl_vars['item']->value['name']);?>
"><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['item']->value['img_url'];?>
"></a>
            <a href="<?php echo detail_product($_smarty_tpl->tpl_vars['item']->value['id'],$_smarty_tpl->tpl_vars['item']->value['name']);?>
"><h3><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</h3></a>
            <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value['description'],30);?>
</p>
            <p class="product_price"><b>Giá : <?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['item']->value['price']);?>
 VNĐ</b></p>
        </div>
        <?php }} ?>
    <div class="paging">
        <?php echo $_smarty_tpl->getVariable('pagging')->value;?>

    </div>
</div>