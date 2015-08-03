{if count($tags) > 0}
<div class="b-sidebar__section">
	<div class="g-section-s">
		<h4 class="g-section-s__title">
			{getWidgetTitle('page_tag_cloud')}
		</h4>
		<div class="g-section-s__item">
			<div class="b-tags">
				<div class="b-tags__list g-clearfix">
					{foreach $tags as $item}
						<a class="b-tags__item g-link" href="{site_url('tags/search/'.$item.value)}" >{$item.value} ({$item.count})</a>
					{/foreach}
				</div>
			</div>
		</div>
	</div>
</div>
{/if}
