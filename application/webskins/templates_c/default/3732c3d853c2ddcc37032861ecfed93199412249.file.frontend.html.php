<?php /* Smarty version Smarty-3.0.7, created on 2013-07-08 22:38:52
         compiled from "E:\xampp\htdocs\stdpr\application/webskins/templates/layout//frontend.html" */ ?>
<?php /*%%SmartyHeaderCode:2133851dadd0c29d395-83798194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3732c3d853c2ddcc37032861ecfed93199412249' => 
    array (
      0 => 'E:\\xampp\\htdocs\\stdpr\\application/webskins/templates/layout//frontend.html',
      1 => 1370877737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2133851dadd0c29d395-83798194',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="COPYRIGHT" content="Copyright (c) by 1Top" />
<meta name="ROBOTS" content="INDEX, FOLLOW" />
<meta name="Googlebot" content="index,follow,archive" />
<meta name="google-site-verification" content="_6BlIjkj1lduoGAR3oH_Ey1LNRzoKNaG9SARy0nuVkU" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="<?php echo $_smarty_tpl->getVariable('page_title')->value;?>
" />
<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('meta_keyword')->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->getVariable('meta_description')->value;?>
" /> 
<base href="<?php echo base_url();?>
"/>
<title><?php echo $_smarty_tpl->getVariable('page_title')->value;?>
</title>
<?php echo $_smarty_tpl->getVariable('header_script')->value;?>

<link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic" rel="stylesheet" type="text/css" />
</head>
<body id="top">
    <div class="wrapper sticky_footer">
    <header><?php echo $_smarty_tpl->getVariable('header')->value;?>
</header> 
    <div id="content" class="right_sidebar">
        <div class="inner" style="padding-bottom: 404px;">
            <div class="general_content">
            	<div class="main_content">
                    <?php echo $_smarty_tpl->getVariable('main_content')->value;?>

                </div>
                <div class="sidebar">                       
                    <?php echo $_smarty_tpl->getVariable('sidebar')->value;?>
                                              
                </div>
                <div class="clearboth"></div>
            </div>        
        </div>
    </div>
    <!--<?php echo $_smarty_tpl->getVariable('content')->value;?>
-->   		
    <!--end main content-->
  
    <footer><?php echo $_smarty_tpl->getVariable('footer')->value;?>
</footer>        
  
   <?php echo $_smarty_tpl->getVariable('footer_script')->value;?>

   </div>   
</body>
</html>