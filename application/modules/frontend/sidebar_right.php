<?php
class sidebar_right extends Module{
    function __construct(){
        $this->load->model('gk_model');
        $this->load->library('Image');
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(
                'libs/jquery.easing.1.3.js',
                'libs/jquery.timers.1.2.js',
                'libs/jquery.galleryview-2.1.1.js',
                'libs/jquery.galleryview.setup.js',
            )   
        );        
        $css = array(
            //'frontend/styles/layout.css'            
        );        
        return array('js'=>$js,'css'=>$css);
    }
    function draw(){
        $this->load->skins('frontend');

        $info       = $this->gk_model->select(FE_PRODUCTS,'id,name,image,price',array('hot' => 1),array(),'time_created DESC',3);  
        if($info){
            $arr_info = array();
            foreach($info as $item){
                $item['img_url']    = $this->image->productImage($item['image'],array('src' => true,'height' => 70,'width' => 70));
                $arr_info[] = $item;
            }
        }

        $assign = array(
            'list_hot'  => $arr_info,
            'skin_front' => SKIN_GOMSU
        );      
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('main/sidebar_right.html');
    }
}
?>