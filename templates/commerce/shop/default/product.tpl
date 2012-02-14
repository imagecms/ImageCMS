{# Variables
# @var model
# @var editProductUrl
# @var jsCode
#}

{$jsCode}

<script type="text/javascript">
	var currentProductId = '{echo $model->getId()}';
</script>

<!-- BEGIN STAR RATING -->
<link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/rating/jquery.rating-min.css" />
<script src="{$SHOP_THEME}js/rating/jquery.rating-min.js"></script>
<script src="{$SHOP_THEME}js/rating/jquery.MetaData-min.js"></script>
<script src="{$SHOP_THEME}js/product.js"></script>
<!-- END STAR RATING -->

<!-- BEGIN LIGHTBOX -->
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.color.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.lightbox.min.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SHOP_THEME}js/lightbox/styles/jquery.lightbox.min.css" />
<!-- END LIGHTBOX -->

{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

	  <div id="titleExt">
		<h5 class="left">
		{echo ShopCore::encode($model->getName())}
		{if sizeof($model->getProductVariants()) == 1}
			{echo $model->firstVariant->getName()}
		{/if}
		</h5>
		<div class="right">
		{$rating = $model->getRating()}
			<input class="hover-star" type="radio" name="rating-1" value="1" {if $rating==1}checked="checked"{/if}/>
			<input class="hover-star" type="radio" name="rating-1" value="2" {if $rating==2}checked="checked"{/if}/>
			<input class="hover-star" type="radio" name="rating-1" value="3" {if $rating==3}checked="checked"{/if}/>
			<input class="hover-star" type="radio" name="rating-1" value="4" {if $rating==4}checked="checked"{/if}/>
			<input class="hover-star" type="radio" name="rating-1" value="5" {if $rating==5}checked="checked"{/if}/>
		</div>
		<div class="sp"></div>

		<div id="categoryPath">
			{renderCategoryPath($model->getMainCategory())}
		</div>
	  </div>

	{if $CI->session->flashdata('productAdded') === true}
		<div style="padding:10px;background-color:#f5f5dc;">
			Товар добавлен в <a href="{shop_url('cart')}" rel="nofollow">корзину.</a>
		</div>
	{/if}
		<br/>
	{if ShopCore::$ci->dx_auth->is_admin()}
		<div style="float:right;"><a target="_blank" href="/admin?r=admin/components/run/shop/products/edit/{echo $editProductUrl}/&b=shopAdminPage">Редактировать товар</a></div>
	{/if}
	<div class="left">

	  <div id="gallery">
		<div id="prImage" align="center">
		{if $model->getMainImage()}
			<img src="{productImageUrl($model->getMainImage())}" border="0" alt="{echo encode($model->getName())}" />
		{/if}
		</div>

		{if sizeof($model->getSProductImagess()) > 0}
			{foreach $model->getSProductImagess() as $image}
				<div class="images">
					<div class="image">
						<a class="lightbox" alt="{echo encode($model->getName())}" href="{echo $image->getUrl()}">
							<img src="{echo $image->getThumbUrl()}" style="width:90px;">
						</a>
					</div>
				</div>
			{/foreach}
		{/if}
	  </div>

	</div>
	<div id="product" style="width:380px;">
		<div id="detail">
			<h3>Описание продукта:</h3>
			{echo $model->getShortDescription()}
			{echo $model->getFullDescription()}

			{if $model->countProperties() > 0}
				<h3>Характеристики:</h3>
				<div id="productProperties">
					{echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
				</div>
			{/if}
		</div>

	<a href="#"></a>

	<div class="right">
		<form action="{shop_url('cart/add')}" name="productForm" id="productForm" method="post">

		{if $model->countProductVariants() > 1}
		<!-- See products.js::display_variant_price() for more details -->
		<div align="right" style="padding-bottom:20px;">
		Варианты товара:
			<select name="variantId" onChange="display_variant_price(this.value)">
			{foreach $model->getProductVariants() as $variant}
				<option value="{echo $variant->getId()}">{echo ShopCore::encode($variant->getName())}</option>
			{/foreach}
			</select>
		</div>
		{else:}
			<input type="hidden" name="variantId" value="{echo $model->firstVariant->getId()}" />
		{/if}


		<div class="price">
			<span id="price">{echo $model->firstVariant->toCurrency()} {$CS}</span>

			<!-- Старая цена -->
			{if $model->getOldPrice() > 0}
			<div style="font-size:13px;color:#000">
			   Старая цена: <span style="color:red;"><s>{echo $model->toCurrency('OldPrice')} {$CS}</s></span>
			</div>
			{/if}

			<!-- Выводим процент или сумму скидки(если есть) -->
			{if $model->hasDiscounts()}
			<div style="font-size:12px;color:#d2691e;">
				На данный продукт действует скидка {echo $model->getDiscountString()}
			</div>
			{/if}
		</div>

		<!-- See products.js::display_variant_price() for more details -->
		<div align='right' style="font-size:12px;color:#669900;">
			{if $model->firstVariant->getStock() > 0}
				<span id="stock">Есть на складе</span>
			{else:}
				<span id="stock">Нет на складе</span>
			{/if}
		</div>
		<a id="send-request" style="float:right;font-size: 13px;cursor: pointer;display:{if $model->firstVariant->getStock()}none{else:}block{/if};">Сообщить о появлении</a><br />
		<input type="hidden" name="productId" value="{echo $model->getId()}" />
		<input type="hidden" name="quantity" value="1" />

		<!--
		<a rel="nofollow" href="#" onClick="document.productForm.submit(); return false;" class="button1">{echo ShopCore::t('ДОБАВИТЬ В КОРЗИНУ')}</a>
		-->
		<a rel="nofollow" href="#" onClick='ajaxAddToCart(); return false;' class="button1">{echo ShopCore::t('ДОБАВИТЬ В КОРЗИНУ')}</a>
		<div style="margin-left:45px;font-size:13px;display:none;background-color:#f5f5dc;" id="cartNotify">
			Товар добавлен в корзину.
		</div>
		<a rel="nofollow" href="#" onClick='ajaxAddToWishList(); return false;' class="button1">{echo ShopCore::t('ДОБАВИТЬ В WISH LIST')}</a>
		<div style="margin-left:45px;font-size:13px;display:none;background-color:#f5f5dc;" id="wishListNotify">
			Товар добавлен в Wish List.
		</div>

		<div id="dialog-form" title="Сообщить о появлении" style="height: 575px;">
			<span style="font-weight: bold; font-size: 14px;">{echo $model->getName()}</span>
			<div id="notifyProductVariantName" style="font-weight: bold; font-size: 13px;">{echo $model->firstVariant->getName()}</div>
			<p class="validateTips" style="color: #d2691e;"></p>
			<form>
			<fieldset>
					<label for="name">Ваше имя:</label>
					<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
					<label for="phone">Мобильный телефон:</label>
					<input type="text" name="phone" id="phone" value="" class="text ui-widget-content ui-corner-all" />
					<label for="actual">Актуально до:</label>
					<input type="text" name="actual" id="actual" value="дд-мм-гггг" class="text ui-widget-content ui-corner-all" style="background-image: url('{$SHOP_THEME}style/images/calendar.png'); background-position: right center; background-repeat: no-repeat;" />
					<label for="comment">Дополнительная информация:</label>
					<textarea name="comment" id="comment" class="text ui-widget-content ui-corner-all" style="min-width: 95%;height: 75px;"></textarea>
			</fieldset>
			</form>
		</div>
		{form_csrf()}
		</form>
	</div>

	<div class="spRight"></div>
  </div>

	<div class="sp"></div>
	{if $model->getRelatedProductsModels()}
	<h5>Сопутствующие товары</h5>
		{# Display list of related products #}
		<ul class="products">
			{$count = 1;}
			{foreach $model->getRelatedProductsModels() as $p}
				<li {if $count == 3} class="last" {$count = 0}{/if}>
					<div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
						<a href="{shop_url('product/' . $p->getUrl())}">
							<img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />
						</a>
					</div>
					<h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
					<div class="price">
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
	{/if}
	<div class="sp"></div>

	{$comments}

</div>

