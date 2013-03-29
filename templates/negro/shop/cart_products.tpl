{$inCart = ShopCore::app()->SCart->getData()}
{$discountCom = ShopCore::app()->SCart->rediscount()}
{if count($discountCom)}
    {$comulativ = $discountCom->getDiscount()}
{/if}

{if $inCart}
    <table>
        <colgroup>
            <col width="35"/>
            <col width="580"/>
            <col width="150"/>
            <col width="150"/>
        </colgroup>
        <thead>
            <tr>
                <th></th>
                <th>Товар</th>
                <th class="t-a_c">Кол-во</th>
                <th class="t-a_c">Сумма</th>
            </tr>
        </thead>
        <tbody>
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
                    {if $item.gift_cert_price && $item.gift_cert_price > 0 && ShopCore::$ci->dx_auth->is_logged_in() === true && !isset($certificate)}
                        {$certificate = $item.gift_cert_price}
                    {/if}


                    <tr>
                        <td class="t-a_c v-a_m">
                            <button type="button" class="icon-times-order delete_overlay_prod" data-undo="{$key}" data-href="/shop/cart/delete/{$key}"></button>
                        </td>
                        <td>
                            <ul class="items-complect item-order">
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
                            <div class="btn btn-def2 minus disabled">
                                <button type="button" {if $item.quantity <= 1}disabled="disabled"{/if}><span class="helper"></span><span>-</span></button>
                            </div>
                            <span class="d_i-b number v-a_m" style="width: 43px;"><input type="text" value="{$item.quantity}" class="t-a_c f-s_18 cart_pop_quant" data-title="только цифры" data-min="1" name="products[{$key}]"/></span>
                            <div class="btn btn-def2 plus">
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

                    {if $item.gift_cert_price && $item.gift_cert_price > 0 && ShopCore::$ci->dx_auth->is_logged_in() === true && !isset($certificate)}
                        {$certificate = $item.gift_cert_price}
                    {/if}
                    <tr>
                        <td class="t-a_c v-a_m">
                            <button type="button" class="icon-times-order delete_overlay_prod" data-undo="{$key}" data-href="/shop/cart/delete/{$key}"></button>
                        </td>
                        <td>
                            <ul class="items-complect">
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
                            <div class="btn btn-def2 minus disabled">
                                <button type="button" {if $item.quantity <= 1}disabled="disabled"{/if}><span class="helper"></span><span>-</span></button>
                            </div>
                            <span class="d_i-b number v-a_m" style="width: 43px;"><input type="text" value="{$item.quantity}" class="t-a_c f-s_18 cart_pop_quant" data-title="только цифры" data-min="1" name="products[{$key}]"/></span>
                            <div class="btn btn-def2 plus">
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
        <tfoot>
            <tr>
                <td colspan="4" class="t-a_r">
                    {if $comulativ > 0 || $prod_discount > 0}
                        {if $comulativ > 0}
                            <span>Накопительная скидка:</span> <span class="text-discount">{echo $comulativ}%</span> <span class="old-price"><span>({$total_nondisc} <span class="cur">{$CS}</span>)</span></span>
                        {elseif $prod_discount > 0}
                            Ваша скидка: <span class="text-discount">{echo $prod_discount}%</span> <span class="old-price"><span>({$total_nondisc} <span class="cur">{$CS}</span>)</span></span>
                        {/if}
                    {/if}

                    {$summary = $total_final - $certificate}
                    {if $certificate && $certificate > 0}
                        Подарочный сертификат: <span class="text-discount">-{echo $certificate} {$CS}</span>
                    {else:}
                        {$summary = $total_final}
                    {/if}
                    <span class="m-l_5">В сумме:
                        <span class="price-order f-s_21">
                            <span>{$summary} <span class="cur">{$CS}</span></span>
                        </span>
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="forCart" value="1" />


    <div class="cert_alert d_n">
        {if $msg}
            <div class="msg">
                {if $msg == 1}
                    <span class="notice" data-type="notice">Вы использовали сертификат!</span>
                {elseif $msg == 2}
                    <span class="error" data-type="error">Не верный ключ сертификата!</span>
                {/if}
            </div>
        {/if}
    </div>

    <script type="text/javascript">
        $(".cert_drop_container").html( $('.cert_alert').html() );
        
        totalFullPrice = {$summary};
        totalProductPrice = {$total_nondisc};
        {if $comulativ > 0}
            discType = "comulativ";
            userDiscount = {echo $comulativ};
        {elseif $prod_discount > 0}
            discType = "product";
            userDiscount = {$prod_discount};
        {else:}
            discType = "none";
        {/if}
    </script>
{else:}
    <div class="title_h3 green">В корзине нет товаров</div>
    <script type="text/javascript">
        $('#order_form').hide();
        $('#no_products').removeClass('d_n');
    </script>
{/if}
