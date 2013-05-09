<section class="mini-layout">
         <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Widget settings") ?> <b> <?php $widget.name ?> </b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/widgets_manager/index" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Go back") ?> </span></a>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form"><i class="icon-ok"></i> <?php lang("Have been saved") ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-edit"></i> <?php lang("Save and go back") ?> </button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="row-fluid">
            <form action=" <?php $BASE_URL ?> admin/widgets_manager/update_widget/ <?php $widget.id ?> " id="widget_form" method="post" class="form-horizontal">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th> <?php lang("Settings") ?> </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="inside_padd">
                                    <div class="row-fluid">
                                        <div class="control-group">
                                            <label class="control-label" for="comcount"> <?php lang("Images limit") ?> :</label>
                                            <div class="controls">
                                                <input id="comcount" type="text" name="limit" value=" <?php $widget.settings.limit ?> "/> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="symcount"> <?php lang("Algorithm") ?> :</label>
                                            <div class="controls">
                                                <select name="order" id="symcount"> 
                                                    <option value="latest"  <?php if $widget.settings.order=='latest' ?> selected="selected" <?php /if ?> > <?php lang("Last images") ?> </option>
                                                    <option value="random"  <?php if $widget.settings.order=='random' ?> selected="selected" <?php /if ?> > <?php lang("Random images") ?> </option>
                                                </select> 
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                 <?php form_csrf() ?> 
            </form>
        </div>
    </div>
</section><div id="titleExt"><h5> <?php widget('path') ?> <span class="ext"><?php  lang('Gallery') ?></span></h5></div>

 <?php if is_array($albums) ?> 
<ul class="products">
     <?php $counter = 1 ?> 
     <?php foreach $albums as $album ?>      
    <li  <?php if $counter == 3 ?>  class="last"  <?php $counter = 0 ?>  <?php /if ?> >  
        <a href=" <?php site_url('gallery/album/' . $album.id) ?> " class="image"><img src=" <?php $album.cover_url ?> " border="0" /></a>
        <h3 class="name"><a href=" <?php site_url('gallery/album/' . $album.id) ?> "> <?php $album.name ?> </a></h3>
    </li>
     <?php $counter++ ?> 
     <?php /foreach ?> 
</ul>

 <?php else: ?> 
    <?php lang('Albums not found.') ?>
 <?php /if ?> 
<script src=" <?php $THEME ?> /js/lightBox/js/jquery.lightbox-0.5-min.js"></script>
<link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /js/lightBox/css/jquery.lightbox-0.5-min.css" />
 <?php literal ?> 
    <script type="text/javascript">
    $(function() <?php 
        $('a.lightbox').lightBox( <?php fixedNavigation:true ?> );
     ?> )
    </script>
 <?php /literal ?> 
<div id="titleExt"><h5><a href=" <?php site_url('gallery') ?> "><?php lang('Gallery')) ?></a> &gt;&gt; <span class="ext"> <?php $album.name ?> </span></h5></div>

<div align="center">
<table cellpadding="1" cellspacing="1" border="0">
    <tr>
        <td colspan="2">
            <a href=" <?php media_url($album_url . $prev_img.full_name) ?> " class="lightbox" title=" <?php $prev_img.description ?> " >
                <img src=" <?php media_url($prev_img.url) ?> " style="border:5px solid #E8E8E8;" />
            </a>  
        </td>
    </tr>
    <tr>
        <td>
            <span class="g_small"><?php lang('Image') ?><?php $current_pos ?><?php lang('from') ?><?php count($album.images) ?> </span>
        </td>
        <td align="right">
            <span class="g_small"><a href=" <?php site_url('gallery/thumbnails/' . $album.id) ?> "><?php lang('All images') ?></a></span>
        </td>
    </tr>
</table>

     <?php if $prev ?> <a id="gallery_nav" href=" <?php site_url($album_link . 'image/'. $prev.id) ?> "#image>&lt;&lt;&nbsp;<?php lang('Previous') ?></a>&nbsp;&nbsp; <?php /if ?> 
     <?php if $next ?> &nbsp;&nbsp;<a id="gallery_nav" href=" <?php site_url($album_link . 'image/'. $next.id) ?> "#image><?php lang('Naxt') ?>&nbsp;&gt;&gt;</a> <?php /if ?> 
</div>

<br />

<div class="comments">
     <?php $comments ?> 
</div>

<!-- Image info
     <?php $prev_img.full_name ?>  /  <?php $prev_img.width ?> x <?php $prev_img.height ?>  /  <?php $prev_img.file_size ?>  /  <?php date('Y-m-d H:i', $prev_img.uploaded) ?> 
-->

<!-- Thumbs list
<div class="gallery_thumbs" align="center">
    <ul>
         <?php foreach $album.images as $image ?> 
           <li>
           <a href=" <?php site_url($album_link . 'image/'. $image.id) ?> #image" title=" <?php $image.description ?> "><img src=" <?php site_url($thumb_url . $image.full_name) ?> " alt=" <?php $image.description ?> " /></a>
            <a style="display:none;" rel="lightbox[gallery]" href=" <?php site_url($album_url . $image.full_name) ?> "></a>
           </li>
         <?php /foreach ?> 
    </ul>
