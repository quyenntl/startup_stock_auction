<?php  if ( ! defined('IN_CDT')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
$route['admin/([a-zA-Z0-9-_/]+)'] = "backend/$1";
$route['admin'] = "backend/home/index";
$route['san-pham']   = 'browse/index';
$route['c/([a-zA-Z0-9/]+)/([a-zA-Z0-9-]+)']  = 'browse/cate_pro/$1/$2';
$route['san-pham/([a-zA-Z0-9/]+)/([a-zA-Z0-9-]+).html']  = 'browse/detail/$1/$2';
$route['tin-tuc/([a-zA-Z0-9/]+)/([a-zA-Z0-9-]+).html']  = 'detail_new/index/$1/$2';
$route['(gioi-thieu).html']    = 'about/index';
$route['thu-vien-anh']     = 'about/help/index';
$route['(dang-nhap).html']   = 'login/index';
$route['tin-tuc']   = 'list_new/index';
$route['(thu-tuc-dat-xe).html']    = 'booking/index';
$route['(dat-lenh).html']    = 'finance/index';
$route['(bao-hiem-xe-oto).html']    = 'protect/index';
/* End of file routes.php */
/* Location: ./application/config/routes.php */