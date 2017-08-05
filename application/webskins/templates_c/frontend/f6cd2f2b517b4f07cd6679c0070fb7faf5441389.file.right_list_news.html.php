<?php /* Smarty version Smarty-3.0.7, created on 2013-07-08 22:38:52
         compiled from "E:\xampp\htdocs\stdpr\application/webskins/templates/frontend/news/right_list_news.html" */ ?>
<?php /*%%SmartyHeaderCode:882851dadd0c03f013-91668348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6cd2f2b517b4f07cd6679c0070fb7faf5441389' => 
    array (
      0 => 'E:\\xampp\\htdocs\\stdpr\\application/webskins/templates/frontend/news/right_list_news.html',
      1 => 1372469182,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '882851dadd0c03f013-91668348',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_imagesize')) include 'E:\xampp\htdocs\stdpr\CDT20\system/plugins/function.imagesize.php';
?><div class="block_popular_posts">
    <h4>Thông tin tuyển sinh</h4> 
    <?php  $_smarty_tpl->tpl_vars['new'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['new']->key => $_smarty_tpl->tpl_vars['new']->value){
?>   
        <div class="article">
        	<div class="pic">
        		<a href="#" class="w_hover">
        			<?php echo smarty_function_imagesize(array('src'=>$_smarty_tpl->tpl_vars['new']->value['image'],'width'=>100,'height'=>100,'source'=>'news','default'=>'default_300_300.png'),$_smarty_tpl);?>

        			<span></span>
        		</a>
        	</div>                
        	<div class="text">
        		<p class="title"><a href="<?php echo detail_new($_smarty_tpl->tpl_vars['new']->value['id'],$_smarty_tpl->tpl_vars['new']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['new']->value['title'];?>
</a></p>        	
        	</div>
        </div>
        <div class="line_3"></div>
    <?php }} ?>    
</div>

<div class="block_popular_stuff">    
    <div class="content">
    	<a href="http://h.thoitrangthuhan.com.vn/tin-tuc/30/Khoa-hoc-du-hoc-Nhat-Ban.html" tabindex="_blank"><img src="<?php echo $_smarty_tpl->getVariable('store_data')->value;?>
/ad/qc_1.jpg" /></a>
    </div>    
    <div class="clearboth"></div>
    
    <div class="line_2"></div>
</div>