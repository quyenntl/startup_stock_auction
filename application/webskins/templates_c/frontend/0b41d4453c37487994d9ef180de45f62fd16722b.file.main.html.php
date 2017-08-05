<?php /* Smarty version Smarty-3.0.7, created on 2013-07-08 22:38:51
         compiled from "E:\xampp\htdocs\stdpr\application/webskins/templates/frontend/main/main.html" */ ?>
<?php /*%%SmartyHeaderCode:548751dadd0be6d232-18570592%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b41d4453c37487994d9ef180de45f62fd16722b' => 
    array (
      0 => 'E:\\xampp\\htdocs\\stdpr\\application/webskins/templates/frontend/main/main.html',
      1 => 1370283720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '548751dadd0be6d232-18570592',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'E:\xampp\htdocs\stdpr\CDT20\system/plugins/modifier.date_format.php';
?><div class="block_special_topic">
	<div class="type"><p>Hoạt động</p></div>
    <div class="title"><p><a href="javascript:;">Hình ảnh hoạt động nổi bật</a></p></div>
</div>
<div style="height:17px;" class="separator"></div>
<div class="block_home_slider">
	<div class="flexslider" id="home_slider">    	
    <div class="flex-viewport" style="overflow: hidden; position: relative;">
        <ul class="slides" style="width: 1200%; margin-left: -1220px;">
             <?php  $_smarty_tpl->tpl_vars['arr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['arr']->key => $_smarty_tpl->tpl_vars['arr']->value){
?>  
                  <li class="clone" style="width: 610px; float: left; display: block;">
                    <div class="slide">
                        <?php echo $_smarty_tpl->tpl_vars['arr']->value['img_url'];?>

                        <div class="caption">
                            <p class="title"><?php echo $_smarty_tpl->tpl_vars['arr']->value['title'];?>
</p>
                            <p><a href="<?php echo $_smarty_tpl->tpl_vars['arr']->value['link_detail'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['arr']->value['description'];?>
</a></p>
                        </div>                      
                    </div>
                  </li>
              <?php }} ?>         
            </ul></div>
            <ul class="flex-direction-nav"><li><a href="#" class="flex-prev">Previous</a></li><li><a href="#" class="flex-next">Next</a></li></ul></div>
    
    <script type="text/javascript">
		$(function () {
			$('#home_slider').flexslider({
				animation : 'slide',
				controlNav : true,
				directionNav : true,
				animationLoop : true,
				slideshow : false,
				useCSS : false
			});			
		});
	</script>
</div>
<div style="margin:34px 0px 28px;" class="line_2"></div>
<div class="block_media_posts">
    <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news_nomal')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
?>
	<article class="block_media_post">
        <div class="f_pic">
            <a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['img_url'];?>
<span class="hover"></span></a>            
        </div>            
      	<p class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</a></p>
        <p class="date"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['time_create'],"%H:%M %d/%m/%Y");?>
</p>
    </article>
    <?php }} ?>    
</div>