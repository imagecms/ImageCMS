{$loc_main_partners_list = getBanner('partners', 'object')}
{if count($loc_main_partners_list) > 0}
<div class="g-section-l">
	<div class="g-container">
		<h2 class="g-section-l__title">
			{echo $loc_main_partners_list->getName()}
		</h2>

		<div class="b-partner-w js">
		{foreach $loc_main_partners_list->getBannerImages() as $item}
			{$loc_url_target = $item->getTarget() == 1 ? "target=\"_blank\"" : ""}
			<div class="b-partner-w__item js">
				{if $item->getUrl()}
				<a href="{echo $item->getUrl()}" {$loc_url_target}><img src="{echo $item->getImageOriginPath()}" alt="{echo $item->getName()}"></a>
				{else:}
				<img src="{echo $item->getImageOriginPath()}" alt="{echo $item->getName()}}">
				{/if}
			</div>
			{/foreach}
		</div>

	</div>
</div>
{/if}
