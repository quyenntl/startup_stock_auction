<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class news extends CDT_Controller{
    function index(){
        
    }
    function update(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));
            die;        
        }
        $this->load->model('gk_model');
        
        $id     = $this->input->get('id');
        $value  = $this->input->get('value');
        if($id && $value){
            if($this->gk_model->update(FE_NEWS,array('id'=>$id),array('ordering'=>$value))){
                echo 'Ok';
            }else{
                echo 'Error';
            }            
        }else{
            echo 'Có lỗi trong quá trình thực hiện';
        }        
    }
    function update_img(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));
            die;        
        }
        $this->load->model('gk_model');
        
        $id     = $this->input->get('id');
        $value  = $this->input->get('value');
        if($id && $value){
            if($this->gk_model->update(FE_ABOUT,array('id'=>$id),array('ordering'=>$value))){
                echo 'Ok';
            }else{
                echo 'Error';
            }            
        }else{
            echo 'Có lỗi trong quá trình thực hiện';
        }
    }
}
?>