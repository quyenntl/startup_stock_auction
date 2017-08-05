<?php /* Smarty version Smarty-3.0.7, created on 2017-02-28 10:07:48
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/navigation/navsystem.html" */ ?>
<?php /*%%SmartyHeaderCode:184209260358b4e984ee8b27-86941633%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b5e4ad5ea3d2e3ee7b36774dac5654b92c6c0e4' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/navigation/navsystem.html',
      1 => 1488179587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184209260358b4e984ee8b27-86941633',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h6 class="title"><i class="icon-user"></i>Quản trị Menu System </h6>

<?php echo $_smarty_tpl->getVariable('msg')->value;?>

<div class="box-content" id="khung-edit">
    <h6 class="title"><i class="icon-wrench"></i> &nbsp;Add/Edit Menu</h6>
    <div class="search-form" style="margin-top: 20px;">
       <?php echo $_smarty_tpl->getVariable('begin_form')->value;?>

            <input type="hidden" id="id_edit" name="id_edit" value="<?php echo $_smarty_tpl->getVariable('id_edit')->value;?>
"/>
            <div class="span12">
                 <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="fullname">Name Menu</label>
                            <div class="controls">
                                <input type="text" id="name" name="name" required="" placeholder="Name Menu view"/>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label">Ordering</label>
                            <div class="controls">
                                <input type="text" id="order" name="order" required="" placeholder="Ordering"/>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <div class="control-group">
                        <label class="control-label">Parent menu</label>
                        <div class="controls">
                            <select id="category" name="category">
                                <option value="0">- Parent menu</option>
                            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
?>
                                <option <?php if ($_smarty_tpl->getVariable('id_edit')->value==$_smarty_tpl->tpl_vars['value']->value['id']){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">-- <?php echo $_smarty_tpl->tpl_vars['value']->value['text'];?>
</option>
                                <?php if ($_smarty_tpl->tpl_vars['value']->value['children']){?>
                                    <?php  $_smarty_tpl->tpl_vars['values'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['value']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['values']->key => $_smarty_tpl->tpl_vars['values']->value){
?>
                                    <option <?php if ($_smarty_tpl->getVariable('id_edit')->value==$_smarty_tpl->tpl_vars['values']->value['id']){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['values']->value['id'];?>
">-- -- <?php echo $_smarty_tpl->tpl_vars['values']->value['text'];?>
</option>
                                    <?php }} ?>
                                <?php }?>
                            <?php }} ?>
                            </select>
                        </div>
                    </div>
                
                    <div class="input-prepend">
                        <div class="control-group">
                            <label class="control-label">Link menu</label>
                            <div class="controls">
                                <span class="add-on"><?php echo admin_url();?>
</span>
                                <input class="span6" id="link" name="link" type="text" required="" placeholder="Url-Link"/>
                            </div>
                        </div>                        
                    </div>

            </div>    


            <div class="control-group" style="margin-left: 20px;">
                <div class="controls">
                <button class="btn btn-success" id="addmenu" type="submit"><i class="icon-plus-sign icon-white"></i> &nbsp;Add new menu</button>
                </div>
            </div>            
        <?php echo $_smarty_tpl->getVariable('end_form')->value;?>

    </div>
</div>
<table class="table table-bordered table-striped tablesorter">
    <thead>
        <tr>
            <th style="width:50px;">Ordering</th>
            <th colspan="6"><i class="icon-home"></i> Menu name</th>
            <th style="width: 85px; text-align: center"><i class="icon-wrench"></i> Action</th>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
         <tr>
            <td><strong><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
.<?php echo $_smarty_tpl->tpl_vars['value']->value['order'];?>
</strong></td>
            <td colspan="<?php echo ($_smarty_tpl->getVariable('col_total')->value-$_smarty_tpl->tpl_vars['value']->value['level']);?>
"><strong><?php echo $_smarty_tpl->tpl_vars['value']->value['text'];?>
</strong></td>
            <td>
                    <a class="btn btn-success js_edit" href="navsystem/edit/<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"><i class="icon-edit icon-white"></i></a>
                    <a href="<?php echo admin_url();?>
navsystem/index/del/<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-warning" onclick="return confirm('Do you want delete this menu?')"><i class="icon-trash icon-white"></i></a>
            </td>
        </tr>
        
        <?php if ($_smarty_tpl->tpl_vars['value']->value['children']){?>
            <?php  $_smarty_tpl->tpl_vars['values'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['value']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['values']->key => $_smarty_tpl->tpl_vars['values']->value){
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['values']->key;
?>
                 <tr>
                    <td colspan="<?php echo $_smarty_tpl->tpl_vars['values']->value['level'];?>
"></td>
                    <td style="width: 60px;border-left: none;"><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
.<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</td>
                    <td colspan="<?php echo ($_smarty_tpl->getVariable('col_total')->value-1-$_smarty_tpl->tpl_vars['values']->value['level']);?>
"><?php echo $_smarty_tpl->tpl_vars['values']->value['text'];?>
</td>
                    <td>
                        <a class="btn btn-success js_edit" href="navsystem/edit/<?php echo $_smarty_tpl->tpl_vars['values']->value['id'];?>
"><i class="icon-edit icon-white"></i></a>
                        <a href="<?php echo admin_url();?>
navsystem/index/del/<?php echo $_smarty_tpl->tpl_vars['values']->value['id'];?>
" class="btn btn-danger" onclick="return confirm('Do you want delete this menu?')"><i class="icon-ban-circle icon-white"></i></a>
                    </td>
                </tr>                
                <?php if ($_smarty_tpl->tpl_vars['values']->value['children']){?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['values']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
?>
                             <tr>
                                <td colspan="<?php echo $_smarty_tpl->tpl_vars['val']->value['level'];?>
"></td>
                                <td style="width: 60px;border-left: none;"><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
.<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
.<?php echo $_smarty_tpl->tpl_vars['val']->value['order'];?>
</td>
                                <td colspan="<?php echo ($_smarty_tpl->getVariable('col_total')->value-1-$_smarty_tpl->tpl_vars['val']->value['level']);?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['text'];?>
</td>
                                <td>
                                        <a class="btn btn-success js_edit" href="navsystem/edit/<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><i class="icon-edit icon-white"></i></a>
                                        <a href="<?php echo admin_url();?>
navsystem/index/del/<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="btn btn-danger" onclick="return confirm('Do you want delete this menu?')"><i class="icon-trash icon-white"></i></a>
                                </td>
                            </tr>
                        <?php }} ?>
                <?php }?>                
            <?php }} ?>
        <?php }?>
    <?php }} ?>    
    </tbody>
</table>
<div class="fix"></div>