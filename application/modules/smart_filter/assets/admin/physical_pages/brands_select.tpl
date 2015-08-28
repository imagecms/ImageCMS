<option value="0">--{lang('Select brand', 'smart_filter')}--</option>
<option value="all" style="display: none">{echo lang('All',"smart_filter")}</option>
{foreach $brands as $brand}
    <option value="{echo $brand['id']}" data-url="{echo $brand['url']}" data-name="{echo $brand['name']}">{echo $brand['name']}</option>
{/foreach}