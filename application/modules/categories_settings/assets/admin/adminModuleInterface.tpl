<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">
                Дополнительные настройки:
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div class="inside_padd">
                    <div class="row-fluid">
                        <div class="span3">
                            {foreach $columns as $column}
                                <div class="control-group">
                                    <label class="control-label" for="iddCategory">Колонка {echo $column}:</label>
                                    <div class="controls ">
                                        <select  id="ajaxSaveShopCategories" name="Categories[]" multiple="multiple" style="height:100px !important;">
                                            {foreach $categories as $category}
                                                {if in_array($category->getId(), $columnCategories[$column])}
                                                    <option selected {if $category->getLevel() == 0}style="font-weight: bold;"{/if} {if in_array($category->getId(),$currentCategories)} selected {/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                                                {else:}
                                                    <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} {if in_array($category->getId(),$currentCategories)} selected {/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                        <button type="button" data-column="{echo $column}" class="btn btn-small btn-primary btn-success cattegoryColumnSaveButtonMod"><i class="icon-ok icon-white"></i>Сохранить</button>
                                    </div>
                                </div>                               
                            {/foreach}
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>