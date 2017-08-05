<?php /* Smarty version Smarty-3.0.7, created on 2013-10-25 10:11:51
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/products/detail.html" */ ?>
<?php /*%%SmartyHeaderCode:9857722315269e17757be51-98675980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3d5738fb199b28f142be1c506c1e190bb857cd7' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/products/detail.html',
      1 => 1382670706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9857722315269e17757be51-98675980',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_money_format')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.money_format.php';
if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
?><?php  $_smarty_tpl->tpl_vars['detail'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('info_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['detail']->key => $_smarty_tpl->tpl_vars['detail']->value){
?>
    <h2><?php echo $_smarty_tpl->tpl_vars['detail']->value['name'];?>
</h2>
    <div class="col col_13">
        <a href="javascript:;"><img width="350" height="200" src="<?php echo $_smarty_tpl->tpl_vars['detail']->value['img_url'];?>
" alt=""></a>
    </div>
    <div class="col no_margin_right"><b>Đặc điểm</b>
        <table>
            <tbody><tr>
                <td width="160" height="30">Giá:</td>
                <td><?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['detail']->value['price']);?>
 VNĐ</td>
            </tr>
            <tr>
                <td height="30">Chiều cao:</td>
                <td><?php echo $_smarty_tpl->tpl_vars['detail']->value['height'];?>
 cm</td>
            </tr>
            <tr>
                <td height="30">Khối lượng:</td>
                <td><?php echo $_smarty_tpl->tpl_vars['detail']->value['weight'];?>
 Gram</td>
            </tr>
            <tr>
                <td height="30">Vật liệu :</td>
                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['detail']->value['material'],21);?>
</td>
            </tr>
        </tbody></table>
    </div>
    <div class="cleaner h30"></div>
    <?php echo $_smarty_tpl->tpl_vars['detail']->value['content'];?>

    <div class="cleaner h50"></div>
<?php }} ?>
<h5><strong>Sản phẩm cùng loại</strong></h5>
<?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('other_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
?>
    <div class="col col_14 product_gallery <?php if ($_smarty_tpl->tpl_vars['one']->value['i']==3){?>no_margin<?php }?>">
        <a href="<?php echo detail_product($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['name']);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['one']->value['img_url'];?>
" alt=""></a>
        <a href="<?php echo detail_product($_smarty_tpl->tpl_vars['one']->value['id'],$_smarty_tpl->tpl_vars['one']->value['name']);?>
"><h3><?php echo $_smarty_tpl->tpl_vars['one']->value['name'];?>
</h3></a>
    </div>
<?php }} ?>