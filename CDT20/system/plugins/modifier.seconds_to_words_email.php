<?php
/**
 * @copyright 2010 MAPIX Technologies Ltd, UK, http://mapix.com/
 * @license http://en.wikipedia.org/wiki/BSD_licenses  BSD License
 * @package Smarty
 * @subpackage PluginsModifier
 * @edit : huandt@peacesoft
 */


function smarty_modifier_seconds_to_words_email($seconds) {
    if ($seconds < 0) throw new Exception("Can't do negative numbers!");
    if ($seconds == 0) return '<span style="font-weight:bold;color:#333">0</span> giờ <span style="font-weight:bold;color:#333">0</span> phút';
    
    $day = intval($seconds/86400);
    
    $hours = intval(($seconds%86400)/pow(60,2));
    
    $minutes = intval((($seconds%86400)%pow(60,2))/60);
    
    $out = '<span style="font-weight:bold;color:#333">';
    if($day > 0) $out .=  $day. '</span> ngày <span style="font-weight:bold;color:#333">';
    if($hours >= 0) $out .= $hours . '</span> giờ <span style="font-weight:bold;color:#333">';
    if($minutes >= 0) $out .= $minutes . '</span> phút';
       
    return trim($out);
}
?>