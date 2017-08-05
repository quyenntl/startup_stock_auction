<?php /* Smarty version Smarty-3.0.7, created on 2017-07-24 21:10:12
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/user/index.html" */ ?>
<?php /*%%SmartyHeaderCode:3856396785975ffc44b7067-94829982%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5beb59079c5fcdbab81bd5bb6d0ef4baa3b159da' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/user/index.html',
      1 => 1500905396,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3856396785975ffc44b7067-94829982',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_money_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.money_format.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.date_format.php';
?><h6 class="title" style=" width: 88%; float: left; "><i class="icon-user"></i>Investor Management</h6>
<a href="#add-user-modal" data-toggle="modal" class="btn btn-success" style="margin-top:12px;float:right"><i class="icon-plus icon-white"></i> Add</a>
<div class="fix"></div>
<div class="box-content">
    <h6 class="title"><i class="icon-search"></i>Search</h6>
    <div class="search-form">
        <form class="form-horizontal">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="mobiphone_s">Email</label>
                    <div class="controls">
                        <input type="text" name="email" placeholder="Email" value="<?php echo $_smarty_tpl->getVariable('array_get')->value['email'];?>
" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="mobiphone_s">Mã nhà đầu tư</label>
                    <div class="controls">
                        <input type="text" name="ndt_id" placeholder="Mã nhà đầu tư" value="<?php echo $_smarty_tpl->getVariable('array_get')->value['ndt_id'];?>
" />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-bordered table-striped tablesorter">
    <thead>
        <tr>
            <th>Id</th>
            <th>Bid Code</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Current Price</th>
            <th>Create date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['user']->key;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['ndt_id'];?>
</td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['user']->value['code'];?>

            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td>
            <td><?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['user']->value['price_current']);?>
 đ</td>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['time_created'],"%d/%m/%Y %H:%M");?>
</td>
            <td>
                <span>
                    <a class="btn btn-info update-modal" href="#" data-toggle="modal" role="button" u-id="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" data-placement="top" rel="tooltip" data-original-title="Edit"><i class="icon-edit icon-white"></i></a>                    
                </span>
                <span style="display: inline-block;margin-top: 5px;">
                    <a data-original-title="Xóa" rel="tooltip" data-placement="top" u-id="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" class="btn del-guide btn-danger lock"><i class="icon-trash icon-white"></i></a>
                </span>
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
    <i class="icon-list-alt"></i> Total: <?php echo smarty_modifier_money_format($_smarty_tpl->getVariable('total_data')->value);?>

</div>
<div class="fix"></div>

<!-- Modal Add user -->
<div id="add-user-modal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5>Add Investor</h5>
    </div>
    <?php echo $_smarty_tpl->getVariable('form')->value;?>

    <div class="modal-body">
        <div style="margin-bottom: 10px;"></div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"></span>
                        <input type="text" id="fullname" name="fullname" value="" placeholder="Fullname" required>
                    </div>
                </div>
                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-phone"></i></span>
                        <input type="text" id="mobiphone" name="mobiphone" value="" placeholder="Phone">
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on">@</span>
                        <input type="text" id="email" name="email" value="" placeholder="Email" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="result-update" style="float: left; width: 330px; margin-bottom: 0px; text-align: left;">
        </div>
        <button href="#" class="btn btn-success add-click">Save</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </form>
</div>