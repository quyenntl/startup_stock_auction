<?php
class admin_course extends CDT_Controller{
    function index(){}
    function accept_course(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));die;
        }
        
        $id = $this->input->get('id');
        if($id){
            $this->load->model('gk_model');
            $this->gk_model->update(FE_REG_COURSE,array('id'=>$id),array('auth_status'=>1));
            echo json_encode(array('code'=>1,'msg'=>'Thành công'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Có lỗi trongq quá trình thực hiện'));
        }
    }
    
    function un_accept_course(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));die;
        }
        
        $id = $this->input->get('id');
        if($id){
            $this->load->model('gk_model');
            $this->gk_model->update(FE_REG_COURSE,array('id'=>$id),array('auth_status'=>0));
            echo json_encode(array('code'=>1,'msg'=>'Thành công'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Có lỗi trongq quá trình thực hiện'));
        }
    }
    function accept_reg_car(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));die;
        }
        
        $id = $this->input->get('id');
        if($id){
            $this->load->model('gk_model');
            $this->gk_model->update(FE_REG_LEN_CAR,array('id'=>$id),array('auth_status'=>1));
            echo json_encode(array('code'=>1,'msg'=>'Thành công'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Có lỗi trongq quá trình thực hiện'));
        }
    }
    
    function un_accept_reg_car(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền truy cập'));die;
        }
        
        $id = $this->input->get('id');
        if($id){
            $this->load->model('gk_model');
            $this->gk_model->update(FE_REG_LEN_CAR,array('id'=>$id),array('auth_status'=>0));
            //Cap nhat lai bang lich
            $info   = $this->gk_model->select_one(FE_REG_LEN_CAR,'id,CAR_ID,start_date,time_start,time_end',array('id'=>$id));
            $time_start = $info['time_start'];
            $time_end   = $info['time_end'];
            $time_map   = $this->gk_model->select(FE_TIME_MAP,'value,time_code,time_code_show',array('value >='=>$time_start,'value <='=>$time_end));
            if(!empty($time_map)){
                $str_time_map   = '';
                $new_time_map   = array();
                $data_update    = array();                
                foreach($time_map as $item){
                    $str_explode_time_map .= $item['time_code'].','; 
                }
                $str_explode_time_map = rtrim($str_explode_time_map,',');
                $data_check   = $this->gk_model->select_one(FE_CAR_STATUS,$str_explode_time_map,array('SCH_DATE'=>$info['start_date'],'car_id'=>$info['CAR_ID']));
                if(!empty($data_check)){                    
                    $data_update    = array();
                    foreach($data_check as $key=>$value){
                        $data_update[$key] = ($value-1) < 0 ? 0 : ($value - 1);
                    }
                    $this->gk_model->update(FE_CAR_STATUS,array('SCH_DATE'=>$info['start_date'],'car_id'=>$info['CAR_ID']),$data_update);                    
                }
            }
            echo json_encode(array('code'=>1,'msg'=>'Thành công'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Có lỗi trongq quá trình thực hiện'));
        }
    }
    
    function update_len_car(){
        $this->load->model('gk_model');
        $id     = $this->input->get('id');
        $info   = $this->gk_model->select_one(FE_REG_LEN_CAR,'*',array('id'=>$id));
        if(empty($info)){
            echo json_encode(array('code'=>0,'msg'=>'Không tồn tại thông tin'));die;
        }
        $time_start = $info['time_start'];
        $time_end   = $info['time_end'];
        $car_id     = $info['CAR_ID'];
        $day        = $info['start_date'];
        $time_map   = $this->gk_model->select(FE_TIME_MAP,'value,time_code,time_code_show',array('value >='=>$time_start,'value <='=>$time_end));
        if(!empty($time_map)){
            $str_time_map   = '';
            $new_time_map   = array();
            $data_update    = array();
            foreach($time_map as $item){
                $str_time_map .= $item['time_code'].'+';
                //$data_update[$item['time_code']]    = 1 ;
                $new_time_map[$item['value']] = $item['time_code_show'];
                $str_explode_time_map .= $item['time_code'].',';
            }                        
            $str_time_map = rtrim($str_time_map,'+');
            $str_explode_time_map = rtrim($str_explode_time_map,','); 
                                              
            $data_check   = $this->gk_model->select_one(FE_CAR_STATUS,'('.$str_time_map.') as num,'.$str_explode_time_map.' ',array('SCH_DATE'=>$day,'car_id'=>$car_id));
            
            if(empty($data_check)){
                echo json_encode(array('code'=>0,'msg'=>'Bảng lịch đã được cập nhật: '.$info['start_date']));die;
            }elseif((int)$data_check['num'] > 2){
                echo json_encode(array('code'=>0,'msg'=>'Xe '.$car_id. ' đã bận từ '.$new_time_map[$time_start].' đến '.$new_time_map[$time_end]));
                die;
            }else if((int)$data_check['num'] <= 2){
                unset($data_check['num']);
                if(!empty($data_check)){
                    foreach($data_check as $key=>$value){
                        $data_update[$key] = $value+1;
                    }
                }                
                $this->gk_model->update(FE_REG_LEN_CAR,array('id'=>$id),array('record_status'=>1));                
                $this->gk_model->update(FE_CAR_STATUS,array('SCH_DATE'=>$day,'car_id'=>$car_id),$data_update);
                echo json_encode(array('code'=>1,'msg'=>'Thành công'));
            }
        }            
    }
    function gen_car_calendar(){
        $time_start = $this->input->get('time_start');
        $time_end   = $this->input->get('time_end');
        $int_time_start = strtotime($time_start);
        $int_time_end   = strtotime($time_end);       
        if($time_end && $time_start){
            $this->load->model('gk_model');
            $info   = $this->gk_model->select(FE_CAR_STATUS,'CAR_ID',array('SCH_DATE >=' => $time_start, 'SCH_DATE <=' => $time_end ),array(),'CAR_ID ASC');
            if(!empty($info)){
                echo json_encode(array('code'=>0,'msg'=>'Đã tồn tại lịch xe'));
            }else{
                //Thuc hien insert du lieu
               //Lay ra list xe                
                $list_car   = $this->gk_model->select(FE_CAR,'id,CAR_ID,ORDERS',array(),array(),'ORDERS asc');                              
                if(!empty($list_car)){
                    $data_insert    = array();
                    for($i = $int_time_start; $i<=$int_time_end;$i=$i+86400){                                                
                        foreach($list_car as $one){
                            $data_insert[] = array('CAR_ID'=>$one['CAR_ID'],'SCH_DATE'=>date('Y-m-d',$i));
                        }
                    }                    
                    if(!empty($data_insert)){
                        $this->gk_model->multi_insert(FE_CAR_STATUS,$data_insert);
                        echo json_encode(array('code'=>1,'msg'=>'Thành công'));die;
                    }
                    
                }else{
                    echo json_encode(array('code'=>0,'msg'=>'Không tồn tại thông tin của xe')); 
                }   
            }
        }
    }
}
?>