<?php /* Smarty version Smarty-3.0.7, created on 2017-03-01 11:51:54
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/layout//frontend_car.html" */ ?>
<?php /*%%SmartyHeaderCode:66965095358b6536a87c746-00366191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac6e95058e4308d893ad980742e129fc5671172f' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/layout//frontend_car.html',
      1 => 1488343081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66965095358b6536a87c746-00366191',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="vi">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title><?php echo $_smarty_tpl->getVariable('page_title')->value;?>
</title>
    <meta name="robots" content="noodp">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Thanh Xuân Ford - Thanh Xuân Ford">
    <meta property="og:description" content="Thanh Xuân Ford">
    <meta property="og:site_name" content="Thanh Xuân Ford">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="Thanh Xuân Ford">
    <meta name="twitter:title" content="Thanh Xuân Ford - Thanh Xuân Ford">
    <meta name="description" content="<?php echo $_smarty_tpl->getVariable('meta_description')->value;?>
" />
    <meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('meta_keyword')->value;?>
" />
    <base href="<?php echo base_url();?>
"/>
    <?php echo $_smarty_tpl->getVariable('header_script')->value;?>

    <style type="text/css" id="custom-background-css">
        body.custom-background { background-color: #f6f6f6; }
    </style>
</head>
<body class="home blog custom-background sidebar-content" itemscope="itemscope" itemtype="http://schema.org/WebPage" cz-shortcut-listen="true">
<div class="site-container">
    <?php echo $_smarty_tpl->getVariable('header')->value;?>

<div class="site-inner">
    <?php echo $_smarty_tpl->getVariable('slide_content')->value;?>

    
<div class="content-sidebar-wrap">
    <?php echo $_smarty_tpl->getVariable('main_content')->value;?>


    <!--left-->
    <aside class="sidebar sidebar-primary widget-area">
        <?php echo $_smarty_tpl->getVariable('sidebar_left')->value;?>

    </aside>
<!--enDleft-->
</div>
</div>
<div class="clear"></div>

<div class="footer-widgets">
    <?php echo $_smarty_tpl->getVariable('footer')->value;?>

    <?php echo $_smarty_tpl->getVariable('footer_script')->value;?>

</body>
</html>