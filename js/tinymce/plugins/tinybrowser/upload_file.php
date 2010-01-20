<?php
require_once('config_tinybrowser.php');
require_once('fns_tinybrowser.php');


$fp = fopen('/srv/http/imagecms/system/cache/dump.html', 'w');
ob_start();
var_dump($_REQUEST);
$da = ob_get_contents();
ob_end_clean();
fwrite($fp, $da);
fclose($fp);


// Imagecms auth;
define('CMS_BRIDGE', TRUE);
define('ICMS_INIT', TRUE);
define('ICMS_DISBALE_CSRF', TRUE);

$ser = $_SERVER;
$_SERVER['QUERY_STRING'] = '';
require(realpath('../../../../system/cms_bridge.php'));

$obj =& get_instance();

$_SERVER = $ser;
$query_string = $_SERVER['QUERY_STRING'];

$get_array = array();
parse_str($query_string, $get_array);

foreach($get_array as $key => $val) 
{
    $_GET[$key] = $obj->input->xss_clean($val);
    $_REQUEST[$key] = $obj->input->xss_clean($val);
}

$explodes = explode('/', $_REQUEST['sessidpass']);
$cms_user_id = $explodes[0];
$obj->db->select('id, password');
$cms_user = $obj->db->get_where('users', array('id' => $cms_user_id))->row_array();
$cms_auth_key = sha1($cms_user['password']);

if ($_REQUEST['sessidpass'] != $cms_user['id'].'/'.$cms_auth_key)
{
    echo 'Auth Error.';
    die();
}

// end cms auth

// Check hash is correct (workaround for Flash session bug, to stop external form posting)
if($_GET['obfuscate'] != md5($_SERVER['DOCUMENT_ROOT'].$tinybrowser['obfuscate'])) { echo 'Error!'; exit; } 

// Check  and assign get variables
if(isset($_GET['type'])) { $typenow = $_GET['type']; } else { echo 'Error!'; exit; } 
if(isset($_GET['folder'])) { $dest_folder = urldecode($_GET['folder']); } else { echo 'Error!'; exit; } 

// Check file extension isn't prohibited
$ext = end(explode('.',$_FILES['Filedata']['name']));
if(!validateExtension($ext, $tinybrowser['prohibited'])) { echo 'Error!'; exit; } 

// Check file data
if ($_FILES['Filedata']['tmp_name'] && $_FILES['Filedata']['name'])
	{	
	$source_file = $_FILES['Filedata']['tmp_name'];
	$file_name = stripslashes($_FILES['Filedata']['name']);
	if($tinybrowser['cleanfilename']) $file_name = clean_filename($file_name);
	if(is_dir($tinybrowser['docroot'].$folder_name.$dest_folder))
		{
		$success = copy($source_file,$tinybrowser['docroot'].$dest_folder.'/'.$file_name.'_');
		}
	if($success)
		{
		header('HTTP/1.1 200 OK'); //  if this doesn't work for you, try header('HTTP/1.1 201 Created');
		?><html><head><title>File Upload Success</title></head><body>File Upload Success</body></html><?php
		}
	}		
?>
