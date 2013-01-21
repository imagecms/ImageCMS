<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('amt_album')}: {$album['name']}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery/category/{$album['category_id']}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <label style="display:inline;">
                    <button type="button" class="btn btn-small btn-success openDlg"><i class="icon-white icon-plus"></i>{lang('a_add_pictures')}</button>
                </label>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#addPics" data-submit><i class="icon-white icon-ok"></i>{lang('amt_save')}</button>
                <button type="button" class="btn btn-small btn-danger action_on disabled"  onclick="$('.modal').modal('show');"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
            </div>
        </div>                            
    </div>  

    <div id="picsToUpload">

    </div>
   
    {if $album.images}
        <table class="table">
            <tbody>
                <tr>
                    <td style="border: 0;">
                        <div class="well well-small">
                            <div class="frame_label all_select">
                                <span class="niceCheck">
                                    <input type="checkbox"/>
                                </span>
                                {lang('a_choose_all_photos')}
                            </div>
                        </div>
                        <ul class="sortable2 f-s_0 save_positions photo_list albums_list" data-url="/admin/components/cp/gallery/update_img_positions" data-url-delete="/admin/components/cp/gallery/delete_image">
                            {foreach $album.images as $item}
                                <li>
                                    <table  class="table table-striped table-bordered">
                                        <tr>
                                            <td>
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
                                                        <button type="button" class="btn" data-rel="tooltip" onclick="shopCategories.deleteCategoriesConfirm($(this).closest('td').find('[name=ids]').val());" data-title="{lang('a_delete')}" data-remove=""><i class="icon-remove"></i></button>
                                                        <a href="/admin/components/init_window/gallery/edit_image/{$item.id}" class="btn" data-rel="tooltip" data-title="{lang('a_to_edit')}"><i class="icon-edit"></i></a>
                                                    </div>
                                                    <div class="fon"></div>
                                                </div>
                                                <div class="m-t_10">
                                                    <b>{lang('a_name')}:</b> <span title="{$item.file_name}{$item.file_ext}">{truncate($item['file_name'], 10)}{$item.file_ext}</span><br/>
                                                    <b>{lang('a_size')}:</b> {$item.file_size} Kb
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
            {lang('a_album_empty')}
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
        <h3>{lang('a_acc_per_43')}:</h3>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        <a href="#" class="btn btn-primary" onclick="shopCategories.deleteCategoriesConfirm()">{lang('a_delete')}</a>
    </div>
</div>