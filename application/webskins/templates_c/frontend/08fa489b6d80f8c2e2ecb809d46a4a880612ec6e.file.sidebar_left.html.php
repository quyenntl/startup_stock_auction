<?php /* Smarty version Smarty-3.0.7, created on 2013-10-24 15:17:48
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/sidebar_left.html" */ ?>
<?php /*%%SmartyHeaderCode:5191369585268d7acd9f450-69934424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08fa489b6d80f8c2e2ecb809d46a4a880612ec6e' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/sidebar_left.html',
      1 => 1382602646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5191369585268d7acd9f450-69934424',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
?><div id="sidebar1">
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
        </div>