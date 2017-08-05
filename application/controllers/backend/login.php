<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class login extends CDT_Controller{
    function index($do=''){           
        $this->smarty->assign('page_title','Đăng nhập hệ thống quản trị | Login');
        $this->load->library('session');
        
        $this->smarty->assign_module(
        		array(
					'footer'       => 'backend/footer',
					'content'      => array('backend/login_mod',array('do'=>$do))
                ));                               
        $assign = array(
            'login_layout' => true
        );
        $this->smarty->assign($assign);
        return $this->smarty->display('backend.html');
    }
}
?>