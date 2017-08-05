<?php /* Smarty version Smarty-3.0.7, created on 2017-03-06 15:11:06
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/products/main.html" */ ?>
<?php /*%%SmartyHeaderCode:26654644858bd199acf59d7-08263047%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fb1d3ff1a491dd7acc971cb86ed9688d0189686' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/products/main.html',
      1 => 1488787855,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26654644858bd199acf59d7-08263047',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_money_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.money_format.php';
?><main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope">
    <div id="home-news">
        <h1 class="heading"><?php echo $_smarty_tpl->getVariable('info_cate')->value['name'];?>
</h1>
        <ul class="product-list">
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
            <li class="product-item">
                    <div class="product-img">
                     <a class="img" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" href="<?php echo detail_product($_smarty_tpl->tpl_vars['item']->value['id'],$_smarty_tpl->tpl_vars['item']->value['name']);?>
">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['img_url'];?>
" class="attachment-medium size-medium wp-post-image" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" width="300" height="224"></a> 
                    </div>
                <a class="product-title" href="<?php echo detail_product($_smarty_tpl->tpl_vars['item']->value['id'],$_smarty_tpl->tpl_vars['item']->value['name']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
                <p class="price  gachngang">
                    <?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['item']->value['price']);?>
 VNĐ    </p>
                <p class="price"><?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['item']->value['price_sale']);?>
 VNĐ</p>    <a class="detail" href="<?php echo detail_product($_smarty_tpl->tpl_vars['item']->value['id'],$_smarty_tpl->tpl_vars['item']->value['name']);?>
" title="Chi tiết">Chi tiết</a>
            </li>   
        <?php }} ?>           
        </ul><!--End .product-list-->
    </div><!--End #news-wrap-->
</main>