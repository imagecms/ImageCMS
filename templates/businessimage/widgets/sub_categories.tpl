{$loc_sub_cats = get_sub_categories($category.id)}

{if count($loc_sub_cats) > 0}
<div class="b-sidebar__section">
	<nav class="b-subcats g-section-s">
		<h4 class="g-section-s__title">
			{tlang('Categories')}
		</h4>
		<div class="g-section-s__item">
			<ul class="b-subcats__list">
			{foreach $loc_sub_cats as $item}
				<li class="b-subcats__item">
					<a href="{site_url($item.path_url)}" class="b-subcats__item-link g-link">{$item.name}</a>
				</li>
			{/foreach}
			</ul>
		</div>
	</nav>
</div>
{/if}