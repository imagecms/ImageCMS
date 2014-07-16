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
        <div class="out-in">
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
            </a>
            <!-- End. Photo & Name product -->
            <div class="description">
                <div class="out-in">
                    <div class="clearfix">
                        <div class="f_r">
                            {/*if adaptive*/}
                            <span class="icon-adaptive"></span>
                        </div>
                        <div class="frame-price-title">
                            <span class="title">{echo ShopCore::encode($p->getName())}</span>
                            <!-- Start. Prices-->
                            <div class="frame-prices f-s_0">
                                {$oldoprice = $p->getOldPrice() && $p->getOldPrice() != 0 && $p->getOldPrice() > $p->firstVariant->toCurrency()}
                                {if $hasDiscounts}
                                    <!-- Start. Check for discount-->
                                    <span class="price-discount">
                                        <span>
                                            <span class="curr">{$CS}</span><span class="price priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                                        </span>
                                    </span>
                                    <!-- End. Check for discount-->
                                {/if}
                                {if $oldoprice && !$hasDiscounts}
                                    <!-- Start. Check old price-->
                                    <span class="price-discount">
                                        <span>
                                            <span class="curr">{$CS}</span><span class="price priceOrigVariant">{echo intval($p->toCurrency('OldPrice'))}</span>
                                        </span>
                                    </span>
                                    <!-- End. Check old price-->
                                {/if}
                                <!-- Start. Product price-->
                                {if $p->firstVariant->toCurrency() > 0}
                                    <span class="current-prices f-s_0">
                                        <span class="price-new">
                                            <span>
                                                <span class="curr">{$CS}</span><span class="price priceVariant">{echo $p->firstVariant->toCurrency()}</span>
                                            </span>
                                        </span>
                                        {if $NextCS != null}
                                            <span class="price-add">
                                                <span>
                                                    <span class="curr-add">{$NextCS}</span><span class="price addCurrPrice">{echo $p->firstVariant->toCurrency('Price',$NextCSId)}</span>
                                                </span>
                                            </span>
                                        {/if}
                                    </span>
                                {/if}
                                <!-- End. Product price-->
                            </div>
                            <!-- End. Prices-->
                        </div>
                        <div class="funcs-buttons">
                            <!-- Start. Collect information about Variants, for future processing -->
                            {foreach $variants as $key => $pv}
                                <div class="btn-create-shop2">
                                    <a href="{echo shop_url('product/'.$p->getUrl())}">
                                        <span class="text-el">{lang('Подробнее', 'newLevel')}</span>
                                    </a>
                                </div>
                                <div class="btn-primary big">
                                    <a href="#">
                                        <span class="text-el">{lang('Демо', 'newLevel')}</span>
                                    </a>
                                </div>
                            {/foreach}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
{/foreach}