<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class news extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Quản trị tin tức');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/news_mod',
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
                'content'      => array('backend/add_new_mod', array('id' => $id, 'mode' => 'form'))
            ));
        return $this->smarty->display('backend.html');
    }
    function add_img(){
        $this->smarty->assign_module(
            array(
                'header'       => 'backend/header',
                'navigation'   => 'backend/navigation',
                'footer'       => 'backend/footer',
                'content'      => array('backend/add_img_mod')
            ));
        return $this->smarty->display('backend.html');
    }
}
?>