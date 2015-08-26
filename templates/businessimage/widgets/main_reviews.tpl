{$loc_items_num = count($recent_news)}
{if $loc_items_num > 0}
<section class="g-section-l">
	<div class="g-container">
		<h2 class="g-section-l__title">
			{getWidgetTitle('main_reviews')}
		</h2>   
		<div class="g-section-l__item g-section-l_shrink">
			
			<!-- Latest reviews -->
			<div class="b-review-w js">
				{foreach $recent_news as $item}
				<!-- Pushing Additional Fields -->
				{$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
				<article class="b-review-w__item js">
					{if trim($item.field_image) != ""}
					<div class="b-review-w__photo">
						<img class="b-review-w__img" src="{$item.field_image}" alt="{$item.title}">
					</div>
					{/if}
					{if trim($item.prev_text) != ""}
					<div class="b-review-w__desc">
						<div class="g-text g-text_sub">{$item.prev_text}</div>
					</div>
					{/if}
					<h3 class="b-review-w__name">
						{$item.title}
						{if trim($item.field_url) != ""}
						<a class="b-review-w__url g-link" href="http://{str_replace('http://', '', $item.field_url)}" target="_blank">{$item.field_url}</a>
						{/if}
					</h3>
				</article>
				{/foreach}
			</div>

		</div>
	</div>
</section>
{/if}