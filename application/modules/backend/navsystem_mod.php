<?php
class navsystem_mod extends Module {    
    private $privilege_code = 'MENU_SYSTEM';
    private $msg            = '';
    private $type_msg       = '';
    private $menu_cache     = '';
    
    function __construct(){  
        $this->load->model('gk_model','sys_model');
        /* check privilege
        $privilege = $this->users_lib->AdminPrivilege($this->privilege_code);
        if(!$privilege)
            redirect(admin_url());
        */        
    }
                   
    function script(){
        
        $js = array(
                'header' => array(),
                'footer' => array(
                    'libs/jquery.history.js',
                    'backend/navigation.js'
                )   
        );
        
        $css = array(
        
        );
        
        return array('js'=>$js,'css'=>$css);
    }
    
    function submit(){
        $user_info  = $this->users_lib->adminInfo();        
        if($user_info['role'] != 1){
            redirect(site_url('admin'));
        }
        
        $id         = $this->input->post('id_edit');
        $name       = $this->input->post('name');
        $order      = $this->input->post('order');
        $category   = $this->input->post('category');
        $link       = $this->input->post('link');
        
        if($name!='' && $category!='' && $link!='')
        {
           $menu_cha = ($category > 0) ? $this->sys_model->select(SYS_MENU,'level,source',array('id'=>$category)) : 0;
           $source      = ($category > 0) ? ( ($menu_cha[0]['source'] == 0) ? $category : $menu_cha[0]['source'].','.$category ) : 0;
           
           $data = array(
                'name'      => $name,
                'url'       => ($link=='#') ? 'javascript:void(0);' : $link,
                'level'     => $menu_cha[0]['level'] + 1,
                'parent_id' => $category,
                'order'     => $order,
                'source'    => $source
           ); 
        }
        
        
        // Nếu là action Edit
        if($id > 0 && $data){            
            $this->sys_model->update(SYS_MENU,array('id'=>$id),$data);
            $this->_cache_menu();
            $this->msg = 'Success!';
            $this->type_msg = 1;
        }
        elseif (!$id && $data) {            
            $this->sys_model->insert(SYS_MENU,$data);
            $this->_cache_menu();
            $this->msg = 'Add menu success';
            $this->type_msg = 1;
        }
        else{
            $this->msg = 'Content is null';
            $this->type_msg = 3;
        }   
    }
    
    function draw($params=array()){        
        if($params['do']=='del'){           
            $id = (int)$params['id'];
            if($this->_delete($id) == true)
            {
                redirect(site_url('admin/navsystem'));
            }
            else {
                $this->msg = 'Delete menu false, please try again';
                $this->type_msg = 3;
            }
        }        
        if($this->msg != ''){
            $this->load->helper('notice');
            if($this->type_msg == 3)
                $this->smarty->assign('msg',error($this->msg));
            elseif($this->type_msg == 1)
                $this->smarty->assign('msg',success($this->msg));
            elseif($this->type_msg == 2)
                $this->smarty->assign('msg',warning($this->msg));
            else
                $this->smarty->assign('msg',information($this->msg));
        }else{
            $this->smarty->assign('msg','');
        }        
        $this->load->helper('form');
        $this->load->skins('backend');        
        $this->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'modules'.DS));        
        if(is_file(CACHE_PATH.'modules'.DS.'navigation.depzai'))
        {
            $this->menu_cache = $this->cache->get("navigation.depzai");
        }
        
        if(empty( $this->menu_cache))
        {
              
            $this->menu_cache =  $this->_cache_menu(); 
        
        } 
        $assign = array(
            'page_title'  => 'Admin menu system',
            'begin_form'  => form_open('backend/navsystem_mod','',array('class'=>'form-horizontal')),
            'close_form'  => form_close(),
            'base_url'    => base_url(),
            'col_total'   => 7,
            'data'        => $this->_loop_menu(0,1),
        );

        $this->smarty->assign($assign);
        return $this->smarty->display_module('navigation/navsystem.html');
    }
    
    private function _loop_menu($parent_id=0,$level = 1)
    {   
        $array = array();        
        foreach($this->menu_cache[$parent_id][$level] as $menu)
        {
            $data_level = ($level > 0) ? $level : 0;            
            // Là menu nhưng không có menu Con
            if(count($this->menu_cache[$menu['id']][$level + 1]) == 0)
            {
                $array[] = array('id'=>$menu['id'],'level'=>$data_level,'text'=>$menu['name'],'order'=>$menu['order']);
            }
            
            // Là menu nhưng lại có Con, Cháu
            elseif(count($this->menu_cache[$menu['id']][$level + 1]) > 0)
            {
                $array[] = array('id'=>$menu['id'],'level'=>$data_level,'text'=>$menu['name'],'order'=>$menu['order'],'children' => $this->_loop_menu($menu['id'],$level + 1));
            }

        }
        
        //$ghep_array = array_merge($array,$arr);
        return $array; 
    }
    
    
    private function _delete($id='')
    {
        if($id > 0)
        {
          $this->sys_model->delete(SYS_MENU,array('id'=>$id));
          
          return $this->_cache_menu();  
        }
        
        return false;
    }
    
    private function _cache_menu()
    {
        $this->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'modules'.DS));        
        $data_menu = $this->sys_model->select(SYS_MENU,'','','','order');        
        $i = 0;
        foreach($data_menu as $menu)
        {
            $i ++;
            $list_menu[$menu['parent_id']][$menu['level']][$menu['order'].$i] = array('id'=>$menu['id'],'name'=>$menu['name'],'url'=>$menu['url'],'order'=>$menu['order']);
        }
        
        $this->cache->save("navigation.depzai",$list_menu,84600*30);
        
        return $list_menu;
    }    
}
?>