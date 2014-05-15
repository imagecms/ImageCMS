<script type="text/javascript">
    totalItemsBask = {if $totalItems}{echo $totalItems}{else:}0{/if};
</script>
<div class="frame-bask frameBask p_r">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    {if $totalItems > 0}
        <div class="drop-header">
            <div class="title bask"><span>{lang('Корзина товаров','box')}</span></div>
        </div>
        <div class="drop-content">
            <div class="inside-padd">
                <table class="table-order">
                    <tbody>
                        {foreach $items as $item}
                            <!-- for single product -->
                            {if $item->instance === "SProducts"}
                                <tr data-id="{echo $item->getId()}" class="items items-bask cart-product">
                                    <td class="frame-remove-bask-btn">
                                        <button type="button" class="icon_times_cart" onclick="Shop.Cart.remove({echo $item->getId()})"></button>
                                    </td>
                                    <td class="frame-items">
                                        <a href="{echo shop_url('product/'.$item->getSProducts()->getUrl())}" title="{echo $item->getName()}" class="frame-photo-title">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="{echo $item->getSmallPhoto()}" alt="{echo $item->getName()}"/>
                                            </span>
                                            <span class="title">{echo $item->getSProducts()->getName()}</span>
                                        </a>
                                        <div class="description">
                                            {if $item->getName() && trim($item->getName()) != trim($item->getSProducts()->getName())}
                                                <span class="frame-variant-name">
                                                    <span class="code">{lang('Вариант','box')}:</span>
                                                    <span class="text-el">{echo trim($item->getName())}</span>
                                                </span>
                                            {/if}
                                        </div>
                                    </td>
                                    <td class="frame-count frameCount">
                                        <div class="number js-number" data-title="{lang('Количество на складе','box')} {echo $item->getStock()}">
                                            <input type="text" value="{echo $item->quantity}" class="plusMinus plus-minus" id="inputChange{echo $item->getId()}" data-id="{echo $item->getId()}" data-title="{lang('Только цифры','box')}" data-min="1" data-max="{echo $item->getStock()}"/>
                                        </div>
                                        <span class="s-t f-s_13">{lang('шт.', 'box')}</span>
                                    </td>
                                    <td class="frame-cur-sum-price">
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
                                <tr class="row-kits" data-id="{echo $item->getId()}">
                                    <td class="frame-remove-bask-btn">
                                        <button type="button" class="icon_times_cart" onclick="Shop.Cart.remove({echo $item->getId()}, true)"></button></button>
                                    </td>
                                    <td class="frame-items frame-items-kit">
                                        <div class="title">{lang('Комплект товаров', 'box')}</div>
                                        <ul class="items items-bask">
                                            {foreach $item->items as $k => $kitItem}
                                                <li>
                                                    {if $k != 0}
                                                        <div class="next-kit">+</div>
                                                    {/if}
                                                    <div class="frame-kit{if $k === 0} main-product{/if}">
                                                        <a class="frame-photo-title" href="{echo shop_url('product/'.$kitItem->getSProducts()->getUrl())}">
                                                            <span class="photo-block">
                                                                <span class="helper"></span>
                                                                <img src="{echo $kitItem->getSmallPhoto()}">
                                                            </span>
                                                            <span class="title">{echo $kitItem->getSProducts()->getName()}</span>
                                                        </a>
                                                        <div class="description">
                                                            {if $item->getName() && trim($kitItem->getName()) != trim($kitItem->getSProducts()->getName())}
                                                                <span class="frame-variant-name">
                                                                    <span class="code">{lang('Вариант','box')}:</span>
                                                                    <span class="text-el">{echo $kitItem->getName()}</span>
                                                                </span>
                                                            {/if}
                                                        </div>
                                                    </div>
                                                </li>
                                            {/foreach}
                                        </ul>
                                    </td>
                                    <td class="frame-count">
                                        <div class="number js-number" data-title="{lang('Количество на складе','box')} {echo $item->getStock()}">
                                            <input type="text" value="{echo $item->quantity}" class="plusMinus plus-minus" id="inputChange{echo $item->getId()}" data-id="{echo $item->getId()}" data-kit="1" data-title="{lang('Только цифры','box')}" data-min="1" data-max="{echo $item->getStock()}"/>
                                        </div>
                                        <span class="f-s_13 s-t">{lang('шт.', 'box')}</span>
                                    </td>
                                    <td class="frame-cur-sum-price">
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
                            {/if}
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer-bask drop-footer">
            <div class="inside-padd">
                <div class="clearfix">
                    <div class="f_l isCart">
                        <button type="button" data-closed="closed-js">
                            <span class="text-el"><span class="f-s_14 ref2">←</span> <span class="d_l_3">{lang('Вернуться к оформлению','box')}</span></span>
                        </button>
                    </div>
                    <div class="f_r">
                        {if $discount_val}
                            <span class="frame-discount">
                                <span class="s-t">{lang('Ваша скидка','box')}:</span>
                                <span class="text-discount current-discount"><span class="text-el">-{echo ShopCore::app()->SCurrencyHelper->convert($discount_val)}</span> <span class="curr">{$CS}</span></span>
                            </span>
                        {/if}
                        <span class="c_6 f-s_13">{lang('Сумма товаров','box')}:</span>
                        <span class="frame-cur-sum-price">
                            <span class="frame-prices f-s_0">
                                {if $discount_val}
                                    <span class="price-discount">
                                        <span>
                                            <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($cartOriginPrice)}</span>
                                            <span class="curr">{$CS}</span>
                                        </span>
                                    </span>
                                {/if}
                                <span class="current-prices f-s_0">
                                    <span class="price-new">
                                        <span>
                                            <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($cartPrice)}</span>
                                            <span class="curr">{$CS}</span>
                                        </span>
                                    </span>
                                    {if $NextCSId}
                                        <span class="price-add">
                                            <span>
                                                <span class="price">({echo ShopCore::app()->SCurrencyHelper->convert($cartPrice, $NextCSId)}</span>
                                                <span class="curr-add">{$NextCS})</span>
                                            </span>
                                        </span>
                                    {/if}
                                </span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="content-frame-foot notCart">
                <div class="clearfix inside-padd">
                    <div class="f_l" style="margin-top: 9px;">
                        <button type="button" data-closed="closed-js">
                            <span class="text-el"><span class="f-s_14 ref2">←</span> <span class="d_l_3">{lang('Продолжить покупки','box')}</span></span>
                        </button>
                    </div>
                    <div class="btn-buy btn-buy-p btn-buy-pp f_r">
                        <a href="{shop_url('cart')}">
                            <span class="text-el">{lang('Оформить заказ','box')}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    {else:}
        <div class="drop-header">
            <div class="title">{lang('Ваша корзина','box')} <span class="add-info">{lang('пуста','box')}</span></div>
        </div>
        <div class="drop-content is-empty">
            <div class="inside-padd">
                <div class="msg f-s_0">
                    <div class="success"><span class="icon_info"></span><span class="text-el">{lang('Вы удалили все элементы из корзины','box')}</span></div>
                </div>
                <div class="notCart">
                    <button type="button" data-closed="closed-js">
                        <span class="text-el"><span class="f-s_14 ref2">←</span> <span class="d_l_3">{lang('Продолжить покупки','box')}</span></span>
                    </button>
                </div>
            </div>
        </div>
    {/if}
    <div class="preloader" style="display: none;"></div>
</div>
