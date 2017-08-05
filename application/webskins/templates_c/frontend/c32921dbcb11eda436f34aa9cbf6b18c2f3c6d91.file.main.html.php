<?php /* Smarty version Smarty-3.0.7, created on 2013-07-30 23:47:27
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/main/main.html" */ ?>
<?php /*%%SmartyHeaderCode:44327142051f7ee1f683d77-08065281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c32921dbcb11eda436f34aa9cbf6b18c2f3c6d91' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/main/main.html',
      1 => 1375202568,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44327142051f7ee1f683d77-08065281',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/stdpr/CDT20/system/plugins/modifier.truncate.php';
?><div class="5grid-layout">
            <div class="row">
                <div class="6u">
                    <div class="mobileUI-main-content" id="content">
                        <section>
                            <div class="post">
                                <?php  $_smarty_tpl->tpl_vars['s_hot'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s_hot']->key => $_smarty_tpl->tpl_vars['s_hot']->value){
?>
                                <p class="subtitle"><?php echo $_smarty_tpl->tpl_vars['s_hot']->value['title'];?>
</p>
                                <p><a href="<?php echo $_smarty_tpl->tpl_vars['s_hot']->value['link_detail'];?>
">
                                    <img alt="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['s_hot']->value['title'],30);?>
" src="<?php echo $_smarty_tpl->tpl_vars['s_hot']->value['img_url'];?>
">
                                </a><br>
                                    <?php echo $_smarty_tpl->tpl_vars['s_hot']->value['description'];?>

                                <p class="button-style2"><a href="<?php echo $_smarty_tpl->tpl_vars['s_hot']->value['link_detail'];?>
">Chi tiết</a></p>
                                <?php }} ?>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="3u" id="sidebar1">
                    <section>
                        <h2>Dịch vụ</h2>
                        <ul class="style2">
                        <?php  $_smarty_tpl->tpl_vars['nomal'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_news_nomal')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['nomal']->key => $_smarty_tpl->tpl_vars['nomal']->value){
?>
                            <li class="<?php if ($_smarty_tpl->tpl_vars['nomal']->value['i']==1){?>first<?php }?>">
                                <p><a href="<?php echo $_smarty_tpl->tpl_vars['nomal']->value['link_detail'];?>
">
                                 <img alt="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['nomal']->value['title'],30);?>
" src="<?php echo $_smarty_tpl->tpl_vars['nomal']->value['img_url'];?>
">
                                <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['nomal']->value['title'],100);?>
</a></p>
                            </li>
                        <?php }} ?>
                        </ul>
                    </section>
                </div>
                <div class="3u">
                    <div id="sidebar2">
                        <section>
                            <div class="sbox1">
                                <h2>Tin tức</h2>
                                <ul class="style1">
                                <?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
?>
                                    <li class="<?php if ($_smarty_tpl->tpl_vars['one']->value['j']==1){?>first<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['one']->value['link_detail'];?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['one']->value['title'],35);?>
</a></li>
                                <?php }} ?>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>