<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class staff extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Quản trị cán bộ - giáo viên');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/staff_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }  
}
?>