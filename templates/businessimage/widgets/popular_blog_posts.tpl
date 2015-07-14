{if count($recent_news) > 0}
<div class="b-sidebar__section">
	<div class="b-blog-popular-w g-section-s">
		<h4 class="b-blog-popular-w__title g-section-s__title">
			{getWidgetTitle('popular_blog_posts')}
		</h4>
		<div class="g-section-s__item">
			{foreach $recent_news as $item}		
			<div class="b-blog-popular-w__item-title">
				<a href="{site_url($item.full_url)}" class="g-link">{$item.title}</a>
			</div>
			<div class="b-blog-popular-w__item-addinfo">
					
				<!-- BLOCK b-addinfo BEGIN -->
				<div class="b-addinfo">
					<div class="b-addinfo__list g-clearfix">	
						<div class="b-addinfo__item">
							<i class="b-addinfo__item-icon fa fa-eye" title="{tlang('Number of views')}"></i>
							<span class="b-addinfo__item-text">{$item.showed}</span>
						</div>
						<div class="b-addinfo__item">
							<i class="b-addinfo__item-icon fa fa-clock-o" title="{tlang('Publication Date')}"></i>
							<time class="b-addinfo__item-text" datetime="{date('Y-m-d', $item.publish_date)}">{date('d.m.y', $item.publish_date)}</time>
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