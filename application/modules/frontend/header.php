<?php
class header extends Module{    
    function __construct(){
        $this->load->model('gk_model');
    }

    function script(){        
        $js = array(
            'header' => array(
                'libs/jquery-1.9.0.min.js'
                
            ),
            'footer' => array(  
                'frontend/collapse.js',              
                'frontend/bootstrap.min.js'
            )   
        );
        $css = array(
            'frontend/styles/bootstrap.min.css',
            'frontend/styles/navbar-fixed-top.css'
        );        
        return array('js'=>$js,'css'=>$css);
    }
    
    
    function draw(){        
        
        $assign = array(
            //'list_category'  => $list_n,
        );
        $this->smarty->assign($assign);
        $this->load->skins('frontend');
        return $this->smarty->display_module('header1/index.html');
    }
}
?>