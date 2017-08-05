<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class booking extends CDT_Controller{
    function index(){        
        $assign = array(
            'page_title'       => 'Thanh Xuân Ford - Capital Ford - Thủ Tục Đặt Xe '.SITE_TITLE,
            'meta_keyword'     => 'Thanh Xuân Ford - Capital Ford',
            'meta_description' => 'Thanh Xuân Ford - Capital Ford'
        );
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header',array('local' => 'booking')),
                'main_content'  => 'frontend/booking_car_mod',
                'sidebar_left'       => 'frontend/sidebar_left',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend_car.html');
    }
}
?>