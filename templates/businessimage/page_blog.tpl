<!-- Including tags module to the page -->
{$tags = page_tags($page.id)}

<!-- Including social networks share module to the page -->
{$social = $CI->load->module('share')->_make_share_form();}

<div class="g-container">
	<h1 class="b-content__title">
		{$page.title}
	</h1>
	<div class="g-row g-row_indent-20">
		<div class="g-col-9 g-col-12_from-m">
			<div class="b-content__section g-text">
				{$page.full_text}
			</div>
			<div class="b-content__addinfo">
				{include_tpl('widgets/page_add_info')}
			</div>
					
			{if $tags || $social}
			<div class="b-content__bloginfo">
				<div class="g-row">
					<div class="g-col-7 g-col-12_from-s">
						{if $tags}
						<div class="b-content__bloginfo-section b-content__bloginfo_left">
							<div class="b-content__bloginfo-title">
								{tlang('Tags')}
							</div>
							<div class="b-content__bloginfo-list">
								<div class="b-tags">
									{foreach $tags as $item}
									<a class="b-tags__item g-link" href="{site_url('tags/search/'.$item.value)}" >{$item.value}</a>
									{/foreach}
								</div>
							</div>
						</div>
						{/if}
					</div>
					<div class="g-col-5 g-col-12_from-s">
						<div class="b-content__bloginfo-section b-content__bloginfo_right">
							<div class="b-content__bloginfo-title">
								{tlang('Share')}
							</div>
							<div class="b-content__bloginfo-list">
								{$social}
							</div>
						</div>
					</div>
				</div>
			</div>
			{/if}

			{if $page.comments_status == 1}
				{$Comments = $CI->load->module('comments')->show()}
			{/if}

			{widget('page_related_posts')}

		</div>
		<aside class="g-col-3 g-col-12_from-m">
			<div class="b-sidebar">
				{include_tpl('widgets/search_blog')}
					
				{widget('popular_blog_posts')}
					
				{widget('page_tag_cloud')}
					
				{widget('latest_comments')}
			</div>
		</aside>
	</div>
</div>