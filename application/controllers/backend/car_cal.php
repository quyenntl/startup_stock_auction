<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class car_cal extends CDT_Controller{
    function index(){
        redirect(site_url('register/edit_len_car'));
    }
}
?>