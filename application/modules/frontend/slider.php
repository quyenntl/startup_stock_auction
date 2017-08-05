<?php
class slider extends Module{
    function __construct(){
        $this->load->model('gk_model');
        $this->load->library('Image');
    }
    function script(){
        $js = array(
            'header' => array(
                 'libs/jquery.nivo.slider.js'
            ),
            'footer' => array(
               
            )   
        );        
        $css = array(
            'cars/nivo-slider.css'            
        );        
        return array('js'=>$js,'css'=>$css);
    }
    function draw(){
        $this->load->skins('frontend');
        // $list_image = $this->gk_model->select(FE_ABOUT,'id,image,description',array('active' => 1),array(),'id ASC',9);
        // if(!empty($list_image)){
        //     $arr_image  = array();
        //     foreach($list_image as $item){
        //         $item['img_url']    = $this->image->aboutImage($item['image'],array('src' => true,'height' => 250,'width' => 700));
        //         $arr_image[] = $item;
        //     }
        // }
        $assign = array(
            //'list_image'  => $arr_image,
            'skin_front' => SKIN_CAR
        );      
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('main/slider.html');
    }
}
?>