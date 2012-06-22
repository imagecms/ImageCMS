<?php
/*
 * Image CMS
 * Compress and output js files
 */

	$code = file_get_contents(dirname(__FILE__).'/tiny_mce.js');

	$exp = 3600 * 24 * 10;
	header("Content-Type: text/javascript");
	header("Vary: Accept-Encoding");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + $exp) . " GMT");

	if (extension_loaded('zlib'))
	{
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) AND strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
		{
			ob_start('ob_gzhandler');
		}
	}

	print $code;

