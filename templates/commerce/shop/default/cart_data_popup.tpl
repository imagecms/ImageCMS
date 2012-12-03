{$inCart = ShopCore::app()->SCart->getData()}
{if $inCart}
    <div class="fancy wish_list">
        <form method="post" action="{shop_url('cart')}" >
            <h1 class="m-l_19">{lang('s_cart')}</h1>
            <table class="cleaner_table"  cellspacing="0">
                <colgroup>
                    <col span="1" width="140">
                    <col span="1" width="365">
                    <col span="1" width="130">
                    <col span="1" width="160">
                    <col span="1" width="138">
                    <col span="1" width="28">
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
                            {$vprices = currency_convert($variant->getPrice(), $variant->getCurrency())}
                            <tr>
                                <td>
                                    <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo_block">
                                        <img src="{if count($variants)>1 && $variant->getSmallImage() != ''}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($item.model->getMainModimage())}{/if}"
                                             alt="{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                                    </a>
                                </td>
                                <td>
                                    <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a>
                                </td>
                                <td>
                                    <div class="price f-s_16 f_l">{echo $vprices.main.price} <sub>{$vprices.main.symbol}</sub>
                                    </div>
                                </td>
                                <td>
                                    <div class="count">
                                        <input name="products[{$key}]" type="text" value="{$item.quantity}"/>
                                        <span class="plus_minus">
                                            <button class="count_up">&#9650;</button>
                                            <button class="count_down">&#9660;</button>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="price f-s_18 f_l">
                                        {if $item.discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                            <div class="price f-s_12 f_l">Скидка {echo $item.discount}%</div><br /> 
                                            {$summary = $vprices.main.price * $item.quantity}
                                            {echo $summary - $summary / 100 *$item.discount}
                                            <sub>{$vprices.main.symbol}</sub>      <br />       
                                            <del class="price price-c_red f-s_12 price-c_9">{echo $summary} {$vprices.main.symbol}</del> 
                                        {else:}
                                            {$summary = $vprices.main.price * $item.quantity}
                                            {echo $summary}
                                            <sub>{$vprices.main.symbol}</sub>
                                        {/if}
                                    </div>
                                </td>
                                <td>
                                    <a href="{shop_url('cart/delete/'.$key)}" class="delete_text">&times;</a>
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
                                    {echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {$CS}                             
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
                                    {echo $summary = ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} {$CS}
                                </td>
                                <td rowspan="{echo $item.model->countProducts()}"><a href="{shop_url('cart/delete/' . $key)}" rel="nofollow" class="delete_text">&times;</a></td>

                            </tr>
                            {foreach $item.model->getShopKitProducts() as $shopKitProduct}
                                {$ap = $shopKitProduct->getSProducts()}
                                {$ap->setLocale(ShopController::getCurrentLocale())}
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
                                <br /><s style="font-size:14px;">{echo $kitFirstVariant->toCurrency('origPrice')} {$CS}</s>
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
                                <div class="f_l f-s_26" style="width: 268px;">                                   
                                    {if count($discountCom)} 
                                        <span class="price f-s_12 price-c_9" style="font-size: 14px;">
                                            Накопительная скидка {echo $discountCom->getDiscount()}%
                                        </span>
                                    {/if}
                                </div>
                                <div class="f_r buttons button_big_blue">
                                    <a href="{shop_url('cart')}">{lang('s_c_of_z_')}</a>
                                </div>
                                <div class="f_r">
                                    {if $NextCS == $CS}
                                        <div class="price f-s_26_lh_50 f_l">{$total} <sub>{$CS}</sub>
                                        {else:}
                                            <div class="price f-s_26 f_l">
                                                {if count($discountCom)} 
                                                    <del class="price price-c_red f-s_12 price-c_9">{echo $total} {$CS}</del> 
                                                    <span class="price f-s_12 price-c_9" style="font-size: 14px;">Скидка {echo $discountCom->getDiscount()}%</span><br />
                                                    {echo $total - $total / 100 * $discountCom->getDiscount()} {$CS}

                                                {elseif $item.discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                    <div class="price f-s_26 f_l">
                                                        {echo $total - $total / 100 * $item.discount} {$CS}
                                                    </div>
                                                    {else:}
                                                          <div class="price f-s_26 f_l">
                                                        {echo $total} {$CS}
                                                    </div>
                                                {/if}



                                            </div>
                                        {/if}
                                    </div>
                                    <div class="sum f_r">
                                        {lang('s_summ')}:
                                    </div>
                                </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            {form_csrf();}        
        </form>
    </div>
{else:}
    {literal}
        {"close":"true","msg": "<div class='fancy wish_list'><h1 class='m-l_19'>{/literal}{lang('s_cart')}</h1><div class='comparison_slider'><div class='f-s_18  t-a_c' style='padding:53px 0;'>{lang('s_cart_empty')}{literal}</div></div></div>"}{/literal}
        {/if}