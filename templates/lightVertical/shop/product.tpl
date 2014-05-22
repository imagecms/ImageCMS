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

<div class="frame-menu-main vertical-menu">
    {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('category_menu')}
    <div class="frame-benefits">
        {widget('benefits')}
    </div>
</div>
<div class="content">


    <div class="frame-inside page-product">
        <div class="container">
            {$inCartFV = getAmountInCart('SProducts', $model->firstVariant->getId())}
            <div class="clearfix">
                <div class="item-product clearfix globalFrameProduct{if $model->firstVariant->getStock() == 0} not-avail{else:}{if $inCartFV} in-cart{else:} to-cart{/if}{/if}">

                    <div class="right-product">
                        <!-- Start. frame for cloudzoom -->
                        <div id="xBlock"></div>
                        <!-- End. frame for cloudzoom -->
                        <div class="f-s_0 title-product">
                            <!-- Start. Name product -->
                            <div class="frame-title">
                                <h1 class="title">{echo  ShopCore::encode($model->getName())}</h1>
                            </div>
                        </div>
                        <div class="frame-info-block clearfix">
                            <ul>
                                <li class="frame-variant-code frameVariantCode f_l" {if !$model->firstVariant->getNumber()}style="display:none;"{/if}>
                                    <span class="code f-s_12 js-code">
                                        {lang('Код','lightVertical')}:
                                        {if $model->firstVariant->getNumber()}
                                            {trim($model->firstVariant->getNumber())}
                                        {/if}
                                    </span>
                                </li>
                                {if $model->enable_comments && intval($Comments[$model->getId()]) !== 0}
                                    <li class="f_r">
                                        {$CI->load->module('star_rating')->show_star_rating($model, false)}
                                        <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-response d_i-b v-a_m d_l_1">
                                            {intval($Comments[$model->getId()])}
                                            {echo SStringHelper::Pluralize($Comments[$model->getId()], array(lang("отзыв",'lightVertical'),lang("отзыва",'lightVertical'),lang("отзывов",'lightVertical')))}
                                        </button>
                                    </li>
                                {else:}
                                    <li>
                                        <div class="frame-star">
                                            <div class="f_r">
                                                <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-null-response d_l_1">{lang('Оставить отзыв','lightVertical')}</button>
                                            </div>
                                        </div>
                                    </li>
                                {/if}
                                {/*}
                                {if $model->getBrand() != null}
                                    <li>
                                        {$brand = $model->getBrand()->getName()}
                                        {$hasBrand = trim($brand) != ''}
                                        <span class="frame-item-brand f-s_12">{lang('Бренд','lightVertical')}:
                                            <span class="code f-s_12 js-code">
                                                {if $hasBrand}
                                                    <a href="{shop_url('brand/'.$model->getBrand()->getUrl())}">
                                                        {echo trim($brand)}
                                                    </a>
                                                {/if}
                                            </span>
                                        </span>
                                    </li>
                                {/if}
                                { */}
                            </ul>
                        </div>
                        <div class="frame-prices-variant">

                            <!-- Start. Check variant-->
                            {if count($variants) > 1}
                                <div class="check-variant-product f_l">
                                    <div class="title">{lang('Вариант','lightVertical')}:</div>
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
                            <div class="f-s_0 buy-block c_b">
                                <div class="frame-prices-buy-wish-compare">
                                    <div class="frame-prices-buy f-s_0">
                                        <!-- Start. Prices-->
                                        <div class="frame-prices-buy f-s_0">
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
                                                            <span class="price-add d_i-b">
                                                                <span>
                                                                    <span class="price addCurrPrice">{echo $model->firstVariant->toCurrency('Price',$NextCSId)}</span>
                                                                    <span class="curr-add">{$NextCS}</span>
                                                                </span>
                                                            </span>
                                                        {/if}
                                                    </span>
                                                {/if}
                                                <!-- End. Product price-->
                                            </div>
                                        </div>
                                        <!-- End. Prices-->
                                        <div class="funcs-buttons clearfix d_b">
                                            <!-- Start. Collect information about Variants, for future processing -->
                                            {foreach $variants as $key => $productVariant}
                                                {$discount = 0}
                                                {if $hasDiscounts}
                                                    {$discount = $productVariant->getvirtual('numDiscount')/$productVariant->toCurrency()*100}
                                                {/if}
                                                {if $productVariant->getStock() > 0}
                                                    {$inCart = getAmountInCart('SProducts', $productVariant->getId())}
                                                    <div class="f_l">
                                                        <div class="frame-count-buy js-variant-{echo $productVariant->getId()} js-variant f_l" {if $key != 0}style="display:none"{/if}>
                                                            <form method="POST" action="/shop/cart/addProductByVariantId/{echo $productVariant->getId()}">
                                                                <div class="frame-count frameCount d_n">
                                                                    <div class="number js-number" data-title="{lang('Количество на складе','lightVertical')} {echo $productVariant->getstock()}">
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
                                                                        <input type="text" name="quantity" value="{echo $inCart ? $inCart : 1}" class="plusMinus plus-minus" data-title="{lang('Только цифры','lightVertical')}" data-min="1" data-max="{echo $productVariant->getstock()}" {if $inCart}disabled="disabled"{/if}>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-buy-p btn-cart{if !$inCart} d_n{/if}">
                                                                    <button
                                                                        type="button"
                                                                        data-id="{echo $productVariant->getId()}"

                                                                        class="btnBuy"
                                                                        >
                                                                        <span class="text-el">{lang('Уже в корзине', 'lightVertical')}</span>
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
                                                                        <span class="text-el">{lang('Купить', 'lightVertical')}</span>
                                                                    </button>
                                                                </div>
                                                                {form_csrf()}
                                                            </form>
                                                        </div>
                                                    {else:}
                                                        <div class="d_i-b v-a_m">
                                                            <div class="js-variant-{echo $productVariant->getId()} js-variant" {if $key != 0}style="display:none"{/if}>
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
                                                                        <span class="text-el d_l_1">{lang('Узнать о появлении','lightVertical')}</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        {/if}

                                                    </div>

                                                {/foreach}
                                                <div class="social-tell f_r">
                                                    {echo $CI->load->module('share')->_make_share_form()}
                                                </div>
                                            </div>

                                            <!-- End. Collect information about Variants, for future processing -->
                                        </div>
                                        <!-- Start. Wish List & Compare List buttons -->
                                        <div class="frame-wish-compare-list d_i-b v-a_m f-s_0">
                                            <div class="frame-btn-compare">
                                                <div class="btn-compare">
                                                    <button class="toCompare"
                                                            data-id="{echo $model->getId()}"
                                                            type="button"
                                                            data-title="{lang('К сравнению','lightVertical')}"
                                                            data-firtitle="{lang('К сравнению','lightVertical')}"
                                                            data-sectitle="{lang('В сравнении','lightVertical')}"
                                                            data-rel="tooltip">
                                                        <span class="icon_compare"></span>
                                                        <span class="text-el d_l">{lang('К сравнению','lightVertical')}</span>
                                                    </button>
                                                </div>
                                            </div>
                                            {foreach $variants as $key => $pv}
                                                <div class="frame-btn-wish js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if} data-id="{echo $pv->getId()}">
                                                    {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
                                                </div>
                                            {/foreach}
                                        </div>
                                        <!-- End. Wish List & Compare List buttons -->

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



                                        <div class="social-like">
                                            {echo $CI->load->module('share')->_make_like_buttons()}
                                        </div>
                                    </div>
                                </div>
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
                    <!-- Start. Kit-->
                    {if $model->getShopKitsLoggedUsersCheck($CI->dx_auth->is_logged_in()) != false}
                        <div class="horizontal-carousel">
                            <section class="frame-complect special-proposition">
                                <div class="frame-title">
                                    <div class="title">{lang('В комплекте дешевле','lightVertical')}</div>
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
                                                                        <img src="{echo $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}" title="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
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
                                                                            <img src="{echo $kitProduct->getSProducts()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProduct->getSProducts()->getName())}" title="{echo ShopCore::encode($kitProduct->getSProducts()->getName())}"/>

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
                                                                        <span class="text-el">{lang('В корзине', 'lightVertical')}</span>
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
                                                                        <span class="text-el">{lang('Купить', 'lightVertical')}</span>
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
                    <!-- Start. Tabs block-->
                    <ul class="tabs tabs-data tabs-product">
                        <li class="active">
                            <button data-href="#view">{lang('Обзор','lightVertical')}</button>
                        </li>
                        {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}

                            <li><button data-href="#first" data-source="{shop_url('product_api/renderProperties')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()} {literal}}{/literal}' data-selector=".characteristic">{lang('Свойства','lightVertical')}</button></li>
                            {/if}
                            {if $fullDescription = $model->getFullDescription()}
                            <li><button data-href="#second" data-source="{shop_url('product_api/renderFullDescription')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}{literal}}{/literal}' data-selector=".inside-padd > .text">{lang('Полное описание','lightVertical')}</button></li>
                            {/if}
                            {if $accessories}
                            <li><button data-href="#fourth" data-source="{shop_url('product_api/getAccessories')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}, "arrayVars": {json_encode(array('opi_defaultItem'=>true))}{literal}}{/literal}' data-selector=".inside-padd > .items">{lang('Аксессуары','lightVertical')}</button></li>
                            {/if}
                        <!--Output of the block comments-->
                        {if $Comments && $model->enable_comments}
                            <li>
                                <button type="button" data-href="#comment" onclick="Comments.renderPosts($('#comment .inside-padd'), {literal}{'visibleMainForm': '1'}{/literal})">
                                    <span class="icon_comment-tab"></span>
                                    <span class="text-el">
                                        <span id="cc">
                                            {if intval($Comments[$model->getId()][0]) !== 0}
                                                {lang('Отзывы','lightVertical')}
                                                ({echo intval($Comments[$model->getId()])})
                                            {else:}
                                                {lang('Отзывы (0)','lightVertical')}
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
                                    <span class="title-h2">{lang('Свойства','lightVertical')}</span>
                                    <div class="characteristic">
                                        <div class="product-charac patch-product-view">
                                            {echo $dl_properties}
                                        </div>
                                        <button class="f-s_0 d_n_ d_l_1 d_i-b" data-trigger="[data-href='#first']" data-scroll="true">
                                            <span class="text-el">{lang('Все свойства','lightVertical')}</span>
                                        </button>
                                    </div>
                                </div>
                            {/if}
                            {if $fullDescription != ''}
                                <div class="inside-padd">
                                    <!--                        Start. Description block-->
                                    <div class="product-descr patch-product-view">
                                        <div class="text">
                                            <div class="title-h2">{lang('Описание' , 'lightVertical')}</div>
                                            <h2>{echo  ShopCore::encode($model->getName())}</h2>
                                            {echo $fullDescription}
                                        </div>
                                    </div>
                                    <button class="f-s_0 d_n_ d_l_1 d_i-b" data-trigger="[data-href='#second']" data-scroll="true">
                                        <span class="text-el">{lang('Полное описание','lightVertical')}</span>
                                    </button>
                                    <!--                        End. Description block-->
                                </div>
                            {/if}

                            {if $accessories}
                                <div class="accessories">
                                    <div class="title-default">
                                        <div class="title">
                                            <h2 class="d_i">{lang('С этим товаром покупают','lightVertical')}</h2>
                                            {if count($accessories) > 3}
                                                <button class="f-s_0 d_n_ d_l_1 d_i-b s-all-marg" data-trigger="[data-href='#fourth']" data-scroll="true">
                                                    <span class="text-el">{lang('Все аксессуары','lightVertical')}</span>
                                                </button>
                                            {/if}
                                        </div>
                                    </div>
                                    <div class="inside-padd">
                                        <ul class="items items-default items-product">
                                            {$CI->load->module('new_level')->OPI($accessories, array('opi_defaultItem'=>true, 'opi_limit'=>3))}
                                        </ul>
                                    </div>
                                </div>
                            {/if}
                            <div class="inside-padd">
                                <!--Start. Comments block-->
                                {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
                                <div class="frame-form-comment">
                                    <div class="forComments p_r">
                                        {echo $c['comments']}
                                    </div>
                                    <!--End. Comments block-->
                                </div>
                            </div>
                        </div>
                        <!--             Start. Characteristic-->
                        <div id="first">
                            <div class="inside-padd">
                                <div class="title-h2">{lang('Свойства', 'lightVertical')}</div>
                                <div class="characteristic">
                                    <div class="preloader"></div>
                                </div>
                            </div>
                        </div>
                        <!--                    End. Characteristic-->
                        <div id="second">
                            <div class="inside-padd">
                                <div class="title-h2">{lang('Описание' , 'lightVertical')}</div>
                                <div class="text">
                                    <div class="preloader"></div>
                                </div>
                            </div>
                        </div>
                        <div id="comment">
                            <div class="inside-padd forComments p_r">
                                <div class="preloader"></div>
                            </div>
                        </div>
                        <!--Block Accessories Start-->
                        {if $accessories}
                            <div id="fourth" class="accessories">
                                <div class="inside-padd">
                                    <h2 class="m-b_30">{lang('С этим товаром покупают','lightVertical')}</h2>
                                    <ul class="items items-default items-product">
                                        <div class="preloader"></div>
                                    </ul>
                                </div>
                            </div>
                        {/if}
                        <!--End. Block Accessories-->
                    </div>
                    <!-- End. Tabs block-->
                    <!--Start. Payments method form -->

                    <!--End. Payments method form -->
                </div>

            </div>
        </div>
        <!-- Start. Similar Products-->
        {widget('similar')}
        <!-- End. Similar Products-->
    </div>


    <!-- Start. Photo Popup Frame-->
    <div class="drop drop-style globalFrameProduct" id="photo"></div>
</div>
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