{foreach $products as $key => $p}
    {if $key >= $limit && isset($limit)}
        {break}
    {/if}
    <li>
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
            {if !$widget && !$defaultItem}
                <span class="frame-variant-name-code">
                    {$hasCode = $p.number == ''}
                    <span class="frame-variant-code" {if $hasCode}style="display:none;"{/if}>Артикул:
                        <span class="code">
                            {if !$hasCode}
                                {trim($p.number)}
                            {/if}
                        </span>
                    </span>
                </span>
            {/if}
            <div class="frame-prices f-s_0">
                <!-- Check for discount-->
                {$oldoprice = $p.old_price && $p.old_price != 0 && $p.old_price > $p.price}
                {if $oldoprice}
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo $p.old_price}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                {/if}
                <span class="current-prices f-s_0">
                    <span class="price-new">
                        <span>
                            <span class="price priceVariant">{echo $p.price}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                </span>
            </div>
            <!--            End. Price-->
            <div class="funcs-buttons">
                <!-- Start. Collect information about Variants, for future processing -->
                {if $p.stock > 0}
                    <div class="frame-count-buy variant_{echo $p.variant_id} variant">
                        <div class="frame-count">
                            <div class="number" data-title="количество на складе {echo $p.stock}" data-prodid="{echo $p.id}" data-varid="{echo $p.variant_id}" data-rel="frameplusminus">
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
                                <input type="text" value="1" data-rel="plusminus" data-title="только цифры" data-min="1" data-max="{echo $p.stock}">
                            </div>
                        </div>
                        <div class="btn-buy">
                            <button
                                class="btnBuy infoBut"
                                type="button"
                                data-id="{echo $p.variant_id}"
                                data-prodid="{echo $p.id}"
                                data-varid="{echo $p.variant_id}"
                                data-price="{echo $p.price}"
                                data-name="{echo ShopCore::encode($p.name)}"
                                data-maxcount="{echo $p.stock}"
                                data-number="{echo trim($p.number)}"
                                data-mediumImage="{echo $photo}"
                                data-img="{echo $photo}"
                                data-url="{echo shop_url('product/'.$p.url)}"
                                data-prodStatus='{json_encode(promoLabelBtn($p.action, $p.hot, $p.hit))}'>
                                <span class="icon_cleaner icon_cleaner_buy"></span>
                                <span class="text-el">{lang('s_buy')}</span>
                            </button>
                        </div>
                    </div>
                {else:}
                    <div class="btn-not-avail variant_{echo $p.variant_id} variant" {if $key != 0}style="display:none"{/if}>
                        <button
                            class="infoBut"
                            type="button"
                            data-drop=".drop-report"
                            data-source="/shop/ajax/getNotifyingRequest"

                            data-id="{echo $p.variant_id}"
                            data-prodid="{echo $p.id}"
                            data-varid="{echo $p.variant_id}"
                            data-price="{echo $p.price}"
                            data-name="{echo ShopCore::encode($p.name)}"
                            data-maxcount="{echo $p.stock}"
                            data-number="{echo trim($p.number)}"
                            data-mediumImage="{echo $photo}"
                            data-img="{echo $photo}"
                            data-url="{echo shop_url('product/'.$p.url)}"
                            data-prodStatus='{json_encode(promoLabelBtn($p.action, $p.hot, $p.hit))}'>                                
                            <span class="icon-but"></span>
                            <span class="text-el">{lang('s_message_o_report')}</span>
                        </button>
                    </div>
                {/if}
            </div>
        </div>
        <button 
            type="button"
            class="d_l_1"
            data-type="json"
            data-modal="true"
            data-overlayopacity= "0"
            data-drop="#notification"
            data-source="/wishlist/wishlistApi/deleteItem/{echo $p[variant_id]}/{echo $p[wish_list_id]}"
            >удалить</button>
        <button 
            type="button"
            class="d_l_1"
            data-drop="#wishListPopup"
            data-source="/wishlist/wishlistApi/renderPopup/{echo $p[variant_id]}/{echo $p[wish_list_id]}/{echo $user[id]}"
            >
            Переместить
        </button>
        {$w[comment]}
    </li>
{/foreach}