</div>
-->

<div id="titleExt"><h5><a href=" <?php site_url('gallery') ?> "><?php lang('Gallery')?></a> &gt;&gt; <span class="ext"> <?php $album.name ?> </span></h5></div>
<ul class="products thumbs">
	  <?php $counter = 1 ?> 
     <?php foreach $album.images as $image ?> 
     <li  <?php if $counter == 4 ?>  class="last"  <?php $counter = 0 ?>  <?php /if ?> >
      <a href=" <?php site_url($album_link . 'image/'. $image.id) ?> " title=" <?php $image.description ?> " class="image"><img src=" <?php media_url($thumb_url . $image.full_name) ?> " alt=" <?php $image.description ?> " /></a>
     </li>
      <?php $counter++ ?> 
     <?php /foreach ?> 
</ul>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Image CMS Gallery</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="generator" content="ImageCMS">

     <?php literal ?> 
    <style type="text/css">
    body  <?php 
        font-size: 12px;
        font-family: Verdana, Sans-serif;  
        background-color: #DDDDDD;
        color: #333333;
        padding: 0;
        margin: 0;  
        width:100%;
        height:100%;
     ?> 

    img  <?php   
        border-style: none;
     ?>  

    .header  <?php 
        font-size:16px;
        background-color:#333333;
        color:#EFEFEF;  
        padding: 5px;
        border-bottom: 4px solid #888383;
     ?> 

    a, a:visited 
     <?php 
        border-bottom:0px;
        color:#225588;
        outline-style:none;
        outline-width:medium;
        text-decoration:underline;
     ?> 

    h1  <?php 
        font-size: 16px;
        text-transform: uppercase;
     ?> 

    .container  <?php 
        margin:auto;
        width:750px;
     ?> 

    .content  <?php 
        background-color: #F1F1F1; 
        width: 750px;
        padding:5px;
        border:2px solid #CCCCCC; 
        min-height:300px;
        float:left;
     ?> 

    .albums_list  <?php 
        position:relative;
     ?> 

    .albums_list ul  <?php  
        list-style:none;
        text-align:left;
     ?> 

    .albums_list li  <?php 
        margin:0;
        float:left;
        display:table-cell;
        width:200px;
        height:150px;
        padding:5px;
     ?> 

    .albums_list p  <?php 
        padding:0;
        margin:0;
     ?> 

    .date  <?php 
        font-size:10px;
        display:block;
     ?> 

    .menu  <?php 
        float:left;
        background-color:#F1F1F1;
        padding:5px;
        width:200px;
        background-color: #F1F1F1; 
        border:2px solid #CCCCCC; 

     ?> 

    .menu ul  <?php 
        list-style:none;
        padding-left:15px;
     ?> 

    .menu li.empty  <?php 
        height:15px;
     ?> 

    </style>
     <?php /literal ?> 

</head>

<body>

    <div class="header">
        Image CMS Gallery
    </div>

        <div class="container">
            <div class="content">
                 <?php $content ?> 
            </div>
        </div>

        <div class="menu">
            <ul>
                <li><a href=" <?php site_url('gallery') ?> "><?php lang('All albums') ?></a><li>
                <li class="empty"></li>
                <li><?php lang('Categories') ?>:<li>
                 <?php foreach $gallery_category as $category ?> 
                <li><a href=" <?php site_url('gallery/category/' . $category.id) ?> "> <?php $category.name ?> </a></li>
                 <?php /foreach ?> 
            </ul>
        </div>

