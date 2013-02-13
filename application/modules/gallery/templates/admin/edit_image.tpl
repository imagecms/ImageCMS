<!--<div class="top-navigation">
    <div style="float:left;">
        <ul>
            <li>
                <form id="image_upload_form" style="width:100%;" method="post" enctype="multipart/form-data" action="{site_url('admin/components/run/gallery/upload_image/' . $album['id'])}">
                     <input name="userfile" id="file" size="27" type="file" /> 

                    <div style="height:16px;width:130px;float:left;text-align: center; overflow: hidden;" class="button_silver_130">
                        <div style="color:#000000;">{lang('amt_select_file')}</div>
                        <input type="file" name="userfile" id="file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" />
                    </div>

                    <input type="submit" name="action" value="{lang('amt_download_file')}" class="button_silver_130" />
                    <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
                    {form_csrf()}</form>
            </li>
            <li>
                <span id="upload_result"></span>
            </li>
        </ul>
    </div>

    <div align="right" style="padding:7px 13px;">
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/'); return false;"  >{lang('amt_gallery')}</a> 
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
            <span class="title w-s_n">{lang('amt_album')}: <a href="/admin/components/cp/gallery/edit_album/{$album.id}" class="pjax">{$album.name}</a></span>
        </div>
        <div class="pull-right">                
            <div class="d-i_b">
                <a  href="/admin/components/cp/gallery/edit_album/{$album.id}"  class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
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
            <dl class="dl-horizontal m-t_20">
                <dt>{lang('amt_name')}</dt>
                <dd>{truncate($image.file_name, 25)}{$image.file_ext}</dd>
                <dt>{lang('amt_downloaded')}</dt>
                <dd>{date('Y-m-d H:i', $image.uploaded)}</dd>
                <dt>{lang('amt_views')}</dt>
                <dd>{$image.views}</dd>
                <dt>{lang('amt_file_size')}</dt>
                <dd>{$image.file_size}</dd>
                <dt>{lang('amt_image_size')}</dt>
                <dd>{$image.width}px / {$image.height}px</dd>
            </dl>
            <form method="post" action="{site_url('admin/components/run/gallery/update_info/' . $image.id)}" id="change_img_desc" class="form-horizontal">
                <label>
                    <input type="checkbox" name="cover" value="1" {if $image.id == $album['cover_id']} checked="checked" {/if}/>{lang('amt_preview')}
                </label>
                <label class="number">
                    {lang('amt_position')}<input type="text" value="{$image.position}" name="position" />
                </label>
                <label>
                    {lang('amt_description')}
                    <textarea name="description" class="textarea elRTE">{$image.description}</textarea>
                </label>
                <div class="m-t_10">
                    <button type="submit" class="btn btn-primary formSubmit" data-form="#change_img_desc"><i class="icon-ok"></i> {lang('amt_save')}</button>
                    <a href="/admin/components/cp/gallery/edit_album/{$album.id}" class="btn">{lang('amt_cancel')}</a>
                </div>
                {form_csrf()}
            </form>

            <form method="post" action="{site_url('admin/components/cp/gallery/rename_image/' . $image.id)}" id="change_imn_name_form">
                <label>{lang('amt_new_name')}<input type="text" class="textbox_short" name="new_name" /></label>
                <button type="submit" class="btn btn-primary formSubmit" data-form="#change_imn_name_form"><i class="icon-ok"></i> {lang('amt_save')}</button>
                {form_csrf()}
            </form>
        </div>
    </div>
</section>