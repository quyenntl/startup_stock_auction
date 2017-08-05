<?php
 class Cache_lib{
    private $CDT;
    private $user_info;
    /**
     * Khởi tạo con trỏ CDT
     */    
    function __construct(){
        $this->CDT = &get_instance();        
    }
    /**
     * Tao cache danh muc
     */ 
    function cache_list_category(){
        $this->CDT->load->model('gk_model');
        $this->CDT->load->cache(array("adapter"=>"file","cache_path"=>CACHE_MODULE_PATH));
        $list_category  = $this->CDT->cache->get('list_category.cache');
        if(empty($list_category)){ 
            $list_category  = $this->CDT->gk_model->select(MK_CATEGORY,'id,name',array('active'=>1));
            if(!empty($list_category)){
                $new_array  = array();
                foreach($list_category as $item){
                    $new_array[$item['id']] = $item['name'];
                }
                $this->CDT->cache->save("list_category.cache",$new_array,84600*30);            
            }
            return $new_array;
        }else{
            return $list_category;
        }        
    }
    
    function city(){        
        $this->CDT->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'location'.DS));
        $data_city = $this->CDT->cache->get("city.cache");
        
        if(empty($data_city)){
            $this->CDT->load->model('gk_model','fe');
            $data = $this->CDT->fe->select(FE_CITY,'','','','city_name');            
            foreach($data as $value){                
                if($value['id']==18 || $value['id']==52){
                    $city[$value['id']] = array($value['id'],$value['city_name']);
                }
                else if($value['id'] != 69){//Loai bo Toan Quoc
                    $district[$value['id']] = array($value['id'],$value['city_name']);
                }                
            }            
            $arrCity = array_merge_recursive($city,$district);            
            foreach($arrCity as $value){
                $data_city[$value[0]] = $value[1];
            }    
            $this->CDT->cache->save("city.cache",$data_city,8640000); //Cái này có mấy khi thay đổi đâu. để 100 ngày
        }        
        return $data_city;  
    }
    
    //Hàm trả về quận huyện theo tỉnh thành cho trước: Để dùng được hàm này nên có cache trước: "cronjob/generate_cache_district"
    function get_cache_district($city_id){
        $this->CDT->load->cache(array("adapter"=>"file","cache_path"=>LOCATION_CACHE));
        $district_list = $this->CDT->cache->get($city_id.'.cache');        
        if(empty($district_list)){
            $this->CDT->load->model('gk_model','fe');
            $array_district = $this->CDT->fe->select(FE_DISTRICT,'id, district_name',array('city_id' => $city_id));
            $timeCache      = 365*86400;
            $district_list  = array();
            foreach($array_district as $key => $value) {
                $district_list[$value['id']] = $value['district_name'];
            }
            $this->CDT->cache->save($city_id.".cache",$district_list,$timeCache); //Cái này có mấy khi thay đổi đâu. để 100 ngày
        }

        return $district_list;
    }   
}
?>