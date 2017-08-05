<?php /* Smarty version Smarty-3.0.7, created on 2017-07-24 21:29:28
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/layout//frontend.html" */ ?>
<?php /*%%SmartyHeaderCode:1343535211597604485b17b4-48614434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a8e8e6795bf738241916c188aa4bab840a0c948' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/layout//frontend.html',
      1 => 1500906559,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1343535211597604485b17b4-48614434',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href=""> <?php echo $_smarty_tpl->getVariable('meta_refresh')->value;?>

    <style>
        div.fw-footer div.copyright {
            text-align: center;
            font-size: 14px;
            padding: 5em 0 1em 0;
        }
    </style>

    <title><?php echo $_smarty_tpl->getVariable('page_title')->value;?>
</title>
    <base href="<?php echo base_url();?>
" id="base" /> <?php echo $_smarty_tpl->getVariable('header_script')->value;?>

</head>

<body>

    <!-- Fixed navbar -->
    <?php echo $_smarty_tpl->getVariable('menu')->value;?>


    <div class="container">
        <?php echo $_smarty_tpl->getVariable('main_content')->value;?>

        <!-- Main component for a primary marketing message or call to action -->
    </div>
    <!-- /container -->

    <div class="fw-footer">
        <div class="copyright">
            Nguyễn Đình Nam - Startup AI © 2017
        </div>
    </div>
    <?php echo $_smarty_tpl->getVariable('footer')->value;?>
 <?php echo $_smarty_tpl->getVariable('footer_script')->value;?>

</body>

</html>