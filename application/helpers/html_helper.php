<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    if (!function_exists('href_nofollow'))
    {
		function href_nofollow($content)
		{
			return preg_replace_callback('/<(a\s[^>]+)>/isU', 'seo_nofollow_replace', $content);	
		}
	}

	if (!function_exists('seo_nofollow_replace'))
	{
		function seo_nofollow_replace($match)
		{ 

			list($original, $tag) = $match;

			if (strpos($tag, "nofollow")) {
				return $original; // уже есть
			}
			elseif ( strpos($tag, $_SERVER['SERVER_NAME']) || strpos($tag, 'href="/') || strpos($tag, "href='/")) {
				   return $original; // исключения
			}
			else {
				return "<$tag rel=\"nofollow\">";
			}
		}
	}