</body>
</html>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Settings") ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Back") ?> </span></a>
                <button name="button" class="btn formSubmit btn-primary" data-submit data-form="#gallery_settings_form"> <?php lang("Save") ?> </button> 
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <form method="post" action=" <?php site_url('admin/components/cp/gallery/settings/update') ?> " id="gallery_settings_form">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang("Categories and albums") ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <div class="control-label"> <?php lang("Sort") ?> :</div>
                                                <div class="controls">
                                                    <select name="order_by" class="input-large">
                                                        <option value="date"  <?php if $settings.order_by == "date" ?>  selected="selected"  <?php /if ?> > <?php lang("By date") ?> </option>    
                                                        <option value="name"  <?php if $settings.order_by == "name" ?>  selected="selected"  <?php /if ?> > <?php lang("in alphabetic order") ?> </option>    
                                                        <option value="position"  <?php if $settings.order_by == "position" ?>  selected="selected"  <?php /if ?> > <?php lang("By position") ?> </option> 
                                                    </select>
                                                    <select name="sort_order" class="input-large">
                                                        <option value="desc"  <?php if $settings.sort_order == "desc" ?>  selected="selected"  <?php /if ?> > <?php lang("in descending order") ?> </option> 
                                                        <option value="asc"  <?php if $settings.sort_order == "asc" ?>  selected="selected"  <?php /if ?> > <?php lang("in  ascending order") ?> </option>    
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang("Images") ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="max_file_size"> <?php lang("maximum file size") ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp; <?php lang("In megabites") ?> </div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.max_file_size ?> " name="max_file_size" id="max_file_size"/> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="max_width"> <?php lang("Maximum width") ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;px</div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.max_width ?> " name="max_width" id="max_width"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="max_height"> <?php lang("Maximum height") ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;px</div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.max_height ?> " name="max_height" id="max_height"/>
                                                    </div>
                                                </div>
                                            </div><div class="control-group">
                                                <label class="control-label" for="quality"> <?php lang("Quality") ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;%</div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.quality ?> " name="quality" id="quality" maxlength="3" data-max="100"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label"> <?php lang("Save ratio") ?> </div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1"  <?php if $settings.maintain_ratio == TRUE ?> checked="checked" <?php /if ?>    name="maintain_ratio" /> <?php lang("Yes") ?> </label>
                                                    <label class="d-i_b"><input type="radio" value="0"  <?php if $settings.maintain_ratio == FALSE ?> checked="checked" <?php /if ?>  name="maintain_ratio" /> <?php lang("No") ?> </label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label"> <?php lang("Cut the borders") ?> </div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1"  <?php if $settings.crop == TRUE ?> checked="checked" <?php /if ?>    name="crop" />  <?php lang("Yes") ?> </label>
                                                    <label class="d-i_b"><input type="radio" value="0"  <?php if $settings.crop == FALSE ?> checked="checked" <?php /if ?>  name="crop" />  <?php lang("No") ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang("Image preview") ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="prev_img_width"> <?php lang("height") ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp; <?php lang("px") ?> </div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.prev_img_width ?> " name="prev_img_width" id="prev_img_width"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="prev_img_height"> <?php lang('amt_height') ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp; <?php lang("px") ?> </div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.prev_img_height ?> " name="prev_img_height" id="prev_img_height"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label"> <?php lang("Save ratio") ?> </div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1"  <?php if $settings.maintain_ratio_prev == TRUE ?> checked="checked" <?php /if ?>    name="maintain_ratio_prev" />  <?php lang("Yes") ?> </label>
                                                    <label class="d-i_b"><input type="radio" value="0"  <?php if $settings.maintain_ratio_prev == FALSE ?> checked="checked" <?php /if ?>  name="maintain_ratio_prev" />  <?php lang("No") ?> </label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label"> <?php lang("Cut the borders") ?> </div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1"  <?php if $settings.crop_prev == TRUE ?> checked="checked" <?php /if ?>    name="crop_prev" />  <?php lang("Yes") ?> </label>
                                                    <label class="d-i_b"><input type="radio" value="0"  <?php if $settings.crop_prev == FALSE ?> checked="checked" <?php /if ?>  name="crop_prev" />  <?php lang("No") ?> </label>
                                                </div>
                                            </div>
                                        </div>                                                
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang("Image icons") ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="thumb_width"> <?php lang("height") ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp; <?php lang("px") ?> </div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.thumb_width ?> " name="thumb_width" id="thumb_width"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="thumb_height"> <?php lang('amt_height') ?> </label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp; <?php lang("px") ?> </div>
                                                    <div class="o_h number">
                                                        <input type="text" value=" <?php $settings.thumb_height ?> " name="thumb_height" id="thumb_height"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label"> <?php lang("Save ratio") ?> </div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1"  <?php if $settings.maintain_ratio_icon == TRUE ?> checked="checked" <?php /if ?>  name="maintain_ratio_icon" />  <?php lang("Yes") ?> </label>
                                                    <label class="d-i_b"><input type="radio" value="0"  <?php if $settings.maintain_ratio_icon == FALSE ?> checked="checked" <?php /if ?>  name="maintain_ratio_icon" />  <?php lang("No") ?> </label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label"> <?php lang("Cut the borders") ?> </div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1"  <?php if $settings.crop_icon == TRUE ?> checked="checked" <?php /if ?>    name="crop_icon" />  <?php lang("Yes") ?> </label>
                                                    <label class="d-i_b"><input type="radio" value="0"  <?php if $settings.crop_icon == FALSE ?> checked="checked" <?php /if ?>  name="crop_icon" />  <?php lang("No") ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang("Watermark") ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="wm_hor_alignment"> <?php lang("horizontal alignment") ?> </label>
                                                <div class="controls">
                                                    <select name="wm_hor_alignment" id="wm_hor_alignment">
                                                        <option  <?php if $settings.wm_hor_alignment == 'left' ?> selected="selected" <?php /if ?>  value="left"> <?php lang("left or on the left") ?> </option>
                                                        <option  <?php if $settings.wm_hor_alignment == 'center' ?> selected="selected" <?php /if ?>  value="center"> <?php lang("in the center") ?> </option>
                                                        <option  <?php if $settings.wm_hor_alignment == 'right' ?> selected="selected" <?php /if ?>  value="right"> <?php lang("on the right") ?> </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="wm_vrt_alignment"> <?php lang("vertical alignment") ?> </label>
                                                <div class="controls">
                                                    <select name="wm_vrt_alignment" id="wm_vrt_alignment">
                                                        <option  <?php if $settings.wm_vrt_alignment == 'top' ?> selected="selected" <?php /if ?>  value="top"> <?php lang("at the top") ?> </option>
                                                        <option  <?php if $settings.wm_vrt_alignment == 'middle' ?> selected="selected" <?php /if ?>  value="middle"> <?php lang("in the middle") ?> </option>
                                                        <option  <?php if $settings.wm_vrt_alignment == 'bottom' ?> selected="selected" <?php /if ?>  value="bottom"> <?php lang("at the bottom") ?> </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="watermark_type"> <?php lang("Type") ?> </label>
                                                <div class="controls">
                                                    <select name="watermark_type" onchange="show_watermark_block();" id="watermark_type">
                                                        <option value="text"   <?php if $settings.watermark_type == 'text' ?> selected="selected" <?php /if ?>   > <?php lang("Text") ?> </option>
                                                        <option value="overlay"  <?php if $settings.watermark_type == 'overlay' ?> selected="selected" <?php /if ?>  > <?php lang("Image") ?> </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Image settings -->
                                            <div id="image_settings"  <?php if $settings.watermark_type == 'text' ?> style="display:none;" <?php /if ?> >
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_image"> <?php lang("Path to the image") ?> </label>
                                                    <div class="controls">
                                                        <input type="text" value=" <?php $settings.watermark_image ?> " name="watermark_image" id="watermark_image"/>
                                                        <span class="help-inline"> <?php lang("File has to be located on the server. For example") ?> : ./uploads/images/logo.png</span>            
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_image_opacity"> <?php lang("Transparency") ?> </label>
                                                    <div class="controls">
                                                        <div class="pull-right help-block">&nbsp;&nbsp;%</div>
                                                        <div class="o_h number">
                                                            <input type="text" value=" <?php $settings.watermark_image_opacity ?> " name="watermark_image_opacity" id="watermark_image_opacity" maxlength="3" data-max="100"/>
                                                            <span class="help-inline"> <?php lang("Select a digit from 1 to 100") ?> </span> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_padding"> <?php lang("Offset") ?> </label>
                                                    <div class="controls">
                                                        <div class="pull-right help-block">&nbsp;&nbsp; <?php lang("px") ?> </div>
                                                        <div class="o_h">
                                                            <input type="text" value=" <?php $settings.watermark_padding ?> " name="watermark_padding" id="watermark_padding"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="text_settings"  <?php if $settings.watermark_type == 'overlay' ?> style="display:none;" <?php /if ?> >
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_text"> <?php lang("Text") ?> </label>
                                                    <div class="controls">
                                                        <input type="text" value=" <?php $settings.watermark_text ?> " name="watermark_text" id="watermark_text"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_font_size"> <?php lang("Font size") ?> </label>
                                                    <div class="controls number">
                                                        <input type="text" value=" <?php $settings.watermark_font_size ?> " name="watermark_font_size" id="watermark_font_size"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_color"> <?php lang("Font colour") ?> </label>
                                                    <div class="controls">
                                                        <input type="text" value=" <?php $settings.watermark_color ?> " name="watermark_color" id="watermark_color" maxlength="6"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_padding2"> <?php lang("Offset") ?> </label>
                                                    <div class="controls">
                                                        <div class="pull-right help-block">&nbsp;&nbsp; <?php lang("px") ?> </div>
                                                        <div class="o_h">
                                                            <input type="text" value=" <?php $settings.watermark_padding ?> " name="watermark_padding" id="watermark_padding2"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_font_path"> <?php lang("Path to font") ?> </label>
                                                    <div class="controls">
                                                        <input type="text" value=" <?php $settings.watermark_font_path ?> " name="watermark_font_path" id="watermark_font_path"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                 <?php form_csrf() ?> 
                </form>
            </div>
        </div>
    </div>
