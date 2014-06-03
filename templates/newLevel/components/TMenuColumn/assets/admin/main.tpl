{$categories = \ShopCore::app()->SCategoryTree->getTree();}
<form method="post" action="{site_url('admin/components/init_window/template_manager/updateComponent')}/{echo $handler}" id="component_{echo $handler}_form">
    <input type="hidden" name="handler" value="{echo $handler}">

    <table class="frame-level-menu frame_level table table-bordered table-condensed products_table">
        <thead>
            <tr>
                <td>{lang('Category', 'newLevel')}</td>
                <td class="span2" style="padding-left: 5px;text-align: center;">{lang('Show in column', 'newLevel')}</td>
            </tr>
        </thead>
        <tbody>
        <select name="openLevels">
            <option {if $openLevels == 'all'}selected="selected"{/if}value="all">{lang('Open all levels', 'newLevel')}</option>
            <option {if $openLevels == '2'}selected="selected"{/if} value="2">{lang('Open second level', 'newLevel')}</option>
        </select>

        {foreach $categoriesT as $key => $category}
            {$children = $category['children'];}
            {$category = $category['category'];}
            <tr>
                <td>
                    <div class="title lev">
                        {if $children}
                            <button type="button" class="btn btn-small my_btn_s" data-rel="tooltip" data-placement="top" data-original-title="{lang('Toggle this category', 'newLevel')}" style="display: none;" onclick="hideSubCategory(this)">
                                <i class="my_icon icon-minus"></i>
                            </button>
                            <button type="button" class="btn btn-small my_btn_s btn-primary" data-rel="tooltip" data-placement="top" data-original-title="{lang('Expand Category', 'newLevel')}" onclick="showSubCategory(this)">
                                <i class="my_icon icon-plus"></i>
                            </button>
                        {/if}
                        <a href="/admin/components/run/shop/categories/edit/{echo $category->id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="{lang('Editing category', 'newLevel')}">
                            {echo $category->name}
                        </a>
                    </div>
                </td>
                <td></td>
            </tr>
            {if $children}
                <tr class="frame_level">
                    <td colspan="2">
                        <table>
                            <tbody>
                                {foreach $children as $child}
                                    {$children = $child['children'];}
                                    {$category = $child['category'];}
                                    <tr>
                                        <td>
                                            <div class="title lev">
                                                {if $children}
                                                    <button type="button" class="btn btn-small my_btn_s" data-rel="tooltip" data-placement="top" data-original-title="{lang('Toggle this category', 'newLevel')}" style="display: none;" onclick="hideSubCategory(this)">
                                                        <i class="my_icon icon-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-small my_btn_s btn-primary" data-rel="tooltip" data-placement="top" data-original-title="{lang('Expand Category', 'newLevel')}" onclick="showSubCategory(this)">
                                                        <i class="my_icon icon-plus"></i>
                                                    </button>
                                                {/if}
                                                <a href="/admin/components/run/shop/categories/edit/{echo $category->id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="{lang('Editing category', 'newLevel')}">
                                                    {echo $category->name}
                                                </a>
                                            </div>
                                        </td>
                                        {$dis = false}
                                        {if $openLevels == '2'}
                                            {$dis = true}
                                        {/if}
                                        <td class="span2 t-a_c frame-level-2-select" style="padding-left: 0;">{echo $template->getComponent('TMenuColumn')->select_column_menu($category->id, $dis)}</td>
                                    </tr>
                                    {if $children}
                                        <tr class="frame_level">
                                            <td colspan="2">
                                                <table>
                                                    <tbody>
                                                        {foreach $children as $category}
                                                            <tr>
                                                                <td>
                                                                    <div class="title lev">
                                                                        <a href="/admin/components/run/shop/categories/edit/{echo $category->id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="{lang('Editing category', 'newLevel')}">
                                                                            {echo $category->name}
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td class="span2 t-a_c" style="padding-left: 0;">{echo $template->getComponent('TMenuColumn')->select_column_menu($category->id)}</td>
                                                            </tr>
                                                        {/foreach}
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    {/if}
                                {/foreach}
                            </tbody>
                        </table>
                    </td>
                </tr>
            {/if}
        {/foreach}
        </tbody>
    </table>
    {form_csrf()}
</form>
<button type="button" class="btn btn-small action_on formSubmit btn-primary cattegoryColumnSaveButtonMod" data-form="#component_{echo $handler}_form" data-action="close">
    <i class="icon-ok icon-white"></i>{lang('Save', 'newLevel')}
</button>
{literal}
    <script>
        function showSubCategory(el) {
            $(el).hide().prev().show().end().closest('tr').next().show();
        }
        function hideSubCategory(el) {
            $(el).hide().next().show().end().closest('tr').next().hide();
        }
    </script>
{/literal}