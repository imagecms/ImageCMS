 <option value="">-- {lang('Choose template')} --</option>
{foreach $langs as $module_name}
    <option class="{echo $module_name['template']}">{echo $module_name['template']}</option>
{/foreach}