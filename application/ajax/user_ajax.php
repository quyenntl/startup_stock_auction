<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
class user_ajax extends CDT_Controller{
    function index(){}
    function login(){        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
       
        $this->load->library('session');
        
        $session = $this->session->userdata($this->config->item('session_user_ad'));

        if($session && ($session['timeout_login'] + $this->config->item('time_out')) > time() && $session['role'] > 1){        
            redirect(admin_url());
        }
        if($username=='' || $password==''){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-error"><strong>Error</strong>: Username or Password is NULl</div>'));
            die;
        }
       
        $this->load->model('gk_model', 'fe_model');
        $field = '*';        
        $data = $this->fe_model->select(FE_USER, $field,array('user_name'=>$username,'status'=>1,));

        if(!$data){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-error"> <strong>'.$username.'</strong> not exit.</div>'));
            die;
        }
       
        $userinfo = $data[0];
        
        if($userinfo['role'] != 1){
            echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-error">&nbsp; You are not  Admin.</div>'));
            die;
        }
       
        if($this->users_lib->encodePassword($password,$this->config->item('encryption_key')) != $userinfo['password'])
        {
            echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-error">&nbsp; Password not valid.</div>'));
            die;
        }       
       
        unset($userinfo['time_last_visited']);
     
        $userinfo['time_last_visited'] = $data[0]['time_last_visited'];
        $userinfo['timeout_login']   = time();
        
        $this->fe_model->update(FE_USER,array('id'=>$userinfo['id']),array('time_last_visited'=>time()));
        
        $this->session->set_userdata(array($this->config->item('session_user_ad')=>$userinfo));        
        echo json_encode(array('code'=>1));
    }
    function add(){
        //Check quyen
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->model('gk_model');
        $user_name  = $this->input->post('user_name');
        if(preg_match('/[^a-zA-Z0-9_]/', $user_name)){
            echo json_encode(array('err' => 2, 'msg' => '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>&nbsp; &nbsp; User name not valid.
                  Not in (a-zA-Z0-9) 
                </div>'));
            die;    
        }
        $mobilephone    = $this->input->post('mobiphone');
        $email          = $this->input->post('email');
		$code = 		$this->input->post('code');
		$sig_deposit_amt = $this->input->post('sig_deposit_amt');
		if (!$code) {
			$code = $this->users_lib->genarateCode();
		}	
		
		$checkExists = $this->gk_model->select(FE_USER, '*',array('code' => $code));
		if (!empty($checkExists)) {
			echo json_encode(array('err' => 1, 'msg' => '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>Error, Bid code is exists.
            </div>'));
			die;
		}
		
        //check email
        $check = $this->gk_model->select(FE_USER,'id',array('email'=>$email));
        if(!empty($check)){
            echo json_encode(array('err' => 2, 'msg' => '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>&nbsp; &nbsp; Email bạn nhập đã tồn tại 
                </div>'));
            die;
        }
        $fullname       = $this->input->post('fullname');
        $data   = array(
            'code'     => $code,
            'email'    => $email,
            'fullname' => $fullname,
            'phone'     => $mobilephone,
            'role'      => 2,
            'time_created'  => time(),
            'status'    => 1,
			'sig_deposit_amt' => $sig_deposit_amt
        );
        $result_insert  = $this->gk_model->insert(FE_USER,$data);
        if($result_insert){
            $ndt = 'NDT';
            if($result_insert < 10){
                $ndt = str_pad($ndt,6,"0").$result_insert;
            }elseif($result_insert >= 10 && $result_insert < 100){
                $ndt = str_pad($ndt,5,"0").$result_insert;
            }elseif($result_insert >= 100 && $result_insert < 1000){
                $ndt = str_pad($ndt,4,"0").$result_insert;
            }else{
                $ndt = $ndt.$result_insert;
            }
            $update = $this->gk_model->update(FE_USER,array('id' => $result_insert),array('ndt_id' => $ndt));
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button> &nbsp;&nbsp;Success.
                </div>'));
        }else{
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>&nbsp; &nbsp; Error
                </div>'));
        }
    }
    function load_info()
    {       
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->skins('backend');
        $this->load->model('gk_model', 'fe_model');        
        $this->load->helper('form');
        $user_id        = $this->input->get('user_id');
        $data           = $this->fe_model->select_one(FE_USER, '*', array('id' => $user_id));
        $assign         = array(
            'data'          => $data,          
            'array_status_user' => $this->input->array_to_option($this->config->item('status_user'),$data['status']),
            'array_role'    => $this->input->array_to_option($this->config->item('role'),$data['role']),
            'form'          => form_open('', '',array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'info-user-form'))
        );
        $this->smarty->assign($assign);
        echo $this->smarty->display_module('user/modal_info.html');
    }
    function update_info(){
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $first_name = $this->input->post('first_name');
        $last_name  = $this->input->post('last_name');
        $sig_deposit_amt      = $this->input->post('sig_deposit_amt');
        $address    = $this->input->post('address');
        $email       = $this->input->post('email');
        $status     = $this->input->post('status');
        $code  = $this->input->post('code');
		$fullname 	= $this->input->post('fullname');
        $price_fix = $this->input->post('price_fix');
        $data       = array(         
            'sig_deposit_amt'         => $sig_deposit_amt,
            'email'          => $email,            
			'fullname'		=> $fullname,
			'code'		=> $code,
            'price_fix' => $price_fix
        );
		$this->load->model('gk_model','fe_model');        
		//Kiem tra code xem co ton tai khong.
		
        
        
        $condition['id']     = $this->input->post('u_id');
		$checkExists = $this->fe_model->select(FE_USER, '*',array('id !=' => $condition['id'],'code' => $code));
		if (!empty($checkExists)) {
			echo json_encode(array('err' => 1, 'msg' => '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>Error, Bid code is exists.
            </div>'));
			die;
		}
		
        if($this->fe_model->update(FE_USER, $condition, $data))
            echo json_encode(array('err' => 0, 'msg' => '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>Update success.
            </div>'));
        else
            echo json_encode(array('err' => 1, 'msg' => '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>Error, please try again.
            </div>'));
    }
    /**
     * Block user
     */ 
    function block_user(){    
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->model('gk_model', 'fe_model');
        $user_id = $this->input->get('user_id');

        $condition['id'] = $user_id;
        $data = array();
        if($status == 1)
        {
    	    $data['status'] = 2;
    	    $mode = 'block';
        }
        else
        {
    	    $data['status'] = 1;
    	    $mode = 'unblock';
        }
        if($this->fe_model->update(FE_USER, $condition, $data))
        {
    	    echo json_encode(array('err' => 0, 'mode' => $mode, 'stat' => $data['status']));
        }
        else
        {
    	    echo json_encode(array('err' => 1));
        }
    }

    /**
     * Delete user
     */ 
    function delete_user(){    
        $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->model('gk_model', 'fe_model');
        $user_id = $this->input->get('user_id');
        $ndt_id = $this->fe_model->select_one(FE_USER,'ndt_id',array('id'=>$user_id));
        $condition['id'] = $user_id;
        
        if($this->fe_model->delete(FE_USER,array('id'=>$user_id)))
        {
            //xoa lich su bid
            $this->fe_model->delete('tbl_bid',array('user_code'=>$ndt_id['ndt_id']));
    	    echo json_encode(array('err' => 0));
        }
        else
        {
    	    echo json_encode(array('err' => 1));
        }
    }

    //login FE
    function login_fe(){        
        $code = $this->input->get('codebm123');
        $email = $this->input->get('email');
        $this->load->library('session');
        //echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger">Đã hết giờ đặt giá!</div>'));die;
        $session = $this->session->userdata($this->config->item('session_user'));
        
        if($code == ''){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Error</strong>: Bạn hãy nhập mã của bạn!</div>'));
            die;
        }

        if($email == ''){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Error</strong>: Bạn hãy nhập email của bạn!</div>'));
            die;
        }
       
        $this->load->model('gk_model', 'fe_model');
        $field = '*';
        $data = $this->fe_model->select(FE_USER, $field,array('code'=>$code,'email' => $email,'status'=>1));

        if(!$data){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"> Mã <strong>'.$code.'</strong> bạn nhập không tồn tại.</div>'));
            die;
        }
       
        $userinfo = $data[0];
       
        unset($userinfo['time_last_visited']);
     
        $userinfo['time_last_visited'] = $data[0]['time_last_visited'];
        $userinfo['timeout_login']   = time();
        
        $this->fe_model->update(FE_USER,array('id'=>$userinfo['id']),array('time_last_visited'=>time()));
        
        $this->session->set_userdata(array($this->config->item('session_user')=>$userinfo));
        $userInfo = $this->users_lib->userInfo();
        // $privilege = $this->config->item('privilege');
        // $url = $privilege[(int)$userInfo['privilege']]['url'];
        // //HuanDT comment
        // if (!$url) {
        //     $url = 'dang-ky-thue-xe';           
        // }
        echo json_encode(array('code'=>1,'html'=>'<div class="alert alert-success">You login successfully!</div>'));
    }

    //logout
    function log_out_fe(){
        $userinfo = $this->session->userdata($this->config->item('session_user'));
        // Acion logout admin
        if($userinfo){
            $this->session->destroy();
            echo json_encode(array('code' => 1));
        }
    }
    //xu ly khi BID
    function actionBid(){
        $price = (int) $this->input->get('price');
        $quantity = (int) $this->input->get('quantity');
        $price_fix = $this->input->get('price_fix');
        
        $this->load->model('gk_model', 'fe_model');
        $datetime = date('Y/m/d H:i:s');
        
        $time_end = $this->fe_model->select_one(FE_SYSTEM_CONFIG,'*',array('name' =>'TIME','key' => 'END_TIME'));       
    
        if ($datetime > $time_end['value']) {
            echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Thông báo</strong>: 
            Hiện đã hết giờ đặt giá!</div>'));
            die;
        }
        
        //check dang nhap
        $userInfo  = $this->users_lib->userInfo();
        if(empty($userInfo)){
            echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Lỗi</strong>: Bạn hãy đăng nhập!</div>'));
            die;
        }
		$userInfo = $this->fe_model->select_one(FE_USER,'*',array('id' =>$userInfo['id']));
        
        if ($price_fix=='true') {            
            $result = $this->fe_model->update(FE_USER,array('ndt_id' =>$userInfo['ndt_id']),array('price_fix' =>$userInfo['sig_deposit_amt']));
            $data = $this->fe_model->select(FE_BID,'max(price) as max_price',array('user_code !=' =>$userInfo['ndt_id']), array());    
		
            
            $price = $data[0]['max_price'];
            if ($price == 0) {
                $price = 1;
            }
            $quantity = floor($userInfo['sig_deposit_amt']/$price);
            /*
            if ($result) {            
                echo json_encode(array('code'=>1,'html'=>'<div class="alert alert-success">Bạn đã đặt lệnh thành công!</div>'));die;
            }else {
                echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Error</strong>: Đặt lệnh thất bại, xin vui 
                    lòng liên hệ quản trị</div>'));die;
            }*/
            
        }else {
            $this->fe_model->update(FE_USER,array('ndt_id' =>$userInfo['ndt_id']),array('price_fix' =>0));
        }
        //
        if($price == '' || $price < 2000){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Lỗi</strong>: Bạn hãy nhập giá, làm tròn hang nghìn!</div>'));
            die;
        }
        if($quantity == '' || $quantity == 0){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Lỗi</strong>: Bạn hãy nhập số lượng cổ phần là số!</div>'));
            die;
        }
        /*if($quantity % 10 != 0){
              echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Lỗi</strong>: Bạn hãy nhập số lượng cổ phần là bội của 10!</div>'));
            die;
        }*/
    
		 
		 
        if ($userInfo['sig_deposit_amt'] < $price*$quantity) {
            echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Lỗi</strong>: 
                Giá đặt tối đa ko được quá số tiền ký quỹ</div>'));
            die;
        }
        
        $dataInsert = array(
            'user_code' => $userInfo['ndt_id'],
            'price' => $price,
            'num_stocks' => $quantity,
            'time_created' => time()
        );
        //check user da bid hay chua
        $checkB = $this->fe_model->select_one('tbl_bid','id', array('user_code' => $userInfo['ndt_id']));
        if(!empty($checkB)){
            //update
            $updateBid = $this->fe_model->update('tbl_bid',array('id' => (int)$checkB['id']), array('price' => $price,'num_stocks' => $quantity,'time_created' => time()));
            if($updateBid){
                //data hist
                $dataH = array(
                    'user_code' => $userInfo['ndt_id'],
                    'price' => $price,
                    'num_stocks' => $quantity,
                    'time_created' => time()
                );
                $insertH = $this->fe_model->insert('tbl_bid_hist', $dataH);
                $update = $this->fe_model->update(FE_USER,array('ndt_id' => $userInfo['ndt_id']),
                     array('price_current' => $price));
                echo json_encode(array('code'=>1,'html'=>'<div class="alert alert-success">Bạn đã đặt lệnh thành công!</div>'));
                
            //Update nhung truong hop khac:
            $userSpc = $this->fe_model->select(FE_USER,'*',array('price_fix >' => 0));
            if (!empty($userSpc)) {
                $newUserSpc = array();
                if ($price == 0) {
                    $price = 1;
                }
                foreach($userSpc as $one) {
                    $newUserSpc[$one['ndt_id']] = $one;
                    //Kiem tra price
                    $this->fe_model->update(FE_BID,array('price <' => $price,'user_code' =>$one['ndt_id']),array('price' => $price,
                        'num_stocks' => floor($one['sig_deposit_amt']/$price)
                    ));
                }
            }
            
            
                die;
            }else{
                echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Error</strong>: Đặt lệnh thất bại, xin vui lòng thử lại!</div>'));die;
            }
        }else{
            $insert = $this->fe_model->insert('tbl_bid', $dataInsert);
            if($insert){
                //data hist
                $dataH = array(
                    'user_code' => $userInfo['ndt_id'],
                    'price' => $price,
                    'num_stocks' => $quantity,
                    'time_created' => time()
                );
                $insertH = $this->fe_model->insert('tbl_bid_hist', $dataH);
                $update = $this->fe_model->update(FE_USER,array('ndt_id' => $userInfo['ndt_id']), array('price_current' => $price));
                
                $userSpc = $this->fe_model->select(FE_USER,'*',array('price_fix !=' => 0));
                if (!empty($userSpc)) {
                    $newUserSpc = array();
                    if ($price == 0) {
                        $price = 1;
                    }
                    foreach($userSpc as $one) {
                        $newUserSpc[$one['ndt_id']] = $one;
                        //Kiem tra price
                        $this->fe->model->update(FE_BID,array('price <' => $price,'user_code' =>$one['ndt_id']),array('price' => $price,
                            'num_stocks' => floor($one['sig_deposit_amt']/$price)
                        ));
                    }
                }
            
                echo json_encode(array('code'=>1,'html'=>'<div class="alert alert-success">Bạn đã đặt lệnh thành công!</div>'));die;
            }else{
                echo json_encode(array('code'=>0,'html'=>'<div class="alert alert-danger"><strong>Error</strong>: Đặt lệnh thất bại, xin vui lòng thử lại!</div>'));die;
            }
        }
    }
    
    function update_config(){
         $user_info  = $this->users_lib->adminInfo();
        if($user_info['role'] != 1){
            die;
        }
        $this->load->model('gk_model', 'fe_model');
        $tmp_num_stock = $this->input->get('tmp_num_stock');
        
        
        if($this->fe_model->update(FE_SYSTEM_CONFIG,array('name'=>'SO_LUONG_CP','key' => 'SO_LUONG'),array('value' =>$tmp_num_stock) ))
        {
            //xoa lich su bid           
    	    echo json_encode(array('code' => 1,'msg' => 'Success'));
        }
        else
        {
    	    echo json_encode(array('code' => 0,'msg' => 'Error when process'));
        }
    }
}
?>