<?php 
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006 - 2011 EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 2.0
 * @filesource	
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Caching Class 
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Core
 * @author		ExpressionEngine Dev Team
 * @link		
 */
class Cache{
	
	protected $valid_drivers 	= array(
		'cache_apc', 'cache_file', 'cache_memcached', 'cache_dummy'
	);

   // protected $_cache_path		= NULL;		// Path of cache files (if file-based cache)
	protected $_adapter			= 'dummy';
	
	// ------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct($config = array())
	{
		if ( ! empty($config))
		{
			$this->_initialize($config);
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Get 
	 *
	 * Look for a value in the cache.  If it exists, return the data 
	 * if not, return FALSE
	 *
	 * @param 	string	
	 * @return 	mixed		value that is stored/FALSE on failure
	 */
	public function get($id)
	{	
		return $this->_adapter->get($id);
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Save
	 *
	 * @param 	string		Unique Key
	 * @param 	mixed		Data to store
	 * @param 	int			Length of time (in seconds) to cache the data
	 *
	 * @return 	boolean		true on success/false on failure
	 */
	public function save($id, $data, $ttl = 3600)
	{
		return $this->_adapter->save($id, $data, $ttl);
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete from Cache
	 *
	 * @param 	mixed		unique identifier of the item in the cache
	 * @return 	boolean		true on success/false on failure
	 */
	public function delete($id)
	{
		return $this->_adapter->delete($id);
	}

	// ------------------------------------------------------------------------

	/**
	 * Clean the cache
	 *
	 * @return 	boolean		false on failure/true on success
	 */
	public function clean()
	{
		return $this->_adapter->clean();
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Info
	 *
	 * @param 	string		user/filehits
	 * @return 	mixed		array on success, false on failure	
	 */
	public function cache_info($type = 'user')
	{
		return $this->_adapter->cache_info($type);
	}

	// ------------------------------------------------------------------------
	
	/**
	 * Get Cache Metadata
	 *
	 * @param 	mixed		key to get cache metadata on
	 * @return 	mixed		return value from child method
	 */
	public function get_metadata($id)
	{
		return $this->_adapter->get_metadata($id);
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Initialize
	 *
	 * Initialize class properties based on the configuration array.
	 *
	 * @param	array 	
	 * @return 	void
	 */
	private function _initialize($config)
	{   
	    $adapter  =  'Cache_'.(isset($config['adapter']) ? $config['adapter']: 'file');
        require_once CDT20_PATH.'caching'.DS.'drivers'.DS.$adapter.EXT;
		$this->_adapter = new $adapter($config);
      //  $this->_adapter->_cache_path = $config['_cache_path'];
        
        $default_config = array(
				'adapter',
				'memcached',
                'cache_path'
		);
       	foreach ($default_config as $key)
		{
			if (isset($config[$key]))
			{
				$param = '_'.$key;

				$this->_adapter->{$param} = $config[$key];
			}
		}
	
	}

	// ------------------------------------------------------------------------

	/**
	 * Is the requested driver supported in this environment?
	 *
	 * @param 	string	The driver to test.
	 * @return 	array
	 */
	public function is_supported()
	{  
        $support = $this->_adapter->is_supported();
		return $support;
	}
	// ------------------------------------------------------------------------
}
// End Class

/* End of file Cache.php */
/* Location: ./system/libraries/Cache/Cache.php */