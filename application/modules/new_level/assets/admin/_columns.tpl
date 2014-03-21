<table class="table table-striped table-bordered table-hover table-condensed t-l_a">
    <thead>
        <tr>
            <th colspan="6">
                {lang('Categories menu', 'new_level')}:
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div class="inside_padd span9">
                    <div class="row-fluid">
                        <div class="span3">
                            <table class="table-columns">
                                <tr>
                                    {foreach $columns as $column}
                                        <td class="span5">
                                            <div class="control-group">
                                                <label class="control-label" for="iddCategory"><b class="columnName">{lang('Column', 'new_level')} {echo $column}:</b></label>
                                                <div class="controls ">
                                                    <select  id="ajaxSaveShopCategories" name="Categories[]" multiple="multiple" style="height:250px !important;">
                                                        {foreach $categories as $category}
                                                            {if in_array($category.id, $columnCategories[$column])}
                                                                <option selected {if count($category.full_path_ids) == 0}style="font-weight: bold;"{/if} {if in_array($category.id,$currentCategories)} selected {/if} value="{echo $category.id}">{str_repeat('-',count($category.full_path_ids))} {echo ShopCore::encode($category['name'])}</option>
                                                            {else:}
                                                                <option {if count($category.full_path_ids) == 0}style="font-weight: bold;"{/if} {if in_array($category.id,$currentCategories)} selected {/if} value="{echo $category.id}">{str_repeat('-',count($category.full_path_ids))} {echo ShopCore::encode($category.name)}</option>
                                                            {/if}
                                                        {/foreach}
                                                    </select>
                                                    <button type="button" data-column="{echo $column}" class="btn btn-small btn-primary btn-success cattegoryColumnSaveButtonMod"><i class="icon-ok icon-white"></i>{lang('Save', 'new_level')}</button>
                                                </div>
                                            </div>   
                                        </td>
                                    {/foreach}
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>