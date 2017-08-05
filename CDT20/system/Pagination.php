<?php  if ( ! defined('IN_CDT')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
class Pagination {

	var $base_url			= ''; // The page we are linking to
    var $end_url            = ''; // parram của url
	var $total_rows  		= 0; // Total number of items (database results)
	var $per_page	 		= 10; // Max number of items you want shown per page
	var $num_links			=  2; // Number of "digit" links to show before/after the currently viewed page
	var $cur_page	 		=  0; // The current page being viewed
	var $first_link   		= '&lsaquo;&lsaquo; First';
	var $next_link			= 'Next ';
	var $prev_link			= ' Prev';
	var $last_link			= 'End &rsaquo;&rsaquo;';
	var $uri_segment		= 3;
	var $full_tag_open		= '';
	var $full_tag_close		= '</li>';
	var $first_tag_open		= '<li>';
	var $first_tag_close	= '</li>';
	var $last_tag_open		= '<li>';
	var $last_tag_close		= '';
	var $cur_tag_open		= '<li><a class="paging-active" href="javascript:;">';
	var $cur_tag_close		= '</a></li>';
	var $next_tag_open		= '<li>';
	var $next_tag_close		= '</li>';
	var $prev_tag_open		= '<li>';
	var $prev_tag_close		= '</li>';
	var $num_tag_open		= '<li>';
	var $num_tag_close		= '';
	var $page_query_string	= FALSE;
	var $query_string_segment = 'per_page';
    var $id                 = '';
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	function Pagination($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}

		log_message('debug', "Pagination Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */
	function create_links()
	{
	   $output = '<li>Tổng số: '.$this->total_rows.'</li>';
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			return '<ul>'.$output.'</ul>';
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			return '<ul>'.$output.'</ul>';
		}

		// Determine the current page number.
		$CDT =& get_instance();
        
		if ($CDT->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CDT->input->get($this->query_string_segment) != 0)
			{
				$this->cur_page = $CDT->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
            
		}
		else
		{
		      
			if ($CDT->uri->segment($this->uri_segment) != 0)
			{
				$this->cur_page = $CDT->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;               
			}
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page) || $this->cur_page == 0)
		{
			$this->cur_page = 1;
		}
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}

		$uri_page_number = $this->cur_page;
		$this->cur_page = $uri_page_number;//floor(($this->cur_page/$this->per_page) + 1);

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 0;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CDT->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}

  		// And here we go...
		

		// Render the "First" link
	//	if  ($this->cur_page > ($this->num_links + 1))
//		{
//			$output .= $this->first_tag_open.'<a href="'.$this->base_url.$this->end_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
//		}

		// Render the "previous" link
		if  ($this->cur_page != 1)
		{
			//$i = $uri_page_number - $this->per_page;
            $i = $this->cur_page - 1;
			if ($i == 0) $i = '';
			$output .= $this->prev_tag_open.'<a href="'.$this->base_url.$i.$this->end_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
		}

		// Write the digit links
		for ($loop = $start; $loop < $end; $loop++)
		{
			$i = $loop;

			if ($i >= 0)
			{
                $n = $loop + 1;
				if ($this->cur_page == $n)
				{
					$output .= $this->cur_tag_open.$n.$this->cur_tag_close; // Current page
				}
				else
				{
					$output .= $this->num_tag_open.'<a href="'.$this->base_url.$n.$this->end_url.'">'.$n.'</a>'.$this->num_tag_close;
				}
			}
		}

		// Render the "next" link
		if ($this->cur_page < $num_pages)
		{
			$output .= $this->next_tag_open.'<a href="'.$this->base_url.($this->cur_page + 1).$this->end_url.'">'.$this->next_link.'</a>'.$this->next_tag_close;
		}

		// Render the "Last" link
	//	if (($this->cur_page + $this->num_links) < $num_pages)
