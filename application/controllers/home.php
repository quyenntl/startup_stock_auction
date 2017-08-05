<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class home extends CDT_Controller{
    function index(){     
        $assign = array(
			'page_title'       => 'Trang Chủ'.SITE_TITLE,
			'meta_keyword'     => '',
			'meta_description' => '',
			'meta_refresh' => '<meta http-equiv="refresh" content="60">'
        );
        $this->smarty->assign_module(
            array(
				'header'        => 'frontend/header',
                'menu'    => 'frontend/nav_mod',
                'main_content'  => 'frontend/main',
				
                //'sidebar_left'       => 'frontend/sidebar_left',
				//'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
		
        return $this->smarty->display('frontend.html');
    }
}
?>