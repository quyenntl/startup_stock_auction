<?php /* Smarty version Smarty-3.0.7, created on 2017-02-27 14:53:49
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/news/list.html" */ ?>
<?php /*%%SmartyHeaderCode:167425925158b3db0ddfc449-85763946%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fdc73505190cea9d385ea8bd50c42b4438c1a09a' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/news/list.html',
      1 => 1488179588,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167425925158b3db0ddfc449-85763946',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.truncate.php';
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