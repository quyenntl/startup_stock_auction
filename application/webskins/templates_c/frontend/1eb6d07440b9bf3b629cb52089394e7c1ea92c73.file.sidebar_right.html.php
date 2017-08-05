<?php /* Smarty version Smarty-3.0.7, created on 2013-10-25 09:36:22
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/sidebar_right.html" */ ?>
<?php /*%%SmartyHeaderCode:10926283955269d9262d5936-70276115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1eb6d07440b9bf3b629cb52089394e7c1ea92c73' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/gomsu/application/webskins/templates/frontend/main/sidebar_right.html',
      1 => 1382668576,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10926283955269d9262d5936-70276115',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_money_format')) include '/Applications/XAMPP/xamppfiles/htdocs/gomsu/CDT20/system/plugins/modifier.money_format.php';
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