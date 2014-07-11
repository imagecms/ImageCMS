<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------
  | AUTO-LOADER
  | -------------------------------------------------------------------
 */

$autoload['libraries'] = array('lib_init', 'lib_category', 'lib_csrf', 'Localizer');


/*
  | -------------------------------------------------------------------
  |  Auto-load Helper Files
  | -------------------------------------------------------------------
 */


$autoload['helper'] = array('url', 'language', 'array', 'rules', 'widget', 'form_csrf', 'my_url', 'category', 'page', 'cache', 'html', 'javascript', 'security', 'siteinfo', 'form_helper');



/*
  | -------------------------------------------------------------------
  |  Auto-load Plugins
  | -------------------------------------------------------------------
 */

$autoload['plugin'] = array();


/*
  | -------------------------------------------------------------------
  |  Auto-load Config files
  | -------------------------------------------------------------------
 */

$autoload['config'] = array('auth', 'language');


/*
  | -------------------------------------------------------------------
  |  Auto-load Language files
  | -------------------------------------------------------------------
 */

$autoload['language'] = array();


/*
  | -------------------------------------------------------------------
  |  Auto-load Models
  | -------------------------------------------------------------------
 */

$autoload['model'] = array('cms_base');


/*
| -------------------------------------------------------------------
|  Auto-load Core Libraries
| -------------------------------------------------------------------
|
| DEPRECATED:  Use $autoload['libraries'] above instead.
|
*/
// $autoload['core'] = array();



/* End of file autoload.php */
/* Location: ./system/application/config/autoload.php */