</section>
 <?php literal ?> 
    <script type="text/javascript">
                                    function show_watermark_block()
                                     <?php 
                                        $('#text_settings, #image_settings').toggle();
                                     ?> 

    </script>
 <?php /literal ?> 
                    
                    
                    

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Albums") ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Back") ?> </span></a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i> <?php lang("Create") ?> </a>
            </div>
        </div>
    </div>
    <div id="gallery_main_block">
         <?php if $albums ?> 
            <ul class="sortable2 f-s_0 save_positions albums_list" data-url="/admin/components/cp/gallery/update_album_positions">
                 <?php foreach $albums as $item ?> 
                    <li>
                        <table  class="table table-striped table-bordered">
                            <tr>
                                <td class="span2" style="border-top: 0;">
                                    <div class="t-a_c">
                                         <?php if $item.cover_url != 'empty' ?> 
                                            <a href="/admin/components/cp/gallery/edit_album/ <?php $item.id ?> " class="pjax t-d_n">
                                                <img src=" <?php $item.cover_url ?> "/>
                                            </a>
                                         <?php else: ?> 
                                            <img src=" <?php $THEME ?> /img/no_image.png"/>
                                         <?php /if ?> 
                                        <div class="m-t_10">
                                            <a href="/admin/components/init_window/gallery/edit_album/ <?php $item.id ?> " class="btn btn-small" data-rel="tooltip" data-title=" <?php lang("View images") ?> "><i class="icon-fullscreen"></i><?php lang('Photo view') ?></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="span10" style="border-top: 0;border-left: 0;">
                                    <table class="no-borderd">
                                        <tbody>
                                            <tr>
                                                <th> <?php lang("Name") ?> :</th>
                                                <td> <?php $item.name ?> </td>
                                            </tr>
                                            <tr>
                                                <th> <?php lang("Created") ?> :</th>
                                                <td> <?php date('Y-m-d H:i', $item.created) ?> </td>
                                            </tr>
                                            <tr>
                                                <th> <?php lang("Has been updated or updated") ?> :</th>
                                                <td> <?php if $item.updated != NULL ?>   <?php date('Y-m-d H:i', $item.updated) ?>    <?php else: ?>  0000-00-00 00:00  <?php /if ?> </td>
                                            </tr>
                                            <tr>
                                                <th> <?php lang("Views") ?> :</th>
                                                <td> <?php $item.views ?> </td>
                                            </tr>
                                            <tr>
                                                <th> <?php lang("Description") ?> :</th>
                                                <td>  <?php truncate(strip_tags($item.description), 55, '...') ?> </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <a href="/admin/components/init_window/gallery/edit_album_params/ <?php $item.id ?> " class="btn btn-small   " data-rel="tooltip" data-title=" <?php lang('a_to_edit') ?> "><i class="icon-edit"></i> <?php lang('Edit album') ?></a>
                                                    <button type="button" class="btn btn-danger btn-small" data-rel="tooltip" onclick="change_status('/admin/components/init_window/gallery/delete_album/ <?php echo $item.id ?> / <?php echo $item.category_id ?> ')" data-title=" <?php lang("Delete") ?> " data-remove=""><i class="icon-trash icon-white"></i><?php lang('Delete album') ?></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <input type="hidden" name="ids" value=" <?php $item.id ?> ">
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </li>
                 <?php /foreach ?> 
            </ul>
         <?php else: ?> 
            <div class="alert alert-info m-t_20">
                 <?php lang("No albums found") ?> 
            </div>
         <?php /if ?> 
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang("Delete album?") ?> </h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');"> <?php lang("Cancel") ?> </a>
        <a href="" class="btn btn-primary" onclick="GalleryAlbums.deleteCategoriesConfirm();$('.modal').modal('hide');"> <?php lang("Delete") ?> </a>
    </div>
</div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n"> <?php lang("Album") ?> :  <?php $album['name'] ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery/category/ <?php $album['category_id'] ?> " class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Back") ?> </span></a>
                <label style="display:inline;">
                    <button type="button" class="btn btn-small btn-success openDlg"><i class="icon-white icon-plus"></i> <?php lang('a_add_pictures') ?> </button>
                </label>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#addPics" data-submit><i class="icon-white icon-ok"></i> <?php lang("Save") ?> </button>
                <button type="button" class="btn btn-small btn-danger action_on disabled"  onclick="$('.modal').modal('show');"><i class="icon-trash icon-white"></i> <?php lang("Delete") ?> </button>
            </div>
        </div>                            
    </div>  

    <div id="picsToUpload">

    </div>
   
     <?php if $album.images ?> 
        <table class="table">
            <tbody>
                <tr>
                    <td style="border: 0;">
                        <div class="well well-small">
                            <div class="frame_label all_select">
                                <span class="niceCheck">
                                    <input type="checkbox"/>
                                </span>
                                 <?php lang("Chose all photos") ?> 
                            </div>
                        </div>
                        <ul class="sortable2 f-s_0 save_positions photo_list albums_list" data-url="/admin/components/cp/gallery/update_img_positions" data-url-delete="/admin/components/cp/gallery/delete_image">
                             <?php foreach $album.images as $item ?> 
                                <li>
                                    <table  class="table table-striped table-bordered">
                                        <tr>
                                            <td>
                                                <div class="pull-left m-r_15">
                                                    <spna class="frame_label">
                                                        <span class="niceCheck">
                                                            <input type="checkbox" name="ids" value=" <?php $item.id ?> "/>
                                                        </span>
                                                    </spna>
                                                </div>
                                                <div class="t-a_c photo_album o_h">
                                                    <img title=" <?php $item.file_name ?>  <?php $item.file_ext ?> " src=" <?php media_url($album_url . '/' . $item['file_name'] .'_prev'. $item['file_ext']) ?> "/>
                                                    <div class="btn-group f-s_0">
                                                        <button type="button" class="btn" data-rel="tooltip" onclick="shopCategories.deleteCategoriesConfirm($(this).closest('td').find('[name=ids]').val());" data-title=" <?php lang("Delete") ?> " data-remove=""><i class="icon-remove"></i></button>
                                                        <a href="/admin/components/init_window/gallery/edit_image/ <?php $item.id ?> " class="btn" data-rel="tooltip" data-title=" <?php lang('a_to_edit') ?> "><i class="icon-edit"></i></a>
                                                    </div>
                                                    <div class="fon"></div>
                                                </div>
                                                <div class="m-t_10">
                                                    <b> <?php lang("Name") ?> :</b> <span title=" <?php $item.file_name ?>  <?php $item.file_ext ?> "> <?php truncate($item['file_name'], 10) ?>  <?php $item.file_ext ?> </span><br/>
                                                    <b> <?php lang("Size") ?> :</b>  <?php $item.file_size ?>  Kb
                                                </div>
                                                <input type="hidden" name="ids" value=" <?php $item.id ?> ">
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                             <?php /foreach ?> 
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
     <?php else: ?> 
        <div class="alert alert-info m-t_20">
             <?php lang("Album is empty") ?> 
        </div>
     <?php /if ?> 

    <div>
        <form action="/admin/components/cp/gallery/upload_image/ <?php $album.id ?> " id="addPics" method="post"  enctype="multipart/form-data" style="visibility: hidden;height: 0px;">
            <input type="file" multiple="multiple"  name="newPic[]" id="addPictures" class="multiPic" data-previewdiv="#picsToUpload">
        </form>
    </div>
            
</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang("Deleting photos") ?> :</h3>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang("Cancel") ?> </a>
        <a href="#" class="btn btn-primary" onclick="shopCategories.deleteCategoriesConfirm()"> <?php lang("Delete") ?> </a>
    </div>
</div><div id="notice_error">
     <?php $error ?> 
</div>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Create a category") ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Back") ?> </span></a>
                <button type="button" class="btn btn-small action_on formSubmit btn-success" data-form="#create_category_form" data-action="edit" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang("Create") ?> </button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#create_category_form" data-action="close"><i class="icon-check"></i> <?php lang("Save and exit") ?> </button>
            </div>
        </div>
    </div>
    <div class="inside_padd">
        <div class="form-horizontal row-fluid">
            <div class="span9">
                <form method="post" action=" <?php site_url('admin/components/cp/gallery/create_category') ?> " id="create_category_form">
                    <div class="control-group">
                        <label class="control-label" for="name"> <?php lang("Name") ?> :</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" value="" required/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="g_c_desc"> <?php lang("Description") ?> :</label>
                        <div class="controls">
                            <textarea name="description" id="g_c_desc" class="elRTE"> <?php htmlspecialchars($category.description) ?> </textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="position"> <?php lang("Position") ?> :</label>
                        <div class="controls number">
                            <input type="text" name="position" id="position" value=""/>
                        </div>
                    </div>
                     <?php form_csrf() ?> 
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php lang('Delete categories') ?></h3>
    </div>
    <div class="modal-body">
        <p><?php lang('Delete selected categories') ?>?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang("Cancel") ?> </a>
        <a href="#" class="btn btn-primary" onclick="GalleryCategories.deleteCategoriesConfirm()" > <?php lang("Delete") ?> </a>
    </div>
</div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Edit the category") ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Back") ?> </span></a>
                <button type="button" class="btn btn-small formSubmit btn-primary" data-form="#create_category_form" data-action="edit" data-submit><i class="icon-ok"></i> <?php lang("Have been saved") ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#create_category_form" data-action="close"><i class="icon-check"></i> <?php lang("Save and exit") ?> </button>
            </div>
        </div>
    </div>
    <div class="inside_padd">
        <div class="form-horizontal row-fluid">
            <div class="span9">
                <form method="post" action=" <?php site_url('admin/components/cp/gallery/update_category/' . $category.id) ?> " id="create_category_form">
                    <div class="control-group">
                        <label class="control-label" for="name"> <?php lang("Name") ?> :</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" value=" <?php $category.name ?> " required=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="g_c_desc"> <?php lang("Description") ?> :</label>
                        <div class="controls">
                            <textarea name="description" id="g_c_desc" class="elRTE"> <?php htmlspecialchars($category.description) ?> </textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="position"> <?php lang("Position") ?> :</label>
                        <div class="controls number">
                            <input type="text" name="position" id="position" value=" <?php $category.position ?> " class="textbox_long" />
                        </div>
                    </div>
                     <?php form_csrf() ?> 
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php lang('Removing categories') ?></h3>
    </div>
    <div class="modal-body">
        <p><?php lang('Delete selected categories') ?>?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang("Cancel") ?> </a>
        <a href="#" class="btn btn-primary" onclick="GalleryCategories.deleteCategoriesConfirm()" > <?php lang("Delete") ?> </a>
    </div>
