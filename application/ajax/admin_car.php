<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class admin_car extends CDT_Controller{
    function index(){}
    function add(){
        //Check quyen
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));die;
        }
        $this->load->model('gk_model');
        $car_id = $this->input->post('car_id');
        //check xem ma xe da ton tai chua
        $check_info = $this->gk_model->select_one(FE_CAR,'id',array('CAR_ID'=>$car_id));
        if(!empty($check_info)){
            echo json_encode(array('code'=>0,'msg'=>'Đã tồn tại thông tin xe'));die;
        }        
        $data   = array(
            'CAR_ID' => $car_id,
            'CAR_CLASS' => $this->input->post('car_type'),
            'CAR_STATUS' => 'A',
            'ORDERS'    => $this->input->post('ordering'),            
            'CAR_INFO'     => $this->input->post('car_info'),
            'CAR_REG_ID'   => $this->input->post('car_reg_id'),
            'DESCRIPTION'   => $this->input->post('description'),
            'TEACHER_ID'    => $this->input->post('teacher')
        );
        if($this->gk_model->insert(FE_CAR,$data)){
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
        $id     = $this->input->get('car_id');
        $info   = $this->gk_model->select_one(FE_CAR,'*',array('car_id'=>$id));
        $array_car_type = $this->gk_model->select(FE_CAR_INFO,'*',array(),array(),'CAR_CLASS asc');
        if(!empty($array_car_type)){
            $new_array_car_type = array();
            foreach($array_car_type as $one){
                $new_array_car_type[$one['CAR_CLASS']]    = $one['DESCRIPTION']; 
            }
        }
        if(!empty($info)){            
            $this->load->skins('backend');
            $this->load->helper('form');            
            $assign         = array(
                'info'          => $info,                
                'form_begins'          => form_open('', '',array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'update-car-form')),
                'option_car'  => $this->input->array_to_option($new_array_car_type,$info['CAR_CLASS'])
            );
            $this->smarty->assign($assign);
            echo $this->smarty->display_module('car/modal_info.html');
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
        $car_id = $this->input->post("car_id");
        //Kiem tra xem ma xe co ton tai hay khong
        $check_info = $this->gk_model->select_one(FE_CAR,'id',array('CAR_ID'=>$car_id));
        if(!empty($check_info)){
            $data   = array(
                'CAR_CLASS' => $this->input->post('car_type'),                
                'ORDERS'    => $this->input->post('ordering'),            
                'CAR_INFO'     => $this->input->post('car_info'),
                'CAR_REG_ID'   => $this->input->post('car_reg_id'),
                'DESCRIPTION'   => $this->input->post('description'),
                'TEACHER_ID'    => $this->input->post('teacher')
            );            
            if($this->gk_model->update(FE_CAR, array('car_id'=>$car_id), $data))
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>Thành công.
                </div>'));
            else
                echo json_encode(array('err' => 1, 'msg' => '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>Có lỗi trong quá trình thực hiện
                </div>'));
            
        }else{
            echo json_encode(array('err' => 1, 'msg' => '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>Mã xe không tồn tại
            </div>'));
        }
               
        
    }
}
?>