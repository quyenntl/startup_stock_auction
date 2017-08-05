<?php /* Smarty version Smarty-3.0.7, created on 2017-07-26 22:53:06
         compiled from "E:\xampp\htdocs\VP9\application/webskins/templates/backend/config/index.html" */ ?>
<?php /*%%SmartyHeaderCode:218365978bae2a0ea83-04694073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac692143bf74c33ccb2993f3e64fa6f7dacb4ae9' => 
    array (
      0 => 'E:\\xampp\\htdocs\\VP9\\application/webskins/templates/backend/config/index.html',
      1 => 1501084385,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '218365978bae2a0ea83-04694073',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'E:\xampp\htdocs\VP9\CDT20\system/plugins/modifier.date_format.php';
?><h6 class="title">
    <i class="icon-user"></i>
    Admin Config
</h6>
    <div class="fix"></div>
    <!--<a href="<?php echo site_url("admin/config_sys/form");?>
" class="btn btn-success" style="margin-bottom: 12px;"><i class="icon-plus icon-white"></i> Add new</a>-->
<div class="box-content">    
    <div class="search-form">
        <form class="form-horizontal">
			
            <div class="span6">	
				 <div class="control-group">
                    <label class="control-label col-sm-4 " for="mobiphone_s">Số cổ phần muốn điều chỉnh: </label>
                    <div class="controls">
						<input type="text" name="tmp_num_stock" id="tmp_num_stock" value="<?php echo $_smarty_tpl->getVariable('tmp_num_stock')->value;?>
" />
                    </div>
                </div>			
            </div>
				<div class="control-group">
               <div class="controls">
                    <button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Preview</button>
                    <button type="button" class="btn btn-success update-config"><i class="icon-check icon-white"></i> Save</button>
                </div></div>
        </form>
    </div>
</div>

<?php if ($_smarty_tpl->getVariable('total_stock_tmp')->value){?>
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
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['price']*number_format(1000,0,".",".");?>
</td>
			<td><?php echo number_format(($_smarty_tpl->tpl_vars['item']->value['price']*1000*$_smarty_tpl->tpl_vars['item']->value['num_stocks']),0,".",".");?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['num_stocks'];?>
</td>
            <!--<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['time_created'],"%H:%M:%S");?>
</td>-->
        </tr>
        <?php }} ?>
    </tbody>
</table>
<?php }else{ ?>
<table class="table table-bordered table-striped tablesorter">
    <thead>
        <tr>
            <th>#</th>
            <th><i class="icon-book"></i> Name</th>
            <th>Key</th>
            <th> Value</th>          
            <th> Time created</th>           
            <th style="width: 128px;"><i class="icon-wrench"></i> Action</th>
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
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['key'];?>
 </td>                       
            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
 </td>          
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['time_created'],"%d/%m/%y %H:%M:%S");?>
</td> 
           
            <td>
                <a href="admin/config_sys/form/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="btn btn-info"><i class="icon-edit icon-white"></i></a>               

                <a href="<?php echo site_url('admin/config_sys');?>
?cmd=del&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" title="Delete" onclick="if(!confirm('Do you want to delete?')) return false;" class="btn lock btn-danger" data-placement="top" rel="tooltip" data-original-title="Delete"><i class="icon-lock icon-white"></i></a>
                                
                
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
<?php }?>		
	

<div class="fix"></div>
<div style="text-align:right; color: #0088CC">
    <i class="icon-list-alt"></i>Total: <?php echo $_smarty_tpl->getVariable('total_data')->value;?>

</div>
<div class="fix"></div>