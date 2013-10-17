{$pricePrecision = ShopCore::app()->SSettings->pricePrecision}
{foreach $products as $key => $p}
    {if $key >= $limit && isset($limit)}
        {break}
    {/if}
    <li class="item-WL {if $p.stock == 0}not-avail{/if}">
        <a href="{shop_url('product/' . $p.url)}" class="frame-photo-title">
            <span class="photo-block">
                <span class="helper"></span>
                {$photo = site_url('uploads/shop/products/medium/'.$p.image)}
                <img data-original="{echo $photo}"
                     src="{$THEME}images/blank.gif"
                     alt="{echo ShopCore::encode($p.name)}"
                     class="vimg lazy"/>
                {$discount = 0}
                {promoLabel($p.action, $p.hot, $p.hit)}
            </span>
            <span class="title">{echo ShopCore::encode($p.name)}</span>
        </a>
        <div class="description">
            <div class="frame-prices f-s_0">
                <!-- Check for discount-->
                {$oldoprice = $p.old_price && $p.old_price != 0 && $p.old_price > $p.price}
                {if $oldoprice}
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo intval($p.old_price)}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                {/if}
                <span class="current-prices f-s_0">
                    <span class="price-new">
                        <span>
                            <span class="price priceVariant">{echo round($p.price, $pricePrecision)}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                    {if $NextCS != null}
                        <span class="price-add">
                            <span>
                                (<span class="price addCurrPrice">{echo ShopCore::app()->SCurrencyHelper->convert($p.price, $NextCSId)}</span>
                                <span class="curr-add">{$NextCS}</span>)
                            </span>
                        </span>
                    {/if}
                </span>
            </div>
            <!--            End. Price-->
            <div class="funcs-buttons">
                <!-- Start. Collect information about Variants, for future processing -->
                {if $p.stock > 0}
                    <div class="frame-count-buy variant_{echo $p.variant_id} variant">
                        <div class="frame-count">
                            <div class="number" data-title="{lang('количество на складе', 'newLevel')} {echo $p.stock}" data-prodid="{echo $p.id}" data-varid="{echo $p.variant_id}" data-rel="frameplusminus">
                                <div class="frame-change-count">
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
                                <input type="text" value="1" data-rel="plusminus" data-title="{lang('только цифры', 'newLevel')}" data-min="1" data-max="{echo $p.stock}">
                            </div>
                        </div>
                        <div class="btn-buy">
                            <button
                                disabled="disabled"
                                class="btnBuy infoBut"
                                type="button"
                                data-id="{echo $p.id}"
                                data-prodid="{echo $p.id}"
                                data-varid="{echo $p.variant_id}"
                                data-price="{echo $p.price}"
                                data-addPrice="{if $NextCS != null}{echo ShopCore::app()->SCurrencyHelper->convert($p.price, $NextCSId)}{/if}"
                                data-count="1"
                                data-name="{echo ShopCore::encode($p.name)}"
                                data-maxcount="{echo $p.stock}"
                                data-number="{echo trim($p.number)}"
                                data-mediumImage="{echo $photo}"
                                data-img="{echo $photo}"
                                data-url="{echo shop_url('product/'.$p.url)}"
                                data-prodStatus='{json_encode(promoLabelBtn($p.action, $p.hot, $p.hit))}'
                                >
                                <span class="icon_cleaner icon_cleaner_buy"></span>
                                <span class="text-el">{lang('Купить','newLevel')}</span>
                            </button>
                        </div>
                    </div>
                {else:}
                    <div class="btn-not-avail variant_{echo $p.variant_id} variant" >
                        <button
                            class="infoBut"
                            type="button"
                            data-drop=".drop-report"
                            data-source="/shop/ajax/getNotifyingRequest"

                            data-id="{echo $p.id}"
                            data-prodid="{echo $p.id}"
                            data-varid="{echo $p.variant_id}"
                            data-price="{echo $p.price}"
                            data-addPrice="{if $NextCS != null}{echo ShopCore::app()->SCurrencyHelper->convert($p.price, $NextCSId)}{/if}"
                            data-name="{echo ShopCore::encode($p.name)}"
                            data-maxcount="{echo $p.stock}"
                            data-number="{echo trim($p.number)}"
                            data-mediumImage="{echo $photo}"
                            data-img="{echo $photo}"
                            data-url="{echo shop_url('product/'.$p.url)}"
                            <span class="icon-but"></span>
                            <span class="text-el">{lang('Сообщить о появлении','newLevel')}</span>
                        </button>
                    </div>
                {/if}
            </div>
        </div>
        {if trim($p[comment]) != ''}
            <p>
                {$p[comment]}
            </p>
        {/if}
        {if $p.access == 'private' || !$otherlist}
            <div class="funcs-buttons-WL-item">
                <div class="btn-remove-item-wl">
                    <button
                        type="button"
                        data-type="json"
                        data-modal="true"

                        data-drop="#notification"
                        data-effect-on="fadeIn"
                        data-effect-off="fadeOut"
                        data-source="{site_url('/wishlist/wishlistApi/deleteItem/'.$p[variant_id].'/'.$p[wish_list_id])}"
                        data-callback="removeItem"
                        ><span class="icon_remove"></span><span class="text-el d_l_1">{lang('Удалить', 'newLevel')}</span></button>
                </div>
                <div class="btn-move-item-wl">
                    <button
                        type="button"
                        data-drop="#wishListPopup"
                        data-source="{site_url('/wishlist/renderPopup/'.$p[variant_id].'/'.$p[wish_list_id])}"
                        data-always="true"
                        ><span class="icon_move"></span><span class="text-el d_l_1">{lang('Переместить', 'newLevel')}</span>
                    </button>
                </div>
            </div>
        {/if}
    </li>
{/foreach}