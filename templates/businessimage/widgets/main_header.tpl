<header class="b-header">
	
	<div class="b-header__line">
		<div class="g-container">
			<div class="g-row g-row_valign-mid">
				<div class="g-col-2 g-col-6_xs">

					<!-- Lang switcher widget -->
					{widget('lang_switcher')}

				</div>
				<div class="g-col-10 g-col-6_xs g-col_align-right">
					
					<!-- Site info -->
					{include_tpl('main_siteinfo')}

				</div>
			</div>
		</div>
	</div>

	<div class="b-header__main">
		<div class="g-container">
			<div class="g-row g-row_valign-mid">
				<div class="g-col-3 g-col-12_from-l">
					<div class="g-row">
							<div class="g-col-12 g-col-6_from-s">
								
								<!-- Logo -->
								{if siteinfo('siteinfo_logo') != ""}
								<div class="b-logo">
									<a class="b-logo__link" href="{site_url('')}">
										<img class="b-logo__img" src="{echo siteinfo('siteinfo_logo')}" alt="{$site_title}">
										</a>
								</div>
								{/if}

							</div>
							<div class="g-col-12 g-col-6_from-s g-col_align-right">
								
								<!-- Toggle-menu icon -->
								<div class="b-toggle-menu js fa fa-bars fa-2x"></div>

							</div>
					</div>
				</div>
				<div class="g-col-9 g-col-12_from-l">
					
					<!-- Main menu module -->
					{load_menu('main_menu')}

				</div>
			</div>
		</div>
	</div>

</header>