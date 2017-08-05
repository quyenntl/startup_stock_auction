<?php
class protect_mod extends Module{
    function __construct(){
        
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(               
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
        return $this->smarty->display_module('news/protect.html');
    }
}
?>