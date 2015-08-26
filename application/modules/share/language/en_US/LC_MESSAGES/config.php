<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------
  | DATABASE CONNECTIVITY SETTINGS
  | -------------------------------------------------------------------
  | This file will contain the settings needed to access your database.
  |
  | For complete instructions please consult the 'Database Connection'
  | page of the User Guide.
  |
  | -------------------------------------------------------------------
  | EXPLANATION OF VARIABLES
  | -------------------------------------------------------------------
  |
  |	['hostname'] The hostname of your database server.
  |	['username'] The username used to connect to the database
  |	['password'] The password used to connect to the database
  |	['database'] The name of the database you want to connect to
  |	['dbdriver'] The database type. ie: mysql.  Currently supported:
  |                  mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
  |	['dbprefix'] You can add an optional prefix, which will be added
  |				 to the table name when using the  Active Record class
  |	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
  |	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
  |	['cache_on'] TRUE/FALSE - Enables/disables query caching
  |	['cachedir'] The path to the folder where cache files should be stored
  |	['char_set'] The character set used in communicating with the database
  |	['dbcollat'] The character collation used in communicating with the database
  |	['swap_pre'] A default table prefix that should be swapped with the dbprefix
  |	['autoinit'] Whether or not to automatically initialize the database.
  |	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
  |							- good for ensuring strict SQL while developing
  |
  | The $active_group variable lets you choose which connection group to
  | make active.  By default there is only one group (the 'default' group).
  |
  | The $active_record variables lets you determine whether or not to load
  | the active record class
 */

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'u20898';
$db['default']['password'] = 'Bmw8hPx8Cr';
$db['default']['database'] = 'u20898';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = PUBPATH . 'system/cache';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/*
  |--------------------------------------------------------------------------
  | Base Site URL
  |--------------------------------------------------------------------------
  |
  | URL to your CodeIgniter root. Typically this will be your base URL,
  | WITH a trailing slash:
  |
  |	http://example.com/
  |
 */

// Auto-detect base url.
$prototype = "http" . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "") . "://";
$server = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
$config['base_url'] = $prototype . $server;

$config['static_base_url'] = $config['base_url'];

/*
  |--------------------------------------------------------------------------
  | Index File
  |--------------------------------------------------------------------------
  |
  | Typically this will be your index.php file, unless you've renamed it to
  | something else. If you are using mod_rewrite to remove the page set this
  | variable so that it is blank.
  |
 */
$config['index_page'] = "";
$config['is_installed'] = TRUE;
$config['rebuild_hooks_tree'] = FALSE;
/*
  |--------------------------------------------------------------------------
  | URI PROTOCOL
  |--------------------------------------------------------------------------
  |
  | This item determines which server global should be used to retrieve the
  | URI string.  The default setting of "AUTO" works for most servers.
  | If your links do not seem to work, try one of the other delicious flavors:
  |
  | 'AUTO'			Default - auto detects
  | 'PATH_INFO'		Uses the PATH_INFO
  | 'QUERY_STRING'	Uses the QUERY_STRING
  | 'REQUEST_URI'		Uses the REQUEST_URI
  | 'ORIG_PATH_INFO'	Uses the ORIG_PATH_INFO
  |
 */
$config['uri_protocol'] = "REQUEST_URI";

/*
  |--------------------------------------------------------------------------
  | Template Config
  |--------------------------------------------------------------------------
  |
  | 'tpl_compile_path'		Path 	to store compiled template files
  | 'tpl_force_compile'	Compile template file each request
  | 'tpl_compiled_ttl'	        Time to live for compiled file
  | 'tpl_compress_output'   Use gzip to compress output
  | 'tpl_use_filemtime'
  |
 */
$config['tpl_compile_path'] = PUBPATH . 'system/cache/templates_c/';
$config['tpl_force_compile'] = FALSE;
$config['tpl_compiled_ttl'] = 84600;
$config['tpl_compress_output'] = FALSE;
$config['tpl_use_filemtime'] = TRUE;

/*
  |--------------------------------------------------------------------------
  | URL suffix
  |--------------------------------------------------------------------------
  |
  | This option allows you to add a suffix to all URLs generated by CodeIgniter.
  | For more information please see the user guide:
  |
  | http://codeigniter.com/user_guide/general/urls.html
 */

