<?php
/**
 * Quản lý Category
 * author   Kiennt
 */
class category_ajax extends CDT_Controller{    
    function index(){
        
    }
    
    function get_one(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));
            die;        
        }
        $id = (int)$this->input->get('id');
        $this->load->model('gk_model','mk_model');
        $menu = $this->mk_model->select(MK_CATEGORY,'*',array('id'=>$id));
        if($menu)
        {            
            $return = array(
                'code'=>1,
                'name'=>$menu[0]['name'],
                'name_ascii'=>$menu[0]['name_ascii'],
                'order'=>$menu[0]['ordering'],
                'parent'=>$menu[0]['parent_id'],
                'active'=>$menu[0]['active']
            );
        }
        else{
            $return = array('code'=>0);
        }
        //var_dump($return);die;
        echo json_encode($return);
    }
}
?>