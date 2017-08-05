<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');

class config_sys extends CDT_Controller{
    function index(){          
        $this->smarty->assign('page_title', 'Admin Config');   
           
        $this->smarty->assign_module(
        		array(
					'header' => 'backend/header',
					'navigation' => 'backend/navigation',
					'content'   => 'backend/config_mod',
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
                'content'      => array('backend/add_config_mod', array('id' => $id, 'mode' => 'form'))
            ));
        return $this->smarty->display('backend.html');
    }
}
?>