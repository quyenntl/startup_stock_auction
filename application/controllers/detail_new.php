<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class detail_new extends CDT_Controller{
    function index($id){        
        $assign = array(
            'page_title'       => 'Gốm sứ phong thuỷ - '.SITE_TITLE,
            'meta_keyword'     => 'Gốm sứ phong thuỷ',
            'meta_description' => 'Gốm sứ phong thuỷ'
        );
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header'),
                'main_content'  => array('frontend/detail_new_mod',array('id' => $id)),
                'sidebar_left'       => 'frontend/sidebar_left',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend_car.html');
    }
}
?>