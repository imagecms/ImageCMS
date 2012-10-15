<section class="mini-layout" style="padding-top: 39px; ">
    <div class="frame_title clearfix" style="top: 179px; width: 1168px; ">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_categories')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="#" class="btn btn-small pjax btn-success" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/show_create_category'); return false;"><i class="icon-plus-sign icon-white"></i>{lang('amt_create_cat')}</a>
                <a href="#" class="btn btn-small pjax btn-success" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/show_crate_album'); return false;"><i class="icon-plus-sign icon-white"></i>{lang('amt_create_album')}</a>
                <a href="#" class="btn btn-small pjax" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/settings'); return false;">{lang('amt_settings')}</a>
            </div>
        </div>
    </div>
</section>
<div style="clear:both"></div> 
{if $categories}
<div id="sortable" >
    <table id="cats_table">
        <thead>
        <th width="5px"></th>
        <th width="5px;">{lang('amt_id')}</th>
        <th axis="string">{lang('amt_name')}</th>
        <th axis="string">{lang('amt_albums')}</th>
        <th axis="string">{lang('amt_description')}</th>
        <th axis="date">{lang('amt_crea')}</th>
        <th></th>
        </thead>
        <tbody>
            {foreach $categories as $category}
            <tr>
                <td></td>
                <td>{$category.id}</td>
                <td onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/{$category.id}'); return false;">{$category.name}</td>
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
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

{literal}
<script type="text/javascript">
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

</script>
{/literal}

{/if}
