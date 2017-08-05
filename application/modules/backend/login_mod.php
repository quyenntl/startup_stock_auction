<?php
class login_mod extends Module{
    function __construct(){}
    function script(){
        $js = array(
                'header' => array(
                	'libs/jquery.js',
                ),
                'footer' => array(
                    'libs/bootstrap.js',
                    'backend/login.js'
                )   
        );
        
        $css = array(
            'backend/dashboard.css',
            'css/bootstrap.css',
            'css/bootstrap-responsive.css'
        );
        
        return array('js'=>$js,'css'=>$css);
    }
    
    function submit(){        
    }
    
    
    function draw($do=array()){ 
        $userinfo = $this->session->userdata($this->config->item('session_user_ad'));
        // Acion logout admin
        if(isset($do['do']) && $do['do'] == 'exit')
        {
            if($userinfo)
                $this->session->destroy();
                
            redirect(admin_url('login'));
        }
        //
        
        // Check timeout & exits session       
        if($userinfo && ($userinfo['timeout_login'] + $this->config->item('time_out')) > time() && $userinfo['role'] == 1)
        {
            redirect(admin_url('/'));
        }

        $this->load->skins('backend');
        $this->load->helper('form');
        
        $assign = array(
            'begin_form'  => form_open('backend/login_mod','',array('id'=>'form_login')),
            'close_form'  => form_close(),
            'base_url'    => base_url(),
            'skin_url'    => SKIN_ADMIN.'/images',
            'username'    => $userinfo['user_name'],
            'comeback_url'=> $this->input->get('url'),
        );

        $this->smarty->assign($assign);
                     
        return $this->smarty->display_module('login/index.html');
    }
}
?>