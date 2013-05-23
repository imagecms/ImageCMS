{if count($goods_in_spy) > 0}
    <div class="title_h2">Товары за которыми следите:</div>
    <ul class="items items-complect clearfix">
        {foreach $goods_in_spy as $good}
            {$p = getProduct($good->getProductId())}
            {$v = getVariant($good->getVariantId())}
            <li>
                <a href="{shop_url('product/' . $p->getUrl())}">
                    <span class="photo-block">
                        <span class="helper"></span>
                        {if $p->getSmallImage()}
                            <img alt="{echo ShopCore::encode($p->getName())}" src="{productImageUrl($p->getSmallImage())}">
                        {else:}
                            <img alt="{echo ShopCore::encode($p->getName())}" src="{productImageUrl('no_s.png')}">
                        {/if}

                        {if $p->getOldPrice() > $p->firstVariant->getPrice()}
                            {$discount = round(100 - ($p->firstVariant->getPrice() / $p->getOldPrice() * 100))}
                        {else:}
                            {$discount = 0}
                        {/if}
                        {promoLabel($p->getHit(), $p->getHot(), $discount)}
                    </span>
                    <span class="title">{echo ShopCore::encode($p->getName())}</span>
                </a>
                <div class="description">
                    <div class="o_h">
                        {if $p->getOldPrice() > $v->getPrice()}
                            <div class="d_i-b m-r_10">
                                <span><span class="old-price"><span>{echo round_price($p->getOldPrice())} <span class="cur">{$CS}</span></span></span></span>
                            </div>
                        {/if}
                        {if $v->getPrice() > 0}
                            <div class="price-complect d_i-b">
                                <div>{echo $v->getPrice()} <span class="cur">{$CS}</span></div>
                            </div>
                        {/if}
                    </div>
                </div>
                <span class="icon_times-apply deleteFromSpy" data-uid="{echo $_SESSION[DX_user_id]}" data-vid="{echo $v->getId()}"></span>
            </li>
        {/foreach}
    </ul>
{else:}
    <div class="title_h4">Слежку на товары не установлено</div>
{/if}