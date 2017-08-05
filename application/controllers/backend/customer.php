<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class customer extends CDT_Controller{
    function index(){
        $this->smarty->assign('page_title', 'Gatekeeper | Admin customer');        
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/customer_mod',
                    'footer' => 'backend/footer'
                ));
        return $this->smarty->display('backend.html');
    }
}
?>