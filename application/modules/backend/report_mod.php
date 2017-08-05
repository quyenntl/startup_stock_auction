<?php
class report_mod extends Module{
    function __construct(){
        $this->load->model('gk_model');
        $this->load->library('Cache');
        $cmd    = $this->input->get('cmd');        
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
                    'backend/about_img.js'
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
        
        if($description){
            $like['description']  = $array_get['description'] = $description;
            $end_url .= 'name='.$description.'&';
        }
        $category_selected  = $this->input->get('category');
        if($category_selected){
            $condition['cate_id']   = $category_selected;
            $end_url .= 'category='.$category_selected.'&';
        }
        $total_data            = $this->gk_model->count(FE_BID, $condition, $like);        
		$config['base_url']    = site_url('admin/report/index');
		$config['end_url'] 	   = ($end_url == '' ? '' : rtrim($end_url,'&'));
		$config['per_page']    = 100;
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
		
        //$list_tmp  = $this->gk_model->select(FE_BID, '*', $condition, $like, 'ordering asc', $config['per_page'], $offset);
		
		$dataTemp = $this->gk_model->select(FE_BID,'*',array(),array(),'price desc,num_stocks desc,time_created asc');
		
		$newData = array();
		$currentKey = 0;		
		$configItem = $this->gk_model->select_one(FE_SYSTEM_CONFIG,'*',array('name' =>'SO_LUONG_CP','KEY' =>'SO_LUONG'));		
		if (!empty($configItem)) {
			$total = $configItem['value'];			
		}else {
			$total = 1000;
		}
		$tmp_num_stock = $this->input->get('tmp_num_stock');
		if ($tmp_num_stock) {			
			$total  = $tmp_num_stock;
		}else {
			$tmp_num_stock = $total;		
		}
		
		if (!empty($dataTemp)) {
			foreach($dataTemp as $key =>$one) {
				
				$_one = $one;
				$_one['tmp_num_stocks'] = (int)$newData[$key-1]['tmp_num_stocks'] + $one['num_stocks'];				
				//echo $one['num_stocks'] .'-'.$key. '<br/>';
                //$_one['so_cpmua_duoc'] = ceil($one['price']*$one['num_stocks']);
				if ($_one['tmp_num_stocks'] > $total){
					$_one['tmp_num_stocks'] = 0;	
					$currentKey = $key-1;					
					break;
				}else {
					$currentKey = $key;
				}
				$newData[] = $_one;
			}			
		}
        $socpban = 0;
       
		$temp_price = $dataTemp[$currentKey]['price'];	
        foreach($newData as $one) {
            $socpban += ceil(($one['price']*$one['num_stocks'])/$temp_price);            
        }	
        $assign = array(           
            'data'  => $newData,
            'paging'     => $this->pagination->create_links_page(),
            'count' => $offset+1,           
            'total_data'    => $total_data,
			'temp_price' => $temp_price,	
			'total_stock_tmp' => $newData[$currentKey]['tmp_num_stocks'],
			'tmp_num_stock' => $tmp_num_stock, 
            'socpban' => $socpban          
        );
        $this->smarty->assign($assign);
		
        $this->load->skins('backend');
        return $this->smarty->display_module('report/index.html');
    }
}
?>