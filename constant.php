<?php
define('CDT_VERSION', '2.0');
define('DS', '/' );
define('EXT', '.php' );
define('ROOT_PATH',dirname(__FILE__));
define('CDT20_PATH',ROOT_PATH .DS. 'CDT20'.DS);
define('SYSTEM_PATH',CDT20_PATH . 'system'.DS);

define('UTF8_ENABLED',false);



define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',                            'rb');
define('FOPEN_READ_WRITE',                        'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',        'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',    'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',                    'ab');
define('FOPEN_READ_WRITE_CREATE',                'a+b');
define('FOPEN_WRITE_CREATE_STRICT',                'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',        'x+b');

?>