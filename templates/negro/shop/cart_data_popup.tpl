{$inCart = ShopCore::app()->SCart->getData()}
<div class="fancy-cleaner fancy">
    {if count($inCart) > 0}
        <div class="inside-padd frame-cleaner-main">
            <form method="post" action="{shop_url('cart')}" id="order_form">
                <div class="title_h3">В вашей корзине {count($inCart)} {echo SStringHelper::Pluralize(count($inCart), array('товар','товара','товаров'))} на сумму
                    <span class="price-order">
                        <span><span class="totalCartHead">0</span> <span class="cur">{$CS}</span></span>
                    </span>
                </div>
                <div class="frame-scroll-cleaner">
                    <div class="frame-cleaner-main">
                        <table>
                            <colgroup>
                                <col width="35"/>
                                <col width="130"/>
                                <col width="350"/>
                                <col width="150"/>
                                <col width="150"/>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="2">Товар</th>
                                    <th class="t-a_c">Кол-во</th>
                                    <th class="t-a_c">Сумма</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$related = array()}
                                {$total_nondisc = $total_final = 0}
                                {foreach $inCart as $key => $item}
                                    {$item_final = $item.quantity * $item.price}

                                    {if $item['instance'] != 'ShopKit'}
                                        {$p = getProduct($item.productId)}
                                        {$v = getVariant($item.variantId)}

                                        {$prod_price = $v->getPrice() * $item.quantity}

                                        {if $item.discount && $item.discount > 0 && ShopCore::$ci->dx_auth->is_logged_in() === true && !isset($prod_discount)}
                                            {$prod_discount = $item.discount}
                                        {/if}

                                        {$avail_products[] = $p->getId()}
                                        {if $p->getRelatedProducts()}
                                            {$arr = explode(',',$p->getRelatedProducts())}
                                            {foreach $arr as $r}
                                                {if !in_array($r, $related)}
                                                    {$related[] = $r}
                                                {/if}
                                            {/foreach}    
                                        {/if}
                                        <tr>
                                            <td class="t-a_c v-a_m">
                                                <button type="button" class="icon_times-order delete_overlay_prod" data-undo="{$key}" data-href="/shop/cart/delete/{$key}"></button>
                                            </td>
                                            <td colspan="2">
                                                <ul class="items items-complect item-order">
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
                                                            <span class="title">{echo ShopCore::encode($p->getName())} {echo ShopCore::encode($v->getName())}</span>
                                                        </a>
                                                        <div class="description">
                                                            {if $v->getPrice() > 0}
                                                                <div class="o_h">
                                                                    <div class="price-complect d_i-b">
                                                                        <div>{echo $v->getPrice()} <span class="cur">{$CS}</span></div>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="t-a_c f-s_0 frame-plus-minus">
                                                <div class="btn-def2 minus disabled">
                                                    <button type="button" {if $item.quantity <= 1}disabled="disabled"{/if}><span class="helper"></span><span>-</span></button>
                                                </div>
                                                <span class="d_i-b number v-a_m" style="width: 43px;"><input type="text" value="{$item.quantity}" class="t-a_c f-s_18 cart_pop_quant" data-title="только цифры" data-min="1" name="products[{$key}]"/></span>
                                                <div class="btn-def2 plus">
                                                    <button type="button"><span class="helper"></span><span>+</span></button>
                                                </div>
                                            </td>
                                            <td class="t-a_c">
                                                {if $comulativ > 0 || $item.discount > 0}
                                                    <span class="old-price"><span>{$prod_price} <span class="cur">{$CS}</span></span></span>
                                                    {$item_final = round_price($item_final - $item_final * $comulativ / 100)}
                                                {/if}
                                                <div class="price-complect f-s_21"><div>{$item_final} <span class="cur">{$CS}</span></div></div>
                                            </td>
                                        </tr>
                                        {$total_nondisc += $prod_price}
                                    {else:}
                                        <!-- комплект -->
                                        {$kitProducts = getKitProducts($item[kitId])}
                                        {$k_main = getProduct($kitProducts[0][main_product])}

                                        {$kit_price = $k_main->firstVariant->getPrice()}
                                        <tr>
                                            <td class="t-a_c v-a_m">
                                                <button type="button" class="icon_times-order delete_overlay_prod" data-undo="{$key}" data-href="/shop/cart/delete/{$key}"></button>
                                            </td>
                                            <td colspan="2">
                                                <ul class="items items-complect">
                                                    <li>
                                                        <div class="f_l">
                                                            <a href="{shop_url('product/' . $k_main->getUrl())}">
                                                                <span class="photo-block">
                                                                    <span class="helper"></span>
                                                                    {if $k_main->getSmallImage()}
                                                                        <img src="{productImageUrl($k_main->getSmallImage())}" alt="{echo ShopCore::encode($k_main->getName())}" />
                                                                    {else:}
                                                                        <img src="{productImageUrl('no_s.png')}" alt="{echo ShopCore::encode($k_main->getName())}" />
                                                                    {/if}
                                                                </span>
                                                                <span class="title">{echo $k_main->getName()}</span>
                                                            </a>
                                                            <div class="description">
                                                                <div class="o_h">
                                                                    <div class="price-complect d_i-b">
                                                                        <div>{echo $k_main->firstVariant->getPrice()} <span class="cur">{$CS}</span></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="f_l plus-complect">+</div>
                                                    </li>
                                                    {$kcnt = count($kitProducts)}
                                                    {foreach $kitProducts as $prod}
                                                        {$p = getProduct($prod[product_id])}

                                                        {$p_disc = $p->firstVariant->getPrice() - ($p->firstVariant->getPrice() * $prod[discount] / 100)}
                                                        {$kit_price += $p->firstVariant->getPrice()}
                                                        <li>
                                                            <div class="f_l">
                                                                <a href="{shop_url('product/' . $p->getUrl())}">
                                                                    <span class="photo-block">
                                                                        <span class="helper"></span>
                                                                        {if $p->getSmallImage()}
                                                                            <img alt="{echo ShopCore::encode($p->getName())}" src="{productImageUrl($p->getSmallImage())}">
                                                                        {else:}
                                                                            <img alt="{echo ShopCore::encode($p->getName())}" src="{productImageUrl('no_s.png')}">
                                                                        {/if}
                                                                    </span>
                                                                    <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                                                </a>
                                                                <div class="description">
                                                                    <div class="o_h">
                                                                        <div class="d_i-b m-r_10">
                                                                            <span><span class="old-price"><span>{echo $p->firstVariant->getPrice()} <span class="cur">{$CS}</span></span></span></span>
                                                                        </div>
                                                                        <div class="price-complect d_i-b">
                                                                            <div>{$p_disc} <span class="cur">{$CS}</span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="f_l plus-complect">{if $kcnt == 1}={else:}+{/if}</div>
                                                            {$kcnt --}
                                                        </li>
                                                    {/foreach}
                                                </ul>
                                            </td>
                                            <td class="t-a_c f-s_0 frame-plus-minus">
                                                <div class="btn-def2 minus disabled">
                                                    <button type="button" {if $item.quantity <= 1}disabled="disabled"{/if}><span class="helper"></span><span>-</span></button>
                                                </div>
                                                <span class="d_i-b number v-a_m" style="width: 43px;"><input type="text" value="{$item.quantity}" class="t-a_c f-s_18 cart_pop_quant" data-title="только цифры" data-min="1" name="products[{$key}]"/></span>
                                                <div class="btn-def2 plus">
                                                    <button type="button"><span class="helper"></span><span>+</span></button>
                                                </div>
                                                <div class="c_9 m-t_10">Комплект</div>
                                            </td>
                                            <td class="t-a_c">
                                                {if $comulativ > 0 || $item.discount > 0}
                                                    {$item_final = round_price($item_final - $item_final * $comulativ / 100)}
                                                {/if}
                                                <span class="old-price"><span>{$kit_price} <span class="cur">{$CS}</span></span></span>
                                                <div class="price-complect f-s_21"><div>{$item_final} <span class="cur">{$CS}</span></div></div>
                                            </td>
                                        </tr>
                                        {$total_nondisc += $kit_price}
                                    {/if}
                                    {$total_final += $item_final}
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    {foreach $related as $r}
                        {if !in_array($r, $avail_products)}
                            {$related_products[] = $r}
                        {/if}
                    {/foreach}
                    {if count($related_products) > 0}
                        {shuffle($related_products);} 
                        <div class="footer-fancy-cleaner">
                            <div class="title_h2 m-l_42">Рекомендуем добавить к заказу</div>
                            <ul class="items items-complect items items-recomedet clearfix">
                                {$rcnt = 4}
                                {foreach $related_products as $id}
                                    {if $rcnt != 0}
                                        {$p = getProduct($id)}
                                        <li>
                                            <div>
                                                <div class="frame-label f_l goBuy" data-prodid="{echo $p->getId()}" data-varid="{echo $p->firstVariant->getId()}" data-type="check">
                                                    <span class="niceCheck b_n">
                                                        <input type="checkbox" />
                                                    </span>
                                                </div>
                                                <div class="f_l">
                                                    <a href="{shop_url('product/' . $p->getUrl())}">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            {if $p->getSmallImage()}
                                                                <img alt="{echo ShopCore::encode($p->getName())}" src="{productImageUrl($p->getSmallImage())}">
                                                            {else:}
                                                                <img alt="{echo ShopCore::encode($p->getName())}" src="{productImageUrl('no_s.png')}">
                                                            {/if}
                                                            {if $p->getHot()}
                                                                <span class="prod_status nowelty">new</span>
                                                            {/if}
                                                            {if $p->getHit()}
                                                                <span class="prod_status hit">хит</span>
                                                            {/if}
                                                            {if $p->getAction()}
                                                                <span class="prod_status action">акция</span>
                                                            {/if}
                                                        </span>
                                                        <span class="title">{echo ShopCore::encode($p->getName())}</span>
                                                    </a>
                                                    <div class="description">
                                                        <div class="o_h">
                                                            {if $p->getOldPrice() > $p->firstVariant->getPrice()}
                                                                <div class="d_i-b m-r_10">
                                                                    <span><span class="old-price"><span>{echo round_price($p->getOldPrice())} <span class="cur">{$CS}</span></span></span></span>
                                                                </div>
                                                            {/if}
                                                            <div class="price-complect d_i-b">
                                                                <div>{echo $p->firstVariant->getPrice()} <span class="cur">{$CS}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        {$rcnt--}
                                    {else:}
                                        {breack;}
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    {/if}
                </div>
                <table>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="v-a_b" style="padding-right: 0;">
                                <div class="f_l m-t_20">
                                    <div class="c_54 pointer f-s_16 fb_close">← <span class="d_l_green">Продолжить покупки</span></div>
                                </div>
                            </td>
                            <td colspan="3" class="t-a_r">
                                <div class="d_i-b v-a_b">
                                    {if $comulativ > 0}
                                        <div class="f-s_14">Накопительная скидка:
                                            <span class="text-discount">{echo $comulativ}%</span> <span class="old-price"><span>({$total_nondisc} <span class="cur">{$CS}</span>)</span></span>
                                        </div>
                                    {elseif $prod_discount > 0}
                                        <div class="f-s_14">Ваша скидка:
                                            <span class="text-discount">{echo $prod_discount}%</span> <span class="old-price"><span>({$total_nondisc} <span class="cur">{$CS}</span>)</span></span>
                                        </div>
                                    {/if}
                                    {$summary = round_price($total_final)}
                                    <div class="f-s_18">Итого к оплате:
                                        <span class="price-order">
                                            <span>{round_price($summary)} <span class="cur">{$CS}</span></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="v-a_b m-l_20 btn-order-product">
                                    <input type="submit" value="Оформить заказ"/>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                {form_csrf()}
            </form>
        </div>
        <script type="text/javascript">
            totalFullPrice = {$summary};
            $('.totalCartHead').text(totalFullPrice);
        </script>
    {else:}
        <div class="inside-padd frame-cleaner-main">
            <div class="title_h3">В корзине нет товаров</div>
        </div>
        <script type="text/javascript">
            $('#order_form').hide();
            $('#no_products').show();
        </script>
    {/if}
</div>