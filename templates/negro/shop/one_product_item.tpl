{if !$promos && $products}{$promos = $products}{/if}
{foreach $promos as $p}
{$Comments = $CI->load->module('comments')->init($p)}
<li>
    <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title">
        <span class="photo-block">
            <span class="helper"></span>
            <img src="{productSmallImageUrl($p)}" alt="{echo ShopCore::encode($p->getName())}" />
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
        {$CI->load->module('star_rating')->show_star_rating($p)}
        {if $Comments[$p->getId()][0] != '0' && $p->enable_comments}
        <a href="{shop_url('product/'.$p->url.'#comment')}" class="count_response">
            {echo $Comments[$p->getId()]}
        </a>
        {/if}
        <div class="frame-prices f-s_0">
            <!-- Check for discount-->
            {if ShopCore::$ci->dx_auth->is_logged_in() === true && $p->firstVariant->toCurrency() != $p->firstVariant->toCurrency('OrigPrice')}
            {$discount =true}
            {/if}
            {if $p->hasDiscounts()}
            <span class="price-discount">
                <span>
                    <span class="price">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                    <span class="curr">{$CS}</span>
                </span>
            </span>
            {/if}
            {if $p->firstVariant->toCurrency() > 0}
            <span class="current-prices f-s_0">
                <span class="price-new">
                    <span>
                        <span class="price">{echo $p->firstVariant->toCurrency()}</span>
                        <span class="curr">{$CS}</span>
                    </span>
                </span>
                {if $NextCSId != null}
                <span class="price-add">
                    <span>
                        (<span class="price">{echo $p->firstVariant->toCurrency('Price',1)}</span>
                        <span class="add-curr">{$NextCs}</span>)
                    </span>
                </span>
                {/if}
            </span>
            {/if}
        </div>

        <!--            End. Price-->
        {if $CI->uri->segment(2) == "category" || $CI->uri->segment(2) == "brand" || $CI->uri->segment(2) == "search" || $CI->uri->segment(2) == "compare" || $CI->uri->segment(2) == "wish_list"}
        <div class="f-s_0 func-button">
            {if $p->firstvariant->getstock() != 0}
            <!-- buy/inCart button -------------------->
            <div class="btn-buy">
                <button class="btnBuy"
                        type="button"
                        data-prodId="{echo $p->getId()}"
                        data-varId="{echo $p->firstVariant->getId()}"
                        data-price="{echo $p->firstVariant->toCurrency()}"
                        data-name="{echo $p->getName()}"
                        data-number="{echo $p->firstVariant->getnumber()}"
                        data-maxcount="{echo $p->firstVariant->getstock()}"
                        data-vname="{echo $p->firstVariant->getName()}">
                    <span class="icon_cleaner icon_cleaner_buy"></span>
                    <span class="text-el">{lang('s_buy')}</span>
                </button>
            </div>
            <!-- end of buy/inCart buttons ------------->
            {else:}
            <!-- Start. Notify button -->
            <div class="btn-not-avail">
                <button
                    type="button"
                    data-drop=".drop-report"
                    data-source="/shop/ajax/getNotifyingRequest"
                    data-prodid="{echo $p->getId()}"
                    data-varid="{echo $p->firstVariant->getId()}"
                    data-price="{echo $p->firstVariant->toCurrency()}" 
                    data-name="{echo ShopCore::encode($p->getName())}"
                    data-maxcount="{echo $p->firstVariant->getstock()}"
                    data-number="{echo $p->firstVariant->getNumber()}"
                    data-img="{echo $p->firstVariant->getSmallPhoto()}"
                    data-url="{echo shop_url('product/'.$p->getUrl())}"
                    data-origPrice="{if $p->hasDiscounts()}{echo $p->firstVariant->toCurrency('OrigPrice')}{/if}"
                    data-stock="{echo $p->firstVariant->getStock()}"
                    >
                    <span class="text-el">Сообщит о появлении</span>
                </button>
            </div>
            <!-- End. Notify button -->
            {/if}
            <!--                     Add to wishlist, if $CI->uri->segment(2) != "wish_list"-->
            {if $CI->uri->segment(2) != "wish_list"}
            <!-- Wish List buttons --------------------->
            <div class="var_{echo $p->firstVariant->getId()} prod_{echo $p->getId()}">
                <div class="btn-wish" data-title="В список желаний" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" data-rel="tooltip">
                    <button class="toWishlist"
                            data-price="{echo $p->firstVariant->toCurrency()}"
                            data-prodid="{echo $p->getId()}"
                            data-varid="{echo $p->firstVariant->getId()}"
                            type="button"
                            data-title="{lang('s_add_to_wish_list')}"
                            data-firtitle="{lang('s_add_to_wish_list')}"
                            data-sectitle="{lang('s_in_wish_list')}"
                            data-rel="tooltip">
                        <span class="icon_wish"></span>
                        <span class="text-el">{lang('s_add_to_wish_list')}</span>
                    </button>
                </div>
            </div>
            <!-- end of Wish List buttons -------------->
            {/if}
            <!--                     Add to compare, if $CI->uri->segment(2) != "compare"-->
            {if $CI->uri->segment(2) != "compare"}
            <!-- compare buttons ----------------------->
            <div class="d_i-b">
                <div class="btn-def btn-compare" data-title="В список сравнений"  data-prodid="{echo $p->getId()}" data-rel="tooltip">
                    <button class="toCompare"
                            data-prodid="{echo $p->getId()}"
                            type="button"
                            data-title="{lang('s_add_to_compare')}"
                            data-firtitle="{lang('s_add_to_compare')}"
                            data-sectitle="{lang('s_in_compare')}"
                            data-rel="tooltip">
                        <span class="icon_compare"></span>
                        <span class="text-el">{lang('s_add_to_compare')}</span>
                    </button>
                </div>
            </div>
            <!-- end of compare buttons ---------------->
            {/if}
            <!--                    Start. Description-->
            {if trim($p->getShortDescription()) != ''}
            <div class="short_desc">
                {echo $p->getShortDescription()}
            </div>
            {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->getId(), 1)}
            <div class="short_desc">
                <p>{echo $props}</p>
            </div>
            {/if}
            <!-- End. Description-->
        </div>     
        {/if}
    </div>
    <!--        Start. Remove buttons if compare or wishlist-->
    {if $CI->uri->segment(2) == "compare"}
    <button type="button" class="icon_times_remove deleteFromCompare" onclick="Shop.CompareList.rm({echo  $p->getId()}, this)"></button>
    {/if}
    {if $CI->uri->segment(2) == "wish_list" && ShopCore::$ci->dx_auth->is_logged_in() === true}
    <button data-drop_bak=".drop-enter" onclick="Shop.WishList.rm({echo $p->getId()}, this, {echo $p->getId()})" class="icon_times_remove"></button>
    {/if}
    <!--        End. Remove buttons if compare or wishlist-->
</li>
{/foreach}