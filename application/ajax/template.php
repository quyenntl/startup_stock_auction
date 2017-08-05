<?php
class template extends CDT_Controller{
    function index(){
    }
    function add(){
        //Check quyen
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }        
        $this->load->model('gk_model');
        $data   = array(
            'name'  => $this->input->post('name'),
            'description'   => $this->input->post('description'),
            'time_created'  => time()
        );
        $result_insert  = $this->gk_model->insert(FE_TEMPLATE,$data);
        if($result_insert){
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button> &nbsp;&nbsp;Success.
                </div>'));
        }else{
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>&nbsp; &nbsp; Error
                </div>'));
        }
    }
    function load_info(){
        //Check quyen
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->skins('backend');
        $this->load->model('gk_model');        
        $this->load->helper('form');
        $id             = $this->input->get('id');
        $data           = $this->gk_model->select_one(FE_TEMPLATE, '*', array('id' => $id));
        $assign         = array(
            'data'          => $data,            
            'form'          => form_open('', '',array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'info-template-form')),
            'admin_info'    => $admin_info
        );
        $this->smarty->assign($assign);
        echo $this->smarty->display_module('template/edit_info.html');
    }
    function update_info(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }        
        $this->load->model('gk_model');
        $data_update    = array(
            'name'  => $this->input->post('name'),
            'description'   => $this->input->post('description')
        );
        $condition['id']     = $this->input->post('u_id');
        if($this->gk_model->update(FE_TEMPLATE, $condition, $data_update))
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>Update success.
            </div>'));
        else
            echo json_encode(array('err' => 1, 'msg' => '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>Error, please try again.
            </div>'));
    }
    function del_temp(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }        
        $this->load->model('gk_model');
        $id = $this->input->get('id');
        
        if($this->gk_model->delete(FE_TEMPLATE,array('id'=>$id))){
            echo json_encode(array('code'=>1,'notice'=>'Success'));
        }else{
            echo json_encode(array('code'=>0,'notice'=>'Error'));
        }
    }  
}  
?>