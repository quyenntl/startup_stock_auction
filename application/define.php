<?php
define('DS','/');
define('APP_PATH',dirname(__FILE__).'/');
define('SITE_TITLE','');
/*
define ('APP_URL','http://mocmien.net/');
define ('APP_URL_EDITOR','http://mocmien.net/storedata/');
define ('STATIC_URL','http://mocmien.net/storedata/');
define ('MEDIA_URL','http://mocmien.net/');
*/

if (isset($_SERVER['HTTP_HOST'])) {
	$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ? 'https' : 'http';
	$base_url .= '://'. $_SERVER['HTTP_HOST'];
	$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	
} else {
	$base_url = 'http://vipdoithuong.com/';
}


define ('APP_URL',$base_url);
define ('APP_URL_EDITOR',$base_url.'/storedata/');
define ('STATIC_URL',$base_url.'/storedata/');
define ('MEDIA_URL',$base_url);


define('CACHE_PATH',APP_PATH.'cache'.DS);
define('APP_MODEL_PATH',APP_PATH.'models/');
define('APP_MODULE_PATH',APP_PATH.'modules/');

define('SKINS_TEMPLATE','default');
define('SKINS_ADMIN_TEMPLATE','admin');
define('TEMPLATE_PATH',APP_PATH.'webskins'.DS.'templates'.DS);
define('LAYOUT_PATH',TEMPLATE_PATH.'layout'.DS);
define('TEMPLATE_PATH_COMPILE',APP_PATH.'webskins'.DS.'templates_c'.DS);
define('SKIN_ADMIN',APP_URL.'webskins/skins/backend');
define('SKIN_FRONTEND',APP_URL.'webskins/skins/frontend');
define('SKIN_CAR',APP_URL.'webskins/skins/cars');

define('CACHE_MODULE_PATH',APP_PATH.'cache'.DS.'modules'.DS);
define('CACHE_CATEGORY',APP_PATH.'cache'.DS.'categories'.DS);
define('CACHE_PRIVILEGE_PATH',APP_PATH.'cache'.DS.'privilege'.DS);
define('CACHE_CATE_PATH',APP_PATH.'cache'.DS.'cate_active'.DS);
define("CAPTCHA_AUDIO_PATH",APP_PATH."audio".DS);
define('CACHE_QUERY',APP_PATH.'cache'.DS.'query'.DS);
define('CACHE_DEAL_LOCATION',APP_PATH.'cache'.DS.'deal_location'.DS);
define('SERVICE_LOG_FILE',APP_PATH.'cache/service_log.txt');
define('LOCATION_CACHE',APP_PATH.'cache'.DS.'location'.DS);
define('CACHE_IMAGE', true);
?>