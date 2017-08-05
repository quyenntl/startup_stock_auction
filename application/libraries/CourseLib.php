<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class CourseLib{
    private $CDT;
    function __construct(){
        $this->CDT = &get_instance();        
    }
    function export_course_reg(){        
        $this->CDT->load->model('gk_model');
        $name           = $this->CDT->input->get('name');
        $course_type    = $this->CDT->input->get('course_type');
        $time_start     = $this->CDT->input->get('time_create_begin');
        $time_end       = $this->CDT->input->get('time_create_end');
        $phone          = $this->CDT->input->get('phone');   
        $cmnd           = $this->CDT->input->get('cmnd');   
        $time_reg_begin = $this->CDT->input->get('time_reg_begin');
        $time_reg_end   = $this->CDT->input->get('time_reg_end');  
        if($name){
            $like['Cust_name']  = $array_get['name'] = $name;            
        }        
        if($phone){
            $like['telephone']  = $array_get['phone'] = $phone;            
        }
        if($course_type){
            $condition['Course_type']   = $course_type;
        }
        if($time_start){
            $condition['open_date >']   = strtotime($time_start);            
        }        
        if($time_end){
            $condition['open_date <']   = strtotime($time_end) + 86400;
        } 
        if($cmnd){
            $like['Id_value']  = $cmnd; 
        } 
        if($time_reg_begin){
            $condition['unix_timestamp(start_date) >=']   = strtotime($time_reg_begin);           
        }
        if($time_reg_end){
            $condition['unix_timestamp(start_date) <=']   = strtotime($time_reg_end);            
        }
              
        $list_course    = $this->CDT->gk_model->select(FE_REG_COURSE,'*',$condition);
        $this->CDT->load->library('ExcelExport');
        $template               = $this->CDT->excelexport->get_template();
        $template->load_from_file(CACHE_PATH.'excel_template/reg_course.xls');
        $file_name              = 'Dang_ky_hoc '.date('H_i_s_d_m_Y');
        $data[0]['content']				= array('Thời gian tạo từ');
        $hang_xe   = $this->CDT->config->item('hang_xe');
               
        $data[0]['content']             = array('Thời gian tạo: '.date('d/m/Y h:i:s'));                               
        $data[1]['header']				= array('STT','Tên học viên','Số CMND','Địa chỉ','Số điện thoại','Hạng xe');
        
        if(!empty($list_course)){
            $array_city_id         = array();
            $array_district_id     = array();
            foreach($list_course as $one){
                if(!in_array($one['city_id'],$array_city_id)){
                    $array_city_id[]   = $one['city_id'];
                }
                if(!in_array($one['district_id'],$array_district_id)){
                    $array_district_id[]  = $one['district_id'];
                }
            }
            if($array_city_id){
                $array_city = $this->CDT->gk_model->select_in(FE_CITY,'id,city_name',array(),'id',$array_city_id);                
                if(!empty($array_city)){
                    $array_city_new = array();
                    foreach($array_city as $one){
                        $array_city_new[$one['id']] = $one['city_name'];
                    }
                }
            }
            if($array_district_id){
                $array_district = $this->CDT->gk_model->select_in(FE_DISTRICT,'id,district_name',array(),'id',$array_district_id);
                
                if(!empty($array_district)){
                    $array_district_new = array();
                    foreach($array_district as $one){
                        $array_district_new[$one['id']] = $one['district_name'];
                    }
                }                
            }        
            $i = 0;
            foreach($list_course as $one){
                $data[1]['content'][$i]				= array($i+1,$one['Cust_name'],$one['Id_value'],
                                                        $one['address'].','.$array_district_new[$one['district_id']].','.$array_city_new[$one['city_id']],
                                                        $one['telephone'],$hang_xe[$one['Course_type']]);
                                                        
                $i++;       
            }
        }      
        $template->set_contents($data);
        $this->CDT->excelexport->download($file_name);        
    }
    function export_car_reg(){
        $this->CDT->load->model('gk_model');
        $name           = $this->CDT->input->get('name');
        $course_type    = $this->CDT->input->get('course_type');
        $time_start     = $this->CDT->input->get('time_create_begin');
        $time_end       = $this->CDT->input->get('time_create_end');
        $phone          = $this->CDT->input->get('phone');        
        $cmnd           = $this->CDT->input->get('cmnd');
        if($name){
            $like['Cust_name']  = $array_get['name'] = $name;            
        }        
        if($phone){
            $like['telephone']  = $array_get['phone'] = $phone;            
        }
        if($course_type){
            $condition['Course_type']   = $course_type;            
        }
        if($time_start){
            $condition['open_date >']   = strtotime($time_start);            
        }        
        if($time_end){
            $condition['open_date <']   = strtotime($time_end) + 86400;                        
        }     
        if($cmnd){
            $like['Id_value']  = $cmnd; 
        }   
        $list_course    = $this->CDT->gk_model->select(FE_REG_LEN_CAR,'*',$condition);
        $this->CDT->load->library('ExcelExport');
        $template               = $this->CDT->excelexport->get_template();
        $template->load_from_file(CACHE_PATH.'excel_template/reg_car.xls');
        $file_name              = 'Dang_ky_thue_xe '.date('H_i_s_d_m_Y');
        $data[0]['content']				= array('Thời gian tạo từ');
        $hang_xe   = $this->CDT->config->item('hang_xe');
               
        $data[0]['content']             = array('Thời gian tạo: '.date('d/m/Y h:i:s'));                               
        $data[1]['header']				= array('STT','Tên học viên','Số CMND','Số điện thoại','Ngày thuê','Thời gian bắt đầu','Thời gian kết thúc','Tên xe');
        
        if(!empty($list_course)){
            $array_city_id         = array();
            $array_district_id     = array();
            $time_map   = $this->CDT->gk_model->select(FE_TIME_MAP,'value,time_code,time_code_show',array());
            if($time_map){
                $array_time_map     = array();
                foreach($time_map as $one){
                    $array_time_map[$one['value']]  = $one['time_code_show'];
                }
            }  
                    
            $i = 0;
            foreach($list_course as $one){
                $data[1]['content'][$i]		= array($i+1,$one['Cust_name'],$one['Id_value'],                                                        
                                                    $one['telephone'],date('d-m-Y',strtotime($one['start_date'])) ,$array_time_map[$one['time_start']],$array_time_map[$one['time_end']],$one['CAR_ID']);
                                                        
                $i++;
            }
        }           
        $template->set_contents($data);
        $this->CDT->excelexport->download($file_name);
    }
    
}
?>