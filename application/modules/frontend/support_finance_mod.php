<?php
class support_finance_mod extends Module{
    function __construct(){
        
    }
    function script(){
        $js = array(
            'header' => array(
            ),
            'footer' => array(     
				 'libs/jquery.number.js',       
                'frontend/account.js',
				'frontend/bid.js',
                'frontend/countdown.js',
                'frontend/bootstrap-toggle.min.js'
            )   
        );      
        $css = array(            
                'frontend/styles/bootstrap-toggle.min.css'           
        );  
                
        return array('js'=>$js,'css'=>$css);
    }
    function draw($params = array()){
        $this->load->skins('frontend');
		$userInfo = $this->users_lib->userInfo();
		
		if (empty($userInfo)) {
			redirect(site_url('dang-nhap.html'));			
		}
		$this->load->model('gk_model');
		
		$configItem = $this->gk_model->select_one(FE_SYSTEM_CONFIG,'*',array('name' =>'SO_LUONG_CP','KEY' =>'SO_LUONG'));		
		if (!empty($configItem)) {
			$total = $configItem['value'];			
		}else {
			$total = 1000;
		}	
		
		//Lay gia cao nhat
		$data = $this->gk_model->select(FE_BID,'max(price) as max_price',array(), array());		
		//Tinh toan gia khop tam thoi
		$dataTemp = $this->gk_model->select(FE_BID,'*',array(),array(),'price desc');
		$newData = array();
		$currentKey = 0;
		if (!empty($dataTemp)) {
			foreach($dataTemp as $key =>$one) {
				$_one = $one;
				$_one['tmp_num_stocks'] = (int)$newData[$key-1]['tmp_num_stocks'] + $one['num_stocks'];				
				//echo $one['num_stocks'] .'-'.$key. '<br/>';
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
		$temp_price = $dataTemp[$currentKey]['price'];		
		
		//Lay gia hien tai cua chu dau tu		
		$currentBid = $this->gk_model->select_one(FE_BID,'*',array('user_code' => $userInfo['ndt_id']));
		
		$sotien_huydong = (int)$newData[$currentKey]['tmp_num_stocks'] * $temp_price;
        $time_end = $this->gk_model->select_one(FE_SYSTEM_CONFIG,'*',array('name' =>'TIME','key' => 'END_TIME'));
		
        $assign = array(
            //'list'  => $arr_product
			'user_info' => $userInfo,
			'max_price' => $data[0]['max_price'],
			'temp_price' => $temp_price,	
			'currentBid' => $currentBid	,
			'sotien_huydong' => $sotien_huydong,
            'count_time' => $time_end['value']
        );
        $this->smarty->assign($assign);	
      
		
		
        return $this->smarty->display_module('news/finance.html');
    }
}
?>