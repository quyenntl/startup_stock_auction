<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class course extends CDT_Controller{
    function index(){}
    function reg_course(){
        $this->load->model('gk_model');
        $data = array(
            'Cust_name' => $this->input->post('name'),
            'Id_value'  => $this->input->post('cmt'),
            'telephone' => $this->input->post('phone'),
            'Course_type'   => $this->input->post('type_cost'),
            'open_date' => time(),
            'amount_stl'    => 0, //Tien dat coc
            'amount_due'    => 100000,
            'record_status' => 0,
            'city_id'  => $this->input->post('reg_city'),
            'district_id' => $this->input->post('reg_district'),
            'address'   => $this->input->post('reg_add')
        );
        $result = $this->gk_model->insert(FE_REG_COURSE,$data);
        if($result){
            echo json_encode(array('code'=>1,'msg'=>'Đăng ký thành công'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Có lỗi trong quá trình thực hiện'));
        }
    }
    /**
     * Đăng ký thuê xe
     */ 
    function reg_len_car(){
        $this->load->model('gk_model');
        $time_start = $this->input->post('time_start');
        $time_end   = $this->input->post('time_end');
        $id_date    = $this->input->post('reg_date');        
        if($time_end - $time_start < 2){
            echo json_encode(array('code'=>0,'msg'=>'Thời gian đăng ký học phải > 1h'));die;
        }
        $car_id     = $this->input->post('car_id');
        $start_date = $this->input->post('day');
        $day    = date('Y-m-d',strtotime(str_replace('/','-',$start_date)));
        $data   = array(
            'Cust_name' => $this->input->post('name'),
            'Id_value'  => $this->input->post('cmt'),
            'telephone' => $this->input->post('phone'),
            'CAR_ID' => $car_id,
            'open_date' => time(),
            'start_date' => $day,
            'time_start' => $time_start,
            'time_end'  => $time_end,            
            'id_date'       => $id_date       
        );
        
        $time_map   = $this->gk_model->select(FE_TIME_MAP,'value,time_code,time_code_show',array('value >'=>$time_start,'value <'=>$time_end));
        if(!empty($time_map)){
            $str_time_map   = '';
            $new_time_map   = array();
            $data_update    = array();
            foreach($time_map as $item){
                $str_time_map .= $item['time_code'].'+';
                $data_update[$item['time_code']]    = 1;
                $new_time_map[$item['value']] = $item['time_code_show'];
            }
            $str_time_map = rtrim($str_time_map,'+');
            $data_check   = $this->gk_model->select_one(FE_CAR_STATUS,'('.$str_time_map.') as num',array('SCH_DATE'=>$day,'car_id'=>$car_id));            
            if(empty($data_check)){
                echo json_encode(array('code'=>0,'msg'=>'Không có lịch trong ngày: '.$start_date));die;
            }elseif((int)$data_check['num'] >= 1){
                echo json_encode(array('code'=>0,'msg'=>'Xe '.$car_id. ' đã bận từ '.$new_time_map[$time_start].' đến '.$new_time_map[$time_end]));
                die;
            }
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Không tồn tại lịch xe trong thời gian bạn chọn'));die;
        }
            
        $result = $this->gk_model->insert(FE_REG_LEN_CAR,$data);
        if($result){
            //Update vao bang status_car
            if((int)$data['num'] == 0){
                //Update vao bang trang thai
                //$this->gk_model->update(FE_CAR_STATUS,array('SCH_DATE'=>$day,'car_id'=>$car_id),$data_update);                                        
            }
            echo json_encode(array('code'=>1,'msg'=>'Đăng ký thành công'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Có lỗi trong quá trình thực hiện'));
        }
    }
    /**
     * Su bang lich
     */     
    function edit_len_car(){
        $user_info  = $this->users_lib->userInfo();
        if($user_info['role'] != 1){
            echo json_encode(array('code'=>0,'msg'=>'Bạn không có quyền'));die;
        }
        $this->load->model('gk_model');
        $time_start = $this->input->post('time_start');
        $time_end   = $this->input->post('time_end');
        $id_date    = $this->input->post('reg_date');       
        $car_id     = $this->input->post('car_id');
        $start_date = $this->input->post('day');        
        $day    = date('Y-m-d',strtotime(str_replace('/','-',$start_date)));       
        $car_status = $this->input->post('car_status');
        $time_map   = $this->gk_model->select(FE_TIME_MAP,'value,time_code,time_code_show',array('value >='=>$time_start,'value <='=>$time_end));
        if((int)$car_status == 0){
            echo json_encode(array('code'=>0,'msg'=>'Bạn chưa chọn trạng thái để cập nhật'));die;
        }
        if($car_status == 2){
            $car_status = 0;
        }
        if(!empty($time_map)){
            $str_time_map   = '';
            $new_time_map   = array();
            $data_update    = array();
            
            foreach($time_map as $item){                
                $data_update[$item['time_code']]    = $car_status;
                $new_time_map[$item['value']] = $item['time_code_show'];
                $str_explode_time_map .= $item['time_code'].','; 
            }
            $str_explode_time_map = rtrim($str_explode_time_map,',');                       
            $data_check   = $this->gk_model->select_one(FE_CAR_STATUS,$str_explode_time_map,array('SCH_DATE'=>$day,'car_id'=>$car_id));
            
            if(!empty($data_check) && !empty($data_update)){
                if($car_status == 1){
                    $data_update    = array();
                    foreach($data_check as $key=>$value){
                        $data_update[$key] = ($value+1) > 2 ? 2:($value + 1);
                    }
                }
                $this->gk_model->update(FE_CAR_STATUS,array('SCH_DATE'=>$day,'car_id'=>$car_id),$data_update);
                echo json_encode(array('code'=>1,'msg'=>'Thành công'));die;
            }else{
                echo json_encode(array('code'=>0,'msg'=>'Không tồn tại lịch xe trong thời gian bạn chọn'));
            }
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Thời gian bạn chọn không phù hợp'));
        }
    }
    function view_cal(){
        $this->load->model('gk_model');
        $this->load->skins('frontend');
        $this->load->library('Image');
        $type_car   = $this->input->get('type_car');
        $time       = $this->input->get('time');
        $day_search = $this->input->get('day');
        
        $time_condition     = array();
        $car_info_condition = array();
        if($time == 1){
            $time_condition['value >']  = 0;
            $time_condition['value <']  = 12;
        }elseif($time == 2){
            $time_condition['value >']  = 10;
            $time_condition['value <']  = 22;
        }elseif($time == 3){
            $time_condition['value >']  = 20;
        }
        
        
        if($type_car){
            $car_info_condition['CAR_CLASS']    = $type_car;
        }        
        $list_time_map      = $this->gk_model->select(FE_TIME_MAP,'*',$time_condition,array(),'id asc');
        $list_car_info      = $this->gk_model->select(FE_CAR_INFO,'CAR_CLASS,DESCRIPTION,image',$car_info_condition,array(),'CAR_CLASS asc');
        $array_car_info     = array();
        if($list_car_info){
            foreach($list_car_info as $one){
                $array_car_info[$one['CAR_CLASS']]  = $one['CAR_CLASS'].' - '.$one['DESCRIPTION'];
                $array_car_image[$one['CAR_CLASS']] = $this->image->car_type_img($one['image'],array('src' => true,'width' => 120,'height' => 90));
            }
        }       
        $field_status_car   = '';
        foreach($list_time_map as $value){
            $field_status_car .= $value['time_code'].',';
        }        
       
        $list_car           = $this->gk_model->select(FE_CAR,'id,CAR_ID,CAR_INFO,CAR_CLASS',$car_info_condition,array(),'id asc');
        $array_car_id       = array();
        if(!empty($list_car)){
            foreach($list_car as $item){
                $array_car_id[] = $item['CAR_ID'];
                $array_car_image_new[$item['CAR_ID']]   = $array_car_image[$item['CAR_CLASS']]; 
            }
        }        
                
        if($day_search){
            $condition_car_status['SCH_DATE'] = date('Y-m-d',strtotime(str_replace('/','-',$day_search)));   
        }
        
        
        $list_car_status    = $this->gk_model->select_in(FE_CAR_STATUS,$field_status_car.' CAR_ID',$condition_car_status,'CAR_ID',$array_car_id);
       
        $assign = array(            
            'time_current'  => date('d/m/Y',time()),
            'time_map'  => $list_time_map,
            'list_car_status'   => $list_car_status,
            'car_option'    => $this->input->array_to_option($array_car_info,$select_car_info),
            'array_car_img' => $array_car_image_new
        );
        $assign['check'] = 1;
        if(empty($list_car_status)){
            $assign['check'] = 0;
            $assign['time_selected']    = $day_search;            
        }
        $assign['static_url'] = STATIC_URL;

        $this->smarty->assign($assign); 
        $html   = $this->smarty->display_module('course/ajax_reg_len_car.html');
        echo json_encode(array('code'=>1,'html'=>$html));
    }
    function get_list_car(){
        $type_car   = $this->input->get('car_type');
        $this->load->skins('frontend');
        if($type_car){
            $this->load->model('gk_model');
            //Lay ra dah sach tat ca cac xe
            $list_all_car   = $this->gk_model->select(FE_CAR,'id,CAR_ID',array('CAR_CLASS'=>$type_car),array(),'ORDERS asc');            
            if(!empty($list_all_car)){
                $new_list_car_all   = array();
                foreach($list_all_car as $one){
                    $new_list_car_all[$one['CAR_ID']]  = $one['CAR_ID']; 
                }
                $assign = array(
                    'car_option'   => $this->input->array_to_option($new_list_car_all,'0')
                );
                $this->smarty->assign($assign); 
                $html   = $this->smarty->display_module('course/list_car.html');
                echo json_encode(array('code'=>1,'html'=>$html));
            }
        }else{
            echo json_encode(array('code'=>0,'msg'=>'Không tồn tại xe phù hợp'));
        }
    }
    /*Lay thog tin lich xe*/
    function check_car_status(){
        $time_start = $this->input->get('time_start');
        $time_end   = $this->input->get('time_end');
        $car_id     = $this->input->get('car_id');
        $day        = date('Y-m-d',strtotime(str_replace('/','-',$this->input->get('day'))));
        $this->load->model('gk_model');
        if($time_end -$time_start < 3){
            echo json_encode(array('code'=>0,'msg'=>'Thời gian đăng ký học phải > 1h'));die;
        }
        $time_map   = $this->gk_model->select(FE_TIME_MAP,'value,time_code,time_code_show',array('value >'=>$time_start,'value <'=>$time_end));
        if(!empty($time_map)){
            $str_time_map   = '';
            $new_time_map   = array();
            $data_update    = array();
            foreach($time_map as $item){
                $str_time_map .= $item['time_code'].'+';
                $data_update[$item['time_code']]    = 1;
                $new_time_map[$item['value']] = $item['time_code_show'];
            }
            $str_time_map = rtrim($str_time_map,'+');
            $data   = $this->gk_model->select_one(FE_CAR_STATUS,'('.$str_time_map.') as num',array('SCH_DATE'=>$day,'car_id'=>$car_id));            
            if(!empty($data)){
                if((int)$data['num'] >= 1){
                    echo json_encode(array('code'=>0,'msg'=>'Xe '.$car_id. ' đã bận từ '.$new_time_map[$time_start].' đến '.$new_time_map[$time_end]));
                }else{
                    //Update vao bang trang thai
                    //$this->gk_model->update(FE_CAR_STATUS,array('SCH_DATE'=>$day,'car_id'=>$car_id),$data_update);
                    echo json_encode(array('code'=>1));
                }
            }else{
                echo json_encode(array('code'=>0,'msg'=>'Không có lịch trong ngày: '.$this->input->get('day')));
            }
        }        
    }
    function get_car_cal(){
        $time_start = $this->input->get('time_start');
        $time_end   = $this->input->get('time_end');
        $car_id     = $this->input->get('car_id');
        $day        = date('Y-m-d',strtotime(str_replace('/','-',$this->input->get('day'))));
        $this->load->model('gk_model');     
        $time_map   = $this->gk_model->select(FE_TIME_MAP,'value,time_code,time_code_show',array('value >'=>$time_start,'value <'=>$time_end));
        if(!empty($time_map)){
            $str_time_map   = '';
            $new_time_map   = array();
            $data_update    = array();
            foreach($time_map as $item){
                $str_time_map .= $item['time_code'].'+';
                $data_update[$item['time_code']]    = 1;
                $new_time_map[$item['value']] = $item['time_code_show'];
            }
            $str_time_map = rtrim($str_time_map,'+');            
            $data   = $this->gk_model->select_one(FE_CAR_STATUS,'('.$str_time_map.') as num',array('SCH_DATE'=>$day,'car_id'=>$car_id));
                      
            if(!empty($data)){
                if((int)$data['num'] >= 1){
                    echo json_encode(array('code'=>0,'msg'=>'Xe '.$car_id. ' đã bận từ '.$new_time_map[$time_start].' đến '.$new_time_map[$time_end]));
                }else{                    
                    echo json_encode(array('code'=>1,'msg'=>'Hiện tại xe rảnh trong thời gian bạn chọn'));
                }
            }else{
                echo json_encode(array('code'=>0,'msg'=>'Không có lịch trong ngày: '.$this->input->get('day')));
            }
        }        
    }
    function get_district(){
        $this->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'location'.DS));
		$zone_id = $this->input->get('city_id');

		$district_list  = $this->cache->get($zone_id.'.cache');        
        if(empty($district_list)){
            $this->load->library('Cache_Lib');
            $district_list  = $this->cache_lib->get_cache_district($zone_id);
        }        
        $html   = '<option value="0">Quận/Huyện</option>';
		foreach ($district_list as $key => $value) {		    
            $html .= '<option value='.$key.'>'.$value.'</option>';
        }    		
		echo $html;
    }
}
?>