<?php /* Smarty version Smarty-3.0.7, created on 2013-07-08 22:38:54
         compiled from "E:\xampp\htdocs\stdpr\application/webskins/templates/frontend/news/help.html" */ ?>
<?php /*%%SmartyHeaderCode:3076951dadd0ef35e69-30175670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '566311c71acc02a33c3ca2ffda9c868b5808b336' => 
    array (
      0 => 'E:\\xampp\\htdocs\\stdpr\\application/webskins/templates/frontend/news/help.html',
      1 => 1370767976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3076951dadd0ef35e69-30175670',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_imagesize')) include 'E:\xampp\htdocs\stdpr\CDT20\system/plugins/function.imagesize.php';
?><literal>
<script type="text/javascript">
 $(document).ready( function(){	
		var buttons = { previous:$('#jslidernews2 .button-previous') ,
						next:$('#jslidernews2 .button-next') };			 
		$('#jslidernews2').lofJSidernews( { interval:5000,
											 	easing:'easeInOutQuad',
												duration:1200,
												auto:true,
												mainWidth:684,
												mainHeight:450,                                                
												navigatorHeight		: 90,
												navigatorWidth		: 310,
												maxItemDisplay:5,
												buttons:buttons } );				
	});

</script>
</literal>
<style>	
	ul.lof-main-wapper li {
		position:relative;	
	}
</style>

<div class="block_breadcrumbs">
    <ul>
        <?php echo $_smarty_tpl->getVariable('path_way')->value;?>
          
    </ul>
</div>

<div class="wrapper">  
    <div class="container">    
    <div id="jslidernews2" class="lof-slidecontent" style="width:980px; height:450px;">
	   <div class="preload"><div></div></div>            
            <div  class="button-previous">Previous</div>                   
    		 <!-- MAIN CONTENT --> 
              <div class="main-slider-content" style="width:684px; height:450px;">
                <ul class="sliders-wrap-inner">
                    <?php  $_smarty_tpl->tpl_vars['arr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_img')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['arr']->key => $_smarty_tpl->tpl_vars['arr']->value){
?>
                    <li>                           
                          <img src=<?php echo $_smarty_tpl->tpl_vars['arr']->value['img_link'];?>
 height=450" width="684" />           
                          <div class="slider-description">                           
                                <p><h3><?php echo $_smarty_tpl->tpl_vars['arr']->value['description'];?>
</h3></p>                   
                           
                         </div>
                    </li>   
                    <?php }} ?>             
                  </ul>  	
            </div>
 		   <!-- END MAIN CONTENT --> 
           <!-- NAVIGATOR -->
           	<div class="navigator-content">
                  <div class="navigator-wrapper">
                        <ul class="navigator-wrap-inner">
                        <?php  $_smarty_tpl->tpl_vars['arr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list_img')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['arr']->key => $_smarty_tpl->tpl_vars['arr']->value){
?> 
                          <li>
                                <div>
                                    <?php echo smarty_function_imagesize(array('src'=>$_smarty_tpl->tpl_vars['arr']->value['image'],'width'=>60,'height'=>60,'source'=>'img_about','default'=>'default_60_60.png'),$_smarty_tpl);?>
                                  
                                    <span style="font-size:17px;margin-top:12px;display:block;"><?php echo $_smarty_tpl->tpl_vars['arr']->value['description'];?>
</span>
                                </div>    
                            </li>
                        <?php }} ?>
                        </ul>
                  </div>
   
             </div> 
          <!----------------- END OF NAVIGATOR --------------------->
          <div class="button-next">Next</div>
 
 		 <!-- BUTTON PLAY-STOP -->
          <div class="button-control"><span></span></div>
          <!-- END OF BUTTON PLAY-STOP -->           
 </div> 
    
</div>
</div>