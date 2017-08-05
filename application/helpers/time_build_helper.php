<?php
function time_difference($endtime){
    $born_date = mktime(6,30,0,7,24,2008);
    $date_diff_array = date_build($endtime, time());
    
    $days   = $date_diff_array['day'];
    $months = $date_diff_array['month'];
    $years  = $date_diff_array['year'];
    $hours  = $date_diff_array['hour'];
    $mins   = $date_diff_array['minute'];
    $secs   = $date_diff_array['second'];
    $diff   = '';
    
    if($years > 0)
        $diff .= '<strong>'.$years.'</strong> năm ';
    if($months > 0)
        $diff .= '<strong>'.$months.'</strong> tháng ';
    if($days > 0)
        $diff .= '<strong>'.$days.'</strong> ngày ';
    if($hours >= 0)
        $diff .= '<strong>'.$hours.'</strong> giờ ';
    if($mins >= 0)
        $diff .= '<strong>'.$mins.'</strong> phút ';
    //if($secs >=0)
//        $diff .= $secs.' giây';
    //$diff="'day': ".$days.",'month': ".$months.",'year': ".$years.",'hour': ".$hours.",'min': ".$mins.",'sec': ".$secs;
    return $diff;
}
function date_build($d1, $d2){
    if ($d1 < $d2){
        $temp = $d2;
        $d2 = $d1;
        $d1 = $temp;
    }
    else {
        $temp = $d1; //temp can be used for day count if required
    }
    $d1 = date_parse(date("Y-m-d H:i:s",$d1));
    $d2 = date_parse(date("Y-m-d H:i:s",$d2));
    //seconds
    if ($d1['second'] >= $d2['second']){
        $diff['second'] = $d1['second'] - $d2['second'];
    }
    else {
        $d1['minute']--;
        $diff['second'] = 60-$d2['second']+$d1['second'];
    }
    //minutes
    if ($d1['minute'] >= $d2['minute']){
        $diff['minute'] = $d1['minute'] - $d2['minute'];
    }
    else {
        $d1['hour']--;
        $diff['minute'] = 60-$d2['minute']+$d1['minute'];
    }
    //hours
    if ($d1['hour'] >= $d2['hour']){
        $diff['hour'] = $d1['hour'] - $d2['hour'];
    }
    else {
        $d1['day']--;
        $diff['hour'] = 24-$d2['hour']+$d1['hour'];
    }
    //days
    if ($d1['day'] >= $d2['day']){
        $diff['day'] = $d1['day'] - $d2['day'];
    }
    else {
        $d1['month']--;
        $diff['day'] = date("t",$temp)-$d2['day']+$d1['day'];
    }
    //months
    if ($d1['month'] >= $d2['month']){
        $diff['month'] = $d1['month'] - $d2['month'];
    }
    else {
        $d1['year']--;
        $diff['month'] = 12-$d2['month']+$d1['month'];
    }
    //years
    $diff['year'] = $d1['year'] - $d2['year'];
    return $diff;   
}

?>