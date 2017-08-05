<?php
class nav_mod extends Module{
    function __construct(){
        
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(    
                'frontend/account.js'           
            )   
        );        
                
        return array('js'=>$js,'css'=>$css);
    }
    function draw($params = array()){
        //check dang nhap
        $userinfo = $this->users_lib->userInfo();

        $this->load->skins('frontend');
        $assign = array(
            'usr'  => $userinfo
        );
        $this->smarty->assign($assign);
        return $this->smarty->display_module('main/nav.html');
    }
}
?>