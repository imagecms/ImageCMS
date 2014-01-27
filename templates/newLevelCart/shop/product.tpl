{/*/**
* @file Render shop product;
* @partof main.tpl;
* @updated 26 February 2013;
* Variables
*  $model : PropelObjectCollection of (object) instance of SProducts
*   $model->hasDiscounts() : Check whether the discount on the product.
*   $model->firstVariant : variable which contains the first variant of product;
*   $model->firstVariant->toCurrency() : variable which contains price of product;
*
*/}
{$Comments = $CI->load->module('comments')->init($model)}
{$NextCSIdCond = $NextCS != null}
{$variants = $model->getProductVariants()}
{$sizeAddImg = sizeof($productImages = $model->getSProductAdditionalImages())}
{$hasDiscounts = $model->hasDiscounts()}
<div class="frame-crumbs">
    <!-- Making bread crumbs -->
    {widget('path')}
</div>
<div class="frame-inside page-product">
    <div class="container">
        {$inCartFV = getAmountInCart('SProducts', $model->firstVariant->getId())}
        <div class="clearfix item-product globalFrameProduct{if $model->firstVariant->getStock() == 0} not-avail{else:}{if $inCartFV} in-cart{else:} to-cart{/if}{/if}">
            <div class="f-s_0 title-product">
                <!-- Start. Name product -->
                <div class="frame-title">
                    <h1 class="title">{echo  ShopCore::encode($model->getName())}</h1>
                </div>
                <!-- End. Name product -->
                <!-- Start. article & variant name & brand name -->
                <span class="frame-variant-name-code">
                    <span class="frame-variant-code frameVariantCode" {if !$model->firstVariant->getNumber()}style="display:none;"{/if}>
                        {lang('Артикул','newLevel')}:
                        <span class="code js-code">
                            {if $model->firstVariant->getNumber()}
                                {trim($model->firstVariant->getNumber())}
                            {/if}
                        </span>
                    </span>
                    {if count($variants) > 1}
                        <span class="frame-variant-name frameVariantName" {if !$model->firstVariant->getName()}style="display:none;"{/if}>
                            {lang('Вариант','newLevel')}:
                            <span class="code js-code">
                                {if $model->firstVariant->getName()}
                                    {trim($model->firstVariant->getName())}
                                {/if}
                            </span>
                        </span>
                    {/if}
                    {if $model->getBrand() != null}
                        {$brand = $model->getBrand()->getName()}
                        {$hasBrand = trim($brand) != ''}
                        <span class="frame-item-brand">{lang('Бренд','newLevel')}:
                            <span class="code js-code">
                                {if $hasBrand}
                                    <a href="{shop_url('brand/'.$model->getBrand()->getUrl())}">
                                        {echo trim($brand)}
                                    </a>
                                {/if}
                            </span>
                        </span>
                    {/if}
                </span>
                <!-- End. article & variant name & brand name -->
            </div>
            <div class="right-product">
                <!-- Start. frame for cloudzoom -->
                <div id="xBlock"></div>
                <!-- End. frame for cloudzoom -->
                <div class="right-product-left">
                    <div class="f-s_0 buy-block">
                        <!-- Start. Check variant-->
                        {if count($variants) > 1}
                            <div class="check-variant-product">
                                <div class="title">{lang('Выберите вариант','newLevel')}:</div>
                                <div class="lineForm">
                                    <select name="variant" id="variantSwitcher">
                                        {foreach $variants as $key => $productVariant}
                                            <option value="{echo $productVariant->getId()}">
                                                {if $productVariant->getName()}
                                                    {echo ShopCore::encode($productVariant->getName())}
                                                {else:}
                                                    {echo ShopCore::encode($model->getName())}
                                                {/if}
                                            </option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                        {/if}
                        <!-- End. Check variant-->
                        <div class="frame-prices-buy-wish-compare">
                            <div class="frame-prices-buy f-s_0">
                                <!-- Start. Prices-->
                                <div class="frame-prices f-s_0">
                                    <!-- Start. Check for discount-->
                                    {$oldoprice = $model->getOldPrice() && $model->getOldPrice() != 0 && $model->getOldPrice() > $model->firstVariant->toCurrency()}
                                    {if $hasDiscounts}
                                        <span class="price-discount">
                                            <span>
                                                <span class="price priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')}</span>
                                                <span class="curr">{$CS}</span>
                                            </span>
                                        </span>
                                    {/if}
                                    <!-- End. Check for discount-->
                                    <!-- Start. Check old price-->
                                    {if $oldoprice && !$hasDiscounts}
                                        <span class="price-discount">
                                            <span>
                                                <span class="price priceOrigVariant">{echo intval($model->getOldPrice())}</span>
                                                <span class="curr">{$CS}</span>
                                            </span>
                                        </span>
                                    {/if}
                                    <!-- End. Check old price-->
                                    <!-- Start. Product price-->
                                    {if $model->firstVariant->toCurrency() > 0}
                                        <span class="current-prices f-s_0">
                                            <span class="price-new">
                                                <span>
                                                    <span class="price priceVariant">{echo $model->firstVariant->toCurrency()}</span>
                                                    <span class="curr">{$CS}</span>
                                                </span>
                                            </span>
                                            {if $NextCSIdCond}
                                                <span class="price-add">
                                                    <span>
                                                        (<span class="price addCurrPrice">{echo $model->firstVariant->toCurrency('Price',$NextCSId)}</span>
                                                        <span class="curr-add">{$NextCS}</span>)
                                                    </span>
                                                </span>
                                            {/if}
                                        </span>
                                    {/if}
                                    <!-- End. Product price-->
                                </div>
                                <!-- End. Prices-->
                                <div class="funcs-buttons">
                                    <!-- Start. Collect information about Variants, for future processing -->
                                    {foreach $variants as $key => $productVariant}
                                        {$discount = 0}
                                        {if $hasDiscounts}
                                            {$discount = $productVariant->getvirtual('numDiscount')/$productVariant->toCurrency()*100}
                                        {/if}
                                        {if $productVariant->getStock() > 0}
                                            {$inCart = getAmountInCart('SProducts', $productVariant->getId())}
                                            <div class="frame-count-buy js-variant-{echo $productVariant->getId()} js-variant" {if $key != 0}style="display:none"{/if}>
                                                <form method="POST" action="/shop/cart/addProductByVariantId/{echo $productVariant->getId()}">
                                                    <div class="frame-count frameCount">
                                                        <div class="number js-number" data-title="{lang('Количество на складе','newLevel')} {echo $productVariant->getstock()}">
                                                            <div class="frame-change-count">
                                                                <div class="btn-plus">
                                                                    <button type="button" {if $inCart}disabled="disabled"{/if}>
                                                                        <span class="icon-plus"></span>
                                                                    </button>
                                                                </div>
                                                                <div class="btn-minus">
                                                                    <button type="button" {if $inCart}disabled="disabled"{/if}>
                                                                        <span class="icon-minus"></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="quantity" value="{echo $inCart ? $inCart : 1}" class="plusMinus plus-minus" data-title="{lang('Только цифры','newLevel')}" data-min="1" data-max="{echo $productVariant->getstock()}" {if $inCart}disabled="disabled"{/if}>
                                                        </div>
                                                    </div>
                                                    <div class="btn-buy-p btn-cart{if !$inCart} d_n{/if}">
                                                        <button 
                                                            type="button"
                                                            data-id="{echo $productVariant->getId()}"

                                                            class="btnBuy"
                                                            >
                                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                                            <span class="text-el">{lang('В корзине', 'newLevel')}</span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-buy-p btn-buy{if $inCart} d_n{/if}">
                                                        <button 
                                                            type="button"

                                                            onclick='Shop.Cart.add($(this).closest("form").serialize(), "{echo $productVariant->getId()}")'
                                                            class="btnBuy infoBut"

                                                            data-id="{echo $productVariant->getId()}"
                                                            data-vname="{echo ShopCore::encode($productVariant->getName())}"
                                                            data-number="{echo $productVariant->getNumber()}"
                                                            data-price="{echo $productVariant->toCurrency()}"
                                                            data-add-price="{if $NextCSIdCond}{echo $productVariant->toCurrency('Price',$NextCSId)}{/if}"
                                                            data-orig-price="{if $hasDiscounts}{echo $productVariant->toCurrency('OrigPrice')}{/if}"
                                                            data-large-image="
                                                            {if preg_match('/nophoto/', $productVariant->getlargePhoto()) > 0}
                                                                {echo $model->firstVariant->getlargePhoto()}
                                                            {else:}
                                                                {echo $productVariant->getlargePhoto()}
                                                            {/if}"
                                                            data-main-image="
                                                            {if preg_match('/nophoto/', $productVariant->getMainPhoto()) > 0}
                                                                {echo $model->firstVariant->getMainPhoto()}
                                                            {else:}
                                                                {echo $productVariant->getMainPhoto()}
                                                            {/if}"
                                                            data-img="
                                                            {if preg_match('/nophoto/', $productVariant->getSmallPhoto()) > 0}
                                                                {echo $model->firstVariant->getSmallPhoto()}
                                                            {else:}
                                                                {echo $productVariant->getSmallPhoto()}
                                                            {/if}"
                                                            data-maxcount="{echo $productVariant->getstock()}"
                                                            >
                                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                                            <span class="text-el">{lang('Купить', 'newLevel')}</span>
                                                        </button>
                                                    </div>
                                                    {form_csrf()}
                                                </form>
                                            </div>
                                        {else:}
                                            <div class="d_i-b v-a_m">
                                                <div class="js-variant-{echo $productVariant->getId()} js-variant" {if $key != 0}style="display:none"{/if}>
                                                    <div class="alert-exists">{lang('Нет в наличии','newLevel')}</div>
                                                    <div class="btn-not-avail">
                                                        <button
                                                            type="button"
                                                            class="infoBut"
                                                            data-drop=".drop-report"
                                                            data-source="/shop/ajax/getNotifyingRequest"

                                                            data-id="{echo $productVariant->getId()}"
                                                            data-name="{echo ShopCore::encode($model->getName())}"
                                                            data-vname="{echo ShopCore::encode($productVariant->getName())}"
                                                            data-number="{echo $productVariant->getNumber()}"
                                                            data-price="{echo $productVariant->toCurrency()}"
                                                            data-add-price="{if $NextCSIdCond}{echo $productVariant->toCurrency('Price',$NextCSId)}{/if}"
                                                            data-orig-price="{if $hasDiscounts}{echo $productVariant->toCurrency('OrigPrice')}{/if}"
                                                            data-large-image="
                                                            {if preg_match('/nophoto/', $productVariant->getlargePhoto()) > 0}
                                                                {echo $model->firstVariant->getlargePhoto()}
                                                            {else:}
                                                                {echo $productVariant->getlargePhoto()}
                                                            {/if}"
                                                            data-main-image="
                                                            {if preg_match('/nophoto/', $productVariant->getMainPhoto()) > 0}
                                                                {echo $model->firstVariant->getMainPhoto()}
                                                            {else:}
                                                                {echo $productVariant->getMainPhoto()}
                                                            {/if}"
                                                            data-img="
                                                            {if preg_match('/nophoto/', $productVariant->getSmallPhoto()) > 0}
                                                                {echo $model->firstVariant->getSmallPhoto()}
                                                            {else:}
                                                                {echo $productVariant->getSmallPhoto()}
                                                            {/if}"
                                                            data-maxcount="{echo $productVariant->getstock()}"
                                                            data-url="{echo shop_url('product/'.$model->getUrl())}"
                                                            >
                                                            <span class="icon-but"></span>
                                                            <span class="text-el">{lang('Сообщить о появлении','newLevel')}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    {/foreach}
                                </div>
                                <!-- End. Collect information about Variants, for future processing -->
                            </div>
                            <!-- Start. Wish List & Compare List buttons -->
                            <div class="frame-wish-compare-list f-s_0">
                                {foreach $variants as $key => $pv}
                                    <div class="frame-btn-wish js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if} data-id="{echo $pv->getId()}">
                                        {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
                                    </div>
                                {/foreach}
                                <div class="frame-btn-compare">
                                    <div class="btn-compare">
                                        <button class="toCompare"
                                                data-id="{echo $model->getId()}"
                                                type="button"
                                                data-title="{lang('К сравнению','newLevel')}"
                                                data-firtitle="{lang('К сравнению','newLevel')}"
                                                data-sectitle="{lang('В сравнении','newLevel')}"
                                                data-rel="tooltip">
                                            <span class="icon_compare"></span>
                                            <span class="text-el d_l">{lang('К сравнению','newLevel')}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End. Wish List & Compare List buttons -->
                        </div>
                    </div>
                    <!-- Start. Description -->
                    {if trim($model->getShortDescription()) != ''}
                        <div class="short-desc">
                            {echo $model->getShortDescription()}
                        </div>
                    {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($model->getId())}
                        <div class="short-desc">
                            <p>{echo $props}</p>
                        </div>
                    {/if}
                    <!--  End. Description -->
                    <!--Start .Share-->
                    <dl class="social-product">
                        <dt class="s-t text-social-like">{lang('Понравился товар?', 'newLevel')}</dt>
                        <dd class="social-like">
                            {echo $CI->load->module('share')->_make_like_buttons()}
                        </dd>
                        <dt class="s-t text-social-tell">{lang('Рассказать друзьям:', 'newLevel')}</dt>
                        <dd class="social-tell">
                            {echo $CI->load->module('share')->_make_share_form()}
                        </dd>
                    </dl>
                    <!-- End. Share -->
                </div>
                <div class="right-product-right">
                    <!--Start. Payments method form -->
                    {widget('payments_delivery_methods_info')}
                    <!--End. Payments method form -->
                </div>
            </div>
            <div class="left-product leftProduct">
                <!-- Start. Photo block-->
                <a rel="position: 'xBlock'" onclick="return false;" href="{echo $model->firstVariant->getLargePhoto()}" class="frame-photo-title photoProduct cloud-zoom" id="photoProduct" title="{echo ShopCore::encode($model->getName())}" data-drop="#photo" data-start="Product.initDrop">
                    <span class="photo-block">
                        <span class="helper"></span>
                        <img src="{echo $model->firstVariant->getMainPhoto()}" alt="{echo ShopCore::encode($model->getName())}" title="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" class="vImgPr"/>
                        {$discount = 0}
                        {if $hasDiscounts}
                            {$discount = $model->firstVariant->getvirtual('numDiscount')/$model->firstVariant->toCurrency('origprice')*100}
                        {/if}
                        {promoLabel($model->getAction(), $model->getHot(), $model->getHit(), $discount)}
                    </span>
                </a>
                <!-- End. Photo block-->
                <!-- Start. Star rating -->
                {if $model->enable_comments && intval($Comments[$model->getId()]) !== 0}
                    <div class="frame-star t-a_j">
                        {$CI->load->module('star_rating')->show_star_rating($model, false)}
                        <div class="d-i_b">
                            <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-response d_l">
                                {intval($Comments[$model->getId()])}
                                {echo SStringHelper::Pluralize($Comments[$model->getId()], array(lang("отзыв","newLevel"),lang("отзыва","newLevel"),lang("отзывов","newLevel")))}
                            </button>
                        </div>
                    </div>
                {else:}
                    <div class="frame-star t-a_j">
                        <div class="d_i-b">
                            <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-null-response d_l">{lang('Оставить отзыв','newLevel')}</button>
                        </div>
                    </div>
                {/if}
                <!-- End. Star rating-->
                {if $sizeAddImg > 0}
                    <!-- Start. additional images-->
                    <div class="horizontal-carousel">
                        <div class="frame-thumbs carousel-js-css">
                            {/*carousel-js-css*/}
                            <div class="content-carousel">
                                <ul class="items-thumbs items">
                                    <!-- Start. main image-->
                                    <li class="active">
                                        <a onclick="return false;" rel="useZoom: 'photoProduct'" href="{echo $model->firstVariant->getLargePhoto()}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery" id="mainThumb">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="{echo $model->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($model->getName())}" class="vImgPr"/>
                                            </span>
                                        </a>
                                    </li>
                                    <!-- End. main image-->
                                    {foreach $productImages as $key => $image}
                                        <li>
                                            <a onclick="return false;" rel="useZoom: 'photoProduct'" href="{productImageUrl('products/additional/'.$image->getImageName())}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery">
                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                    <img src="{echo productImageUrl('products/additional/thumb_'.$image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                                                </span>
                                            </a>
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                            <div class="group-button-carousel">
                                <button type="button" class="prev arrow">
                                    <span class="icon_arrow_p"></span>
                                </button>
                                <button type="button" class="next arrow">
                                    <span class="icon_arrow_n"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End. additional images-->
                {/if}
            </div>
        </div>
    </div>
    <!-- Start. benefits block-->
    <div class="frame-benefits-product">
        <div class="frame-benefits">
            {widget('benefits')}
        </div>
    </div>
    <!-- End. benefits block-->
    <!-- Start. Kit-->
    {if count($model->getShopKitsLoggedUsersCheck($CI->dx_auth->is_logged_in())) > 0}
        <div class="container">
            <section class="frame-complect horizontal-carousel">
                <div class="frame-title">
                    <div class="title">{lang('Специальное предложение! Купить, установить и получить скидку на аксессуары!','newLevel')}</div>
                </div>
                <div class="carousel-js-css items-carousel complects-carousel">
                    <div class="content-carousel">
                        <ul class="items-complect items">
                            {foreach $model->getShopKitsLoggedUsersCheck($CI->dx_auth->is_logged_in()) as $key => $kitProducts}
                                {$inCart = getAmountInCart('ShopKit', $kitProducts->getId())}
                                <li class="globalFrameProduct{if $inCart} in-cart{else:} to-cart{/if}">
                                    <ul class="items items-bask row-kits rowKits">
                                        <!-- main product -->

                                        <li>
                                            <div class="frame-kit main-product">
                                                <div class="frame-photo-title">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="{echo $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
                                                        {promoLabel($kitProducts->getSProducts()->getAction(), $kitProducts->getSProducts()->getHot(), $kitProducts->getSProducts()->getHit(), 0)}
                                                    </span>
                                                    <span class="title">{echo ShopCore::encode($model->getName())}</span>
                                                </div>
                                                <div class="description">
                                                    <div class="frame-prices f-s_0">
                                                        <!-- Start. Product price-->
                                                        <span class="current-prices f-s_0">
                                                            <span class="price-new">
                                                                <span>
                                                                    <span class="price priceVariant">{echo $kitProducts->getMainProductPrice()}</span>
                                                                    <span class="curr">{$CS}</span>
                                                                </span>
                                                            </span>
                                                            {if $NextCSIdCond}
                                                                <span class="price-add">
                                                                    <span>

                                                                        (<span class="price addCurrPrice">{echo $kitProducts->getMainProductPrice($NextCSId)}</span>

                                                                        <span class="curr-add">{$NextCS}</span>)
                                                                    </span>
                                                                </span>
                                                            {/if}
                                                        </span>
                                                        <!-- End. Product price-->
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- /end main product -->
                                        {foreach $kitProducts->getShopKitProducts() as  $key => $kitProduct}
                                            <!-- additional product -->
                                            <li>
                                                <div class="next-kit">+</div>
                                                <div class="frame-kit">
                                                    <a href="{shop_url('product/' . $kitProduct->getSProducts()->getUrl())}" class="frame-photo-title">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="{echo $kitProduct->getSProducts()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProduct->getSProducts()->getName())}"/>

                                                            {$discount = $kitProduct->getDiscount()}

                                                            {promoLabel($kitProduct->getSProducts()->getAction(), $kitProduct->getSProducts()->getHot(), $kitProduct->getSProducts()->getHit(), $discount)}
                                                        </span>
                                                        <span class="title">{echo ShopCore::encode($kitProduct->getSProducts()->getName())}</span>
                                                    </a>
                                                    <div class="description">
                                                        <div class="frame-prices f-s_0">
                                                            <!-- Check for discount-->
                                                            {if $kitProduct->getDiscount()}
                                                                <span class="price-discount">
                                                                    <span>
                                                                        <span class="price priceOrigVariant">{echo $kitProduct->getKitProductPrice()}</span>
                                                                        <span class="curr">{$CS}</span>
                                                                    </span>
                                                                </span>
                                                            {/if}
                                                            <!-- Start. Product price-->

                                                            <span class="current-prices f-s_0">
                                                                <span class="price-new">
                                                                    <span>
                                                                        <span class="price priceVariant">{echo $kitProduct->getKitNewPrice()}</span>
                                                                        <span class="curr">{$CS}</span>
                                                                    </span>
                                                                </span>
                                                                {if $NextCSIdCond}
                                                                    <span class="price-add">
                                                                        <span>
                                                                            (<span class="price addCurrPrice">{echo $kitProduct->getKitNewPrice($NextCSId)}</span>
                                                                            <span class="curr-add">{$NextCS}</span>)
                                                                        </span>
                                                                    </span>
                                                                {/if}
                                                            </span>

                                                            <!-- End. Product price-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- /additional product -->
                                        {/foreach}
                                    </ul>
                                    <!-- total -->
                                    <div class="complect-gen-sum">
                                        <div class="gen-sum-kit">=</div>
                                        <div class="frame-gen-price-buy-complect">
                                            <div class="frame-prices f-s_0">
                                                <span class="price-discount">
                                                    <span>
                                                        <span class="price">{echo $kitProducts->getTotalPriceOld()}</span>
                                                        <span class="curr">{$CS}</span>
                                                    </span>
                                                </span>
                                                <span class="current-prices f-s_0">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price">{echo $kitProducts->getTotalPrice()}</span>
                                                            <span class="curr">{$CS}</span>
                                                        </span>
                                                    </span>
                                                    {if $NextCSIdCond}
                                                        <span class="price-add">
                                                            <span>
                                                                (<span class="price">{echo $kitProducts->getTotalPrice($NextCSId)}</span>
                                                                <span class="curr-add">{$NextCS}</span>)
                                                            </span>
                                                        </span>
                                                    {/if}
                                                </span>
                                            </div>
                                            <form method="POST" action="/shop/cart/addKit/{echo $kitProducts->getId()}">
                                                <div class="btn-buy-p btn-cart{if !$inCart} d_n{/if}">
                                                    <button 
                                                        type="button"
                                                        data-id="{echo $kitProducts->getId()}"

                                                        class="btnBuy infoBut btnBuyKit"
                                                        >
                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                        <span class="text-el">{lang('В корзине', 'newLevel')}</span>
                                                    </button>
                                                </div>
                                                <div class="btn-buy-p btn-buy{if $inCart} d_n{/if}">
                                                    <button 
                                                        type="button"
                                                        data-id="{echo $kitProducts->getId()}"

                                                        onclick='Shop.Cart.add($(this).closest("form").serialize(), "{echo $kitProducts->getId()}", true)'
                                                        class="btnBuy infoBut btnBuyKit"
                                                        >
                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                        <span class="text-el">{lang('Купить', 'newLevel')}</span>
                                                    </button>
                                                </div>
                                                {form_csrf()}
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /total -->
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    <!-- Start. Buttons for next/prev kit-->
                    <div class="group-button-carousel">
                        <button type="button" class="prev arrow">
                            <span class="icon_arrow_p"></span>
                        </button>
                        <button type="button" class="next arrow">
                            <span class="icon_arrow_n"></span>
                        </button>
                    </div>
                    <!-- Start. Buttons for next/prev kit-->
                </div>
            </section>
        </div>
    {/if}
    <!-- End. Kits-->
    <div class="container f-s_0">
        <!-- Start. Tabs block-->
        <ul class="tabs tabs-data tabs-product">
            <li class="active">
                <button data-href="#view">{lang('Обзор','newLevel')}</button>
            </li>
            {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}

                <li><button data-href="#first" data-source="{shop_url('product_api/renderProperties')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()} {literal}}{/literal}' data-selector=".characteristic">{lang('Свойства','newLevel')}</button></li>
            {/if}
            {if $fullDescription = $model->getFullDescription()}
                <li><button data-href="#second" data-source="{shop_url('product_api/renderFullDescription')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}{literal}}{/literal}' data-selector=".inside-padd > .text">{lang('Полное описание','newLevel')}</button></li>
            {/if}
            {if $accessories}
                <li><button data-href="#fourth" data-source="{shop_url('product_api/getAccessories')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}, "arrayVars": {json_encode(array('opi_defaultItem'=>true))}{literal}}{/literal}' data-selector=".inside-padd > .items">{lang('Аксессуары','newLevel')}</button></li>
            {/if}
            <!--Output of the block comments-->
            {if $Comments && $model->enable_comments}
                <li>
                    <button type="button" data-href="#comment" onclick="Comments.renderPosts($('#comment .inside-padd'), {literal}{'visibleMainForm': '1'}{/literal})">
                        <span class="icon_comment-tab"></span>
                        <span class="text-el">
                            <span id="cc">
                                {if intval($Comments[$model->getId()][0]) !== 0}
                                    {echo intval($Comments[$model->getId()])}
                                    {echo SStringHelper::Pluralize($Comments[$model->getId()], array(lang("отзыв","newLevel"),lang("отзыва","newLevel"),lang("отзывов","newLevel")))}
                                {else:}
                                    {lang('Оставить отзыв','newLevel')}
                                {/if}
                            </span>
                        </span>
                    </button>
                </li>
            {/if}
        </ul>
        <div class="frame-tabs-ref frame-tabs-product">
            <div id="view">
                {if $dl_properties}
                    <div class="inside-padd">
                        <span class="title-h2">{lang('Свойства','newLevel')}</span>
                        <div class="characteristic">
                            <div class="product-charac patch-product-view">
                                {echo $dl_properties}
                            </div>
                            <button class="t-d_n f-s_0 s-all-d ref d_n_" data-trigger="[data-href='#first']" data-scroll="true">
                                <span class="icon_arrow"></span>
                                <span class="text-el">{lang('Просмотреть все спецификации','newLevel')}</span>
                            </button>
                        </div>
                    </div>
                {/if}
                {if $fullDescription != ''}
                    <div class="inside-padd">
                        <!--                        Start. Description block-->
                        <div class="product-descr patch-product-view">
                            <div class="text">
                                <div class="title-h2">{lang('Описание' , 'newLevel')}</div>
                                <h2>{echo  ShopCore::encode($model->getName())}</h2>
                                {echo $fullDescription}
                            </div>
                        </div>
                        <button class="t-d_n f-s_0 s-all-d ref d_n_" data-trigger="[data-href='#second']" data-scroll="true">
                            <span class="icon_arrow"></span>
                            <span class="text-el">{lang('Полное описание','newLevel')}</span>
                        </button>
                        <!--                        End. Description block-->
                    </div>
                {/if}

                {if $accessories}
                    <div class="accessories">
                        <div class="title-default">
                            <div class="title">
                                <h2 class="d_i">{lang('С этим товаром покупают','newLevel')}</h2>
                                {if count($accessories) > 4}
                                    <button class="t-d_n f-s_0 s-all-d ref s-all-marg" data-trigger="[data-href='#fourth']" data-scroll="true">
                                        <span class="icon_arrow"></span>
                                        <span class="text-el">{lang('Смотреть все аксессуары','newLevel')}</span>
                                    </button>
                                {/if}
                            </div>
                        </div>
                        <div class="inside-padd">
                            <ul class="items items-default">
                                {$CI->load->module('new_level')->OPI($accessories, array('opi_defaultItem'=>true, 'opi_limit'=>4))}
                            </ul>
                        </div>
                    </div>
                {/if}
                <div class="inside-padd">
                    <!--Start. Comments block-->
                    {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
                    <div class="frame-form-comment">
                        <div class="forComments">
                            {echo $c['comments']}
                        </div>
                        <!--End. Comments block-->
                    </div>
                </div>
            </div>
            <!--             Start. Characteristic-->
            <div id="first">
                <div class="inside-padd">
                    <div class="title-h2">{lang('Свойства', 'newLevel')}</div>
                    <div class="characteristic">
                        <div class="preloader"></div>
                    </div>
                </div>
            </div>
            <!--                    End. Characteristic-->
            <div id="second">
                <div class="inside-padd">
                    <div class="title-h2">{lang('Описание' , 'newLevel')}</div>
                    <div class="text">
                        <div class="preloader"></div>
                    </div>
                </div>
            </div>
            <div id="comment">
                <div class="inside-padd forComments">
                    <div class="preloader"></div>
                </div>
            </div>
            <!--Block Accessories Start-->
            {if $accessories}
                <div id="fourth" class="accessories">
                    <div class="inside-padd">
                        <h2 class="m-b_30">{lang('С этим товаром покупают','newLevel')}</h2>
                        <ul class="items items-default">
                            <div class="preloader"></div>
                        </ul>
                    </div>
                </div>
            {/if}
            <!--End. Block Accessories-->
        </div>
        <!-- End. Tabs block-->
    </div>
</div>
<!-- Start. Similar Products-->
{widget('similar')}
<!-- End. Similar Products-->

<!-- Start. News-->
{widget('latest_news')}
<!-- End. News-->

<!-- Start. Photo Popup Frame-->
<div class="drop drop-style globalFrameProduct" id="photo"></div>
<script type="text/template" id="framePhotoProduct">
    {literal}
        <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
        <div class="drop-header">
            <div class="title"><%- obj.title %></div>
            <div class="horizontal-carousel">
                <div class="frame-fancy-gallery frame-thumbs">
                    <div class="fancy-gallery carousel-js-css">
                        <div class="content-carousel">
                            <ul class="items-thumbs items">
                                <%= obj.frame.find(obj.galleryContent).html() %>
                            </ul>
                        </div>
                        <div class="group-button-carousel">
                            <button type="button" class="prev arrow">
                                <span class="icon_arrow_p"></span>
                            </button>
                            <button type="button" class="next arrow">
                                <span class="icon_arrow_n"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="drop-content">
            <div class="inside-padd">
                <img src="<%- obj.mainPhoto %>" alt="<%- obj.title %>"/>
            </div>
            <div class="horizontal-carousel">
                <div class="group-button-carousel">
                    <button type="button" class="prev arrow">
                        <span class="icon_arrow_p"></span>
                    </button>
                    <button type="button" class="next arrow">
                        <span class="icon_arrow_n"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="drop-footer">
            <div class="inside-padd">
                <%= obj.frame.find(obj.footerContent).html()%>
            </div>
        </div>
    {/literal}
</script>
<!-- End. Photo Popup Frame-->

<!-- Start. JS vars-->
<script type="text/javascript">
    var hrefCategoryProduct = "{$category_url}";
</script>
{literal}
    <script type="text/javascript">
        var
        productPhotoDrop = true,
        productPhotoCZoom = true;
    </script>
{/literal}
<!-- End. JS vars-->

<script type="text/javascript">
    initDownloadScripts(['cusel-min-2.5', 'cloud-zoom.1.0.3.min', 'product'], 'initPhotoTrEv', 'initPhotoTrEv');
</script>