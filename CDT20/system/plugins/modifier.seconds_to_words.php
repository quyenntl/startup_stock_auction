<?php
/**
 * @copyright 2010 MAPIX Technologies Ltd, UK, http://mapix.com/
 * @license http://en.wikipedia.org/wiki/BSD_licenses  BSD License
 * @package Smarty
 * @subpackage PluginsModifier
 * @edit : huandt@peacesoft
 */


function smarty_modifier_seconds_to_words($seconds) {
    if ($seconds < 0) throw new Exception("Can't do negative numbers!");
    if ($seconds == 0) return "Còn 0 giờ 0 phút 0 giây";
    
    $day = intval($seconds/86400);
    
    $hours = intval(($seconds%86400)/pow(60,2));
    
    $minutes = intval((($seconds%86400)%pow(60,2))/60);
    
    $out = "Còn ";
    if($day > 0) $out .=  $day. " ngày ";
    if($hours >= 0) $out .= $hours . " giờ ";
    if($minutes >= 0) $out .= $minutes . " phút";
       
    return trim($out);
}
?>