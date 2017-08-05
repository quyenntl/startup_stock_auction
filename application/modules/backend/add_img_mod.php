<?php
class add_img_mod extends Module{
    function __construct(){
         $this->load->library('upload');
         $this->load->model('gk_model');
    }
    function script(){}
    function submit(){
        $id_edit         = $this->input->post('new_id');
        $arrFileUpload  = $_FILES;
        $i = 1;        
        if(!file_exists(STORE_DATA.'news/'.$id_edit)){
            mkdir(STORE_DATA.'news/'.$id_edit,0777,true);
            chmod(STORE_DATA.'news/'.$id_edit,0777);
        }
        $arrUpdateImage = array();
        $j = 1;
        
        foreach($arrFileUpload AS $key => $itemFile){
            if($itemFile['name'] != "") {
                $imageName = $itemFile['name'];
                $x = explode('.', $imageName);
                $imageName = time().'_'.str_replace('  ','',str_replace("'","",$x[0])).'.'.end($x);                    
                $config['file_name'] = $imageName;
                     
                $config['upload_path'] = STORE_DATA.'news/'.$id_edit;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|GIF|PNG|JPEG';
                $config['max_size']    = '5000';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $res = $this->upload->do_upload($key);
                
                $err_upload = $this->upload->display_errors();
                
                if($err_upload != "") {
                    $this->msg .= 'Đăng tải lỗi: ' .$key.$err_upload.'<br />';
                    $this->type_msg = 3;
                }else{
                    $srcImg = $this->upload->file_name;
                    $arrUpdateImage[$key] = $id_edit.DS.$srcImg;
                } 
            }
            ++$j;
        }
        
        $this->gk_model->update(FE_NEWS,array('id'=>$id_edit),$arrUpdateImage);
    }
    
    function draw(){
        $this->load->skins('backend');
        $this->load->helper('form');
        $assign = array(
            'id'            => $id,            
            'begin_form'     => form_open('backend/add_img_mod', '',array('enctype'=>'multipart/form-data', 'id' => 'form_img')),
            'end_form'      => form_close()           
        );            
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('news/multiple_img.html');
    }
}
?>