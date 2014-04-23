{$categories = \ShopCore::app()->SCategoryTree->getTree();}
{$countColumn = 7}
<form method="post" action="{site_url('admin/components/init_window/template_manager/updateComponent')}/{echo $handler}" id="component_{echo $handler}_form"> 
    <input type="hidden" name="handler" value="{echo $handler}">
    <table class="table-columns">
        <tr>
            {foreach $columns as $colon}
                <td class="span4">
                    <div class="control-group">
                        <label class="control-label"><b class="columnName">{lang('Column', 'newLevel_TM')} {echo $colon}:</b></label>
                        <div class="controls ">
                            <select  class="ColumnsSelect" name="columns[{echo $colon}][]" multiple="multiple" style="height:400px !important;">
                                {foreach $categories as $key => $category}
                                    {if $columns_db[$colon] && in_array($category['id'], $columns_db[$colon])}
                                        {$selected = "selected='selected'";}
                                    {/if}
                                    <option {echo $selected} {if count($category['full_path_ids']) == 0}style="font-weight:bold"{/if} value="{echo $category['id']}">{echo str_repeat("-", count($category['full_path_ids']))}{echo $category['name']}</option>
                                    {$selected = "''";}
                                {/foreach}
                            </select>
                        </div>
                    </div>   
                </td>
            {/foreach}
        </tr>
    </table>
    {var_dump($columns)}
    {var_dump($columns_db)}
    {//echo $template->getComponent('TMenuColumn')->select_column_menu()}
    <table class="frame_level table table-striped table-bordered table-hover table-condensed products_table">
        {foreach $categories as $key => $category}
            {if $category->parent_id == 0}
                {$arrId[$category->id] = $category->id}
                {$arrName[$category->id] = $category->name}
            {/if}
        {/foreach}
        {$select = '<select class="input-mini">'}
        {for $i = 0; $i <= $countColumn; $i++}
            {$select .= "<option value='" . $i . "'>" . $i . "</option>"}
        {/for}
        {$select.='</select>'}
        {foreach $arrId as $id}
            {$arrHtml[$id] = ''}
            {foreach $categories as $key => $cat}
                {if $cat->parent_id == $id}
                    {$arrHtml[$id] .= '<tr><td><div class="title lev"><a href="/admin/components/run/shop/categories/edit/' . $cat->id . '" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="' . lang("Edit of category", "newLevel_TM") . '">' . $cat->name . '</a></div></td><td class="span3 t-a_c">' . $select . '</td></tr>'}
                {/if}
            {/foreach}
        {/foreach}
        <thead>
            <tr>
                <td>{lang('Category', 'newLevel_TM')}</td>
                <td class="span3">{lang('Show in column', 'newLevel_TM')}</td>
            </tr>
        </thead>
        <tbody>
            {foreach $categories as $key => $category}
                {if $category->id && in_array($category->id, $arrId)}
                    <tr>
                        <td>
                            <div class="title lev">
                                {if $arrHtml[$category->id]}
                                    <button type="button" class="btn btn-small my_btn_s" data-rel="tooltip" data-placement="top" data-original-title="{lang('Toggle this category', 'newLevel_TM')}" style="display: none;" onclick="hideSubCategory(this)">
                                        <i class="my_icon icon-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-small my_btn_s btn-primary" data-rel="tooltip" data-placement="top" data-original-title="{lang('Expand Category', 'newLevel_TM')}" onclick="showSubCategory(this)">
                                        <i class="my_icon icon-plus"></i>
                                    </button>
                                {/if}
                                <a href="/admin/components/run/shop/categories/edit/{$category->id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="{lang('Editing category', 'newLevel_TM')}">{echo $arrName[$category->id]}</a>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    {if $arrHtml[$category->id]}
                        <tr class="frame_level">
                            <td colspan="2">
                                <table>
                                    <tbody>
                                        {echo $arrHtml[$category->id]}
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    {/if}
                {/if}
            {/foreach}
        </tbody>
    </table>
    {form_csrf()}
</form>
<button type="button" class="btn btn-small action_on formSubmit btn-primary cattegoryColumnSaveButtonMod" data-form="#component_{echo $handler}_form" data-action="close">
    <i class="icon-ok icon-white"></i>{lang('Save', 'newLevel_TM')}
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