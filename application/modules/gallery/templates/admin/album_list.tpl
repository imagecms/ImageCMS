<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Albums", 'gallery')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang("Create album", 'gallery')}</a>
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
                                            <img src="{$THEME}img/no_image.png"/>
                                        {/if}
                                        <div class="m-t_10">
                                            <a href="/admin/components/init_window/gallery/edit_album/{$item.id}" class="btn btn-small" data-rel="tooltip" data-title="{lang("View images", 'gallery')}"><i class="icon-fullscreen"></i> {lang('View images', 'gallery')}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="span10" style="border-top: 0;border-left: 0;">
                                    <table class="no-borderd">
                                        <tbody>
                                            <tr>
                                                <th>{lang("Name", 'gallery')}:</th>
                                                <td>{$item.name}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang("Created", 'gallery')}:</th>
                                                <td>{date('Y-m-d H:i', $item.created)}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang("Has been updated", 'gallery')}:</th>
                                                <td>{if $item.updated != NULL} {date('Y-m-d H:i', $item.updated)}  {else:} 0000-00-00 00:00 {/if}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang("Views", 'gallery')}:</th>
                                                <td>{$item.views}</td>
                                            </tr>
                                            <tr>
                                                <th>{lang("Description", 'gallery')}:</th>
                                                <td> {truncate(strip_tags($item.description), 55, '...')}</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <a href="/admin/components/init_window/gallery/edit_album_params/{$item.id}"
                                                       class="btn btn-small"
                                                       data-rel="tooltip"
                                                       data-title="{lang('Edit', 'gallery')}">
                                                        <i class="icon-edit"></i> {lang('Edit albums', 'gallery')}
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-danger btn-small"
                                                            data-rel="tooltip"
                                                            onclick="change_status('/admin/components/init_window/gallery/delete_album/{echo $item.id}/{echo $item.category_id}')"
                                                            data-title="{lang('Delete', 'gallery')}"
                                                            data-remove="">
                                                        <i class="icon-trash icon-white"></i> {lang('Delete', 'gallery')}
                                                    </button>
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
                {lang("No albums found", 'gallery')}
            </div>
        {/if}
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Delete album?", 'gallery')}</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'gallery')}</a>
        <a href="" class="btn btn-primary" onclick="GalleryAlbums.deleteCategoriesConfirm();
                                                                    $('.modal').modal('hide');">{lang('Delete', 'gallery')}</a>
    </div>
</div>