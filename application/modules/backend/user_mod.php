<?php
class user_mod extends Module{
    function __construct(){
        $this->load->model('gk_model');
    }
    function script(){        
		$js = array(
                'header' => array(
                ),
                'footer' => array(
                	'libs/jquery.tablesorter.min.js',
                    'libs/jquery.livequery.js',                    
                    'libs/bootbox.min.js',
                    'libs/bootstrap-datepicker.js',
                    'libs/jquery.validate.js',
                    'backend/user.js'
                )   
        );        
        $css = array(
            'backend/user.css',
            'css/datepicker.css',
        );
        return array('js'=>$js,'css'=>$css);
    }
    function draw($params = array()){        
        $this->load->library('pagination');
        $array_status_user      = $this->config->item('status_user');        
        $status_user            = $this->input->get('status_user');
        $condition              = array();
		$like                   = array();
        $array_get              = array();
		$this->load->skins('backend');		
        $this->load->helper('form');
        $email      = $this->input->get('email');
        $first_name = $this->input->get('first_name');
        $last_name  = $this->input->get('last_name');
        $phone      = $this->input->get('phone');
        $ndt_id      = $this->input->get('ndt_id');
        $end_url    = "?cmd=search&";
        if($email){
            $like['email']  = $array_get['email'] = $email;
            $end_url .= 'email=' . $email.'&';
        }
        if($phone){
            $like['phone']  = $array_get['phone'] = $phone;
            $end_url .= 'phone=' . $phone.'&';
        }
        if($ndt_id){
            $like['ndt_id']  = $array_get['ndt_id'] = $ndt_id;
            $end_url .= 'ndt_id=' . $ndt_id.'&';
        }
        $total_data            = $this->gk_model->count(FE_USER, $condition, $like);        
		$config['base_url']    = site_url('admin/user/index');
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
                
        $list_user  = $this->gk_model->select(FE_USER, '*', $condition, $like, 'price_current DESC', $config['per_page'], $offset);  
        if (!empty($list_user)) {
            foreach($list_user as $one) {
                $arrayUserID [] = $one['ndt_id'];
            }
        }
        $listData = $this->gk_model->select_in(FE_BID,'user_code,num_stocks',array(),'user_code',$arrayUserID);
        if (!empty($listData)) {
            $userBid = array();
            foreach($listData as $one) {
                $userBid[$one['user_code']] = $one;
            }
        }
        //var_dump($this->pagination->create_links_page());die;
        $assign = array(
            'form'       => form_open('', $current_page,array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal cancel', 'id' => 'add-user-form')),
            'array_status_user' => $this->input->array_to_option($array_status_user,$tatus_user),
            'data'  => $list_user,
            'paging1'     => $this->pagination->create_links_page(),
            'count' => $offset+1,
            'array_role'    => $this->config->item('role'),
            'total_data'    => $total_data,
            '_array_status_user'    => $array_status_user,
            'user_bid' => $userBid
        );
        $this->smarty->assign($assign);
        $this->load->skins('backend');
        return $this->smarty->display_module('user/index.html');
    }
}
?>