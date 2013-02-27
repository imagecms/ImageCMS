{if $CI->session->flashdata('makeOrder')}
    <script>{literal}
        $(document).ready(function(){Shop.Cart.clear();})
            {/literal}
    </script>
{/if}
<article>
    <div class="m-t_10"></div>
    <div class="">
        {if $CI->session->flashdata('makeOrder') === true}
            <h1 class="d_i v-a_m m-r_45">
                {lang('s_thank_order')}
            </h1>
        {/if}
        <a href="{site_url()}shop/profile" class="btn btn_cart v-a_m">
            {lang('s_go_profile')}
        </a>
        <div class="row-fluid">
            <div class="frameGroupsForm span5">
                <div class="header_title">{lang('s_order_data')}</div>
                <div class="inside_padd">
                    <table class="tableOrderData">
                        <!-- Start. Render Order number -->
                        <tr>
                            <th>{lang('s_order')} #:</th>
                            <td>{echo ShopCore::encode($model->getId())}</td>
                        </tr>
                        <!-- End. Render Order number -->

                        <!-- Start. Display Paid status -->
                        <tr>
                            <th>{lang('s_paid')}:</th>
                            <td>{if $model->getPaid() == true} {lang('s_yes')}{else:}{lang('s_no')}{/if}</td>
                        </tr>
                        <!-- End. Display Paid status -->

                        <!-- Start. Show Order status name -->
                        <tr>
                            <th>{lang('s_status')}:</th>
                            <td>{echo SOrders::getStatusName('Id',$model->getStatus())}</td>
                        </tr>
                        <!-- End. Show Order status name -->

                        <!-- Start. Render certificate -->
                        {if $model->getGiftCertKey() != null}
                            <tr>
                                <th>{lang('s_do_you_cer_tif')}: </th>
                                <td>-{echo $model->getgiftCertPrice()} {$CS}</td>
                            </tr>
                        {/if}
                        <!-- End. Render certificate -->

                        <!-- Start. Delivery Method name -->
                        {if $model->getDeliveryMethod() > 0}
                            <tr>
                                <th>{lang('s_dostavka')}:</th>
                                <td>{echo $model->getSDeliveryMethods()->getName()}</td>
                            </tr>
                        {/if}
                        <!-- End. Delivery Method name -->

                        <!-- Start. Render payment button and payment description -->
                        {if $model->getPaid() != true}
                            <tr class="b_n">
                                <th></th>
                                <td>{echo $paymentMethods['0']->getPaymentForm($model)}{if $paymentMethods['0']->getDescription()}<div class="m-t_10 infoOrder" style="font-style: italic">{echo ShopCore::t($paymentMethods['0']->getDescription())}</div>{/if}</td>
                            </tr>
                        {/if}
                        <!-- End. Render payment button and payment description -->
                    </table>
                </div>
            </div>

            {/*}
            <div class="frameGroupsForm span7">
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
                        <!-- Start. Rendering produts list   -->
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
                            <!-- Start. Render kit -->
                            {if $item->getKitId() > 0}
                                <tr>
                                    <td colspan="4">
                                        <ul class="items items_catalog">
                                            <li>
                                                <ul class="items items_middle">
                                                    <!-- Start. Main product -->
                                                    {if $item->is_main}
                                                        <li class="span4">
                                                            <div class="item_set">
                                                                <div class="description">
                                                                    <a href="{shop_url('product/' . $product->getUrl())}">
                                                                        {echo ShopCore::encode($product->getName())}
                                                                        {if count($variants)>1}
                                                                            - {echo ShopCore::encode($variant->name)}
                                                                        {/if}
                                                                    </a>
                                                                    <div class="price price_f-s_16">
                                                                        <span class="f-w_b">{echo $variant->getPrice()}</span> {$CS}.&nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                                <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                                                    <span class="helper"></span>
                                                                    <figure>
                                                                        <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($product->getSmallModimage())}{/if}" alt="{echo ShopCore::encode($product->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                            <div class="d_i-b">+</div>
                                                        </li>
                                                        <!-- End. Main product -->
                                                    {else:}
                                                        <!-- Start. Kit product -->
                                                        <li class="span4">
                                                            <div class="item_set">
                                                                <div class="description">
                                                                    <a href="{shop_url('product/' . $product->getUrl())}">
                                                                        {echo ShopCore::encode($product->getName())}
                                                                        {if count($variants)>1} - {echo ShopCore::encode($variant->name)}
                                                                        {/if}
                                                                    </a>
                                                                    <div class="price price_f-s_16">
                                                                        <span class="d_b old_price">
                                                                            <span class="f-w_b">
                                                                                {echo $variant->getPrice()}
                                                                            </span>
                                                                            {$CS}.
                                                                        </span>
                                                                        <span class="f-w_b">99999</span> грн.&nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                                <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                                                    <span class="helper"></span>
                                                                    <figure>
                                                                        <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($product->getSmallModimage())}{/if}" alt="{echo ShopCore::encode($product->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                                                                    </figure>
                                                                </a>
                                                                <span class="top_tovar discount">-5%</span>
                                                            </div>
                                                            <div class="d_i-b">+</div>
                                                        </li>
                                                        <!-- End. Kit product -->
                                                    {/if}
                                                </ul>
                                                <img src="/templates/new_shop_template/shop/default/images/gen_sum.png"/>
                                                <div class="c_97">(Количество комплектов - 1)</div>
                                                <div class="price price_f-s_18">
                                                    <span class="f-w_b">30000</span> грн.
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            {else:}
                                <!-- End. Render kit -->
                                <tr>
                                    <td class="v-a_m">
                                        <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                            <figure>
                                                <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($product->getSmallModimage())}{/if}" alt="{echo ShopCore::encode($product->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                                            </figure>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{shop_url('product/' . $product->getUrl())}" class="c_97">
                                            {echo ShopCore::encode($product->getName())}
                                            {if count($variants)>1} - {echo ShopCore::encode($variant->name)}
                                            {/if}
                                        </a>
                                        <div class="price price_f-s_16">
                                            <span class="first_cash">
                                                <span class="f-w_b">{echo $variant->getPrice()}</span>
                                                {$CS}.
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="c_8a">х</span>
                                        <span class="f-w_b f-s_16">{echo $item->getQuantity()}</span>
                                        {lang('s_pcs1')}. =
                                    </td>
                                    <td>
                                        <div class="price price_f-s_16">
                                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                {$prOne = $variant->getPrice() * $item->getQuantity()}
                                                {$prThree = $prOne - $prOne / 100 * $discount}
                                                <span class="first_cash">
                                                    <span class="f-w_b">
                                                        {echo $variant->getPrice() * $item->getQuantity()}
                                                    </span>
                                                    {$CS}.
                                                </span>
                                            {else:}
                                                {$prThree = $variant->getPrice() * $item->getQuantity()}
                                                <span class="first_cash">
                                                    <span class="f-w_b">
                                                        {echo $prThree}
                                                    </span>
                                                    {$CS}.
                                                </span>
                                            {/if}
                                        </div>
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                        <!-- End. Rendering produts list   -->
                    </tbody>
                    <tfoot>
                        <!-- Start. Rendering totals   -->
                        <tr>
                            <td colspan="4">
                                <div class="t-a_r inside_padd">
                                    <div class="form_alert">{if $model->getgiftcertprice()>0}
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
                        <!-- End. Rendering totals   -->
                    </table>
                </div>
                { */ }
            </div>
        </div>
    </article>
