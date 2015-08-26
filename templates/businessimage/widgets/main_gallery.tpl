{$loc_items_num = count($images)}
{if $loc_items_num > 0}
<section class="g-section-l">
	<h2 class="g-section-l__title">
		{getWidgetTitle('main_gallery')}
	</h2>
	
	<!-- Gallery widget -->
	<div class="b-gallery-w js">
		{foreach $images as $item}
			<div class="b-gallery-w__item">
				<a class="js-fancybox" href="{$item.file_path}" title="{strip_tags(trim($item.description))}">
					<img class="b-gallery-w__image" src="{$item.thumb_path}" alt="{strip_tags(trim($item.description))}">
						<div class="b-gallery-w__zoom">
							<div class="b-gallery-w__zoom-wrap-outer">
								<div class="b-gallery-w__zoom-wrap-inner">
									<i class="fa fa-search-plus fa-lg"></i>
								</div>
							</div>
						</div>
				</a>
			</div>
			{/foreach}
	</div>
</section>
{/if}