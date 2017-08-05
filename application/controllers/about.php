<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class about extends CDT_Controller{
    function index(){        
        $assign = array(
            'page_title'       => 'Thanh Xuân Ford - Capital Ford - Giới Thiệu'.SITE_TITLE,
            'meta_keyword'     => 'Thanh Xuân Ford - Capital Ford',
            'meta_description' => 'Thanh Xuân Ford - Capital Ford'
        );
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header',array('local' => 'about')),
                'main_content'  => 'frontend/about_mod',
                'sidebar_left'       => 'frontend/sidebar_left',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend_car.html');
    }
    /**
     * Liên hệ
     */
    function contact(){
        $assign = array(
            'page_title'       => 'Thanh Xuân Ford - Capital Ford - Liên Hệ'.SITE_TITLE,
            'meta_keyword'     => 'Thanh Xuân Ford - Capital Ford',
            'meta_description' => 'Thanh Xuân Ford - Capital Ford'
        );
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header',array('local' => 'contact')),
                'main_content'  => 'frontend/contact_mod',
                'sidebar_left'       => 'frontend/sidebar_left',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend_car.html');
    }
}
?>