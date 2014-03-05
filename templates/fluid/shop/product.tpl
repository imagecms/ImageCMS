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
        <div class="clearfix">
            <div class="right-product">
                <!--Start. Payments method form -->
                {widget('payments_delivery_methods_info')}
                <!--End. Payments method form -->
                <!-- Start. Similar Products-->
                {widget('similar')}
                <!-- End. Similar Products-->
            </div>
            <div class="left-product leftProduct">
                <div class="o_h item-product globalFrameProduct{if $model->firstVariant->getStock() == 0} not-avail{else:}{if $inCartFV} in-cart{else:} to-cart{/if}{/if}">
                    <div class="left-product-left">
                        {if $sizeAddImg > 0}
                            <!-- Start. additional images-->
                            <div class="vertical-carousel">
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
                    </div>
                    <div class="left-product-right">
                        <div class="f-s_0 title-product">
                            <!-- Start. Name product -->
                            <div class="frame-title">
                                <h1 class="title">{echo  ShopCore::encode($model->getName())}</h1>
                            </div>
                            <!-- End. Name product -->
                        </div>
                        <div class="t-a_j">
                            <!-- Start. article & variant name & brand name -->
                            <div>
                                <span class="frame-variant-name-code">
                                    <span class="frame-variant-code frameVariantCode" {if !$model->firstVariant->getNumber()}style="display:none;"{/if}>
                                        <span class="s-t">{lang('Код','newLevel')}:</span>
                                        <span class="code js-code">
                                            {if $model->firstVariant->getNumber()}
                                                {trim($model->firstVariant->getNumber())}
                                            {/if}
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <!-- End. article & variant name & brand name -->
                            <!-- Start. Star rating -->
                            <div>
                                {if $model->enable_comments && intval($Comments[$model->getId()]) !== 0}
                                    <div class="frame-star">
                                        {$CI->load->module('star_rating')->show_star_rating($model, false)}
                                        <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-response d_l">
                                            {intval($Comments[$model->getId()])}
                                            {echo SStringHelper::Pluralize($Comments[$model->getId()], array(lang("отзыв","newLevel"),lang("отзыва","newLevel"),lang("отзывов","newLevel")))}
                                        </button>
                                    </div>
                                {else:}
                                    <div class="frame-star">
                                        <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-null-response d_l">{lang('Оставить отзыв','newLevel')}</button>
                                    </div>
                                {/if}
                            </div>
                            <!-- End. Star rating-->
                        </div>
                        <!-- Start. frame for cloudzoom -->
                        <div id="xBlock"></div>
                        <!-- End. frame for cloudzoom -->

                        <div class="f-s_0 buy-block">
                            <!-- Start. Check variant-->
                            {if count($variants) > 1}
                                <div class="check-variant-product">
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
                                <div class="w_375 d_i-b v-a_m">
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
                                                                <span class="price addCurrPrice">{echo $model->firstVariant->toCurrency('Price',$NextCSId)}</span>
                                                                <span class="curr-add">{$NextCS}</span>
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
                                </div>
                                <!-- Start. Wish List & Compare List buttons -->
                                <div class="frame-wish-compare-list f-s_0 d_i-b v-a_m">
                                    {foreach $variants as $key => $pv}
                                        <div class="frame-btn-wish js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if} data-id="{echo $pv->getId()}">
                                            {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
                                        </div>
                                    {/foreach}
                                    <div class="frame-btn-compare">
                                        <div class="btn-compare">
                                            <div class="toCompare btnCompare"
                                                 data-id="{echo $model->getId()}"
                                                 type="button"
                                                 data-title="{lang('Cравнить','newLevel')}"
                                                 data-firtitle="{lang('Cравнить','newLevel')}"
                                                 data-sectitle="{lang('В списке сравнений','newLevel')}"
                                                 data-rel="tooltip">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox">
                                                </span>
                                                <span class="text-el d_l">{lang('Cравнить','newLevel')}</span>
                                            </div>
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
                        <div class="social-product">
                            <div class="social-like d_i-b">
                                {//echo $CI->load->module('share')->_make_like_buttons()}
                            </div>
                            <div class="social-tell d_i-b">
                                {//echo $CI->load->module('share')->_make_share_form()}
                            </div>
                        </div>
                        <!-- End. Share -->
                    </div>
                </div><!-- frame. left-product-* -->
                <!-- Start. Kit-->
                {if count($model->getShopKitsLoggedUsersCheck($CI->dx_auth->is_logged_in())) > 0}
                    <div class="title-complect">
                        <div class="frame-title">
                            <div class="title">{lang('В комплекте дешевле','newLevel')}</div>
                        </div>
                    </div>
                    <section class="frame-complect horizontal-carousel">
                        <div class="carousel-js-css items-carousel complects-carousel">
                            <div class="content-carousel">
                                <ul class="items-complect items">
                                    {foreach $model->getShopKitsLoggedUsersCheck($CI->dx_auth->is_logged_in()) as $key => $kitProducts}
                                        {$inCart = getAmountInCart('ShopKit', $kitProducts->getId())}
                                        <li class="globalFrameProduct{if $inCart} in-cart{else:} to-cart{/if}">
                                            <ul class="items row-kits rowKits items-product">
                                                <!-- main product -->
                                                <li>
                                                    <div class="frame-kit main-product">
                                                        <div class="frame-photo-title">
                                                            <span class="photo-block">
                                                                <span class="helper"></span>
                                                                <img src="{echo $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
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
                                                                                <span class="price addCurrPrice">{echo $kitProducts->getMainProductPrice($NextCSId)}</span>
                                                                                <span class="curr-add">{$NextCS}</span>
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
                                                                                    <span class="price addCurrPrice">{echo $kitProduct->getKitNewPrice($NextCSId)}</span>
                                                                                    <span class="curr-add">{$NextCS}</span>
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
                                                                        <span class="price">{echo $kitProducts->getTotalPrice($NextCSId)}</span>
                                                                        <span class="curr-add">{$NextCS}</span>
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
                {/if}
                <!-- End. Kits-->
                <div class="frame-view-product clearfix">
                    <div class="left-view-product">
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
                    <div class="right-view-product">
                        {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($model)}
                            <div class="inside-padd">
                                <div class="title-default">
                                    <div class="frame-title">
                                        <div class="title">{lang('Характеристики','newLevel')}</div>
                                    </div>
                                </div>
                                <div class="characteristic">
                                    <table>
                                        <tbody>
                                            {foreach $dl_properties as $prop}
                                                <tr>
                                                    <th><span class="text-el">{echo $prop.Name}</span></th>
                                                    <td><span class="text-el">{echo $prop.Value}</span></td>
                                                </tr>
                                            {/foreach}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        {/if}
                        {$fullDescription = $model->getFullDescription()}
                        {if $fullDescription != ''}
                            <div class="inside-padd">
                                <!--                        Start. Description block-->
                                <div class="product-descr patch-product-view">
                                    <div class="text">
                                        <div class="title-default">
                                            <div class="frame-title">
                                                <div class="title">{lang('Описание' , 'newLevel')}</div>
                                            </div>
                                        </div>
                                        <h2>{echo  ShopCore::encode($model->getName())}</h2>
                                        {echo $fullDescription}
                                    </div>
                                </div>
                                <!--                        End. Description block-->
                            </div>
                        {/if}

                        {if $accessories}
                            <div class="accessories">
                                <div class="title-default">
                                    <div class="frame-title">
                                        <div class="title">{lang('Аксессуары','newLevel')}</div>
                                    </div>
                                </div>
                                <div class="inside-padd">
                                    <ul class="items items-default items-product">
                                        {$CI->load->module('new_level')->OPI($accessories, array('opi_defaultItem'=>true))}
                                    </ul>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    initDownloadScripts(['cusel-min-2.5', 'cloud-zoom.1.0.3.min', '_product'], 'initPhotoTrEv', 'initPhotoTrEv');
</script>
<div style="display: none;">
    <img src="{echo $model->firstVariant->getLargePhoto()}" alt="{echo ShopCore::encode($model->getName())}" class="vImgPr"/>
    {foreach $productImages as $key => $image}
        <img src="{productImageUrl('products/additional/'.$image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
    {/foreach}
</div>