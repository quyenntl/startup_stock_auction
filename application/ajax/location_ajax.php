<?php
/**
* @author Siêu Deeds
*/
class location_ajax extends CDT_Controller
{
	function load_district()
	{
		$this->load->cache(array("adapter"=>"file","cache_path"=>CACHE_PATH.'location'.DS));
		$zone_id = $this->input->get('zone_id');

		$district_list  = $this->cache->get($zone_id.'.cache');        
        if(empty($district_list)){
            $this->load->library('cache_local');
            $district_list  = $this->cache_local->get_cache_district($zone_id);
        }        
        $html   = '<option value="0">Quận/Huyện</option>';
		foreach ($district_list as $key => $value) {		    
            $html .= '<option value='.$key.'>'.$value.'</option>';
        }    		
		echo $html;
	}
}