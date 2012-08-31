        {if count($items) > 0}
        <div class="content_head">
            <h1>Оформление заказа</h1>
            <p class="alert">Способ оплаты и доставки вы сможете согласовать с менеджером, который свяжется с вами после оформления заказа.</p>
        </div>
        <hr class="head_cle_foot"/>
        <form method="post" action="{site_url(uri_string())}" id="cartForm">
            <div class="main_frame_inside">
                {if validation_errors()}
                <label><span class="red d_b">{validation_errors()}</span></label>
                {/if}
                <label>
                    Ваше имя:
                    <input type="text" name="userInfo[fullName]" />
                </label>
                <label>
                    Email:
                    <input type="text" name="userInfo[email]" />
                </label>
                <label>
                    Номер мобильного телефона:
                    <input type="text" name="userInfo[phone]" />
                </label>
                <label>
                    Коментарий к заказу:
                    <textarea name="userInfo[commentText]"></textarea>
                </label>
            </div>
            <div class="main_f_i_f-r"></div>
            <div class="content_head">
                <div class="title_h1">Ваш заказ</div>
            </div>
            <ul class="catalog">
            {foreach $items as $key=>$item}
            {$variants = $item.model->getProductVariants()}
            {foreach $variants as $v}
                {if $v->getId() == $item.variantId}
                    {$variant = $v}
                {/if}
            {/foreach}
                <li>
                    <a href="{shop_url('product/' . $item.model->getUrl())}" class="top_frame_tov">
                        <span class="figure"><img src="{productImageUrl($item.model->getMainModimage())}"/></span>
                        <span class="descr">
                            <span class="title">{echo ShopCore::encode($item.model->getName())}</span>
                            <input name="products[{$key}]" type="hidden" value="{$item.quantity}"/>
                            <span class="d_b price">{$summary = $variant->getPrice() * $item.quantity}{echo $summary} {$CS}</span>
                        </span>
                    </a>
                </li>
            {$total     += $summary}
            {$total_nc  += $summary_nextc}
            {/foreach}
            </ul>
            <div class="main_frame_inside">
                <div class="gen_sum">
                    <span class="total_pay">Всего к оплате:</span>
                    <span class="price">
                        {if $total < $item.delivery_free_from}
                        {$total += $item.delivery_price}
                        {/if}
                        {if isset($item.gift_cert_price)}
                            {$total -= $item.gift_cert_price}
                        {/if}
                        {echo $total} {$CS}
                    </span>
                </div>
                <span class="but_buy inp">
                    <span class="b_buy_in">
                        <span class="helper"></span>
                        <input type="submit" value="Оформить заказ" class="v-a_m"/>
                    </span>
                </span>
            </div>
            <!-- <input type="hidden" name="userInfo[email]" value="mobile@device.order" /> -->
            <input type="hidden" name="deliveryMethodId" value="7"/>
            <input type="hidden" name="paymentMethodId" value="1"/>
            <input type="hidden" name="setOrderMobile" value="1"/>
            <input type="hidden" name="makeOrder" value="1"/>
        {form_csrf()}
        </form>
        <div class="main_f_i_f-r"></div>
        {else:}
        <div class="content_head">
            <h1>Оформление заказа</h1>
        </div>
        <div class="main_frame_inside">
            <div class="gen_sum">
                <span class="total_pay">{echo ShopCore::t('Корзина пуста')}</span>
            </div>
        </div>
        {/if}