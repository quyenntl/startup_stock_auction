<?php
/**
 * User controller
 */
if ( ! defined('IN_CDT')) exit('No direct script access allowed');  
class template extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Gatekeeper | Admin Template');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/template_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }
}
?>