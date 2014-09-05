<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Categories", 'gallery')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="$('.modal').modal();" disabled="disabled"><i class="icon-trash icon-white"></i>{lang("Delete", 'gallery')}</button>
                <a href="/admin/components/init_window/gallery/show_create_category" class="btn btn-small pjax btn-success"><i class="icon-plus-sign icon-white"></i>{lang("Create a category", 'gallery')}</a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang("Create an album", 'gallery')}</a>
                <a href="/admin/components/cp/gallery/settings" class="btn btn-small pjax">{lang("Settings", 'gallery')}</a>
            </div>
        </div>
    </div>
    {if $categories}
        <table id="cats_table" class="table  table-bordered table-hover table-condensed t-l_a">
            <thead>
            <th class="t-a_c span1">
                <span class="frame_label">
                    <span class="niceCheck">
                        <input type="checkbox">
                    </span>
                </span>
            </th>
            <th>{lang("ID", 'gallery')}</th>
            <th>{lang("Name", 'gallery')}</th>
            <th>{lang("Albums", 'gallery')}</th>
            <th>{lang("Description", 'gallery')}</th>
            <th>{lang("Created", 'gallery')}</th>
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
                            <a class="pjax" href="/admin/components/init_window/gallery/edit_category/{$category.id}" data-rel="tooltip" data-placement="top" data-original-title="{lang("Edit category", 'gallery')}">{$category.name}</a>
                        </td>
                        <td>
                            {if $cnt = count_albums($category.id)}
                                <a href="/admin/components/init_window/gallery/category/{$category.id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="{lang("View albums", 'gallery')}" >({lang("View albums", 'gallery')})</a>
                            {/if}
                            {echo $cnt}
                        </td>
                        <td>{truncate($category.description, 75)}</td>
                        <td>{date('Y-d-m H:i', $category.created)}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else:}
        <div class="alert alert-info m-t_20">
            {lang("Category list is empty", 'gallery')}
        </div>
    {/if}
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Delete category?", 'gallery')}</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel", 'gallery')}</a>
        <a href="" class="btn btn-primary" onclick="GalleryCategories.deleteCategoriesConfirm();$('.modal').modal('hide');">{lang("Delete", 'gallery')}</a>
    </div>
</div>