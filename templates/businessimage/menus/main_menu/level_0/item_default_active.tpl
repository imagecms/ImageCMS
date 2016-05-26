{if $wrapper}
	{$loc_js_toggle = "js-double-tap";}
	{$loc_item_arrow = "b-menu__item_arrow"}
{else:}
	{$loc_js_toggle = "";}
	{$loc_item_arrow = "";}
{/if}
<li class="b-menu__item b-menu__item_active {$loc_js_toggle} {$loc_item_arrow}">
	<a class="b-menu__link" href="{$link}" {$target}>{$title}</a>
	{$wrapper}
</li>