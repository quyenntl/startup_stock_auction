<?php /* Smarty version Smarty-3.0.7, created on 2017-07-24 17:30:50
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/main.html" */ ?>
<?php /*%%SmartyHeaderCode:16847430465975cc5a159cd5-38218169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e94157092915eab314be2b48e8e79e97edaa7c1' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/main.html',
      1 => 1500892247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16847430465975cc5a159cd5-38218169',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.date_format.php';
?><p style="text-align:center;"><b>Số CP muốn phát hành: <?php echo number_format($_smarty_tpl->getVariable('num_stocks')->value,0,".",".");?>
</b> </p>
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Mã NĐT</th>
            <th>Giá</th>
            <th>Trị giá</th>
            <th>Số CP</th>
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
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['user_code'];?>
</td>
            <td><?php echo number_format($_smarty_tpl->tpl_vars['item']->value['price'],0,".",".");?>
</td>
            <td><?php echo number_format(($_smarty_tpl->tpl_vars['item']->value['price']*$_smarty_tpl->tpl_vars['item']->value['num_stocks']),0,".",".");?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['num_stocks'];?>
</td>
            <!--<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['time_created'],"%H:%M:%S");?>
</td>-->
        </tr>
        <?php }} ?>
    </tbody>
</table>