<?php /* Smarty version Smarty-3.0.7, created on 2017-07-19 06:31:46
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/nav.html" */ ?>
<?php /*%%SmartyHeaderCode:576697010596e9a6232ac95-74714832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd78d7b3084ea961682d16b977fba9a46c06cf2c5' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/nav.html',
      1 => 1500420704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '576697010596e9a6232ac95-74714832',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<nav class="navbar navbar-default navbar-fixed-top" >
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <!--<a class="navbar-brand" href="<?php echo base_url();?>
">Home</a> -->
			<img src="<?php echo site_url();?>
webskins/skins/frontend/images/artificial-intelligence.jpg" width="60" >
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-default" >
            <ul class="nav navbar-nav">
                <li class=""><a href="<?php echo base_url();?>
">Bảng giá</a></li>
                <li class=""><a href="<?php echo bid_url();?>
">Đặt giá</a></li>                
            </ul>
			<ul class="nav navbar-nav">
			<li><a href="javascript:;" style="font-size:16px;font-weight:bold;"> Đầu tư cùng Nguyễn Đình Nam - Startup AI - Công nghệ trí thông minh nhân tạo</a></li>
			</ul>
            <?php if ($_smarty_tpl->getVariable('usr')->value==false){?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo login_url();?>
">Login</a></li>
            </ul>
            <?php }else{ ?>
            <ul class="nav navbar-nav navbar-right showhd">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_smarty_tpl->getVariable('usr')->value['ndt_id'];?>
 <span class="caret"></span></a>
                    <ul class="dropdown-menu" id="show">
                        <li><a href="javascript:;" class="logout">Log out</a></li>
                    </ul>
                </li>
            </ul>
            <?php }?>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>