$config['url_suffix'] = "";

/*
  |--------------------------------------------------------------------------
  | Default Language
  |--------------------------------------------------------------------------
  |
  | This determines which set of language files should be used. Make sure
  | there is an available translation if you intend to use something other
  | than english.
  |
 */
$config['language'] = "russian";

/*
  |--------------------------------------------------------------------------
  | Default Character Set
  |--------------------------------------------------------------------------
  |
  | This determines which character set is used by default in various methods
  | that require a character set to be provided.
  |
 */
$config['charset'] = "UTF-8";

/*
  |--------------------------------------------------------------------------
  | Enable/Disable System Hooks
  |--------------------------------------------------------------------------
  |
  | If you would like to use the "hooks" feature you must enable it by
  | setting this variable to TRUE (boolean).  See the user guide for details.
  |
 */
$config['enable_hooks'] = TRUE;


/*
  |--------------------------------------------------------------------------
  | Class Extension Prefix
  |--------------------------------------------------------------------------
  |
  | This item allows you to set the filename/classname prefix when extending
  | native libraries.  For more information please see the user guide:
  |
  | http://codeigniter.com/user_guide/general/core_classes.html
  | http://codeigniter.com/user_guide/general/creating_libraries.html
  |
 */
$config['subclass_prefix'] = 'MY_';


/*
  |--------------------------------------------------------------------------
  | Allowed URL Characters
  |--------------------------------------------------------------------------
  |
  | This lets you specify with a regular expression which characters are permitted
  | within your URLs.  When someone tries to submit a URL with disallowed
  | characters they will get a warning message.
  |
  | As a security measure you are STRONGLY encouraged to restrict URLs to
  | as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
  |
  | Leave blank to allow all characters -- but only if you are insane.
  |
  | DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
  |
 */
//$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
//$config['permitted_uri_chars'] = 'a-zа-яёіґ 0-9~%.:_\-';
$config['permitted_uri_chars'] = '?A-Za-zА-Яа-я=\s&0-9~%\.:_-';

/*
  |--------------------------------------------------------------------------
  | Enable Query Strings
  |--------------------------------------------------------------------------
  |
  | By default CodeIgniter uses search-engine friendly segment based URLs:
  | example.com/who/what/where/
  |
  | You can optionally enable standard query string based URLs:
  | example.com?who=me&what=something&where=here
  |
  | Options are: TRUE or FALSE (boolean)
  |
  | The other items let you set the query string "words" that will
  | invoke your controllers and its functions:
  | example.com/index.php?c=controller&m=function
  |
  | Please note that some of the helpers won't work as expected when
  | this feature is enabled, since CodeIgniter is designed primarily to
  | use segment based URLs.
  |
 */
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd'; // experimental not currently in use

/*
  |--------------------------------------------------------------------------
  | Error Logging Threshold
  |--------------------------------------------------------------------------
  |
  | If you have enabled error logging, you can set an error threshold to
  | determine what gets logged. Threshold options are:
  | You can enable error logging by setting a threshold over zero. The
  | threshold determines what gets logged. Threshold options are:
  |
  |	0 = Disables logging, Error logging TURNED OFF
  |	1 = Error Messages (including PHP errors)
  |	2 = Debug Messages
  |	3 = Informational Messages
  |	4 = All Messages
  |
  | For a live site you'll usually only enable Errors (1) to be logged otherwise
  | your log files will fill up very fast.
  |
 */
$config['log_threshold'] = 0;

/*
  |--------------------------------------------------------------------------
  | Error Logging Directory Path
  |--------------------------------------------------------------------------
  |
  | Leave this BLANK unless you would like to set something other than the default
  | system/logs/ folder.  Use a full server path with trailing slash.
  |
 */
$config['log_path'] = 'application/logs';

/*
  |--------------------------------------------------------------------------
  | Date Format for Logs
  |--------------------------------------------------------------------------
  |
  | Each item that is logged has an associated date. You can use PHP date
  | codes to set your own date formatting
  |
 */
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
  |--------------------------------------------------------------------------
  | Cache Directory Path
  |--------------------------------------------------------------------------
  |
  | Leave this BLANK unless you would like to set something other than the default
  | system/cache/ folder.  Use a full server path with trailing slash.
  |
 */
