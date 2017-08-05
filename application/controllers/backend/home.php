<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class home extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Trang chủ admin | ADMIN');
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					//'content'   => 'backend/main',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }
}
?>