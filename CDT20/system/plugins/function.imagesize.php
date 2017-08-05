<?php
require_once(SYSTEM_PATH."wide/WideImage.php");
error_reporting(0);
function smarty_function_imagesize($params, &$smarty)
{    
    $imageDefaul    = isset($params['default']) ? $params['default'] : 'default.png';
    
    if($params['src'] == NULL){
         return model_image($imageDefaul, $params);
    }
    
    if(!CACHE_IMAGE){
        return model_image($params['src'], $params);
    }
   
    //$imageName      = strstr($params['src'],'.');
    $imageName      = strstr($params['src'],'.',true);
    //echo $imageName;die;
    $thumbName      = 'thumb_'.end(explode('/',$imageName)).'_'.$params['width'].'x'.$params['height'];
    $ext            = '.png';
    $folderSource   = isset($params['source']) ? $params['source']: "unknow";
    $linkOrigin     = $folderSource.'/'.$params['src'];

    try{
        $arrUrl = explode('/',$params['src']);
        
        if(count($arrUrl) > 1)
        {
            for($i = 0; $i < count($arrUrl) - 1; $i++)
            {
                $folderSource .= '/'.$arrUrl[$i]; 
               
               if(!is_dir(STORE_DATA.$folderSource)){
                    @mkdir(STORE_DATA.$folderSource,DIR_WRITE_MODE);   
                }
            }
        }
        
        if(!is_dir(STORE_DATA.$folderSource."/thumb")){    
            @mkdir(STORE_DATA.$folderSource."/thumb",DIR_WRITE_MODE);
        }

        if(!file_exists(STORE_DATA.$linkOrigin)){
            return model_image($imageDefaul, $params);
        }else{
            $image          = WideImage::load(STORE_DATA.$linkOrigin);
        }
    }
    
    catch(Exceptions $e){
        return model_image($imageDefaul, $params);
    }
    
    if(!$image){
            return model_image($imageDefaul, $params);
    }
    
    if(!file_exists(STORE_DATA.$folderSource."/thumb/".$thumbName.$ext)){
        $image->resize($params['width'],$params['height'],'inside','down')->saveToFile(STORE_DATA.$folderSource."/thumb/".$thumbName.$ext);    
    }
    
    $image->destroy();
    return model_image($folderSource."/thumb/".$thumbName.$ext, $params);
}

function model_image($image_name, $params){
    if($params['link'] == true)
    {
        if(CACHE_IMAGE)
            return STATIC_URL.$image_name;
        
        return STATIC_URL.$image_name;

    }
    
    if(CACHE_IMAGE)
        return '<img src="'. STATIC_URL.$image_name .'" style=max-width:'.$params['width'].'px;max-height:'.$params['height'].'px;" alt="'. $params['alt']. '" rel="'. $params['rel']. '" class="'. $params['class']. '"/>';
        
    return '<img src="'. STATIC_URL.$image_name .'" alt="'. $params['alt']. '" style=max-width:'.$params['width'].'px;max-height:'.$params['height'].'px;" rel="'. $params['rel']. '" class="'. $params['class']. '" />';
}

?>