$config['cache_path'] = PUBPATH . 'system/cache/';

/*
  |--------------------------------------------------------------------------
  | Encryption Key
  |--------------------------------------------------------------------------
  |
  | If you use the Encryption class or the Sessions class with encryption
  | enabled you MUST set an encryption key.  See the user guide for info.
  |
 */
$config['encryption_key'] = "347lQnePg3ZMbBgVznIiQQo5dVY6ZQHh";

/*
  |--------------------------------------------------------------------------
  | Session Variables
  |--------------------------------------------------------------------------
  |
  | 'session_cookie_name' = the name you want for the cookie
  | 'encrypt_sess_cookie' = TRUE/FALSE (boolean).  Whether to encrypt the cookie
  | 'session_expiration'  = the number of SECONDS you want the session to last.
  |  by default sessions last 7200 seconds (two hours).  Set to zero for no expiration.
  | 'time_to_update'		= how many seconds between CI refreshing Session Information
  |
 */
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_encrypt_cookie'] = FALSE;
$config['sess_use_database'] = FALSE;
$config['sess_table_name'] = 'ci_sessions';
$config['sess_match_ip'] = FALSE;
$config['sess_match_useragent'] = TRUE;
$config['sess_time_to_update'] = 600;

/*
  |--------------------------------------------------------------------------
  | Cookie Related Variables
  |--------------------------------------------------------------------------
  |
  | 'cookie_prefix' = Set a prefix if you need to avoid collisions
  | 'cookie_domain' = Set to .your-domain.com for site-wide cookies
  | 'cookie_path'   =  Typically will be a forward slash
  |
 */
$config['cookie_prefix'] = "";
$config['cookie_domain'] = "";
$config['cookie_path'] = "/";

/*
  |--------------------------------------------------------------------------
  | Global XSS Filtering
  |--------------------------------------------------------------------------
  |
  | Determines whether the XSS filter is always active when GET, POST or
  | COOKIE data is encountered
  |
 */
$config['global_xss_filtering'] = FALSE;

/*
  |--------------------------------------------------------------------------
  | Output Compression
  |--------------------------------------------------------------------------
  |
  | Enables Gzip output compression for faster page loads.  When enabled,
  | the output class will test whether your server supports Gzip.
  | Even if it does, however, not all browsers support compression
  | so enable only if you are reasonably sure your visitors can handle it.
  |
  | VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
  | means you are prematurely outputting something to your browser. It could
  | even be a line of whitespace at the end of one of your scripts.  For
  | compression to work, nothing can be sent before the output buffer is called
  | by the output class.  Do not "echo" any values with compression enabled.
  |
 */
$config['compress_output'] = FALSE;

/*
  |--------------------------------------------------------------------------
  | Master Time Reference
  |--------------------------------------------------------------------------
  |
  | Options are "local" or "gmt".  This pref tells the system whether to use
  | your server's local time as the master "now" reference, or convert it to
  | GMT.  See the "date helper" page of the user guide for information
  | regarding date handling.
  |
 */
$config['time_reference'] = 'local';
$config['default_time_zone'] = 'Europe/Kyiv';

/*
  |--------------------------------------------------------------------------
  | Rewrite PHP Short Tags
  |--------------------------------------------------------------------------
  |
  | If your PHP installation does not have short tag support enabled CI
  | can rewrite the tags on-the-fly, enabling you to utilize that syntax
  | in your view files.  Options are TRUE or FALSE (boolean)
  |
 */
$config['rewrite_short_tags'] = FALSE;


/*
  |--------------------------------------------------------------------------
  | Reverse Proxy IPs
  |--------------------------------------------------------------------------
  |
  | If your server is behind a reverse proxy, you must whitelist the proxy IP
  | addresses from which CodeIgniter should trust the HTTP_X_FORWARDED_FOR
  | header in order to properly identify the visitor's IP address.
  | Comma-delimited, e.g. '10.0.1.200,10.0.1.201'
  |
 */
$config['proxy_ips'] = '';


/* End of file config.php */
/* Location: ./system/application/config/config.php */
$config['use_deprecated_cart_methods'] = FALSE;

$config['owner_email'] = 'test-iofgjjwgpk@liamg.com';
