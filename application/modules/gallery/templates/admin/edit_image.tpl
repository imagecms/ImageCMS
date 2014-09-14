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
    <table class="table table-bordered content_big_td">
        <tbody>
            <tr>
                <td style="border-top: 0;">
                    <div class="row-fluid inside_padd">
                        <div class="span4">
                            <span class="img-polaroid d-i_b">
                                <img src="{media_url($album_url . '/' . $image['file_name'] .'_prev'. $image['file_ext'])}"/>
                            </span>
                        </div>
                        <div class="span7">
                            <dl class="dl-horizontal m-t_20">
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
                                    <input type="checkbox" name="cover" value="1" {if $image.id == $album['cover_id']} checked="checked" {/if}/>{lang("Cover", 'gallery')}
                                </label>
                                <label class="number">
                                    <span class="m-r_10">{lang("Position", 'gallery')}</span>
                                    <input type="text" value="{$image.position}" name="position"/>
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
                                <label>
                                    <span class="m-r_10">{lang("New name", 'gallery')}</span>
                                    <input type="text" class="textbox_short" name="new_name" />
                                </label>
                                <button type="submit" class="btn btn-primary formSubmit" data-form="#change_imn_name_form"><i class="icon-ok"></i> {lang("Save", 'gallery')}</button>
                                {form_csrf()}
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</section>