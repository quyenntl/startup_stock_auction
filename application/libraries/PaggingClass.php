<?php
class PaggingClass{
    private $CDT;
    function __construct(){
        $this->CDT = &get_instance();
    }
    function pagging_ajax($total, $perPage, $numPageShow=10, $classNormal='',$page_name='page_no', $classCurrent = '')
    {
        $content='';
        $totalpage = ceil($total/$perPage); 
        $currentpage = $this->CDT->input->get($page_name);
        if($currentpage == 'NULL')
            $currentpage = 1; 
       // $currentpage=round($currentpage);
        if($classCurrent == '')
            $classCurrent = 'class="pagActive"';
        else
           $classCurrent = 'class="'.$classCurrent.'"';
        if($classNormal){
            $classText = $classNormal;
            $classNormal = 'class="'.$classNormal.'"';
        }
        if($currentpage <= 0 || $currentpage > $totalpage)
        {
            $currentpage = 1;
        }
        
        if($currentpage > ($numPageShow/2))
        {
            $startpage = $currentpage-floor($numPageShow/2);
            if(($totalpage - $startpage) < $numPageShow)
            {
                $startpage = $totalpage - $numPageShow + 1;
            }
        }
        else
        {
            $startpage = 1;
        }
        if($startpage < 1)
        {
            $startpage = 1;
        }        
        //Link den trang truoc
        if($currentpage > 1)
        {
            $content.= '<li><A class="pagFirt '.$classText.'" href="javascript:;" rel = "'.($currentpage-1).'" >Trước</A></li>';
        }
        //Danh sach cac trang        
        if($startpage > 1)
        {
            $content.= '<li><a '.$classNormal.' href="javascript:;" rel= "1">1</a></li>';            
        }
        for($i = $startpage; $i <= ($startpage + $numPageShow - 1) && $i <= $totalpage; $i++)
        {
            if($i == $currentpage)
            {
                $content.= '<li ><a '.$classCurrent.' href="javascript:;" rel="javascript:;">'.$i.'</a></li>';
            }
            else 
            {
                $content.= '<li><a '.$classNormal.' href="javascript:;" rel= "'.$i.'">'.$i.'</a></li>';
            }
        }
        if($i == $totalpage)
        {
            $content.= '<li><a '.$classNormal.' href="javascript:;" rel= "'.$totalpage.'">'.$totalpage.'</a></li>';
        }
        else
            if($i < $totalpage and !$isNotAll)
            {
                $content.= '<li>...</li><li><a '.$classNormal.' href="javascript:;" rel= "'.$totalpage.'">'.$totalpage.'</a></li>';
            }        
        //Trang sau
        if($currentpage < $totalpage)
        {
            $content.= '<li><A class="pageLast '.$classText.'" href="javascript:;" rel="'.($currentpage+1).'" >Sau</A></li>';
        }
        if($totalpage < 2)
            $content='';
        if($content == '')
            return $content;
        else
            return '<ul class="pagination clearfix">'.$content.'</ul>';
    }
    function pagging($total, $perPage, $numPageShow=10, $classNormal='',$page_name='page_no', $classCurrent = '')
    {
        $urlCurrent = $this->curPageURL($page_name);
        $content='';
        $totalpage = ceil($total/$perPage); 
        $currentpage = $this->CDT->input->get($page_name);
        if($currentpage == 'NULL')
            $currentpage = 1; 
       // $currentpage=round($currentpage);
        if($classCurrent == '')
            $classCurrent = 'class="pagActive"';
        else
           $classCurrent = 'class="'.$classCurrent.'"';
        if($classNormal){
            $classText = $classNormal;
            $classNormal = 'class="'.$classNormal.'"';
        }
        if($currentpage <= 0 || $currentpage > $totalpage)
        {
            $currentpage = 1;
        }
        
        if($currentpage > ($numPageShow/2))
        {
            $startpage = $currentpage-floor($numPageShow/2);
            if(($totalpage - $startpage) < $numPageShow)
            {
                $startpage = $totalpage - $numPageShow + 1;
            }
        }
        else
        {
            $startpage = 1;
        }
        if($startpage < 1)
        {
            $startpage = 1;
        }        
        //Link den trang truoc
        $url = '';
        if($currentpage > 1)
        {
            $url = $urlCurrent.$page_name.'='.($currentpage-1);
            $content.= '<li><A class="pagFirt '.$classText.'" href="'.$url.' ">Trước</A></li>';
        }
        //Danh sach cac trang        
        if($startpage > 1)
        {
            $url = $urlCurrent.$page_name.'=1';
            $content.= '<li '.$classNormal.'><a  href="'.$url.' ">1</a></li>';            
        }
        for($i = $startpage; $i <= ($startpage + $numPageShow - 1) && $i <= $totalpage; $i++)
        {
            if($i == $currentpage)
            {
                $content.= '<li  '.$classCurrent.'><a href="javascript:;" rel="javascript:;">'.$i.'</a></li>';
            }
            else 
            {
                $url = $urlCurrent.$page_name.'='.$i;
                $content.= '<li '.$classNormal.'><a  href="'.$url.' ">'.$i.'</a></li>';
            }
        }
        if($i == $totalpage)
        {
            $url = $urlCurrent.$page_name.'='.$totalpage;
            $content.= '<li '.$classNormal.'><a  href="'.$url.' ">'.$totalpage.'</a></li>';
        }
        else
            if($i < $totalpage and !$isNotAll)
            {
                $url = $urlCurrent.$page_name.'='.$totalpage;
                $content.= '<li>...</li><li '.$classNormal.'><a  href="'.$url.' ">'.$totalpage.'</a></li>';
            }        
        //Trang sau
        if($currentpage < $totalpage)
        {
            $url = $urlCurrent.$page_name.'='.($currentpage+1);
            $content.= '<li><A class="pageLast '.$classText.'" href="'.$url.' ">Sau</A></li>';
        }
        if($totalpage < 2)
            $content='';
        if($content == '')
            return $content;
        else
            return '<ul class="pagination clearfix">'.$content.'</ul>';
    }
    function curPageURL($page_name){
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        if(strpos($pageURL,'?')){
            if(strpos($pageURL,'?'.$page_name) > 0){
                return substr($pageURL,0,strpos($pageURL,$page_name));
            }
            if(strpos($pageURL,$page_name) > 0){
                return substr($pageURL,0,strpos($pageURL,'&'.$page_name)).'&';
            }
            return $pageURL.'&';
        }
        else{
            return $pageURL.'?';
        }
    }
    
    function curPageURLNONE($page_name){
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
        /*if(strpos($pageURL,'?')){
            if(strpos($pageURL,'?'.$page_name) > 0){
                return substr($pageURL,0,strpos($pageURL,$page_name));
            }
            if(strpos($pageURL,$page_name) > 0){
                return substr($pageURL,0,strpos($pageURL,'&'.$page_name)).'&';
            }
            return $pageURL.'&';
        }
        else{
            return $pageURL.'?';
        }*/
    }
}
?>