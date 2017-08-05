<?php /* Smarty version Smarty-3.0.7, created on 2017-07-26 00:23:07
         compiled from "E:\xampp\htdocs\VP9\application/webskins/templates/backend/login/index.html" */ ?>
<?php /*%%SmartyHeaderCode:2041359777e7b268823-22941403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20d2172dd086dd7ea96bc32a61f16d7d93d380c6' => 
    array (
      0 => 'E:\\xampp\\htdocs\\VP9\\application/webskins/templates/backend/login/index.html',
      1 => 1500995136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2041359777e7b268823-22941403',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="width:350px; margin: 0 auto; margin-top: 30px;">
    <div class="widget_login">

        <br />
        <span id="alerts" style="display: inline-block;height: 40px;margin: 17px 0 0;padding: 0;width: 100%;display: none;"></span> <?php echo $_smarty_tpl->getVariable('begin_form')->value;?>

        <div class="control-group" style="text-align: center;">

            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span>
                    <input class="span8" id="prependedInput" value="<?php echo $_smarty_tpl->getVariable('username')->value;?>
" required="" name="username" type="text" placeholder="Username" />
                </div>
            </div>


            <div class="controls" style="margin: 20px 0;">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-question-sign"></i></span>
                    <input class="span8" id="prependedInput" required="" name="password" type="password" placeholder="Password" />
                </div>
            </div>

            <button type="submit" class="large green button radius" id="submit_login" style="width: 230px">Login</button>

        </div>
        <?php echo $_smarty_tpl->getVariable('close_form')->value;?>

        <hr/>
    </div>
</div>
<input type="hidden" name="comeback_url" id="comeback_url" value="<?php echo $_smarty_tpl->getVariable('comeback_url')->value;?>
" />
<input type="hidden" id="url_img" value="<?php echo $_smarty_tpl->getVariable('skin_url')->value;?>
" />
<input type="hidden" id="current_url" value="<?php echo site_url('admin');?>
" />
<div class="copyright" style="text-align: center; border-top: 1px solid #ccc; padding-top:10px; width:350px; margin: 0 auto;"><span style="text-transform: uppercase; font-weight: bold;">© Admin 2017</span> <br/></div>