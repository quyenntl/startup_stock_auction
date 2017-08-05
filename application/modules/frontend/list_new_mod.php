<?php
class list_new_mod extends Module{
    function __construct(){
        $this->load->model('gk_model');
        $this->load->library('Image');
        $this->load->library('PaggingClass');
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(
                'libs/jquery.easing.1.3.js',
                'libs/jquery.timers.1.2.js',
                'libs/jquery.galleryview-2.1.1.js',
                'libs/jquery.galleryview.setup.js',
            )   
        );        
        $css = array(
            //'frontend/styles/layout.css'            
        );        
        return array('js'=>$js,'css'=>$css);
    }
    function draw(){
        $this->load->skins('frontend');
            
        $total_data = $this->gk_model->count(FE_NEWS,$condition,array());            
        $page       = $this->input->get('page');
        $per_page   = 6;
        $pagging    = $this->paggingclass->pagging($total_data,$per_page,5,'','page','current');

        $offset = $page;
        if ( ! is_numeric($offset) || $offset == 0)
        {
            $offset = 1;
        }
        $offset = ($offset - 1)*$per_page;        
        $info       = $this->gk_model->select(FE_NEWS,'id,title,description,image',array(),array(),'time_create DESC',$per_page,$offset);  
        $arr_info = array();
        $i = 0;
        foreach($info as $item){
            $item['i'] = $i++;
            $item['img_url']    = $this->image->newsImage($item['image'],array('src' => true,'height' => 150,'width' => 200));
            $arr_info[] = $item;
        }
        $assign = array(            
            'list_news'  => $arr_info,
            'pagging'   => $pagging
        );
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('news/list.html');
    }
}
?>