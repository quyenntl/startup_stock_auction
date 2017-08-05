<?php
class sidebar_left extends Module{
    function __construct(){
        $this->load->model('gk_model');
        $this->load->library('Image');
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(
                
            )   
        );        
        $css = array(
            //'frontend/styles/layout.css'            
        );        
        return array('js'=>$js,'css'=>$css);
    }
    function draw(){
        $this->load->skins('frontend');
        //
        $list_category = $this->gk_model->select(MK_CATEGORY,'id,name,name_ascii',array(),array(),'id ASC');
        if(!empty($list_category)){
            $list_n = array();
            $i = 0;
            foreach($list_category as $one){
                $link = 'c/'.$one['id'].'/'.$one['name_ascii'];
                $one['i'] = $i++;
                $one['link_detail']    = site_url($link);
                $list_n[]           = $one;
            }
        }        
        //
        $list_new_hot = $this->gk_model->select(FE_NEWS,'id,title,image',array(),array(),'time_create DESC',5);
        $dataNew = array();
        if($list_new_hot){
            $dataNew = $list_new_hot;
        }

        $assign = array(
            'list_category'  => $list_n,
            'list_news' => $dataNew,
            'skin_front' => SKIN_CAR
        );      
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('main/sidebar_left.html');
    }
}
?>