</div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Categories") ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="$('.modal').modal();" disabled="disabled"><i class="icon-trash icon-white"></i> <?php lang("Delete") ?> </button>
                <a href="/admin/components/init_window/gallery/show_create_category" class="btn btn-small pjax btn-success"><i class="icon-plus-sign icon-white"></i> <?php lang("Create a category") ?> </a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i> <?php lang("Create an album") ?> </a>
                <a href="/admin/components/cp/gallery/settings" class="btn btn-small pjax"> <?php lang("Settings") ?> </a>
            </div>
        </div>
    </div>
     <?php if $categories ?> 
        <table id="cats_table" class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th class="t-a_c span1">
                <span class="frame_label">
                    <span class="niceCheck">
                        <input type="checkbox">
                    </span>
                </span>
            </th>
            <th> <?php lang("ID") ?> </th>
            <th> <?php lang("Name") ?> </th>
            <th> <?php lang("Albums") ?> </th>
            <th> <?php lang("Description") ?> </th>
            <th> <?php lang("Created or Has been created") ?> </th>
            </thead>
            <tbody class="sortable save_positions" data-url="/admin/components/cp/gallery/update_positions">
                 <?php foreach $categories as $category ?> 
                    <tr>
                        <td class="t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck">
                                    <input type="checkbox" name="ids" value=" <?php $category.id ?> ">
                                </span>
                            </span>
                        </td>
                        <td> <?php $category.id ?> </td>
                        <td class="share_alt">
                            <a class="pjax" href="/admin/components/init_window/gallery/edit_category/ <?php $category.id ?> " data-rel="tooltip" data-placement="top" data-original-title=" <?php lang("Edit the category") ?> "> <?php $category.name ?> </a>
                        </td>
                        <td>
                             <?php if $category.albums_count ?> 
                                <a href="/admin/components/init_window/gallery/category/ <?php $category.id ?> " class="pjax" data-rel="tooltip" data-placement="top" data-original-title=" <?php lang("View albums") ?> " >(<?php lang('View albums')?>)</a>
                             <?php /if ?> 
                             <?php $category.albums_count ?> 
                        </td>
                        <td> <?php truncate(htmlspecialchars($category.description), 75) ?> </td>
                        <td> <?php date('Y-d-m H:i', $category.created) ?> </td>
                    </tr>
                 <?php /foreach ?> 
            </tbody>
        </table>
     <?php else: ?> 
        <div class="alert alert-info m-t_20">
             <?php lang("Category list is empty") ?> 
        </div>
     <?php /if ?> 
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang("Delete category?") ?> </h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');"> <?php lang("Cancel") ?> </a>
        <a href="" class="btn btn-primary" onclick="GalleryCategories.deleteCategoriesConfirm();$('.modal').modal('hide');"> <?php lang("Delete") ?> </a>
    </div>
</div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Album") ?>  # <?php $album.id ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery/category/ <?php $album['category_id'] ?> " class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Back") ?> </span></a>
                <button type="button" class="btn btn-small formSubmit btn-primary" data-form="#create_album_form" data-action="edit" data-submit><i class="icon-ok"></i> <?php lang("Save") ?> </button> 
                <button type="button" class="btn btn-small formSubmit" data-form="#create_album_form" data-action="close"><i class="icon-check"></i> <?php lang("Save and go back") ?> </button>
                <button type="button" class="btn btn-small btn-danger" onclick="$('.modal').modal('show');GalleryAlbums.whatDelete(this);" ><i class="icon-trash icon-white"></i> <?php lang("Delete") ?> </button> 
            </div>
        </div>
    </div>
    <div class="inside_padd">
        <div class="form-horizontal row-fluid">
            <div class="span9">
                <form method="post" action=" <?php site_url('admin/components/cp/gallery/update_album/' . $album.id ) ?> " id="create_album_form">
                    <div class="control-group">
                        <label class="control-label" for="category_id"> <?php lang("Categories") ?> :</label>
                        <div class="controls">
                            <select name="category_id" id="category_id">
                                 <?php foreach $categories as $item ?> 
                                <option value=" <?php $item.id ?> "   <?php if $item['id'] == $album['category_id']  ?> selected="selected" <?php /if ?>  > <?php $item.name ?> </option>
                                 <?php /foreach ?> 
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name"> <?php lang("Name") ?> :</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" value=" <?php htmlspecialchars($album.name) ?> " required=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for=""> <?php lang("Description") ?> :</label>
                        <div class="controls">
                            <textarea name="description" class="elRTE"> <?php htmlspecialchars($album.description) ?> </textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for=""> <?php lang("Position") ?> :</label>
                        <div class="controls">
                            <input type="text" name="position" value=" <?php $album.position ?> " class="textbox_long" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for=""> <?php lang("Template file") ?> :</label>
                        <div class="controls">
                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                            <div class="o_h">
                                <input type="text" name="tpl_file" value=" <?php $album.tpl_file ?> " class="textbox_long" />
                                <div class="help-block"> <?php lang("by default") ?>  album.tpl</div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value=" <?php $album.id ?> " name="album_id"/>
                    <input type="hidden" value=" <?php $album['category_id'] ?> " name="category_id"/>
                     <?php form_csrf() ?> 
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang("Album deletion") ?> :</h3>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang("Cancel") ?> </a>
        <a href="#" class="btn btn-primary" onclick="GalleryAlbums.deleteCategoriesConfirm()" > <?php lang("Delete") ?> </a>
    </div>
</div>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang("Create an album") ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang("Back") ?> </span></a>
                <button type="button" name="button" class="btn formSubmit btn-success" data-form="#create_album_form" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang("Create an album") ?> </button> 
            </div>
        </div>
    </div>
    <div class="inside_padd">
        <div class="form-horizontal row-fluid">
            <div class="span9">
                <form method="post" action=" <?php site_url('admin/components/cp/gallery/create_album') ?> " id="create_album_form">
                    <div class="control-group">
                        <label class="control-label" for="category_id"> <?php lang("Categories") ?> :</label>
                        <div class="controls">
                            <select name="category_id" id="category_id">
                                <!-- <option value="0"><?php lang('No')?></option> -->
                                 <?php foreach $categories as $item ?> 
                                    <option value=" <?php $item.id ?> "> <?php $item.name ?> </option>
                                 <?php /foreach ?> 
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name"> <?php lang("Name") ?> :</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" value="" required/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="description"> <?php lang("Description") ?> :</label>
                        <div class="controls">
                            <textarea name="description" id="description" class="elRTE"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="tpl_file"> <?php lang("Template file") ?> :</label>
                        <div class="controls">
                            <div class="pull-right help-block">.tpl</div>
                            <div class="o_h">
                                <input type="text" name="tpl_file" id="tpl_file" value=""/>
                                <span class="help-block"> <?php lang("by default") ?> : album.tpl</span>
                            </div>
                        </div>
                    </div>
                     <?php form_csrf() ?> 
                </form>
            </div>
        </div>
    </div>
