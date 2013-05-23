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
                                <img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" />
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
                                <span class="price-old">
                                    <span>
                                        <span class="price">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                                {/if}
                                {if $p->firstVariant->toCurrency() > 0}
                                <span class="current-prices f-s_0 var_price_{echo $p->firstVariant->getId()} prod_price_{echo $p->getId()}">
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
                                    <button class="buyButton toCart"
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
                                <div class="d_i-b var_{echo $p->firstVariant->getId()} prod_{echo $p->getId()} v-a_m not-avail_wrap">
                                    <span class="f-s_12 t-a_l">
                                        <span class="d_b">Товара нет в наличии</span>
                                        <button type="button" class="d_l_b f-s_12" data-drop=".drop-report" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="bottom left">Сообщите</button> о появлении
                                    </span>
                                    <span class="datas">
                                        <input type="hidden" name="ProductId" value="{echo $p->getId()}" />
                                        <input type="hidden" name="VariantId" value="{echo $p->firstVariant->getId()}" />
                                    </span>
                                </div>
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