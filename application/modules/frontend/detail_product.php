<?php
class detail_product extends Module{
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
    function draw($param){
        $this->load->skins('frontend');

        $id = $param['id'];
        $info       = $this->gk_model->select(FE_PRODUCTS,'category_id,name,description,image,content,price,price_sale,link_ytb',array('id' => $id));
        $arr_info = array();
        foreach($info as $item){
            $item['img_url']    = $this->image->productImage($item['image'],array('src' => true,'height' => 200,'width' => 350));
            $arr_info[] = $item;
        }
        //
        $other_product = $this->gk_model->select(FE_PRODUCTS,'id,name,image,price,price_sale',array('category_id' => $info[0]['category_id'],'id !=' => $id),array(),'time_created DESC');
        
        if($other_product){
            $i = 1;
            $arr_product = array();
            foreach ($other_product AS $one) {
                $one['i'] = $i++;
                $one['img_url']    = $this->image->productImage($one['image'],array('src' => true,'height' => 150,'width' => 200));
                $arr_product[] = $one;
            }
        }

        $assign = array(
            'info_product'  => $arr_info,
            'other_product' => $arr_product,
            'pagging'   => $pagging
        );
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('products/detail.html');
    }
}
?>