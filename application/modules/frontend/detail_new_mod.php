<?php
class detail_new_mod extends Module{
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
            
        );        
        return array('js'=>$js,'css'=>$css);
    }
    function draw($param){
        $this->load->skins('frontend');

        $id = $param['id'];
        $info       = $this->gk_model->select(FE_NEWS,'title,description,image,content,time_create',array('id' => $id));
        $arr_info = array();
        foreach($info as $item){
            $item['img_url']    = $this->image->newsImage($item['image'],array('src' => true,'height' => 200,'width' => 350));
            $arr_info[] = $item;
        }
        //
        $other_news = $this->gk_model->select(FE_NEWS,'id,title,time_create',array('id !=' => $id),array(),'time_create DESC',6);
        if($other_news){
            $i = 1;
            $arr_news = array();
            foreach($other_news AS $one){
                $one['i'] = $i++;
                $arr_news[] = $one;
            }
        }
        $assign = array(            
            'info_news'  => $arr_info,
            'other_news'   => $arr_news
        );
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('news/detail.html');
    }
}
?>