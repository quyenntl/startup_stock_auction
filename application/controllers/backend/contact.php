<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class contact extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Thông tin liên hệ của khách hàng');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/contact_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }  
}
?>