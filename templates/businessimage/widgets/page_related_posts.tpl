{$related_pages = $pages}

{$loc_items_num = count($related_pages)}

{if $loc_items_num > 0}
	<!-- Dynamic Grid Cols | Max 3 cols -->
	{$loc_cols_num = round(12/$loc_items_num)}
	{$loc_cols_num = $loc_cols_num > 3 ? $loc_cols_num : 4;}
	<div class="g-section-m">
		<h2 class="g-section-m__title">
			{getWidgetTitle('page_related_posts')}
		</h2>
		
		<!-- Blog widget -->
		<div class="b-blog-w">
			<div class="g-row g-row_indent-30">
				{foreach $related_pages as $item}
				{$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
				<div class="g-col-{$loc_cols_num}">
					<article class="b-blog-w__item">
						{if trim($item.field_image) != ""}
						<div class="b-blog-w__image">
							<a href="{site_url($item['cat_url'].$item['url'])}"><img src="{$item.field_image}" alt="{$item.title}"></a>
						</div>
						{/if}
						<time class="b-blog-w__date" datetime="{date('Y-m-d', $item.publish_date)}">{locale_date('d F Y', $item.publish_date)}</time>
						<h3 class="b-blog-w__title">
							<a class="g-link" href="{site_url($item['cat_url'].$item['url'])}">{$item.title}</a>
						</h3>
						{if trim($item.prev_text) != ""}
						<div class="g-text g-text_sub">{$item.prev_text}</div>
						{/if}
					</article>
				</div>
				{/foreach}
			</div>
		</div>

	</div>
{/if}