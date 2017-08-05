<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
/**
 * Create URL Title
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash,
 * an underscore or a space as the word separator.
 *
 * @access  public
 * @param   string  the string
 * @param   string  the separator: dash, underscore or space
 * @param   string  lowercase: TRUE or FALSE
 * @return  string
 */
if (! function_exists('url_title')) {
  function url_title($str, $separator = 'dash', $lowercase = FALSE) {
    if ($separator == 'dash') {
      $search   = '_';
      $replace  = '-';
    }
    else if ($separator == 'underscore') {
      $search   = '-';
      $replace  = '_';
    }
    else {
      $search   = ' ';
      $replace  = ' ';
    }

    $str = convert_accented_characters($str);

    $trans = array(
            $search                     => $replace,
            "\s+"                       => $replace,
            "[^a-zA-Z0-9".$replace."]"  => '',
            $replace."+"                => $replace,
            $replace."$"                => '',
            "^".$replace                => ''
    );

    if ($lowercase) {
      $str = strtolower($str);
    }
    $str = strip_tags($str);

    foreach ($trans as $key => $val) {
      $str = preg_replace("#".$key."#", $val, $str);
    }

    return trim(stripslashes($str));
  }
}

// ------------------------------------------------------------------------

/**
 * Convert Special Chars
 *
 * Found Via:
 * http://us.php.net/manual/en/function.chr.php#72145
 *
 * @access    public
 * @param    string    the string
 * @return    string
 */
function convert_accented_characters($string) {
  return strtr($string,array(
            'ấ'=>'a','ầ'=>'a','ẩ'=>'a','ẫ'=>'a','ậ'=>'a','Ấ'=>'A','Ầ'=>'A','Ẩ'=>'A','Ẫ'=>'A','Ậ'=>'A','ắ'=>'a','ằ'=>'a','ẳ'=>'a',
            'ẵ'=>'a','ặ'=>'a','Ắ'=>'A','Ằ'=>'A','Ẳ'=>'A','Ẵ'=>'A','Ặ'=>'A','á'=>'a','à'=>'a','ả'=>'a','ã'=>'a','ạ'=>'a','â'=>'a','ă'=>'a',
            'Á'=>'A','À'=>'A','Ả'=>'A','Ã'=>'A','Ạ'=>'A','Â'=>'A','Ă'=>'A',
			'ế'=>'e','ề'=>'e','ể'=>'e','ễ'=>'e','ệ'=>'e','Ế'=>'E','Ề'=>'E','Ể'=>'E','Ễ'=>'E','Ệ'=>'E',
            'é'=>'e','è'=>'e','ẻ'=>'e','ẽ'=>'e','ẹ'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ẻ'=>'E','Ẽ'=>'E','Ẹ'=>'E','Ê'=>'E',
			'í'=>'i','ì'=>'i','ỉ'=>'i','ĩ'=>'i','ị'=>'i','Í'=>'I','Ì'=>'I','Ỉ'=>'I','Ĩ'=>'I','Ị'=>'I',
			'ố'=>'o','ồ'=>'o','ổ'=>'o','ỗ'=>'o','ộ'=>'o','Ố'=>'O','Ồ'=>'O','Ổ'=>'O','Ô'=>'O','Ộ'=>'O',
            'ớ'=>'o','ờ'=>'o','ở'=>'o','ỡ'=>'o','ợ'=>'o','Ớ'=>'O','Ờ'=>'O','Ở'=>'O','Ỡ'=>'O','Ợ'=>'O','ó'=>'o','ò'=>'o',
            'ỏ'=>'o','õ'=>'o','ọ'=>'o','ô'=>'o','ơ'=>'o','Ó'=>'O','Ò'=>'O','Ỏ'=>'O','Õ'=>'O','Ọ'=>'O','Ô'=>'O','Ơ'=>'O',
			'ứ'=>'u','ừ'=>'u','ử'=>'u','ữ'=>'u','ự'=>'u','Ứ'=>'U','Ừ'=>'U','Ử'=>'U','Ữ'=>'U','Ự'=>'U','ú'=>'u','ù'=>'u','ủ'=>'u','ũ'=>'u',
            'ụ'=>'u','ư'=>'u','Ú'=>'U','Ù'=>'U','Ủ'=>'U','Ũ'=>'U','Ụ'=>'U','Ư'=>'U',
			'ý'=>'y','ỳ'=>'y','ỷ'=>'y','ỹ'=>'y','ỵ'=>'y','Ý'=>'Y','Ỳ'=>'Y','Ỷ'=>'Y','Ỹ'=>'Y','Ỵ'=>'Y',
			'đ'=>'d','Đ'=>'D'
  ));
}
//--admin----//

function ajax_url(){
    return APP_URL;
}
function logout_admin(){
    return APP_URL.'admin/administrator?cmd=logout';
}
function login_admin(){
    return APP_URL.'admin/administrator';
}
function admin_url($go=''){
    return APP_URL.'admin/'.$go;
}
//--frontEnd----//
function user_url() {
    return APP_URL.'tai-khoan.html';
}
function login_url() {
    return APP_URL.'dang-nhap.html';
}
function register_url() {
    return APP_URL.'dang-ky.html';
}
function logout_url() {
    return APP_URL.'dang-xuat.html';
}
function store_data_url() {
    return STATIC_URL;
}


function seller_about_url(){
    
    return APP_URL.'gioi-thieu';
}
function onetop_url(){
    
    return APP_URL;
}
function account_url($user_id=0){
    
    return APP_URL.'u/tai-khoan';
}



function news_detail_url($news_id,$news_title){
    
    return APP_URL.'tin-tuc/'.$news_id.'/'.url_title($news_title).'.html';
}


//
function detail_new($id,$title){    
    return APP_URL.'tin-tuc/'.$id.'/'.url_title($title).'.html';
}
function detail_product($id,$title){    
    return APP_URL.'san-pham/'.$id.'/'.url_title($title).'.html';
}
function list_all_news($id,$title){    
    return APP_URL.'tin-tuc';
}
function about_url(){
    return APP_URL.'gioi-thieu.html';
}
function booking_url(){
    return APP_URL.'thu-tuc-dat-xe.html';
}
function bid_url(){
    return APP_URL.'dat-lenh.html';
}
function protect_url(){
    return APP_URL.'bao-hiem-xe-oto.html';
}
function error_page(){
    return site_url();
}
function browse_url($id,$name){
    return APP_URL.'c/'.$id.'/'.url_title($name);
}

function contact_url(){
    return APP_URL.'lien-he.html';
}
function fee_url(){
    return APP_URL.'chi-phi.html';
}
//khach hang
function getMoreParam($arrParam)
{
    $str='';
    if ($arrParam)
    foreach ($arrParam as $key=>$value)
    {
        if($value)
        {
            if ($str != '')
                $str .='&'.$key.'='.$value;
            else
                $str .=$key.'='.$value;
        }
    } 
    if($str)
        $str = '?'.$str;
    return $str;
}
?>