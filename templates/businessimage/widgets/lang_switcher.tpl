{if count($languages) > 0}
<ul class="b-langs g-clearfix">
	{foreach $languages as $lang}
	{$loc_page_url = "/" . $lang.identif . $current_address}
		<li class="b-langs__item g-left">
			{if $CI->config->config['cur_lang'] != $lang.id}
				<a class="b-langs__link" href="{$loc_page_url}">
			{/if}
			<span>{$lang.lang_name}</span>
			{if $CI->config->config['cur_lang'] != $lang.id}
				</a>
			{/if}
		</li>
	{/foreach}
</ul>
{/if}
