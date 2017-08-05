<?php
class list_product_cate extends Module{
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
                
            )   
        );        
        $css = array(
            //'frontend/styles/layout.css'            
        );        
        return array('js'=>$js,'css'=>$css);
    }
    function draw($param){
        $this->load->skins('frontend');
        $cate_id    = $param['cate_id'];      
        if($cate_id){
            $condition['category_id']   = $cate_id;
        }
        //
        $infoCate = $this->gk_model->select_one(MK_CATEGORY,'id,name',array('id' => (int)$cate_id));
            
        $total_data = $this->gk_model->count(FE_PRODUCTS,$condition,array());            
        $page       = $this->input->get('page');
        $per_page   = 30;
        $pagging    = $this->paggingclass->pagging($total_data,$per_page,5,'','page','current');

        $offset = $page;
        if ( ! is_numeric($offset) || $offset == 0)
        {
            $offset = 1;
        }
        $offset = ($offset - 1)*$per_page;        
        $info       = $this->gk_model->select(FE_PRODUCTS,'id,name,image,price,price_sale',$condition,array(),'time_created DESC',$per_page,$offset);  
        $arr_info = array();
        foreach($info as $item){
            $item['img_url']    = $this->image->productImage($item['image'],array('src' => true,'height' => 224,'width' => 300));
            $arr_info[] = $item;
        }
        
        $assign = array(            
            'list_product'  => $arr_info,
            'info_cate' => $infoCate,
            'pagging'   => $pagging
        );
        
        $this->smarty->assign($assign);
        return $this->smarty->display_module('products/main.html');
    }
}
?>