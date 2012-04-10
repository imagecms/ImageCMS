<?php
require_once('config_tinybrowser.php');
// Set language
if(isset($tinybrowser['language']) && file_exists('langs/'.$tinybrowser['language'].'.php'))
	{
	require_once('langs/'.$tinybrowser['language'].'.php'); 
	}
else
	{
	require_once('langs/en.php'); // Falls back to English
	}
require_once('fns_tinybrowser.php');

// Imagecms auth;
define('CMS_BRIDGE', TRUE);
define('ICMS_INIT', TRUE);
define('ICMS_DISBALE_CSRF', TRUE);

$ser = $_SERVER;
$_SERVER['QUERY_STRING'] = '';
require(realpath('../../../../system/cms_bridge.php'));

$obj =& get_instance();

if(!check_perm('tinybrowser_edit'))
{
    die('Нет доступа!');
}

$_SERVER = $ser;
$query_string = $_SERVER['QUERY_STRING'];

$get_array = array();
parse_str($query_string,$get_array);

foreach($get_array as $key => $val) 
{
    $_GET[$key] = $obj->input->xss_clean($val);
    $_REQUEST[$key] = $obj->input->xss_clean($val);
}
// end cms auth
	
if(!$tinybrowser['allowedit'] && !$tinybrowser['allowdelete'])
	{
	echo TB_EDDENIED;
	exit;
	}

// Assign file operation variables
$typenow = (isset($_GET['type']) ? $_GET['type'] : 'image');
$foldernow = (isset($_REQUEST['folder']) ? urldecode($_REQUEST['folder']) : '');
$destfolder = (isset($_POST['destination']) ? $tinybrowser['path'][$typenow].urldecode($_POST['destination']) : '');
$destfoldernow = (isset($_POST['destination']) ? urldecode($_POST['destination']) : $foldernow);

// Assign edit and thumbnail path
$editpath = $tinybrowser['path'][$typenow].$foldernow;
$thumbpath = $tinybrowser[$tinybrowser['thumbsrc']][$typenow].$foldernow;

// Assign browsing options
$sortbynow = (isset($_REQUEST['sortby']) ? $_REQUEST['sortby'] : $tinybrowser['order']['by']);
$sorttypenow = (isset($_REQUEST['sorttype']) ? $_REQUEST['sorttype'] : $tinybrowser['order']['type']);
$sorttypeflip = ($sorttypenow == 'asc' ? 'desc' : 'asc');  
$viewtypenow = 'detail';
$findnow = (isset($_REQUEST['find']) && !empty($_REQUEST['find']) ? $_REQUEST['find'] : false);
$actionnow = (isset($_REQUEST['action']) ? $_REQUEST['action'] : $tinybrowser['defaultaction'] );
$showpagenow = (isset($_REQUEST['showpage']) ? $_REQUEST['showpage'] : 0);

// Assign url pass variables
$passfolder = '&folder='.urlencode($foldernow);
$passfeid = (isset($_GET['feid']) && $_GET['feid']!='' ? '&feid='.$_GET['feid'] : '');
$passaction = '&action='.$actionnow;
$passfind = '&action='.$findnow;
$passsortby = '&sortby='.$sortbynow.'&sorttype='.$sorttypenow;

// Assign sort parameters for column header links
$sortbyget = array();
$sortbyget['name'] = '&sortby=name';
$sortbyget['size'] = '&sortby=size'; 
$sortbyget['type'] = '&sortby=type'; 
$sortbyget['modified'] = '&sortby=modified';
$sortbyget['dimensions'] = '&sortby=dimensions'; 
$sortbyget[$sortbynow] .= '&sorttype='.$sorttypeflip;

// Assign css style for current sort type column
$thclass = array();
$thclass['name'] = '';
$thclass['size'] = ''; 
$thclass['type'] = ''; 
$thclass['modified'] = '';
$thclass['dimensions'] = ''; 
$thclass[$sortbynow] = ' class="'.$sorttypenow.'"';

// Initalise alert array
$notify = array(
	'type' => array(),
	'message' => array()
);
$deleteqty = 0;
$renameqty = 0;
$resizeqty = 0;
$rotateqty = 0;
$moveqty = 0;
$errorqty = 0;
	
// Set when rotating images to force thumbnail refresh
$imagerefresh ='';

