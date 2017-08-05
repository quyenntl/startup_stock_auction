<?php
/**
* @author Siêu Deeds
*/
class guide_ajax extends CDT_Controller
{
    function del_guide()
    {
        $admin_info     = $this->users_lib->adminInfo();
        if($admin_info['role'] != 1){
            echo json_encode(array('err'=>0,'msg'=>'Bạn không có quyền'));die;
        }
            

        $this->load->model('gk_model', 'fe_model');
        $id        = $this->input->get('id');

        $this->fe_model->delete(FE_NEWS, array('id' => $id));
        echo json_encode(array('err'=>0));
    }
    function del_about()
    {
        $admin_info     = $this->users_lib->adminInfo();
        if($admin_info['role'] != 1){
            echo json_encode(array('err'=>0,'msg'=>'Bạn không có quyền'));die;
        }
            

        $this->load->model('gk_model', 'fe_model');
        $id        = $this->input->get('id');

        $this->fe_model->delete(FE_ABOUT, array('id' => $id));
        echo json_encode(array('err'=>0));
    }

    function block_guide()
    {
        $admin_info     = $this->users_lib->adminInfo();
        if($admin_info['role'] != 1){
            echo json_encode(array('err'=>0,'msg'=>'Bạn không có quyền'));die;
        }

        $this->load->model('gk_model', 'fe_model');
        $id     = $this->input->get('id');
        $status = $this->input->get('status');
        if($status == 1)
        {
            $this->fe_model->update(FE_NEWS, array('id' => $id), array('active' => 0));
            echo json_encode(array('err'=>0, 'new_status' => 0));
        }
        else if($status == 0)
        {
            $this->fe_model->update(FE_NEWS, array('id' => $id), array('active' => 1));
            echo json_encode(array('err'=>0, 'new_status' => 1));
        }
    }
    function set_hot(){
        $admin_info     = $this->users_lib->adminInfo();
        if($admin_info['role'] != 1){
            echo json_encode(array('err'=>0,'msg'=>'Bạn không có quyền thực hiện chức năng này'));die;
        }
        $this->load->model('gk_model', 'fe_model');
        $id     = $this->input->get('id');
        $status = $this->input->get('status');
        if($status == 1)
        {
            $this->fe_model->update(FE_NEWS, array('id' => $id), array('hot' => 0));
            echo json_encode(array('err'=>0, 'new_status' => 0));
        }
        else if($status == 0)
        {
            $this->fe_model->update(FE_NEWS, array('id' => $id), array('hot' => 1));
            echo json_encode(array('err'=>0, 'new_status' => 1));
        }
    }
}