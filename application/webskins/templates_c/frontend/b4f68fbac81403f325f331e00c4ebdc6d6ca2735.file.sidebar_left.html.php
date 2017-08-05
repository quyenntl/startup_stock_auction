<?php /* Smarty version Smarty-3.0.7, created on 2017-03-05 13:07:23
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/sidebar_left.html" */ ?>
<?php /*%%SmartyHeaderCode:78115687858bbab1b323d98-01384114%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4f68fbac81403f325f331e00c4ebdc6d6ca2735' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/sidebar_left.html',
      1 => 1488694039,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78115687858bbab1b323d98-01384114',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.truncate.php';
?><section id="nav_menu-2" class="widget widget_nav_menu">
            <div class="widget-wrap">
                <h4 class="widget-title widgettitle">Danh mục sản phẩm</h4>
                <div class="menu-danh-muc-san-pham-container">
                    <ul id="menu-danh-muc-san-pham" class="menu">
                    <?php  $_smarty_tpl->tpl_vars['cate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cate']->key => $_smarty_tpl->tpl_vars['cate']->value){
?>
                        <li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="<?php echo $_smarty_tpl->tpl_vars['cate']->value['link_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['cate']->value['name'];?>
</a></li>
                    <?php }} ?>
                    </ul>
                </div>
            </div>
        </section>
        <section id="support-online-2" class="widget support-online-widget">
            <div class="widget-wrap">
                <h4 class="widget-title widgettitle">Hỗ trợ trực tuyến</h4>
                <div class="wrap-support">
                    <div id="supporter-info">
                        <div id="support-1" class="supporter">
                            <div class="info">
                                <a onclick="goog_report_conversion('tel:0945488866')" class="phone" href="#">0945 488 866</a>
                            </div>
                            <div class="online">
                            </div>
                        </div>
                        <div id="support-1" class="supporter">
                            <div class="info">
                                <a onclick="goog_report_conversion('tel:0911777866')" class="phone" href="#">0911 777 866</a>
                            </div>
                            <div class="online">
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </section>
        <section id="featured-post-2" class="widget featured-content featuredpost">
            <div class="widget-wrap">
                <h4 class="widget-title widgettitle">Tin tức</h4>
                <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value){
?>
                <article class="tin-tuc type-tin-tuc status-publish format-standard has-post-thumbnail danhmuc-tin-tuc entry">
                    <a href="<?php echo detail_new($_smarty_tpl->tpl_vars['news']->value['id'],$_smarty_tpl->tpl_vars['news']->value['title']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
" class="alignleft">
                        <img src="<?php echo store_data_url();?>
news/<?php echo $_smarty_tpl->tpl_vars['news']->value['image'];?>
" class="entry-image attachment-tin-tuc" alt="ford vietnam" width="200" height="200">
                    </a>
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php echo detail_new($_smarty_tpl->tpl_vars['news']->value['id'],$_smarty_tpl->tpl_vars['news']->value['title']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a>
                        </h2>
                    </header>
                </article>
                <?php }} ?>
            </div>
        </section>
        <!--section id="facebook-like-widget-2" class="widget facebook_like">
            <div class="widget-wrap">
                <h4 class="widget-title widgettitle">Like Facebook</h4>
                <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <div class="fb-like-box fb_iframe_widget" data-href="https://www.facebook.com/kidspacehn/" data-height="239" data-width="233" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" allowtransparency="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=&amp;color_scheme=light&amp;container_width=233&amp;header=false&amp;height=239&amp;href=https%3A%2F%2Fwww.facebook.com%2FIQFact%2F&amp;locale=vi_VN&amp;sdk=joey&amp;show_faces=true&amp;stream=false&amp;width=233">
                    <span style="vertical-align: bottom; width: 233px; height: 230px;">
                        Đặt tại đây
                    </span>
                </div>
            </div>
        </section-->


<!--div id="sidebar1">
            <div id="box1">
                <h4 align="center">DANH MỤC SẢN PHẨM</h4>
                <ul class="style1">
                <?php  $_smarty_tpl->tpl_vars['cate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cate']->key => $_smarty_tpl->tpl_vars['cate']->value){
?>
                    <li class="<?php if ($_smarty_tpl->tpl_vars['cate']->value['i']==0){?>first<?php }else{ ?> <?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['cate']->value['link_detail'];?>
"><?php echo $_smarty_tpl->tpl_vars['cate']->value['name'];?>
 ></a></li>
                <?php }} ?>
                </ul>
            </div>
            <div id="box2">
                <h4 align="center">CHÚNG TÔI INTERNET</h4>
                <ul class="style1">
                    <li class="first">
                        <a href="javascript:;"><img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/images/fb.png"></a>
                        <a href="javascript:;"><img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/images/google.png"></a>
                        <a href="javascript:;"><img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/images/Twitter.png"></a>
                    </li>
                </ul>
            </div>
            <div id="box2">
                <h4 align="center">HOẠT ĐỘNG</h4>
                <ul class="style1">
                <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value){
?>
                    <li class="<?php if ($_smarty_tpl->tpl_vars['news']->value['i']==0){?>first<?php }else{ ?> <?php }?>"><a href="<?php echo detail_new($_smarty_tpl->tpl_vars['news']->value['id'],$_smarty_tpl->tpl_vars['news']->value['title']);?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['news']->value['title'],30);?>
</a></li>
                <?php }} ?>
                </ul>
            </div>
            <div id="box2">
                <h4 align="center">TIN VIDEO</h4>
                <ul class="style1" style="margin-left:5px;">
                    <li class="first">
                        <iframe width="200" height="150" src="http://www.youtube.com/embed/MGYJ3cVynY4" frameborder="0" allowfullscreen></iframe>
                    </li>
                </ul>
            </div>
            <div id="box2">
                <h4 align="center">THÔNG SỐ</h4>
                <ul class="style1" style="margin-left:5px;">
                    <li class="first">
                        <li>Online : 100</li>
                        <li>Lượt xem : 467</li>
                    </li>
                </ul>
            </div>
        </div-->