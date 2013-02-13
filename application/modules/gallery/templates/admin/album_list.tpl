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
                                <td class="span2" style="border-top: 0;">
                                    <div class="t-a_c">
                                        {if $item.cover_url != 'empty'}
                                            <a href="/admin/components/cp/gallery/edit_album/{$item.id}" class="pjax t-d_n">
                                                <img src="{$item.cover_url}"/>
                                            </a>
                                        {else:}
                                            <img src="{$THEME}/img/no_image.png"/>
                                        {/if}
                                        <div class="m-t_10">
                                            <a href="/admin/components/init_window/gallery/edit_album/{$item.id}" class="btn btn-small" data-rel="tooltip" data-title="{lang('imgs_view')}"><i class="icon-fullscreen"></i> Просмотр фото</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="span10" style="border-top: 0;border-left: 0;">
                                    <table class="no-borderd">
                                        <tbody>
                                            <tr>
                                                <th>{lang('amt_name')}:</th>
                                                <td>{$item.name}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang('amt_cr')}:</th>
                                                <td>{date('Y-m-d H:i', $item.created)}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang('amt_up')}:</th>
                                                <td>{if $item.updated != NULL} {date('Y-m-d H:i', $item.updated)}  {else:} 0000-00-00 00:00 {/if}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang('amt_views')}:</th>
                                                <td>{$item.views}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang('amt_description')}:</th>
                                                <td> {truncate(strip_tags($item.description), 55, '...')}</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <a href="/admin/components/init_window/gallery/edit_album_params/{$item.id}" class="btn btn-small   " data-rel="tooltip" data-title="{lang('a_to_edit')}"><i class="icon-edit"></i> Редактировать альбом</a>
                                                    <button type="button" class="btn btn-danger btn-small" data-rel="tooltip" onclick="$('.modal').modal();GalleryAlbums.whatDelete(this);" data-title="{lang('a_delete')}" data-remove=""><i class="icon-trash icon-white"></i> Удалить альбом</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <input type="hidden" name="ids" value="{$item.id}">
                                    </table>
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