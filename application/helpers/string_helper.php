<?php
function short($string, $limit, $break=" ", $pad="...")
{
    if(strlen($string) <= $limit) return $string;
    if(false !== ($breakpoint = strpos($string, $break, $limit)))
    {
        if($breakpoint < strlen($string) - 1)
        {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }
    return $string;
}
?>