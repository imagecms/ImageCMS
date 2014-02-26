{$opi_widget = $opi_widget != false && $opi_widget != NULL}
{$opi_wishlist = $opi_wishlist != false && $opi_wishlist != NULL}
{$opi_compare = $opi_compare != false && $opi_compare != NULL}
{$opi_codeArticle = $opi_codeArticle != false && $opi_codeArticle != NULL}
{$opi_defaultItem = $opi_defaultItem != false && $opi_defaultItem != NULL}
{$opi_vertical = $opi_vertical != false && $opi_vertical != NULL}
{$opi_wishListPage = $opi_wishListPage != false && $opi_wishListPage != NULL}

{$condlimit = $opi_limit != false && $opi_limit != NULL}
{foreach $products as $key => $p}

    {if is_array($p) && $p.id}
        {$pArray = $p;}
        {$variants = array()}
        {$p = getProduct($p.id)}
        {$p->firstVariant = getVariant($pArray.id,$pArray.variant_id)}
        {$variants[] = $p->firstVariant}
    {else:}
        {$variants = $p->getProductVariants()}
    {/if}

    {$hasDiscounts = $p->hasDiscounts()}

    {if $key >= $opi_limit && $condlimit}
        {break}
    {/if}
    {$Comments = $CI->load->module('comments')->init($p)}
    {$inCartFV = getAmountInCart('SProducts', $p->firstVariant->getId())}
    <li class="globalFrameProduct{if $p->firstVariant->getStock() == 0} not-avail{else:}{if $inCartFV} in-cart{else:} to-cart{/if}{/if}" data-pos="top">
        <!-- Start. Photo & Name product -->
        <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title" title="{echo ShopCore::encode($p->getName())}">
            <span class="photo-block">
                <span class="helper"></span>
                {$photo = $p->firstVariant->getMediumPhoto()}
                <img data-original="{echo $photo}"
                     src="{$THEME}images/blank.gif"
                     alt="{echo ShopCore::encode($p->firstVariant->getName())}"
                     class="vImg lazy"/>
                {$discount = 0}
                {if $hasDiscounts}
                    {$discount = $p->firstVariant->getvirtual('numDiscount') / $p->firstVariant->toCurrency('origprice') * 100}
                {/if}
                {promoLabel($p->getAction(), $p->getHot(), $p->getHit(), $discount)}
            </span>
            <span class="title">{echo ShopCore::encode($p->getName())}</span>
        </a>
        <!-- End. Photo & Name product -->
        <div class="description">
            <!-- Start. article & variant name & brand name -->
            {if $opi_codeArticle}
                <div class="frame-variant-name-code">
                    {$hasCode = $p->firstVariant->getNumber() == ''}
                    <span class="frame-variant-code frameVariantCode" {if $hasCode}style="display:none;"{/if}>{lang('Артикул','newLevel')}:
                        <span class="code js-code">
                            {if !$hasCode}
                                {trim($p->firstVariant->getNumber())}
                            {/if}
                        </span>
                    </span>
                    {if count($variants) > 1}
                        {$hasVariant = $p->firstVariant->getName() == ''}
                        <span class="frame-variant-name frameVariantName" {if $hasVariant}style="display:none;"{/if}>{lang('Вариант','newLevel')}:
                            <span class="code js-code">
                                {if !$hasVariant}
                                    {trim($p->firstVariant->getName())}
                                {/if}
                            </span>
                        </span>
                    {/if}
                    {if $brand = $p->getBrand()}
                        {$brand = $brand->getName()}
                        {$hasBrand = trim($brand) != ''}
                        <span class="frame-item-brand">{lang('Бренд','newLevel')}:
                            <span class="code js-code">
                                {if $hasBrand}
                                    <a href="{shop_url('brand/'.$p->getBrand()->getUrl())}">
                                        {echo trim($brand)}
                                    </a>
                                {/if}
                            </span>
                        </span>
                    {/if}
                </div>
            {/if}
            <!-- End. article & variant name & brand name -->
            {if !$opi_vertical}
                {if $p->enable_comments && intval($Comments[$p->getId()]) !== 0}
                    <div class="frame-star f-s_0">
                        {$CI->load->module('star_rating')->show_star_rating($p, false)}
                        <a href="{shop_url('product/'.$p->url.'#comment')}" class="count-response">
                            {intval($Comments[$p->getId()])}
                            {echo SStringHelper::Pluralize($Comments[$p->getId()], array(lang("отзыв","newLevel"),lang("отзыва","newLevel"),lang("отзывов","newLevel")))}
                        </a>
                    </div>
                {/if}
            {/if}
            <!-- Start. Prices-->
            <div class="frame-prices f-s_0">
                {$oldoprice = $p->getOldPrice() && $p->getOldPrice() != 0 && $p->getOldPrice() > $p->firstVariant->toCurrency()}
                {if $hasDiscounts}
                    <!-- Start. Check for discount-->
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                    <!-- End. Check for discount-->
                {/if}
                {if $oldoprice && !$hasDiscounts}
                    <!-- Start. Check old price-->
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo intval($p->getOldPrice())}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                    <!-- End. Check old price-->
                {/if}
                <!-- Start. Product price-->
                {if $p->firstVariant->toCurrency() > 0}
                    <span class="current-prices f-s_0">
                        <span class="price-new">
                            <span>
                                <span class="price priceVariant">{echo $p->firstVariant->toCurrency()}</span>
                                <span class="curr">{$CS}</span>
                            </span>
                        </span>
                        {if $NextCS != null}
                            <span class="price-add">
                                <span>
                                    <span class="price addCurrPrice">{echo $p->firstVariant->toCurrency('Price',$NextCSId)}</span>
                                    <span class="curr-add">{$NextCS}</span>
                                </span>
                            </span>
                        {/if}
                    </span>
                {/if}
                <!-- End. Product price-->
            </div>
            <!-- End. Prices-->
            <!-- Start. Check variant-->
            {if !$opi_widget && !$opi_defaultItem && !$opi_compare && !$opi_wishListPage}
                {if count($variants) > 1}
                    <div class="check-variant-catalog">
                        <div class="lineForm">
                            <select id="сVariantSwitcher_{echo $p->firstVariant->getId()}" name="variant">
                                {foreach $variants as $key => $pv}
                                    {if $pv->getName()}
                                        {$name = ShopCore::encode($pv->getName())}
                                    {else:}
                                        {$name = ShopCore::encode($p->getName())}
                                    {/if}
                                    <option value="{echo $pv->getId()}" title="{echo $name}">
                                        {echo $name}
                                    </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                {/if}
            {/if}
            <!-- End. Check variant-->
            <div class="funcs-buttons frame-without-top">
                <div class="no-vis-table">
                    <!-- Start. Collect information about Variants, for future processing -->
                    {foreach $variants as $key => $pv}
                        {$discount = 0}
                        {if $hasDiscounts}
                            {$discount = $pv->getvirtual('numDiscount')/$pv->toCurrency()*100}
                        {/if}
                        {if $pv->getStock() > 0}
                            {$inCart = getAmountInCart('SProducts', $pv->getId())}
                            <div class="frame-count-buy js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if}>
                                <form method="POST" action="/shop/cart/addProductByVariantId/{echo $pv->getId()}">
                                    {if !$opi_widget && !$opi_defaultItem}
                                        <div class="frame-count frameCount">
                                            <div class="number js-number" data-title="{lang('Количество на складе','newLevel')} {echo $pv->getstock()}">
                                                <div class="frame-change-count">
                                                    <div class="btn-plus">
                                                        <button type="button"{if $inCart} disabled="disabled"{/if}>
                                                            <span class="icon-plus"></span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-minus">
                                                        <button type="button"{if $inCart} disabled="disabled"{/if}>
                                                            <span class="icon-minus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="text" name="quantity" value="{echo $inCart ? $inCart : 1}" class="plusMinus plus-minus" data-title="{lang('Только цифры','newLevel')}" data-min="1" data-max="{echo $pv->getstock()}"{if $inCart} disabled="disabled"{/if}>
                                            </div>
                                        </div>
                                    {/if}
                                    <div class="btn-buy btn-cart{if !$inCart} d_n{/if}">
                                        <button 
                                            type="button"
                                            data-id="{echo $pv->getId()}"

                                            class="btnBuy"
                                            >
                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                            <span class="text-el">{lang('В корзине', 'newLevel')}</span>
                                        </button>
                                    </div>
                                    <div class="btn-buy{if $inCart} d_n{/if}">
                                        <button
                                            type="button"

                                            onclick='Shop.Cart.add($(this).closest("form").serialize(), "{echo $pv->getId()}")'
                                            class="btnBuy infoBut"

                                            data-id="{echo $pv->getId()}"
                                            data-name="{echo ShopCore::encode($p->getName())}"
                                            data-vname="{echo ShopCore::encode($pv->getName())}"
                                            data-number="{echo $pv->getNumber()}"
                                            data-price="{echo $pv->toCurrency()}"
                                            data-add-price="{if $NextCS != null}{echo $pv->toCurrency('Price',$NextCSId)}{/if}"
                                            data-orig-price="{if $hasDiscounts}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                            data-medium-image="
                                            {if preg_match('/nophoto/', $pv->getMediumPhoto()) > 0}
                                                {echo $p->firstVariant->getMediumPhoto()}
                                            {else:}
                                                {echo $pv->getMediumPhoto()}
                                            {/if}"
                                            data-img="
                                            {if preg_match('/nophoto/', $pv->getSmallPhoto()) > 0}
                                                {echo $p->firstVariant->getSmallPhoto()}
                                            {else:}
                                                {echo $pv->getSmallPhoto()}
                                            {/if}"
                                            data-url="{echo shop_url('product/'.$p->getUrl())}"
                                            data-maxcount="{echo $pv->getstock()}"
                                            >
                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                            <span class="text-el">{lang('Купить', 'newLevel')}</span>
                                        </button>
                                    </div>
                                    {form_csrf()}
                                </form>
                            </div>
                        {else:}
                            <div class="btn-not-avail js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if}>
                                <button
                                    class="infoBut"
                                    type="button"
                                    data-drop=".drop-report"
                                    data-source="/shop/ajax/getNotifyingRequest"

                                    data-id="{echo $pv->getId()}"
                                    data-name="{echo ShopCore::encode($p->getName())}"
                                    data-vname="{echo ShopCore::encode($pv->getName())}"
                                    data-number="{echo $pv->getNumber()}"
                                    data-price="{echo $pv->toCurrency()}"
                                    data-add-price="{if $NextCS != null}{echo $pv->toCurrency('Price',$NextCSId)}{/if}"
                                    data-orig-price="{if $hasDiscounts}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                    data-medium-image="
                                    {if preg_match('/nophoto/', $pv->getMediumPhoto()) > 0}
                                        {echo $p->firstVariant->getMediumPhoto()}
                                    {else:}
                                        {echo $pv->getMediumPhoto()}
                                    {/if}"
                                    data-img="
                                    {if preg_match('/nophoto/', $pv->getSmallPhoto()) > 0}
                                        {echo $p->firstVariant->getSmallPhoto()}
                                    {else:}
                                        {echo $pv->getSmallPhoto()}
                                    {/if}"
                                    data-maxcount="{echo $pv->getstock()}"
                                    data-url="{echo shop_url('product/'.$p->getUrl())}"
                                    >
                                    <span class="icon-but"></span>
                                    <span class="text-el">{lang('Сообщить о появлении','newLevel')}</span>
                                </button>
                            </div>
                        {/if}
                    {/foreach}
                </div>
            </div>
            <!-- End. Collect information about Variants, for future processing -->
            {if !$opi_defaultItem}
                <div class="frame-without-top">
                    <!-- Wish List & Compare List buttons -->
                    <div class="frame-wish-compare-list no-vis-table t-a_j">
                        {if !$opi_compare}
                            <div class="frame-btn-comp">
                                <!-- Start. Compare List button -->
                                <div class="btn-compare">
                                    <div class="toCompare btnCompare"
                                         data-id="{echo $p->getId()}"
                                         type="button"
                                         data-title="{lang('Сравнить','newLevel')}"
                                         data-firtitle="{lang('Сравнить','newLevel')}"
                                         data-sectitle="{lang('В списке сравнений','newLevel')}"
                                         data-rel="tooltip">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox">
                                        </span>
                                        <span class="text-el d_l">{lang('Сравнить','newLevel')}</span>
                                    </div>
                                </div>
                                <!-- End. Compare List button -->
                            </div>
                        {/if}
                        {if $opi_wishlist}
                            <!-- Start. Wish list buttons -->
                            {foreach $variants as $key => $pv}
                                <div class="frame-btn-wish js-variant-{echo $pv->getId()} js-variant d_i-b_" {if $key != 0}style="display:none"{/if}>
                                    {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
                                </div>
                            {/foreach}
                            <!-- End. wish list buttons -->
                        {/if}
                    </div>
                    <!-- End. Wish List & Compare List buttons -->
                </div>
            {/if}
            <!-- End. Collect information about Variants, for future processing -->
            {if !$opi_widget && !$opi_compare && !$opi_defaultItem && !$opi_wishListPage}
                <div class="frame-without-top">
                    <div class="no-vis-table">
                        <!--Start. Description-->
                        {if trim($p->getShortDescription()) != ''}
                            <div class="short-desc">
                                {echo strip_tags($p->getShortDescription())}
                            </div>
                        {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->getId())}
                            <div class="short-desc">
                                <p>{echo $props}</p>
                            </div>
                        {/if}
                        <!-- End. Description-->
                    </div>
                </div>
            {/if}
        </div>
        <!-- Start. Remove buttons if compare-->
        {if $opi_compare && !$opi_widget && !$opi_wishListPage}
            <button type="button" class="icon_times deleteFromCompare" onclick="Shop.CompareList.rm({echo  $p->getId()}, this)"></button>
        {/if}
        <!-- End. Remove buttons if compare-->

        <!-- Start. For wishlist page-->
        {if $opi_wishListPage}
            {$p = $pArray}
            {if trim($p[comment]) != ''}
                <p>
                    {$p[comment]}
                </p>
            {/if}
            {if !$opi_otherlist}
                <div class="funcs-buttons-WL-item">
                    <div class="btn-remove-item-wl">
                        <button
                            type="button"
                            data-id="{echo $p.variant_id}"
                            class="btnRemoveItem"

                            data-type="json"
                            data-modal="true"

                            data-drop="#notification"
                            data-effect-on="fadeIn"
                            data-effect-off="fadeOut"
                            data-source="{site_url('/wishlist/wishlistApi/deleteItem/'.$p[variant_id].'/'.$p[wish_list_id])}"
                            data-after="WishListFront.removeItem"
                            ><span class="icon_remove"></span><span class="text-el d_l_1">{lang('Удалить', 'newLevel')}</span></button>
                    </div>
                    <div class="btn-move-item-wl">
                        <button
                            type="button"
                            data-drop="#wishListPopup"
                            data-source="{site_url('/wishlist/renderPopup/'.$p[variant_id].'/'.$p[wish_list_id])}"
                            data-always="true"
                            ><span class="icon_move"></span><span class="text-el d_l_1">{lang('Переместить', 'newLevel')}</span>
                        </button>
                    </div>
                </div>
            {/if}
        {/if}
        <!-- End. For wishlist page-->

        <div class="decor-element"></div>
    </li>
{/foreach}