<?php /* Smarty version Smarty-3.0.7, created on 2013-10-24 10:06:43
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/backend/products/form.html" */ ?>
<?php /*%%SmartyHeaderCode:125125983952688ec3ea0919-41217810%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '703b41d9b52784e15ae09d987f240af3a19b5497' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/backend/products/form.html',
      1 => 1382583965,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125125983952688ec3ea0919-41217810',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h6 class="title" style=" width: 78%; float: left; ">
    <i class="icon-edit"></i> <?php if ($_smarty_tpl->getVariable('id')->value){?>Sửa sản phẩm<?php }else{ ?>Thêm sản phẩm<?php }?>
</h6>

<a href="<?php echo site_url("admin/products");?>
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
			<label>Tiêu đề</label>
		    <input type="text" id="title" value="<?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
" name="title" class="span6"/>

		    <label>Giá</label>
		    <input type="text" id="price" value="<?php echo $_smarty_tpl->getVariable('data')->value['price'];?>
" name="price" size="5" /> (VND)
            
            <label>Chiều cao</label>
		    <input type="text" id="height" value="<?php echo $_smarty_tpl->getVariable('data')->value['height'];?>
" name="height" size="5" /> (cm)

		    <label>Khối lượng</label>
		    <input type="text" id="weight" value="<?php echo $_smarty_tpl->getVariable('data')->value['weight'];?>
" name="weight" size="5" /> (Gram)
		    <label>Vật liệu sản xuất</label>
		    <input type="text" id="material" value="<?php echo $_smarty_tpl->getVariable('data')->value['material'];?>
" name="material" size="20" />
		    <label>Nổi bật
		      	<input type="checkbox" name="status" value="1"<?php if ($_smarty_tpl->getVariable('data')->value['active']==1){?> checked="checked"<?php }?> /></label> 
		    <!--label>Url fix cứng</label>
		    <input type="text" id="slug" placeholder="<?php echo site_url();?>
[url]" value="<?php echo $_smarty_tpl->getVariable('data')->value['url_fix'];?>
" name="url_fix" class="span6"/-->
    
		    <label>Danh mục</label>
            <select name="guide_category_id" id="guide_category_id">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('category_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->getVariable('data')->value['cate_id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                <?php }} ?>
            </select>
            <label>Miêu tả</label>
            <textarea name="description" style="width: 450px;height:50px;"><?php echo $_smarty_tpl->getVariable('data')->value['description'];?>
</textarea>
            
            <label>Ảnh đại diện</label>
            <input type="file" name="image" />
            <?php if ($_smarty_tpl->getVariable('data')->value['image']){?>
            <img src="<?php echo store_data_url();?>
news/<?php echo $_smarty_tpl->getVariable('data')->value['image'];?>
" width="80" height="80" />
            <?php }?>
            <label>Nội dung</label>
		    <textarea id="content" name="content" class="span9 editor"><?php echo $_smarty_tpl->getVariable('data')->value['content'];?>
</textarea>
		
		    <div class="control-group" style="text-align: center">
    			<button class="btn btn-success guide-cat-add"><i class="icon-ok icon-white"></i> Lưu</button>
		    </div>
		</form>
	</div>
</div>
<div class="fix"></div>