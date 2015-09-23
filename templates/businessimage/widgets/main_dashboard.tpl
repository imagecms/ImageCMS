{$dashboardItems = $CI->load->module('banners')->getByGroup('dashboard')}
{$numOfColsClass = round(12/count($dashboardItems))}
{$numOfColsClass = $numOfColsClass >= 3 ? $numOfColsClass : 4;}
{if count($dashboardItems) > 0}
<div class="g-section-l">
	<div class="g-container">
		<div class="g-section-l__items">
		
			<!-- Dashboard -->
			<div class="b-dashboard">			
				<div class="g-row g-row_indent-30">
					{foreach $dashboardItems as $item}
						<div class="g-col-{$numOfColsClass} g-col-6_from-m g-col-12_from-s b-dashboard_ico-color">
							<article class="b-dashboard__item">
								<i class="b-dashboard__ico fa fa-2x {$item.photo}"></i>
								<div class="b-dashboard__info">
									<h2 class="b-dashboard__title">
										{if trim($item.url) != ""}
                                            <a class="b-dashboard__link" href="{site_url($item.url)}">{$item.name}</a>
										{else:}
										    {$item.name}
										{/if}
									</h2>
									<div class="g-text g-text_sub">{$item.description}</div>
								</div>
							</article>
						</div>
					{/foreach}
				</div>
			</div>
			
		</div>
	</div>
</div>
{/if}