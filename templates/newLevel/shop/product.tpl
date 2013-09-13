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
<div class="frame-crumbs">
    <!-- Making bread crumbs -->
    {widget('path')}
</div>
<div class="frame-inside page-product">
    <div class="container">
        <div class="clearfix item-product {if $model->firstVariant->getStock() == 0}not-avail{/if}">
            <div class="f-s_0 title-product">
                <div class="frame-title">
                    <h1 class="d_i">{echo  ShopCore::encode($model->getName())}</h1>
                </div>
                <span class="frame-variant-name-code">
                    <span class="frame-variant-code" {if !$model->firstVariant->getNumber()}style="display:none;"{/if}>
                        {lang('Артикул:','newLevel')}:
                        <span class="code">
                            {if $model->firstVariant->getNumber()}
                                {trim($model->firstVariant->getNumber())}
                            {/if}
                        </span>
                    </span>
                    <span class="frame-variant-name" {if !$model->firstVariant->getName()}style="display:none;"{/if}>
                        {lang('Вариант','newLevel')}:
                        <span class="code">
                            {if $model->firstVariant->getName()}
                                {trim($model->firstVariant->getName())}
                            {/if}
                        </span>
                    </span>
                </span>
            </div>
            <div class="right-product">
                <div id="xBlock"></div>
                <div class="right-product-left">
                    <div class="f-s_0 buy-block">
                        <!--Select variant -->
                        {$variants = $model->getProductVariants()}
                        {if count($variants) > 1}
                            <div class="check-variant-product">
                                <div class="title">{lang('Выберите вариант','newLevel')}:</div>
                                <div class="lineForm">
                                    <select name="variant" id="variantSwitcher">
                                        {foreach $model->getProductVariants() as $key => $productVariant}
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
                        <!--End. Select variant -->
                        <div class="frame-prices-buy-wish-compare">
                            <div class="frame-prices-buy f-s_0">
                                <!-- $model->hasDiscounts() - check for a discount. And show old price-->
                                <div class="frame-prices f-s_0">
                                    <!-- Check for discount-->
                                    {$oldoprice = $model->getOldPrice() && $model->getOldPrice() != 0 && $model->getOldPrice() > $model->firstVariant->toCurrency()}
                                    {$hasDiscounts = $model->hasDiscounts()}
                                    {if $hasDiscounts}
                                        <span class="price-discount">
                                            <span>
                                                <span class="price priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')}</span>
                                                <span class="curr">{$CS}</span>
                                            </span>
                                        </span>
                                    {/if}
                                    {if $oldoprice && !$hasDiscounts}
                                        <span class="price-discount">
                                            <span>
                                                <span class="price priceOrigVariant">{echo $model->getOldPrice()}</span>
                                                <span class="curr">{$CS}</span>
                                            </span>
                                        </span>
                                    {/if}
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
                                <!-- Start button for main & variants prod -->
                                <div class="funcs-buttons">
                                    {foreach $variants as $key => $productVariant}
                                        {if $productVariant->getStock() > 0}
                                            {$discount = 0}
                                            {if $hasDiscounts}
                                                {$discount = $productVariant->getvirtual('numDiscount')/$productVariant->toCurrency()*100}
                                            {/if}
                                            <div class="frame-count-buy variant_{echo $productVariant->getId()} variant" {if $key != 0}style="display:none"{/if}>
                                                <div class="frame-count">
                                                    <div class="number" data-title="{lang('Количество на складе','newLevel')} {echo $productVariant->getstock()}" data-prodid="{echo $model->getId()}" data-varid="{echo $productVariant->getId()}" data-rel="frameplusminus">
                                                        <div class="frame-change-count">
                                                            <div class="btn-plus">
                                                                <button type="button">
                                                                    <span class="icon-plus"></span>
                                                                </button>
                                                            </div>
                                                            <div class="btn-minus">
                                                                <button type="button">
                                                                    <span class="icon-minus"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <input type="text" value="1" data-rel="plusminus" data-title="{lang('Только цифры','newLevel')}" data-min="1" data-max="{echo $productVariant->getstock()}">
                                                    </div>
                                                </div>
                                                <div class="btn-buy btn-buy-p">
                                                    <button class="btnBuy infoBut"
                                                            type="button"
                                                            data-id="{echo $productVariant->getId()}"
                                                            data-prodid="{echo $model->getId()}"
                                                            data-varid="{echo $productVariant->getId()}"
                                                            data-price="{echo $productVariant->toCurrency()}"
                                                            data-count="1"
                                                            data-name="{echo ShopCore::encode($model->getName())}"
                                                            data-vname="{echo trim(ShopCore::encode($productVariant->getName()))}"
                                                            data-maxcount="{echo $productVariant->getstock()}"
                                                            data-number="{echo trim($productVariant->getNumber())}"
                                                            data-url="{echo shop_url('product/'.$model->getUrl())}"
                                                            data-img="{echo $productVariant->getSmallPhoto()}"
                                                            data-mainImage="{echo $productVariant->getMainPhoto()}"
                                                            data-largeImage="{echo $productVariant->getlargePhoto()}"
                                                            data-origPrice="{if $model->hasDiscounts()}{echo $productVariant->toCurrency('OrigPrice')}{/if}"
                                                            data-addPrice="{if $NextCSIdCond}{echo $productVariant->toCurrency('Price',$NextCSId)}{/if}"
                                                            data-prodStatus='{json_encode(promoLabelBtn($model->getAction(), $model->getHot(), $model->getHit(), $discount))}'
                                                            >
                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                        <span class="text-el">{lang('Купить')}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        {else:}
                                            <div class="d_i-b v-a_m">
                                                <div class="variant_{echo $productVariant->getId()} variant" {if $key != 0}style="display:none"{/if}>
                                                    <div class="alert-exists">{lang('Нет в наличии','newLevel')}</div>
                                                    <div class="btn-not-avail">
                                                        <button
                                                            type="button"
                                                            data-drop=".drop-report"
                                                            data-source="/shop/ajax/getNotifyingRequest"

                                                            data-id="{echo $productVariant->getId()}"
                                                            data-prodid="{echo $model->getId()}"
                                                            data-varid="{echo $productVariant->getId()}"
                                                            data-name="{echo ShopCore::encode($model->getName())}"
                                                            data-vname="{echo trim(ShopCore::encode($productVariant->getName()))}"
                                                            data-maxcount="{echo $productVariant->getstock()}"
                                                            data-number="{echo trim($productVariant->getNumber())}"
                                                            data-mainImage="{echo $productVariant->getMainPhoto()}"
                                                            data-largeImage="{echo $productVariant->getlargePhoto()}"
                                                            class="infoBut">
                                                            <span class="icon-but"></span>
                                                            <span class="text-el">{lang('Сообщить о появлении','newLevel')}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    {/foreach}
                                </div>
                            </div>
                            <!-- end. frame-prices-buy -->
                            <div class="frame-wish-compare-list f-s_0">
                                <!-- Wish List buttons -->
                                {foreach $variants as $key => $pv}
                                    <div class="frame-btn-wish variant_{echo $pv->getId()} variant" {if $key != 0}style="display:none"{/if} data-id="{echo $model->getId()}" data-varid="{echo $pv->getId()}">
                                        {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
                                    </div>
                                {/foreach}
                                <!-- end of Wish List buttons -->
                                <!-- compare buttons -->
                                <div class="frame-btn-compare">
                                    <div class="btn-compare" data-prodid="{echo $model->getId()}">
                                        <button class="toCompare"
                                                data-prodid="{echo $model->getId()}"
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
                                <!-- end of compare buttons -->
                            </div>
                            <!-- End button for main & variants prod -->
                        </div>
                        <!-- end. frame-prices-buy-wish-compare -->
                    </div>
                    <!-- end. buy-block -->
                    <!-- Start. Description -->
                    {//if trim($model->getShortDescription()) != ''}
                    {if false}
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
                <!-- end. right-product-left -->
                <div class="right-product-right">
                    <!--Start. Payments method form -->
                    {widget('payments_delivery_methods_info')}
                    <!--End. Payments method form -->
                </div>
            </div>
            <div class="left-product">
                {$sizeAddImg = sizeof($productImages = $model->getSProductImagess())}
                <a rel="position: 'xBlock'" onclick="return false;" href="{echo $model->firstVariant->getLargePhoto()}" class="frame-photo-title photoProduct cloud-zoom" id="photoGroup" title="{echo ShopCore::encode($model->getName())}">
                    <span class="photo-block">
                        <span class="helper"></span>
                        <img src="{echo $model->firstVariant->getMainPhoto()}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" class="vimg" title="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}"/>
                        {$discount = 0}
                        {if $hasDiscounts}
                            {$discount = $model->firstVariant->getvirtual('numDiscount')/$model->firstVariant->toCurrency('origprice')*100}
                        {/if}
                        {promoLabel($model->getAction(), $model->getHot(), $model->getHit(), $discount)}
                    </span>
                </a>
                <!-- End. Photo block-->
                <!-- Star rating -->
                {if $model->enable_comments && $Comments[$model->getId()] !== 0}
                    <div class="frame-star t-a_j">
                        {$CI->load->module('star_rating')->show_star_rating($model, false)}
                        <div class="d-i_b">

                            <span class="s-t">{lang('Оставить отзыв','newLevel')}</span>
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
                <!--Additional images-->
                {if $sizeAddImg > 0}
                    <ul data-rel="mainThumbPhoto">
                        <li class="d_n">
                            <a {/*rel="group"*/} href="{echo $model->firstVariant->getLargePhoto()}" title="{echo ShopCore::encode($model->getName())}">
                                <span class="photo-block">
                                    <span class="helper"></span>
                                    <img src="{echo $model->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($model->getName())}"/>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="horizontal-carousel">
                        <div class="frame-thumbs carousel_js">
                            {/*carousel_js*/}
                            <div class="content-carousel">
                                <ul class="items-thumbs items">
                                    <!--if cloudzoom-->
                                    <li class="active">
                                        <a rel="useZoom: 'photoGroup', smallImage: '{echo $model->firstVariant->getMainPhoto()}'" href="{echo $model->firstVariant->getLargePhoto()}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="{echo $model->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($model->getName())}"/>
                                            </span>
                                        </a>
                                    </li>
                                    <!--if cloudzoom -->
                                    {foreach $productImages as $key => $image}
                                        <li>
                                            <a {/*rel="group"*/} rel="useZoom: 'photoGroup', smallImage: '{productImageUrl('products/additional/'.$image->getImageName())}'" href="{productImageUrl('products/additional/'.$image->getImageName())}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery">
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
                {/if}
                <!--End block-->
            </div>
        </div>
    </div>
    <div class="frame-benefits-product">
        <div class="frame-benefits">
            {widget('benefits')}
        </div>
    </div>
    <!--Kit start-->

    {if $model->getShopKits()}
        {if $model->getShopKits()->count() > 0}
            <div class="container">
                <section class="frame-complect horizontal-carousel">
                    <div class="title-complect">
                        <div class="title">{lang('Специальное предложение! Купить установить и получить скидку на аксессуары!','newLevel')}</div>
                    </div>
                    <div class="carousel_js products-carousel complects-carousel">
                        <div class="content-carousel">
                            <ul class="items-complect items">
                                {foreach $model->getShopKits() as $key => $kitProducts}
                                    <li>
                                        <ul class="items items-bask row-kits">
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
                                                <div class="btn-buy">
                                                    <button class="btnBuy" type="button"
                                                            data-prodid="{echo json_encode(array_merge($kitProducts->getProductIdCart()))}"
                                                            data-price="{echo $kitProducts->getTotalPrice()}"
                                                            data-prices ="{echo json_encode($kitProducts->getPriceCart())}"
                                                            data-addprice="{if $NextCSIdCond}{echo $kitProducts->getTotalPrice($NextCSId)}{/if}"
                                                            data-addprices="{if $NextCSIdCond}{echo json_encode($kitProducts->getPriceCart($NextCSId))}{/if}"
                                                            data-origprices='{echo json_encode($kitProducts->getOrigPriceCart())}'
                                                            data-origprice='{echo $kitProducts->getTotalPriceOld()}'
                                                            data-name="{echo ShopCore::encode(json_encode($kitProducts->getNamesCart()))}"
                                                            data-kit="true"
                                                            data-kitId="{echo $kitProducts->getId()}"
                                                            data-varid="{echo $kitProducts->getMainProduct()->firstVariant->getId()}"
                                                            data-url='{echo json_encode($kitProducts->getUrls())}'
                                                            data-img='{echo json_encode($kitProducts->getImgs())}'
                                                            data-maxcount='{echo $kitProduct->getSProducts()->firstVariant->getStock()}'
                                                            data-prodstatus='{json_encode($kitProducts->getKitStatus())}'
                                                            >
                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                        <span class="text-el">{lang('Купить')}</span>
                                                    </button>
                                                </div>
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
    {/if}
    <!--        End. Buy kits-->
    <div class="container f-s_0">
        <!--        Start. Tabs block       -->
        <ul class="tabs tabs-data tabs-product">
            <li class="active">
                <button data-href="#view">{lang('Обзор','newLevel')}</button>
            </li>
            {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}

                <li><button data-href="#first" data-source="{shop_url('product_api/renderProperties')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}{literal}}{/literal}' data-selector=".characteristic">{lang('Свойства','newLevel')}</button></li>
                {/if}
                {if $fullDescription = $model->getFullDescription()}
                <li><button data-href="#second" data-source="{shop_url('product_api/renderFullDescription')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}{literal}}{/literal}' data-selector=".inside-padd > .text">{lang('Полное описание','newLevel')}</button></li>
                {/if}
                {if $accessories}
                <li><button data-href="#fourth" data-source="{shop_url('product_api/getAccessories')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}{literal}}{/literal}' data-selector=".inside-padd > .items">{lang('Аксессуары','newLevel')}</button></li>
                {/if}
            <!--Output of the block comments-->
            {if $Comments && $model->enable_comments}
                <li>
                    <button type="button" data-href="#comment" onclick="renderPosts($('#comment .inside-padd'))">
                        <span class="icon_comment-tab"></span>
                        <span class="text-el">
                            <span id="cc">
                                {if $Comments[$model->getId()][0] !== '0'}
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
                        <h2>{lang('Свойства','newLevel')}</h2>
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

                <div class="inside-padd">
                    <!--Start. Comments block-->
                    <div class="frame-form-comment">
                        {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
                        <div class="for_comments">
                            {echo $c['comments']}
                        </div>
                        <!--End. Comments block-->
                    </div>
                </div>
                {if $accessories}
                    <div class="accessories">
                        <div class="title-default">
                            <div class="title">
                                <h2 class="d_i">{lang('Аксессуары','newLevel')} {echo $model->getName()}</h2>
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
                                {$CI->load->module('new_level')->OPI($accessories, array('defaultItem'=>true, 'limit'=>4))}
                            </ul>
                        </div>
                    </div>
                {/if}
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
                <div class="inside-padd for_comments">
                    <div class="preloader"></div>
                </div>
            </div>
            <!--Block Accessories Start-->
            {if $accessories}
                <div id="fourth" class="accessories">
                    <div class="inside-padd">
                        <div class="title-h2">{lang('Аксессуары','newLevel')} {echo $model->getName()}</div>
                        <ul class="items items-default">
                            <div class="preloader"></div>
                        </ul>
                    </div>
                </div>
            {/if}
            <!--End. Block Accessories-->
        </div>
    </div>
    <!-- End. Tabs block       -->
</div>
</div>
<div class="horizontal-carousel">
    {widget('similar')}
</div>
{widget('latest_news')}
<script type="text/javascript">
                    var hrefCategoryProduct = "{$category_url}";
</script>
{literal}
    <script type="text/javascript">
        var
                //productPhotoFancybox = true,
                productPhotoDrop = true,
                productPhotoCZoom = true,
                forThumbFancybox = "body{background-color:#fff;text-align: center;height:100%;margin:0;}img{height: auto; max-width: 100%; vertical-align: middle; border: 0; width: auto\9;max-height: 100%; -ms-interpolation-mode: bicubic; }.helper{vertical-align: middle;width: 0;height: 100%;padding: 0 !important;border: 0 !important;display: inline-block;}.helper + *{vertical-align: middle;display: inline-block;word-break: break-word;}";
    </script>
{/literal}
{/*
<script type="text/javascript" src="{$THEME}js/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="{$THEME}css/fancybox.css" media="all" />
*/}
<script type="text/javascript" src="{$THEME}js/cloud-zoom.1.0.3.min.js"></script>
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
<div class="drop drop-style" id="photo">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title"></div>
    </div>
    <div class="drop-content-photo">
        <div class="inside-padd">
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
    </div>
</div>