//		{
//			$i = (($num_pages * $this->per_page) - $this->per_page);
//			$output .= $this->last_tag_open.'<a href="'.$this->base_url.$i.$this->end_url.'">'.$this->last_link.'</a>'.$this->last_tag_close;
//		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = '<ul>'.$this->full_tag_open.$output.$this->full_tag_close.'</ul>';

		return $output;
	}
    
    
    /**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */
	function create_links_page()
	{
	   $output = '';// '<li>Tổng số: '.$this->total_rows.'</li>';
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			//return '<ul>'.$output.'</ul>';
            return $output;
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			//return '<ul>'.$output.'</ul>';
            return $output;
		}

		// Determine the current page number.
		$CDT =& get_instance();
        
		if ($CDT->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CDT->input->get($this->query_string_segment) != 0)
			{
				$this->cur_page = $CDT->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
            
		}
		else
		{
		      
			if ($CDT->uri->segment($this->uri_segment) != 0)
			{
				$this->cur_page = $CDT->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;               
			}
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page) || $this->cur_page == 0)
		{
			$this->cur_page = 1;
		}
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}

		$uri_page_number = $this->cur_page;
		$this->cur_page = $uri_page_number;//floor(($this->cur_page/$this->per_page) + 1);

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 1) ? $this->cur_page - ($this->num_links + 1) : 0;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CDT->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}

  		// And here we go...
		

		// Render the "First" link
	//	if  ($this->cur_page > ($this->num_links + 1))
//		{
//			$output .= $this->first_tag_open.'<a href="'.$this->base_url.$this->end_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
//		}

		$output .= '<ul class="paging clearfix">';
		// Render the "previous" link
		if  ($this->cur_page != 1)
		{
			//$i = $uri_page_number - $this->per_page;
            $i = $this->cur_page - 1;
			if ($i == 0) $i = '';
			//$output .= $this->prev_tag_open.'<a href="'.$this->base_url.$i.$this->end_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
            $output .= '<li><a class="pagFirt" href="'.$this->base_url.$i.$this->end_url.'">'.$this->prev_link.'</a></li>';
		}

		// Write the digit links
		for ($loop = $start; $loop < $end; $loop++)
		{
			if ($loop >= 0)
			{
                $n = $loop + 1;
				if ($this->cur_page == $n)
				{
					//$output .= $this->cur_tag_open.$n.$this->cur_tag_close; // Current page
                    $output .= '<li class="active"><a class="pagActive" href="javascript:;">'.$n.'</a></li>'; // Current page
				}
				else
				{
					//$output .= $this->num_tag_open.'<a href="'.$this->base_url.$n.$this->end_url.'">'.$n.'</a>'.$this->num_tag_close;
                    $output .= '<li><a href="'.$this->base_url.$n.$this->end_url.'">'.$n.'</a></li>';
				}
			}
		}

		// Render the "next" link
		if ($this->cur_page < $num_pages)
		{
			//$output .= $this->next_tag_open.'<a href="'.$this->base_url.($this->cur_page + 1).$this->end_url.'">'.$this->next_link.'</a>'.$this->next_tag_close;
            $output .= '<li><a class="pageLast" href="'.$this->base_url.($this->cur_page + 1).$this->end_url.'">'.$this->next_link.'</a></li>';
		}
		
		$output .= '</ul>';
		// Render the "Last" link
// 		if (($this->cur_page + $this->num_links) < $num_pages)
// 		{
// 			$i = (($num_pages * $this->per_page) - $this->per_page);
// 			$output .= $this->last_tag_open.'<a href="'.$this->base_url.$i.$this->end_url.'">'.$this->last_link.'</a>'.$this->last_tag_close;
// 		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		//$output = '<ul>'.$this->full_tag_open.$output.$this->full_tag_close.'</ul>';

		return $output;
	}
    
    /**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */
	function phantrang()
	{
	   $output = '';
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			//return '<ul>'.$output.'</ul>';
            return $output;
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			//return '<ul>'.$output.'</ul>';
            return $output;
		}

		// Determine the current page number.
		$CDT =& get_instance();
        
		if ($CDT->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CDT->input->get($this->query_string_segment) != 0)
			{
				$this->cur_page = $CDT->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
            
		}
		else
		{
		      
			if ($CDT->uri->segment($this->uri_segment) != 0)
			{
				$this->cur_page = (int) $this->cur_page;               
			}
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page) || $this->cur_page == 0)
		{
			$this->cur_page = 1;
		}
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}

		$uri_page_number = $this->cur_page;
		$this->cur_page = $uri_page_number;//floor(($this->cur_page/$this->per_page) + 1);

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 1) ? $this->cur_page - ($this->num_links + 1) : 0;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CDT->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') ;
		}

  		// And here we go...
		

		// Render the "First" link
	//	if  ($this->cur_page > ($this->num_links + 1))
