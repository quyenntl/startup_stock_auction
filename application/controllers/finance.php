<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class finance extends CDT_Controller{
    function index(){        
        $assign = array(
			'page_title'       => 'Trang đặt lệnh'.SITE_TITLE,
			'meta_keyword'     => '',
			'meta_description' => ''
        );
        $this->smarty->assign_module(
            array(
                'header'        => 'frontend/header',
				'menu'    => 'frontend/nav_mod',
                'main_content'  => 'frontend/support_finance_mod',
				//'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend.html');
    }
}
?>