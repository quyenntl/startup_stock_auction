<?php 
//session_start(1);
ob_start();
define('IN_CDT',true);
date_default_timezone_set('Asia/Bangkok');
error_reporting(0);
require_once '../constant.php';
require_once 'define.php';
require_once 'config/define_database.php';
require_once(SYSTEM_PATH.'Common'.EXT);

//set_error_handler('_exception_handler');
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
    $URI    =& load_class('URI','system');
    $RTR =& load_class('Router', 'system');
    $RTR->_set_routing();
    if (isset($routing))
    {
        $RTR->_set_overrides($routing);
    }
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
    if ( ! file_exists(APP_PATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().EXT))
    {
        show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
    }
    
    include_once(APP_PATH.'config'.DS.'define_database'.EXT);
    include(APP_PATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().EXT);
    
    
    // Set a mark point for benchmarking
    $class  = $RTR->fetch_class();
    $method = $RTR->fetch_method();
    if ( ! class_exists($class)
        OR strncmp($method, '_', 1) == 0
        OR in_array(strtolower($method), array_map('strtolower', get_class_methods('CDT_Controller')))
        )
    {        
        show_404("{$class}/{$method}");
    }

    // cache object o day vao memcache
    $CDT = new $class;
        
    // neu ko ton tai method se xu ly loi 404
    if (method_exists($CDT, '_remap'))
    {
        $CDT->_remap($method, array_slice($URI->rsegments, 2));
    }
    else
    {
        // is_callable() returns TRUE on some versions of PHP 5 for private and protected
        // methods, so we'll use this workaround for consistent behavior die;
        
        if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($CDT))))
        {
            // Check and see if we are using a 404 override and use it.
            if ( ! empty($RTR->routes['404_override']))
            {
                $x = explode('/', $RTR->routes['404_override']);
                $class = $x[0];
                $method = (isset($x[1]) ? $x[1] : 'index');
                if ( ! class_exists($class))
                {
                    if ( ! file_exists(APP_PATH.'controllers/'.$class.EXT))
                    {
                        show_404("{$class}/{$method}");
                    }

                    include_once(APP_PATH.'controllers/'.$class.EXT);
                    unset($CDT);
                    $CDT = new $class();
                }
            }
            else
            {
                show_404("{$class}/{$method}");
            }
        }

        // Call the requested method.
        // Any URI segments present (besides the class/function) will be passed to the method for convenience
        call_user_func_array(array(&$CDT, $method), array_slice($URI->rsegments, 2));
    }   
    
    if (class_exists('CDT_DB') AND isset($CDT->db))
    {
        $CDT->db->close();
    }
    if (class_exists('CDT_DB') AND isset($CDT->sdb))
    {
        $CDT->sdb->close();
    }
    // set cache object CDT for page
    
    die;
    flush($CDT);
    
    $BM->mark('total_execution_time_end');
   
    echo '<pre style="color:#000;width:100%">';
    echo "<ol>";
    $i=0;
    foreach($CDT->db->queries as $oneQuery){
       echo "<li>". $oneQuery ."<br/> <b>Time excute</b> ". $CDT->db->query_times[$i]." s </li>";
       $i++;
    }
    echo "</ol>";
    if(isset($CDT->mkdb)){
        echo '<pre style="color:#COCC9F;width:100%">';
        echo "<ol>";
        $i=0;
        foreach($CDT->mkdb->queries as $oneQuery){
           echo "<li>". $oneQuery ."<br/> <b>Time excute</b> ". $CDT->mkdb->query_times[$i]." s </li>";
           $i++;
        }
        echo "</ol>";
    }

    if(isset($CDT->sysdb)){
        echo '<pre style="color:green;width:100%">';
        echo "<ol>";
        $i=0;
        foreach($CDT->sysdb->queries as $oneQuery){
           echo "<li>". $oneQuery ."<br/> <b>Time excute</b> ". $CDT->sysdb->query_times[$i]." s </li>";
           $i++;
        }
        echo "</ol>";
    }
    if(isset($CDT->logdb)){
        echo '<pre style="color:green;width:100%">';
        echo "<ol>";
        $i=0;
        foreach($CDT->logdb->queries as $oneQuery){
           echo "<li>". $oneQuery ."<br/> <b>Time excute</b> ". $CDT->logdb->query_times[$i]." s </li>";
           $i++;
        }
        echo "</ol>";
    }
    
    echo "<p> Time generate page : ".$BM->elapsed_time('total_execution_time_start','total_execution_time_end')."</p>"; 
    echo "<p> Memory used: ".$BM->memory_usage()."</p>"; 
    $included_files = get_included_files();
    echo '<p>Include tong so:' .count($included_files)."</p>";   
    echo "<ol>";  
    foreach ($included_files as $filename) {
        
        echo "<li> $filename </li>";
    }
    echo "</ol>";
    
    echo '</pre>';
?>