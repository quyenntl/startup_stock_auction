<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class list_new extends CDT_Controller{
    function index(){
        $assign = array(
			'page_title'       => 'Danh sách tin tức - '.SITE_TITLE,
			'meta_keyword'     => '',
			'meta_description' => ''
        );
        
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header',array('local' => 'home')),
                'main_content'  => array('frontend/list_new_mod'),
                'slide_content'    => 'frontend/slider',
                'sidebar_left'       => 'frontend/sidebar_left',
                'sidebar_right'       => 'frontend/sidebar_right',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend.html');
    }
}
?>