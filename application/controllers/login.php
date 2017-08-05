<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class login extends CDT_Controller{
    //Đăng ký học lái xe
    function index(){        
        $assign = array(
			'page_title'       => 'Đăng nhập'.SITE_TITLE,
			'meta_keyword'     => 'Đăng nhập',
			'meta_description' => ''
        );
        $this->smarty->assign_module(
            array(
                'header'        => 'frontend/header',
				'menu'    => 'frontend/nav_mod',
                'main_content'  => 'frontend/login_mod',
				//'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend.html');
    }
}
?>