<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class browse extends CDT_Controller{
    function index(){
        $assign = array(
            'page_title'       => 'Danh sách sản phẩm - Thanh Xuân Ford - Capital Ford - '.SITE_TITLE,
            'meta_keyword'     => '',
            'meta_description' => ''
        );
        
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header',array('local' => 'product')),
                'main_content'  => 'frontend/main',
                'sidebar_left'       => 'frontend/sidebar_left',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend_car.html');
    }
    function cate_pro($category_id,$title){
        $assign = array(
            'page_title'       => 'Danh sách sản phẩm - Thanh Xuân Ford - Capital Ford - '.SITE_TITLE,
            'meta_keyword'     => '',
            'meta_description' => ''
        );      
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header',array('local' => 'product')),
                'main_content'  => array('frontend/list_product_cate',array('cate_id' => $category_id)),
                'slide_content'    => 'frontend/slider',
                'sidebar_left'       => 'frontend/sidebar_left',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend_car.html');
    }
    function detail($id,$title){
        $assign = array(
            'page_title'       => $title.' - Thanh Xuân Ford - Capital Ford - '.SITE_TITLE,
            'meta_keyword'     => '',
            'meta_description' => ''
        );      
        $this->smarty->assign_module(
            array(
                'header'        => array('frontend/header',array('local' => 'product')),
                'main_content'  => array('frontend/detail_product',array('id' => $id)),
                'sidebar_left'       => 'frontend/sidebar_left',
                'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend_car.html');
    }
}
?>