<?php  if ( ! defined('IN_CDT')) exit('No direct script access allowed');

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CDT_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
//		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}
		$this->load =& load_class('Loader', 'system');
        //Khong load lai class libraries đa load khi goi autoloader
		$this->load->_base_classes =& is_loaded();
        $this->load->autoloader();
        
        $this->load->skins();         
        if(isset($_POST['form_module_name'])){
            // call method submit in module
            $module = $this->input->post('form_module_name'); 
            $this->load->load_module(trim(strip_tags($module)),array('submit'=>true));
            
        }
		log_message('debug', "Controller Class Initialized");

	}

	public static function &get_instance()
	{	
		return self::$instance;
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */