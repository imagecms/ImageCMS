<?PHP header("Content-Type: text/html; charset=utf-8");?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-type" content="eng" />
<meta name="description" content="Generator of sprites and optimizer of images &ndash; forms sprite, optimizes an image, creates CSS-rules and corresponding to them html-file" />
<meta name="keywords" content="Generator sprites, optimization image, stick image, creation css, creation html" />
<title>Main</title>
<?php include('blocks/css.php')?>
</head>
<body>
<?php $index='engstart.php'; $help='enghelp.php'; $langu='index.php'; $lange='engstart.php'; $p=1; include('blocks/headerENG.php')?>
<div class="cont clear">
<?php
$hr=$_GET['hr'];
$jak=$_GET['jak'];
$dis=$_GET['dis'];
$caf=$_GET['caf'];
$car=$_GET['car'];
$type=$_GET['type'];
switch ($type)
{	case v: $h='of width';$h_s='width';
	break;
	case h: $h='of height';$h_s='height';
	break;}
if (!isset($_GET['caf'])){$caf='3';}
$filesource=$_GET['filesource'];
$fileexit=$_GET['fileexit'];
if (isset($dis)){
printf("<br><a href='%s' class='df'>%s</a>", $hr, $jak);
printf("<div class ='info' style='display:%s;'>
<dl>
<dt class='dt_info'>total size of files to:</dt>
<dd>%s kb</dd>
<dt class='dt_info'>total file size after:</dt>
<dd>%s kb</dd>
</dl>
</div><br />", $dis, $filesource, $fileexit);
if ($caf!=3){echo '<span id="ch2">Important notes: </span><div id="nv">';}
if (($caf+$car<=2) and ($caf+$car>=1)) {
if ($caf==1){
	echo '<span>It is recommended to choose files for sticking in sprite of identical format, if you are not sure that converting in other format will decrease a filesize
</span>';}	
if ($car==1){
	echo '<span>It is recommended to choose an image for sticking in sprite &ndash; with identical  <b>'.$h.'</b>, large overfall <b>'.$h_s.'</b> will increase unoccupied space accordingly and size of sprite</span>';
	}echo '</div>';
}
else if ($caf+$car==0){echo '<span>Does not have important notes</span></div>';}
else if ($caf==3){echo '';}
}?>

<form action="upload.php" method=post enctype="multipart/form-data" id="f1">
<fieldset>
    <legend><span class="downlegend">Loading of archive</span></legend>
    <div class="button">Choose a zip archive<input type=file name=userfile></input></div>
    <label class="pidk" id="note">size of archive no more 2 MB.</label>
</fieldset>

<fieldset>
    <legend><span class="downlegend">Choice of operation and settings</span></legend>
    <dl>
    <label for="op1"><input type="radio" name="choose_oper" value="ops" checked="checked" id="op1" onchange="addsett(this);"/>sticking in the sprite and optimization</label>
    <label for="op2"><input type="radio" name="choose_oper" value="opi" id="op2" onchange="addsett(this);"/>optimization of separate images</label>
</fieldset>

<fieldset>
    <legend><span class="downlegend">Doublets of images</span></legend>
    <dl>
        <label for="ign2"><input type=radio name="doubleimg" value="noignore" id="ign2" checked="checked">delete the image that repeat</label>
        <label for="ign1"><input type=radio name="doubleimg" value="ignore" id="ign1">to ignore the doublets of images</label>
    </dl>
</fieldset>

<fieldset>
    <legend><span class="downlegend">Change of size of entrance images</span></legend>
    <dl>
        <dt>type of size of images:</dt>
        <dd>
            <label for="t2"><input type="radio" name="choose_rozm" value="rel" checked="checked" id="t2" onchange="proporstart();"/>relative</label>
            <label for="t1"><input type="radio" name="choose_rozm" value="absol" id="t1" onchange="proporstart();"/>absolute</label>
        </dd>
        <dd class="n_b">
            <label for="propor1"><input type=checkbox name="propor1" id="propor1" checked="checked" onchange="proporstart();">to save proportions</label>
            <label for="propor2"><input type=checkbox name="propor2" id="propor2" checked="checked" onchange="proporstart();">initial sizes</label>
        </dd>
        <dt>width:</dt>
        <dd>
            <input type="text" maxlength="5" size="3" value="100" name="width_res" id="width_res" onchange="proporstart();"></input><label id="unitv1">%</label><label class="pidk" id="w">(percent of width of image)</label></dd>
        <dt>height:</dt>
        <dd>
            <input type="text" maxlength="3" size="3" value="100" name="height_res" id="height_res" onchange="proporstart();"></input><label id="unitv2">%</label><label class="pidk" id="h">(percent of height of image)</label></dd>
    </dl>
</fieldset>

<fieldset>
    <legend><span class="downlegend">Settings</span></legend>
    <dl>
        <dt>name of file of image:</dt>
        <dd>
        	<input type="text" maxlength="10" size="10" value="myfileimg" name="nameimg" id="nameimg" onFocus="doClear(this)" onblur="doadd(this)"></input></dd>
        <dt>type of sprite:</dt>
        <dd>
            <label for="s3"><input type="radio" name="choose_sprite" value="b_a" id="s3" checked="checked"/>automatic</label>
            <label for="s1"><input type="radio" name="choose_sprite" value="v" id="s1"/>vertical</label>
            <label for="s2"><input type="radio" name="choose_sprite" value="h" id="s2"/>horizontal</label>
        </dd>
        <dt>format of initial image:</dt>
        <dd>
            <div class="l_b">
                <select name="choose_type" id="choose_type" onchange="addsett(this);">
                <option value="jpeg" selected="selected">JPEG</option>
                <option value="png">PNG</option>
                <option value="gif">GIF</option>
                </select>
                <label for="res"><input type="checkbox" name="res" id="res" disabled onchange="addsett(this);"></input>save image format</label>		</div>
            <div class="l_b">
            	<label for="b_f"><input type="checkbox" name="b_f" id ="b_f" onchange="addsett(this);"></input>to choose automatically</label>
            </div><label class="pidk">in the case of choice there will be the chosen format which a filesize(-s) is the least in</label>
        </dd>
        <dt>amount of colors:</dt>
        <dd>
            <select name="image_color" id="image_color"  disabled>
            <?php $j=2;for($i=1; $i<=8; $i++){echo "<option value='$j'>$j</option>"; $j*=2;}?>
            <option value="true_color" selected="selected">actual color</option>
            </select>
            <label class="pidk">(for gif and png)</label>
        </dd>       
        <dt>quality of images:</dt>
        <dd>
            <input type="text" maxlength="3" size="3" value="" name="jpeg_qual" id="jpeg_qual"></input><label>%</label><label class="pidk">max. 100% (for jpeg)</label>
        </dd>
        <dt>background colour:<input type="text" maxlength="7" size="3" value="" name="colorfon" id = "colorfon"></input></dt>
        <dd>
	        <label class="pidk">possible input:(for example #000, #000000 or without &ndash; #)</label><label class="pidk">if a value will be not correct, or not will be set then a white color will be chosen</label>
        </dd>
        <dt>transparency and alpha channel:</dt>
        <dd>
            <div class="l_b"><label for="alfa"><input type="checkbox" name="alfa" id = "alfa" disabled></input>alpha is a channel in png images</label><br />
            <label for="iepng" style="margin-left:-38px;display:block;"><input type="checkbox" name="iepng" id = "iepng" disabled></input>to correct the problem of reflection of png in IE 6</label></div>
            <div class="l_b"><label>transparent color for gif:</label><input type="text" maxlength="7" size="3" name="opacity" id = "opacity" disabled></input>
            </div><label class="pidk">if the value is not correct for the 16th system will not be that color</label>
        </dd>
        <dt>Mode Interlaced:</dt>
        <dd>
            <input type="checkbox" name="interlaced" id = "interlaced" ></input><label for="interlaced">to set mode interlaced</label><label class="pidk">index display for (png, gif), progressive display for (jpeg)</label>
        </dd>
        <dt>spacing between images:</dt>
        <dd>
	        <input type="text" maxlength="3" size="3" value="0" name="margin" id = "margin" onFocus="doClear(this)" onblur="doadd(this)"></input><label>px</label>
        </dd>
    </dl>
</fieldset>

<fieldset>
    <legend><span class="downlegend">Advanced settings</span></legend>
    <dl id="csshtml">
        <dt id="ch">
        <label for="css"><input type="checkbox" name="css" value="css" checked="checked" id="css" onchange="addsett(this);"/>write a CSS file</label></dt>
        <dt>type of selectors:</dt>
        <dd>
            <select name="choose_selector" id="choose_selector" onchange="addsett(this);">
            <option value="." selected="selected">classes (.)</option>
            <option value="#">identifiers (#)</option>
            </select>
        </dd>
        <dt>name of selectors:</dt>
        <dd>
            <input type="text" size="10" value="sprite_" name="nameselec" id="nameselec" onFocus="doClear(this)" onblur="doadd(this)"></input><label>begin from</label><input type="text" size="1" value="0" name="ord" id="ord" onFocus="doClear(this)" onblur="doadd(this)"></input>
        </dd>
        <dt>coder for:</dt>
        <dd>
            <select name="type_elem" id="type_elem" onchange="addsett(this);">
            <option value="div" selected="selected">blocks (div)</option>
            <option value="li">lists (li)</option>
            <option value="a">buttons</option>
            </select><br>
            <label for="examptext"><input type="checkbox" name="examptext" id="examptext" disabled></input>to insert text for the revision of formatting of CSS</label><br>
            <label for="bas"><input type="checkbox" name="bas" id="bas"></input>to make up pseudoelements</label><br>
            <label for="iepsevdo"><input type="checkbox" name="iepsevdo" id="iepsevdo"></input>to correct problems with pseudoelements in IE 6-7</label>
        </dd>
        <dt>repeating background:</dt>
        <dd>
            <select name="type_repeat" id="type_repeat">
            <option value="no-repeat" selected="selected">no-repeat</option>
            <option value="repeat-x">repeat-x</option>
            <option value="repeat-y">repeat-y</option>
            <option value="repeat">repeat</option>
            </select>
        </dd>
        <dt>name of file CSS::</dt>
        <dd>
            <input type="text" maxlength="" size="10" value="myfilecss" name="namecss" id="namecss" onFocus="doClear(this)" onblur="doadd(this)"></input><label>.css</label>
        </dd>
        <dt id="ch">
	        <label for="html"><input type="checkbox" name="html" value="html" checked="checked" id="html" onchange="addsett(this);"/>write HTML file</label></dt>
        <dt>type of DOCTYPE:</dt>
        <dd>
            <select name="choose_dtd" id="choose_dtd">
            <option value="d" disabled="disabled" class="d">Строгий</option>
            <option value="st4">DTD HTML 4.01</option>
            <option value="st1">DTD XHTML 1.0</option>
            <option value="d" disabled="disabled"></option>
            
            <option value="d" disabled="disabled">Перехідний</option>
            <option value="tr4">DTD HTML 4.01 Transitional</option>
            <option value="tr1" selected="selected">DTD XHTML 1.0 Transitional</option>
            <option value="d" disabled="disabled"></option>
            
            <option value="d" disabled="disabled">Фрейми</option>
            <option value="fr4">DTD HTML 4.01 Frameset</option>
            <option value="fr1">DTD XHTML 1.0 Frameset</option>
            <option value="d" disabled="disabled"></option>
            
            <option value="d" disabled="disabled">HTML5</option>
            <option value="html5">&lt;!DOCTYPE html&gt;</option>
            </select>
		</dd>
        <dt>code:</dt>
        <dd>
            <select name="choose_charset" id="choose_charset">
            <option value="ch1">Cyrillic alphabet (Windows)</option>
            <option value="ch2">Multilingual UTF-8</option>
            <option value="ch3">West-European(Windows)</option>
            </select>
        </dd>
        <dt>name of file HTML:</dt>
        <dd>
	        <input type="text" maxlength="" size="10" value="myfilehtml" name="namehtml" id="namehtml" onFocus="doClear(this)" onblur="doadd(this)"></input><label>.html</label>
        </dd>
        <dt id="ch">
	        <label for="js"><input type="checkbox" name="js" value="js" checked="checked" id="js"/>to write a script JavaScript to test the download speed</label></dt>
    </dl>
</fieldset>
<input type="hidden" name="url" id="url" value=""></input>
<input type=submit value="Create a sprite CSS and HTML" class="cboth">
</form>
<?php include('blocks/footer.php');?>