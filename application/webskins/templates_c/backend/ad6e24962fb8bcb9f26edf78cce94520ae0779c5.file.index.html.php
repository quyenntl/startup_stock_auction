<?php /* Smarty version Smarty-3.0.7, created on 2017-07-22 10:41:46
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/report/index.html" */ ?>
<?php /*%%SmartyHeaderCode:1663200545972c97a159d11-83190204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad6e24962fb8bcb9f26edf78cce94520ae0779c5' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/report/index.html',
      1 => 1500694830,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1663200545972c97a159d11-83190204',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.date_format.php';
?><h6 class="title" style=" width: 88%; float: left; "><i class="icon-user"></i>Investor Report</h6>

<div class="fix"></div>
<div class="box-content">    
    <div class="search-form">
        <form class="form-horizontal">
			
            <div class="span6">				
                <div class="control-group">
                    <label class="control-label col-sm-4 " for="mobiphone_s">Gía khớp lệnh: </label>
                    <div class="controls">
						<label class="control-label" ><?php echo number_format($_smarty_tpl->getVariable('temp_price')->value,0,".",",");?>
 VND</label>
                    </div>
                </div>
				
				 <div class="control-group">
                    <label class="control-label col-sm-4 " for="mobiphone_s">Số cổ phần muốn điều chỉnh: </label>
                    <div class="controls">
						<input type="text" name="tmp_num_stock" value="<?php echo $_smarty_tpl->getVariable('tmp_num_stock')->value;?>
" >
                    </div>
                </div>			
            </div>
			
			<div class="span6">			
			 <div class="control-group">
                    <label class="control-label" for="mobiphone_s">Số cổ phần được khớp lệnh</label>
                    <div class="controls">
                        <label class="control-label" ><?php echo number_format($_smarty_tpl->getVariable('total_stock_tmp')->value,0,".",",");?>
</label>
                    </div>
                </div>	
				 <div class="control-group">
                    <label class="control-label">Tổng số tiền huy động được: </label>
                    <div class="controls">
                        <label class="control-label" ><?php ob_start();?><?php echo $_smarty_tpl->getVariable('total_stock_tmp')->value*$_smarty_tpl->getVariable('temp_price')->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo number_format($_tmp1,0,".",",");?>
 VND</label>
                    </div>
                </div>
			</div>
            	
				<div class="control-group">
               <div class="controls">
                    <button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Preview</button>
                </div></div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><h4>Danh sách nhà đầu tư được khớp lệnh</h4></div>
  </div>
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