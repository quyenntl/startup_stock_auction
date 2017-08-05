<?php
/**
 * User controller
 */
if ( ! defined('IN_CDT')) exit('No direct script access allowed');  
class user extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Admin user');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/user_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }    
}
?>