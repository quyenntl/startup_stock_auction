<?php 
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class footer extends Module{
    function __construct(){}
    function script(){}
    function submit(){}
    function draw(){
        $this->load->skins('backend');        
        return $this->smarty->display_module('footer/footer.html');
    }
}   
?>