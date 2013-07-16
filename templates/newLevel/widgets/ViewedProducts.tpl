{if count($products) > 0}
    <section class="special-proposition frame-view-products">
        <div class="big-container">
            <div class="carousel_js products-carousel">
                <div class="content-carousel container">
                    <ul class="items items-catalog items-h-carousel">
                        {foreach $products as $p}
                            {$p->getProductVariants()}
                            <li>
                                <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title">
                                    <span class="photo-block">
                                        <span class="helper"></span>
                                        <img src="{echo $p->firstVariant->getMediumPhoto()}" alt="{echo ShopCore::encode($p->getName())}"/>
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
                                    {if $Comments[$p->getId()] && $p->enable_comments}
                                        <div class="frame-star f-s_0">
                                            {$CI->load->module('star_rating')->show_star_rating($p)}
                                            <a href="{shop_url('product/'.$p->url.'#comment')}" class="count-response">
                                                {$Comments[$p->getId()]}
                                            </a>
                                        </div>
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
                                                            <span class="curr-add">{$NextCs}</span>)
                                                        </span>
                                                    </span>
                                                {/if}
                                            </span>
                                        {/if}
                                    </div>
                                    <div class="funcs-buttons">
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
                                                    data-prodStatus='{json_encode(promoLabelBtn($p->getAction(), $p->getHot(), $p->getHit(), $discount))}'
                                                    >
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
                                                    >
                                                    <span class="text-el">Сообщит о появлении</span>
                                                </button>
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
{else:}
    <div class="inside-padd">
        <div class="msg f-s_0">
            <div class="success"><span class="icon_info"></span><span class="text-el">Нет просмотреных товаров</span></div>
        </div>
    </div>
{/if}