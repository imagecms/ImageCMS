<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">
                {lang('The news for products category', 'shop_news')}
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div class="inside_padd">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label" for="iddCategory">{lang('Show in categories', 'shop_news')}:</label>
                                <div class="controls">
                                    <form  type="post">
                                        <select id="ajaxSaveShopCategories" name="Categories[]" multiple="multiple" style="height:200px !important;">
                                            {foreach $categories as $category}
                                                <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} {if in_array($category->getId(),$currentCategories)} selected {/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                                            {/foreach}
                                        </select>
                                        <input type="hidden" name="contentId" value="{echo $shopNews['pageId']}" id="contentId"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="control-group">
                            <div class="controls">
                                <button type="button" class="btn btn-small btn-primary btn-success" id="saveShopNewsCategories"><i class="icon-ok icon-white"></i>{lang('Save', 'shop_news')}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>