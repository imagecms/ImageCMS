{if count($comments) > 0}
<div class="b-sidebar__section">
	<div class="b-comment-w g-section-s">
		<h4 class="b-comment-w__title g-section-s__title">
			{getWidgetTitle('latest_comments')}
		</h4>
		<div class="g-section-s__item">
			{foreach $comments as $item}
			<div class="b-comment-w__item-text">
				<a href="{site_url($item.url)}#comment_{$item.id}" class="b-comment-w__item-text-link g-link">{strip_tags(trim($item.text))}</a>
			</div>
			
			<div class="b-comment-w__item-addinfo">
				<!-- BLOCK b-addinfo BEGIN -->
				<div class="b-addinfo">
					<div class="b-addinfo__list g-clearfix">
						<div class="b-addinfo__item">
							<i class="b-addinfo__item-icon fa fa-user" title="{tlang('Posted by')}"></i>
							<span class="b-addinfo__item-text">{$item.user_name}</span>
						</div>
						<div class="b-addinfo__item">
							<i class="b-addinfo__item-icon fa fa-clock-o" title="{tlang('Publication Date')}"></i>
							<time class="b-addinfo__item-text" datetime="{date('Y-m-d', $item.date)}">{date("d.m.y", $item.date)}</time>
						</div>
					</div>				
				</div>
				<!-- BLOCK b-addinfo END -->
			</div>
			{/foreach}
		</div>
	</div>
</div>
{/if}