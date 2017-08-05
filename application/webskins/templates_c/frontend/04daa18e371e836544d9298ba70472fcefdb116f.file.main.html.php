<?php /* Smarty version Smarty-3.0.7, created on 2017-08-05 00:04:36
         compiled from "E:\xampp\htdocs\VP9\application/webskins/templates/frontend/main/main.html" */ ?>
<?php /*%%SmartyHeaderCode:297535984a924593fb4-22700805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04daa18e371e836544d9298ba70472fcefdb116f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\VP9\\application/webskins/templates/frontend/main/main.html',
      1 => 1501865843,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '297535984a924593fb4-22700805',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'E:\xampp\htdocs\VP9\CDT20\system/plugins/modifier.date_format.php';
?><p style="text-align:center;"><b>Số CP dự kiến  phát hành huy động từ NĐT: <?php echo number_format($_smarty_tpl->getVariable('num_stocks')->value,0,".",".");?>
</b> </p>
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Mã NĐT</th>
            <th>Giá đặt (VND)</th>
            <th>Trị giá (VND)</th>
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
        <tr <?php if ($_smarty_tpl->getVariable('current_key')->value==$_smarty_tpl->tpl_vars['key']->value){?> style="border-bottom: 2px solid red;"<?php }?>>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['user_code'];?>
</td>
            <td style="text-align:right;"><?php echo number_format(($_smarty_tpl->tpl_vars['item']->value['price']),0,".",".");?>
</td>
            <td style="text-align:right;"><?php echo number_format(($_smarty_tpl->tpl_vars['item']->value['price']*$_smarty_tpl->tpl_vars['item']->value['num_stocks']),0,".",".");?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['num_stocks'];?>
</td>
            <!--<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['time_created'],"%H:%M:%S");?>
</td>-->
        </tr>
        <?php }} ?>
    </tbody>
</table>

 <div class="home-box-count-time">
    <h3 class="panel-title">Thời gian còn lại:  </h3>
	<span id="getting-started"></span>
	<input type="hidden" id="count_time"  value="<?php echo $_smarty_tpl->getVariable('count_time')->value;?>
" />
 </div>