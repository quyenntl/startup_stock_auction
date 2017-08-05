<?php
class navigation extends Module {
    private $menu_cache = '';
    private $link_admin;
    
    function __construct(){         
        //check quyen
        if($this->users_lib->adminInfo() != true)
        {
            redirect(admin_url('login'));
        }
    }
    
    function draw()
    {
        $this->link_admin = APP_URL.'admin/';
        
        $this->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'modules'.DS));
        
        if(is_file(CACHE_PATH.'modules'.DS.'navigation.depzai'))
        {
            $this->menu_cache = $this->cache->get("navigation.depzai");
        }
        
        if(empty( $this->menu_cache))
        {
        
            $this->load->model('gk_model','gk_model');
            
            $data_menu = $this->gk_model->select(SYS_MENU,'','','','order');
            
            $i = 0;
            foreach($data_menu as $menu)
            {
                $i ++;
                $list_menu[$menu['parent_id']][$menu['level']][$menu['order'].$i] = array('id'=>$menu['id'],'name'=>$menu['name'],'url'=>$menu['url']);
            }
            
            $this->menu_cache =  $list_menu;
            
            $this->cache->save("navigation.depzai",$list_menu,84600*30);    
        
        }
        
        $this->smarty->assign('html_menu',$this->_menu(0,1));
        $this->load->skins('backend');
        return $this->smarty->display_module('navigation/navigation.html');
    }
    
    /**
     * Hàm đệ quy Menu đa cấp siêu thần chưởng
     * Được viết bởi
     * VIết bằng bút chì và giấy báo
     */
    
    private function _menu($parent_id = 0, $level = 1, $arrID = array(), $html = NULL)
    { 
        if(!$html) $html = '';
        foreach($this->menu_cache[$parent_id][$level] as $sub_id => $menu)
        {
            // Là menu cấp 1 nhưng không có menu Con
            if($level == 1 && count($this->menu_cache[$menu['id']][$level + 1]) == 0)
            {
                $html .= '
                    <li'.(($active==$menu['id'] || (!$arrID && $menu['url']=='admin'))?' class="active"' : '').'>
        	      	    <a href="'.(($menu['url'] != "javascript:void(0);") ? $this->link_admin : '').$menu['url'].'">'.$menu['name'].'</a>
        	       </li>
                ';
            }
            
            // Là menu cấp 1 nhưng lại có Con, Cháu
            elseif($level == 1 && count($this->menu_cache[$menu['id']][$level + 1]) > 0)
            {
                $html .= '
                    <li class="dropdown'.(($active==$menu['id'] || (!$arrID && $menu['url']=='admin'))?' active' : '').'">
	      	            <a class="dropdown-toggle" href="'.(($menu['url'] != "javascript:void(0);") ? $this->link_admin : '').$menu['url'].'">'.$menu['name'].'<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            '.$this->_menu($menu['id'],$level + 1,array($menu['id'])).'
                        </ul>
        	       </li>
                ';
            }
            
            
            # Lớn hơn cấp 1
            // Đã là cái loại con cháu thì chớ lại còn có vợ - con - cháu - chắt
            elseif($level > 1  && count($this->menu_cache[$menu['id']][$level + 1]) > 0)
            {
                $html .= '
                    <li class="dropdown-submenu'.(($level==3)?' pull-left' : '').'">
	          	        <a tabindex="-1" href="'.(($menu['url'] != "javascript:void(0);") ? $this->link_admin : '').$menu['url'].'">'.$menu['name'].'</a>
                        <ul class="dropdown-menu">
                            '.$this->_menu($menu['id'],$level + 1,array($menu['id'])).'
                        </ul>
        	       </li>
                ';
            }
            
            // Đã xấu xí lại chẳng có con cháu (bọn lạc loài khác)
            else
            {
                $html .= '
                    <li>
	          	       <a href="'.(($menu['url'] != "javascript:void(0);") ? $this->link_admin : '').$menu['url'].'">'.$menu['name'].'</a>
                    </li>
                ';
            }
        }
        
        return $html; 
    }

}
?>