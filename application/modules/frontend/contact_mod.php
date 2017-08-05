<?php
class contact_mod extends Module{
    function __construct(){
        $this->load->library('Image');
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(
                'frontend/contact.js',       
            )   
        );        
                
        return array('js'=>$js,'css'=>$css);
    }
    function draw($params = array()){
        $this->load->skins('frontend');
        $assign = array(
            //'list'  => $arr_product
        );
        $this->smarty->assign($assign);
        return $this->smarty->display_module('news/contact.html');
    }
}
?>