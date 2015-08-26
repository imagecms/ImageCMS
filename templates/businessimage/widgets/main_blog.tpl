{$loc_items_num = count($recent_news)}

{if $loc_items_num > 0}

<!-- Dynamic Grid Cols | Max 4 cols -->
{$loc_cols_num = round(12/$loc_items_num)}
{$loc_cols_num = $loc_cols_num > 3 ? $loc_cols_num : 3;}

<!-- URL to Widget First Category | Used to Make Link to All Items Page -->
{$loc_cat_url = str_replace(strrchr($recent_news[0]['full_url'], "/"), "", $recent_news[0]['full_url'])}

<section class="g-section-l g-section-l_bg">
	<div class="g-container">
		<h2 class="g-section-l__title">
			<a class="g-section-l__title-url" href="{site_url($loc_cat_url)}">{getWidgetTitle('main_blog')}</a>
		</h2>
		<div class="g-section-l__items">
			
			<!-- Blog widget -->
			<div class="b-blog-w">
				<div class="g-row g-row_indent-30">
					{foreach $recent_news as $item}
					{$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
					<div class="g-col-{$loc_cols_num}">
						<article class="b-blog-w__item">
							{if trim($item.field_image) != ""}
							<div class="b-blog-w__image">
								<a href="{site_url($item.full_url)}"><img src="{$item.field_image}" alt="{$item.title}"></a>
							</div>
							{/if}
							<time class="b-blog-w__date" datetime="{date('Y-m-d', $item.publish_date)}">{locale_date('d F Y', $item.publish_date)}</time>
							<h3 class="b-blog-w__title">
								<a class="g-link" href="{site_url($item.full_url)}">{$item.title}</a>
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
	</div>
</section>
{/if}