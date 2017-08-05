<?php /* Smarty version Smarty-3.0.7, created on 2017-03-03 15:16:20
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/news/detail.html" */ ?>
<?php /*%%SmartyHeaderCode:149936493258b92654d72a65-66898578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5815edc50cf6df1ae694e4107b040ff24734791f' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/news/detail.html',
      1 => 1488528979,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149936493258b92654d72a65-66898578',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope">
        <?php  $_smarty_tpl->tpl_vars['detail'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('info_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['detail']->key => $_smarty_tpl->tpl_vars['detail']->value){
?>
        <h1 class="entry-title"><?php echo $_smarty_tpl->tpl_vars['detail']->value['title'];?>
</h1>
        <div class="entry-content">
            <?php echo $_smarty_tpl->tpl_vars['detail']->value['content'];?>

       </div>
        <?php }} ?>
        <div id="related-post">
            <h4 class="heading">Tin Liên Quan</h4>
            <ul>         
            <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('other_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value){
?>   
                <li>
                    <a href="<?php echo detail_new($_smarty_tpl->tpl_vars['news']->value['id'],$_smarty_tpl->tpl_vars['news']->value['title']);?>
" title="Đánh giá xe Ford Focus 2016 từ các chuyên gia"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a>
                </li>
            <?php }} ?>
            </ul>
        </div>
</main>