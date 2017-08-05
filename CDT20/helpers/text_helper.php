<?php  if ( ! defined('IN_CDT')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Text Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/text_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Word Limiter
 *
 * Limits a string to X number of words.
 *
 * @access	public
 * @param	string
 * @param	integer
 * @param	string	the end character. Usually an ellipsis
 * @return	string
 */
if ( ! function_exists('word_limiter'))
{
	function word_limiter($str, $limit = 100, $end_char = '&#8230;')
	{
		if (trim($str) == '')
		{
			return $str;
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

		if (strlen($str) == strlen($matches[0]))
		{
			$end_char = '';
		}

		return rtrim($matches[0]).$end_char;
	}
}

// ------------------------------------------------------------------------

/**
 * Character Limiter
 *
 * Limits the string based on the character count.  Preserves complete words
 * so the character count may not be exactly as specified.
 *
 * @access	public
 * @param	string
 * @param	integer
 * @param	string	the end character. Usually an ellipsis
 * @return	string
 */
if ( ! function_exists('character_limiter'))
{
	function character_limiter($str, $n = 500, $end_char = '&#8230;')
	{
		if (strlen($str) < $n)
		{
			return $str;
		}

		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n)
		{
			return $str;
		}

		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';

			if (strlen($out) >= $n)
			{
				$out = trim($out);
				return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
			}
		}
	}
}

// ------------------------------------------------------------------------

/**
 * High ASCII to Entities
 *
 * Converts High ascii text and MS Word special characters to character entities
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('ascii_to_entities'))
{
	function ascii_to_entities($str)
	{
		$count	= 1;
		$out	= '';
		$temp	= array();

		for ($i = 0, $s = strlen($str); $i < $s; $i++)
		{
			$ordinal = ord($str[$i]);

			if ($ordinal < 128)
			{
				/*
					If the $temp array has a value but we have moved on, then it seems only
					fair that we output that entity and restart $temp before continuing. -Paul
				*/
				if (count($temp) == 1)
				{
					$out  .= '&#'.array_shift($temp).';';
					$count = 1;
				}

				$out .= $str[$i];
			}
			else
			{
				if (count($temp) == 0)
				{
					$count = ($ordinal < 224) ? 2 : 3;
				}

				$temp[] = $ordinal;

				if (count($temp) == $count)
				{
					$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);

					$out .= '&#'.$number.';';
					$count = 1;
					$temp = array();
				}
			}
		}

		return $out;
	}
}

// ------------------------------------------------------------------------

/**
 * Entities to ASCII
 *
 * Converts character entities back to ASCII
 *
 * @access	public
 * @param	string
 * @param	bool
 * @return	string
 */
