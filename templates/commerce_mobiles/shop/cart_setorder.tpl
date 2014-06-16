<div class="content_head">
    <h1>{lang('Корзина','commerce_mobiles')}</h1>
</div>
{if count($items) > 0}
    <form id="form" method="POST" action="{shop_url('cart')}">
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
                        <a href="{shop_url('product/' . $item.model->getUrl())}" class="top_frame_tov">
                            <span class="figure">
                                <img src="{echo $variant->getMediumPhoto()}"/>
                            </span>
                            <span class="descr">
                                <span class="title">{echo ShopCore::encode($item.model->getName())}</span>
                                {if $item.variantName}
                                    <span class="code_v">{lang('Вариант', 'commerce_mobiles')}: {echo $item.variantName}</span>
                                {/if}
                                {if $variant->getNumber()}
                                    <span class="divider">/</span>
                                    <span class="code">{lang('Артикул', 'commerce_mobiles')}: {echo $variant->getNumber()}</span>
                                {/if}
                                <span class="d_b price">{echo $item.price} {$CS}</span>
                            </span>
                        </a>
                        <span class="descr">
                            <input name="products[{$key}]" type="text" price="{echo $item.price}" value="{$item.quantity}" onblur=""/>
                            <span class="frame_count">
                                <span class="refresh_price"></span>
                                <span class="count">{lang('шт','commerce_mobiles')}.</span>
                            </span>
                            <a href="{shop_url('cart/delete/'.$key)}" class="remove_ref red"><span>×</span> {lang('Удалить','commerce_mobiles')}</a>
                        </span>
                    </div>
                </li>
                {$summary = $item.price * $item.quantity}
                {$total     += $summary}
                {$total_nc  += $summary_nextc}
            {/foreach}
        </ul>
        <div class="main_frame_inside">
            <div class="gen_sum">
                <span class="total_pay">{lang('Всего к оплате','commerce_mobiles')}:</span>
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
                    <input type="submit" name="setOrderMobile" value="Оформить заказ" class="v-a_m input_order"/>
                </span>
            </span>
        </div>
        <div class="main_f_i_f-r"></div>
        <input id="recount" type="hidden" name="recount" value="0" />
        {form_csrf()}
    </form>
{else:}
    <div class="main_frame_inside">
        <div class="gen_sum">
            <span class="total_pay">{echo ShopCore::t('Корзина пуста')}</span>
        </div>
    </div>
{/if}
