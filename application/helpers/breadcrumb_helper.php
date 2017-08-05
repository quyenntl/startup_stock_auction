<?php
/** 
* @author Siêu Deeds
*/
function breadcrumb($mode = 'item', $data_category = array(), $data_item = array(), $data_news = array())
{	
	$deeds =& get_instance();
	if($data_category)
	{
		$deeds->load->library('CategoryTree');
		$deeds->load->helper('string');
		$parent_category = $deeds->categorytree->get_parent_category($data_category['parent_id']);
		
		//Trả nguyên về HTML về sau sửa html breadcrumb chỉ sửa trong helper là ok
		if($mode == 'browser')
		{
			if($parent_category)
			{
				$breadcrumb = '
				<div class="pathway mgt10">
				   	<ul>
				    	<li><a href="'.base_url().'">Trang chủ </a></li>
				    	<li><a href="'.navigation_url($parent_category['name_ascii']).'">'.$parent_category['name'].' </a></li>
				    	<li><a href="javascript:;" class="active">'.$data_category['name'].' </a></li>
				    </ul>
				</div>';
			}
			else
			{
				$breadcrumb = '
				<div class="pathway mgt10">
				   	<ul>
				    	<li><a href="'.base_url().'">Trang chủ </a></li>
				    	<li><a href="javascript:;" class="active">'.$data_category['name'].' </a></li>
				    </ul>
				</div>';
			}
			
		}
		else if($mode == 'item')
		{
			$breadcrumb = '<div class="pathway mgt10">
			   	<ul>
			    	<li><a href="'.base_url().'">Trang chủ </a></li>
			    	<li><a href="'.navigation_url($parent_category['name_ascii']).'">'.$parent_category['name'].' </a></li>
			    	<li><a href="'.navigation_url($data_category['name_ascii']).'">'.$data_category['name'].' </a></li>
			    	<li><a href="javascript:;" class="active">'.short($data_item['title_short'], 90, $break=" ", $pad="...").' </a></li>
			    </ul>
			</div>';
		}

		return $breadcrumb;
	}
}
?>