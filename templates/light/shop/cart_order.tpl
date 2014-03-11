<script type="text/javascript">
    totalItemsBask = {echo $totalItems}
</script>
{if $gift_key}
    <input type="hidden" name="gift" value="{echo $gift_key}"/>
    <input type="hidden" name="gift_ord" value="1"/>
{/if}
<table class="table-order table-order-view">
    <thead>
        <tr>
            <th>{lang('Товар', 'newLevel')}</th>
            <th>{lang('Кол-во', 'newLevel')}</th>
            <th>{lang('Cумма', 'newLevel')}</th>
        </tr>
    </thead>
    <tbody>
        {foreach $items as $item}
            <!-- Start. For single product -->
            {if  $item->instance == 'SProducts'}
                <tr class="items items-bask cart-product">
                    <td class="frame-items">
                        <a href="{echo shop_url('product/'.$item->getSProducts()->getUrl())}" class="frame-photo-title">
                            <span class="photo-block">
                                <span class="helper"></span>
                                <img src="{echo $item->getSmallPhoto()}" alt="">
                            </span>
                            <span class="title">{echo $item->getSProducts()->getName()}</span>
                        </a>
                        <div class="description">
                            {if $item->getName() && trim($item->getName()) != trim($item->getSProducts()->getName())}
                                <span class="frame-variant-name">
                                    <span class="text-el">{lang('Вариант','newLevel')}</span>
                                    <span class="code">({echo trim($item->getName())})</span>
                                </span>
                            {/if}
                            {if $item->getNumber()}
                                <span class="frame-variant-code">{lang('Артикул','newLevel')}  
                                    <span class="code">({echo $item->getNumber()})
                                    </span>
                                </span> 
                            {/if}
                        </div>
                    </td>
                    <td>
                        <div class="frame-frame-count">
                            <div class="frame-count">
                                <span class="plus-minus">{echo $item->quantity}</span>
                            </div>
                        </div>
                    </td>
                    <td class="frame-cur-sum-price">
                        <span class="title">{lang('Сумма','newLevel')}: </span>
                        <div class="frame-prices f-s_0">
                            {if ShopCore::app()->SCurrencyHelper->convert($item->originPrice) != ShopCore::app()->SCurrencyHelper->convert($item->price)}
                                <span class="price-discount">
                                    <span>
                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->originPrice) * $item->quantity}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                            {/if}
                            <span class="current-prices f-s_0">
                                <span class="price-new">
                                    <span>
                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->price * $item->quantity)}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                                {/*}
                                {if $NextCSId}
                                    <span class="price-add">
                                        <span>
                                            <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->price * $item->quantity, $NextCSId)}</span>
                                            <span class="curr">{$NextCS}</span>
                                        </span>
                                    </span>
                                {/if}
                                { */}
                            </span>
                        </div>
                    </td>
                </tr>
            {else:}
                <!-- Start. Shop kit -->
                <tr class="row row-kits">
                    <td class="frame-items frame-items-kit">
                        <div class="title-h3 c_9">{lang('Комплект товаров', 'newLevel')}</div>
                        <ul class="items items-bask">
                            {foreach $item->items as $k => $kitItem}
                                <li>
                                    {if $k != 0}
                                        <div class="next-kit">+</div>
                                    {/if}
                                    <div class="frame-kit">
                                        <a class="frame-photo-title" href="{echo shop_url('product/'.$kitItem->getSProducts()->getUrl())}">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="{echo $kitItem->getSmallPhoto()}">
                                            </span>
                                            <span class="title">{echo $kitItem->getSProducts()->getName()}</span>
                                        </a>
                                        <div class="description">
                                            {if $kitItem->getName() && trim($kitItem->getName()) != trim($kitItem->getSProducts()->getName())}
                                                <span class="frame-variant-name">
                                                    <span class="text-el">{lang('Вариант','newLevel')}</span>
                                                    <span class="code">({echo $kitItem->getName()})</span>
                                                </span>
                                            {/if}
                                            {if $kitItem->getSProducts()->getNumber()}
                                                <span class="frame-variant-code">{lang('Артикул','newLevel')}  
                                                    <span class="code">({echo $kitItem->getSProducts()->getNumber()})
                                                    </span>
                                                </span> 
                                            {/if}
                                        </div>
                                    </div>
                                </li>
                            {/foreach}
                        </ul>
                    </td>
                    <td>
                        <div class="frame-frame-count">
                            <div class="frame-count">
                                <span class="plus-minus">{echo $item->quantity}</span>
                            </div>
                        </div>
                    </td>
                    <td class="frame-cur-sum-price">
                        <span class="title">{lang('Сумма','newLevel')}: </span>
                        <div class="frame-prices f-s_0">
                            {if ShopCore::app()->SCurrencyHelper->convert($item->originPrice) != ShopCore::app()->SCurrencyHelper->convert($item->price)}
                                <span class="price-discount">
                                    <span>
                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->originPrice * $item->quantity)}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                            {/if}
                            <span class="current-prices f-s_0">
                                <span class="price-new">
                                    <span>
                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->price)}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                                {/*}
                                {if $NextCSId}
                                    <span class="price-add">
                                        <span>
                                            <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->price * $item->quantity, $NextCSId)}</span>
                                            <span class="curr">{$NextCS}</span>
                                        </span>
                                    </span>
                                {/if}
                                { */}
                            </span>
                        </div>
                    </td>
                </tr>
                <!-- End. Shop kit -->
            {/if}
        {/foreach}   
    </tbody>
    <tfoot class="gen-info-price">
        {if $discount_val}
            <tr>
                <td colspan="3">
                    <span class="s-t f_l">{lang('Начальная стоимость товаров','newLevel')}:</span>
                    <div class="f_r">                
                        <span class="price f-w_b">{echo ShopCore::app()->SCurrencyHelper->convert($cartOriginPrice)}</span>
                        <span class="curr"> {$CS}</span>
                    </div>
                </td>
            </tr>
        {/if}
        <tr>
            <td colspan="3">
                <span class="s-t f_l">{lang('Cтоимость товаров','newLevel')}:</span>
                <div class="f_r">
                    <span class="price f-w_b">{echo ShopCore::app()->SCurrencyHelper->convert($cartPrice)}</span>
                    <span class="curr">{$CS}</span>
                </div>
            </td>
        </tr>
        {if $deliveryMethod && $deliveryMethod->getPrice() != 0 || $deliveryMethod && $deliveryMethod->getDeliverySumSpecifiedMessage() != ''}
            <tr>
                <td colspan="3">
                    <span class="s-t f_l">{lang('Доставка','newLevel')}:</span>
                    <div class="f_r">
                        {if !$deliveryMethod->getDeliverySumSpecified()}
                            {$priceDel = $deliveryMethod->getPrice()}
                            {$priceDelAdd = ShopCore::app()->SCurrencyHelper->convert($deliveryMethod->getPrice(), $NextCSId)}
                            {$priceDelFreeFrom = ceil($deliveryMethod->getFreeFrom())}

                            {if $cartPrice < $priceDelFreeFrom}
                                {$cartPrice += $priceDel}
                                <span class="price f-w_b">{echo $priceDel}</span>
                                <span class="curr">{$CS}</span>
                                (<span class="price f-w_b">{echo $priceDelAdd}</span>
                                <span class="curr-add">{$NextCS}</span>)
                                <span class="not-delivery-price"></span>
                            {else:}
                                <span class="text-el s-t">{lang('Бесплатно', 'newLevel')}</span>
                            {/if}
                        {else:}
                            <span class="text-el s-t">{echo $deliveryMethod->getDeliverySumSpecifiedMessage()}</span>
                        {/if}
                    </div>
                </td>
            </tr>
        {/if}
        {if $discount_val}
            <tr>
                <td colspan="3">
                    <span class="s-t f_l">{lang('Ваша текущая скидка','newLevel')}:</span>
                    <div class="text-discount current-discount f_r">
                        <span class="price f-w_b">{echo ShopCore::app()->SCurrencyHelper->convert($discount_val)}</span>
                        <span class="curr">{$CS}</span>
                    </div>
                </td>
            </tr>
        {/if}
        {if $gift_val}
            <tr>
                <td colspan="3">
                    <span class="s-t f_l">{lang('Подарочный сертификат','newLevel')}:</span>
                    <div class="text-discount f_r">
                        <span class="price f-w_b">{echo ShopCore::app()->SCurrencyHelper->convert($gift_val)}</span>
                        <span class="curr">{$CS}</span>
                    </div>
                </td>
            </tr>
        {elseif $CI->load->module('mod_discount/discount_api')->isGiftCertificat()}
            <tr>
                <td colspan="3">
                    <div class="clearfix">
                        <span class="s-t f_l">{lang('Подарочный сертификат','newLevel')}:</span>
                        <div class="frame-gift f_r">
                            {if $gift_error}
                                <div class="msg">
                                    <div class="error">
                                        <span class="icon_error"></span>
                                        <span class="text-el">{lang('Неверный подарочный сертификат', 'newLevel')}</span>
                                    </div>
                                </div>
                            {else:}
                                <div class="btn-toggle-gift">
                                    <button type="button" class="d_l_1" data-drop="#gift" data-place="inherit" data-overlay-opacity="0">
                                        <span class="text-el">{lang('Ввести промо-код', 'newLevel')}</span>
                                    </button>
                                </div>
                            {/if}
                            <div id="gift" class="{if !$gift_error}drop{/if} o_h">
                                <div class="btn-def f_r">
                                    <button type="button" id="giftButton">
                                        <span class="text-el">{lang('Применить', 'newLevel')}</span>
                                    </button>
                                </div>
                                <div class="o_h">
                                    <input type="text" name="gift"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        {/if}
    </tfoot>
</table>
<div class="gen-sum-order footer-bask">
    <div class="inside-padd clearfix">
        <span class="title f_l">{lang('К оплате с учетом доставки','newLevel')}:</span>
        <span class="frame-prices f_r">
            <span class="current-prices f-s_0">
                <span class="price-new">
                    <span>
                        <span class="price" id="finalAmount">
                            {echo ShopCore::app()->SCurrencyHelper->convert($cartPrice)}
                        </span>
                        <span class="curr">{$CS}</span>
                    </span>
                </span>
                {if $NextCS != null}
                    <span class="price-add">
                        <span>
                            (<span class="price" id="finalAmountAdd">{echo ShopCore::app()->SCurrencyHelper->convert($cartPrice, $NextCSId)}</span>
                            <span class="curr-add">{$NextCS}</span>)
                        </span>
                    {/if}
                </span>
            </span>
        </span>
    </div>
</div>
<div class="preloader" style="display: none;"></div>