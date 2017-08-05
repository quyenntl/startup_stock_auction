<?php
class category_mod extends Module {
    
    private $privilege_code = 'CATEGORY';
    private $msg            = '';
    private $type_msg       = '';
    private $menu_cache     = '';
    
    function __construct(){  
        $this->load->model('gk_model','mk_model');
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            redirect(site_url());
        }                 
        $this->load->cache(array("adapter"=>"file","cache_path"=>CACHE_MODULE_PATH));                                    
    }
                   
    function script(){
        
        $js = array(
                'header' => array(),
                'footer' => array(
                    'libs/jquery.history.js',
                    'backend/category.js'
                )   
        );
        
        $css = array(
        
        );
        
        return array('js'=>$js,'css'=>$css);
    }
    
    function submit(){        
        $id         = $this->input->post('id_edit');
        $name       = $this->input->post('name');
        $name_ascii = $this->input->post('name_ascii');
        $order      = $this->input->post('order');
        $category   = $this->input->post('category');
        $active     = $this->input->post('active');
        
        if($name!='' && $category!='' && $name_ascii!='')
        {
           $check = $this->mk_model->select(MK_CATEGORY,'id',array('name_ascii'=>$name_ascii));

           $menu_cha = ($category > 0) ? $this->mk_model->select(MK_CATEGORY,'level,name_ascii',array('id'=>$category)) : 0;

           if (!$id) {
                $name_ascii = ($check) ? $menu_cha[0]['name_ascii'].'-'.$name_ascii : $name_ascii;
           }
           
           $data = array(
                'name'          => $name,
                'name_ascii'    => $name_ascii,
                'level'         => $menu_cha[0]['level'] + 1,
                'parent_id'     => $category,
                'ordering'      => $order,
                'active'        => $active
           );           
        }
        
        
        // Nếu là action Edit
        if($id > 0 && $data){
            $this->mk_model->update(MK_CATEGORY,array('id'=>$id),$data);
            $this->_cache_menu(); 
            $this->msg = 'Cập nhật thành công!';
            $this->type_msg = 1;
            redirect('admin/category');
        }
        elseif (!$id && $data) {           
            $this->mk_model->insert(MK_CATEGORY,$data);
            $this->_cache_menu();
            $this->msg = 'Thêm mới thành công!';
            $this->type_msg = 1;
            redirect('admin/category');
        }
        else{
            $this->msg = 'Bạn chưa nhập nội dung';
            $this->type_msg = 3;
        }   
    }
    
    function draw($params=array()){        
        if($params['do']=='del'){           
            $id = (int)$params['id'];
            if($this->_delete($id) == true)
            {
                redirect(admin_url().'category');
            }
            else {
                $this->msg = 'Xóa thất bại, xin vui lòng thử lại!';
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
        
        
        if(is_file(CACHE_MODULE_PATH.'backend_category.cache'))
        {
            $this->menu_cache = $this->cache->get("backend_category.cache");
        }
        
        if(empty( $this->menu_cache))
        {
              
            $this->menu_cache =  $this->_cache_menu(); 
        
        } 
        $assign = array(
            'page_title'  => 'Quản trị Category',
            'begin_form'  => form_open('backend/category_mod','',array('class'=>'form-horizontal')),
            'close_form'  => form_close(),
            'base_url'    => base_url(),
            'col_total'   => 7,
            'data'        => $this->_loop_menu(0,1),
        );

        $this->smarty->assign($assign);
        return $this->smarty->display_module('category/list.html');;
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
          $this->mk_model->delete(MK_CATEGORY,array('id'=>$id));
          
          return $this->_cache_menu();  
        }
        
        return false;
    }
    
    private function _cache_menu()
    {
        $data_menu = $this->mk_model->select(MK_CATEGORY,'','','','ordering');
        
        $i = 0;
        foreach($data_menu as $menu)
        {
            $i ++;
            $list_menu[$menu['parent_id']][$menu['level']][$menu['ordering'].$i] = array('id'=>$menu['id'],'name'=>$menu['name'],'name_ascii'=>$menu['name_ascii'],'order'=>$menu['ordering'],'active'=>$menu['active']);
        }
        
        $this->cache->save("backend_category.cache",$list_menu,84600*30);
        
        return $list_menu;
    }
    
    
}
?>