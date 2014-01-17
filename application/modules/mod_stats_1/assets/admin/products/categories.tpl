<div>
    <a id="selectCategoryHideShow">
        {lang('Select categories', 'mod_stats')}
    </a>
    <div id="categoriesMultiSelectBlock" style="display: none;">
        <div class="control-group">
            <div class="controls" >
                <select multiple="multiple" id="selectCategoriesIds" style="height: 150px !important;">
                    {foreach $data['categoryTree'] as $category}
                        {$selected=""}
                        {if in_array($category->getId(), $productCategories) && $category->getId() != $model->getCategoryId()}
                            {$selected="selected='selected'"}
                        {/if}
                        <option {if $category->getLevel() == 0}
                            style="font-weight: bold;"{/if} 
                            {$selected} 
                            value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}
                        </option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="span2" style="float: right;"> 
            <a class="btn btn-small" id="withSelectedCategoriesDrawChartButton">
                <i class="icon-share-alt">
                </i>
                {lang('Show','mod_stats')}
            </a>
        </div>
        <br/>
        <hr/>
    </div>
</div>
<div class="m-t_20">
    <div class="d-i_b">
        <select id="selectChartType">
            <option value="pieChart">{lang('pie', 'mod_stats')}</option>
            <option value="barChart">{lang('bar', 'mod_stats')}</option>
        </select>
    </div>
    <div id="pieChart" class="hideChart">
        <svg style="height: 500px;"></svg>
    </div>
    <div id="barChart" class="hideChart span12" style="display: none;">
        <svg style="height: 500px; width: 800px;"></svg>
    </div>
</div>