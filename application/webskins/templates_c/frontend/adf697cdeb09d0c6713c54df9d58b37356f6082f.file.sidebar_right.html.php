<?php /* Smarty version Smarty-3.0.7, created on 2017-02-27 14:17:41
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/sidebar_right.html" */ ?>
<?php /*%%SmartyHeaderCode:78094425858b3d295dc9212-24843088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adf697cdeb09d0c6713c54df9d58b37356f6082f' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/sidebar_right.html',
      1 => 1488179588,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78094425858b3d295dc9212-24843088',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_money_format')) include '/home/mocmien/domains/mocmien.net/CDT20/system/plugins/modifier.money_format.php';
?><div id="sidebar2">
            <div>
                <h3 align="center">Hỗ trợ</h3>
                <ul class="style2">
                    <li class="first">
                        <a mce_href="ymsgr:sendim?demo" href="ymsgr:sendim?demo">
                            <img src="http://opi.yahoo.com/online?u=demo&;m=g&;t=2" border=0 height=”25″ width=”110″ >
                        </a>
                        <h4>MR Tâm<br/> Hotline : 0902270313<br/>Email : abc@gmail.com</h4>
                    </li>
                    <li>
                        <h3>Sản phẩm nổi bật</h3>
                        <div class="">
                            <ul class="small-product">
                            <?php  $_smarty_tpl->tpl_vars['hot'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_hot')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['hot']->key => $_smarty_tpl->tpl_vars['hot']->value){
?>
                                <li>
                                    <a href="<?php echo detail_product($_smarty_tpl->tpl_vars['hot']->value['id'],$_smarty_tpl->tpl_vars['hot']->value['name']);?>
">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['hot']->value['img_url'];?>
">
                                    </a>
                                    <p><a href="<?php echo detail_product($_smarty_tpl->tpl_vars['hot']->value['id'],$_smarty_tpl->tpl_vars['hot']->value['name']);?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['hot']->value['name'],18);?>
</a><br/>
                                        Giá : <?php echo smarty_modifier_money_format($_smarty_tpl->tpl_vars['hot']->value['price']);?>
 VNĐ
                                    </p>
                                </li>
                            <?php }} ?>  
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h3>Tamnguyen Consult,jsc</h3>
                        <p>
                            <img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/images/logo.png" width="230">
                        </p>
                    </li>
                </ul>
            </div>
        </div>