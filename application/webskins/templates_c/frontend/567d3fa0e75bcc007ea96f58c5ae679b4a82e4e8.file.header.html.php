<?php /* Smarty version Smarty-3.0.7, created on 2013-07-19 23:10:55
         compiled from "E:\xampp\htdocs\stdpr\application/webskins/templates/frontend/header/header.html" */ ?>
<?php /*%%SmartyHeaderCode:2978151e9650f6c6505-07873390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '567d3fa0e75bcc007ea96f58c5ae679b4a82e4e8' => 
    array (
      0 => 'E:\\xampp\\htdocs\\stdpr\\application/webskins/templates/frontend/header/header.html',
      1 => 1374166358,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2978151e9650f6c6505-07873390',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="header">
            	<section class="top">
                	<div class="inner">
                    	<div class="fl">
                        	<div class="block_top_menu">
                            	<ul>
                                	<li><a href="javascript:;">Số điện thoại: <b>0915.984.606</b></a></li>
                                    <li><a href="javascript:;">Email: <b>thehiep07@gmail.com</b></a></li>                                    
                                </ul>
                            </div>
                        </div>
                        <div class="fr">
                        	<div class="block_top_menu">
                            	<ul>
                                	<li><a href="skype:doanhuan12?chat"><img src="<?php echo site_url();?>
/webskins/skins/news/images/skype.png" /> Hỗ trợ 1</a></li>
                                    <li><a href="skype:doanhuong0103?chat"><img src="<?php echo site_url();?>
/webskins/skins/news/images/skype.png" /> Hỗ trợ 2</a></li>                                    
                                </ul>
                            </div>                            
                            <div class="block_social_top">
                            	<ul>
                                	<li><a href="#" class="fb">Facebook</a></li>
                                    <li><a href="#" class="tw">Twitter</a></li>                                    
                                </ul>
                            </div>
                        </div>
                        
                    	<div class="clearboth"></div>
                    </div>
                </section>
                
            	<section class="bottom">
                	<div class="inner">
                    	<div id="logo_top" style="padding-top:14px;">
                            <img src="<?php echo site_url();?>
/webskins/skins/news/images/logo.png" style="float:left;" />
                            <span style="display: block;margin-top:27px;float:left;">
                            <a href="<?php echo site_url();?>
">
                                <span style="color:#F24024;font-size:35px;font-weight:bold;font-style:italic;">Du học </span>
                                <span style="color:#000;font-size:40px;font-weight:bold;">Nhật Bản</span>
                            </a>
                            </span>
                        </div>                        
                        <div class="block_today_date">
                        	<div class="num"><p id="num_top" /></div>
                            <div class="other">
                            	<p class="month_year"><span id="month_top"></span>, <span id="year_top"></span></p>
                                <p id="day_top" class="day" />
                            </div>
                        </div>                        
                        <div class="fr" style="margin-top:50px;">                            
                            <div class="block_search_top">
                            	<form action="http://google.com/search" />
                                	<div class="field"><input type="text" name="q" class="w_def_text" title="Từ khóa" /></div>
                                    <input type="submit" class="button" value="Search" />                                    
                                    <div class="clearboth"></div>
                                </form>
                            </div>
                        </div>                        
                        <div class="clearboth"></div>
                    </div>
                </section>
                <section class="section_main_menu">
                	<div class="inner">
                    	<nav class="main_menu">
                        	<ul>
								<li <?php if ($_smarty_tpl->getVariable('local')->value=='home'){?>class="current_page_item"<?php }?>><a href="<?php echo site_url();?>
">Trang chủ</a></li>                                
							  	<li class="big_dropdown <?php if ($_smarty_tpl->getVariable('local')->value=='about'){?>current_page_item<?php }?>" data-content="business"><a href="<?php echo about_url();?>
">Giới thiệu</a></li>
                                <li class="big_dropdown" ><a href="javascript:;">Lao động</a></li>
							  	<li class="big_dropdown <?php if ($_smarty_tpl->getVariable('local')->value=='new'){?>current_page_item<?php }?>" data-content="technology"><a href="<?php echo site_url('tin-tuc');?>
">Tin tức</a>
                                    <ul>
                                    	<li><a href="<?php echo site_url('c/23/thong-tin-chung');?>
">Thông tin chung</a></li>
                                        <li><a href="<?php echo site_url('c/24/thong-tin-chung');?>
">Kinh nghiệm du học</a></li>
                                        <li><a href="<?php echo site_url('c/27/thong-tin-chung');?>
">Đất nước Nhật Bản</a></li>
                                    </ul>  
                                </li>
                                <li class="big_dropdown <?php if ($_smarty_tpl->getVariable('local')->value=='new-28'){?>current_page_item<?php }?>" data-content="education"><a href="<?php echo site_url('c/28/du-hoc-uc');?>
">Du học Úc</a></li>
							  	<li class="big_dropdown <?php if ($_smarty_tpl->getVariable('local')->value=='albulm'){?>current_page_item<?php }?>" data-content="education"><a href="<?php echo site_url('thu-vien-anh');?>
">Thư viện ảnh</a></li>                                
							  	<li class="<?php if ($_smarty_tpl->getVariable('local')->value=='contact'){?>current_page_item<?php }?>"><a href="<?php echo contact_url();?>
">Liên hệ</a></li>	  		  		  		
						  </ul>
						</nav>
                    </div>
                </section>                           
</div>