</section><!--<div class="top-navigation">
    <div style="float:left;">
        <ul>
            <li>
                <form id="image_upload_form" style="width:100%;" method="post" enctype="multipart/form-data" action=" <?php site_url('admin/components/run/gallery/upload_image/' . $album['id']) ?> ">
                     <input name="userfile" id="file" size="27" type="file" /> 

                    <div style="height:16px;width:130px;float:left;text-align: center; overflow: hidden;" class="button_silver_130">
                        <div style="color:#000000;"> <?php lang("Select a file") ?> </div>
                        <input type="file" name="userfile" id="file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" />
                    </div>

                    <input type="submit" name="action" value=" <?php lang("Upload a file") ?> " class="button_silver_130" />
                    <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
                     <?php form_csrf() ?> </form>
            </li>
            <li>
                <span id="upload_result"></span>
            </li>
        </ul>
    </div>

    <div align="right" style="padding:7px 13px;">
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/'); return false;"  > <?php lang("Gallery") ?> </a> 
        >
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/ <?php $category.id ?> '); return false;"> <?php $category.name ?> </a> 
        >
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/ <?php $album.id ?> '); return false;"> <?php $album.name ?> </a>     
    </div>
</div>-->

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n"> <?php lang("Album") ?> : <a href="/admin/components/cp/gallery/edit_album/ <?php $album.id ?> " class="pjax"> <?php $album.name ?> </a></span>
        </div>
        <div class="pull-right">                
            <div class="d-i_b">
                <a  href="/admin/components/cp/gallery/edit_album/ <?php $album.id ?> "  class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"><?php lang('Return') ?></span></a>
            </div>
        </div>            
            
    </div>
    <div class="row inside_padd">
        <div class="span4">
            <span class="img-polaroid d-i_b">
                <img src=" <?php media_url($album_url . '/' . $image['file_name'] .'_prev'. $image['file_ext']) ?> "/>
            </span>
        </div>
        <div class="span7">
            <dl class="dl-horizontal m-t_20">
                <dt> <?php lang("Name") ?> </dt>
                <dd> <?php truncate($image.file_name, 25) ?>  <?php $image.file_ext ?> </dd>
                <dt> <?php lang("Has been downloaded or downloaded") ?> </dt>
                <dd> <?php date('Y-m-d H:i', $image.uploaded) ?> </dd>
                <dt> <?php lang("Views") ?> </dt>
                <dd> <?php $image.views ?> </dd>
                <dt> <?php lang("File size") ?> </dt>
                <dd> <?php $image.file_size ?> </dd>
                <dt> <?php lang("Image size") ?> </dt>
                <dd> <?php $image.width ?> px /  <?php $image.height ?> px</dd>
            </dl>
            <form method="post" action=" <?php site_url('admin/components/run/gallery/update_info/' . $image.id) ?> " id="change_img_desc" class="form-horizontal">
                <label>
                    <input type="checkbox" name="cover" value="1"  <?php if $image.id == $album['cover_id'] ?>  checked="checked"  <?php /if ?> /> <?php lang("Preview or skin or cover") ?> 
                </label>
                <label class="number">
                     <?php lang("Position") ?> <input type="text" value=" <?php $image.position ?> " name="position" />
                </label>
                <label>
                     <?php lang("Description") ?> 
                    <textarea name="description" class="textarea elRTE"> <?php $image.description ?> </textarea>
                </label>
                <div class="m-t_10">
                    <button type="submit" class="btn btn-primary formSubmit" data-form="#change_img_desc"><i class="icon-ok"></i>  <?php lang("Save") ?> </button>
                    <a href="/admin/components/cp/gallery/edit_album/ <?php $album.id ?> " class="btn"> <?php lang("Cancel") ?> </a>
                </div>
                 <?php form_csrf() ?> 
            </form>

            <form method="post" action=" <?php site_url('admin/components/cp/gallery/rename_image/' . $image.id) ?> " id="change_imn_name_form">
                <label> <?php lang("New name") ?> <input type="text" class="textbox_short" name="new_name" /></label>
                <button type="submit" class="btn btn-primary formSubmit" data-form="#change_imn_name_form"><i class="icon-ok"></i>  <?php lang("Save") ?> </button>
                 <?php form_csrf() ?> 
            </form>
        </div>
    </div>
</section><div id="gallery_latest_images">
     <?php  lang('My last photo');  ?> 
     <?php foreach $images as $image ?> 
        <a href=" <?php site_url($image.url) ?> "><img src=" <?php $image.thumb_path ?> " title=" <?php $image.description ?> " /></a>
     <?php /foreach ?> 
</div>
