<link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="{$THEME}{$colorScheme}/colorscheme.css" media="all" />
<style>
    {literal}
        #popupCart{display:block;}
    {/literal}
</style>
<div id="popupCart" class="drop drop-bask drop-style">
    <div class="frame-bask frameBask">
        <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
        <div class="no-empty js-no-empty">
            <div class="drop-header">
                <div class="title bask"><span>{lang('В корзине','newLevel')}</span><span class="add-info"><span class="topCartCount"> {echo $count}</span></span> <span class="plurProd">{echo SStringHelper::Pluralize($count, array(lang('товар','newLevel'),lang('товара','newLevel'),lang('товаров','newLevel')))}</span> <span>{lang('Сумма','newLevel')}</span> <span class="add-info"><span class="topCartTotalPrice">{echo $cartPrice}</span></span> <span class="curr">{$CS}</span></div>
            </div>
            <div class="drop-content">
                <div class="no-empty js-no-empty">
                    <div class="frame-bask-main">
                        <div class="inside-padd">
                            <table class="table-order">
                                <tbody>
                                    {foreach $items as $item}
                                        <!-- for single product -->
                                        {//var_dump($item)}
                                        {if $item->instance === "SProducts"}
                                            <tr data-id="{echo $item->getId()}" class="items items-bask cart-product">
                                                <td class="frame-remove-bask-btn"><button type="button" class="icon_times_cart" onclick="Shop.Cart.rm({echo $item->getId()});"></button></td>
                                                <td class="frame-items">
                                                    <a href="{echo shop_url('product/'.$item->getSProducts()->getUrl())}" title="{echo $item->getName()}" class="frame-photo-title">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="{echo $item->getSmallPhoto()}" alt="{echo $item->getName()}"/>
                                                        </span>
                                                        <span class="title">{echo $item->getName()}</span>
                                                    </a>
                                                    <div class="description">
                                                        {if $item->getName()}
                                                            <span class="frame-variant-name">{lang('Вариант','newLevel')} <span class="code">({echo $item->getName()})</span></span>
                                                        {/if}
                                                        {if $item->getNumber()}
                                                            <span class="frame-variant-code">{lang('Артикул','newLevel')} <span class="code">({echo $item->getNumber()})</span></span>
                                                        {/if}
                                                    </div>
                                                </td>
                                                <td class="frame-count frameCount">
                                                    <span class="countOrCompl">{lang('Количество', 'newLevel')}</span>
                                                    <div class="number" data-title="{lang('Количество на складе','newLevel')} {echo $item->getStock()}">
                                                        <div class="frame-change-count frameChangeCount" data-id="{echo $item->getId()}">
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
                                                        <input type="text" value="{echo $item->quantity}" class="plusMinus plus-minus" data-title="{lang('Только цифры','newLevel')}" data-min="1" data-max="{echo $item->getStock()}"/>
                                                    </div>
                                                </td>

                                                <td class="frame-cur-sum-price">
                                                    <span class="title">{lang('Сумма','newLevel')}: </span>
                                                    <div class="frame-cur-sum-price">
                                                        <div class="frame-prices f-s_0">
                                                            {if ShopCore::app()->SCurrencyHelper->convert($item->originPrice) != ShopCore::app()->SCurrencyHelper->convert($item->price)}
                                                                <span class="price-discount">
                                                                    <span>
                                                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->originPrice)}</span>
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
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        {/if}
                                        {literal}
                                            <tr class="rowKits row-kits" data-prodid="{- item.id }" data-kitId="{- item.kitId }" data-varid="{- item.vId }" data-id="popupKit_{- item.kitId }">
                                                <td class="frame-remove-bask-btn"><button type="button" class="icon_times_cart" onclick="ShopFront.Cart.rm(this, true);"></button></td>
                                                <td class="frame-items frame-items-kit">
                                                    <ul class="items items-bask">
                                                        { _.each(prices, function(id){  }
                                                        <li>
                                                            { if (i != 0){ }
                                                            <div class="next-kit">+</div>
                                                            { } }
                                                            <div class="frame-kit { if (i == 0){} main-product { } }">
                                                                { if (0==i) { }
                                                                <a class="frame-photo-title" href="{- urls[i]}">
                                                                    <span class="photo-block">
                                                                        <span class="helper"></span>
                                                                        <img src="{- images[i]}" alt="{- '('+item.vname+')'}">
                                                                    </span>
                                                                    <span class="title">{- names[i] }</span>
                                                                </a>
                                                                <div class="description">
                                                                    {if(item.vname){ }<span class="frame-variant-name frameVariantName">{lang('Вариант','newLevel')}  <span class="code js-code">({- item.vname})</span></span> { } }
                                                                    {if (item.number) { }<span class="frame-variant-code frameVariantCode">{lang('Артикул','newLevel')}  <span class="code js-code">({-item.number })</span></span> { } }
                                                                    {/*}
                                                                    <div class="frame-prices f-s_0">
                                                                        <span class="current-prices f-s_0">
                                                                            <span class="price-new">
                                                                                <span>
                                                                                    <span class="price">{-parseFloat(prices[i]).toFixed(pricePrecision)}</span>
                                                                                    <span class="curr">{-curr}</span>
                                                                                </span>
                                                                            </span>
                                                                            {if (nextCsCond){}
                                                                            <span class="price-add">
                                                                                <span>
                                                                                    <span class="price">{- parseFloat(addprices[i]).toFixed(pricePrecision) }</span>
                                                                                    <span class="curr-add">{-nextCs}</span>
                                                                                </span>
                                                                            </span>
                                                                            {}}
                                                                        </span>
                                                                    </div>
                                                                    {*/}
                                                                </div>
                                                                { } else { }

                                                                <a class="frame-photo-title" href="{- urls[i]}">
                                                                    <span class="photo-block">
                                                                        <span class="helper"></span>
                                                                        <img src="{- images[i]}" alt="{- '('+item.vname+')'}">
                                                                    </span>
                                                                    <span class="title">{-names[i]}</span>
                                                                </a>
                                                                <div class="description">
                                                                    {if(item.vname){ }<span class="frame-variant-name frameVariantName">{lang('Вариант','newLevel')}  <span class="code js-code">({- item.vname})</span></span> { } }
                                                                    {if (item.number) { }<span class="frame-variant-code frameVariantCode">{lang('Артикул','newLevel')}  <span class="code js-code">({-item.number })</span></span> { } }
                                                                    {/*}
                                                                    <div class="frame-prices f-s_0">
                                                                        <span class="price-discount">
                                                                            <span>
                                                                                <span class="price">{-parseFloat(origprices[i]).toFixed(pricePrecision)}</span>
                                                                                <span class="curr">{-curr}</span>
                                                                            </span>
                                                                        </span>
                                                                        <span class="current-prices f-s_0">
                                                                            <span class="price-new">
                                                                                <span>
                                                                                    <span class="price">{-parseFloat(prices[i]).toFixed(pricePrecision)}</span>
                                                                                    <span class="curr">{-curr}</span>
                                                                                </span>
                                                                            </span>
                                                                            {if (nextCsCond){}
                                                                            <span class="price-add">
                                                                                <span>
                                                                                    <span class="price">{- parseFloat(addprices[i]).toFixed(pricePrecision) }</span>
                                                                                    <span class="curr-add">{-nextCs}</span>
                                                                                </span>
                                                                            </span>
                                                                            {}}
                                                                        </span>
                                                                    </div>
                                                                    {*/}
                                                                </div>
                                                                { } }
                                                            </div>
                                                        </li>
                                                        { i++;  }); }
                                                    </ul>
                                                </td>
                                                <td class="frame-count frameCount">
                                                    <span class="countOrCompl">{-text.kits}</span>
                                                    <div class="number js-number" data-title="{lang('Количество на складе','newLevel')} {-' '+item.maxcount}">
                                                        <div class="frame-change-count frameChangeCount" data-prodid="{- item.id }" data-varid="{- item.vId }" data-price="{- item.price }" data-origprice="{- item.origprice }" data-addprice="{- item.addprice }" data-kit="{-item.kit }">
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
                                                        <input type="text" value="{- item.count }" class="plusMinus plus-minus" data-title="{lang('Только цифры','newLevel')}" data-min="1" { if (item.maxcount) { } data-max="{-item.maxcount}" { } } />
                                                    </div>
                                                </td>
                                                <td class="frame-cur-sum-price">
                                                    <span class="title">{lang('Сумма','newLevel')}: </span>
                                                    <div class="frame-prices f-s_0">
                                                        <span class="price-discount">
                                                            <span>
                                                                <span class="price priceOrigOrder">{- parseFloat(item.count*item.origprice).toFixed(pricePrecision) }</span>
                                                                <span class="curr">{-curr}</span>
                                                            </span>
                                                        </span>
                                                        <span class="current-prices f-s_0">
                                                            <span class="price-new">
                                                                <span>
                                                                    <span class="price priceOrder">{- parseFloat(item.count * item.price).toFixed(pricePrecision) }</span>
                                                                    <span class="curr">{-curr}</span>
                                                                </span>
                                                            </span>
                                                            {/*if (nextCsCond){}
                                                            <span class="price-add">
                                                                <span>
                                                                    <span class="price priceAddOrder">{- parseFloat(item.count * item.addprice).toFixed(pricePrecision) }</span>
                                                                    <span class="curr">{-nextCs}</span>
                                                                </span>
                                                            </span>
                                                            {}*/}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        {/literal}
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {literal}
                <div class="frame-foot drop-footer">
                    <div class="header-frame-foot">
                        <div class="inside-padd">
                            <div class="clearfix">
                                <span class="frame-discount frameDiscount">
                                    <span class="s-t">{lang('Ваша текущая скидка','newLevel')}:</span>
                                    <span class="text-discount current-discount"><span class="curDiscount"></span> <span class="curr">{-curr}</span></span>
                                </span>
                                { if (orderDetails) { }
                                <div class="btn-form f_l">
                                    <button type="button" data-closed="closed-js">
                                        <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к оформлению','newLevel')}</span>
                                    </button>
                                </div>
                                { } }
                                <span class="s-t">{lang('Всего','newLevel')}:</span>
                                <span class="frame-cur-sum-price">
                                    <span class="frame-prices f-s_0">
                                        <span class="price-discount">
                                            <span class="frame-discount frameDiscount">
                                                <span class="price genSumDiscount"></span>
                                                <span class="curr">{-curr}</span>
                                            </span>
                                        </span>
                                        <span class="current-prices f-s_0">
                                            <span class="price-new">
                                                <span>
                                                    <span class="price topCartTotalPrice">{- parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision) }</span>
                                                    <span class="curr">{-curr}</span>
                                                </span>
                                            </span>
                                            {if (nextCsCond){}
                                            <span class="price-add">
                                                <span>
                                                    <span class="price topCartTotalAddPrice">{- parseFloat(Shop.Cart.getTotalAddPrice()).toFixed(pricePrecision) }</span>
                                                    <span class="curr-add">{-nextCs}</span>
                                                </span>
                                            </span>
                                            {}}
                                        </span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        { if (!orderDetails) { }
                        <div class="content-frame-foot">
                            <div class="clearfix inside-padd">
                                <div class="btn-form f_l">
                                    <button type="button" data-closed="closed-js">

                                        <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к покупкам','newLevel')}</span>
                                    </button>
                                </div>
                                <div class="btn-cart btn-cart-p f_r">
                                    <a href="/shop/cart">
                                        <span class="icon_cart_p"></span>
                                        <span class="text-el">{lang('Оформить заказ','newLevel')}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        { } }
                    </div>
                </div>
            </div>
            <div class="empty js-empty">
                <div class="drop-header">
                    <div class="title">{lang('Ваша корзина','newLevel')} <span class="add-info">{lang('пуста','newLevel')}</span></div>
                </div>
                <div class="drop-content">
                    <div class="inside-padd">
                        <div class="msg f-s_0">
                            <div class="success"><span class="icon_info"></span><span class="text-el">{lang('Вы удалили все элементы из корзины','newLevel')}</span></div>
                        </div>
                        { if (!orderDetails) { }
                        <div class="btn-form">
                            <button type="button" data-closed="closed-js">
                                <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к покупкам','newLevel')}</span>
                            </button>
                        </div>
                        { } }
                    </div>
                </div>
            </div>
        {/literal}
    </div>
</div>