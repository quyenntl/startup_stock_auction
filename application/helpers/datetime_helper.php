<?php
function string_to_time($str, $format = '', $date_time_delimiter = ' ', $date_delimiter = '/', $time_delimiter = ':') {
	$str = trim($str);
	str_replace('  ', ' ',$str);
	str_replace(' '.$date_delimiter, $date_delimiter,$str);
	str_replace($date_delimiter.' ', $date_delimiter,$str);
	str_replace(' '.$time_delimiter, $time_delimiter,$str);
	str_replace($time_delimiter.' ', $time_delimiter,$str);
	//Get date and time
	$date_time = explode($date_time_delimiter, $str);
	//Check date array
	if (strpos($date_time[0], $date_delimiter)) {
		$date = explode($date_delimiter, $date_time[0]);
		$time = explode($time_delimiter, $date_time[1]);
	} else {
		$date = explode($date_delimiter, $date_time[1]);
		$time = explode($time_delimiter, $date_time[0]);
	}
//echo $date_time[0]; var_dump(strpos($date_time[0], $date_delimiter)); die;
	if($format == '') {
		$format = 'd/m/Y H:i:s';
		return mktime($time[0],$time[1],$time[2],$date[1],$date[0],$date[2]);
	} else {
		return date($format, mktime($time[0],$time[1],$time[2],$date[1],$date[0],$date[2]));
	}
}

function date_to_time ($str,$date_delimiter = '/') {
	//writer: KienNT
	//Format: $str = d/m/Y
	$date = explode($date_delimiter, $str);
	return mktime(0,0,0,$date[1],$date[0],$date[2]);
}

function dates_in_between($date1, $date2) {
	//writer: KienNT
	//Format: $date (Y/m/d)
	//Usage	: dates_in_between('2001-12-28', '2002-01-01');
	//Result: array;
	$day = 60*60*24;

	$date1 = strtotime($date1);
	$date2 = strtotime($date2);

	$days_diff = round(($date2 - $date1)/$day); // Unix time difference devided by 1 day to get total days in between

	$dates_array = array();

	$dates_array[] = date('d/m/Y',$date1);

	for($x = 1; $x < $days_diff; $x++){
		$dates_array[] = date('d/m/Y',($date1+($day*$x)));
	}

	$dates_array[] = date('d/m/Y',$date2);

	return $dates_array;
}

function count_day_in_month($thang,$nam){
    $ngay=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
    if (($nam%4==0 && $nam%100!=0) || $nam%400==0) $ngay[2]=29;
	
    return $ngay[$thang];
}
/* Hàm tính khoảng cách thời gian hiện tại so với thời gian cũ */
function timespent($date)
{
	$today = time();
	$target = $date;
	$difference =($today-$target);

	if ($difference >= 365*86400)
	{
		$days = (int) ($difference/(365*86400));
		return $days . " năm trước";
	}
	if ($difference >= 30*86400 && $difference < 365*86400)
	{
		$days = (int) ($difference/(30*86400));
		return $days . " tháng trước";
	}
	elseif ($difference >= 86400 && $difference < 30*86400)
	{
		$days = (int) ($difference/86400);
		return $days . " ngày trước";
	}
	elseif ($difference < 86400 && $difference >= 3600)
	{
		$days = (int) ($difference/3600);
		return $days . " giờ trước";
	}
	elseif ($difference < 3600 && $difference >= 60)
	{
		$days = (int) ($difference/60);
		return $days . " phút trước";
	}
	elseif ($difference < 60)
	{
		$days = (int) ($difference/1);
		return $days . " giây trước";
	}
}
?>