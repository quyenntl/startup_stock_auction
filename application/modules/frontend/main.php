<?php
class main extends Module{
    function __construct(){
        $this->load->model('gk_model');
        $this->load->library('Image');
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(   
            'libs/jquery.number.js',  
            'frontend/countdown.js',
            'frontend/bid.js'               
            )   
        );        
                
        return array('js'=>$js,'css'=>$css);
    }
    function draw(){
        $this->load->skins('frontend');
		$data = $this->gk_model->select(FE_BID,'*',array(),array(),'price desc,num_stocks desc,time_created asc');
        //
		//Lay so luong co phieu trong bang config:
		$configItem = $this->gk_model->select_one(FE_SYSTEM_CONFIG,'*',array('name' =>'SO_LUONG_CP','KEY' =>'SO_LUONG'));		
		if (!empty($configItem)) {
			$num_stocks = $configItem['value'];			
		}else {
			$num_stocks = 1000;
		}
		
        $currentKey = 0;
        
        if (!empty($data)) {
			foreach($data as $key =>$one) {
				$_one = $one;
				$_one['tmp_num_stocks'] = (int)$newData[$key-1]['tmp_num_stocks'] + $one['num_stocks'];				
				//echo $one['num_stocks'] .'-'.$key. '<br/>';
				if ($_one['tmp_num_stocks'] > $num_stocks){
					$_one['tmp_num_stocks'] = 0;	
					$currentKey = $key-1;
					break;
				}else {
					$currentKey = $key;
				}
				$newData[] = $_one;
			}			
		}
		$temp_price = $data[$currentKey]['price'];	
        $time_end = $this->gk_model->select_one(FE_SYSTEM_CONFIG,'*',array('name' =>'TIME','key' => 'END_TIME'));        
        $assign = array(
            // 'list_category'  => $list_n,
            // 'list'  => $arr_product
			'data' => $data,
			'num_stocks' => $num_stocks,
            'current_key' =>$currentKey,
            'count_time' => $time_end['value']
        );
		
		
        $this->smarty->assign($assign);
        return $this->smarty->display_module('main/main.html');
    }
}
?>