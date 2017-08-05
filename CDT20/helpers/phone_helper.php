<?php
/**
 * Helper dùng để check số điện thoại có đúng chuẩn không
 * @author vunn(vunn@peacesoft.net)
 */
if ( ! function_exists('mobiphone_type'))
{
	function mobiphone_type($mobile_phone)
	{
	   if($mobile_phone){
    		$lengthPhone = strlen($mobile_phone);
            if($lengthPhone < 6 || $lengthPhone > 20 || preg_match('/[^0-9_]/',$mobile_phone) == 1){
                return 'Số điện thoại của bạn không đúng chuẩn';
            }else{
                return 'SUCCESS';
            }
        }
        return 'Chưa nhập số điện thoại';
	}
}

?>