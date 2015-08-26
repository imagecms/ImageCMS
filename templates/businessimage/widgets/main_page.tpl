{if trim($page.prev_text) != ""}
<div class="g-section-l g-section-l_bg">
	<div class="g-section-l__item">
		
		<!-- Hometext -->
		<div class="b-hometext">
			<div class="g-container">
				<div class="g-row g-row_indent-30 g-row_valign-mid">
					<div class="g-col-6 g-col-12_from-s">
						<h1 class="b-hometext__title">
							{$page.title}
						</h1>
						<div class="g-text g-text_sub">
							{$page.prev_text}
						</div>
						{if trim($page.full_text) != "" && $page.full_text != $page.prev_text}
						<div class="b-hometext__btn">
							<a class="g-btn_l" href="{site_url($page.cat_url . $page.url)}">{tlang('Read more')}</a>
						</div>
						{/if}
					</div>
					{if trim($page.field_image) != ""}
					<div class="g-col-6 g-col-12_from-s g-col_align-right">
						<img class="b-hometext__image" src="{$page.field_image}" alt="{$page.title}">
					</div>
					{/if}
				</div>
			</div>
		</div>
	</div>

</div>
{/if}