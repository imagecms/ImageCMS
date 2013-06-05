{if count($products) > 0}
<section class="special-proposition">
    <div class="title_h1 container">
        <span>{$title}</span>
    </div>
    <div class="big-container">
        <div class="carousel_js products-carousel">
            <div class="content-carousel container">
                <ul class="items items-catalog">
                    {foreach $products as $p}
                    {$p->getProductVariants()}
                    <li>
                        <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title">
                            <span class="photo-block">
                                <span class="helper"></span>
                                <img src="{echo $p->firstVariant->getMediumPhoto()}" alt="{echo ShopCore::encode($p->getName())}" />
                                <!-- creating hot bubble for products image if product is hot -->
                                {if $p->getHot()}
                                <span class="prod_status nowelty">{lang('s_shot')}</span>
                                {/if}
                                <!-- creating hot bubble for products image if product is hit -->
                                {if $p->getHit()}
                                <span class="prod_status hit">{lang('s_s_hit')}</span>
                                {/if}
                                <!-- creating hot bubble for products image if product is action -->
                                {if $p->getAction()}
                                <span class="prod_status action">{echo $p->firstVariant->getNumDiscount()} %</span>
                                {/if}
                            </span>
                            <span class="title">{echo ShopCore::encode($p->getName())}</span>
                        </a>
                        <div class="description">
                            {$CI->load->module('star_rating')->show_star_rating($p)}
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
                            <div class="f-s_0 func-button">
                                {if $p->firstvariant->getstock() != 0}
                                <!-- buy/inCart button -------------------->
                                <div class="btn-buy">
                                    <button
                                        class="btnBuy"
                                        type="button" 
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
                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                        <span class="text-el">{lang('s_buy')}</span>
                                    </button>
                                </div>
                                <!-- end of buy/inCart buttons ------------->
                                {else:}
                                <!-- Start. Notify button -->

                                <!-- End. Notify button -->
                                {/if}
                            </div>
                        </div>
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
</section>
{/if}