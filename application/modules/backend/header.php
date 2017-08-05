<?php
class header extends Module{
    function __construct(){}
    function script(){
        $js = array(
                'header' => array(
                	'libs/jquery.js',
                ),
                'footer' => array(
                    'libs/bootstrap.js',
                    'libs/select2.js',
                    'backend/header.js'
                )   
        );        
        $css = array(
            'css/bootstrap.css',
            'css/bootstrap-responsive.css',
            'css/google.css',
            'css/select2.css',
            'backend/dashboard.css'
        );
        
        return array('js'=>$js,'css'=>$css);
    }
    function submit(){}
    function draw(){
        $this->load->skins('backend');
        $assign = array(
            'base_url'    => base_url(),
            'userinfo'    => $this->session->userdata($this->config->item('session_user_ad')),
        );       
        $this->smarty->assign($assign);
        return $this->smarty->display_module('header/header.html');
    }
}
?>