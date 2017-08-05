<?php /* Smarty version Smarty-3.0.7, created on 2017-03-02 14:26:08
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/about/contact.html" */ ?>
<?php /*%%SmartyHeaderCode:50499062758b7c910e57610-07915518%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f54127dfcb207d3bc81aad36544eb2f4f5aa192' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/about/contact.html',
      1 => 1488439566,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50499062758b7c910e57610-07915518',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.date_format.php';
?><h6 class="title">
    <i class="icon-user"></i>
    Liên hệ khách hàng
</h6>
<table class="table table-bordered table-striped tablesorter">
    <thead>
        <tr>
            <th>#</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Nội dung</th>
            <th>Thời gian tạo</th>
            <th style="width: 128px;"><i class="icon-wrench"></i> Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
        <tr>
            <td><?php echo $_smarty_tpl->getVariable('offset')->value+$_smarty_tpl->tpl_vars['key']->value+1;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
            <td  class="blue editable" lang="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['ordering'];?>
            
            </td>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['time_create'],"%d/%m/%y %H:%M:%S");?>
</td>            
            <td>
                
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>
<?php if ($_smarty_tpl->getVariable('paging')->value){?>
<div class="pagination">
    <?php echo $_smarty_tpl->getVariable('paging')->value;?>

</div>
<?php }?>
<div class="fix"></div>
<div style="text-align:right; color: #0088CC">
    <i class="icon-list-alt"></i> Tổng số: <?php echo $_smarty_tpl->getVariable('total_data')->value;?>
 kết quả
</div>
<div class="fix"></div>