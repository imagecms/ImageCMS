<article>
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        <span typeof="v:Breadcrumb">
            <a href="#" rel="v:url" property="v:title">Главная</a>
        </span>/
        <span typeof="v:Breadcrumb">
            <span rel="v:url" property="v:title">Сравнение товаров</span>
        </span>
    </div>
    <div class="row">
        <div class="span6">
        {if $CI->session->flashdata('makeOrder') === true}<h1 class="d_i v-a_m m-r_45">{lang('s_thank_order')}</h1>{/if}
        <div class="frameGroupsForm">
            <div class="header_title">{lang('s_order_data')}<a href="{site_url()}shop/profile" class="btn btn_cart v-a_m">{lang('s_go_profile')}</a></div>
            <div class="inside_padd">
                <table class="tableOrderData">
                    <tr>
                        <th>{lang('s_paid')}:</th>
                        <td>{if $model->getPaid() == true} {lang('s_yes')}{else:}{lang('s_no')}{/if}</td>
                    </tr>
                    <tr>
                        <th>{lang('s_status')}:</th>
                        <td>{echo SOrders::getStatusName('Id',$model->getStatus())} {if $model->getDeliveryMethod() > 0}</td>
                    </tr>
                    {if $model->getGiftCertKey() != null}
                        <tr>
                            <th>{lang('s_do_you_cer_tif')}: </th>
                            <td>-{echo $model->getgiftCertPrice()} {$CS}</td>
                        </tr>
                    {/if}
                    {if count($discountCom)}
                        <tr>
                            <th>{lang('s_discount')}: </th>
                            <td>(-{echo $model->getComulativ()}%)</td>
                        </tr>
                    {/if}
                    <tr>
                        <th>{lang('s_dostavka')}:</th>
                        <td>{echo $model->getSDeliveryMethods()->getName()}{/if}</td>
                    </tr>
                    {if $paymentMethods[0] != null && !$model->getPaid()}
                        <tr>
                            <th>{lang('s_pay')}:</th>
                                {foreach $paymentMethods as $pm}
                                <td class="buyandpay">
                                    <label>{echo encode($pm->getName())}</label>
                                    <div>{echo $pm->getPaymentForm($model)} </div>
                                    {echo $pm->getDescription()}

                                </td>
                            {/foreach}
                        </tr>
                    {/if}
                </table>
            </div>
        </div>
        <div class="frameGroupsForm">
            <div class="header_title">{lang('s_order')} №{echo $model->getId()}</div>
            <table class="table v-a_bas table_order">
                <thead class="v_h">
                    <tr>
                        <td class="span1"></td>
                        <td class="span3"></td>
                        <td class="span1"></td>
                        <td class="span1"></td>
                    </tr>
                </thead>
                <tbody>
                    <!-- Start of rendering produts list   -->
                    {foreach $model->getSOrderProductss() as $item}
                        {$total = $total + $item->getQuantity() * $item->toCurrency()}
                        {$product = $item->getSProducts()}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($product->getid())}
                        {$variants = $item->getSProducts()->getProductVariants()}
                        {foreach $variants as $v}
                            {if $v->getId() == $item->getVariantId()}
                                {$variant = $v}
                            {/if}
                        {/foreach}
                        {if $item->getKitId() > 0}
                            {if $item->getIsMain()}
                                <tr>
                                    <td class="v-a_m">
                                        {if $product->getmainimage()}
                                            <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                                <figure>
                                                    <img src="{productImageUrl($product->getSmallModimage())}" border="0" alt="{echo ShopCore::encode($product->getName())}"/>
                                                </figure>
                                            </a>
                                        {/if}
                                    </td>
                                    <td>
                                        <a href="{shop_url('product/' . $product->getUrl())}" class="c_97">{echo ShopCore::encode($product->getName())}</a>
                                        <div class="price price_f-s_16">
                                            <span class="first_cash"><span class="f-w_b">{echo $item->toCurrency()}</span> {$CS}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="c_8a">х</span> <span class="f-w_b f-s_16">{echo $item->getQuantity()}</span> {lang('s_pcs1')}. =
                                    </td>
                                    <td>
                                        <div class="price price_f-s_16">
                                            <span class="first_cash"><span class="f-w_b">{echo $item->getQuantity() * $kits[$item->getKitId()]['price']}</span> {$CS}.</span>
                                        </div>
                                    </td>
                                </tr>
                            {else:}
                                <tr>
                                    <td class="v-a_m">
                                        {if $product->getmainimage()}
                                            <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                                <figure>
                                                    <img src="{productImageUrl($product->getSmallModimage())}"/>
                                                </figure>
                                            </a>
                                        {/if}
                                    </td>
                                    <td>
                                        <a href="{shop_url('product/' . $product->getUrl())}" class="c_97">{echo ShopCore::encode($product->getName())}</a>
                                        <div class="price price_f-s_16">
                                            <span class="first_cash"><span class="f-w_b">{echo $item->toCurrency()}</span> {$CS}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="c_8a">х</span> <span class="f-w_b f-s_16">{echo $item->getQuantity()}</span> {lang('s_pcs1')}. =
                                    </td>
                                    <td>
                                        <div class="price price_f-s_16">
                                            <span class="first_cash"><span class="f-w_b">{echo $item->toCurrency()}</span> {$CS}.</span>
                                        </div>
                                    </td>
                                </tr>                             
                            {/if}
                        {else:}
                            <tr>
                                <td class="v-a_m">
                                    <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                        <figure>
                                            <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($product->getSmallModimage())}{/if}" alt="{echo ShopCore::encode($product->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                                        </figure>
                                    </a>
                                </td>
                                <td>
                                    <a href="{shop_url('product/' . $product->getUrl())}" class="c_97">{echo ShopCore::encode($product->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a>
                                    <div class="price price_f-s_16">
                                        <span class="first_cash"><span class="f-w_b">{echo $variant->getPrice()}</span> {$CS}.</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="c_8a">х</span> <span class="f-w_b f-s_16">{echo $item->getQuantity()}</span> {lang('s_pcs1')}. =
                                </td>
                                <td>
                                    <div class="price price_f-s_16">
                                        {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                            {$prOne = $variant->getPrice() * $item->getQuantity()}
                                            {$prThree = $prOne - $prOne / 100 * $discount}
                                            <span class="first_cash"><span class="f-w_b">{echo $variant->getPrice() * $item->getQuantity()}</span> {$CS}.</span>
                                        {else:}
                                            {$prThree = $variant->getPrice() * $item->getQuantity()}
                                            <span class="first_cash"><span class="f-w_b">{echo $prThree}</span> {$CS}.</span>
                                        {/if}
                                    </div>
                                </td>
                            </tr>
                        {/if}
                    {/foreach}
                    <!-- End of rendering produts list   -->
                </tbody>
                <!-- Start of rendering totals   -->
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="t-a_r inside_padd">
                                <div class="form_alert d_i-b">
                                    {if $model->getgiftcertprice()>0}
                                        {$giftPrice = $model->getgiftcertprice()}
                                        {$total -= $model->getgiftcertprice()}
                                    {/if}
                                    {if $total >= $deliveryMethod->getFreeFrom() AND $deliveryMethod->getFreeFrom() > 0}
                                        <div class="c_97" style="margin-bottom: 4px;">({lang('s_product_amount')}: <span class="f-w_b">{echo $total}</span> ({$CS})</div>
                                        {if $giftPrice}
                                            <div class="price f-s_12">{lang('s_do_you_cer_tif')}: -{echo $giftPrice} {$CS}</div>
                                        {/if}
                                    {else:}
                                        <div class="c_97" style="margin-bottom: 4px;">({lang('s_product_amount')}: <span class="f-w_b">{echo $total + $model->getDeliveryPrice()}</span> {$CS} + {lang('s_dostavka')}: <span class="f-w_b">{echo $model->getDeliveryPrice()}</span> {$CS})</div>
                                        {if $giftPrice}
                                            <div class="price f-s_12">{lang('s_do_you_cer_tif')}: -{echo $giftPrice} {$CS}</div>
                                        {/if}
                                    {/if}
                                    <span class="f-s_18">{lang('s_summ')}:</span> <span class="f-s_24">{echo $total + $model->getDeliveryPrice()}</span> <span class="f-s_14">{$CS}.</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <!-- End of rendering totals   -->
            </table>
        </div>
    </div>
</div>
</article>
