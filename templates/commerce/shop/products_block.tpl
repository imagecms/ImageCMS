{if $totalProducts > 0}
		<ul class="products">
		{$count = 1;}
		{foreach $products as $p}
			<li {if $count == 3} class="last" {$count = 0}{/if} {if $count == 1} style="clear:left;" {/if}>
				<div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
					<a href="{shop_url('product/' . $p->getUrl())}">
						<img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="{echo encode($p->getName())}" />
					</a>
				</div>
				<h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
				<div class="price priceLight" {if $p->firstVariant->getStock() == 0}style="color:silver;"{/if}>
					{$p->firstVariant}
					{if $p->hasDiscounts()}
						<s>{echo $p->firstVariant->toCurrency('origPrice')} {$CS}</s>
						<br/>
						<span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
					{else:}
						<span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
					{/if}
				</div>
				<div class="compare"><a href="{shop_url('compare/add/' . $p->getId())}">{lang('s_compare')}</a></div>
			</li>
			{if $count == 3}<li class="separator"></li> {$count=0}{/if}
			{$count++}
		{/foreach}
		</ul>

		<div class="sp"></div>
		<div class="products_bottom" id="products_bottom"></div>
		<div id="gopages" class="navigation">
			{$pagination}
		</div>
		<div class="sp"></div>
		{else:}
		<p>
			{echo ShopCore::t(lang('s_no_prod_category'))}.
		</p>
{/if}