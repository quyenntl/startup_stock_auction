<?php  if ( ! defined('IN_CDT')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Loader Class
 *
 * Loads views and files
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @author		ExpressionEngine Dev Team
 * @category	Loader
 * @link		http://codeigniter.com/user_guide/libraries/loader.html
 */
class Loader {
     var $_base_classes        = array(); // Set by the controller class  
     var $_cdt_classes        = array(); // Set by the controller class  
     var $_cdt_loaded_files        = array(); // Set by the controller class  
     var $_cdt_helpers        = array(); // Set by the controller class  
     var $_cdt_models        = array(); // Set by the controller class  
     
     
     
	// All these are set automatically. Don't mess with them.
	function database($params = '',$object_name=NULL, $return = FALSE, $active_record = NULL)
    {

        // Grab the super object
        $CDT =& get_instance();
        $object_name = ($object_name!=null)? $object_name:'db'; 
        // Do we even need to load the database class?
        if (class_exists('CDT_DB') AND $return == FALSE AND $active_record == NULL AND isset($CDT->$object_name) AND is_object($CDT->$object_name))
        {
            return FALSE;
        }
        require_once(CDT20_PATH.'database/DB'.EXT);

        if ($return === TRUE)
        {
            return DB($params, $active_record);
        }
        
        // Initialize the db variable.  Needed to prevent
        // reference errors with some configurations
        $CDT->$object_name = '';

        // Load the DB class  
        
        $CDT->$object_name =& DB($params, $active_record);
        
    }
    
    
    /**
     * Autoloader
     *
     * The config/autoload.php file contains an array that permits sub-systems,
     * libraries, and helpers to be loaded automatically.
     *
     * @access    private
     * @param    array
     * @return    void
     */
    function autoloader()
    {

        include_once(APP_PATH.'config/autoload'.EXT);
        

        if ( ! isset($autoload))
        {
            return FALSE;
        }


        // Autoload helpers and languages
        if (isset($autoload['helper']) AND count($autoload['helper']) > 0)
        {
            $this->helper($autoload['helper']);
        }

        // Load libraries
        if (isset($autoload['libraries']) AND count($autoload['libraries']) > 0)
        {
            // Load the database driver.
            if (in_array('database', $autoload['libraries']))
            {
                $this->database();
                $autoload['libraries'] = array_diff($autoload['libraries'], array('database'));
            }

            // Load all other libraries
            foreach ($autoload['libraries'] as $item)
            {
                $this->library($item);
            }
        }

        // Autoload models
        if (isset($autoload['model']))
        {
            $this->model($autoload['model']);
        }
    }
    
    /**
     * Class Loader
     *
     * This function lets users load and instantiate classes.
     * It is designed to be called from a user's app controllers.
     *
     * @access    public
     * @param    string    the name of the class
     * @param    mixed    the optional parameters
     * @param    string    an optional object name
     * @return    void
     */
    function library($library = '', $params = NULL, $object_name = NULL)
    {
        if (is_array($library))
        {
            foreach ($library as $class)
            {
                $this->library($class, $params);
            }

            return;
        }

        if ($library == '' OR isset($this->_base_classes[$library]))
        {
            return FALSE;
        }

        if ( ! is_null($params) && ! is_array($params))
        {
            $params = NULL;
        }

        $this->cdt_load_class($library, $params, $object_name);
    }
    /**
    * Load helpers file
    * 
    * @param mixed $helper
    * @param mixed $system
    */
    function helper($helpers){
        if(is_array($helpers)){
            foreach ($this->_cdt_prep_filename($helpers, '_helper') as $helper)
            {
                if (isset($this->_cdt_helpers[$helper]))
                {
                    continue;
                }
                foreach (array(APP_PATH, CDT20_PATH) as $path)
                {
                    
                    if (file_exists($path.'helpers/'.$helper.EXT))
                    {
                        include_once($path.'helpers/'.$helper.EXT);

                        $this->_cdt_helpers[$helper] = TRUE;
                        log_message('debug', 'Helper loaded: '.$helper);
                        break;
                    }
                }   
                if ( ! isset($this->_cdt_helpers[$helper]))
                {
                    show_error('Unable to load the requested file: helpers/'.$helper.EXT);
                }
            }
        }else{
            foreach (array(APP_PATH, CDT20_PATH) as $path)
            {    
                if (file_exists($path.'helpers/'.$helpers.'_helper'.EXT))
                {
                    include_once($path.'helpers/'.$helpers.'_helper'.EXT);

                    $this->_cdt_helpers[$helpers] = TRUE;
                    log_message('debug', 'Helper loaded: '.$helpers.'_helper');
                    break;
                }
            }
             if ( ! isset($this->_cdt_helpers[$helpers]))
            {
                show_error('Unable to load the requested file: helpers/'.$helpers.'_helper'.EXT);
            }
        }
    }
    /**
    * Load model file
    * 
    * @param mixed $class
    */
    function model($model, $name = '', $db_conn = FALSE)
    {
        if (is_array($model))
        {
            foreach ($model as $babe)
            {
                $this->model($babe);
            }
            return;
        }

        if ($model == '')
        {
            return;
        }

        $path = '';

        // Is the model in a sub-folder? If so, parse out the filename and path.
        if (($last_slash = strrpos($model, '/')) !== FALSE)
        {
            // The path is in front of the last slash
            $path = substr($model, 0, $last_slash + 1);

            // And the model name behind it
            $model = substr($model, $last_slash + 1);
        }

        if ($name == '')
        {
            $name = $model;
        }

        if (in_array($name, $this->_cdt_models, TRUE))
        {
            return;
        }

        $CDT =& get_instance();
        if (isset($CDT->$name))
        {
            show_error('The model name you are loading is the name of a resource that is already being used: '.$name);
        }

        $model = strtolower($model);

        if ( ! file_exists(APP_MODEL_PATH.$path.$model.EXT))
        {
             show_error('Unable to locate the model you have specified: '.$model); 
        }

        if ($db_conn !== FALSE AND ! class_exists('CDT_DB'))
        {
            if ($db_conn === TRUE)
            {
                $db_conn = '';
            }

            $CDT->load->database($db_conn, FALSE, TRUE);
        }

        if ( ! class_exists('Model'))
        {
            load_class('Model', 'system');
        }

        require_once(APP_MODEL_PATH.$path.$model.EXT);

        $model = ucfirst($model);

        $CDT->$name = new $model();

        $this->_cdt_models[] = $name;

        // couldn't find the model
       return;
    }
    
    /**
    * Load model file
    * 
    * @param mixed $class
    */
    function m_model($model, $name = '', $db_conn = FALSE)
    {
        if (is_array($model))
        {
            foreach ($model as $babe)
            {
                $this->m_model($babe);
            }
            return;
        }
        $tmp = explode('_',$model);
        $subdir = $tmp[0];
        if (($last_slash = strrpos($model, '/')) !== FALSE)
        {
            // Extract the path
            $subdir = substr($model, 0, $last_slash + 1);

            // Get the filename from the path
            $model = substr($model, $last_slash + 1);
        }
        if ($model == '')
        {
            return;
        }

        if ($name == '')
        {
            $name = $model;
        }

        if (in_array($name, $this->_cdt_models, TRUE))
        {
            return;
        }

        $CDT =& get_instance();
        if (isset($CDT->$name))
        {
            show_error('The model name of module you are loading is the name of a resource that is already being used: '.$name);
        }

        $model = strtolower($model);

        if ( ! file_exists(APP_MODULE_PATH.$subdir.'/model/'.$model.EXT))
        {
             show_error('Unable to locate the module model you have specified: '.$model); 
        }

        if ($db_conn !== FALSE AND ! class_exists('CDT_DB'))
        {
            if ($db_conn === TRUE)
            {
                $db_conn = '';
            }

            $CDT->load->database($db_conn, FALSE, TRUE);
        }

        if ( ! class_exists('Model'))
        {
            load_class('Model', 'system');
        }

        require_once(APP_MODULE_PATH.$subdir.'/model/'.$model.EXT);

        $model = ucfirst($model);

        $CDT->$name = new $model();

        $this->_cdt_models[] = $name;

        // couldn't find the model
       return;
    }
   
    /**
     * Instantiates a class
     *
     * @access    private
     * @param    string
     * @param    string
     * @param    string    an optional object name
     * @return    null
     */
    function init_class($class, $config = FALSE, $object_name = NULL)
    {
        $class = strtolower($class);
        $this->_cdt_classes[$class] = $class;
        $CDT =& get_instance();
        if (is_null($object_name))
        {
            $object_name = $class;
        }
        if ($config !== NULL)
        {
            $CDT->$object_name = new $class($config);
        }
        else
        {
            $CDT->$object_name = new $class;
        }
    }
    
    /**
     * Load class
     *
     * This function loads the requested class.
     *
     * @access    private
     * @param    string    the item that is being loaded
     * @param    mixed    any additional parameters
     * @param    string    an optional object name
     * @return    void
     */
    function cdt_load_class($class, $params = NULL, $object_name = NULL)
    {
        // Get the class name, and while we're at it trim any slashes.
        // The directory path can be included as part of the class name,
        // but we don't want a leading slash
        $class = str_replace(EXT, '', trim($class, '/'));

        // Was the path included with the class name?
        // We look for a slash to determine this
        $subdir = '';
        if (($last_slash = strrpos($class, '/')) !== FALSE)
        {
            // Extract the path
            $subdir = substr($class, 0, $last_slash + 1);

            // Get the filename from the path
            $class = substr($class, $last_slash + 1);
        }
        // We'll test for both lowercase and capitalized versions of the file name
        foreach (array(ucfirst($class), strtolower($class)) as $class)
        {
            foreach (array(SYSTEM_PATH,APP_PATH.'libraries/') as $path)
            {
                $filepath = $path.$subdir.$class.EXT;
                                // Does the file exist?  No?  Bummer...
                if ( ! file_exists($filepath))
                {
                    continue;
                }

                // Safety:  Was the class already loaded by a previous call?
                if (in_array($filepath, $this->_cdt_loaded_files))
                {
                    // Before we deem this to be a duplicate request, let's see
                    // if a custom object name is being supplied.  If so, we'll
                    // return a new instance of the object
                    if ( ! is_null($object_name))
                    {
                        $CDT =& get_instance();
                        if ( ! isset($CDT->$object_name))
                        {   
                            return $this->init_class($class, $params, $object_name);
                        }
                    }

                    $is_duplicate = TRUE;
                    log_message('debug', $class." class already loaded. Second attempt ignored.");
                    return;
                }

               include_once($filepath);
               $this->_cdt_loaded_files[] = $filepath;
               return $this->init_class($class, $params, $object_name);
            }

        } // END FOREACH
        
    }
    function language($file = array(), $lang = '')
    {
        $CDT =& get_instance();

        if ( ! is_array($file))
        {
            $file = array($file);
        }

        foreach ($file as $langfile)
        {
            $CDT->lang->load($langfile, $lang);
        }
    }
    
    
    function skins($skin=''){
        $CDT =& get_instance();
        if($skin==''){
            if (isset($CDT->smarty))
            {
                $CDT->smarty->template_dir = TEMPLATE_PATH.SKINS_TEMPLATE.DS;
                $CDT->smarty->compile_dir  = TEMPLATE_PATH_COMPILE.SKINS_TEMPLATE.DS;
                $CDT->smarty->cache_dir    = CACHE_PATH.SKINS_TEMPLATE.DS;   
            } 
        }else{
            $CDT->smarty->template_dir = TEMPLATE_PATH.$skin.DS;
            $CDT->smarty->compile_dir  = TEMPLATE_PATH_COMPILE.$skin.DS;
            $CDT->smarty->cache_dir    = CACHE_PATH.$skin.DS;  
        }
                            
    }
    
    function skin_admin($skin=''){
        $CDT =& get_instance();
        $CDT->smarty->template_dir = TEMPLATE_PATH.SKINS_ADMIN_TEMPLATE.DS;
        $CDT->smarty->compile_dir  = TEMPLATE_PATH_COMPILE.SKINS_ADMIN_TEMPLATE.DS;
        $CDT->smarty->cache_dir    = CACHE_PATH.SKINS_ADMIN_TEMPLATE.DS;  
                     
    }
    
    function load_module($module_name,$config=NULL){
            $subdir = '';
            if (($last_slash = strrpos($module_name, '/')) !== FALSE)
            {
                // Extract the path
                $subdir = substr($module_name, 0, $last_slash + 1);
    
                // Get the filename from the path
                $module_name = substr($module_name, $last_slash + 1);
            }
            
            if($config['cache'] === true){
                $CDT = & get_instance();
                $CDT->load->cache(array("adapter"=>"file","cache_path"=>CACHE_MODULE_PATH));
                $html = $CDT->cache->get($module_name."_".md5($subdir).".html");
                if($html != false){
                    return $html;
                };
                
            }
            $filepath = APP_MODULE_PATH.$subdir.$module_name.EXT;          
            if ( ! file_exists($filepath))
            {
                show_error('Cannot load module: '.$subdir.$module_name);
            }
            
            include_once($filepath);
            $class = $module_name;
            $class_name = 'module_'.$module_name;
            
            if ( ! is_null($module_name))
            {       
                $CDT =& get_instance();
                if(!isset($CDT->$class_name)){
                    $CDT->$class_name = new $class();   
                }                
                if (isset($config['submit']))
                {     
                     $CDT->$class_name->submit();
                }
                // Load JS
                if(method_exists($CDT->$class_name,'script')){
                    $arrScript                   = $CDT->$class_name->script();
                    $CDT->static_script[]        = $arrScript;
                    $CDT->static_module_script[] = $module_name.count($arrScript['js']['header']).'_'.count($arrScript['js']['footer']).'_'.count($arrScript['css']);
                }
                // cache module
                $this->_cdt_loaded_files[] = $filepath;
                $html = $CDT->$class_name->draw($config);
                if($config['cache'] === true){
                    $CDT->cache->save($module_name."_".md5($subdir).".html",$html);    
                }
                if($config['track']===true){
                    
                }
                return $html;  
            }
            
            show_error('Cannot draw module '.$module_name);

    }
    
    function config($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
    {
        $CDT =& get_instance();
        $CDT->config->load($file, $use_sections, $fail_gracefully);
    }
    
    function _cdt_prep_filename($filename, $extension)
    {
        if ( ! is_array($filename))
        {
            return array(strtolower(str_replace(EXT, '', str_replace($extension, '', $filename)).$extension));
        }
        else
        {
            foreach ($filename as $key => $val)
            {
                $filename[$key] = strtolower(str_replace(EXT, '', str_replace($extension, '', $val)).$extension);
            }

            return $filename;
        }
    }
    
    function cache($params = NULL, $object_name = NULL)
	{
        $filepath = CDT20_PATH.'caching'.DS.'Cache'.EXT;
        // Does the file exist?  No?  Bummer...
        if ( ! file_exists($filepath))
        {
            show_error('Unable to load the requested file: caching/cache'.EXT);
        }

        // Safety:  Was the class already loaded by a previous call?
        if (in_array($filepath, $this->_cdt_loaded_files))
        {
            // Before we deem this to be a duplicate request, let's see
            // if a custom object name is being supplied.  If so, we'll
            // return a new instance of the object
            if ( ! is_null($object_name))
            {
                $CDT =& get_instance();
                if ( ! isset($CDT->$object_name))
                {   
                    return $this->init_class('cache', $params, $object_name);
                }
               
            }
            // xu ly khoi tao cac bien voi gia tri moi
            //$is_duplicate = TRUE;
            log_message('debug', "cache ".$params['adapter']." class already loaded. Second attempt ignored.");
            return $this->init_class('cache', $params, $object_name);
            
            //return;
        }

       include_once($filepath);
       $this->_cdt_loaded_files[] = $filepath;
       return $this->init_class('cache', $params, $object_name);
	}
    
    /**
     * assigns a Smarty variable
     * 
     * @Author KienNT
     * @param array $ |string $tpl_var the template variable name(s)
     * @param mixed $value the value to assign
     * @param boolean $nocache if true any output of this variable will be not cached
     * @param boolean $scope the scope the variable will have  (local,parent or root)
     */
     
    function assign($tpl_var, $value = null, $nocache = false){
        $CDT =& get_instance();
        return $CDT->smarty->assign($tpl_var, $value, $nocache);
    }

}
