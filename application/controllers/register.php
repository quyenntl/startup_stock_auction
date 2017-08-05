<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class register extends CDT_Controller{
    //Đăng ký học lái xe
    function index(){        
        $assign = array(
			'page_title'       => 'Đăng ký học lái xe - '.SITE_TITLE,
			'meta_keyword'     => 'Đăng ký học lái xe',
			'meta_description' => 'Trung tâm đào tạo lái xe'
        );
        $this->smarty->assign_module(
            array(
				'header'        => array('frontend/header',array('local' => 'reg')),
                //                
                'content' => 'frontend/reg_course_mod',
                //
				'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend.html');
    }
    
    //Dang ky thue xe
    function register_len_car(){
         $assign = array(
			'page_title'       => 'Đăng ký thuê xe - '.SITE_TITLE,
			'meta_keyword'     => 'Đăng ký thuê xe',
			'meta_description' => 'Trung tâm đào tạo lái xe'
        );
        $this->smarty->assign_module(
            array(
				'header'        => array('frontend/header',array('local' => 'len')),
                //
                'content' => 'frontend/reg_len_car_mod',
                //
				'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend.html');
    }
    function edit_len_car(){
        $assign = array(
			'page_title'       => 'Admin -sửa lịch xe - '.SITE_TITLE,
			'meta_keyword'     => 'Admin -sửa lịch xe',
			'meta_description' => 'Trung tâm đào tạo lái xe'
        );
        $this->smarty->assign_module(
            array(
				'header'        => array('frontend/header',array('local' => 'len')),
                //
                'content' => 'frontend/edit_len_car_mod',
                //
				'footer'        => 'frontend/footer'
            )
        );
        $this->smarty->assign($assign); 
        return $this->smarty->display('frontend.html');
    }
}
?>