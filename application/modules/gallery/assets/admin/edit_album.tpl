<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Album editing", 'gallery')}: {$album['name']}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery/category/{$album['category_id']}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <label style="display:inline-block;vertical-align: middle;margin-bottom:0;">
                    <button type="button" class="btn btn-small btn-success openDlg"><i class="icon-white icon-plus"></i>{lang('Add pictures', 'gallery')}</button>
                </label>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#addPics" data-submit><i class="icon-white icon-ok"></i>{lang("Save", 'gallery')}</button>
                <button type="button" class="btn btn-small btn-danger action_on disabled"  onclick="$('.modal:not(.addNotificationMessage)').modal('show');"><i class="icon-trash"></i>{lang("Delete", 'gallery')}</button>
            </div>
        </div>
    </div>

    <div id="picsToUpload">

    </div>

    {if $album.images}
        <table class="table content_big_td m-t_10">
            <tbody>
                <tr>
                    <td style="border: 0;padding: 0;">
                        <div class="well well-small m-b_0">
                            <div class="frame_label all_select">
                                <span class="niceCheck">
                                    <input type="checkbox"/>
                                </span>
                                {lang("Chose all photos", 'gallery')}
                            </div>
                        </div>
                        <ul class="sortable2 f-s_0 save_positions photo_list albums_list" data-url="/admin/components/cp/gallery/update_img_positions" data-url-delete="/admin/components/cp/gallery/delete_image">
                            {foreach $album.images as $item}
                                <li>
                                    <table  class="table  table-bordered content_big_td">
                                        <tr>
                                            <td style="border-top: 0;">
                                                <div class="pull-left m-r_15">
                                                    <spna class="frame_label">
                                                        <span class="niceCheck">
                                                            <input type="checkbox" name="ids" value="{$item.id}"/>
                                                        </span>
                                                    </spna>
                                                </div>
                                                <div class="t-a_c photo_album o_h">
                                                    <img title="{$item.file_name}{$item.file_ext}" src="{media_url($album_url . '/' . $item['file_name'] .'_prev'. $item['file_ext'])}"/>
                                                    <div class="btn-group f-s_0">
                                                        <button type="button" class="btn" data-rel="tooltip" onclick="shopCategories.deleteCategoriesConfirm($(this).closest('td').find('[name=ids]').val());" data-title="{lang("Delete", 'gallery')}" data-remove=""><i class="icon-trash"></i></button>
                                                        <a href="/admin/components/init_window/gallery/edit_image/{$item.id}" class="btn" data-rel="tooltip" data-title="{lang('Edit', 'gallery')}"><i class="icon-edit"></i></a>
                                                    </div>
                                                    <div class="fon"></div>
                                                </div>
                                                <div class="m-t_10">
                                                    <span title="{$item.file_name}{$item.file_ext}">{truncate($item['file_name'], 20)}{$item.file_ext}</span><br/>
                                                    <b>{lang("Size", 'gallery')}:</b> {$item.file_size} Kb
                                                </div>
                                                <input type="hidden" name="ids" value="{$item.id}">
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                            {/foreach}
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    {else:}
        <div class="alert alert-info m-t_20">
            {lang("Album is empty", 'gallery')}
        </div>
    {/if}

    <div>
        <form action="/admin/components/cp/gallery/upload_image/{$album.id}" id="addPics" method="post"  enctype="multipart/form-data" style="visibility: hidden;height: 0px;">
            <input type="file" multiple="multiple"  name="newPic[]" id="addPictures" class="multiPic" data-previewdiv="#picsToUpload">
        </form>
    </div>

</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Deleting photos", 'gallery')}</h3>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel", 'gallery')}</a>
        <a href="#" class="btn btn-primary" onclick="shopCategories.deleteCategoriesConfirm()">{lang("Delete", 'gallery')}</a>
    </div>
</div>