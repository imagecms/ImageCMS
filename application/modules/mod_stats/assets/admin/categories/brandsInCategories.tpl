<div class="span7">
    <select id="selectCategoryId">
        {foreach $data as $category}
            <option 
                {if $category->getLevel() == 0}style="font-weight: bold;"{/if} 
                value="{echo $category->getId()}" 
                {if $_COOKIE['cat_id_for_stats'] == $category->getId()}selected=selected{/if}
                >
                    {str_repeat('-',$category->getLevel())}{echo ShopCore::encode($category->getName())}
            </option>
{/foreach}
</select>
</div>
<div class="span2">
    <div class="d-i_b">
        <select id="selectChartType">
            <option value="pieChart">{lang('pie', 'mod_stats')}   </option>
            <option value="barChart">{lang('bar', 'mod_stats')}   </option>
        </select>
    </div>
</div>
<div id="pieChart" class="hideChart">
    <svg style="height: 500px;"></svg>
</div>
<div id="barChart" class="hideChart span12" style="display: none;">
    <svg style="height: 500px; width: 800px;"></svg>
</div>

