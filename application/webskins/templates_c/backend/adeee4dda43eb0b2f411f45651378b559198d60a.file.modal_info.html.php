<?php /* Smarty version Smarty-3.0.7, created on 2017-07-22 10:13:25
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/user/modal_info.html" */ ?>
<?php /*%%SmartyHeaderCode:11751330825972c2d5e19821-27157833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adeee4dda43eb0b2f411f45651378b559198d60a' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/user/modal_info.html',
      1 => 1500693150,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11751330825972c2d5e19821-27157833',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h5>Tên nhà đầu tư: <?php echo $_smarty_tpl->getVariable('data')->value['fullname'];?>
</h5>
</div>
<?php echo $_smarty_tpl->getVariable('form')->value;?>

<div class="modal-body">
    <div style="margin-bottom: 10px;"></div>
    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <div class="input-prepend">
                    <span class="add-on">Email</span>
                    <input type="text" id="email_edit" value="<?php echo $_smarty_tpl->getVariable('data')->value['email'];?>
" name="email">
                </div>
            </div>
			
			<div class="control-group">
                <div class="input-prepend">
                    <span class="add-on">Fullname</span>
                    <input type="text" id="fullname}" value="<?php echo $_smarty_tpl->getVariable('data')->value['fullname'];?>
" name="fullname">
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <div class="input-prepend">
                    <span class="add-on">Phone</span>
                    <input type="text" id="mobiphone" name="mobiphone" value="<?php echo $_smarty_tpl->getVariable('data')->value['phone'];?>
" placeholder="091xxxxxx">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
" name="u_id" />
</div>
<div class="modal-footer">
    <div class="result-update" style="float: left; width: 330px; margin-bottom: 0px; text-align: left;">
    </div>
    <button href="#" class="btn btn-success update-click">Update</button>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</form>