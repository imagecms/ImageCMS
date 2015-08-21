<?php
/*
 * Image CMS
 * Compress and output js files
 */

$files = array(
		'mocha/mootools-1.3-core.js', // Mootools
		'mocha/mootools-1.2-more.js',
		'mocha/source/Core/Core.js', //MochaUI
		'mocha/source/Window/Window.js',
		'mocha/source/Window/Modal.js',
		'mocha/source/Window/Windows-from-html.js',
		'mocha/source/Window/Windows-from-json.js',
		'mocha/source/Window/Arrange-cascade.js',
		'mocha/source/Window/Arrange-tile.js',
		'mocha/source/Window/Tabs.js',
		'mocha/source/Layout/Layout.js',
		'mocha/source/Layout/Dock.js',
		'mocha/source/Layout/Workspaces.js',
		'mocha/cms-windows.js', // Other files
		'mocha/functions.js',
		'mocha/init.js',
		'plugins/Roar.js',
		'plugins/Tabs.js',
		'plugins/sortableTable.js',
		'plugins/rdTree.js',
		'plugins/calendar.compat.js',
		'plugins/alertbox.packed.js',
		'plugins/autocompleter/Autocompleter.js',
		'plugins/autocompleter/Observer.js',
		'plugins/autocompleter/Autocompleter.Request.js',
		'plugins/autocompleter/Autocompleter.Local.js',
		'mocha/mootools-more-1.3.2.1.js' //Element.Form for Autocomplete
	);

	$js_root = dirname(__FILE__);

	$code = '';
	foreach ($files as $file)
	{
		$code .= file_get_contents("$js_root/$file");
	}

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

