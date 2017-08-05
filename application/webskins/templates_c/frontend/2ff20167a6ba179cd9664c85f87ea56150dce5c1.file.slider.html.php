<?php /* Smarty version Smarty-3.0.7, created on 2013-10-25 09:37:43
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/slider.html" */ ?>
<?php /*%%SmartyHeaderCode:21306200185269d97714a2c1-53316254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ff20167a6ba179cd9664c85f87ea56150dce5c1' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/slider.html',
      1 => 1382668661,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21306200185269d97714a2c1-53316254',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
?><div id="slider" style="margin-bottom:20px;">
<?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_image')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
?>
	<img src="<?php echo $_smarty_tpl->tpl_vars['one']->value['img_url'];?>
" width="700" height="250" alt="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['one']->value['description'],20);?>
" title="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['one']->value['description'],50);?>
" />
<?php }} ?>
</div>
<script type="text/javascript">
	$(window).load(function() {
		$('#slider').nivoSlider({
			effect:"random",
	        slices:15,
	        boxCols:8,
	        boxRows:4,
	        animSpeed:600,
	        pauseTime:4000,
	        startSlide:0,
	        directionNav:false,
	        controlNav:false,
	        controlNavThumbs:false,
	        pauseOnHover:false,
	        manualAdvance:false
		});
	});
</script>
