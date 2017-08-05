<?php /* Smarty version Smarty-3.0.7, created on 2017-02-28 21:12:52
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/about/form.html" */ ?>
<?php /*%%SmartyHeaderCode:6315253858b58564a05d07-65875228%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3dfccbdd8769a60881a234f19e2116c01cbb166' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/about/form.html',
      1 => 1488179586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6315253858b58564a05d07-65875228',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h6 class="title" style=" width: 78%; float: left; ">
    <i class="icon-edit"></i> <?php if ($_smarty_tpl->getVariable('id')->value){?>Sửa ảnh<?php }else{ ?>Thêm ảnh<?php }?>
</h6>

<a href="<?php echo site_url("admin/about");?>
" class="btn btn-success" style="float: right; margin-top: 12px; margin-left: 19px;"><i class="icon-th-list icon-white"></i> Danh sách</a>
<div class="row-fluid">
	<div class="span12">
		<?php if ($_smarty_tpl->getVariable('notice')->value){?>
		<div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button><?php echo $_smarty_tpl->getVariable('notice')->value;?>
</div>
		<?php }?>
		<?php echo $_smarty_tpl->getVariable('form_edit')->value;?>


			<input type="hidden" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" name="id"/>			    
    
            <label>Miêu tả</label>
            <textarea name="description" style="width: 450px;height:50px;"><?php echo $_smarty_tpl->getVariable('data')->value['description'];?>
</textarea>
            
            <label>Ảnh đại diện</label>
            <input type="file" name="image" />
            <?php if ($_smarty_tpl->getVariable('data')->value['image']){?>
            <img src="<?php echo store_data_url();?>
img_about/<?php echo $_smarty_tpl->getVariable('data')->value['image'];?>
" width="80" height="80" />
            <?php }?>
                        
		    <label class="checkbox">
		      	<input type="checkbox" name="status" value="1"<?php if ($_smarty_tpl->getVariable('data')->value['active']==1){?> checked="checked"<?php }?> /> Hoạt động
		    </label>
		    <div class="control-group" style="text-align: center">
    			<button class="btn btn-success guide-cat-add"><i class="icon-ok icon-white"></i> Lưu</button>
		    </div>
		</form>
	</div>
</div>
<div class="fix"></div>