if ( ! function_exists('entities_to_ascii'))
{
	function entities_to_ascii($str, $all = TRUE)
	{
		if (preg_match_all('/\&#(\d+)\;/', $str, $matches))
		{
			for ($i = 0, $s = count($matches['0']); $i < $s; $i++)
			{
				$digits = $matches['1'][$i];

				$out = '';

				if ($digits < 128)
				{
					$out .= chr($digits);

				}
				elseif ($digits < 2048)
				{
					$out .= chr(192 + (($digits - ($digits % 64)) / 64));
					$out .= chr(128 + ($digits % 64));
				}
				else
				{
					$out .= chr(224 + (($digits - ($digits % 4096)) / 4096));
					$out .= chr(128 + ((($digits % 4096) - ($digits % 64)) / 64));
					$out .= chr(128 + ($digits % 64));
				}

				$str = str_replace($matches['0'][$i], $out, $str);
			}
		}

		if ($all)
		{
			$str = str_replace(array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;", "&#45;"),
								array("&","<",">","\"", "'", "-"),
								$str);
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
 * Word Censoring Function
 *
 * Supply a string and an array of disallowed words and any
 * matched words will be converted to #### or to the replacement
 * word you've submitted.
 *
 * @access	public
 * @param	string	the text string
 * @param	string	the array of censoered words
 * @param	string	the optional replacement value
 * @return	string
 */
if ( ! function_exists('word_censor'))
{
	function word_censor($str, $censored, $replacement = '')
	{
		if ( ! is_array($censored))
		{
			return $str;
		}

		$str = ' '.$str.' ';

		// \w, \b and a few others do not match on a unicode character
		// set for performance reasons. As a result words like über
		// will not match on a word boundary. Instead, we'll assume that
		// a bad word will be bookeneded by any of these characters.
		$delim = '[-_\'\"`(){}<>\[\]|!?@#%&,.:;^~*+=\/ 0-9\n\r\t]';

		foreach ($censored as $badword)
		{
			if ($replacement != '')
			{
				$str = preg_replace("/({$delim})(".str_replace('\*', '\w*?', preg_quote($badword, '/')).")({$delim})/i", "\\1{$replacement}\\3", $str);
			}
			else
			{
				$str = preg_replace("/({$delim})(".str_replace('\*', '\w*?', preg_quote($badword, '/')).")({$delim})/ie", "'\\1'.str_repeat('#', strlen('\\2')).'\\3'", $str);
			}
		}

		return trim($str);
	}
}

// ------------------------------------------------------------------------

/**
 * Code Highlighter
 *
 * Colorizes code strings
 *
 * @access	public
 * @param	string	the text string
 * @return	string
 */
if ( ! function_exists('highlight_code'))
{
	function highlight_code($str)
	{
		// The highlight string function encodes and highlights
		// brackets so we need them to start raw
		$str = str_replace(array('&lt;', '&gt;'), array('<', '>'), $str);

		// Replace any existing PHP tags to temporary markers so they don't accidentally
		// break the string out of PHP, and thus, thwart the highlighting.

		$str = str_replace(array('<?', '?>', '<%', '%>', '\\', '</script>'),
							array('phptagopen', 'phptagclose', 'asptagopen', 'asptagclose', 'backslashtmp', 'scriptclose'), $str);

		// The highlight_string function requires that the text be surrounded
		// by PHP tags, which we will remove later
		$str = '<?php '.$str.' ?>'; // <?

		// All the magic happens here, baby!
		$str = highlight_string($str, TRUE);

		// Prior to PHP 5, the highligh function used icky <font> tags
		// so we'll replace them with <span> tags.

		if (abs(PHP_VERSION) < 5)
		{
			$str = str_replace(array('<font ', '</font>'), array('<span ', '</span>'), $str);
			$str = preg_replace('#color="(.*?)"#', 'style="color: \\1"', $str);
		}

		// Remove our artificially added PHP, and the syntax highlighting that came with it
		$str = preg_replace('/<span style="color: #([A-Z0-9]+)">&lt;\?php(&nbsp;| )/i', '<span style="color: #$1">', $str);
		$str = preg_replace('/(<span style="color: #[A-Z0-9]+">.*?)\?&gt;<\/span>\n<\/span>\n<\/code>/is', "$1</span>\n</span>\n</code>", $str);
		$str = preg_replace('/<span style="color: #[A-Z0-9]+"\><\/span>/i', '', $str);

		// Replace our markers back to PHP tags.
		$str = str_replace(array('phptagopen', 'phptagclose', 'asptagopen', 'asptagclose', 'backslashtmp', 'scriptclose'),
							array('&lt;?', '?&gt;', '&lt;%', '%&gt;', '\\', '&lt;/script&gt;'), $str);

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
 * Phrase Highlighter
 *
 * Highlights a phrase within a text string
 *
 * @access	public
 * @param	string	the text string
 * @param	string	the phrase you'd like to highlight
 * @param	string	the openging tag to precede the phrase with
 * @param	string	the closing tag to end the phrase with
 * @return	string
 */

if ( ! function_exists('highlight_phrase'))
{
	function highlight_phrase($text, $words, $tag_open = '<span class="highlightSearch">', $tag_close = '</span>')
	{
        $arrWords = explode(" ",$words);
        $arrWords = array_filter($arrWords, 'strlen');
        foreach ($arrWords as $word)
        {
            $text = preg_replace("/(".utf82abc($word).")/i", $tag_open."\\1".$tag_close, $text);
            $text = preg_replace("/(".$word.")/i", $tag_open."\\1".$tag_close, $text);
        }
        return $text;
	}
 }

if ( ! function_exists('utf82abc'))
{
    function utf82abc($str)
    { 
        $utf82abc=array(
            'à'=>'a',
            'á'=>'a', 
            'á'=>'a', 
            'ả'=>'a',
            'ã'=>'a',
            'ạ'=>'a',
            
            'ằ'=>'a',
            'ắ'=>'a',
            'ẳ'=>'a',
            'ẵ'=>'a',
            'ặ'=>'a',
            'ă'=>'a',
    
            'ầ'=>'a',
            'ấ'=>'a',
            'ấ'=>'a',
            'ẩ'=>'a',
            'ẫ'=>'a',
            'ậ'=>'a',
            'â'=>'a',
    
            'đ'=>'d',
    
            'è'=>'e',
            'é'=>'e',
            'ẻ'=>'e',
            'ẽ'=>'e',
            'ẹ'=>'e',
                
            'ề'=>'e',
            'ế'=>'e',
            'ể'=>'e',
            'ễ'=>'e',
            'ệ'=>'e',
            'ê'=>'e',
    
            'ì'=>'i',
            'í'=>'i',
            'ỉ'=>'i',
            'ĩ'=>'i',
            'ị'=>'i',
    
            'ò'=>'o',
            'ó'=>'o',
            'ỏ'=>'o',
            'õ'=>'o',
            'ọ'=>'o',
                    
            'ồ'=>'o',
            'ố'=>'o',
            'ố' => 'o',
            'ổ'=>'o',
            'ỗ'=>'o',
            'ộ'=>'o',
            'ô'=>'o',    
                
            'ờ'=>'o',
            'ớ'=>'o',
            'ở'=>'o',
            'ỡ'=>'o',
            'ợ'=>'o',
            'ơ'=>'o',
            
            'ù'=>'u',
            'ú'=>'u',
            'ủ'=>'u',
            'ũ'=>'u',
            'ụ'=>'u',
            
            
            'ừ'=>'u',
            'ứ'=>'u',
            'ử'=>'u',
            'ữ'=>'u',
            'ự'=>'u',
            'ư'=>'u',
    
            'ỳ'=>'y',
            'ý'=>'y',
            'ỷ'=>'y',
            'ỷ'=>'y',
            'ỹ'=>'y',
            'ỵ'=>'y',
    
            'À'=>'A',
            'Á'=>'A',
            'Ả'=>'A',
            'Ã'=>'A',
            'Ạ'=>'A',
            
            'Ằ'=>'A',
            'Ắ'=>'A',
            'Ẳ'=>'A',
            'Ẵ'=>'A',
            'Ặ'=>'A',
            'Ă'=>'A',
    
            'Ầ'=>'A',
            'Ấ'=>'A',
            'Ẩ'=>'A',
            'Ẫ'=>'A',
            'Ậ'=>'A',
            'Â'=>'A',
    
            'Đ'=>'D',
    
            'È'=>'E',
            'É'=>'E',
            'Ẻ'=>'E',
            'Ẽ'=>'E',
            'Ẹ'=>'E',
    
            'Ề'=>'E',
            'Ế'=>'E',
            'Ể'=>'E',
            'Ễ'=>'E',
            'Ệ'=>'E',
            'Ê'=>'E',
    
            'Ì'=>'I',
            'Í'=>'I',
            'Ỉ'=>'I',
            'Ĩ'=>'I',
            'Ị'=>'I',
    
            'Ò'=>'O',
            'Ó'=>'O',
            'Ỏ'=>'O',
            'Õ'=>'O',
            'Ọ'=>'O',
    
            'Ồ'=>'O',
            'Ố'=>'O',
            'Ổ'=>'O',
            'Ỗ'=>'O',
            'Ộ'=>'O',
            'Ô'=>'O',
    
            'Ờ'=>'O',
            'Ớ'=>'O',
            'Ở'=>'O',
            'Ỡ'=>'O',
            'Ợ'=>'O',
            'Ơ'=>'O',    
    
            'Ù'=>'U',
            'Ú'=>'U',
            'Ủ'=>'U',
            'Ũ'=>'U',
            'Ụ'=>'U',
    
            'Ừ'=>'U',
            'Ứ'=>'U',
            'Ử'=>'U',
            'Ữ'=>'U',
            'Ự'=>'U',
            'Ư'=>'U',
    
            'Ỳ'=>'Y',
            'Ý'=>'Y',
            'Ỷ'=>'Y',
            'Ỹ'=>'Y',
            'Ỵ'=>'Y'
        );
        return str_replace(array_keys($utf82abc),array_values($utf82abc),$str);
    }
}

// ------------------------------------------------------------------------

/**
 * Convert Accented Foreign Characters to ASCII
 *
 * @access	public
 * @param	string	the text string
 * @return	string
 */
if ( ! function_exists('convert_accented_characters'))
{
	function convert_accented_characters($str)
	{
		if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/foreign_chars'.EXT))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/foreign_chars'.EXT);
		}
		elseif (is_file(APPPATH.'config/foreign_chars'.EXT))
		{
			include(APPPATH.'config/foreign_chars'.EXT);
		}

		if ( ! isset($foreign_characters))
		{
			return $str;
		}

		return preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);
	}
}

// ------------------------------------------------------------------------

/**
 * Word Wrap
 *
 * Wraps text at the specified character.  Maintains the integrity of words.
 * Anything placed between {unwrap}{/unwrap} will not be word wrapped, nor
 * will URLs.
 *
 * @access	public
 * @param	string	the text string
 * @param	integer	the number of characters to wrap at
 * @return	string
 */
if ( ! function_exists('word_wrap'))
{
	function word_wrap($str, $charlim = '76')
	{
		// Se the character limit
		if ( ! is_numeric($charlim))
			$charlim = 76;

		// Reduce multiple spaces
		$str = preg_replace("| +|", " ", $str);

		// Standardize newlines
		if (strpos($str, "\r") !== FALSE)
		{
			$str = str_replace(array("\r\n", "\r"), "\n", $str);
		}

		// If the current word is surrounded by {unwrap} tags we'll
		// strip the entire chunk and replace it with a marker.
		$unwrap = array();
		if (preg_match_all("|(\{unwrap\}.+?\{/unwrap\})|s", $str, $matches))
		{
			for ($i = 0; $i < count($matches['0']); $i++)
			{
				$unwrap[] = $matches['1'][$i];
				$str = str_replace($matches['1'][$i], "{{unwrapped".$i."}}", $str);
			}
		}

		// Use PHP's native function to do the initial wordwrap.
		// We set the cut flag to FALSE so that any individual words that are
		// too long get left alone.  In the next step we'll deal with them.
		$str = wordwrap($str, $charlim, "\n", FALSE);

		// Split the string into individual lines of text and cycle through them
		$output = "";
		foreach (explode("\n", $str) as $line)
		{
			// Is the line within the allowed character count?
			// If so we'll join it to the output and continue
			if (strlen($line) <= $charlim)
			{
				$output .= $line."\n";
				continue;
			}

			$temp = '';
			while ((strlen($line)) > $charlim)
			{
				// If the over-length word is a URL we won't wrap it
				if (preg_match("!\[url.+\]|://|wwww.!", $line))
				{
					break;
				}

				// Trim the word down
				$temp .= substr($line, 0, $charlim-1);
				$line = substr($line, $charlim-1);
			}

			// If $temp contains data it means we had to split up an over-length
			// word into smaller chunks so we'll add it back to our current line
			if ($temp != '')
			{
				$output .= $temp."\n".$line;
			}
			else
			{
				$output .= $line;
			}

			$output .= "\n";
		}

		// Put our markers back
		if (count($unwrap) > 0)
		{
			foreach ($unwrap as $key => $val)
			{
				$output = str_replace("{{unwrapped".$key."}}", $val, $output);
			}
		}

		// Remove the unwrap tags
		$output = str_replace(array('{unwrap}', '{/unwrap}'), '', $output);

		return $output;
	}
}

// ------------------------------------------------------------------------

/**
 * Ellipsize String
 *
 * This function will strip tags from a string, split it at its max_length and ellipsize
 *
 * @param	string		string to ellipsize
 * @param	integer		max length of string
 * @param	mixed		int (1|0) or float, .5, .2, etc for position to split
 * @param	string		ellipsis ; Default '...'
 * @return	string		ellipsized string
 */
if ( ! function_exists('ellipsize'))
{
	function ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;')
	{
		// Strip tags
		$str = trim(strip_tags($str));

		// Is the string long enough to ellipsize?
		if (strlen($str) <= $max_length)
		{
			return $str;
		}

		$beg = substr($str, 0, floor($max_length * $position));

		$position = ($position > 1) ? 1 : $position;

		if ($position === 1)
		{
			$end = substr($str, 0, -($max_length - strlen($beg)));
		}
		else
		{
			$end = substr($str, -($max_length - strlen($beg)));
		}

		return $beg.$ellipsis.$end;
	}
}

/* End of file text_helper.php */
/* Location: ./system/helpers/text_helper.php */