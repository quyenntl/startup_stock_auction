<?php
 class Users_Lib{
    private $CDT;
    private $user_info;
    private $admin_info;
    /**
     * Khởi tạo con trỏ CDT
     */    
    function __construct(){
        $this->CDT = &get_instance(); 
        $this->CDT->load->library('session');
        $this->user_info = $this->CDT->session->userdata($this->CDT->config->item('session_user'));
        $this->admin_info = $this->CDT->session->userdata($this->CDT->config->item('session_user_ad'));
    }
    
    /**
     * create old password
     * @author  KienNT
     */
    function oldPassword($password){
        return md5 ( $password.$this->CDT->config->item('encryption_key') );
    }
    /**
	 *	encodePassword
	 */
	function encodePassword($password,$salt) {
		return md5 ($password.$salt);
    }
    
    /**
	 * Get Salt Password
     * @author  KienNT
	 */
	function saltPassword() {
		return substr(md5(time()),6,5);
	}
    /**
    * sinh code de dang nhap
    */
    function genarateCode($length = 8){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper ($randomString);
    }
    
    /**
     * Check user Admin and get info Admin
     * 
     * Hàm thực hiện kiểm tra xem user hiện tại phải là admin hay không
     * @return true or false
     */ 
    function adminInfo(){
        $user_id = $this->admin_info['id'];
        if($user_id > 0 && ($this->admin_info['role'] == 1))
        {
            return $this->admin_info;        
        }
        
        else return false;
    }
    
    /**
     * Check user and get info
     * 
     * @author  KienNT
     * Hàm thực hiện kiểm tra xem user hiện tại đăng nhập chưa và trả thông tin user về
     * @return content (Array) or false
     */ 
    function userInfo(){
        $user_id = $this->user_info['id'];
        if($user_id > 0)
        {
            return $this->user_info;        
        }
        
        else return false;
    }
    
    /**
     * Check Privilege Admin
     * 
     * @author  KienNT
     * Hàm thực hiện kiểm tra xem có quyền vô module này không? và có những quyền gì?
     * @return content (Array) or false
     */ 
    function AdminPrivilege($code){
        
        $user_id = $this->user_info['id'];
        
        if($user_id > 0 && $this->user_info['privilege'] == 2)
        {
            return array('add' => 1, 'edit' => 1, 'del' => 1, 'active' => 1);
        }
        elseif($user_id > 0 && $this->user_info['privilege'] == 3 && $code)
        {           
            $this->CDT->load->cache(array("adapter" => "file","cache_path" => CACHE_PATH.'privilege'.DS));
            $content = $this->CDT->cache->get($user_id.".depzai");
            
            if($content){
                return $content[$code];
            }
            else{
                $content = $this->CacheAdminPrivilege();
                if($content)
                {
                    return $content[$code];
                }
                return false;
            }
        }
        
        else return false;
    }
    
    /**
     * Cache quyen Admin
     * 
     * @author  KienNT
     * Hàm thực hiện Cache cac quyen Admin trong thoi gian lam viec
     * @return content (Array) or false
     */ 
    function CacheAdminPrivilege($id = ''){
        
        $user_id = ($id=='') ? $this->user_info['id'] : $id;
        
        if(($user_id > 0 && ($this->user_info['privilege'] == 3) || $id))
        {
        
            $this->CDT->load->database('sysdb','sysdb');
           
            $sql = "SELECT p.code, u.add,u.edit,u.del,u.active FROM ".SYS_PRIVILEGE." p RIGHT JOIN ".SYS_USER_PRIVILEGE." u ON p.id = u.privilege_id WHERE u.userid = ".$user_id;
            $result = $this->CDT->sysdb->query($sql)->result_array();
            
            $quyen = array();
            
            foreach($result as $value)
            {
                $quyen[$value['code']] = $value;
            }

            if($quyen){

                $this->CDT->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'privilege'.DS));

                $this->CDT->cache->save($user_id.".depzai",$quyen);
                
                return $quyen;
            }
            else{
                return false;
            }
        }
        
        else return false;
    }
    //Hàm tạo fulladdress từ id tỉnh thành, quận huyện
    function fulladdress($zone_id, $district_id, $address)
    {
        $this->CDT->load->library('cache_local');
        $zone_list     = $this->CDT->cache_local->city();
        $district_list = $this->CDT->cache->get($zone_id.'.cache');
        return $address . ', ' . $district_list[$district_id] . ', ' . $zone_list[$zone_id];
    }
    
    /**
     * Chức năng tự đăng ký tài khoản cho người dùng khi người dùng thực hiện chức năng openId
     * Cập nhật thông tin vào user, user_info
     * @param $arrayInfo: mảng thông tin người dùng cập nhật. Key = trường insert, value: giá trị insert

     */
    function register_openid($arrayInfo=array()){
        if(empty($arrayInfo) && !is_array($arrayInfo))
            return 'NOT_CONDITION';
        if(!isset($arrayInfo['email']))
            return 'EMAIL_NULL';
        $email = $arrayInfo['email'];
        $arrayInfo['password'] = strtolower(substr(md5($email.$this->CDT->config->item('encryption_key')),0,6));
        $password = $this->endcodePassAuto($email);
        if($email == '')
            return 'EMAIL_EXISTS';
        $this->CDT->load->model('users_model','user_global');
        $check_data = $this->CDT->user_global->checkExistEmail($email);
        if($check_data) // Đã tồn tại email
            return 'SUCCESS';
        include 'userFieldConfig.php';
        $listFieldUserGlobal        = array();
        $listFieldUserInfo      = array();
        $listFieldUserSeller    = array();  
        foreach($arrayInfo AS $key => $value){ // Kiểm tra xem những trường nào được cập nhật vào db
            if(isset($config_user_global_field_array[$key]))
			    if ($config_user_global_field_array[$key]==1)
				   $listFieldUserGlobal[$key] = $value;		
            if(isset($config_user_info_field_array[$key]))
			    if ($config_user_info_field_array[$key]==1)
				   $listFieldUserInfo[$key] = $value;
        }
        // Cập nhật vào user_global để lấy user id
        $listFieldUserGlobal['active_code'] = '';
        $listFieldUserGlobal['status'] = 1;
        $listFieldUserGlobal['password'] = $password;
        $listFieldUserGlobal['time_update'] = $listFieldUserGlobal['time_create'] = time();
        $this->CDT->load->model('users_model','user_global');
        $id = $this->CDT->user_global->insertData($listFieldUserGlobal);
        if(!$id)
            return false;
        $user_id = $this->CDT->userapi->getUserid('',$listFieldUserGlobal['email']);
        $listFieldUserInfo['user_id'] = $listFieldUserSeller['user_id'] = $user_id;        
        $this->CDT->load->model('user_info_model','user_info');
        $this->CDT->user_info->insertData($listFieldUserInfo);
         //cộng gold ở đây 
        $this->CDT->load->library('ApiGoldPoint');
        $new_gold = $this->CDT->apigoldpoint->update_gold_point($user_id,'GOLD_REGIST_ACC');
        
        // Gửi notifi
        $this->CDT->load->library('ApiNotification');
        $this->CDT->apinotification->send('GOLD_REGIST_ACC',array('user_id' => $user_id, 'email' => $email),array('gold' => $new_gold));
        // Thực hiện gửi email kích hoạt tài khoản cho user
        $arrDataEmail = array(
                    'code'      =>  'AUTO_CREATE_ACCOUNT_OPENID',
                    'title'     =>  '',
                    'content'   =>  array(
                                        'password'      =>  $arrayInfo['password'],
                                        'email'         =>  $email,
                                        'full_name'     =>  $arrayInfo['full_name'] ? $arrayInfo['full_name'] : $email 
                                    )
                );
        $this->CDT->load->library('MailClass',$arrDataEmail);
        $email = $arrayInfo['email'];
		$arrConfig = array ('toEmail' => $email, 'toName' => $arrayInfo['full_name'], 'priority' => 1 );
        $this->CDT->mailclass->dispatch($arrConfig);
        //end
        return 'SUCCESS';
    }
    /**
     * Chức năng đăng ký tài khoản người dùng chỉ check điều kiện với email
     * Cập nhật thông tin vào user, user_info
     * Nếu là người bán thì cập nhật vào user_seller nữa
     * @param $arrayInfo: mảng thông tin người dùng cập nhật. Key = trường insert, value: giá trị insert
     * @param $is_seller: Là người bán hay ko
     */
    function register($arrayInfo=array(),$is_seller=false){
        require_once 'userFieldConfig.php';
        
        if(empty($arrayInfo) && !is_array($arrayInfo))
            return 'NOT_CONDITION';
        $password = $this->encodePassword($arrayInfo['password']);
        if(!isset($arrayInfo['email']))
            return 'EMAIL_NULL';
        $email = $arrayInfo['email'];
        if($email == '')
            return 'EMAIL_EXISTS';
        $this->CDT->load->model('users_model','user_global');
        $check_data = $this->CDT->user_global->checkExistEmail($email);
        if($check_data) // Đã tồn tại email
            return 'EMAIL_EXISTS';
        $active_code = $this->getActiveCode($arrayInfo['email']);
        
        $listFieldUserGlobal        = array();
        $listFieldUserInfo      = array();
        $listFieldUserSeller    = array();  
        foreach($arrayInfo AS $key => $value){ // Kiểm tra xem những trường nào được cập nhật vào db
            if(isset($config_user_global_field_array[$key]))
			    if ($config_user_global_field_array[$key]==1)
				   $listFieldUserGlobal[$key] = $value;		
            if(isset($config_user_info_field_array[$key]))
			    if ($config_user_info_field_array[$key]==1)
				   $listFieldUserInfo[$key] = $value;
            if(isset($config_user_seller_field_array[$key]))
			    if ($config_user_seller_field_array[$key]==1)
				   $listFieldUserSeller[$key] = $value;
        }
        // Cập nhật vào user_global để lấy user id
        $listFieldUserGlobal['active_code'] = $active_code;
        $listFieldUserGlobal['password'] = $password;
        $listFieldUserGlobal['time_update'] = $listFieldUserGlobal['time_create'] = time();
        $this->CDT->load->model('users_model','user_global');
        $id = $this->CDT->user_global->insertData($listFieldUserGlobal);
        if(!$id)
            return false;
        $user_id = $this->CDT->userapi->getUserid('',$listFieldUserGlobal['email']);
        $listFieldUserInfo['user_id'] = $listFieldUserSeller['user_id'] = $user_id;        
        $this->CDT->load->model('user_info_model','user_info');
        $this->CDT->user_info->insertData($listFieldUserInfo);
        if($is_seller === true){
            $this->CDT->load->model('user_seller_model','user_seller');
            $listFieldUserSeller['mobile'] = $arrayInfo['mobile_phone'];
            $listFieldUserSeller['seller_name'] = $arrayInfo['full_name'];
            $this->CDT->user_seller->insert_data($listFieldUserSeller);
        }
        //cộng gold ở đây 
        $this->CDT->load->library('ApiGoldPoint');
        $new_gold = $this->CDT->apigoldpoint->update_gold_point($user_id,'GOLD_REGIST_ACC');
        
        // Gửi notifi
        $this->CDT->load->library('ApiNotification');
        $this->CDT->apinotification->send('GOLD_REGIST_ACC',array('user_id' => $user_id, 'email' => $email),array('gold' => $new_gold));
        // Thực hiện gửi email kích hoạt tài khoản cho user
        $arrDataEmail = array(
                    'code'      =>  'REGISTER_ACCOUNT',
                    'title'     =>  '',
                    'content'   =>  array(
                                        'fullname'     =>  $arrayInfo['full_name'],
                                        'linkActive'    =>  active_email($active_code)
                                    )
                );
        $this->CDT->load->library('MailClass',$arrDataEmail);
        $email = $arrayInfo['email'];
		$arrConfig = array ('toEmail' => $email, 'toName' => $arrayInfo['full_name'], 'priority' => 1);
        $this->CDT->mailclass->dispatch($arrConfig);
        //end
        return $user_id;
    }
    /**
     * Hàm cập nhật GOLD
     *
     */
    function update_glod($user_id=0,$gold=0){
        if($user_id == 0 || $gold == 0)
            return false;
        $this->CDT->load->model('user_info_model');
        return $this->CDT->user_info_model->update_glod_new($user_id,$gold);
    }
    /**
     * Hàm thực hiện chức năng cập nhật thông tin người dùng theo điều kiện truyền vào
     */
    function update($arrayInfo=array(),$user_id=0){
        if(empty($arrayInfo) || is_array($arrayInfo) == false)
            return false;
       
        if($user_id == 0)
            return false;
        if(isset($arrayInfo['seller_name']) && !isset($arrayInfo['full_name']))
            $arrayInfo['full_name'] = $arrayInfo['seller_name'];
        if(!isset($arrayInfo['seller_name']) && isset($arrayInfo['full_name']))
            $arrayInfo['seller_name'] = $arrayInfo['full_name'];
        if(isset($arrayInfo['seller_name']) && isset($arrayInfo['full_name']))
            $arrayInfo['full_name'] = $arrayInfo['seller_name'];
        if(isset($arrayInfo['password'])){
            $password = $this->encodePassword($arrayInfo['password']);
            $arrayInfo['password'] = $password;
        }
        include 'userFieldConfig.php';
        $listFieldUserGlobal        = array();
        $listFieldUserInfo      = array();
        $listFieldUserSeller    = array();  
        foreach($arrayInfo AS $key => $value){ // Kiểm tra xem những trường nào được cập nhật vào db
            if(isset($config_user_global_field_array[$key]))
			    if ($config_user_global_field_array[$key]==1)
				   $listFieldUserGlobal[$key] = $value;		
            if(isset($config_user_info_field_array[$key]))
			    if ($config_user_info_field_array[$key]==1)
				   $listFieldUserInfo[$key] = $value;
            if(isset($config_user_seller_field_array[$key]))
			    if ($config_user_seller_field_array[$key]==1)
				   $listFieldUserSeller[$key] = $value;
        }
        $check_update = true;
        // Cập nhật vào user_global để lấy user id
        if(!empty($listFieldUserGlobal)){
            $listFieldUserGlobal['time_update'] = time();
            $this->CDT->load->model('users_model','user_global');
            $id_global = $this->CDT->user_global->updateItem($user_id,$listFieldUserGlobal);
            if(!$id_global)
                $check_update = false;
        }
        if(!empty($listFieldUserInfo)){
            $this->CDT->load->model('user_info_model','user_info');
            $id_info = $this->CDT->user_info->updateItem($user_id,$listFieldUserInfo);
            if(!$id_info)
                $check_update = false;
        }
        if(!empty($listFieldUserSeller)){
            $this->CDT->load->model('user_seller_model','user_seller');
            $id_seller = $this->CDT->user_seller->update_data_by_user_id($listFieldUserSeller,$user_id);
            if(!$id_seller)
                $check_update = $listFieldUserSeller;
        }
        return $check_update;
    }
    /**
     * Hàm thực hiện chức năng active email cho tài khoản cho người dùng
     */
    function active_email($active_code = ''){
        if($active_code == '')
            return 'NO_CONDITION';
        $this->CDT->load->model('users_model','user_global');
        $data_info = array();
        $data = array();
        $data_info = $this->CDT->user_global->get_data_by_condition('id ,active_code, status',array('active_code' => $active_code));
        if(empty($data_info))
            return 'DATA_NOT_EXISTS';
        $data = $data_info[0];
        $user_id = $data['id'];
        $condition = array('status' => 1,'active_code' => '');
        if($this->update($condition,$user_id)){
            $userCurrent = $this->CDT->userapi->isLogin();
            if($userCurrent && $userCurrent['id'] == $user_id){
                $userCurrent['status'] = 1;
                $userCurrent['active_code'] = '';
                $this->CDT->session->set_userdata(array($this->CDT->config->item('session_user')=>$userCurrent));
            }
            return 'SUCCESS';
        }
        return 'FAIL';
    }
    /**
     * Hàm thực hiện chức năng đăng nhập tài khoản người dùng
     * @param $email và $pass do user nhập
     */
    function login($email = '',$pass = '',$save_pass=0,$open_id=false){
        if($open_id == false)
            if($email == '' || $pass == '')
                return 'NOT_CONDITION';
        $pass_check = $this->encodePassword($pass);
        $this->CDT->load->model('users_model','user');
        $condition = array('email' => $email);
        $userGlobal = array();
        $userGlobal = $this->CDT->user->get_data_by_condition('*',$condition);
        if(!empty($userGlobal)){
            $data_new = $userGlobal[0];
            $pass_getDB = $data_new['password'];
            if($pass_check == $pass_getDB || $open_id == true){
                // Kiểm tra xem user có bị khóa không
                if($this->check_lock($data_new['id'])){
                    return 'USER_CURRENT_LOCK';
                }
                // Thỏa mãn thì tạo session
                $this->CDT->load->library('session');
                $user_info = $this->CDT->userapi->getUser('*',$data_new['id']);
                //Check và công gold
                $time_current = time();
                $time_last_login = $user_info['time_last_login'];
                
                $dayEnd = strtotime(date('d-m-Y',$time_last_login).' 23:59:59');
                if($time_current > $dayEnd){
                    //cộng gold ở đây 
                    $this->CDT->load->library('ApiGoldPoint');
                    $new_gold = $this->CDT->apigoldpoint->update_gold_point($data_new['id'],'GOLD_LOGIN');
                    
                    // Gửi notifi
                    $this->CDT->load->library('ApiNotification');
                    $this->CDT->apinotification->send('GOLD_LOGIN',array('user_id' => $data_new['id'], 'email' => $data_new['email']),array('gold' => $new_gold));
                    
                    //Tao lai session
                    $user_info['gold'] = $user_info['gold'] + $new_gold; 
                }
                
                //update thời gian đăng nhập
                $this->update(array('time_last_login' => $time_current),$data_new['id']);
                //end
                if(!isset($user_info['full_name']))
                    $user_info['full_name'] = '';
                $user_info['time_last_login'] = $time_current;
                $this->CDT->session->set_userdata(array($this->CDT->config->item('session_user')=>$user_info));
                if($save_pass == 1){
                    $cookieName = $this->CDT->config->item('sess_cookie_name');
        			$cookieValue = $email.'|'.$this->encodePassword($pass);
        			$cookieExpire = $this->CDT->config->item('sess_expiration');
        			$this->CDT->input->set_cookie(array('name'=>$cookieName, 'value'=>$cookieValue, 'expire'=>$cookieExpire));
                }
                return 'SUCCESS';
            }
            return 'FAIL_PASS';
        }
        return 'NOT_EXISTS_USER';
    }
    /**
     * Thực hiện chức năng kiểm tra user có bị khóa hay ko
     * Nếu ko bị khóa thì return true
     * Nếu đang bị khóa thì check xem đã hết thời gian khóa chưa
     *          - Nếu chưa hết thời gian khóa thì return false
     *          - Nếu hết thời gian khóa thì tự động mở cho user này
     * 
     * @copyright Đọc kỹ hướng dẫn trước khi sửa hàm này
     * @return  false: Là không khóa
     *          true: Là đang khóa và một số trường hợp lỗi
     */
    function check_lock($user_id=0){
        // Lấy trạng thái lock của user
        if($user_id == 0)
            return true;
        $user_info = array();
        $user_info = $this->CDT->userapi->getUser('id ,active_code, status',$user_id);
        if(empty($user_info))
            return true;
        $status = $user_info['status'];
        if($status == 0 || $status == 1)
            return false;// Không phải đang khóa
        // Lấy thông tin bị khóa chi tiết của user
        $this->CDT->load->model('user_lock_model','user_lock');
        $data_user_lock  = array();
        $data_user_lock = $this->CDT->user_lock->checkUserId($user_id);
        if(empty($data_user_lock))
            return true; // Xem như user bị khóa vĩnh viễn
        $type_lock = $data_user_lock['type'];
        if($type_lock == 2)
            return true; // Đang khóa vĩnh viễn
        $time_start = $data_user_lock['time_start'];
        $time_end = $data_user_lock['time_end'];
        $time_current = time();
        // Kiểm tra khoảng thời gian khóa user để tự động mở khóa cho user
        if($time_current >= $time_start && $time_current <= $time_end) // Đang trong thời khóa
            return true;
        if($time_current < $time_start)
            return false;
        if($time_current > $time_end){
            // Ngoài khoảng thời gian khóa thì thực hiện mở khóa cho user
            $unlock_user = $this->unlock($user_id);
            if($unlock_user)
                return false;// Mở khóa thành công
            return true;
        }
    }
    /**
     * Thực hiện chức năng khóa tài khoản người dùng
     * Theo điều kiện truyền vào: Khóa theo khoảng thời gian hoặc khóa vĩnh viễn
     * @param $date_begin, $date_end: dang dd/mm/yyyy
     */
    function lock($user_id=0,$date_begin=0,$date_end=0,$type_lock=1,$comment=''){
        if($user_id == 0)
            return 'NOT_CONDITION';
        if($type_lock == 1){
            // Kiểm tra khoảng thời gian
            $time_begin = $this->toTime("0:0:0 ".$date_begin);
            $time_end = $this->toTime("23:59:59 ".$date_end);
            if ($time_begin >= $time_end or $time_end < time())
                return 'CONDITION_FAIL';
        }else{
            $time_begin = $this->toTime("0:0:0 ".$date_begin);
        }
        $this->CDT->load->model('users_model','user');
        $condition = array('status' => 2);
        if($this->CDT->user->updateItem($user_id,$condition)){
            // Cập nhật vào user_lock
            $this->CDT->load->model('user_lock_model','user_lock');
            $array_info = array(
                            'time_start'    =>  $time_begin,
                            'time_end'      =>  $time_end,
                            'user_id'       =>  $user_id,
                            'type'          =>  $type_lock,
                            'comment'       =>  $comment
                        );
            $getEmail = $this->CDT->userapi->getUser('*',$user_id);
            $email = $getEmail['email'];
            if($type_lock == 1)
                $arrDataEmail = array(
                            'code'      =>  'LOCK_ACCOUNT',
                            'title'     =>  '',
                            'content'   =>  array(
                                                'fullname'         =>  $getEmail['full_name'],
                                                'email'         =>  $email,
                                                'time_start'    =>  $date_begin,
                                                'time_end'      =>  $date_end,
                                                'note'          =>  $comment
                                            )
                        );
            else //LOCK_USER_FULL_TIME
                $arrDataEmail = array(
                            'code'      =>  'LOCK_ACCOUNT_FULL',
                            'title'     =>  '',
                            'content'   =>  array(
                                                'fullname'         =>  $getEmail['full_name'],
                                                'email'         =>  $email,
                                                'time_start'    =>  $date_begin,
                                                'note'          =>  $comment
                                            )
                        );
            $this->CDT->load->library('MailClass',$arrDataEmail);
    		$arrInfo = array ('toEmail' => $email, 'toName' => $getEmail['full_name'], 'priority' => 1 );
            $send_mail = $this->CDT->mailclass->dispatch($arrInfo);
            //end
            $update_lock = $this->CDT->user_lock->insertData($array_info);
            if($update_lock){
                if($send_mail)
                    return 'SUCCESS';
                return $send_mail;
            }
            return 'UPDATE_LOCK_FAIL';             
        }
        return 'UPDATE_GLOBAL_FAIL';    
    }
    /**
     * hàm thực hiện chức năng mở khóa cho người dùng
     */
    function unlock($user_id){
        $this->CDT->load->model('users_model','user');
        $user_info = array();
        $user_info = $this->CDT->user->getOne($user_id);
        if(empty($user_info))
            return 'NOT_CONDITION';
        $active_code = $user_info['active_code'];
        // hai trường hợp này sẽ có 2 email gửi đi với nội dụng khác nhau
        if($active_code != '')
            $condition = array('status' => 0);
        else
            $condition = array('status' => 1);
        if($this->CDT->user->updateItem($user_id,$condition)){
            // Xóa ở bảng user_lock
            $this->CDT->load->model('user_lock_model','user_lock');
             // Thực hiện gửi email kích hoạt tài khoản cho user
            $getEmail = $this->CDT->userapi->getUser('*',$user_id);
            $email = $getEmail['email'];
            $arrDataEmail = array(
                        'code'      =>  'OPEN_ACCOUNT',
                        'title'     =>  '',
                        'content'   =>  array(
                                            'fullname'        =>  $getEmail['full_name'],
                                            'email'        =>  $email,
                                            'time_start'   =>  date('d/m/Y',time())
                                        )
                    );
            $this->CDT->load->library('MailClass',$arrDataEmail);
    		$arrConfig = array ('toEmail' => $email, 'toName' => $getEmail['full_name'], 'priority' => 1 );
            $send_mail = $this->CDT->mailclass->dispatch($arrConfig);
            //end
            $update_lock = $this->CDT->user_lock->delUserId($user_id);
            if($update_lock){
                if($send_mail)
                    return 'SUCCESS';
                return $send_mail;                                    
            } 
            return 'UPDATE_LOCK_FAIL';               
        }
        return 'UPDATE_GLOBAL_FAIL';       
    }
    /**
	 * @desc Ham chuyen doi chuyen doi ngay thang kieu "H:i:s dd/mm/yyyy" hoac "dd/mm/yyyy" sang giay
	 * @access public
	 * @param $dateTime la chuoi co kieu "H:i:s dd/mm/yyyy" hoac "dd/mm/yyyy" 
	 * @return int (so giay)
	 * @note voi chuoi "H:i:s" co the bo qua tham so giay (s), phut (i)
	 * @throws exception "chuoi truyen vao khong dung dinh dang"
	 */
	function toTime($dateTime) {
		$hour = array (0 => 0, 1 => 0, 2 => 0 );
		$dateMonth = array (0 => 0, 1 => 0, 2 => 0 );
		$arr = explode ( ' ', $dateTime );
		if (is_array ( $arr ) && sizeof ( $arr ) > 1) {
			// chuyen doi "H:i:s" sang giay
            $hour = explode ( ':', $arr [0] );
			$dateMonth = explode ( '/', $arr [1] );
		} else {
			$dateMonth = explode ( '/', $dateTime );
		}
		try {
			return mktime ( $hour [0], $hour [1], $hour [2], $dateMonth [1], $dateMonth [0], $dateMonth [2] );
		
		} catch ( Exception $e ) {
			return 0;
		}
	}
    /**
     * Hàm thực hiện chức năng gửi lại mã kích hoạt cho user
     * @param $email
     */
    function ref_email_active($email=''){
        if($email == '')
            return 'NOT_CONDITION';
        // Kiểm tra xem email này đã tồn tại trong hệ thống hay chưa
        $this->CDT->load->model('users_model','user_global');
        $checkData = $this->CDT->user_global->checkExistEmail($email);
        if($checkData){ // Đã tồn tại email
            $userInfo = $checkData[0];
            if($userInfo['status'] == 1){
                return 'ACTIVED';
            }else{
                $active_code = $checkData[0]['active_code'];
                if($active_code == '')
                    $active_code = $this->getActiveCode($email);
                $full_name = $this->CDT->userapi->getFullName(0,$email);
                $this->CDT->user_global->update_data(array('active_code' => $active_code),$userInfo['id']);
                 // Thực hiện gửi email kích hoạt tài khoản cho user
                $arrDataEmail = array(
                            'code'      =>  'ACTIVE_ACCOUNT',
                            'title'     =>  '',
                            'content'   =>  array(
                                                 'fullname'      =>  $full_name,
                                                 'linkActive'    =>  active_email($active_code)
                                        )
                        );
                $this->CDT->load->library('MailClass',$arrDataEmail);
                if(!$userInfo['full_name'])
                    $userInfo['full_name'] = $email;
        		$arrConfig = array ('toEmail' => $email, 'toName' => $userInfo['full_name'], 'priority' => 1);
                $send_mail = $this->CDT->mailclass->dispatch($arrConfig);
                //end
                return 'SUCCESS';
            }
        }
        return 'EMAIL_NOT_EXISTS';
    }
    /**
     * policy quên mật khẩu: User nhập email => sinh ra mã code => đến trang sinh mật khẩu
     * Hàm thực hiện chức năng quên mật khẩu user
     * @param $email
     */
    function forget_pass($email=''){
        if($email == '')
            return 'NOT_CONDITION';
        // Kiểm tra xem email này đã tồn tại trong hệ thống hay chưa
        $this->CDT->load->model('users_model','user_global');
        $checkData = $this->CDT->user_global->checkExistEmail($email);
        if($checkData){ // Đã tồn tại email
            $userInfo = $checkData[0];
            $full_name = $this->CDT->userapi->getFullName(0,$email);
            $code_active = $userInfo['active_code'];
            if($active_code == '')
                $code_active = $this->getActiveCode($email);
            $this->CDT->user_global->update_data(array('lost_pass_code' => $code_active),$userInfo['id']);
             // Thực hiện gửi email kích hoạt tài khoản cho user
            $arrDataEmail = array(
                        'code'      =>  'GET_PASSWORD',
                        'title'     =>  '',
                        'content'   =>  array(
                                            'fullname'     =>  $full_name ? $full_name : $email,
                                            'linkGetPass'   =>  resend_pass($code_active)
                                        )
                    );
            $this->CDT->load->library('MailClass',$arrDataEmail);
            if(!$full_name)
                $full_name = $email;
    		$arrConfig = array ('toEmail' => $email, 'toName' => $full_name, 'priority' => 1);
            $send_mail = $this->CDT->mailclass->dispatch($arrConfig);
            //end
            return 'SUCCESS';
        }
        return 'EMAIL_NOT_EXISTS';
    }
    /**
     * Hàm thực hiện chức năng kiểm tra code gửi lại mật khẩu có đúng không
     * nếu đùng thì trả về thông tin user cần dùng: email, full_name, user_id
     * nếu sau thì trả về false
     */
    function check_code_resend_pass($codeResend=''){
        if($codeResend == ''){
            return false;
        }
        $this->CDT->load->model('users_model','user_global');
        $userData = $this->CDT->user_global->get_data_by_condition('id,email',array('lost_pass_code' => $codeResend));
        if(!empty($userData)){
            return $userData;
        }
        return false;
               
    }
    /**
     * Hàm thực hiện so sánh và cập nhật mật khẩu của user khi thực hiện quên mật khẩu
     * Hàm sử dụng khi user sử dụng chức năng quên mật khẩu
     */
    function create_pass_forget($user_id='',$new_pass = ''){
        if($user_id == '' || $new_pass == '')
            return 'NOT_CONDITION';
        $this->CDT->load->model('users_model','user_global');
        $check_data = $this->CDT->user_global->getOne($user_id);
        if($check_data){
            // Tồn tại dữ liệu
            $new_pass = $this->encodePassword($new_pass);
            $condition = array('password' => $new_pass,'lost_pass_code' => '');
            // cập nhật lại
            $this->CDT->user_global->updateItem($user_id,$condition);
            // Xóa key
           // $this->CDT->load->model('lost_pass_model','lost_pass');
//            $this->CDT->lost_pass->delete_data(array('email' => $check_data['email']));
            return 'SUCCESS';
        }
        return 'USER_NOT_EXISTS';
    }
    /**
     * Hàm thực hiện chức năng đổi mật khẩu của user
     */
    function change_pass($user_id='',$old_pass='',$new_pass='',$refer_pass = ''){
        if($user_id == '' || $old_pass == '' || $new_pass == '' || $refer_pass == '')
            return 'NOT_CONDITION';
        $this->CDT->load->model('users_model','user_global');
        $check_data = $this->CDT->user_global->getOne($user_id);
        if($check_data){// Tồn tại dữ liệu
            $pass_current = $check_data['password'];
            if($pass_current == $this->encodePassword($old_pass)){
                if($new_pass == $refer_pass){
                    $new_pass = $this->encodePassword($new_pass);
                    $condition = array('password' => $new_pass);
                    // cập nhật lại
                    $this->CDT->user_global->updateItem($user_id,$condition);
                    return 'SUCCESS';
                }
                return 'PASS_NOT_EQUAL';
            }
            return 'PASS_OLD_FAIL';            
        }
        return 'USER_NOT_EXISTS';
    }
    /**
     * Hàm thực hiện chức năng add email do user đăng ký vào danh sách nhận thông báo (receive_newsletter)
     */
     function receive_newsletter(){
        return true;
     }
     /**
      * Hàm thực hiện ghi log hoạt động của người dùng trong quản trị
      **/
     function log_action($user_id='', $module='', $action='', $link='') {
        if($user_id == '' || $module == '' || $action == '')
            return 'NOT_CONDITION';
        $this->CDT->load->model('users_model','user_global');
        $check_data = $this->CDT->user_global->getOne($user_id);
        if($check_data){
            $this->CDT->load->model('log_user_admin_model','log_user_admin');
            $data = array(
                'user_id' => $user_id,
                'time_create' => time(),
                'module' => $module,
                'action' => $action,
                'link' => $link
            );
            $this->CDT->log_user_admin->insert_data($data);
            return 'SUCCESS';
        }
        return 'USER_NOT_EXISTS';
     } 
     /**
      * @param user_name => email on CDT => check exit on 1top => 
      *     IF exit => login
      *     ELESE   => regesit user and login
      */
     function login_cdt($userName = '',$pass = ''){
        if($userName == '' || $pass == '')
            return json_encode(array('code' => 0,'html' => 'Thông tin đăng nhập không đầy đủ'));
        // Đăng nhập
        $arrParamWS = array('user_name' => $userName,'pass' => $pass);
        require_once ROOT_PATH.DS.'application/nusoap.php';
        $PASS_LG = 'MOBILE_CDT';        
        $soapClient = new nusoapclient(CDT_WEBSERVICE, 'wsdl');
        $dataWS = $soapClient->call( 'process_name', array ('function_name' => 'userLogin', 'password' => $PASS_LG, 'param' => $arrParamWS ));
        if($dataWS === false)
            json_encode(array('code' => 0,'html' => 'Có lỗi trong quá trình xử lý! Xin vui lòng thử lại!'));
        
        $arrData = json_decode($dataWS,true);
        if($arrData['code'] != 1){
            return json_encode(array('code' => 0,'html' => $arrData['html']));
        }
        
        $userInfo = $arrData['html'];
        $email = $userInfo['email'];
        //kiểm tra xem email đã tồn tại chưa
        $this->CDT->load->model('users_model','user_global');
        $check_data = $this->CDT->user_global->checkExistEmail($email);
        if($check_data === false || empty($check_data)){
            // Thực hiện insert dữ liệu vào và đăng nhập cho user
            $arrInsert = array(
                        'email'         =>  $email,
                        'full_name'     =>  $userInfo['full_name'] ? $userInfo['full_name'] : substr($email,0,strpos('@',$email)),
                        'mobile_phone'  =>  $userInfo['mobile_phone'] ? $userInfo['mobile_phone'] : 0,
                        'address'       =>  $userInfo['address'] ? $userInfo['address'] : '',
                        'zone_id'       =>  $userInfo['zone_id'] ? $userInfo['zone_id'] : '',
                        'nick_skype'    =>  $userInfo['nick_skype'] ? $userInfo['nick_skype'] : '',
                        'nick_ym'       =>  $userInfo['nick_ym'] ? $userInfo['nick_ym'] : ''
                    );
            $this->register_openid($arrInsert);
            //end
        }
        $this->login($email,'',0,true);
        return json_encode(array('code' => 1));
     }
     function save_address($city_id,$district_id,$address){
        $user_info      = $this->CDT->users_lib->userInfo();
        if(empty($user_info)){
            return false;
        }
        $this->CDT->load->model('_frontend_model','frontend_model');
        if($city_id && $district_id && $address){
            $data_update    = array('zone_id'=>$city_id,'district_id'=>$district_id,'address'=>$address,'fulladdress'=>$this->CDT->users_lib->fulladdress($city_id,$district_id,$address));
            if($this->CDT->frontend_model->update(FE_USER,array('id'=>$user_info['id']),$data_update)){
                //Tao lai session
                $user_info['zone_id']   = $city_id;
                $user_info['district_id']   = $district_id;
                $user_info['address']   = $address;
                $user_info['fulladdress']   = $this->CDT->users_lib->fulladdress($city_id,$district_id,$address);
                $this->CDT->session->set_userdata(array($this->CDT->config->item('session_user')=>$user_info));
            }
        }else return false;
     }
     /**
      * Ham update gold
      */ 
     function plus_gold($user_id,$gold){
        $this->CDT->load->model('_frontend_model','frontend_model');
        if($user_id){
            $user_info  = $this->CDT->frontend_model->select_one(FE_USER,'id,gold',array('id'=>$user_id));
            if(!empty($user_info)){
                $new_gold   = $user_info['gold'] + $gold;    
                return $this->CDT->frontend_model->update(FE_USER,array('id'=>$user_info['id']),array('gold'=>$new_gold));                
            }else{
                return false;
            }
        }else{
            return false;
        }
     } 
 }
?>