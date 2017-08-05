<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class admin_staff extends CDT_Controller{
    function index(){}
    function add(){
        //Check quyen
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));die;
        }
        $this->load->model('gk_model');
        $array_type = array('TV'=>'Cán bộ tư vấn','GV'=>'Giáo viên');
        $data   = array(
            'FULL_NAME' => $this->input->post('name'),
            'TELEPHONE' => $this->input->post('phone'),
            'ADDRESS'   => $this->input->post('address'),
            'EMAIL'     => $this->input->post('email'),
            'TYPE_ID'   => $this->input->post('type'),
            'DESCRIPTION'   => $array_type[$this->input->post('type')]
        );
        if($this->gk_model->insert(FE_TEACHER,$data)){
            echo json_encode(array('code'=>1,'msg'=>'Thành công'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Có lỗi trong quá trình thực hiện'));
        }        
    }
    function load_info(){
        //Check quyen
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));die;
        }
        $this->load->model('gk_model');
        $id     = $this->input->get('id');
        $info   = $this->gk_model->select_one(FE_TEACHER,'*',array('id'=>$id));
        if(!empty($info)){
            $option_staff   = array('TV'=>'Cán bộ tư vấn','GV'=>'Giáo viên');
            $this->load->skins('backend');
            $this->load->helper('form');            
            $assign         = array(
                'array_get'          => $info,                
                'form'          => form_open('', '',array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'update-staff-form')),
                'option_staff'  => $this->input->array_to_option($option_staff,$info['TYPE_ID'])
            );
            $this->smarty->assign($assign);
            echo $this->smarty->display_module('staff/modal_info.html');
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Không tồn tại thông tin'));
        }
    }
    function update_info(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->model('gk_model');
        $array_type = array('TV'=>'Cán bộ tư vấn','GV'=>'Giáo viên');
        $id = $this->input->post("u_id");
        $data   = array(
            'FULL_NAME' => $this->input->post('name'),
            'TELEPHONE' => $this->input->post('phone'),
            'ADDRESS'   => $this->input->post('address'),
            'EMAIL'     => $this->input->post('email'),
            'TYPE_ID'   => $this->input->post('type'),
            'DESCRIPTION'   => $array_type[$this->input->post('type')]
        );        
        if($this->gk_model->update(FE_TEACHER, array('id'=>$id), $data))
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>Thành công.
            </div>'));
        else
            echo json_encode(array('err' => 1, 'msg' => '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>Có lỗi trong quá trình thực hiện
            </div>'));
    }
}
?>