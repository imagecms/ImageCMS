<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Albums", 'gallery')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span>
                    <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <a href="/admin/components/init_window/gallery/show_crate_album?category_id={$category['id']}" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang("Create album", 'gallery')}
                </a>
            </div>
        </div>
    </div>
    <div id="gallery_main_block" class="m-t_10">
        {if $albums}
            <ul class="sortable2 f-s_0 save_positions albums_list galery-album-list" data-url="/admin/components/cp/gallery/update_album_positions">
                {foreach $albums as $item}
                    <li>
                        <table class="table table-bordered">
                            <tr>
                                <td class="span2" style="border-top: 0;">
                                    <div class="t-a_c">
                                        <a href="/admin/components/cp/gallery/edit_album/{$item.id}" class="photo-block pjax">
                                            <span class="helper"></span>
                                            {if $item.cover_url != 'empty'}
                                                <img src="{$item.cover_url}"/>
                                            {else:}
                                                <img src="{$THEME}images/select-picture.png"/>
                                            {/if}
                                        </a>
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
                                            {if $item.updated}
                                                <tr>
                                                    <th>{lang("Has been updated", 'gallery')}:</th>
                                                    <td>{if $item.updated != NULL} {date('Y-m-d H:i', $item.updated)}  {else:} 0000-00-00 00:00 {/if}</td>
                                                </tr>
                                            {/if}
                                            {if $item.views}
                                                <tr>
                                                    <th>{lang("Views", 'gallery')}:</th>
                                                    <td>{$item.views}</td>
                                                </tr>
                                            {/if}
                                            {if $item.description}
                                                <tr>
                                                    <th>{lang("Description", 'gallery')}:</th>
                                                    <td> {truncate(strip_tags($item.description), 55, '...')}</td>
                                                </tr>
                                            {/if}
                                        </tbody>
                                        <input type="hidden" name="ids" value="{$item.id}">
                                    </table>
                                    <div class="" style="padding: 4px;">
                                        <a href="/admin/components/init_window/gallery/edit_album/{$item.id}" class="btn btn-small" data-rel="tooltip" data-title="{lang("View images", 'gallery')}"><i class="icon-fullscreen"></i> {lang('View images', 'gallery')}
                                        </a>

                                        <a href="/admin/components/init_window/gallery/edit_album_params/{$item.id}"
                                           class="btn btn-small btn-icon-edit"
                                           data-rel="tooltip"
                                           data-title="{lang('Edit', 'gallery')}">
                                            <i class="icon-edit"></i> {lang('Edit albums', 'gallery')}
                                        </a>
                                        <button type="button"
                                                class="btn btn-small"
                                                data-rel="tooltip"
                                                onclick="$('.products_delete_dialog' +{echo $item.id}).modal('show');"
                                                data-title="{lang('Delete', 'gallery')}">
                                            <i class="icon-trash"></i> {lang('Delete', 'gallery')}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </li>
                    <div class="modal hide fade products_delete_dialog{echo $item.id}">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3>{lang("Delete album?", 'gallery')}</h3>
                        </div>
                        <div class="modal-footer">
                            <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'gallery')}</a>
                            <a href="" class="btn btn-primary" onclick="change_status('/admin/components/init_window/gallery/delete_album/{echo $item.id}/{echo $item.category_id}')
                                    $('.modal').modal('hide');">{lang('Delete', 'gallery')}</a>
                        </div>
                    </div>
                {/foreach}
            </ul>
        {else:}
            <div class="alert alert-info m-t_20">
                {lang("No albums found", 'gallery')}
            </div>
        {/if}
    </div>
</section>
