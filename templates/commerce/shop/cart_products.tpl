{if count($items)}
<!--    <caption>{lang("Basket","admin")}</caption>-->
    <colgroup>
        <col span="1" width="120">
        <col span="1" width="390">
        <col span="1" width="160">
        <col span="1" width="140">
        <col span="1" width="160">
        <col span="1" width="25">
    </colgroup>

    <tbody>
        {foreach $items as $key=>$item}
            {if $item.model instanceof SProducts}
                {$variants = $item.model->getProductVariants()}
                {foreach $variants as $v}
                    {if $v->getId() == $item.variantId}
                        {$variant = $v}
                    {/if}
                {/foreach}
                <tr>
                    <td>
                        <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo_block">
                            <img src="{if count($variants)>1 && $variant->getSmallImage() != ''}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($item.model->getMainModimage())}{/if}" alt="{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                        </a>
                    </td>
                    <td>
                        <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a>
                    </td>
                    <td>
                        {if $item.model->hasDiscounts()}
                            <del class="price price-c_red f-s_12 price-c_9">
                                {echo $variant->toCurrency('OrigPrice')} {$CS}
                            </del> <br />
                        {/if}
                        <div class="price f-s_16 f_l">{echo $variant->toCurrency()} <sub>{$CS}</sub>
                        </div>
                    </td>
                    <td>
                        <div class="count">
                            <input name="products[{$key}]" type="text" value="{$item.quantity}"/>
                            <span class="plus_minus">
                                <button class="count_up inCartProducts">&#9650;</button>
                                <button class="count_down inCartProducts">&#9660;</button>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="price f-s_18 f_l">

                            {$summary = $variant->toCurrency() * $item.quantity}
                            {echo $summary}
                            <sub>{$CS}</sub>

                        </div>
                    </td>
                    <td>
                        <a href="{shop_url('cart/delete/'.$key)}" class="delete_text inCartProducts">&times;</a>
                    </td>
                </tr>
            {elseif($item.model instanceof ShopKit):}
                <tr>
                    <td style="width:90px;padding:2px;">

                        {if $item.model->getMainProduct()->getMainImage()}
                            <a href="{shop_url('product/' . $item.model->getProductId())}" class="photo_block">
                                <img src="{productImageUrl($item.model->getMainProduct()->getId() . '_main.jpg')}" border="0"  width="100" />
                            </a>
                        {/if}
                    </td>
                    <td>
                        <a href="{shop_url('product/' . $item.model->getMainProduct()->getUrl())}">{echo ShopCore::encode($item.model->getMainProduct()->getName())}</a> {echo ShopCore::encode($item.model->getMainProduct()->firstVariant->getName())}
                        <br /><span style="font-size:16px;">{echo $item.model->getMainProduct()->firstVariant->toCurrency()} {$CS}</span>
                    </td>
                    <td rowspan="{echo $item.model->countProducts()}">
                        {//echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {//$CS}
                        {echo $item.price} {$CS}
                    </td>
                    <td rowspan="{echo $item.model->countProducts()}">
                        <div class="count">
                            <input type="text" name="products[{$key}]" value="{$item.quantity}">
                            <span class="plus_minus">
                                <button class="count_up">&#9650;</button>
                                <button class="count_down">&#9660;</button>
                            </span>
                        </div>
                    </td>
                    <td rowspan="{echo $item.model->countProducts()}">
                        {//echo $summary = ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} {//$CS}
                        {echo $summary = $item.totalAmount} {$CS}
                    </td>
                    <td rowspan="{echo $item.model->countProducts()}"><a href="{shop_url('cart/delete/' . $key)}" rel="nofollow" class="delete_text inCartProducts">&times;</a></td>

                </tr>
                {foreach $item.model->getShopKitProducts() as $shopKitProduct}
                    {$ap = $shopKitProduct->getSProducts()}
                    {$ap->setLocale(MY_Controller::getCurrentLocale())}
                    {$kitFirstVariant = $ap->getKitFirstVariant($shopKitProduct)}
                    <tr>
                        <td style="width:90px;padding:2px;">
                            {if $ap->getMainImage()}
                                <a href="{shop_url('product/' . $ap->getId())}" class="photo_block">
                                    <img src="{productImageUrl($ap->getId() . '_main.jpg')}" border="0" width="100" alt="{echo ShopCore::encode($ap->getName())}" />
                                </a>
                            {/if}
                        </td>
                        <td>
                            <a href="{shop_url('product/' . $ap->getUrl())}">{echo ShopCore::encode($ap->getName())}</a> {echo ShopCore::encode($kitFirstVariant->getName())}
                            {if $kitFirstVariant->getEconomy() > 0}
                                <span style="font-size:16px;">{echo $kitFirstVariant->toCurrency()} {$CS}</span>
                            {else:}
                                <span style="font-size:16px;">{echo $kitFirstVariant->toCurrency()} {$CS}</span>
                            {/if}
                        </td>

                    </tr>
                    {$i++}
                {/foreach}
            {/if}
            {$total     += $summary}
            {$total_nc  += $summary_nextc}
        {/foreach}
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
                <div class="foot_cleaner">
                    <div class="f_r">
                        <div class="price f-s_26 f_l">
                            <div class="price f-s_26 f_l">
                                {echo $total} {$CS}
                            </div>
                            <div class="price f-s_12 f_l p-t_19">
                                {if isset($item.delivery_price)}
                                    +{echo $item.delivery_price} {$CS}<br/><br/>
                                {/if}
                                {if isset($item.gift_cert_price)}
                                    -{echo $item.gift_cert_price} {$CS}
                                {/if}
                            </div>
                            <span id="dpholder" data-dp="{if $total >= $item.delivery_free_from AND $item.delivery_free_from > 0} 0 {else:}{echo $item.delivery_price}{/if}"></span>
                            <span id="allpriceholder" data-summary="{echo $total - $item.gift_cert_price}"></span>
                        </div>
                    </div>
                    {$gift_price = (float) $gift_price;}
                    {if (isset($item.gift_cert_price)==false) && $total < $gift_price}
                        <span class="cert_fancybox">Сумма сертификата превышает сумму заказа!</span>
                    {else:}
                    {if $msg == 1}<span class="cert_fancybox"> Вы использовали сертификат!</span>{/if}
                {if $msg == 2}<span class="cert_fancybox"> Не верный ключ сертификата!</span>{/if}
            {/if}
            {literal}
                <script type="text/javascript">
                    $(".cert_fancybox").fancybox().click();
                    $('#giftcertkey').val('');
                </script>
            {/literal}
            <div class="f_r sum"><span class="price">{lang("Total","admin")}:</span><br/>
                {if isset($item.delivery_price)}
                    <div class="f_r price f-s_12 p-t_19">Доставка:<br/><br/>
                    {/if}

                    {if isset($item.gift_cert_price)}
                        <div class="f_r price f-s_12">Подарочный сертификат:<br/>
                        {/if}
                    </div>
                </div>
                </td>
                </tr>
                </tfoot>
                <input type="hidden" name="forCart" value="1" />
            {else:}
                {echo $script}
                <div class="comparison_slider">
                    <div class="f-s_18 m-t_29 t-a_c">{echo ShopCore::t(lang("Basket empty","admin"))}</div>
                </div>
            {/if}


