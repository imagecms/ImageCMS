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

                <div id="productTitle2"></div>
                <div class="left-product leftProduct">
                    <!-- Start. Photo block-->
                    <a rel="position: 'xBlock'" onclick="return false;" href="{echo $model->firstVariant->getLargePhoto()}" class="frame-photo-title photoProduct cloud-zoom" id="photoProduct" title="{echo ShopCore::encode($model->getName())}" data-drop="#photo" data-start="Product.initDrop" data-scroll-content="false">
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

                    <div class="horizontal-carousel photo-main-carousel">
                        <div class="group-button-carousel">
                            <button type="button" class="prev arrow d_i-b">
                                <span class="icon_arrow_p"></span>
                            </button>
                            <button type="button" class="next arrow d_i-b">
                                <span class="icon_arrow_n"></span>
                            </button>
                        </div>
                    </div>   


                    {if $sizeAddImg > 0}
                    <!-- Start. additional images-->
                    <div class="horizontal-carousel d_n">
                        <div class="frame-thumbs carousel-js-css">
                            {/*carousel-js-css*/}
                            <div class="content-carousel">
                                <ul class="items-thumbs items">
                                    <!-- Start. main image-->
                                    <li class="active">
                                        <a onclick="return false;" rel="useZoom: 'photoProduct'" href="{echo $model->firstVariant->getLargePhoto()}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery" id="mainThumb">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="{echo $model->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($model->getName())}" title="{echo ShopCore::encode($model->getName())}" class="vImgPr"/>
                                            </span>
                                        </a>
                                    </li>
                                    <!-- End. main image-->
                                    {foreach $productImages as $key => $image}
                                    <li>
                                        <a onclick="return false;" rel="useZoom: 'photoProduct'" href="{productImageUrl('products/additional/'.$image->getImageName())}" title="{echo ShopCore::encode($model->getName())}" class="cloud-zoom-gallery">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="{echo productImageUrl('products/additional/thumb_'.$image->getImageName())}" alt="{echo ShopCore::encode($model->getName())} - {echo ++$key}" title="{echo ShopCore::encode($model->getName())} - {echo ++$key}"/>
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
                    <!-- End. Photo block-->
                    <!-- Start. Star rating -->
                    {if $model->enable_comments && intval($Comments[$model->getId()]) !== 0}
                    <div class="frame-star">
                        {$CI->load->module('star_rating')->show_star_rating($model, false)}
                        <div class="d_i-b">
                            <span class="s-t">{lang('Клиенты оставили','newLevel')}</span>
                            <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-response-product">
                                {intval($Comments[$model->getId()])}
                                {echo SStringHelper::Pluralize($Comments[$model->getId()], array(lang("отзыв","newLevel"),lang("отзыва","newLevel"),lang("отзывов","newLevel")))}
                            </button>
                        </div>
                    </div>
                    {else:}
                    <div class="frame-star">
                        <div class="d_i-b">
                            <button data-trigger="[data-href='#comment']" data-scroll="true" class="d_l_1">{lang('Оставить отзыв','newLevel')}</button>
                        </div>
                    </div>
                    {/if}
                    <!-- End. Star rating-->


                </div>

                <div class="right-product">

                    <!-- Start. frame for cloudzoom -->
                    <div id="xBlock" class="mq-max mq-w-768 mq-block"></div>
                    <!-- End. frame for cloudzoom -->
                    <div class="f-s_0 title-product mq-max mq-w-768 mq-block" data-mq-max="768" data-mq-min="0" data-mq-target="#productTitle2" >

                      <!-- Start. article & variant name & brand name -->
                      <div class="frame-variant-name-code t-a_j">

                        {/*}
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
                        { */}

                        {if $model->getBrand() != null}
                        {$brand = $model->getBrand()->getName()}
                        {$hasBrand = trim($brand) != ''}

                        {if $hasBrand}
                        <a href="{shop_url('brand/'.$model->getBrand()->getUrl())}" class="t-t_u f-s_11 d_i-b">
                            {echo trim($brand)}
                        </a>
                        {/if}

                        {/if}


                        <span class="frame-variant-code frameVariantCode code d_i-b" {if !$model->firstVariant->getNumber()}style="display:none;"{/if}>
                            {lang('Код продукта','newLevel')}:
                            <span class="js-code">
                                {if $model->firstVariant->getNumber()}
                                {trim($model->firstVariant->getNumber())}
                                {/if}
                            </span>
                        </span>
                    </div>
                    <!-- End. article & variant name & brand name -->
                    <!-- Start. Name product -->
                    <div class="frame-title">
                        <h1 class="title">{echo  ShopCore::encode($model->getName())}</h1>
                    </div>
                    <!-- End. Name product -->

                </div>
                <div class="f-s_0 buy-block">
                    <div class="frame-prices-buy-wish-compare">
                        {$cV = count($variants)}
                        {foreach $variants as $key => $productVariant}
                        {if $cV > 1}
                        <span class="niceRadio b_n">
                            <input type="radio"
                            {if $key == 0}checked="checked"{/if}
                            name="variant"
                            value="{echo $productVariant->getId()}"
                            />
                        </span>
                        {/if}
                        <div class="frame-prices-buy f-s_0 {if $key != 0}no-visible{else:}visible{/if}">
                            {if $cV > 1}
                            <span class="radio-name-container d_i-b v-a_m">
                                <span class="text-el">
                                    {if $productVariant->getName()}
                                    {echo ShopCore::encode($productVariant->getName())}
                                    {else:}
                                    {echo ShopCore::encode($model->getName())}
                                    {/if}
                                </span>
                            </span>
                            {/if}

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
                                        <span class="price priceOrigVariant">{echo intval($model->toCurrency('OldPrice'))}</span>
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
                                {$discount = 0}
                                {if $hasDiscounts}
                                {$discount = $productVariant->getvirtual('numDiscount')/$productVariant->toCurrency()*100}
                                {/if}
                                {if $productVariant->getStock() > 0}
                                {$inCart = getAmountInCart('SProducts', $productVariant->getId())}
                                <div class="frame-count-buy js-variant-{echo $productVariant->getId()} js-variant">
                                    <form method="POST" action="/shop/cart/addProductByVariantId/{echo $productVariant->getId()}">
                                        <div class="frame-count frameCount">
                                            <div class="number js-number" data-title="{lang('Количество на складе','newLevel')} {echo $productVariant->getstock()}">

                                                {/*}
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
                                                { */}

                                                <input type="text" name="quantity" value="{echo $inCart ? $inCart : 1}" class="plusMinus plus-minus" data-title="{lang('Только цифры','newLevel')}" data-min="1" data-max="{echo $productVariant->getstock()}" {if $inCart}disabled="disabled"{/if}>
                                                <span class="text-el">{lang('шт.', 'newLevel')}</span>
                                            </div>
                                        </div>
                                        <div class="btn-buy-p btn-cart{if !$inCart} d_n{/if}">
                                            <button 
                                            type="button"
                                            data-id="{echo $productVariant->getId()}"

                                            class="btnBuy"
                                            >
                                            <span class="icon_cleaner_buy"></span>
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
                                        <span class="icon_cleaner_buy"></span>
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
                                {/*}
                                <div class="btn-not-avail">
                                    <button
                                    type="button"
                                    class="infoBut"
                                    data-drop=".drop-report"
                                    data-source="/shop/ajax/getNotifyingRequest"

                                    data-id="{echo $productVariant->getId()}"
                                    data-product-id="{echo $model->getId()}"
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
                            { */}
                        </div>
                    </div>
                    {/if}
                </div>
                <!-- End. Collect information about Variants, for future processing -->
            </div>

            {/foreach}
            <!-- End. Check variant-->
        </div>
    </div>

    <div class="t-a_j">  
        <!-- Start. Wish List & Compare List buttons -->
        <div class="frame-wish-compare-list f-s_0">
            {foreach $variants as $key => $pv}
            <div class="frame-btn-wish js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if} data-id="{echo $pv->getId()}">
                {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
            </div>
            {/foreach}
            <div class="frame-btn-comp">
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
    <!--Start .Share-->
    <div class="social-tell">
        {echo $CI->load->module('share')->_make_share_form()}
    </div>

    <!-- End. Share -->
</div>


<div class="container f-s_0 mq-max mq-w-960 mq-block" data-mq-max="960" data-mq-min="0" data-mq-target="#productTabs">
    <!-- Start. Tabs block-->
    <ul class="tabs tabs-data tabs-product mq-max mq-w-480 mq-inline-block">

        {if $fullDescription = $model->getFullDescription()}
        <li class="active"><button data-href="#first" data-source="{shop_url('product_api/renderFullDescription')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()}{literal}}{/literal}' data-selector=".inside-padd > .text">{lang('описание','newLevel')}</button></li>
        {/if}

        {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}

        <li><button data-href="#second" data-source="{shop_url('product_api/renderProperties')}" data-data='{literal}{"product_id":{/literal} {echo $model->getId()} {literal}}{/literal}' data-selector=".characteristic">{lang('Характеристики','newLevel')}</button></li>
        {/if}
        <li><button data-href="#third">{lang('доставка и оплата','newLevel')}</button></li>

        <!--Output of the block comments-->
        {if $Comments && $model->enable_comments}
        <li>
            <button type="button" data-href="#comment" onclick="Comments.renderPosts($('#comment .inside-padd'), {literal}{'visibleMainForm': '1'}{/literal})">
                <span id="cc">
                    {if intval($Comments[$model->getId()][0]) !== 0}

                    {lang('отзывы','newLevel')}({echo intval($Comments[$model->getId()])})
                    {else:}
                    {lang('отзывы','newLevel')}(0)
                    {/if}
                </span>
            </button>
        </li>
        {/if}
    </ul>




    <div class="frame-tabs-ref frame-tabs-product  mq-max mq-w-480 mq-block">
        <div id="first">
            <div class="inside-padd">
                <div class="text patch-product">
                    <div class="preloader"></div>
                </div>
                <div class="btn-all-info">
                    <button type="button"><span class="text-el" data-hide='<span class="d_l_2">{lang('Свернуть','newLevel')}</span>' data-show='<span class="d_l_2">{lang('Показать все','newLevel')}</span>'></span></button>
                </div>
            </div>
        </div>
        <!--             Start. Characteristic-->
        <div id="second">
            <div class="inside-padd">



                {if $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($model, 1)}
                {$cntProp = count($props)}

                <ul class="prop-product patch-product">
                    {foreach $props as $key => $prop}
                    {if $key > 5 }{break}{/if}
                    <li>
                        <span class="name-prop  o_h"><span class="dotted_underline d_i-b">{$prop['Name']}:</span></span>
                        <span class="val-prop">{$prop['Value']}</span>
                    </li>
                    {/foreach}
                </ul>
 
                <div class="btn-all-info">
                    <button type="button"><span class="text-el" data-hide='<span class="d_l_2">{lang('Свернуть','newLevel')}</span>' data-show='<span class="d_l_2">{lang('Показать все','newLevel')}</span>'></span></button>
                </div>

                {/if}







            </div>
        </div>
        <!--                    End. Characteristic-->

        <div id="third">
            <div class="inside-padd">
                <div class="text">
                    <div class="preloader"></div>
                    <div class="frame-delivery-payment">
                        <div class="title">
                            <span class="text-el">Доставка товара:</span>
                        </div>
                        <div class="frame-list-delivery">
                            <ul class="list-style-1">
                                <li>Самовывоз из офиса компании</li>
                                <li>Доставка нашим курьером по адресу</li>
                                <li>Курьерскими службами по адресу</li>
                                <li>Курьерскими службами на склад</li>
                            </ul>
                        </div>

                        <div class="title"><span class="text-el">Оплата товара:</span></div>
                        <div class="frame-list-payment">
                            <ul class="list-style-1">
                                <li>Наличными курьеру</li>
                                <li>С помощью банковской карты Visa или Mastercard</li>
                                <li>Через платежную систему Приват24</li>
                                <li>В отделении ПриватБанка</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="comment">
            <div class="inside-padd forComments p_r">
                <div class="preloader"></div>
            </div>
        </div>

    </div>



    <div class="mq-min mq-w-320 mq-block">


        {if $dl_properties = ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($model->getId())}

        {/if}
        {if $fullDescription = $model->getFullDescription()}
        {/if}
        {if $accessories}

        {/if}
        <!--Output of the block comments-->
        {if $Comments && $model->enable_comments}

        {/if}


        {if $fullDescription != ''}
        <div class="frameView">

         <div class="decor_title2">
            {lang('Описание' , 'newLevel')}
        </div>
        <div class="text  patch-product">
            {echo $fullDescription}
        </div>
        <div class="btn-all-info">
            <button type="button"><span class="text-el" data-hide='<span class="d_l_2">{lang('Свернуть','newLevel')}</span>' data-show='<span class="d_l_2">{lang('Показать все','newLevel')}</span>'></span></button>
        </div>

    </div>
    {/if}

    {if $dl_properties}
    <div class="frameView">
        <div class="decor_title2">
            {lang('Характеристики','newLevel')}
        </div>

        <div class="characteristic  patch-product">
            {echo $dl_properties}
        </div>
        <div class="btn-all-info">
            <button type="button"><span class="text-el" data-hide='<span class="d_l_2">{lang('Свернуть','newLevel')}</span>' data-show='<span class="d_l_2">{lang('Показать все','newLevel')}</span>'></span></button>
        </div>
    </div>
    {/if}

    <div class="frameView">
        <div class="frame-form-comment">
            {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
            <div class="forComments">
                {echo $c['comments']}
            </div>
        </div>
    </div>

</div>



<!-- End. Tabs block-->
</div>    
</div>


</div>

<div  id="productTabs" class="container f-s_0"></div>



</div>

<!-- Start. Kit-->

{if $model->getShopKits()}
<div class="container">
    <section class="frame-complect horizontal-carousel">
        <div class="frame-title">
            <div class="title mq-max mq-w-480 mq-block">{lang('Покупай в комплекте со скидкой','newLevel')}</div>
            <div class="title mq-min mq-w-320 mq-block">{lang('Комплект со скидкой','newLevel')}</div>
        </div>
        <div class="carousel-js-css items-carousel complects-carousel">
            <div class="content-carousel">
                <ul class="items-complect items">
                    {foreach $model->getShopKits() as $key => $kitProducts}
                    {$inCart = getAmountInCart('ShopKit', $kitProducts->getId())}
                    <li class="globalFrameProduct{if $inCart} in-cart{else:} to-cart{/if}">
                        <ul class="items items-bask row-kits rowKits items-product">
                            <!-- main product -->
                            <li>
                                <div class="frame-kit main-product">
                                    <div class="frame-photo-title">
                                        <span class="photo-block">
                                            <span class="helper"></span>
                                            <img src="{echo $kitProducts->getMainProduct()->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}" title="{echo ShopCore::encode($kitProducts->getMainProduct()->getName())}"/>
                                            {promoLabel($kitProducts->getSProducts()->getAction(), $kitProducts->getSProducts()->getHot(), $kitProducts->getSProducts()->getHit(), 0)}
                                        </span>
                                        <!-- Start brand name -->  

                                        {if $model->getBrand() != null}
                                        {$brand = $model->getBrand()->getName()}
                                        {$hasBrand = trim($brand) != ''}

                                        <span class="frame-item-brand c_9 f-s_11 t-t_u d_b">
                                            {if $hasBrand}
                                            {echo trim($brand)}
                                            {/if}
                                        </span>

                                        {/if} 
                                        <!-- End brand name -->  
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
                                    <span class="text-el mq-max mq-w-960 mq-inline">{lang('Купить комплект', 'newLevel')}</span>
                                    <span class="text-el mq-w-320 mq-w-480 mq-inline mq-w-768">{lang('Купить', 'newLevel')}</span>
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

</div>
<!-- Start. Similar Products-->
{widget('similar')}
<!-- End. Similar Products-->

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
<span class="helper"></span>
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