// Delete any checked files
if(isset($_POST['deletefile']))
	{
	foreach($_POST['deletefile'] as $delthis => $val)
		{
		$delthisfile = $tinybrowser['docroot'].$editpath.$_POST['actionfile'][$delthis];
		if (file_exists($delthisfile) && unlink($delthisfile)) $deleteqty++; else $errorqty++;
		if($typenow=='image')
			{
			$delthisthumb = $tinybrowser['docroot'].$editpath.'_thumbs/_'.$_POST['actionfile'][$delthis];
			if (file_exists($delthisthumb)) unlink($delthisthumb);
			}
		}
	}
	
// Rename any files with changed name
if(isset($_POST['renamefile']))
	{
	foreach($_POST['renamefile'] as $namethis => $newname)
		{
		if($_POST['actionfile'][$namethis] != $newname.$_POST['renameext'][$namethis])
			{
			$namethisfilefrom = $tinybrowser['docroot'].$editpath.$_POST['actionfile'][$namethis];
			$namethisfileto = $tinybrowser['docroot'].$editpath.clean_filename($newname.$_POST['renameext'][$namethis]);
			if (file_exists($namethisfilefrom) && rename($namethisfilefrom,$namethisfileto)) $renameqty++; else $errorqty++;
			if($typenow=='image')
			   {
				$namethisthumbfrom = $tinybrowser['docroot'].$editpath.'_thumbs/_'.$_POST['actionfile'][$namethis];
				$namethisthumbto = $tinybrowser['docroot'].$editpath.'_thumbs/_'.clean_filename($newname.$_POST['renameext'][$namethis]);
				if (file_exists($namethisthumbfrom)) rename($namethisthumbfrom,$namethisthumbto);
			   }
			}
		}
	}
	
// Move any checked files
if(isset($_POST['movefile']))
	{
	foreach($_POST['movefile'] as $movethis => $val)
		{
		$movethisfile = $tinybrowser['docroot'].$editpath.$_POST['actionfile'][$movethis];
		$movefiledest = $tinybrowser['docroot'].$destfolder.$_POST['actionfile'][$movethis];
		if (!file_exists($movefiledest) && file_exists($movethisfile) && copy($movethisfile,$movefiledest))
         {
         $moveqty++;
         unlink($movethisfile);
         if($typenow=='image')
			   {
			   $movethisthumb = $tinybrowser['docroot'].$editpath.'_thumbs/_'.$_POST['actionfile'][$movethis];
			   $movethumbdest = $tinybrowser['docroot'].$destfolder.'_thumbs/_'.$_POST['actionfile'][$movethis];
			   if (file_exists($movethisthumb) && copy($movethisthumb,$movethumbdest)) unlink($movethisthumb);
			   }
         }
      else $errorqty++;
		}
	}
	
// Resize any files with new size
if(isset($_POST['resizefile']))
	{
	foreach($_POST['resizefile'] as $sizethis => $newsize)
		{
		$newsize = intval($newsize);
		if($newsize)
		   {
			// detect silly sizes
			if($newsize > $tinybrowser['thumbsize'])
				{
				// do image resize
				$targetimg = $tinybrowser['docroot'].$editpath.$_POST['actionfile'][$sizethis];
				if (file_exists($targetimg))
				   {
					$mime = getimagesize($targetimg);
					if($_POST['resizetype'][$sizethis]=='width')
					   {
						$rw = $newsize;
						$rh = $mime[1];
						}
					else
					   {
						$rw = $mime[0];
						$rh = $newsize;
						}
					$im = convert_image($targetimg,$mime['mime']);
					resizeimage($im,$rw,$rh,$targetimg,$tinybrowser['imagequality'],$mime['mime']);
					imagedestroy($im);
					$resizeqty++;
				   }
				else $errorqty++;
				}
         else $errorqty++;
			}
		}
	}

