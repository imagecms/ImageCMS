{$loc_main_banner_list = getBanner('main_banner', 'object')}
{if count($loc_main_banner_list) > 0}
<div class="b-banner-main js no-js">
	{foreach $loc_main_banner_list->getBannerImages() as $item}
		{$loc_url_target = $item->getTarget() == 1 ? "target=\"_blank\"" : ""}
		<div class="b-banner-main__item">
			<img class="b-banner-main__image" src="{echo $item->getImageOriginPath()}" alt="{echo $item->getName()}">
			<div class="g-container">
				<div class="b-banner-main__info g-container">
					<div class="b-banner-main__info-helper">
						<div class="b-banner-main__info-helper-2">
							<div class="b-banner-main__title">
								{echo $item->getName()}
							</div>
							{if $item->getDescription()}
							<div class="b-banner-main__text g-text">
								{echo $item->getDescription()}
							</div>
							{/if}
							{if $item->getUrl()}
							<a class="b-banner-main__button g-btn_l" {$loc_url_target} {if $item->getStatisticUrl()}href="{echo $item->getStatisticUrl()}"{/if}">{tlang('Read more')}</a>
							{/if}
						</div>
					</div>
				</div>
			</div>
		</div>
	{/foreach}
</div>
{/if}