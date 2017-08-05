<?php /* Smarty version Smarty-3.0.7, created on 2013-07-29 16:09:48
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/layout//fe_2col.html" */ ?>
<?php /*%%SmartyHeaderCode:44890433351f6315c9debc1-18891919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed770ad754cd24b8b5888a11b93da7e4d8b0d3df' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/layout//fe_2col.html',
      1 => 1375088963,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44890433351f6315c9debc1-18891919',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $_smarty_tpl->getVariable('page_title')->value;?>
</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $_smarty_tpl->getVariable('meta_description')->value;?>
" />
<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('meta_keyword')->value;?>
" />
<base href="<?php echo base_url();?>
"/>
<?php echo $_smarty_tpl->getVariable('header_script')->value;?>

</head>
<body class="homepage">
<div id="header-wrapper">
	<?php echo $_smarty_tpl->getVariable('header')->value;?>

</div>
<div id="wrapper">
	<div id="page">
		<div class="5grid-layout">
			<div class="row">
				<div class="3u" id="sidebar2">
					<section>
						<div class="sbox1">
							<?php echo $_smarty_tpl->getVariable('list_cate')->value;?>

						</div>
					</section>
				</div>
				<div class="9u mobileUI-main-content" id="content">
					<section>
						<?php echo $_smarty_tpl->getVariable('content')->value;?>

					</section>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="height:100px;">
	<?php echo $_smarty_tpl->getVariable('footer')->value;?>

</div>
</body>
</html>