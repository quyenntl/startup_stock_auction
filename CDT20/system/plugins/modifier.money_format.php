<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty money_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     money_format<br>
 * Purpose:  Formats a number as a currency string
 * @link http://www.php.net/money_format
 * @param float
 * @param string format (default %n)
 * @return string
 */
function smarty_modifier_money_format($string, $decimals=0, $dec_point=",", $thousands_sep=".")
{
    if (is_numeric($string)) // check if it's a number
    {
        return number_format($string, $decimals, $dec_point, $thousands_sep);
    }
    else
    {
        return $string;
    }
} 
?>
