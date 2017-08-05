<?php
if ( ! defined('IN_CDT')) exit('No direct script access allowed');
/**
 * Hàm thực hiện nhiệm vụ build ra ảnh để hiển thị hoặc trả về đường dẫn ảnh
 * Sinh ra các thumb tương ứng của ảnh theo điều kiện truyền vào
 * @author vunn(vunn@peacesoft.net)
 */
class Image {
    private $CDT;
    private $server;
    /**
     * Khởi tạo con trỏ CDT
     */
    function __construct(){
        $this->CDT = &get_instance();
        $this->get_server();
    }
    /**
     * Lấy auto server ảnh
     */
    function get_server(){
        $server_arr = $this->CDT->config->item('server_image');
		$key = array_rand($server_arr);
		$this->server = $server_arr[$key];
    }
	/**
	* Sinh url rewrite
	* 
	* @param mixed $type
	*/
	function rewriteUrl($type){
		switch($type){			
            case 'product_images':
               return $this->server.'product_images';
            case 'news':
                return $this->server.'news';
            case 'products':
                return $this->server.'products';
            case 'img_about':
                return $this->server.'img_about';
            case 'slide_img':
                return $this->server.'slide_img';
            case 'service_img':
                return $this->server.'service_img';
            case 'provide':
                return $this->server.'provide';
            case 'car_type':
                return $this->server.'car_type'; 
			default:
				return $this->server.'default';
		}
	}
	/**
	* Sinh html file ảnh
	* 
	* @param mixed $url
	* @param mixed $class
	* @param mixed $extra
	* @param mixed $loader
	*/
	function generateImage($url,$alt='oto',$class,$extra){
		if($class!=null)
			$class = 'class ="'.$class.'"';
		if($alt!=null)
			$alt = 'alt ="'.$alt.'"';
		return '<img src="'.$url.'" '.$class.' '.$alt.' '.$extra.'/>';
	}
    /**
	* Hàm check file exists thumb 5-sdfghx50x50.png
    * @param:
	* 
	*/
	function checkFile($imagePath, $width = "", $height ="", $default=true,$overWrite=false){
		$pathInfo = pathinfo($imagePath);
		if($pathInfo['dirname'] =="."){
			$pathInfo['dirname'] = "";    
		}else{
			$pathInfo['dirname'] = $pathInfo['dirname'].DS;    
		}
        // Kiểm tra xem có phải là đang lấy trong thư mục con không?
        $fileName = $pathInfo['filename'];
        $dirName = $pathInfo['dirname'];
      
        if(!isset($pathInfo['extension']) || $fileName ==""){
            // Lấy ảnh default nếu cần
            if($default !=true){
                return false;
            }
            $arrDirName = explode('/',$dirName);
            $dirName = $arrDirName[0].'/'; 
            
            return $this->resizeImageDefault($dirName,$width,$height);
		}
      
        $fileNameFull = $fileName.'_'.$width.'_'.$height.".".$pathInfo['extension'];
        
        // Tên ảnh lưu dưới dạng name_50.gif
        
       
		if(!file_exists(STORE_DATA.$dirName.'thumb'.DS.$fileNameFull) || $overWrite == true){
		    if(file_exists(STORE_DATA.$pathInfo['dirname'].$pathInfo['basename'])){
                if(file_exists(STORE_DATA.$pathInfo['dirname'].'thumb/') == false){
                    mkdir(STORE_DATA.$pathInfo['dirname'].'thumb/',0777,true);
                    //chmod(STORE_DATA.$pathInfo['dirname'].'thumb/',0777);
                }
                return $this->resizeImage($imagePath,$width,$height);
            }
            if($default !=true){
                return false;
            }
            $arrDirName = explode('/',$dirName);
            $dirName = $arrDirName[0].'/'; 
            return $this->resizeImageDefault($dirName,$width,$height);
		}
		return true;
	}
    /**
     * Sinh ảnh thumb cho ảnh mặc định
     */
    function resizeImageDefault($dirname,$width="",$height=""){
        $file_default_name = str_replace('/','',$dirname);
        if(file_exists(STORE_DATA.'default'.DS.$dirname.'thumb'.DS.$file_default_name.'_'.$width.'_'.$height.".png")){
            return $this->server.'default'.DS.$dirname.'thumb'.DS.$file_default_name.'_'.$width.'_'.$height.".png";
        }
        if(file_exists(STORE_DATA.'default'.DS.$dirname.$file_default_name.".png")){
            // sinh ảnh thumb tương ứng cho ảnh default
            $imageDefault = 'default'.DS.$dirname.$file_default_name.".png";
            // Tạo ảnh thumb default
            $this->CDT->load->library('image_lib');
            $config['source_image'] = STORE_DATA.$imageDefault;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE; // Sinh anh theo width, height truyền vào. Mặc định TRUE là lấy ảnh vuông :D
            $config['thumb_marker'] = '_'.$width.'_'.$height;
            $config['new_image'] = STORE_DATA.'default'.DS.$dirname.'thumb';
            $config['width'] = $width;
            $config['height'] = $height;
            $this->CDT->image_lib->initialize($config);
            if($this->CDT->image_lib->resize()){
                unset($config);
                $this->CDT->image_lib->clear();
                return $this->server.'default'.DS.$dirname.'thumb'.DS.$file_default_name.'_'.$width.'_'.$height.".png";
            }
            return false;
        }
        return false;
    }
    /**
     * Resize ảnh vào các thumb
     * Khi tồn tại ảnh gốc và không tồn tại ảnh thumb mới gọi hàm này
     */  
     function resizeImage($imagePath,$width="",$height=""){
        //$this->watermark($imagePath,$width,$height);
        $pathInfo = array();
        $imageThumbName = '';
        
        $pathInfo = pathinfo($imagePath);
       
        $imageThumbName = '_'.$width.'_'.$height;
      
        $this->CDT->load->library('image_lib');
        $config['source_image'] = STORE_DATA.$imagePath;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;  //Sinh anh theo width, height truy?n vào. M?c d?nh TRUE là l?y ?nh vuông :D
        $config['thumb_marker'] = $imageThumbName;
        $config['new_image'] = STORE_DATA.$pathInfo['dirname'].DS.'thumb';
        $config['width'] = $width;
        $config['height'] = $height;
        $this->CDT->image_lib->initialize($config);
        if($this->CDT->image_lib->resize()){
            unset($config);
            $this->CDT->image_lib->clear();
            return true;
        }
        return false;
     }
    function watermark($imagePath,$width,$height){
        $this->CDT->load->library('image_lib');
        $configwater['source_image'] = STORE_DATA.$imagePath;
        
        $configwater['maintain_ratio'] = FALSE;  //Sinh anh theo width, height truy?n vào. M?c d?nh TRUE là l?y ?nh vuông :D
        $configwater['create_thumb'] = FALSE;
        $configwater['width'] = $width;
        $configwater['height'] = $height;
        $configwater['thumb_marker'] = '';
        $configwater['wm_type'] = 'overlay';
                        
        $configwater['wm_overlay_path'] = STORE_DATA.'logo.png';
        $configwater['wm_vrt_alignment'] = 'bottom';
        $configwater['wm_hor_alignment'] = 'right';
        $configwater['wm_padding'] = '1';
        $configwater['wm_x_transp'] = 4;
        $configwater['wm_y_transp'] = 5;
        $this->CDT->image_lib->initialize($configwater);
        if($this->CDT->image_lib->watermark()){
            unset($configwater);
            $this->CDT->image_lib->clear();
            return true;
        }
        return false;
    }
    /**
	* Ảnh user
    * @param $imgName: Tên ảnh gốc, $config: các thông số cấu hình cho ảnh
	* 
	*/
	function userImage($imgName='',$config=array()){
	    $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
	    $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        if($imgName == '')
            $imgName = 'users.png';
		$checkFileDefault = $this->checkFile('users'.DS.$imgName,$width,$height,$default,true);
        
		if( $checkFileDefault !== true){
			if($checkFileDefault == false){
				return false; 
			}else{
			    if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
			}
		}
		$pathInfo = pathinfo($imgName);
		$imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
		$server = $this->server;
        if($width == '')
            $url =  $this->rewriteUrl('user').DS.$imageName;
        else
            $url =  $this->rewriteUrl('user').DS.'thumb'.DS.$imageName;
		if($src) 
            return  $url;  
              
		return $this->generateImage($url,$alt,$class,$extra);
	}
    /**
    * anh tin tuc   
    */
    function newsImage($imgName='',$config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        
        if($imgName == '')
            $imgName = 'news.gif';            
        $checkFileDefault = $this->checkFile('news'.DS.$imgName,$width,$height,$default,true);
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        $server = $this->server;
        if($width == '')
            $url =  $this->rewriteUrl('news').DS.$imageName;
        else
            $url =  $this->rewriteUrl('news').DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url;  
              
        return $this->generateImage($url,$alt,$class,$extra);
    }

