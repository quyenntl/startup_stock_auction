<?php

/**
 * @author 		kien.nguyen
 * @project		1topV2
 * @filename	category
 * @company		Peacesoft Solution.,jsc
 * @email		kiennt@peacesoft.net
 * @copyright 	2/11/2012
 */

class category extends CDT_Controller
{
    function index($do='',$id='')
    {
        $this->smarty->assign_module(
        		array(
					'header'       => 'backend/header',
					'navigation'   => 'backend/navigation',
					'footer'       => 'backend/footer',
					'content'      => array('backend/category_mod',array('do'=>$do,'id'=>$id))
                ));
                
        return $this->smarty->display('backend.html');
    }
}


/* End of file category */ 
?>