//		{
//			$output .= $this->first_tag_open.'<a href="'.$this->base_url.$this->end_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
//		}

		$output .= '<ul class="paging clearfix">';
		// Render the "previous" link
		if  ($this->cur_page != 1)
		{
			//$i = $uri_page_number - $this->per_page;
            $i = $this->cur_page - 1;
			if ($i == 0) $i = '';
			//$output .= $this->prev_tag_open.'<a href="'.$this->base_url.$i.$this->end_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
            $output .= '<li><a class="pagFirt" href="'.$this->base_url.$i.$this->end_url.'">'.$this->prev_link.'</a></li>';
		}

		// Write the digit links
		for ($loop = $start; $loop < $end; $loop++)
		{
			if ($loop >= 0)
			{
                $n = $loop + 1;
				if ($this->cur_page == $n)
				{
					//$output .= $this->cur_tag_open.$n.$this->cur_tag_close; // Current page
                    $output .= '<li class="active"><a class="pagActive" href="javascript:;">'.$n.'</a></li>'; // Current page
				}
				else
				{
					//$output .= $this->num_tag_open.'<a href="'.$this->base_url.$n.$this->end_url.'">'.$n.'</a>'.$this->num_tag_close;
                    $output .= '<li><a href="'.$this->base_url.$n.$this->end_url.'">'.$n.'</a></li>';
				}
			}
		}

		// Render the "next" link
		if ($this->cur_page < $num_pages)
		{
			//$output .= $this->next_tag_open.'<a href="'.$this->base_url.($this->cur_page + 1).$this->end_url.'">'.$this->next_link.'</a>'.$this->next_tag_close;
            $output .= '<li><a class="pageLast" href="'.$this->base_url.($this->cur_page + 1).$this->end_url.'">'.$this->next_link.'</a></li>';
		}
		
		$output .= '</ul>';


		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		//$output = '<ul>'.$this->full_tag_open.$output.$this->full_tag_close.'</ul>';

		return $output;
	}
    
    
    function phantrang_ajax()
	{
	   $output = '';
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
            return $output;
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
            return $output;
		}

		// Determine the current page number.
		$CDT =& get_instance();
        
		if ($CDT->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CDT->input->get($this->query_string_segment) != 0)
			{
				$this->cur_page = $CDT->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
            
		}
		else
		{
		      
			if ($CDT->uri->segment($this->uri_segment) != 0)
			{
				$this->cur_page = (int) $this->cur_page;               
			}
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page) || $this->cur_page == 0)
		{
			$this->cur_page = 1;
		}
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}

		$uri_page_number = $this->cur_page;
		$this->cur_page = $uri_page_number;

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 1) ? $this->cur_page - ($this->num_links + 1) : 0;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
  		// And here we go...
		
		$output .= '<ul class="paging clearfix">';
		// Render the "previous" link
		if  ($this->cur_page != 1)
		{
            $i = $this->cur_page - 1;
			if ($i == 0) $i = '';
		      $output .= '<li><a class="pagFirt page_ajax" href="javascript:();" rel="'.$i.'" id="'.$this->id.'">'.$this->prev_link.'</a></li>';
		}

		// Write the digit links
		for ($loop = $start; $loop < $end; $loop++)
		{
			if ($loop >= 0)
			{
                $n = $loop + 1;
				if ($this->cur_page == $n)
				{
					$output .= '<li class="active"><a class="pagActive" href="javascript:;">'.$n.'</a></li>'; // Current page
				}
				else
				{
					$output .= '<li><a href="javascript:();" class="page_ajax" rel="'.$n.'" id="'.$this->id.'">'.$n.'</a></li>';
				}
			}
		}

		// Render the "next" link
		if ($this->cur_page < $num_pages)
		{
			$output .= '<li><a class="pageLast page_ajax" href="javascript:();" rel="'.($this->cur_page + 1).'" id="'.$this->id.'">'.$this->next_link.'</a></li>';
		}
		
		$output .= '</ul>';


		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		return $output;
	}
    
    
}
// END Pagination Class

/* End of file Pagination.php */
/* Location: ./system/libraries/Pagination.php */