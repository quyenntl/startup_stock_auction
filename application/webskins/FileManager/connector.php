<?php
session_start();
//error_reporting(2); // Set E_ALL for debuging
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

define('PATH',dirname(dirname(dirname(dirname(__FILE__)))));

require_once PATH.'/constant.php';

require_once PATH.'/public_html/define.php';

//define('PATH',dirname(dirname(dirname(dirname(__FILE__)))));
//require_once PATH.'/constant.php';
//require_once PATH.'/application/define.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
// Required for MySQL storage connector
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';

/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from  '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool
 **/
function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0   // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')  // set read+write to false, other (locked+hidden) set to true
		: ($attr == 'read' || $attr == 'write');  // else set read+write to true, locked+hidden to false
}
$folderInfo = explode("@",$_SESSION['onetopuser']['email']);
$dirName = $folderInfo[0];// '182_admin';
if(!file_exists(STORE_DATA.'FileManager/'.$dirName)){
    mkdir(STORE_DATA.'FileManager/'.$dirName,0777,true);
    chmod(STORE_DATA.'FileManager/'.$dirName,0777);    
}
//echo STORE_DATA;die;
$opts = array(
	'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			'path'          => STORE_DATA.'FileManager/'.$dirName,         // path to files (REQUIRED)
			'URL'           => APP_URL_EDITOR.'FileManager/'.str_replace('/','',$dirName), // URL to files (REQUIRED)
			'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)
            'uploadAllow'   => array('image/png','image/gif','image/jpeg'),
            'uploadMaxSize' => "2M",
            'disabled'      => array("rename","duplicate","mkfile","copy","cut","edit","help"),
            'rememberLastDir'=> false,
		)
	)
); 



// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

