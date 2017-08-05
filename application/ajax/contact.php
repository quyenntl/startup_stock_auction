<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class contact extends CDT_Controller{
    function sendingContact(){
        $this->load->model('gk_model');

        $data['name']     = $this->input->get('name');
        $data['email']     = $this->input->get('email');
        $data['phone']     = $this->input->get('phone');
        $data['title']    = $this->input->get('title');
        $data['content']     = $this->input->get('content');
        $data['time_create']     = time();

        $insert = $this->gk_model->insert(FE_CONTACT, $data);
        if($insert){
            echo json_encode(array('code'=>1));
        }else{
            echo json_encode(array('code'=>0));
        }
    }
}
?>