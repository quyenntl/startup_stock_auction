<?php /* Smarty version Smarty-3.0.7, created on 2017-07-21 22:39:24
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/config/form.html" */ ?>
<?php /*%%SmartyHeaderCode:13416561725972202cae5cc3-60888461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '300318ab92b9a06c893f5fcc5de44c0d95c74373' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/backend/config/form.html',
      1 => 1475777126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13416561725972202cae5cc3-60888461',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h6 class="title" style=" width: 78%; float: left; ">
    <i class="icon-edit"></i> <?php if ($_smarty_tpl->getVariable('id')->value){?>Edit<?php }else{ ?>Add new<?php }?>
</h6>

<a href="<?php echo site_url("admin/config_sys");?>
" class="btn btn-success" style="float: right; margin-top: 12px; margin-left: 19px;"><i class="icon-th-list icon-white"></i> List</a>
<div class="row-fluid">
	<div class="span12">
		<?php if ($_smarty_tpl->getVariable('notice')->value){?>
		<div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button><?php echo $_smarty_tpl->getVariable('notice')->value;?>
</div>
		<?php }?>
		<?php echo $_smarty_tpl->getVariable('form_edit')->value;?>

         <div class="row-fluid">
         <div class="span4">
            <div class="control-group">
			<input type="hidden" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" name="id"/>    
            <label>Name</label>
            <input type="text" required="" value="<?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
" name="name" placeholder="Name" />
            </div>              
            <div class="control-group">
            <label>Key</label> 
            <input type="text" required="" value="<?php echo $_smarty_tpl->getVariable('data')->value['key'];?>
" name="key" placeholder="Key" />
            </div>
              <div class='control-group' style="text-align: center">
    			<button class="btn btn-success guide-cat-add"><i class="icon-ok icon-white"></i> Save</button>
		    </div>
            </div>
            <!--
             <div class="control-group"> 
                Status <input type="checkbox" value="1" <?php if ($_smarty_tpl->getVariable('data')->value['status']==1){?>checked<?php }?> name="status"/>                
            </div> -->
               
	
       
           
            <div class="span4">            
            <div class="control-group">
             <label>Value</label> 
            <input type="text" required="" value="<?php echo $_smarty_tpl->getVariable('data')->value['value'];?>
" name="value" placeholder="Value" />
            </div>  
            
          
               
            </div>
            
            
            </div>
            </div>
		</form>    
    

</div>
<div class="fix"></div>