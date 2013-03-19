        <div class="content_head">
            <h1>Корзина</h1>
        </div>
        {if count($items) > 0}
        <form method="POST" action="{shop_url('cart')}">
        <ul class="catalog">
          {foreach $items as $key=>$item}
            {$variants = $item.model->getProductVariants()}
            {foreach $variants as $v}
                {if $v->getId() == $item.variantId}
                    {$variant = $v}
                {/if}
            {/foreach}
            <li>
                <div class="top_frame_tov">
                    <span class="figure">
                        <a href="{shop_url('product/' . $item.model->getUrl())}">
                            <img src="{productImageUrl($item.model->getMainModimage())}"/>
                        </a>
                        <a href="{shop_url('cart/delete/'.$key)}" class="remove_ref red"><span>×</span> Удалить</a>
                    </span>
                    <span class="descr">
                        <a href="{shop_url('product/' . $item.model->getUrl())}" class="title">{echo ShopCore::encode($item.model->getName())}</a>
                        <span class="d_b price">{$summary = $variant->getPrice() * $item.quantity}{echo $summary} {$CS}</span>
                        <input type="text" price="{echo $variant->getPrice()}" value="{$item.quantity}" onblur=""/><span class="count">шт.</span>
                    </span>
                </div>
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
                    <input type="submit" name="setOrderMobile" value="Оформить заказ" class="v-a_m"/>
                </span>
            </span>
        </div>
        <div class="main_f_i_f-r"></div>
        {form_csrf()}
        </form>
        {else:}
        <div class="main_frame_inside">
            <div class="gen_sum">
                <span class="total_pay">{echo ShopCore::t('Корзина пуста')}</span>
            </div>
        </div>
        {/if}