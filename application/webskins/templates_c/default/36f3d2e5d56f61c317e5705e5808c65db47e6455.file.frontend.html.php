<?php /* Smarty version Smarty-3.0.7, created on 2013-07-29 16:09:50
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/layout//frontend.html" */ ?>
<?php /*%%SmartyHeaderCode:180748002151f6315eab8ea2-70312236%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36f3d2e5d56f61c317e5705e5808c65db47e6455' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/layout//frontend.html',
      1 => 1375088980,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180748002151f6315eab8ea2-70312236',
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
<!--[if IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
<body class="homepage">
    <div id="header-wrapper">
        <?php echo $_smarty_tpl->getVariable('header')->value;?>

    </div>
    <div class="5grid-layout">
        <?php echo $_smarty_tpl->getVariable('sidebar')->value;?>

    </div>
    <div id="wrapper">
        <div id="page">
            <?php echo $_smarty_tpl->getVariable('main_content')->value;?>

        </div>
    </div>
    <div style="height:100px;">
        <?php echo $_smarty_tpl->getVariable('footer')->value;?>

    </div>
<?php echo $_smarty_tpl->getVariable('footer_script')->value;?>

</body>
</html>