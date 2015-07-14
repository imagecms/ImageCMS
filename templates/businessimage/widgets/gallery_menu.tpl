{if count($gallery_category) > 1}
	<nav class="b-gallery__menu">
		<ul class="g-clearfix">
			<li class="b-gallery__menu-item">
				{if $current_category.id}
					<a class="b-gallery__menu-link g-link" href="{site_url('gallery')}">{tlang('All categories')}</a>
				{else:}
					<span class="b-gallery__menu-link mod-active">{tlang('All categories')}</span>
				{/if}
			</li>
			
			{foreach $gallery_category as $item}
			<li class="b-gallery__menu-item">
				{if $current_category.id != $item.id}
					<a class="b-gallery__menu-link g-link" href="{site_url('gallery/category/'.$item.id)}">{$item.name}</a>
				{else:}
					<span class="b-gallery__menu-link mod-active">{$item.name}</span>
				{/if}
			</li>
			{/foreach}
		</ul>
	</nav>
{/if}