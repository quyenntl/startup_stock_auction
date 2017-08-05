<?php /* Smarty version Smarty-3.0.7, created on 2017-07-21 23:51:09
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/config/index.html" */ ?>
<?php /*%%SmartyHeaderCode:316252039597230fd9f6750-47467415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da71fb847b303488b8bdfb65563d34214ee41131' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/config/index.html',
      1 => 1500655860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '316252039597230fd9f6750-47467415',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.date_format.php';
?><h6 class="title">
    <i class="icon-user"></i>
    Admin Config
</h6>
    <div class="fix"></div>
    <a href="<?php echo site_url("admin/config_sys/form");?>
" class="btn btn-success" style="margin-bottom: 12px;"><i class="icon-plus icon-white"></i> Add new</a>
		
	
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
<div class="fix"></div>
<div style="text-align:right; color: #0088CC">
    <i class="icon-list-alt"></i>Total: <?php echo $_smarty_tpl->getVariable('total_data')->value;?>

</div>
<div class="fix"></div>