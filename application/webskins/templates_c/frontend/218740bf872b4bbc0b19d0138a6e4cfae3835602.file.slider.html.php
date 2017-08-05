<?php /* Smarty version Smarty-3.0.7, created on 2017-03-01 13:45:25
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/slider.html" */ ?>
<?php /*%%SmartyHeaderCode:123771847058b66e05a6f205-50325999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '218740bf872b4bbc0b19d0138a6e4cfae3835602' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/main/slider.html',
      1 => 1488350723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123771847058b66e05a6f205-50325999',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="metaslider_container">
    <div class="slider-wrapper">
        <div class="ribbon"></div>
        <div id="slider" class="nivoSlider">
            <img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/image_fe/slider1.jpg" alt="" class="" width="1000" height="347">
            <img src="<?php echo $_smarty_tpl->getVariable('skin_front')->value;?>
/image_fe/slider2.jpg" alt="" class="" width="1000" height="347">
        </div>
    </div>
</div>

    <script type="text/javascript">
        $('#slider').nivoSlider({
            boxCols:7,
            boxRows:5,
            pauseTime:2000,
            effect:"random",
            controlNav:false,
            directionNav:true,
            pauseOnHover:true,
            animSpeed:600,
            prevText:"",
            nextText:"",
            slices:15,
        }
        );
    </script>