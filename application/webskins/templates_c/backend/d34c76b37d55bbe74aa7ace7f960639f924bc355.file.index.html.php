<?php /* Smarty version Smarty-3.0.7, created on 2017-02-28 10:07:31
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/about/index.html" */ ?>
<?php /*%%SmartyHeaderCode:139892806258b4e973e7b2c7-47968838%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd34c76b37d55bbe74aa7ace7f960639f924bc355' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/about/index.html',
      1 => 1488179586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139892806258b4e973e7b2c7-47968838',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_imagesize')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/function.imagesize.php';
?><h6 class="title">
    <i class="icon-user"></i>
    Quản trị Ảnh
</h6>
    <div class="fix"></div>
    <a href="<?php echo site_url("admin/about/form");?>
" class="btn btn-success" style="margin-bottom: 12px;"><i class="icon-plus icon-white"></i> Thêm mới ảnh</a>

<table class="table table-bordered table-striped tablesorter">
    <thead>
        <tr>
            <th>#</th>
            <th><i class="icon-book"></i> Miêu tả</th>
            <th><i class="icon-time"></i> Thời gian tạo</th>            
            <th><i class="icon-th-list"></i>Ảnh đại diện</th>
            <th><i class="icon-th-list"></i>Thứ tự</th>
            <th style="width: 128px;"><i class="icon-wrench"></i> Thao tác</th>
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
            <td><a href="admin/about/form/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value['description'],90);?>
</a></td>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['time_create'],"%d/%m/%y %H:%M:%S");?>
</td>            
            <td>
                <?php echo smarty_function_imagesize(array('src'=>$_smarty_tpl->tpl_vars['item']->value['image'],'width'=>60,'height'=>60,'source'=>'img_about','default'=>'default_300_300.png'),$_smarty_tpl);?>
            
            </td>
            
            <td  class="blue editable" lang="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['ordering'];?>
            
            </td>
            <td>
                <a href="admin/about/form/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="btn btn-info"><i class="icon-edit icon-white"></i></a>
                <a href="javascript:;" class="btn lock-guide <?php if ($_smarty_tpl->tpl_vars['item']->value['active']==1){?>btn-success<?php }else{ ?>btn-danger<?php }?>" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" data-placement="top" rel="tooltip" data-original-title="Disable/Enable" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" data-status="<?php echo $_smarty_tpl->tpl_vars['item']->value['active'];?>
"><i class="icon-lock icon-white"></i></a>

                <a href="<?php echo site_url('admin/about');?>
?cmd=del&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" title="Xóa" onclick="if(!confirm('Bạn có chắc chắn muốn xóa ảnh này không?')) return false;" class="btn lock btn-danger" data-placement="top" rel="tooltip" data-original-title="Xóa"><i class="icon-lock icon-white"></i></a>
                
                
                
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
    <i class="icon-list-alt"></i> Tổng số: <?php echo $_smarty_tpl->getVariable('total_data')->value;?>
 kết quả
</div>
<div class="fix"></div>

<!-- Modal Add user -->
<div id="guide-cat-modal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 700px; margin-left: -350px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5>Danh mục hướng dẫn</h5>
    </div>

    
        <div class="modal-body">
            <div style="margin-bottom: 10px;"></div>
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $_smarty_tpl->getVariable('form_cat')->value;?>

                    <div class="result-update" style="margin-bottom: 10px; text-align: left;">
                    </div> 
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on" style="width: 137px;">Tên danh mục</span>
                            <input type="text" id="cat_name" value="" name="cat_name" placeholder="Tên danh mục">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on">Đường dẫn thân thiện</span>
                            <input type="text" id="cat_slug" value="" name="cat_slug" placeholder="Đường dẫn thân thiện">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on" style="width: 137px;">Vị trí ưu tiên</span>
                            <input type="text" id="cat_position" value="" name="cat_position" placeholder="Thứ tự hiển thị">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="checkbox">
                            <input type="checkbox" name="cat_status" value="1" checked="checked"/> Hoạt động
                        </label>
                    </div>
                    <div class="control-group">
                        <button class="btn btn-success add-cat-click cancel">Thêm</button>
                    </div>
                    </form>
                </div>
                <table class="table table-bordered table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="width:230px;">Tên danh mục</th>
                            <th style="width:230px;">Url thân thiện</th>
                            <th>Vị trí</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="cat-guide-tbody">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_cat')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                        <tr>
                            <td class="editable"><a href="javascript:;" class="edit-guide-cat" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" data-type-edit="name"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></td>
                            <td><a href="javascript:;" class="edit-guide-cat" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" data-type-edit="slug"><?php echo $_smarty_tpl->tpl_vars['item']->value['slug'];?>
</a></td>
                            <td><a href="javascript:;" class="edit-guide-cat" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" data-type-edit="position"><?php echo $_smarty_tpl->tpl_vars['item']->value['position'];?>
</a></td>
                            <td>
                                <a href="#" class="btn lock-cat <?php if ($_smarty_tpl->tpl_vars['item']->value['status']==1){?>btn-success<?php }else{ ?>btn-danger<?php }?>" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" data-placement="top" rel="tooltip" data-original-title="Khóa/Bỏ khóa" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" data-status="<?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
"><i class="icon-lock icon-white"></i></a>
                                <a data-original-title="Xóa" rel="tooltip" data-placement="top" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="btn del-cat btn-danger"><i class="icon-trash icon-white"></i></a>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">               
            <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
        </div>
</div>