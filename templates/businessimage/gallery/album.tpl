<div class="b-gallery">
	<div class="g-container">

		<div class="g-row">
			<div class="g-col-4 g-col-12_from-m">
				<h1 class="b-content__title">
					{$album.name}
				</h1>
			</div>
			<div class="g-col-8 g-col-12_from-m">
				<!-- Categories Navigation -->
				{include_tpl('../widgets/gallery_menu')}
			</div>
		</div>

		<div class="b-content__section">

			<!-- Category Description -->
			{if trim($album.description) != ""}
			<div class="b-gallery__description g-text">
				{$album.description}
			</div>
			{/if}


			<!-- Albums List -->
			{if count($album.images) > 0}
			<div class="g-row g-row_indent-30">
				{foreach $album.images as $item}
					{$item.loc_prev_url = $album_url .$item['file_name'] .'_prev' .$item['file_ext'];}
					{$item.loc_thumb_url = $album_url ."_thumbs/" .$item['full_name'];}
					{$item.loc_filter_desc = strip_tags(trim($item.description));}
					<div class="g-col-3">
						<div class="b-gallery__photo">
							<a class="b-gallery__photo-link js-fancybox" href="{media_url($item.loc_prev_url)}" title="{$item.loc_filter_desc}">
								<img class="b-gallery__photo-img" src="{media_url($item.loc_thumb_url)}" alt="{$item.loc_filter_desc}">
								<div class="b-gallery__zoom">
								<div class="b-gallery__zoom-wrap-outer">
									<div class="b-gallery__zoom-wrap-inner">
										<i class="fa fa-search-plus fa-lg"></i>
									</div>
								</div>
							</div>
							</a>
							{if strip_tags(trim($item.description)) != ""}
							<div class="b-gallery__photo-text g-text">
								{$item.description}
							</div>
							{/if}
						</div>
					</div>
				{/foreach}
			</div>

			{else:}
			<p class="b-gallery__noitems g-text">
				{tlang('There are no items to display. Please come back later!')}
			</p>
			{/if}

		</div>
	</div>
</div>
