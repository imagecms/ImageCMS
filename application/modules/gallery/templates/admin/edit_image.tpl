<!--<div class="top-navigation">
    <div style="float:left;">
        <ul>
            <li>
                <form id="image_upload_form" style="width:100%;" method="post" enctype="multipart/form-data" action="{site_url('admin/components/run/gallery/upload_image/' . $album['id'])}">
                     <input name="userfile" id="file" size="27" type="file" /> 

                    <div style="height:16px;width:130px;float:left;text-align: center; overflow: hidden;" class="button_silver_130">
                        <div style="color:#000000;">{lang("Select a file", 'gallery')}</div>
                        <input type="file" name="userfile" id="file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" />
                    </div>

                    <input type="submit" name="action" value="{lang("Upload a file", 'gallery')}" class="button_silver_130" />
                    <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
                    {form_csrf()}</form>
            </li>
            <li>
                <span id="upload_result"></span>
            </li>
        </ul>
    </div>

    <div align="right" style="padding:7px 13px;">
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/'); return false;"  >{lang("Gallery", 'gallery')}</a> 
        >
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/{$category.id}'); return false;">{$category.name}</a> 
        >
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/{$album.id}'); return false;">{$album.name}</a>     
    </div>
</div>-->

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Album", 'gallery')}: <a href="/admin/components/cp/gallery/edit_album/{$album.id}" class="pjax">{$album.name}</a></span>
        </div>
        <div class="pull-right">                
            <div class="d-i_b">
                <a  href="/admin/components/cp/gallery/edit_album/{$album.id}"  class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Return', 'gallery')}</span></a>
                {echo create_language_select($languages, $locale, "/admin/components/cp/gallery/edit_image/" . $image.id)}
            </div>
        </div>            
            
    </div>
    <div class="row inside_padd">
        <div class="span4">
            <span class="img-polaroid d-i_b">
                <img src="{media_url($album_url . '/' . $image['file_name'] .'_prev'. $image['file_ext'])}"/>
            </span>
        </div>
        <div class="span7">
            <dl class="dl-horizontal m-t_20 dt_130pxwidth">
                <dt>{lang("Name", 'gallery')}</dt>
                <dd>{truncate($image.file_name, 25)}{$image.file_ext}</dd>
                <dt>{lang("Has been downloaded", 'gallery')}</dt>
                <dd>{date('Y-m-d H:i', $image.uploaded)}</dd>
                <dt>{lang("Views", 'gallery')}</dt>
                <dd>{$image.views}</dd>
                <dt>{lang("File size", 'gallery')}</dt>
                <dd>{$image.file_size}</dd>
                <dt>{lang("Image size", 'gallery')}</dt>
                <dd>{$image.width}px / {$image.height}px</dd>
            </dl>
            <form method="post" action="{site_url('admin/components/run/gallery/update_info/' . $image.id . '/' . $locale )}" id="change_img_desc" class="form-horizontal">
                <label>
                    <input type="checkbox" name="cover" value="1" {if $image.id == $album['cover_id']} checked="checked" {/if}/>{lang("Preview", 'gallery')}
                </label>
                <label class="number">
                    {lang("Position", 'gallery')}<input type="text" value="{$image.position}" name="position" />
                </label>
                <label>
                    {lang("Description", 'gallery')}
                    <textarea name="description" class="smallTextarea elRTE">{$image.description}</textarea>
                </label>
                <div class="m-t_10">
                    <button type="submit" class="btn btn-primary formSubmit" data-form="#change_img_desc"><i class="icon-ok"></i> {lang("Save", 'gallery')}</button>
                    <a href="/admin/components/cp/gallery/edit_album/{$album.id}" class="btn">{lang("Cancel", 'gallery')}</a>
                </div>
                {form_csrf()}
            </form>

            <form method="post" action="{site_url('admin/components/cp/gallery/rename_image/' . $image.id)}" id="change_imn_name_form">
                <label>{lang("New name", 'gallery')}<input type="text" class="textbox_short" name="new_name" /></label>
                <button type="submit" class="btn btn-primary formSubmit" data-form="#change_imn_name_form"><i class="icon-ok"></i> {lang("Save", 'gallery')}</button>
                {form_csrf()}
            </form>
        </div>
    </div>
</section>