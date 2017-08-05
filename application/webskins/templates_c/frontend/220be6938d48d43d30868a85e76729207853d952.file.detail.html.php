<?php /* Smarty version Smarty-3.0.7, created on 2017-03-07 09:33:18
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/products/detail.html" */ ?>
<?php /*%%SmartyHeaderCode:62853808958be1bee8632e1-39151753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '220be6938d48d43d30868a85e76729207853d952' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/products/detail.html',
      1 => 1488853997,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62853808958be1bee8632e1-39151753',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_money_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.money_format.php';
?><main class="content" role="main" itemprop="mainContentOfPage">
    <?php  $_smarty_tpl->tpl_vars['detail'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('info_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['detail']->key => $_smarty_tpl->tpl_vars['detail']->value){
?>
    <div id="product-detail">
        <h1 class="heading" style="margin-bottom: 15px;"><?php echo $_smarty_tpl->tpl_vars['detail']->value['name'];?>
</h1>
        <div class="Information">
            <div class="anhspsp">
                <a class="click-zoom" href="<?php echo $_smarty_tpl->tpl_vars['detail']->value['img_url'];?>
" title="ECOSPORT TREND AT">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['detail']->value['img_url'];?>
" class="attachment-medium size-medium wp-post-image">
                </a>
            </div>
            <div class="thongso">
                <ul>
                    <li>
                        <span class="left">Giá</span>
                        <span class="right">
                       <?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['detail']->value['price']);?>
 VNĐ</span>
                    </li>

                    <li>
                        <span class="left">Giá khuyến mãi</span>
                        <span class="right">
                        <?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['detail']->value['price_sale']);?>
 VNĐ</span>
                    </li>
                    <li>
                        <span class="left" style="width: 380px;">Bạn hãy để lại số điện thoại <a href="<?php echo contact_url();?>
" style="color: blue;">tại đây </a>để biết thông tin mức giá sản phẩm tại tời điểm này. Xin cảm ơn quý khách!</span>
                        <span class="right">
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="clear"></div>
        <div class="entry-content">
            <?php echo $_smarty_tpl->tpl_vars['detail']->value['content'];?>

        </div>
    </div>
    <?php }} ?>
    <div id="related-product">
        <h4 class="heading">Sản Phẩm Liên Quan</h4>
        <ul class="product-list">
        <?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('other_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
?>
            <li class="product-item">
                <div class="product-img">
                    <a class="img" title="ECOSPORT TREND MT" href="<?php echo detail_product($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['name']);?>
">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['one']->value['img_url'];?>
" class="attachment-medium size-medium wp-post-image" alt="<?php echo $_smarty_tpl->tpl_vars['one']->value['name'];?>
" width="300" height="224">
                    </a> 
                </div>
                <a class="product-title" href="<?php echo detail_product($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['name']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['one']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['one']->value['name'];?>
</a>
                <p class="price  gachngang"><?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['one']->value['price']);?>
 VNĐ</p>
                <p class="price"><?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['one']->value['price_sale']);?>
 VNĐ</p><a class="detail" href="<?php echo detail_product($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['name']);?>
" title="Chi tiết">Chi tiết</a>
            </li>
        <?php }} ?>
        </ul>
    </div>
</main>