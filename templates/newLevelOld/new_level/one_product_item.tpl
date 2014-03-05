{$opi_widget = $opi_widget != false && $opi_widget != NULL}
{$opi_wishlist = $opi_wishlist != false && $opi_wishlist != NULL}
{$opi_compare = $opi_compare != false && $opi_compare != NULL}
{$opi_codeArticle = $opi_codeArticle != false && $opi_codeArticle != NULL}
{$opi_defaultItem = $opi_defaultItem != false && $opi_defaultItem != NULL}
{$opi_vertical = $opi_vertical != false && $opi_vertical != NULL}

{$condlimit = $opi_limit != false && $opi_limit != NULL}

{foreach $products as $key => $p}

    {if is_array($p) && $p.id}
        {$p = getProduct($p.id)}
    {/if}

    {$variants = $p->getProductVariants()}

    {$hasDiscounts = $p->hasDiscounts()}

    {if $key >= $opi_limit && $condlimit}

        {break}
    {/if}
    {$Comments = $CI->load->module('comments')->init($p)}
    <li class="globalFrameProduct{if $p->firstVariant->getStock() == 0} not-avail{/if}" data-pos="top">
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
            {if $codeArticle}
                <div class="frame-variant-name-code">
                    {$hasCode = $p->firstVariant->getNumber() == ''}
                    <span class="frame-variant-code frameVariantCode" {if $hasCode}style="display:none;"{/if}>{lang('Артикул','newLevel')}:
                        <span class="code js-code">
                            {if !$hasCode}
                                {trim($p->firstVariant->getNumber())}
                            {/if}
                        </span>
                    </span>
                    {$hasVariant = $p->firstVariant->getName() == ''}
                    <span class="frame-variant-name frameVariantName" {if $hasVariant}style="display:none;"{/if}>{lang('Вариант','newLevel')}:
                        <span class="code js-code">
                            {if !$hasVariant}
                                {trim($p->firstVariant->getName())}
                            {/if}
                        </span>
                    </span>
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
                <!-- Start. Check for discount-->
                {$oldoprice = $p->getOldPrice() && $p->getOldPrice() != 0 && $p->getOldPrice() > $p->firstVariant->toCurrency()}
                {if $hasDiscounts}
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                {/if}
                <!-- End. Check for discount-->
                <!-- Start. Check old price-->
                {if $oldoprice && !$hasDiscounts}
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo intval($p->toCurrency('OldPrice'))}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                {/if}
                <!-- End. Check old price-->
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
                                    (<span class="price addCurrPrice">{echo $p->firstVariant->toCurrency('Price',$NextCSId)}</span>
                                    <span class="curr-add">{$NextCS}</span>)
                                </span>
                            </span>
                        {/if}
                    </span>
                {/if}
                <!-- End. Product price-->
            </div>
            <!-- End. Prices-->
            <!-- Start. Check variant-->
            {if !$opi_widget && !$opi_defaultItem && !$opi_compare}
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
            <div class="funcs-buttons">
                <!-- Start. Collect information about Variants, for future processing -->
                {foreach $variants as $key => $pv}
                    {if $pv->getStock() > 0}
                        <div class="frame-count-buy js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if}>
                            {if !$opi_widget && !$opi_defaultItem}
                                <div class="frame-count frameCount">
                                    <div class="number js-number" data-title="{lang('Количество на складе','newLevel')} {echo $pv->getstock()}" data-prodid="{echo $p->getId()}" data-varid="{echo $pv->getId()}">
                                        <div class="frame-change-count frameChangeCount">
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
                                        <input type="text" value="1" class="plusMinus plus-minus iPr" data-title="{lang('Только цифры','newLevel')}" data-min="1" data-max="{echo $pv->getstock()}">
                                    </div>
                                </div>

                            {/if}
                            <div class="btn-buy">
                                <button
                                    {$discount = 0}
                                    {if $hasDiscounts}
                                        {$discount = $pv->getvirtual('numDiscount')/$pv->toCurrency()*100}
                                    {/if}
                                    disabled="disabled"
                                    class="btnBuy infoBut"
                                    type="button"
                                    data-id="{echo $pv->getId()}"
                                    data-prodid="{echo $p->getId()}"
                                    data-varid="{echo $pv->getId()}"
                                    data-count="1"
                                    data-name="{echo ShopCore::encode($p->getName())}"
                                    data-vname="{echo trim(ShopCore::encode($pv->getName()))}"
                                    data-maxcount="{echo $pv->getstock()}"
                                    data-number="{echo trim($pv->getNumber())}"
                                    data-mediumImage="{echo $pv->getMediumPhoto()}"
                                    data-img="{if preg_match('/nophoto/', $pv->getSmallPhoto()) > 0}{echo $p->firstVariant->getSmallPhoto()}{else:}{echo $pv->getSmallPhoto()}{/if}"
                                    data-url="{echo shop_url('product/'.$p->getUrl())}"
                                    data-price="{echo $pv->toCurrency()}"
                                    data-origPrice="{if $hasDiscounts}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                    data-addPrice="{if $NextCS != null}{echo $pv->toCurrency('Price',$NextCSId)}{/if}"
                                    data-prodStatus='{json_encode(promoLabelBtn($p->getAction(), $p->getHot(), $p->getHit(), $discount))}'
                                    >
                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                    <span class="text-el">{lang('Купить', 'newLevel')}</span>
                                </button>
                            </div>
                        </div>
                    {else:}
                        <div class="btn-not-avail js-variant-{echo $pv->getId()} js-variant" {if $key != 0}style="display:none"{/if}>
                            <button
                                class="infoBut"
                                type="button"
                                data-drop=".drop-report"
                                data-source="/shop/ajax/getNotifyingRequest"

                                data-id="{echo $pv->getId()}"
                                data-prodid="{echo $p->getId()}"
                                data-varid="{echo $pv->getId()}"
                                data-url="{echo shop_url('product/'.$p->getUrl())}"
                                data-price="{echo $pv->toCurrency()}"
                                data-origPrice="{if $hasDiscounts}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                data-addPrice="{if $NextCS != null}{echo $pv->toCurrency('Price',$NextCSId)}{/if}"
                                data-name="{echo ShopCore::encode($p->getName())}"
                                data-vname="{echo trim(ShopCore::encode($pv->getName()))}"
                                data-maxcount="{echo $pv->getstock()}"
                                data-number="{echo trim($pv->getNumber())}"
                                data-img="{echo $pv->getSmallPhoto()}"
                                data-mediumImage="{echo $pv->getMediumPhoto()}"
                                >
                                <span class="icon-but"></span>
                                <span class="text-el">{lang('Сообщить о появлении','newLevel')}</span>
                            </button>
                        </div>
                    {/if}
                {/foreach}
            </div>
            <!-- End. Collect information about Variants, for future processing -->
            {if !$opi_widget && !$opi_defaultItem}
                <div class="frame-without-top">
                    <!-- Wish List & Compare List buttons -->
                    <div class="frame-wish-compare-list no-vis-table">
                        {if $opi_wishlist}
                            <!-- Start. Wish list buttons -->
                            {foreach $variants as $key => $pv}
                                <div class="frame-btn-wish js-variant-{echo $pv->getId()} js-variant d_i-b_" {if $key != 0}style="display:none"{/if}>
                                    {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
                                </div>
                            {/foreach}
                            <!-- End. wish list buttons -->
                        {/if}
                        {if !$opi_compare}
                            <div class="frame-btn-comp">
                                <!-- Start. Compare List button -->
                                <div class="btn-compare">
                                    <button class="toCompare"
                                            data-prodid="{echo $p->getId()}"
                                            type="button"
                                            data-title="{lang('В список сравнений','newLevel')}"
                                            data-firtitle="{lang('В список сравнений','newLevel')}"
                                            data-sectitle="{lang('В списке сравнений','newLevel')}"
                                            data-rel="tooltip">
                                        <span class="icon_compare"></span>
                                        <span class="text-el d_l">{lang('В список сравнений','newLevel')}</span>
                                    </button>
                                </div>
                                <!-- End. Compare List button -->
                            </div>
                        {/if}
                    </div>
                    <!-- End. Wish List & Compare List buttons -->
                </div>
            {/if}
            <!-- End. Collect information about Variants, for future processing -->
            {if !$opi_widget && !$opi_compare && !$opi_defaultItem}
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
        {if $opi_compare && !$opi_widget}
            <button type="button" class="icon_times deleteFromCompare" onclick="Shop.CompareList.rm({echo  $p->getId()}, this)"></button>
        {/if}
        <!-- End. Remove buttons if compare-->

        <div class="decor-element"></div>
    </li>
{/foreach}