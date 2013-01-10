<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_albums')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang('a_create')}</a>
            </div>
        </div>
    </div>
    <div id="gallery_main_block">
        {if $albums}
        <ul class="sortable2 f-s_0 save_positions albums_list" data-url="/admin/components/cp/gallery/update_album_positions">
            {foreach $albums as $item}
            <li>
                <table  class="table table-striped table-bordered">
                    <tr>
                        <td>
                            <div class="t-a_c photo_album">
                                {if $item.cover_url != 'empty'}
                                <a href="/admin/components/cp/gallery/edit_album/{$item.id}" class="pjax">
                                    <img src="{$item.cover_url}"/>
                                </a>
                                {else:}
                                <img src="{$THEME}/img/no_image.png"/>
                                {/if}
                                <div class="btn-group f-s_0">
                                    <button type="button" class="btn" data-rel="tooltip" onclick="$('.modal').modal();GalleryAlbums.whatDelete(this);" data-title="{lang('a_delete')}" data-remove=""><i class="icon-remove"></i></button>
                                    <a href="/admin/components/init_window/gallery/edit_album_params/{$item.id}" class="btn" data-rel="tooltip" data-title="{lang('a_to_edit')}"><i class="icon-edit"></i></a>
                                    <a href="/admin/components/init_window/gallery/edit_album/{$item.id}" class="btn" data-rel="tooltip" data-title="{lang('imgs_view')}"><i class="icon-fullscreen"></i></a>
                                </div>
                                <div class="fon"></div>
                            </div>
                        </td>
                        <td>
                            {lang('amt_name')}: {$item.name}<br/>
                            {lang('amt_description')}: {truncate(strip_tags($item.description), 55, '...')}<br/>
                            {lang('amt_cr')}: {date('Y-m-d H:i', $item.created)}<br/>
                            {lang('amt_up')}: {if $item.updated != NULL} {date('Y-m-d H:i', $item.updated)}  {else:} 0000-00-00 00:00 {/if}<br/>
                            {lang('amt_views')}: {$item.views}<br />
                            <input type="hidden" name="ids" value="{$item.id}">
                        </td>
                    </tr>
                </table>
            </li>
            {/foreach}
        </ul>
        {else:}
        <div class="alert alert-info m-t_20">
            {lang('amt_no_albums')}
        </div>
        {/if}
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('a_album_delete')}</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang('a_footer_cancel')}</a>
        <a href="" class="btn btn-primary" onclick="GalleryAlbums.deleteCategoriesConfirm();$('.modal').modal('hide');">{lang('a_delete')}</a>
    </div>
</div>