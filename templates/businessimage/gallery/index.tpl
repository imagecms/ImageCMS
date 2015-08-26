<!-- Category or Gallery H1 Title -->
{$loc_main_title = $current_category.id ? $current_category.name : tlang('Gallery')}


<div class="b-gallery">
	<div class="g-container">

		<div class="g-row">
			<div class="g-col-4 g-col-12_from-m">
				<h1 class="b-content__title">
					{$loc_main_title}
				</h1>
			</div>
			<div class="g-col-8 g-col-12_from-m">
				<!-- Categories Navigation -->
				{include_tpl('../widgets/gallery_menu')}
			</div>
		</div>
	
		<div class="b-content__section">
			
			<!-- Category Description -->
			{if trim($current_category.description) != ""}
			<div class="b-gallery__description g-text">
				{$current_category.description}
			</div>
			{/if}

			<!-- Albums List -->
			{if count($albums) > 0}
			<div class="g-row g-row_indent-20">
				{foreach $albums as $item}
					{if $item.count > 0}
					{$loc_cover_url = "uploads/gallery/" .$item.id ."/" .$item.cover_name ."_prev".$item.cover_ext}
					<div class="g-col-4">
						<div class="b-gallery__category-album">
							{if $item['cover_name']}
							<a class="b-gallery__category-album-image" href="{site_url('gallery/album/'.$item['id'])}">
								<img class="b-gallery__category-album-img" src="{media_url($loc_cover_url)}" alt="{$item.name}">
							</a>
							{/if}
							<h2 class="b-gallery__category-album-title">
								<a class="g-link" href="{site_url('gallery/album/'.$item['id'])}">{$item.name}</a>
							</h2>
							{if strip_tags(trim($item.description)) != ""}
							<div class="b-gallery__category-album-text g-text_sub">
								{$item.description}
							</div>
							{/if}
						</div>
					</div>
					{/if}
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