<option value="0">--{lang('Select property', 'smart_filter')}--</option>
<option value="all" style="display: none">{echo lang('All',"smart_filter")}</option>
{foreach $properties as $property}
    <option value="{echo $property['property_id']}" data-url="{echo $property['csv_name']}" data-name="{echo $property['name']}">{echo $property['name']}</option>
{/foreach}