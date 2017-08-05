<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');  
class reg_car extends CDT_Controller{
   function index(){
        $this->smarty->assign('page_title', 'Ngochaco | Quản lý đăng ký thuê xe');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/reg_car_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }    
}
?>