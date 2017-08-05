<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class car_calendar extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Quản trị lịch xe');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/car_calendar_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }
}
?>