<?php /* Smarty version Smarty-3.0.7, created on 2013-07-29 23:16:58
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/news/detail.html" */ ?>
<?php /*%%SmartyHeaderCode:141150234051f6957aa0bc86-43075287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60e9e75f81f2497aa891619219bd6ecbb9822bdf' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/stdpr/application/webskins/templates/frontend/news/detail.html',
      1 => 1375114596,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141150234051f6957aa0bc86-43075287',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="post">
    <p class="subtitle"><?php echo $_smarty_tpl->getVariable('info')->value['title'];?>
</p>
    <?php echo $_smarty_tpl->getVariable('info')->value['content'];?>

</div>