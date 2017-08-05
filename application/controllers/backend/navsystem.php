<?php
class navsystem extends CDT_Controller{
    function index($do='',$id='')
    {
        $this->smarty->assign_module(
        		array(
					'header'       => 'backend/header',
					'navigation'   => 'backend/navigation',
					'footer'       => 'backend/footer',
					'content'      => array('backend/navsystem_mod',array('do'=>$do,'id'=>$id))
                ));                
        return $this->smarty->display('backend.html');
    }
}
?>