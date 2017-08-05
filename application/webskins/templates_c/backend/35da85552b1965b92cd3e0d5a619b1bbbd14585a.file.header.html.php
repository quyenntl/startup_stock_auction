<?php /* Smarty version Smarty-3.0.7, created on 2013-07-26 13:48:43
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/backend/header/header.html" */ ?>
<?php /*%%SmartyHeaderCode:105356204051f21bcb8a0338-22534977%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35da85552b1965b92cd3e0d5a619b1bbbd14585a' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/backend/header/header.html',
      1 => 1374821289,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105356204051f21bcb8a0338-22534977',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="navbar">
     <div class="navbar-inner">
        <div class="container">
          	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
          	</a>
          	<a class="brand" href="<?php echo admin_url();?>
">INCON Admin</a>
          	<div class="nav-collapse">
                <a target="_blank" href="<?php echo base_url();?>
" style="position: absolute;right: 180px;top: 6px;" data-placement="left" rel="tooltip" data-original-title="Go to front page"><button class="btn btn-info" type="button"><i class="icon-home icon-white"></i><i class="icon-share-alt icon-white"></i></button></a>
			    <ul class="nav pull-right">
				    <li class="dropdown">
					    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
					      	<span style="padding-right:10px; width:30px; height: 30px"><span class="u-ico">
                              <?php if ($_smarty_tpl->getVariable('userinfo')->value['privilege']==2){?> <font color = "red"> 
                              <?php }elseif($_smarty_tpl->getVariable('userinfo')->value['privilege']==3){?> <font color = "green"> <?php }?>
                              <?php echo $_smarty_tpl->getVariable('userinfo')->value['user_name'];?>
</font></span>
					      	<b class="caret"></b></span>
					    </a>
					    <ul class="dropdown-menu">
					      	<li><a href="<?php echo admin_url('login/index/exit');?>
">Logout</a></li>
					    </ul>
				  	</li>
				</ul>
          	</div>
        </div>
    </div>
</div>