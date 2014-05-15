<script type="text/javascript">
    totalItemsBask = {if $totalItems}{echo $totalItems}{else:}0{/if};
</script>
<div class="frame-bask frameBask p_r">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    {if $totalItems > 0}
        <div class="drop-header">
            <div class="title bask"><span>{lang('В корзине','newLevelVertical')}</span><span class="add-info"><span class="topCartCount"> {echo $totalItems}</span></span> <span class="plurProd">{echo SStringHelper::Pluralize($totalItems, array(lang('товар','newLevelVertical'),lang('товара','newLevelVertical'),lang('товаров','newLevelVertical')))}</span> <span>{lang('Сумма','newLevelVertical')}</span> <span class="add-info"><span class="topCartTotalPrice">{echo ShopCore::app()->SCurrencyHelper->convert($cartPrice)}</span></span> <span class="curr">{$CS}</span></div>
        </div>
        <div class="drop-content">
            <div class="inside-padd">
                <table class="table-order">
                    <tbody>
                        {foreach $items as $item}
                            <!-- for single product -->
                            {if $item->instance === "SProducts"}
                                <tr data-id="{echo $item->getId()}" class="items items-bask cart-product items-product">
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
                                                    <span class="text-el">{lang('Вариант','newLevelVertical')}</span>
                                                    <span class="code">({echo trim($item->getName())})</span>
                                                </span>
                                            {/if}
                                            {if $item->getNumber()}
                                                <span class="frame-variant-code">{lang('Артикул','newLevelVertical')}  
                                                    <span class="code">({echo $item->getNumber()})
                                                    </span>
                                                </span> 
                                            {/if}
                                        </div>
                                    </td>
                                    <td class="frame-count frameCount">
                                        <span class="count-or-compl">{lang('Количество', 'newLevelVertical')}:</span>
                                        <div class="number js-number" data-title="{lang('Количество на складе','newLevelVertical')} {echo $item->getStock()}">
                                            <div class="frame-change-count" data-id="{echo $item->getId()}">
                                                <div class="btn-plus">
                                                    <button type="button">
                                                        <span class="icon-plus"></span>
                                                    </button>
                                                </div>
                                                <div class="btn-minus">
                                                    <button type="button">
                                                        <span class="icon-minus"></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="text" value="{echo $item->quantity}" class="plusMinus plus-minus" id="inputChange{echo $item->getId()}" data-id="{echo $item->getId()}" data-title="{lang('Только цифры','newLevelVertical')}" data-min="1" data-max="{echo $item->getStock()}"/>
                                        </div>
                                    </td>
                                    <td class="frame-cur-sum-price">
                                        <span class="title">{lang('Сумма','newLevelVertical')}: </span>
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
                                        <ul class="items items-bask items-product">
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
                                                                    <span class="text-el">{lang('Вариант','newLevelVertical')}</span>
                                                                    <span class="code">({echo $kitItem->getName()})</span>
                                                                </span>
                                                            {/if}
                                                            {if $kitItem->getSProducts()->getNumber()}
                                                                <span class="frame-variant-code">
                                                                    <span class="text-el">{lang('Артикул','newLevelVertical')}</span>
                                                                    <span class="code">({echo $kitItem->getSProducts()->getNumber()})</span>
                                                                </span> 
                                                            {/if}
                                                        </div>
                                                    </div>
                                                </li>
                                            {/foreach}
                                        </ul>
                                    </td>
                                    <td class="frame-count">
                                        <span class="count-or-compl">{lang('Количество', 'newLevelVertical')}:</span>
                                        <div class="number js-number" data-title="{lang('Количество на складе','newLevelVertical')} {echo $item->getStock()}">
                                            <div class="frame-change-count" data-id="{echo $item->getId()}">
                                                <div class="btn-plus">
                                                    <button type="button">
                                                        <span class="icon-plus"></span>
                                                    </button>
                                                </div>
                                                <div class="btn-minus">
                                                    <button type="button">
                                                        <span class="icon-minus"></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="text" value="{echo $item->quantity}" class="plusMinus plus-minus" id="inputChange{echo $item->getId()}" data-id="{echo $item->getId()}" data-kit="1" data-title="{lang('Только цифры','newLevelVertical')}" data-min="1" data-max="{echo $item->getStock()}"/>
                                        </div>
                                    </td>
                                    <td class="frame-cur-sum-price">
                                        <span class="title">{lang('Сумма','newLevelVertical')}: </span>
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
                    {if $discount_val}
                        <span class="frame-discount">
                            <span class="s-t">{lang('Ваша текущая скидка','newLevelVertical')}:</span>
                            <span class="text-discount current-discount"><span class="text-el">{echo ShopCore::app()->SCurrencyHelper->convert($discount_val)}</span> <span class="curr">{$CS}</span></span>
                        </span>
                    {/if}      
                    <div class="btn-form f_l isCart">
                        <button type="button" data-closed="closed-js">
                            <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к оформлению','newLevelVertical')}</span>
                        </button>
                    </div>
                    <span class="s-t">{lang('Всего','newLevelVertical')}:</span>
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
                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($cartPrice, $NextCSId)}</span>
                                        <span class="curr-add">{$NextCS}</span>
                                    </span>
                                </span>
                            {/if}
                        </span>
                    </span>
                    <br />
                    {if $overloadedDiscounts}
                        <span class="s-t">
                            {lang('Для некоторых скидок превышено их максимальное количество использования','newLevelVertical')}
                        </span>
                    {/if}
                </div>
            </div>
            <div class="content-frame-foot notCart">
                <div class="clearfix inside-padd">
                    <div class="btn-form f_l">
                        <button type="button" data-closed="closed-js">
                            <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к покупкам','newLevelVertical')}</span>
                        </button>
                    </div>
                    <div class="btn-cart btn-cart-p f_r">
                        <a href="/shop/cart">
                            <span class="icon_cart_p"></span>
                            <span class="text-el">{lang('Оформить заказ','newLevelVertical')}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    {else:}
        <div class="drop-header">
            <div class="title">{lang('Ваша корзина','newLevelVertical')} <span class="add-info">{lang('пуста','newLevelVertical')}</span></div>
        </div>
        <div class="drop-content is-empty">
            <div class="inside-padd">
                <div class="msg f-s_0">
                    <div class="success"><span class="icon_info"></span><span class="text-el">{lang('Вы удалили все элементы из корзины','newLevelVertical')}</span></div>
                </div>
                <div class="btn-form notCart">
                    <button type="button" data-closed="closed-js">
                        <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к покупкам','newLevelVertical')}</span>
                    </button>
                </div>
            </div>
        </div>
    {/if}
    <div class="preloader" style="display: none;"></div>
</div>
