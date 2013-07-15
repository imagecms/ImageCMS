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
<div class="frame-crumbs">
    <!-- Making bread crumbs -->
    {widget('path')}
</div>
<div class="frame-inside page-product">
    <div class="container">
        <div class="clearfix item-product">
            <div class="f-s_0 title-product">
                <div class="frame-title">
                    <h1 class="d_i">{echo  ShopCore::encode($model->getName())}</h1>
                </div>
                <span class="frame-variant-name-code">
                    <span class="frame-variant-code" {if !$model->firstVariant->getNumber()}style="display:none;"{/if}>
                        Код товара: 
                        <span class="code">
                            {if $model->firstVariant->getNumber()}
                                {trim($model->firstVariant->getNumber())}
                            {/if}
                        </span>
                    </span>
                    <span class="frame-variant-name" {if !$model->firstVariant->getName()}style="display:none;"{/if}>
                        Вариант: 
                        <span class="code">
                            {if $model->firstVariant->getName()}
                                {trim($model->firstVariant->getName())}
                            {/if}
                        </span>
                    </span>
                </span>
            </div>
            <div class="right-product">
                {/* if cloudzoom*/}
                <div id="xBlock"></div>
                {/*/ if cloudzoom*/}
                <div class="right-product-left">
                    <div class="f-s_0 buy-block">
                        <!--Select variant -->
                        {$variants = $model->getProductVariants()}
                        {if count($variants) > 1}
                            <div class="check-variant-product">
                                <div class="title">Выбор варианта:</div>
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
                                    {if $model->hasDiscounts()}
                                        <span class="price-discount">
                                            <span>
                                                <span class="price priceOrigVariant">{echo $model->firstVariant->toCurrency('OrigPrice')}</span>
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
                                            {if $NextCSId != null}
                                                <span class="price-add">
                                                    <span>
                                                        (<span class="price addCurrPrice">{echo $model->firstVariant->toCurrency('Price',1)}</span>
                                                        <span class="curr-add">{$NextCs}</span>)
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
                                            {if $model->getOldPrice() > $model->firstVariant->getPrice()}
                                                {$discount = round(100 - ($model->firstVariant->getPrice() / $model->getOldPrice() * 100))}
                                            {else:}
                                                {$discount = 0}
                                            {/if}
                                            <div class="frame-count-buy variant_{echo $productVariant->getId()} variant" {if $key != 0}style="display:none"{/if}>
                                                <div class="frame-count">
                                                    <div class="number" data-title="количество на складе {echo $productVariant->getstock()}" data-prodid="{echo $model->getId()}" data-varid="{echo $productVariant->getId()}" data-rel="frameplusminus">
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
                                                        <input type="text" value="1" data-rel="plusminus" data-title="только цифры" data-min="1" data-max="{echo $productVariant->getstock()}">
                                                    </div>
                                                </div>
                                                <div class="btn-buy btn-buy-p">
                                                    <button class="btnBuy infoBut"
                                                            type="button"
                                                            data-id="{echo $productVariant->getId()}"
                                                            data-prodid="{echo $model->getId()}"
                                                            data-varid="{echo $productVariant->getId()}"
                                                            data-price="{echo $productVariant->toCurrency()}"
                                                            data-name="{echo ShopCore::encode($model->getName())}"
                                                            data-vname="{echo ShopCore::encode($productVariant->getName())}"
                                                            data-maxcount="{echo $productVariant->getstock()}"
                                                            data-number="{echo $productVariant->getNumber()}"
                                                            data-img="{echo $productVariant->getSmallPhoto()}"
                                                            data-mainImage="{echo $productVariant->getMainPhoto()}"
                                                            data-largeImage="{echo $productVariant->getlargePhoto()}"
                                                            data-origPrice="{if $model->hasDiscounts()}{echo $productVariant->toCurrency('OrigPrice')}{/if}"
                                                            data-addPrice="{echo $productVariant->toCurrency('Price',1)}"
                                                            data-prodStatus='{json_encode(promoLabelBtn($model->getAction(), $model->getHot(), $model->getHit(), $discount))}'
                                                            >
                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                        <span class="text-el">{lang('s_buy')}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        {else:}
                                            <div class="d_i-b v-a_m">
                                                <div class="variant_{echo $productVariant->getId()} variant" {if $key != 0}style="display:none"{/if}>
                                                    <div class="alert-exists">Товара пока нет в наличии</div>
                                                    <div class="btn-not-avail">
                                                        <button
                                                            type="button"
                                                            data-drop=".drop-report"
                                                            data-source="/shop/ajax/getNotifyingRequest"
                                                            data-id="{echo $productVariant->getId()}"
                                                            data-prodid="{echo $model->getId()}"
                                                            data-varid="{echo $productVariant->getId()}"
                                                            data-name="{echo ShopCore::encode($model->getName())}"
                                                            data-vname="{echo ShopCore::encode($productVariant->getName())}"
                                                            data-maxcount="{echo $productVariant->getstock()}"
                                                            data-number="{echo $productVariant->getNumber()}"
                                                            data-img="{echo $productVariant->getSmallPhoto()}"
                                                            data-mainImage="{echo $productVariant->getMainPhoto()}"
                                                            data-largeImage="{echo $productVariant->getlargePhoto()}"
                                                            class="infoBut">
                                                            <span class="icon-but"></span>
                                                            <span class="text-el">{lang('s_message_o_report')}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    {/foreach}
                                </div>
                            </div>
                            <!-- end. frame-prices-buy -->
                            <div class="frame-wish-compare-list">
                                <!-- Wish List buttons --------------------->
                                {foreach $variants as $key => $productVariant}
                                    <div {if $key != 0}style="display:none"{/if} class="btn-wish variant_{echo $productVariant->getId()} variant">
                                        <button class="toWishlist"
                                                data-price="{echo $productVariant->toCurrency()}"
                                                data-prodid="{echo $model->getId()}"
                                                data-varid="{echo $productVariant->getId()}"
                                                type="button"
                                                data-title="{lang('s_add_to_wish_list')}"
                                                data-firtitle="{lang('s_add_to_wish_list')}"
                                                data-sectitle="{lang('s_in_wish_list')}"
                                                data-rel="tooltip">
                                            <span class="icon_wish"></span>
                                            <span class="text-el d_l">{lang('s_add_to_wish_list')}</span>
                                        </button>
                                    </div>
                                {/foreach}
                                <!-- end of Wish List buttons -------------->
                                <!-- compare buttons ----------------------->
                                <div class="btn-compare" data-prodid="{echo $model->getId()}">
                                    <button class="toCompare"
                                            data-prodid="{echo $model->getId()}"
                                            type="button"
                                            data-title="{lang('s_add_to_compare')}"
                                            data-firtitle="{lang('s_add_to_compare')}"
                                            data-sectitle="{lang('s_in_compare')}"
                                            data-rel="tooltip">
                                        <span class="icon_compare"></span>
                                        <span class="text-el d_l">{lang('s_add_to_compare')}</span>
                                    </button>
                                </div>
                                <!-- end of compare buttons ---------------->
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
                        <dt class="s-t text-social-like">Понравился товар?</dt>
                        <dd class="social-like">
                            {echo $CI->load->module('share')->_make_like_buttons()}
                        </dd>
                        <dt class="s-t text-social-tell">Рассказать друзьям:</dt>
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
                <a rel="group" href="{echo $model->firstVariant->getLargePhoto()}" class="frame-photo-title photoProduct cloud-zoom" id="photoGroup" title="{echo ShopCore::encode($model->getName())}">
                    {/*rel="position: 'xBlock'" */}
                    <span class="photo-block">
                        <span class="helper"></span>
                        <img src="{echo $model->firstVariant->getMainPhoto()}" alt="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}" class="vimg" title="{echo ShopCore::encode($model->getName())} - {echo $model->getId()}"/>
                        {promoLabel($model->getAction(), $model->getHot(), $model->getHit(), $discount)}
                    </span>
                </a>
                <!-- End. Photo block-->
                <!-- Star rating -->
                {if $Comments[$model->getId()][0] != '0' && $model->enable_comments}
                    <div class="frame-star t-a_j">
                        {$CI->load->module('star_rating')->show_star_rating($model)}
                        <div class="d-i_b">
                            <span class="s-t">Покупатели оставили</span>
                            <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-response d_l">{$Comments[$model->getId()]}</button>
                        </div>
                    </div>
                {else:}
                    <div class="frame-star t-a_j">
                        <div class="d_i-b">
                            <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-null-response d_l">Оставьте отзыв</button>
                        </div>
                    </div>
                {/if}
                <!-- End. Star rating-->
                <!--Additional images-->
                {if sizeof($productImages = $model->getSProductImagess()) > 0}
                    <ul data-rel="mainThumbPhoto">
                        <li class="d_n">
                            <a rel="group" href="{echo $model->firstVariant->getLargePhoto()}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery">
                                {/*rel="useZoom: 'photoGroup', smallImage: '{productImageUrl('products/additional/'.$image->getImageName())}'"*/}
                                <span class="photo-block">
                                    <span class="helper"></span>
                                    <img src="{echo $model->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="horizontal-carousel">
                        <div class="frame-thumbs carousel_js">
                            {/*carousel_js*/}
                            {/*if mask-carousel*/}
                            <div class="content-carousel">
                                <ul class="items-thumbs items">
                                    {foreach $productImages as $key => $image}
                                        <li>
                                            <a rel="group" href="{productImageUrl('products/additional/'.$image->getImageName())}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery">
                                                {/*rel="useZoom: 'photoGroup', smallImage: '{productImageUrl('products/additional/'.$image->getImageName())}'"*/}
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
    <!--Kit start-->
    {if $model->getShopKits()->count() > 0}             
        <div class="container">
            <section class="frame-complect horizontal-carousel">
                <div class="title-complect">
                    <div class="title">Акционное предложение! Купи комплект сейчас со скидкой на аксессуары!</div>
                </div>
                <div class="carousel_js products-carousel complects-carousel">
                    <div class="content-carousel">
                        <ul class="items-complect items">
                            {foreach $model->getShopKits() as $key => $kitProducts}
                                {$arrUrl = array()}
                                {$arrImg = array()}
                                <li>
                                    <ul class="items items-bask row-kits">
                                        <!-- main product -->
                                        <li>
                                            <div class="frame-kit main-product">
                                                <div class="frame-photo-title">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="{echo $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
                                                        {if $model->getOldPrice() > $model->firstVariant->getPrice()}
                                                            {$discount = round(100 - ($model->firstVariant->getPrice() / $model->getOldPrice() * 100))}
                                                        {else:}
                                                            {$discount = 0}
                                                        {/if}
                                                        {promoLabel($model->getAction(), $model->getHot(), $model->getHit(), $discount)}
                                                    </span>
                                                    <span class="title">{echo ShopCore::encode($model->getName())}</span>
                                                </div>
                                                <div class="description">
                                                    <div class="frame-prices f-s_0">
                                                        <!-- Start. Product price-->
                                                        {if $model->firstVariant->toCurrency() > 0}
                                                            <span class="current-prices f-s_0">
                                                                <span class="price-new">
                                                                    <span>
                                                                        <span class="price priceVariant">{echo $kitProducts->getMainProductPrice()}</span>
                                                                        <span class="curr">{$CS}</span>
                                                                    </span>
                                                                </span>
                                                                {if $NextCSId != null}
                                                                    <span class="price-add">
                                                                        <span>
                                                                            (<span class="price addCurrPrice">{echo $kitProducts->getMainProductPrice('Price',1)}</span>
                                                                            <span class="curr-add">{$NextCs}</span>)
                                                                        </span>
                                                                    </span>
                                                                {/if}
                                                            </span>
                                                        {/if}
                                                        <!-- End. Product price-->
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        {$arrUrl[] = shop_url('product/' . $kitProducts->getMainProduct()->getUrl())}
                                        {$arrImg[] = $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}
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
                                                            {if $model->getOldPrice() > $model->firstVariant->getPrice()}
                                                                {$discount = round(100 - ($model->firstVariant->getPrice() / $model->getOldPrice() * 100))}
                                                            {else:}
                                                                {$discount = 0}
                                                            {/if}
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
                                                                        <span class="price priceOrigVariant">{//echo $kitProduct->getBeforePrice()}</span>
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
                                                                    {if $NextCSId != null}
                                                                        <span class="price-add">
                                                                            <span>
                                                                                (<span class="price addCurrPrice">{echo $model->firstVariant->toCurrency()}</span>
                                                                                <span class="curr-add">{$NextCs}</span>)
                                                                            </span>
                                                                        </span>
                                                                    {/if}
                                                                </span>
                                                            {/if}
                                                            <!-- End. Product price-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            {$arrUrl[] = shop_url('product/' . $kitProduct->getSProducts()->getUrl())}
                                            {$arrImg[] = $kitProduct->getSProducts()->firstVariant->getSmallPhoto()}
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
                                                        <span class="price">{echo $kitProducts->getAllPriceBefore()}</span>
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
                                                    {if $NextCSId != null}
                                                        <span class="price-add">
                                                            <span>
                                                                (<span class="price">{echo $kitProducts->getTotalPrice()}</span>
                                                                <span class="curr-add">{$NextCs}</span>)
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
                                                        data-addprice="{echo $kitProducts->getTotalPrice()}"
                                                        data-addprices="{echo json_encode($kitProducts->getPriceCart())}"
                                                        data-name="{echo ShopCore::encode(json_encode($kitProducts->getNamesCart()))}"
                                                        data-kit="true"
                                                        data-kitId="{echo $kitProducts->getId()}"
                                                        data-varid="{echo $kitProducts->getMainProduct()->firstVariant->getId()}"
                                                        data-url='{echo json_encode($arrUrl)}'
                                                        data-img='{echo json_encode($arrImg)}'
                                                        data-maxcount='{echo $kitProduct->getSProducts()->firstVariant->getStock()}'
                                                        >
                                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                                    <span class="text-el">{lang('s_buy')}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /total -->
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    <!--                        Start. Buttons for next/prev kit-->
                    <div class="group-button-carousel">
                        <button type="button" class="prev arrow">
                            <span class="icon_arrow_p"></span>
                        </button>
                        <button type="button" class="next arrow">
                            <span class="icon_arrow_n"></span>
                        </button>
                    </div>
                    <!--                        Start. Buttons for next/prev kit-->
                </div>
            </section>
        </div>
    {/if}
    <!--        End. Buy kits-->
    <div class="container f-s_0">
        <!--        Start. Tabs block       -->
        <ul class="tabs tabs-data">
            <li>
                <button data-href="#view">Обзор</button>
            </li>
            {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}
                <li><button data-href="#first" onclick="ProductTabs.renderProperties('{echo $model->getId()}')">Характеристики</button></li>
                {/if}
                {if trim($model->getShortDescription()) != ''}
                <li><button data-href="#second" onclick="ProductTabs.renderFullDescription('{echo $model->getId()}')">Полное описание</button></li>
                {/if}
                {if $accessories}     
                <li><button data-href="#fourth">Аксессуары</button></li>
                {/if}
            <!--Output of the block comments-->
            {if $Comments && $model->enable_comments}
                <li>
                    <button type="button" data-href="#comment" onclick="renderPosts($('#for_comments_tabs'))">
                        <span class="icon_comment-tab"></span>
                        <span class="text-el">                    
                            <span id="cc">
                                {if $Comments[$model->getId()][0] !== '0'}
                                    {echo $Comments[$model->getId()]}
                                {else:}
                                    Оставить отзыв
                                {/if}
                            </span>
                        </span>
                    </button>
                </li>
            {/if}
        </ul>
        <div class="frame-tabs-ref frame-tabs-product">
            <div id="view">
                <!--             Start. Characteristic-->                 
                <div class="inside-padd">
                    <h3>Характеристики</h3>
                    <div class="characteristic">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Краткие характеристики</th>
                                    <td>Экран 11.6'' (1366x768) HD LED, глянцевый </td>
                                </tr>
                                <tr>
                                    <th>Экран</th>
                                    <td>11.6" (1366x768) WXGA</td>
                                </tr>
                                <tr>
                                    <th>Процессор</th>
                                    <td>Двухъядерный AMD Dual-Core C-60 (1.0 -1.33 ГГц)</td>
                                </tr>
                                <tr>
                                    <th>Объем оперативной памяти</th>
                                    <td>2 ГБ</td>
                                </tr>
                                <tr>
                                    <th>Тип оперативной памяти</th>
                                    <td>DDR3-1066</td>
                                </tr>
                                <tr>
                                    <th>Чипсет</th>
                                    <td>AMD A68M Fusion</td>
                                </tr>
                                {/*echo $dl_properties*/}
                            </tbody>
                        </table>
                        {if 10 > 6}
                            <button class="t-d_n f-s_0 s-all-d ref" data-trigger="[data-href='#first']" data-scroll="true">
                                <span class="icon_arrow"></span>
                                <span class="text-el">Смотреть все характеристики</span>
                            </button>
                        {/if}
                    </div>
                </div>

                <div class="inside-padd">
                    <!--                        Start. Description block-->
                    <div class="text">
                        <h3>{echo  ShopCore::encode($model->getName())}</h3>
                            {echo $model->getShortDescription()}
                    </div>
                    {if 10 > 6}
                        <button class="t-d_n f-s_0 s-all-d ref" data-trigger="[data-href='#second']" data-scroll="true">
                            <span class="icon_arrow"></span>
                            <span class="text-el">Смотреть полное описание</span>
                        </button>
                    {/if}
                    <!--                        End. Description block-->
                </div>

                <div class="inside-padd">
                    <!--Start. Comments block-->
                    <div class="frame-form-comment">
                        <div name="for_comments" id="for_comments_view" data-countComment="4"></div>
                        {literal}<script type="text/javascript">$(document).ready(function() {
                            renderPosts($('#for_comments_view'), {countComment: 4});
                        })</script>{/literal}
                        </div>

                        <!--End. Comments block-->
                    </div>
                    {if $accessories}
                        <div class="accessories">
                            <div class="title-default">
                                <div class="title">
                                    <h3 class="d_i">Аксессуары к {echo $model->getName()}</h3>
                                    {if count($accessories) > 4}
                                        <button class="t-d_n f-s_0 s-all-d ref s-all-marg" data-trigger="[data-href='#fourth']" data-scroll="true">
                                            <span class="icon_arrow"></span>
                                            <span class="text-el">Смотреть все аксессуры</span>
                                        </button>
                                    {/if}
                                </div>
                            </div>
                            <div class="inside-padd">
                                <ul class="items items-default">
                                    {foreach $accessories as $p}
                                        {if $p->firstVariant->getStock()}
                                            <li>
                                                <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="{echo $p->firstVariant->getDefaultPhoto()}" alt="{echo ShopCore::encode($p->getName())}"/>
                                                        {if $p->getOldPrice() > $p->firstVariant->getPrice()}
                                                            {$discount = round(100 - ($p->firstVariant->getPrice() / $p->getOldPrice() * 100))}
                                                        {else:}
                                                            {$discount = 0}
                                                        {/if}
                                                        {promoLabel($p->getAction(), $p->getHot(), $p->getHit(), $discount)}
                                                    </span>
                                                    <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                                </a>
                                                <div class="description">
                                                    <div class="frame-prices f-s_0">
                                                        <!-- Check for discount-->
                                                        {if $p->hasDiscounts()}
                                                            <span class="price-discount">
                                                                <span>
                                                                    <span class="price priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                                                                    <span class="curr">{$CS}</span>
                                                                </span>
                                                            </span>
                                                        {/if}
                                                        <!-- Start. Product price-->
                                                        {if $model->firstVariant->toCurrency() > 0}
                                                            <span class="current-prices f-s_0">
                                                                <span class="price-new">
                                                                    <span>
                                                                        <span class="price priceVariant">{echo $p->firstVariant->toCurrency()}</span>
                                                                        <span class="curr">{$CS}</span>
                                                                    </span>
                                                                </span>
                                                                {if $NextCSId != null}
                                                                    <span class="price-add">
                                                                        <span>
                                                                            (<span class="price addCurrPrice">{echo $p->firstVariant->toCurrency('Price', 1)}</span>
                                                                            <span class="curr-add">{$NextCs}</span>)
                                                                        </span>
                                                                    </span>
                                                                {/if}
                                                            </span>
                                                        {/if}
                                                        <!-- End. Product price-->
                                                    </div>
                                                    <div class="btn-buy">
                                                        <button class="btnBuy"
                                                                type="button"
                                                                data-id="{echo $p->getId()}"
                                                                data-varid="{echo $p->firstVariant->getId()}"
                                                                data-prodid="{echo $p->getId()}"
                                                                data-price="{echo $p->firstvariant->toCurrency()}"
                                                                data-name="{echo ShopCore::encode($p->getName())}"
                                                                data-vname="{echo ShopCore::encode($p->firstVariant->getName())}"
                                                                data-number="{echo $p->firstVariant->getnumber()}"
                                                                data-maxcount="{echo $p->firstVariant->getstock()}"
                                                                data-img="{echo $p->firstVariant->getSmallPhoto()}"
                                                                data-url="{echo shop_url('product/' . $p->getUrl())}"
                                                                data-origPrice="{if $p->hasDiscounts()}{echo $p->firstVariant->toCurrency('OrigPrice')}{/if}"
                                                                data-prodStatus='{json_encode(promoLabelBtn($p->getAction(), $p->getHot(), $p->getHit(), $discount))}'
                                                                >
                                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                                            <span class="text-el">{lang('s_buy')}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        {/if}
                                    {/foreach}
                                </ul>
                            </div>
                        </div>
                    {/if}
                </div>
                <!--             Start. Characteristic-->                 
                <div id="first">
                    <div class="inside-padd">
                        <h3>Характеристики</h3>
                        <div class="characteristic">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Краткие характеристики</th>
                                        <td>Экран 11.6'' (1366x768) HD LED, глянцевый </td>
                                    </tr>
                                    <tr>
                                        <th>Экран</th>
                                        <td>11.6" (1366x768) WXGA</td>
                                    </tr>
                                    <tr>
                                        <th>Процессор</th>
                                        <td>Двухъядерный AMD Dual-Core C-60 (1.0 -1.33 ГГц)</td>
                                    </tr>
                                    <tr>
                                        <th>Объем оперативной памяти</th>
                                        <td>2 ГБ</td>
                                    </tr>
                                    <tr>
                                        <th>Тип оперативной памяти</th>
                                        <td>DDR3-1066</td>
                                    </tr>
                                    <tr>
                                        <th>Чипсет</th>
                                        <td>AMD A68M Fusion</td>
                                    </tr>
                                    {/*echo $dl_properties*/}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--                    End. Characteristic-->
                <div id="second">
                    <div class="inside-padd">
                        <!--                        Start. Description block-->
                        <div class="text">
                            <h3>{echo  ShopCore::encode($model->getName())}</h3>
                            <div class="fullDescription">
                               {echo $model->getFullDescription()}
                           </div>
                        </div>
                        <!--                        End. Description block-->
                    </div>
                </div>
                <div id="comment">
                    <div class="inside-padd">
                        <!--Start. Comments block-->
                        <div class="frame-form-comment">
                            <div name="for_comments" id="for_comments_tabs">
                                <div class="preloader"></div>
                            </div>
                        </div>
                        <!--End. Comments block-->
                    </div>
                </div>
                <!--Block Accessories Start-->
                {if $accessories}
                    <div id="fourth" class="accessories">
                        <div class="inside-padd">
                            <h3>Аксессуары к {echo $model->getName()}</h3>
                            <ul class="items items-default">
                                {foreach $accessories as $p}
                                    {if $p->firstVariant->getStock()}
                                        <li>
                                            <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title">
                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                    <img src="{echo $p->firstVariant->getDefaultPhoto()}" alt="{echo ShopCore::encode($p->getName())}"/>
                                                    {if $p->getOldPrice() > $p->firstVariant->getPrice()}
                                                        {$discount = round(100 - ($p->firstVariant->getPrice() / $p->getOldPrice() * 100))}
                                                    {else:}
                                                        {$discount = 0}
                                                    {/if}
                                                    {promoLabel($p->getAction(), $p->getHot(), $p->getHit(), $discount)}
                                                </span>
                                                <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                            </a>
                                            <div class="description">
                                                <div class="frame-prices f-s_0">
                                                    <!-- Check for discount-->
                                                    {if $p->hasDiscounts()}
                                                        <span class="price-discount">
                                                            <span>
                                                                <span class="price priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                                                                <span class="curr">{$CS}</span>
                                                            </span>
                                                        </span>
                                                    {/if}
                                                    <!-- Start. Product price-->
                                                    {if $model->firstVariant->toCurrency() > 0}
                                                        <span class="current-prices f-s_0">
                                                            <span class="price-new">
                                                                <span>
                                                                    <span class="price priceVariant">{echo $p->firstVariant->toCurrency()}</span>
                                                                    <span class="curr">{$CS}</span>
                                                                </span>
                                                            </span>
                                                            {if $NextCSId != null}
                                                                <span class="price-add">
                                                                    <span>
                                                                        (<span class="price addCurrPrice">{echo $p->firstVariant->toCurrency('Price', 1)}</span>
                                                                        <span class="curr-add">{$NextCs}</span>)
                                                                    </span>
                                                                </span>
                                                            {/if}
                                                        </span>
                                                    {/if}
                                                    <!-- End. Product price-->
                                                </div>
                                                <div class="btn-buy">
                                                    <button class="btnBuy"
                                                            type="button"
                                                            data-id="{echo $p->getId()}"
                                                            data-varid="{echo $p->firstVariant->getId()}"
                                                            data-prodid="{echo $p->getId()}"
                                                            data-price="{echo $p->firstvariant->toCurrency()}"
                                                            data-name="{echo ShopCore::encode($p->getName())}"
                                                            data-vname="{echo ShopCore::encode($p->firstVariant->getName())}"
                                                            data-number="{echo $p->firstVariant->getnumber()}"
                                                            data-maxcount="{echo $p->firstVariant->getstock()}"
                                                            data-img="{echo $p->firstVariant->getSmallPhoto()}"
                                                            data-url="{echo shop_url('product/' . $p->getUrl())}"
                                                            data-origPrice="{if $p->hasDiscounts()}{echo $p->firstVariant->toCurrency('OrigPrice')}{/if}"
                                                            data-prodStatus='{json_encode(promoLabelBtn($p->getAction(), $p->getHot(), $p->getHit(), $discount))}'
                                                            >
                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                        <span class="text-el">{lang('s_buy')}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                {/if}
                <!--End. Block Accessories-->
            </div>
            <!-- End. Tabs block       -->
        </div>
    </div>
    {widget('latest_news')}