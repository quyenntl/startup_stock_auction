<?php 
define('IN_CDT',true);
date_default_timezone_set('Asia/Bangkok');
error_reporting(0);
require_once '../constant.php';
require_once 'define.php';
require_once APP_PATH.'config/define_database.php';
require_once(SYSTEM_PATH.'Common'.EXT);
set_error_handler('_exception_handler');
//echo 2;die;
if ( ! is_php('5.3'))
{
    @set_magic_quotes_runtime(0); // Kill magic quotes
}
/*
 * ------------------------------------------------------
 *  Start the timer... tick tock tick tock...
 * ------------------------------------------------------
 */
    $BM =& load_class('Benchmark','system');
    $BM->mark('total_execution_time_start');

    $SEC =& load_class('Security','system');
     
/*    
 * ------------------------------------------------------
 *  Load the Input class and sanitize globals
 * ------------------------------------------------------
 */
    $IN    =& load_class('Input','system');
    $class  = $IN->get('path');
    $method = $IN->get('func');
    $method = ($method!=false ?$method : 'index');
   
/*
 * ------------------------------------------------------
 *  Load the app controller and local controller
 * ------------------------------------------------------
 *
 */
    // Load the base controller class
    require SYSTEM_PATH.'Controller'.EXT;

    function &get_instance()
    {
        return CDT_Controller::get_instance();
    }

    // Load the local application controller
    // Note: The Router class automatically validates the controller path using the router->_validate_request().
    // If this include fails it means that the default controller in the Routes.php file is not resolving to something valid.
    if ( ! file_exists(APP_PATH.'ajax/'.$class.EXT))
    {
        show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
    }

    include_once(APP_PATH.'ajax/'.$class.EXT);
    
    if ( ! class_exists($class)
        OR strncmp($method, '_', 1) == 0
        OR in_array(strtolower($method), array_map('strtolower', get_class_methods('CDT_Controller')))
        )
    {
        
        show_404("{$class}/{$method}");
    }
    
    $CDT = new $class(); 
     
    if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($CDT))))
    {
        // Check and see if we are using a 404 override and use it.        
        if ( ! class_exists($class))
        {
            if ( ! file_exists(APP_PATH.'ajax/'.$class.EXT))
            {
                show_404("{$class}/{$method}");
            }

            include_once(APP_PATH.'ajax/'.$class.EXT);
            unset($CDT);
            $CDT = new $class();
        }
   
    }
    if(method_exists($CDT,$method)){
        $CDT->$method();
    }else{
        die("Function not exists");
    }
    // Call the requested method.
    // Any URI segments present (besides the class/function) will be passed to the method for convenience
    //call_user_func_array(array(&$CDT, $method), array_slice($URI->rsegments, 2));

    
    if (class_exists('CDT_DB') AND isset($CDT->db))
    {
        $CDT->db->close();
    }
    //flush($CDT);
   // 
//    $BM->mark('total_execution_time_end');
//    echo '<pre>';
//    echo $BM->elapsed_time('total_execution_time_start','total_execution_time_end'); 
//    echo "\n";  
//    echo $BM->memory_usage(); 
//    echo "\n";
//    $included_files = get_included_files();
//    echo 'Include tong so:' .count($included_files)."\n";     
//    foreach ($included_files as $filename) {
//        
//        echo "$filename\n";
//    }
//    echo '</pre>';
?>