// Rotate any selected files
if(isset($_POST['rotatefile']))
	{
	$imagerefresh = '?refresh='.uniqid('');
	foreach($_POST['rotatefile'] as $rotatethis => $direction)
		{
		if($direction != 'none')
			{
			$targetimg = $tinybrowser['docroot'].$editpath.$_POST['actionfile'][$rotatethis];
			if (file_exists($targetimg))
				{
				// rotate image
				if($direction == 'clock') $degree=270; else $degree=90;
				$mime = getimagesize($targetimg);
				$im = convert_image($targetimg,$mime['mime']);
				$newim = imagerotate($im, $degree, 0);
				imagedestroy($im);
            if($mime['mime'] == 'image/pjpeg' || $mime['mime'] == 'image/jpeg')
            	imagejpeg ($newim,$targetimg,$tinybrowser['imagequality']);
            elseif($mime['mime'] == 'image/x-png' || $mime['mime'] == 'image/png')
               imagepng ($newim,$targetimg,substr($tinybrowser['imagequality'],0,1));
            elseif($mime['mime'] == 'image/gif')
               imagegif ($newim,$targetimg);
				imagedestroy($newim);
				$rotateqty++;

				// delete and recreate thumbnail image
				$targetthumb = $tinybrowser['docroot'].$editpath.'_thumbs/_'.$_POST['actionfile'][$rotatethis];
				if (file_exists($targetthumb)) unlink($targetthumb);
				$mime = getimagesize($targetimg);
				$im = convert_image($targetimg,$mime['mime']);
				resizeimage($im,$tinybrowser['thumbsize'],$tinybrowser['thumbsize'],$targetthumb,$tinybrowser['thumbquality'],$mime['mime']);
				imagedestroy($im);
				}
			else $errorqty++;
			}
		}
	}

// Read directory contents and populate $file array
$dh = opendir($tinybrowser['docroot'].$editpath);
$file = array();
while (($filename = readdir($dh)) !== false)
	{
	if($filename != '.' && $filename != '..' && !is_dir($tinybrowser['docroot'].$editpath.$filename))
		{
		// search file name if search term entered
		if($findnow) $exists = stripos($filename,$findnow);

		// assign file details to array, for all files or those that match search
		if(!$findnow || ($findnow && $exists !== false))
			{
			$file['name'][] = $filename;
			$file['sortname'][] = strtolower($filename);
			$file['modified'][] = filemtime($tinybrowser['docroot'].$editpath.$filename);
			$file['size'][] = filesize($tinybrowser['docroot'].$editpath.$filename);

			// image specific info or general
			if($typenow=='image' && $imginfo = getimagesize($tinybrowser['docroot'].$editpath.$filename))
				{
				$file['width'][] = $imginfo[0];
				$file['height'][] = $imginfo[1];
				$file['dimensions'][] = $imginfo[0] + $imginfo[1];
				$file['type'][] = $imginfo['mime'];
				}
			else
				{
				$file['width'][] = 'N/A';
				$file['height'][] = 'N/A';
				$file['dimensions'][] = 'N/A';
				$file['type'][] = returnMIMEType($filename);
				}
			}
		}
	}
closedir($dh);

// Assign directory structure to array
$editdirs=array();
dirtree($editdirs,$tinybrowser['docroot'],$tinybrowser['path'][$typenow]);

// generate alert if files deleted
if($deleteqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGDELETE, $deleteqty);
	}
// generate alert if files renamed
elseif($renameqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGRENAME, $renameqty);
	}
// generate alert if files renamed
elseif($moveqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGMOVE, $moveqty);
	}
// generate alert if images resized
elseif($resizeqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGRESIZE, $resizeqty);
	}
// generate alert if images rotated
elseif($rotateqty>0)
   {
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGROTATE, $rotateqty);
	}
	
// generate alert if file errors encountered
if($errorqty>0)
   {
	$notify['type'][]='failure';
	$notify['message'][]=sprintf(TB_MSGEDITERR, $errorqty);
	}

// determine sort order
$sortorder = ($sorttypenow == 'asc' ? SORT_ASC : SORT_DESC);
$num_of_files = (isset($file['name']) ? count($file['name']) : 0);

if($num_of_files>0)
	{
	// sort files by selected order
	sortfileorder($sortbynow,$sortorder,$file);
	}

// determine pagination
if($tinybrowser['pagination']>0)
	{
	$showpagestart = ($showpagenow ? ($_REQUEST['showpage']*$tinybrowser['pagination'])-$tinybrowser['pagination'] : 0);
	$showpageend = $showpagestart+$tinybrowser['pagination'];
	if($showpageend>$num_of_files) $showpageend = $num_of_files;
	}
