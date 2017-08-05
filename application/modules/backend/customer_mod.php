<?php
/**
 * Admin customer mod
 */ 
class customer_mod extends Module{
    function __construct(){
        $this->load->model('gk_model');
    }
    function script(){
        $js = array(
                'header' => array(
                ),
                'footer' => array(
                	'libs/jquery.tablesorter.min.js',
                    'libs/jquery.livequery.js',                    
                    'libs/bootbox.min.js',
                    'libs/bootstrap-datepicker.js',
                    'libs/jquery.validate.js',
                    'backend/customer.js'
                )   
        );        
        $css = array(            
            'css/datepicker.css',
        );
        return array('js'=>$js,'css'=>$css);
    }
    function submit(){}
    function draw(){
        $this->load->skins('backend');
        return $this->smarty->display_module('customer/index.html');
    }
}
?>