<?php /* Smarty version Smarty-3.0.7, created on 2013-07-25 23:16:18
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/backend/user/index.html" */ ?>
<?php /*%%SmartyHeaderCode:201830617251f14f52a7ae51-47934416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75088d30f7eed2879d9bdafaeebe22ca5573213c' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/backend/user/index.html',
      1 => 1362071944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201830617251f14f52a7ae51-47934416',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/Applications/XAMPP/xamppfiles/htdocs/stdpr/CDT20/system/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_money_format')) include '/Applications/XAMPP/xamppfiles/htdocs/stdpr/CDT20/system/plugins/modifier.money_format.php';
?><h6 class="title" style=" width: 88%; float: left; "><i class="icon-user"></i>Admin user</h6>
<a href="#add-user-modal" data-toggle="modal" class="btn btn-success" style="margin-top:12px;float:right"><i class="icon-plus icon-white"></i> Add</a>
<div class="fix"></div>
<div class="box-content">
    <h6 class="title"><i class="icon-search"></i>Search</h6>
    <div class="search-form">
        <form class="form-horizontal">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input type="text" name="email" placeholder="Email" value="<?php echo $_smarty_tpl->getVariable('array_get')->value['email'];?>
"/>
                    </div>
                 </div>
                 <div class="control-group">
                    <label class="control-label" for="mobiphone_s">Phone</label>
                    <div class="controls">
                        <input type="text" name="phone" placeholder="Phone" value="<?php echo $_smarty_tpl->getVariable('array_get')->value['phone'];?>
"/>
                    </div>
                 </div>   
            </div>
            <div class="span6">                
                <div class="control-group">
                    <label class="control-label" for="fullname">First name</label>
                    <div class="controls">
                        <input type="text" name="first_name" placeholder="First name" value="<?php echo $_smarty_tpl->getVariable('array_get')->value['first_name'];?>
"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="fullname">Last name</label>
                    <div class="controls">
                        <input type="text" name="last_name" placeholder="Last name" value="<?php echo $_smarty_tpl->getVariable('array_get')->value['last_name'];?>
"/>
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
            <th>#</th>
            <th>Code</th>
            <th>User name</th>
            <th>First name</th>
            <th>Last name</th>            
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Status</th>
            <th>Create date</th>
            <th>Last visited</th>            
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
            <td><?php echo $_smarty_tpl->getVariable('count')->value++;?>
</td>
            <td>
                USR<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
                                    
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['user_name'];?>
</td>            
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['first_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['last_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['phone'];?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('array_role')->value[$_smarty_tpl->tpl_vars['user']->value['role']];?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('_array_status_user')->value[$_smarty_tpl->tpl_vars['user']->value['status']];?>
</td>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['time_created'],"%d/%m/%Y %H:%M");?>
</td>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['time_last_visited'],"%d/%m/%Y %H:%M");?>
</td>
            <td>
                <span>
                    <a class="btn btn-info update-modal" href="#" data-toggle="modal" role="button" u-id="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" data-placement="top" rel="tooltip" data-original-title="Edit"><i class="icon-edit icon-white"></i></a>                    
                </span>
                <span style="display: inline-block;margin-top: 5px;">
                    <a href="#" class="btn lock <?php if ($_smarty_tpl->tpl_vars['user']->value['status']==1){?>btn-success<?php }else{ ?>btn-danger<?php }?>" u-id="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" u-stat="<?php echo $_smarty_tpl->tpl_vars['user']->value['status'];?>
" data-placement="top" rel="tooltip" data-original-title="Looked/Unlock"><i class="icon-lock icon-white"></i></a>
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
        <h5>Add user</h5>
    </div>
    <?php echo $_smarty_tpl->getVariable('form')->value;?>

        <div class="modal-body">
            <div style="margin-bottom: 10px;"></div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input type="text" id="user_name" value="" name="user_name" placeholder="User name" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input type="password" id="password" value="" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input type="text" id="first_name" value="" name="first_name" placeholder="First name" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input type="text" id="last_name" value="" name="last_name" placeholder="Last name" required>
                        </div>
                    </div>                                                         
                </div>
                <div class="span6">
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-phone"></i></span>
                            <input type="text" id="mobiphone" name="mobiphone" value="" placeholder="Phone" required>
                        </div>
                    </div>                    
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input type="text" id="email" value="" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                            <input type="text" id="address" name="address" placeholder="Address" value="" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <select name="status">
                                <?php echo $_smarty_tpl->getVariable('array_status_user')->value;?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <span class="add-on">Role: </span>
                    <input type="radio" name="role" value="1" />ADMIN&nbsp;&nbsp;
                    <input type="radio" name="role" value="2" />CUSTOMER&nbsp;&nbsp;
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