else
	{
	$showpagestart = 0;
	$showpageend = $num_of_files;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>TinyBrowser :: <?php echo TB_EDIT; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
if($passfeid == '' && $tinybrowser['integration']=='tinymce')
	{
	?><link rel="stylesheet" type="text/css" media="all" href="<?php echo $tinybrowser['tinymcecss']; ?>" /><?php 
	}
else
	{
	?><link rel="stylesheet" type="text/css" media="all" href="css/stylefull_tinybrowser.css" /><?php 
	}
?>
<link rel="stylesheet" type="text/css" media="all" href="css/style_tinybrowser.css.php" />
<script language="javascript" type="text/javascript" src="js/tinybrowser.js.php"></script>
</head>
<body onload="rowHighlight();">
<?php
if(count($notify['type'])>0) alert($notify);
form_open('foldertab',false,basename($_SERVER['SCRIPT_NAME']),'?type='.$typenow.$passfeid);
?>
<div class="tabs">
<ul>
<li id="browse_tab"><span><a href="tinybrowser.php?type=<?php echo $typenow.$passfolder.$passfeid ; ?>"><?php echo TB_BROWSE; ?></a></span></li>
<?php
if($tinybrowser['allowupload']) 
	{
	?><li id="upload_tab"><span><a href="upload.php?type=<?php echo $typenow.$passfolder.$passfeid ; ?>"><?php echo TB_UPLOAD; ?></a></span></li>
	<?php 
	} ?>
<li id="edit_tab" class="current"><span><a href="edit.php?type=<?php echo $typenow.$passfolder.$passfeid ; ?>"><?php echo TB_EDIT; ?></a></span></li>
<?php
if($tinybrowser['allowfolders'])
	{
	?><li id="folders_tab"><span><a href="folders.php?type=<?php echo $typenow.$passfolder.$passfeid; ?>"><?php echo TB_FOLDERS; ?></a></span></li><?php
	}
// Display folder select, if multiple exist
if(count($editdirs)>1)
	{
	?><li id="folder_tab" class="right"><span><?php
	form_select($editdirs,'folder',TB_FOLDERCURR,urlencode($foldernow),true);
	form_hidden_input('sortby',$sortbynow);
   form_hidden_input('sorttype',$sorttypenow);
   form_hidden_input('showpage',$showpagenow);
	form_hidden_input('action',$actionnow);
	?></span></li><?php
	}
?>
</ul>
</div>
</form>
<div class="panel_wrapper">
<div id="general_panel" class="panel currentmod">
<fieldset>
<legend><?php echo TB_EDITFILES; ?></legend>
<?php
form_open('edit','custom',basename($_SERVER['SCRIPT_NAME']),'?type='.$typenow.$passfolder.$passfeid);
?>
<div class="pushleft">
<?php

// Assign edit actions based on file type and permissions
$select = array();
if($tinybrowser['allowdelete']) $select[] = array('delete',TB_DELETE);
if($tinybrowser['allowedit']) $select[] = array('rename',TB_RENAME);
if($tinybrowser['allowfolders']) $select[] = array('move',TB_MOVE);
if($typenow=='image' && $tinybrowser['allowedit'])
	{
	$select[] = array('resize',TB_RESIZE);
	$select[] = array('rotate',TB_ROTATE);
	}
form_select($select,'action',TB_ACTION,$actionnow,true);

// Show page select if pagination is set
if($tinybrowser['pagination']>0)
	{
	$pagelimit = ceil($num_of_files/$tinybrowser['pagination'])+1;
	$page = array();
	for($i=1;$i<$pagelimit;$i++)
		{
		$page[] = array($i,TB_PAGE.' '.$i);
		}
	if($i>2) form_select($page,'showpage',SHOW,$showpagenow,true);
	}
?></div><div class="pushright"><?php

form_hidden_input('sortby',$sortbynow);
form_hidden_input('sorttype',$sorttypenow);
form_text_input('find',false,$findnow,25,50);
form_submit_button('search',TB_SEARCH,'');
?></div><?php

form_open('actionform','custom',basename($_SERVER['SCRIPT_NAME']),'?type='.$typenow.$passfolder.$passfeid);

if($actionnow=='move')
   { ?><div class="pushleft"><?php
   form_select($editdirs,'destination',TB_FOLDERDEST,urlencode($destfoldernow),false);
   ?></div><?php
   } 

if($typenow=='image')
	{
	$selectresize = array(
		array('width',TB_WIDTH),
		array('height',TB_HEIGHT)
		);
	}

switch($actionnow) 
	{
	case 'delete':
		$actionhead = TB_DELETE;
		break;
	case 'rename':
		$actionhead = TB_RENAME;
		break;
	case 'resize':
		$actionhead = TB_RESIZE;
		break;
	case 'rotate':
		$actionhead = TB_ROTATE;
		break;
 	case 'move':
		$actionhead = TB_MOVE;
		break;
	default:
		// do nothing
	}
?><div class="tabularwrapper"><table class="browse"><tr>
<th><a href="?type=<?php echo $typenow.$passaction.$passfolder.$passfeid.$sortbyget['name']; ?>"<?php echo $thclass['name']; ?>><?php echo TB_FILENAME; ?></a></th>
<th><a href="?type=<?php echo $typenow.$passaction.$passfolder.$passfeid.$sortbyget['size']; ?>"<?php echo $thclass['size']; ?>><?php echo TB_SIZE; ?></a></th>
<th><a href="?type=<?php echo $typenow.$passaction.$passfolder.$passfeid.$sortbyget['type']; ?>"<?php echo $thclass['type']; ?>><?php echo TB_TYPE; ?></th>
<th class="nohvr"><?php echo $actionhead; ?></th></tr>
<?php

for($i=$showpagestart;$i<$showpageend;$i++)
	{
	$alt = (IsOdd($i) ? 'r1' : 'r0');
	echo '<tr class="'.$alt.'">';
	if($typenow=='image') echo '<td><a class="imghover" href="#" onclick="return false;" title="'.$file['name'][$i].'&#13;&#10;'.TB_DIMENSIONS.': '.$file['width'][$i].' x '.$file['height'][$i].'&#13;&#10;'.TB_DATE.': '.date($tinybrowser['dateformat'],$file['modified'][$i]).'"><img src="'.$thumbpath.'_thumbs/_'.$file['name'][$i].$imagerefresh.'" alt="" />' .truncate_text($file['name'][$i],30).'</a></td>';
	else echo '<td title="'.$file['name'][$i].'&#13;&#10;'.TB_DATE.': '.date($tinybrowser['dateformat'],$file['modified'][$i]).'">'.truncate_text($file['name'][$i],30).'</td>';
	echo '<td>'.bytestostring($file['size'][$i],1).'</td><td>'.$file['type'][$i].'</td>'
	.'<td>';
	form_hidden_input('actionfile['.$i.']',$file['name'][$i]);
	switch($actionnow) 
		{
		case 'delete':
			echo '<input class="del" type="checkbox" name="deletefile['.$i.']" value="1" />';	
			break;
		case 'rename':
			$ext = '.'.end(explode('.',$file['name'][$i]));
			form_hidden_input('renameext['.$i.']',$ext);
			form_text_input('renamefile['.$i.']',false,basename($file['name'][$i],$ext),30,120); echo $ext;
			break;
		case 'resize':
			form_text_input('resizefile['.$i.']',false,'',4,4); form_select($selectresize,'resizetype['.$i.']',false,'',false);
			break;
		case 'rotate':
			echo '<img src="img/rotate_c.gif" alt="'.TB_ROTATECW.'" /><input class="rad" type="radio" name="rotatefile['.$i.']" value="clock"><img src="img/rotate_ac.gif" alt="'.TB_ROTATECCW.'" /><input class="rad" type="radio" name="rotatefile['.$i.']" value="anticlock">'.TB_NONE.'<input class="rad" type="radio" name="rotatefile['.$i.']" value="none" checked>';
			break;
		case 'move':
			echo '<input class="del" type="checkbox" name="movefile['.$i.']" value="1" />';
			break;
		default:
			// do nothing
		}
	echo "</td></tr>\n";
	}

echo "</table></div>\n".'<div class="pushright">';
if($tinybrowser['allowdelete'] || $tinybrowser['allowedit'])
	{
	form_hidden_input('sortby',$sortbynow);
	form_hidden_input('sorttype',$sorttypenow);
	form_hidden_input('find',$findnow);
	form_hidden_input('showpage',$showpagenow);
	form_hidden_input('action',$actionnow);
	form_submit_button('commit',$actionhead.' '.TB_FILES,'edit');
	}
?>
</div></fieldset></div></div>
</body>
</html>
