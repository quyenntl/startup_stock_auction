<?php
/**
* Highlights a text by searching a word in it.
*/
function smarty_modifier_highlight(&$text='', $word='')
{
   $new_text = $text;
   if($word)
   {
      $word = ucwords($word);
      $new_text = str_ireplace($word, "<span class='hilight'>{$word}</span>", $text);
   }
   return($new_text);
}
?>