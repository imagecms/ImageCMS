<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_categories')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="$('.modal').modal();" disabled="disabled"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                <a href="/admin/components/init_window/gallery/show_create_category" class="btn btn-small pjax btn-success"><i class="icon-plus-sign icon-white"></i>{lang('amt_create_cat')}</a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang('amt_create_album')}</a>
                <a href="/admin/components/cp/gallery/settings" class="btn btn-small pjax">{lang('amt_settings')}</a>
            </div>
        </div>
    </div>
    {if $categories}
    <table id="cats_table" class="table table-striped table-bordered table-hover table-condensed content_big_td">
        <thead>
        <th class="t-a_c span1">
            <span class="frame_label">
                <span class="niceCheck">
                    <input type="checkbox">
                </span>
            </span>
        </th>
        <th>{lang('amt_id')}</th>
        <th>{lang('amt_name')}</th>
        <th>{lang('amt_albums')}</th>
        <th>{lang('amt_description')}</th>
        <th>{lang('amt_crea')}</th>
        </thead>
        <tbody class="sortable save_positions" data-url="/admin/components/cp/gallery/update_positions">
            {foreach $categories as $category}
            <tr>
                <td class="t-a_c">
                    <span class="frame_label">
                        <span class="niceCheck">
                            <input type="checkbox" name="ids" value="{$category.id}">
                        </span>
                    </span>
                </td>
                <td>{$category.id}</td>
                <td class="share_alt">
                    {if $category.albums_count}
                    <a href="/admin/components/init_window/gallery/category/{$category.id}" class="go_to_site pull-right btn btn-mini" data-rel="tooltip" data-placement="top" data-original-title="{lang('a_show_album')}" style="visibility: hidden; "><i class="icon-share-alt"></i></a>
                    {/if}
                    <a class="pjax" href="/admin/components/init_window/gallery/edit_category/{$category.id}" data-rel="tooltip" data-placement="top" data-original-title="{lang('amt_category_edit')}">{$category.name}</a>
                </td>
                <td>{$category.albums_count}</td>
                <td>{truncate(htmlspecialchars($category.description), 75)}</td>
                <td>{date('Y-d-m H:i', $category.created)}</td>
            </tr>
            {/foreach}
        </tbody>
    </table>
    {else:}
    <div class="alert alert-info m-t_20">
        {lang('a_empty_category_list')}
    </div>
    {/if}
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('a_category_delete')}</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang('a_footer_cancel')}</a>
        <a href="" class="btn btn-primary" onclick="GalleryCategories.deleteCategoriesConfirm();$('.modal').modal('hide');">{lang('a_delete')}</a>
    </div>
</div>