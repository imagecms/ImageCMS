<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">
                {lang('Categories columns', 'new_level')}:
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div class="inside_padd">
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
                                                            {if in_array($category->getId(), $columnCategories[$column])}
                                                                <option selected {if $category->getLevel() == 0}style="font-weight: bold;"{/if} {if in_array($category->getId(),$currentCategories)} selected {/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                                                            {else:}
                                                                <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} {if in_array($category->getId(),$currentCategories)} selected {/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
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