    function productImage($imgName='',$config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        
        if($imgName == '')
            $imgName = 'news.gif';            
        $checkFileDefault = $this->checkFile('products'.DS.$imgName,$width,$height,$default,true);
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        $server = $this->server;
        if($width == '')
            $url =  $this->rewriteUrl('products').DS.$imageName;
        else
            $url =  $this->rewriteUrl('products').DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url;  
              
        return $this->generateImage($url,$alt,$class,$extra);
    }
    function aboutImage($imgName='',$config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        
        if($imgName == '')
            $imgName = 'news.gif';            
        $checkFileDefault = $this->checkFile('img_about'.DS.$imgName,$width,$height,$default,true);
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        $server = $this->server;
        if($width == '')
            $url =  $this->rewriteUrl('img_about').DS.$imageName;
        else
            $url =  $this->rewriteUrl('img_about').DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url;  
              
        return $this->generateImage($url,$alt,$class,$extra);
    }
    /**
    * Ảnh san pham
    * @param $imgName: idusser-id_deal-Tên ảnh gốc, $config: các thông số cấu hình cho ảnh    
    */
    function product_img($imgName='', $config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        if($imgName == '')
            $imgName = 'news.png';
        $checkFileDefault = $this->checkFile('product_images/'.$imgName,$width,$height,$default);
        
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
       // if(isset($pathInfo['dirname']))
         //   $imageName = $pathInfo['filename'].'_'.$pathInfo['dirname'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        $server = $this->server;
        
        if($width == '')
            $url =  $this->rewriteUrl('product_images').DS.$imageName;
        else
            $url =  $this->rewriteUrl('product_images').DS.$pathInfo['dirname'].DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url;     
        $isLoader = isset($config['is_loader']) ? $config['is_loader'] : true;
        return $this->generateImage($url,$alt,$class,$extra,$isLoader,$width,$height);
    }    
    
