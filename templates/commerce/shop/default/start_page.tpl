{# Variables
# @var hits
# @var newest
#}

<script type="text/javascript" src="{$SHOP_THEME}js/start_page.js"></script>

{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">
	{$banners = ShopBanersQuery::create()->joinWithI18n(ShopController::getCurrentLocale())->orderByPosition()->find()}
	{if count($banners)}
	<!-- BEGIN SLIDESHOW -->
	<div id="slideshow">
			<ul id="slides" style="width: 693px; height: 260px;">
				{foreach $banners as $banner}
					<li>
						<a href="{echo $banner->getUrl()}"><img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="" height="256"></a>
						<span class="slide_caption">
							<a href="{echo $banner->getUrl()}" class="title">{echo ShopCore::encode($banner->getName())}</a>{echo ShopCore::encode($banner->getText())}
						</span>
					</li>
				{/foreach}
			</ul>
			<div id="slideshow_violator" class="clearfix">
			  <div id="project_caption"></div>
			  <div id="slide_navigation" class="clearfix"></div>
			</div>
	</div>
	<!-- END SLIDESHOW -->
	{/if}

	<!--
	<div align="center" style="padding-bottom: 38px;">
		<div id="mycarousel" class="jcarousel-skin-ie7">
			<ul>

			</ul>
		</div>
	</div>
	-->

	<!-- BEGIN HITS -->
	<div id="titleExt">
		<h5 class="left">Хиты</h5>
		<div class="sp"></div>
	</div>
	<br/>
	<ul class="products">
	{$count = 1}
	{foreach $hits as $p}
		<li {if $count == 3} class="last" {$count = 0}{/if}>
			<div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
				<a href="{shop_url('product/' . $p->getUrl())}">
					<img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="{echo encode($p->getName())}" />
				</a>
			</div>
			<h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
			<div class="price" {if $p->firstVariant->getStock() == 0}style="color:silver;"{/if}>
				{$p->firstVariant}
				{if $p->hasDiscounts()}
					<s>{echo $p->firstVariant->toCurrency('origPrice')} {$CS}</s>
					<br/>
					<span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
				{else:}
					<span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
				{/if}
			</div>
			<div class="compare"><a href="{shop_url('compare/add/' . $p->getId())}">Сравнить</a></div>
		</li>
			{if $count == 3}<li class="separator"></li> {$count=0}{/if}
			{$count++}
	{/foreach}
	</ul>
	<!-- END HITS -->

	<div style="clear:both;"></div>

	<!-- BEGIN NEW -->
	<div id="titleExt">
		<h5 class="left">Новые</h5>
		<div class="sp"></div>
	</div>
	<br/>
	<ul class="products">
	{$count = 1}
	{foreach $newest as $p}
		<li {if $count == 3} class="last" {$count = 0}{/if}>
			<div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
				<a href="{shop_url('product/' . $p->getUrl())}">
					<img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="{echo encode($p->getName())}" />
				</a>
			</div>
			<h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
			<div class="price" {if $p->firstVariant->getStock() == 0}style="color:silver;"{/if}>
				{$p->firstVariant}
				{if $p->hasDiscounts()}
					<s>{echo $p->firstVariant->toCurrency('origPrice')} {$CS}</s>
					<br/>
					<span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
				{else:}
					<span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
				{/if}
			</div>
			<div class="compare"><a href="{shop_url('compare/add/' . $p->getId())}">Сравнить</a></div>
		</li>
			{if $count == 3}<li class="separator"></li> {$count=0}{/if}
			{$count++}
	{/foreach}
	</ul>
	<!-- END NEW -->

</div>
