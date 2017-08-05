<?php
/**
 * Thực hiện lấy thông tin về mail muốn gửi để kết nối với phpmailer và log mail
 * @author vunn(vunn@peacesoft.net)
 */
 class SendMail{
    /**
	 * Subject
	 *	tieu de email
	 * 
	 * @var string
	 */
	public $subject = '';
	
	/**
	 * Content
	 *	HTML string
	 * 
	 * @var string
	 */
	public $content;
	
	/**
	 * To Email
	 * 	Email nguoi nhan
	 *
	 * @var string
	 */
	public $toEmail;
	
	/**
	 * To Name
	 * 	Ten nguoi nhan
	 *
	 * @var string
	 */
	public $toName;
	
	/**
	 * Log Id
	 *	trong truong hop email nay duoc gui lai, no can co 1 log mess
	 *
	 * @var int
	 */
	public $logId = 0;
	
	/**
	 * Priority
	 * 	Muc uu tien gui lai cua email nay
	 *  
	 * @var int
	 */
    public $priority = 0;
	public $status = 2;
	public $is_log = 1;
	/**
	 * Form Name
	 * 	ten nguoi gui
	 *
	 * @var string
	 */
	public $fromName = '';
	
	/**
	 * From Email
	 * 	email nguoi gui
	 *
	 * @var string
	 */
	public $fromEmail = '';
	/**
     * so lan gui mail loi
     *     
     *
     * @var string
     */
    public $count;
	/**
	 * Error Message
	 * 	thong bao loi
	 *
	 * @var string
	 */
	public $errorMess;
	/**
	 * Constructor
	 *
	 * @param Array $info. Thong tin cua cac email can gui
	 */
	public function __construct($info = array()) {
		$vars = array_keys(get_object_vars($this));		
		for ($i=0, $size = sizeof($vars); $i < $size; ++$i) {
			if (isset($info[$vars[$i]])) {				
				$this->$vars[$i] = $info[$vars[$i]];
			}
		}		
	}
	                  
	/**
	 * Log
	 *
	 * @param string $mess
	 * @return void
	 */
	private function _log($msg="",$server="",$status=0) {
	    $CDT = &get_instance(); 
        $CDT->load->model('log_email_model','log_mail');
        $data = array();
		if ($this->logId == 0) { // Insert
			$data = array(
				'to_email'		=> $this->toEmail,
				'to_name'		=> $this->toName,
				'subject'		=> $this->subject,
				'content'		=> $this->content,
				'priority'		=> $this->priority,
				'time'			=> time(),
				'status'	    => $status,
                'server'        => $server,
                'log_msg'       => $msg
			);			
			$this->logId = $CDT->log_mail->insert_data($data);
		}
		else { // Update so luong resent_cont
            if($msg == '')
                $data = array(
                    'server'        => $server
    			);
            else
                $data = array(
                    'server'        => $server,
                    'log_msg'       => $msg
    			);
            $CDT->log_mail->update_data($data,$this->logId);		
		}
	}
	
	/**
	 * Send
	 * 	send email
	 *
	 * @param string $services localhost/gmail
	 * @param int $key -1 => random
	 * @param Array $info, cac thong tin noi dung cua email
	 * @return boolean
	 * @throws phpmailerException neu viec gui mail gap loi
	 * @throws SystemException
	 */
	public function send() {		
		require_once SYSTEM_PATH.'phpmailer'.DS.'PHPMailer.php';
	    $mail = new PHPMailer(true);
	    $mail->CharSet ='utf-8';
        $mail->IsSMTP();                           // tell the class to use SMTP
    	$mail->SMTPAuth   = false;                  // enable SMTP authentication
    	$mail->IsHTML(true); // send as HTML
	    try {
            require APP_PATH.'config'.DS.'mail.php';
		    
            $mail->Port       = 25;                    // set the SMTP server port
        	$mail->Hostname   = $config['Hostname']; // SMTP server
            $mail->Host       = $config['MailHost']; // SMTP server
        	$mail->Username   = $config['Username'];     // SMTP server username
        	$mail->Password   = $config['Password'];            // SMTP server password
      
        
        	$mail->AddReplyTo($config['ReplyMail'],$config['ReplyName']);
        
        	$mail->From       = $config['ReplyMail'];
        	$mail->FromName   = $config['ReplyName'];

        
        	$mail->AddAddress($this->toEmail,$this->toName);
        
        	$mail->Subject  = $this->subject;
            $mail->Body     =  $this->content;
        	$mail->AltBody    = strip_tags($this->content); // optional, comment out and test
        	$mail->WordWrap   = 30; // set word wrap
        
        	$mail->MsgHTML($this->content);
        	
            if($this->priority == 0){ //priority == 0: Gửi luôn || 1: chờ gửi
                $mail->Send();
                if($this->is_log == 1){
                    $this->_log("",$mail->Host,2);
                    return true;
                }
                else{
                    return true;
                } 
            }else{
                $this->_log("",$mail->Host,0);
                return true;
            }
		    
	    }
	    catch (phpmailerException $pme) {
	        if($this->is_log == 1){
                $this->_log($pme->getMessage(),$mail->Host,0);
                return false;
            }
            else{
                return array('msg' => $pme->getMessage(), 'server' => $mail->Host);
            }
	    }
		//return true;
	}
 }
?>