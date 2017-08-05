<?php
/**
 * Quản lý Menu System
 * author   Kiennt
 */
class navigation_ajax extends CDT_Controller{
    private $menu_cache = '';
    
    function index(){
        
    }
    
    function get_one(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->model('gk_model','sys_model');
        $id = (int)$this->input->get('id');
        $menu = $this->sys_model->select(SYS_MENU,'*',array('id'=>$id));
        if($menu)
        {
            $link = ($menu[0]['url'] == 'javascript:void(0);') ? '#' : $menu[0]['url'];
            
            $return = array('code'=>1,'name'=>$menu[0]['name'],'url'=>$link,'order'=>$menu[0]['order'],'parent'=>$menu[0]['parent_id']);
        }
        else{
            $return = array('code'=>0);
        }
        //var_dump($return);die;
        echo json_encode($return);
    }
    /**
     * load sub menu system
     **/
    
    function menu_json()
    {
        header('Content-type: application/json');
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'modules'.DS));
        
        if(is_file(CACHE_PATH.'modules'.DS.'navigation.depzai'))
        {
            $this->menu_cache = $this->cache->get("navigation.depzai");
        }
        
        if(empty( $this->menu_cache))
        {
        
            $this->load->model('gk_model','sys_model');
            
            $data_menu = $this->sys_model->select(SYS_MENU,'','','','order');
            
            $i = 0;
            foreach($data_menu as $menu)
            {
                $i ++;
                $list_menu[$menu['parent_id']][$menu['level']][$menu['order'].$i] = array('id'=>$menu['id'],'name'=>$menu['name'],'url'=>$menu['url']);
            }
            
            $this->menu_cache =  $list_menu;
            
            $this->cache->save("navigation.depzai",$list_menu,84600*30);    
        
        }
        //var_dump($this->_loop_menu(0,1));
        echo json_encode($this->_loop_menu(0,1));
          
    }
    
    private function _loop_menu($parent_id=0,$level = 1)
    {   
        $array = array();
        
        foreach($this->menu_cache[$parent_id][$level] as $menu)
        {
            // Là menu nhưng không có menu Con
            if(count($this->menu_cache[$menu['id']][$level + 1]) == 0)
            {
                $array[] = array('id'=>$menu['id'],'text'=>$menu['name']);
            }
            
            // Là menu nhưng lại có Con, Cháu
            elseif(count($this->menu_cache[$menu['id']][$level + 1]) > 0)
            {
                $array[] = array('id'=>$menu['id'],'text'=>$menu['name'],'children' => $this->_loop_menu($menu['id'],$level + 1));
            }

        }
        
        //$ghep_array = array_merge($array,$arr);
        return $array; 
    }
}
?>