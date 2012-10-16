<section class="mini-layout" style="padding-top: 39px; ">
    <div class="frame_title clearfix" style="top: 179px; width: 1168px; ">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_categories')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a htef="#" class="btn btn-small disabled action_on" id="del_in_search" onclick="$('.modal').modal();" disabled="disabled"><i class="icon-trash"></i>Удалить</a>
                <a href="/admin/components/init_window/gallery/show_create_category" class="btn btn-small pjax btn-success"><i class="icon-plus-sign icon-white"></i>{lang('amt_create_cat')}</a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang('amt_create_album')}</a>
                <a href="#" class="btn btn-small pjax" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/settings'); return false;">{lang('amt_settings')}</a>
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
        <th></th>
        </thead>
        <tbody data-tree>
            {foreach $categories as $category}
            <tr>
                <td class="t-a_c">
                    <span class="frame_label">
                        <span class="niceCheck">
                            <input type="checkbox">
                        </span>
                    </span>
                </td>
                <td>{$category.id}</td>
                <td><a class="pjax" href="/admin/components/init_window/gallery/category/{$category.id}">{$category.name}</a></td>
                <td>{$category.albums_count}</td>
                <td>{truncate(htmlspecialchars($category.description), 75)}</td>
                <td>{date('Y-d-m H:i', $category.created)}</td>
                <td align="right">
                    <img src="{$THEME}/images/edit.png"  onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_category/{$category.id}');" style="cursor:pointer;" />
                    <img src="{$THEME}/images/delete.png"  onclick="confirm_delete_gcategory({$category.id});" style="cursor:pointer;" />
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>

    {literal}
    <!--    <script type="text/javascript">
            window.addEvent('domready', function(){
                cats_table = new sortableTable('cats_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                cats_table.altRow();
            });
    
            function confirm_delete_gcategory(id)
            {
                alertBox.confirm('<h1> </h1><p>Удалить категорию ' + id + '? </p>', {onComplete:
                        function(returnvalue){
                        if(returnvalue)
                        {
                            var req = new Request.HTML({
                                method: 'post',
                                url: base_url + 'admin/components/cp/gallery/delete_category',
                                onRequest: function() { },
                                onComplete: function(response) {  
                                    ajax_div('page', base_url + 'admin/components/cp/gallery/');   
                                }
                            }).post({'category': id });
                        }
                    }
                });
            }
    
        </script>-->
    {/literal}

    {/if}
</section>
<div class="modal hide fade products_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('a_category_delete')}</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang('a_footer_cancel')}</a>
        <a href="" class="btn btn-primary" onclick="GalleryCategories.deleteCategories();$('.modal').modal('hide');">{lang('a_delete')}</a>
    </div>
</div>