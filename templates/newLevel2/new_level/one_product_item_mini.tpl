{foreach $products as $key => $p}
    {$hasDiscounts = $p->hasDiscounts()}
    {$inCartFV = getAmountInCart('SProducts', $p->firstVariant->getId())}
    <li class="globalFrameProduct{if $p->firstVariant->getStock() == 0} not-avail{else:}{if $inCartFV} in-cart{else:} to-cart{/if}{/if}" data-pos="top">
        <!-- Start. Photo & Name product -->
        <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title" title="{echo ShopCore::encode($p->getName())}">
            <span class="photo-block">
                <span class="helper"></span>
                {$photo = $p->firstVariant->getMediumPhoto()}
                <img src="{echo $photo}" alt="{echo ShopCore::encode($p->firstVariant->getName())}" class="vImg"/>
                {$discount = 0}
                {if $hasDiscounts}
                    {$discount = ShopCore::app()->SCurrencyHelper->convert($p->firstVariant->getvirtual('numDiscount')) / $p->firstVariant->toCurrency('origprice') * 100}
                {/if}
                {promoLabel($p->getAction(), $p->getHot(), $p->getHit(), $discount)}
            </span>
            <span class="title">{echo ShopCore::encode($p->getName())}</span>
        </a>
        <!-- End. Photo & Name product -->
        <div class="description">
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
                            <span class="price priceOrigVariant">{echo intval($p->toCurrency('OldPrice'))}</span>
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
        </div>
    </li>
{/foreach}