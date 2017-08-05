<?php /* Smarty version Smarty-3.0.7, created on 2017-07-26 21:20:19
         compiled from "E:\xampp\htdocs\VP9\application/webskins/templates/backend/user/modal_info.html" */ ?>
<?php /*%%SmartyHeaderCode:169365978a52328b261-99947303%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '487c07afbf2e3ba0256f3184771b4809057167db' => 
    array (
      0 => 'E:\\xampp\\htdocs\\VP9\\application/webskins/templates/backend/user/modal_info.html',
      1 => 1501078809,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169365978a52328b261-99947303',
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
                    <input type="text" id="fullname" value="<?php echo $_smarty_tpl->getVariable('data')->value['fullname'];?>
" name="fullname">
                </div>
            </div>
            
            <div class="control-group">
                <div class="input-prepend">
                    <span class="add-on">Số tiền nhờ đặt hộ</span>
                    <input type="text" id="price_fix" value="<?php echo $_smarty_tpl->getVariable('data')->value['price_fix'];?>
" name="price_fix">
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <div class="input-prepend">
                    <span class="add-on">Deposit Amount</span>
                    <input type="text" id="sig_deposit_amt" name="sig_deposit_amt" value="<?php echo $_smarty_tpl->getVariable('data')->value['sig_deposit_amt'];?>
">
                </div>
            </div>
				<div class="control-group">
                    <div class="input-prepend">                       
                        <input type="text" id="code" name="code" value="<?php echo $_smarty_tpl->getVariable('data')->value['code'];?>
" placeholder="Bid Code" required>
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