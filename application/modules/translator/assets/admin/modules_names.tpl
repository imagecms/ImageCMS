 <option value="">-- {lang('Choose module', 'translator')} --</option>
{foreach $langs as $module_name}
    <option class="{echo $module_name['module']}">{echo $module_name['module']}</option>
{/foreach}