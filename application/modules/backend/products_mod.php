<?php
class products_mod extends Module{
    function __construct(){
        $this->load->model('gk_model');
        $this->load->library('Cache');
    }
    function script(){        
		$js = array(
                'header' => array(
                ),
                'footer' => array(
                	'libs/jquery.tablesorter.min.js',
                    'libs/jquery.livequery.js',                    
                    'libs/bootbox.min.js',                    
                    'libs/jquery.validate.js',                    
                    'libs/jquery.inlineedit.js',
                    'backend/news.js'
                )
        );
        $css = array(
            'css/datepicker.css',
        );
        return array('js'=>$js,'css'=>$css);
    }
    function submit(){
        
    }
    function draw($params = array()){
        $this->load->library('pagination');
        
        
        $condition              = array();
		$like                   = array();
        $array_get              = array();
		$this->load->skins('backend');		
        $this->load->helper('form');
        $name       = $this->input->get('n');
        $description = $this->input->get('d');        
        $end_url    = "?cmd=search&";
        if($name){
            $like['name']  = $array_get['name'] = $name;
            $end_url .= 'name='.$name.'&';
        }
        
        $category_id    = $this->input->get('category');
        $title  = $this->input->get('title');
        if($category_id){
            $condition['category_id']   = $category_id;
            $end_url                ='&category='.$category_id;
        }
        if($title){
            $like['title']  = $title;
            $end_url        = '&title='.$title;
        }
        
        if($description){
            $like['description']  = $array_get['description'] = $description;
            $end_url .= 'name='.$description.'&';
        }
        $category_selected  = $this->input->get('category');
        $total_data            = $this->gk_model->count(FE_PRODUCTS, $condition, $like);        
		$config['base_url']    = site_url('admin/products/index');
		$config['end_url'] 	   = ($end_url == '' ? '' : rtrim($end_url,'&'));
		$config['per_page']    = 20;
		$config['total_rows']  = $total_data;
		$config['num_links']   = 2;
		$config['uri_segment'] = 4;
		$offset                = $this->uri->segment(4);
        if (!is_numeric($offset) || $offset == 0)
        {
            $offset = 1;
        }
        $offset = ($offset - 1)*$config['per_page'];
        $this->pagination->initialize($config);
                
        $list_tmp  = $this->gk_model->select(FE_PRODUCTS, '*', $condition, $like, 'time_created DESC', $config['per_page'], $offset);
        $this->load->library('Cache_Lib');
        $list_category  = $this->cache_lib->cache_list_category();     
                
        $assign = array(
            'form'       => form_open('', $current_page,array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal cancel', 'id' => 'add-template-form')),
            'array_status_user' => $this->input->array_to_option($array_status_user,$tatus_user),
            'data'  => $list_tmp,
            'paging'     => $this->pagination->create_links_page(),
            'count' => $offset+1,
            'list_category' => $list_category,
            'total_data'    => $total_data,
            'option_category'   => $this->input->array_to_option($list_category,$category_selected)            
        );
        $this->smarty->assign($assign);
        $this->load->skins('backend');
        return $this->smarty->display_module('products/index.html');
    }
}
?>