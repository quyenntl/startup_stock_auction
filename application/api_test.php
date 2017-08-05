<?php
/**
 * @author huandt
 */ 
define('IN_CDT',true);
date_default_timezone_set('Asia/Bangkok');
require_once 'define.php';
require_once dirname(dirname(__FILE__)).'/constant.php';
require_once SYSTEM_PATH.DS.'Common'.EXT;
require_once SYSTEM_PATH.'Controller'.EXT;
require_once APP_PATH.'webservice/config/config.php';
require_once APP_PATH.'nusoap.php';

/*
	$url_nganluong = 'https://www.nganluong.vn/paygate.php?wsdl';
	$username_nganluong = 'nganluong';
	//private $password_nganluong = 'abcae5cffadff3cecfc45ce370ef1366';
	$password_nganluong = '9fbc3d80daa6a43eb1e5634d3234f865'; 
    $soapClient = new nusoapclient ($url_nganluong, 'wsdl');
    
	$param    = array('username'=>$username_nganluong,'password'=>$password_nganluong,'array' =>array('email_nganluong'=>'huandtcn@gmail.com'));
	$results = $soapClient->call('getNLAccount',$param);
    var_dump($results);die;	*/
$link_webservice_1top   = 'http://localhost/1top/application/webservice.php?wsdl';
$soapClient     = new nusoapclient ($link_webservice_1top, 'wsdl');
$param          = array('transaction_info'=>'ab','order_code'=>'MDH1','payment_id'=>112233,
                'payment_type'=>'22','secure_code'=>'abc123'
                );
$results        = $soapClient->call('UpdateOrder',$param);
var_dump($results);die;

function &get_instance()
{
    return CDT_Controller::get_instance();
}
class api_payment{
    private $CDT;
    function __construct(){        
        $cdtObject = new CDT_Controller();
        $this->CDT = & get_instance();        
        $this->CDT->load->model('payment_model','payment');        
    }
    /**
     * Ham thuc hien insert du lieu vao bang payment
     */    
    function insert_order($arr){
        $param = array();
        if(!empty($arr)){
            $param = $arr;
            $param['time_created'] = time();
            return $this->CDT->payment->insert_data($param);
        }else{
            return false;
        }
    }
    function get_account_info_nl($emailNl){        
        $soapClient = new nusoapclient (LINK_WEBSERVICE, 'wsdl');
        $accNganluongInfo = $soapClient->call('GetBalance',array('username'=>USERAPI,'password'=>USERPASS,'params'=>array('email'=>$emailNl)));
        return $accNganluongInfo;
    }
    /**
     * @param: $emailNl: email tk NL,$moneySendToSeller: so tien chuyen nb, $paymentId: ma gd, $paymentType: (1 -ngay, 2- tam giu),$emailSeller: email nguoi nhan 
     * 
     */ 
    function send_money_to_seller($emailNl,$moneySendToSeller,$paymentId,$paymentType,$emailSeller){
        $this->CDT->load->library('UserApi');
        $userInfo = $this->CDT->userapi->getUserByEmail('id,email',$emailSeller);        
        if(!empty($userInfo)){            
            $soapClient = new nusoapclient (LINK_WEBSERVICE, 'wsdl');
            /**/            
            $accNganluongInfo = $soapClient->call('GetBalance',array('username'=>USERAPI,'password'=>USERPASS,'params'=>array('email'=>$emailNl)));
            if($accNganluongInfo['error_code'] == 'SUCCESS'){
                $receiverId = $accNganluongInfo['result']['nl_id'];                
            }
            else return $accNganluongInfo;            
            $params = array(
                        'receiver_id'   => $receiverId,//id tai khoan nguoi ban - nganluong 
                        'amount'        => $moneySendToSeller, //so tien can chuyen 
                        'payment_type'  => $paymentType, //Chuyen tien tam giu
                        'escrow_time'   => 3,
                        'reason'        => '1Top.vn chuyển tiền tạm giữ cho bạn tương ứng với mã phiếu giảm giá:***** MDH'.$paymentId,
                        'order_code'    => $this->CDT->config->item('payment_prefix').$paymentId
                    );
             
            $result = $soapClient->call('CreateTransferNLTransaction',array('username'=>USERAPI,
                        'password'=>USERPASS,'params'=>$params));
            //$result['error_code'] = 'SUCCESS';        
            if($result['error_code'] == 'SUCCESS'){
                 # ghi log
                $this->CDT->load->model('transaction_log_model', 'transaction_log');
                $arrTransaction = array(
                    'seller_id'     =>$userInfo['id'],
                    'amount'        =>$moneySendToSeller,
                    'payment_type'  =>$paymentType, // approve giao dich tam giu
                    'payment_id'    =>"MDH".$paymentId,
                    'transfer_id'    => (int)$result['transaction_id'],
                    'reason'        =>'1TOP hoàn thành giao dịch chuyển tiền ngay cho bạn tương ứng với mã phiếu giảm giá:'.$coupon_code." MDH".$paymentId,                                                
                    'msg'           =>"1TOP chuyển tiền ngay cho người bán",
                    'coupon_code'   => '*****',
                    'create'        => time(),
                    'type'          =>1
                );
                if($this->CDT->transaction_log->insert_data($arrTransaction))
                    return 'Thành công';
            }else{
                return 'Có lỗi trong quá trình xử lý';
            }
        }
                                                    
    }
}

$obj = new api_payment();
var_dump($obj->get_account_info_nl('kenta1208@gmail.com'));
var_dump($obj->get_account_info_nl('shop_kenta@yahoo.com'));
die;

var_dump($obj->get_account_info_nl('dichvu1102vn1@gmail.com'));
die;
var_dump($obj->get_account_info_nl('thehuan_bg1@yahoo.com'));

//var_dump($obj->get_account_info_nl('huandtcn@gmail.com'));
die;
var_dump($obj->get_account_info_nl('test_cdt_seller@nganluong.vn'));
die;
//var_dump($obj->get_account_info_nl('huandtcn@gmail.com'));die;
//var_dump($obj ->get_account_info_nl('huandtcn@gmail.com'));die;
//var_dump($obj ->send_money_to_seller('quatangvp@gmail.com',155000,4657,2,'quatangvp@gmail.com'));

/**
 * email: nguoi mua, nguoi ban
 * ma dh
 * so tien
 */
 
?>


 