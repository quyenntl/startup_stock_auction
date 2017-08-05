<?php /* Smarty version Smarty-3.0.7, created on 2013-10-24 11:30:48
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/layout//frontend.html" */ ?>
<?php /*%%SmartyHeaderCode:19419105565268a278683c70-09384790%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10ab0a38ab9b69abd0b394a91d76efbf3afe6976' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/layout//frontend.html',
      1 => 1382588851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19419105565268a278683c70-09384790',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="wrapper">
    <?php echo $_smarty_tpl->getVariable('header')->value;?>

    <div id="page" class="container">
        <?php echo $_smarty_tpl->getVariable('sidebar_left')->value;?>

        <div id="content">
        <?php echo $_smarty_tpl->getVariable('slide_content')->value;?>

        <?php echo $_smarty_tpl->getVariable('main_content')->value;?>

        </div>
        <?php echo $_smarty_tpl->getVariable('sidebar_right')->value;?>

    </div>
    <?php echo $_smarty_tpl->getVariable('footer')->value;?>

    <?php echo $_smarty_tpl->getVariable('footer_script')->value;?>

</body>
</html>
