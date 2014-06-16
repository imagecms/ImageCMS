<option value="">-- {lang('Choose module', 'translator')} --</option>
{foreach $langs as $module_name}
    <option class="{echo $module_name['module']}" value="{echo $module_name['module']}">{if $module_name['menu_name']}{echo substr($module_name['menu_name'], 0, 70)}{if mb_strlen($module_name['menu_name']) > 70}...{/if}{else:}{echo $module_name['module']}{/if}</option>
{/foreach}