{if !$promos && $products}{$promos = $products}{/if}
{foreach $promos as $p}
    {$Comments = $CI->load->module('comments')->init($p)}
    <li>
        <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title">
            <span class="photo-block">
                <span class="helper"></span>
                <img data-original="{echo $p->firstVariant->getMediumPhoto()}" src="{$THEME}images/blank.gif" alt="{echo ShopCore::encode($p->firstVariant->getName())}" class="vimg lazy"/>
                <!-- creating hot bubble for products image if product is hot -->
                {if $p->getHot()}
                    <span class="product-status nowelty">{lang('s_shot')}</span>
                {/if}
                <!-- creating hot bubble for products image if product is hit -->
                {if $p->getHit()}
                    <span class="product-status hit">{lang('s_s_hit')}</span>
                {/if}
                <!-- creating hot bubble for products image if product is action -->
                {if $p->getAction()}
                    <span class="product-status action">{lang('s_saction')}</span>
                {/if}
            </span>
            <span class="title">{echo ShopCore::encode($p->getName())}</span>
        </a>
        <div class="description">
            <div class="frame-variant-code">
                {$hasCode = $p->firstVariant->getNumber() == '';}
                <span class="frame-number" {if $hasCode}style="display:none;"{/if}>Артикул: <span class="code">({if !$hasCode}{trim($p->firstVariant->getNumber())}{/if})</span></span>
                {$hasVariant = $p->firstVariant->getName() == '';}  
                <span class="frame-variant-name" {if $hasVariant}style="display:none;"{/if}>Вариант: <span class="code">({if !$hasVariant}{trim($p->firstVariant->getName())}{/if})</span></span>
            </div>
            <div class="frame-star f-s_0">
                {$CI->load->module('star_rating')->show_star_rating($p)}
                {if $Comments[$p->getId()][0] != '0' && $p->enable_comments}
                    <a href="{shop_url('product/'.$p->url.'#comment')}" class="count-response">
                        {$Comments[$p->getId()]}
                    </a>
                {else:}
                    <div class="d_i-b">
                        <a href="{shop_url('product/'.$p->url.'#comment')}" class="count-null-response">Оставьте отзыв</a>
                    </div>
                {/if}
            </div>
            <div class="frame-prices f-s_0">
                <!-- Check for discount-->
                {if ShopCore::$ci->dx_auth->is_logged_in() === true && $p->firstVariant->toCurrency() != $p->firstVariant->toCurrency('OrigPrice')}
                    {$discount = true}
                {/if}
                {if $p->hasDiscounts()}
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                {/if}
                {if $p->firstVariant->toCurrency() > 0}
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
                                    (<span class="price addCurrPrice">{echo $p->firstVariant->toCurrency('Price',1)}</span>
                                    <span class="add-curr">{$NextCs}</span>)
                                </span>
                            </span>
                        {/if}
                    </span>
                {/if}
            </div>

            {$variants = $p->getProductVariants()}
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

            <!--            End. Price-->
            <div class="funcs-buttons">
                {if $CI->uri->segment(2) == "category" || $CI->uri->segment(2) == "brand" || $CI->uri->segment(2) == "search" || $CI->uri->segment(2) == "compare" || $CI->uri->segment(2) == "wish_list"}
                    <!-- Start. Collect information about Variants, for future processing -->
                    {foreach $variants as $key => $pv}
                        {if $pv->getStock() > 0}
                            <div class="frame-count-buy variant_{echo $pv->getId()} variant" {if $key != 0}style="display:none"{/if}>
                                <div class="frame-count">
                                    <div class="number" data-title="количество на складе {echo $pv->getstock()}" data-prodid="{echo $p->getId()}" data-varid="{echo $pv->getId()}" data-rel="frameplusminus">
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
                                        <input type="text" value="1" data-rel="plusminus" data-title="только цифры" data-min="1" data-max="{echo $pv->getstock()}">
                                    </div>
                                </div>
                                <div class="btn-buy">
                                    <button
                                        class="btnBuy infoBut"
                                        type="button"
                                        data-id="{echo $pv->getId()}"
                                        data-prodid="{echo $p->getId()}"
                                        data-varid="{echo $pv->getId()}"
                                        data-price="{echo $pv->toCurrency()}"
                                        data-name="{echo ShopCore::encode($p->getName())}"
                                        data-vname="{echo ShopCore::encode($pv->getName())}"
                                        data-maxcount="{echo $pv->getstock()}"
                                        data-number="{echo $pv->getNumber()}"
                                        data-mediumImage="{echo $pv->getMediumPhoto()}"
                                        data-img="{echo $pv->getSmallPhoto()}"
                                        data-url="{echo shop_url('product/'.$p->getUrl())}"
                                        data-price="{echo $pv->toCurrency()}"
                                        data-number="{echo $pv->getNumber()}"
                                        data-origPrice="{if $p->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                        data-addPrice="{echo $pv->toCurrency('Price',1)}"
                                        data-stock="{echo $pv->getStock()}"
                                        >
                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                        <span class="text-el">{lang('s_buy')}</span>
                                    </button>
                                </div>
                            </div>
                        {else:}
                            <div class="btn-not-avail variant_{echo $pv->getId()} variant" {if $key != 0}style="display:none"{/if}>
                                <button
                                    class="infoBut"
                                    type="button"
                                    data-drop=".drop-report"
                                    data-source="/shop/ajax/getNotifyingRequest"
                                    data-id="{echo $pv->getId()}"
                                    data-prodid="{echo $p->getId()}"
                                    data-varid="{echo $pv->getId()}"
                                    data-price="{echo $pv->toCurrency()}"
                                    data-name="{echo ShopCore::encode($p->getName())}"
                                    data-vname="{echo ShopCore::encode($pv->getName())}"
                                    data-maxcount="{echo $pv->getstock()}"
                                    data-number="{echo $pv->getNumber()}"
                                    data-mediumImage="{echo $pv->getMediumPhoto()}"
                                    data-img="{echo $pv->getSmallPhoto()}"
                                    data-url="{echo shop_url('product/'.$p->getUrl())}"
                                    data-price="{echo $pv->toCurrency()}"
                                    data-number="{echo $pv->getNumber()}"
                                    data-origPrice="{if $p->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                    data-addPrice="{echo $pv->toCurrency('Price',1)}"
                                    data-stock="{echo $pv->getStock()}"
                                    >
                                    <span class="icon-but"></span>
                                    <span class="text-el">{lang('s_message_o_report')}</span>
                                </button>
                            </div>
                        {/if}
                    {/foreach}
                    <div class="p_r frame-without-top">
                        <div class="frame-wish-compare-list no-vis-table">
                            <!--                     Add to wishlist, if $CI->uri->segment(2) != "wish_list"-->
                            {/*}
                            {if $CI->uri->segment(2) != "wish_list"}
                                <!-- Wish List buttons --------------------->
                                {foreach $variants as $key => $pv}
                                    <!-- to wish list button -->
                                    <div class="variant_{echo $pv->getId()} variant btn-wish" {if $key != 0}style="display:none"{/if}>
                                        <button class="toWishlist"
                                                data-price="{echo $pv->toCurrency()}"
                                                data-prodid="{echo $p->getId()}"
                                                data-varid="{echo $pv->getId()}"
                                                type="button"
                                                data-title="{lang('s_add_to_wish_list')}"
                                                data-firtitle="{lang('s_add_to_wish_list')}"
                                                data-sectitle="{lang('s_in_wish_list')}"
                                                data-rel="tooltip">
                                            <span class="icon_wish"></span>
                                            <span class="text-el">{lang('s_add_to_wish_list')}</span>
                                        </button>
                                    </div>
                                {/foreach}
                                <!-- end of Wish List buttons -------------->
                            {/if}
                            { */}
                            <!--                     Add to compare, if $CI->uri->segment(2) != "compare"-->
                            {if $CI->uri->segment(2) != "compare"}
                                <!-- compare buttons ----------------------->
                                <div class="btn-compare">
                                    <button class="toCompare"
                                            data-prodid="{echo $p->getId()}"
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
                            {/if}
                        </div>
                    </div>
                </div>
                <!-- End. Collect information about Variants, for future processing -->

            </div>
            <div class="p_r frame-without-top">
                <div class="no-vis-table">
                    <!--                    Start. Description-->
                    {if trim($p->getShortDescription()) != ''}
                        <div class="short-desc">
                            {echo $p->getShortDescription()}
                        </div>
                    {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->getId(), 1)}
                        <div class="short-desc">
                            <p>{echo $props}</p>
                        </div>
                    {/if}
                    <!-- End. Description-->
                </div>
            </div>
        {/if}
        <!--        Start. Remove buttons if compare or wishlist-->
        {if $CI->uri->segment(2) == "compare"}
            <button type="button" class="icon_times deleteFromCompare" onclick="Shop.CompareList.rm({echo  $p->getId()}, this)"></button>
        {/if}
        {if $CI->uri->segment(2) == "wish_list" && ShopCore::$ci->dx_auth->is_logged_in() === true}
            <button data-drop_bak=".drop-enter" onclick="Shop.WishList.rm({echo $p->getId()}, this, {echo $p->getId()})" class="icon_times"></button>
        {/if}
        <!--        End. Remove buttons if compare or wishlist-->

        <div class="decor-element"></div>
    </li>
{/foreach}