     /**
    * Ảnh san pham
    * @param $imgName: idusser-id_deal-Tên ảnh gốc, $config: các thông số cấu hình cho ảnh    
    */
    function service_img($imgName='', $config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        if($imgName == '')
            $imgName = 'news.png';
        $checkFileDefault = $this->checkFile('service_img/'.$imgName,$width,$height,$default);        
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
       // if(isset($pathInfo['dirname']))
         //   $imageName = $pathInfo['filename'].'_'.$pathInfo['dirname'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        $server = $this->server;
        
        if($width == '')
            $url =  $this->rewriteUrl('service_img').DS.$imageName;
        else
            $url =  $this->rewriteUrl('service_img').DS.$pathInfo['dirname'].DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url;     
        $isLoader = isset($config['is_loader']) ? $config['is_loader'] : true;
        return $this->generateImage($url,$alt,$class,$extra,$isLoader,$width,$height);
    }    
    function provide_img($imgName='', $config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        if($imgName == '')
            $imgName = 'provide.png';
        $checkFileDefault = $this->checkFile('provide/'.$imgName,$width,$height,$default);        
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
       // if(isset($pathInfo['dirname']))
         //   $imageName = $pathInfo['filename'].'_'.$pathInfo['dirname'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        $server = $this->server;
        
        if($width == '')
            $url =  $this->rewriteUrl('').DS.$imageName;
        else
            $url =  $this->rewriteUrl('provide').DS.$pathInfo['dirname'].DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url;     
        $isLoader = isset($config['is_loader']) ? $config['is_loader'] : true;
        return $this->generateImage($url,$alt,$class,$extra,$isLoader,$width,$height);
    }
    function slide_img($imgName='', $config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        if($imgName == '')
            $imgName = 'provide.png';
        $checkFileDefault = $this->checkFile('slide_img/'.$imgName,$width,$height,$default);        
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
       // if(isset($pathInfo['dirname']))
         //   $imageName = $pathInfo['filename'].'_'.$pathInfo['dirname'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        $server = $this->server;
        
        if($width == '')
            $url =  $this->rewriteUrl('').DS.$imageName;
        else
            $url =  $this->rewriteUrl('slide_img').DS.$pathInfo['dirname'].DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url;     
        $isLoader = isset($config['is_loader']) ? $config['is_loader'] : true;
        return $this->generateImage($url,$alt,$class,$extra,$isLoader,$width,$height);
    }
    function car_type_img($imgName='', $config=array()){
        $width      = isset($config['width']) ? $config['width'] : '50';
        $height      = isset($config['height']) ? $config['height'] : '50';
        $default    = isset($config['default']) ? $config['default']: true; // Check cho lấy ảnh mặc định ko (true or false)
        $src        = isset($config['src']) ? $config['src'] : false;   // Có lấy đường dẫn ảnh không (true or false)
        $alt        = isset($config['alt']) ? $config['alt'] : '';
        $class      = isset($config['class']) ? $config['class'] : '';
        $extra      = isset($config['extra']) ? $config['extra'] : '';
        
        if(!$imgName){
            $imgName = 'default_car.jpg';
        }            
        $checkFileDefault = $this->checkFile('car_type'.DS.$imgName,$width,$height,$default,true);        
        if( $checkFileDefault !== true){
            if($checkFileDefault == false){
                return false; 
            }else{
                if($src)
                    return $checkFileDefault;
                return $this->generateImage($checkFileDefault,$alt,$class,$extra);
            }
        }
        $pathInfo = pathinfo($imgName);
        $imageName = $pathInfo['filename'].'_'.$width.'_'.$height.".".$pathInfo['extension'];
        
        $server = $this->server;
        if($width == '')
            $url =  $this->rewriteUrl('car_type').DS.$imageName;
        else
            $url =  $this->rewriteUrl('car_type').DS.'thumb'.DS.$imageName;
        if($src) 
            return  $url; 
              
        return $this->generateImage($url,$alt,$class,$extra);
    }
    function resize_image($image_name = '', $dir = '', $option = array())
    {
        $cropped_image = STORE_DATA.$dir.DS.$image_name;
        if(!file_exists($cropped_image) || $image_name == '')
        {
            return STATIC_URL.'default_300_300.png';
        }
        if(!file_exists(STORE_DATA.$dir.DS.'thumb'))
        {
            @mkdir(STORE_DATA.$dir.DS.'thumb',0777,true);;
        }
        $path_crop_img = pathinfo($cropped_image);

        $source_image  = $path_crop_img['dirname'].DS.'thumb'.DS.$path_crop_img['filename'].'_'.$this->CDT->config->item('pic_width').'_'.$this->CDT->config->item('pic_height').".".strtolower($path_crop_img['extension']);
        $this->CDT->load->library('image_lib');
        if(!file_exists($source_image))
        {
            $config['source_image']   = $cropped_image;
            $config['new_image']      = $source_image;
            $config['maintain_ratio'] = TRUE;
            $config['master_dim']     = 'width';
            $config['width']          = $this->CDT->config->item('pic_width');
            $config['height']         = $this->CDT->config->item('pic_height');
            
            $this->CDT->image_lib->initialize($config);
            $this->CDT->image_lib->resize();
            unset($config);
        }        

        $width        = isset($option['width']) ? $option['width'] : '300';
        $height       = isset($option['height']) ? $option['height'] : '300';
        $src          = isset($option['src']) ? $option['src'] : false;
        
        $path_info = pathinfo($source_image);
        $new_image      = $path_info['dirname'].DS.$path_crop_img['filename'].'_'.$width.'_'.$height.".".strtolower($path_info['extension']);
              
        $new_image_name = STATIC_URL.$dir.DS.'thumb'.DS.$path_crop_img['filename'].'_'.$width.'_'.$height.'.'.strtolower($path_info['extension']);
        
        if(file_exists($new_image))
        {
            if($src == true)
            {
                return $new_image_name;
            }
            else
            {
                return false;
            }           
        }
        $config['source_image']   = $source_image;
        $config['new_image']      = $new_image;
        $config['maintain_ratio'] = TRUE;
        $config['master_dim']     = 'width';
        $config['width']          = $width;
        $config['height']         = $height;
        
        $this->CDT->image_lib->clear();
        $this->CDT->image_lib->initialize($config);

        if ( ! $this->CDT->image_lib->resize())
        {
            echo $this->CDT->image_lib->display_errors();
        }
        else
        {
            if($src == true)
            {
                return $new_image_name;
            }
            else
            {
                return false;
            }
        }
        return false;
    }
}
?>