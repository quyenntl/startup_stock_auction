<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class car_type extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Quản trị loại xe');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/car_type_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }
    function form($id = '')
    {   
        $this->smarty->assign_module(
            array(
                'header'       => 'backend/header',
                'navigation'   => 'backend/navigation',
                'footer'       => 'backend/footer',
                'content'      => array('backend/add_car_type_mod', array('car_class' => $id, 'mode' => 'form'))
            ));
        return $this->smarty->display('backend.html');
    }
}
?>