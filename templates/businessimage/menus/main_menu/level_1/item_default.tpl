{if $wrapper}
	{$loc_js_toggle = "js-double-tap";}
	{$loc_item_arrow = "b-submenu__item_arrow"}
{else:}
	{$loc_js_toggle = "";}
	{$loc_item_arrow = "";}
{/if}
<li class="b-submenu__item {$loc_js_toggle} {$loc_item_arrow}">
	<a class="b-submenu__link" href="{$link}" {$target}>{$title}</a>
	{$wrapper}
</li>