<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class report extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Admin');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/report_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }
    
	/*function form($id = '')
    {   
        $this->smarty->assign_module(
            array(
                'header'       => 'backend/header',
                'navigation'   => 'backend/navigation',
                'footer'       => 'backend/footer',
                'content'      => array('backend/add_about_mod', array('id' => $id, 'mode' => 'form'))
            ));
        return $this->smarty->display('backend.html');
    }*/
}
?>