<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Categories")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="$('.modal').modal();" disabled="disabled"><i class="icon-trash icon-white"></i>{lang("Delete")}</button>
                <a href="/admin/components/init_window/gallery/show_create_category" class="btn btn-small pjax btn-success"><i class="icon-plus-sign icon-white"></i>{lang("Create a category")}</a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang("Create an album")}</a>
                <a href="/admin/components/cp/gallery/settings" class="btn btn-small pjax">{lang("Settings")}</a>
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
            <th>{lang("ID")}</th>
            <th>{lang("Name")}</th>
            <th>{lang("Albums")}</th>
            <th>{lang("Description")}</th>
            <th>{lang("Created or Has been created")}</th>
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
                            <a class="pjax" href="/admin/components/init_window/gallery/edit_category/{$category.id}" data-rel="tooltip" data-placement="top" data-original-title="{lang("Edit the category")}">{$category.name}</a>
                        </td>
                        <td>
                            {if $category.albums_count}
                                <a href="/admin/components/init_window/gallery/category/{$category.id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="{lang("View albums")}" >({lang("View albums")})</a>
                            {/if}
                            {$category.albums_count}
                        </td>
                        <td>{truncate(htmlspecialchars($category.description), 75)}</td>
                        <td>{date('Y-d-m H:i', $category.created)}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else:}
        <div class="alert alert-info m-t_20">
            {lang("Category list is empty")}
        </div>
    {/if}
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Delete category?")}</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel")}</a>
        <a href="" class="btn btn-primary" onclick="GalleryCategories.deleteCategoriesConfirm();$('.modal').modal('hide');">{lang("Delete")}</a>
    </div>
</div>