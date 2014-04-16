{#
/**
* @file Template. Displaying order view page;
* @partof main.tpl;
* Variables
*   $model : (object) instance of SOrders;
*    $model->getId() : return Order ID;
*    $model->getPaid() : return Order paid status;
*    $model->getSDeliveryMethods()->getName() : get Delivery method name;
*    $model->getOrderProducts() : return Ordered products list;
*    $model->getOrderKits() : return Ordered Kits list;
*    $model->getTotalPrice() : get aggregate ordered Products Price;
*    $model->getDeliveryPrice() : return delivery Price;
*    $model->getTotalPriceWithDelivery() : sum of Product and Delivery Prices;
*    $model->getTotalPriceWithGift() : difference of previous price (getTotalPriceWithDelivery) and gift certificate price;
* @updated 27 January 2013;
*/
#}
<article class="container">

    <div class="m-t_10"></div>
    <div class="">
        <!-- We check, if you come to the page for the first time, after the order -->
        {if $CI->session->flashdata('makeOrder') === true}
            <!-- Show greeting message  -->
            <h1 class="d_i v-a_m m-r_45">
                {lang("Thank you for your order.","admin")}
            </h1>
            <!-- Clear Cart locale Storage -->
            <script>{literal}$(document).ready(function() {
                    Shop.Cart.clear();
                }){/literal}
            </script>
        {/if}

        <!-- Start. Render goto profile button -->
        <a href="{shop_url('profile')}" class="btn v-a_m">
            {lang("Go to profile","admin")}
        </a>
        <!-- End. Render goto profile button -->

        <div class="row-fluid">

            <!-- Start. Displays a information block about Order -->
            <div class="frameGroupsForm span5">
                <div class="header_title">{lang("Order data","admin")}</div>
                <div class="inside_padd">
                    <table class="tableOrderData">
                        <!-- Start. Render Order number -->
                        <tr>
                            <th>{lang("Order","admin")} #:</th>
                            <td>{echo ShopCore::encode($model->getId())}</td>
                        </tr>
                        <!-- End. Render Order number -->

                        <!-- Start. Display Paid status -->
                        <tr>
                            <th>{lang("Paid","admin")}:</th>
                            <td>{if $model->getPaid() == true} {lang("Yes","admin")}{else:}{lang("No","admin")}{/if}</td>
                        </tr>
                        <!-- End. Display Paid status -->

                        <!-- Start. Show Order status name -->
                        <tr>
                            <th>{lang("Status","admin")}:</th>
                            <td>{echo SOrders::getStatusName('Id', $model->getStatus())}</td>
                        </tr>
                        <!-- End. Show Order status name -->
                        <!-- Start. Render certificate -->
                        {if $model->getGiftCertKey() != null}
                            <tr>
                                <th>{lang('Certificate')}: </th>
                                <td>-{echo ShopCore::app()->SCurrencyHelper->convert($model->getGiftCertPrice())} {$CS}</td>
                            </tr>
                        {/if}
                        <!-- End. Render certificate -->

                        <!-- Start. Render custom filds -->
                        {$customFilds = ShopCore::app()->CustomFieldsHelper->getCustomFields('order', $model->getId())->asArray();}
                        {foreach $customFilds as $customFild}
                            <tr>
                                <th>{$customFild.field_label}: </th>
                                <td>{$customFild.field_data}</td>
                            </tr>
                        {/foreach}
                        <!-- End. Render custom filds -->

                        <!-- Start. Delivery Method name -->
                        {if $model->getDeliveryMethod() > 0}
                            <tr>
                                <th>{lang("Delivery","admin")}:</th>
                                <td>{echo $model->getSDeliveryMethods()->getName()}</td>
                            </tr>
                        {/if}
                        <!-- End. Delivery Method name -->

                        <!-- Start. Render payment button and payment description -->
                        {if $model->getPaid() != true && $model->getTotalPriceWithGift() > 0}
                            <tr class="b_n">
                                <th></th>
                                <td>{echo $paymentMethod->getPaymentForm($model)}
                                    {if $paymentMethod->getDescription()}
                                        <div class="m-t_10 infoOrder" style="font-style: italic">{echo ShopCore::t($paymentMethod->getDescription())}</div>
                                    {/if}</td>
                            </tr>
                        {/if}
                        <!-- End. Render payment button and payment description -->

                    </table>
                </div>
            </div>
            <!-- End. Displays a information block about Order -->

            <div class="frameGroupsForm span7">
                <div class="header_title">Ваш заказ</div>
                <table class="table v-a_bas table_order">
                    <thead class="v_h">
                        <tr>
                            <td class="span1"></td>
                            <td class="span3"></td>
                            <td class="span2"></td>
                            <td class="span2"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Start. Render Ordered Products -->
                        {foreach $model->getOrderProducts() as $orderProduct}
                            {foreach $orderProduct->getSProducts()->getProductVariants() as $v}
                                {if $v->getid() == $orderProduct->variant_id}
                                    {$Variant = $v}
                                    {break;}
                                {/if}
                            {/foreach}
                            <tr>
                                <td class="v-a_m">
                                    <a href="{shop_url('product/'.$orderProduct->getSProducts()->getUrl())}" class="photo">
                                       {if $Variant} <figure>
                                            <img src="{echo $Variant->getSmallPhoto()}"
                                                 alt="{echo ShopCore::encode($orderProduct->product_name)} {echo ShopCore::encode($orderProduct->variant_name)}"/>
                                        </figure>{/if}
                                    </a>
                                </td>
                                <td>
                                    <a href="{shop_url('product/'.$orderProduct->getSProducts()->getUrl())}">{echo ShopCore::encode($orderProduct->product_name)}</a>
                                    <div class="m-b_10">

                                        {if $Variant}
                                        {if $Variant->getnumber()}<span class="frame_number">Артикул: <span class="code">({echo $Variant->getnumber()})</span></span>{/if}
                                    {if $Variant->getname()}<span class="frame_variant_name">Вариант: <span class="code">({echo $Variant->getname()})</span></span>{/if}
                                {/if}
                            </div>
                            <div class="price price_f-s_16">
                                <span class="first_cash"><span class="f-w_b">{echo ShopCore::app()->SCurrencyHelper->convert($orderProduct->getPrice())}</span> {$CS}</span>
                            </div>
                        </td>
                        <td>
                            <span class="c_8a">х</span>&nbsp;
                            <span class="f-w_b f-s_16">{echo $orderProduct->getQuantity()}</span> Шт.&nbsp;=
                        </td>
                        <td>
                            <div class="price price_f-s_16">
                                <span class="first_cash"><span class="f-w_b">{echo ShopCore::app()->SCurrencyHelper->convert($orderProduct->getPrice()*$orderProduct->getQuantity())}</span> {$CS}</span>
                            </div>
                        </td>
                    </tr>
                {/foreach}
                <!-- End. Render Ordered Products -->

                <!-- Start. Render Ordered kit products  -->
                {foreach $model->getOrderKits() as $orderProduct}
                    <tr>
                        <td colspan="4">
                            <ul class="items items_catalog">
                                <li>
                                    <ul class="items items_middle">

                                        <!-- Start. Display main product of Kit -->
                                        <li class="span4">
                                            <div class="item_set">
                                                <div class="description">
                                                    <a href="{shop_url('product/' . $orderProduct->getKit()->getMainProduct()->getUrl())}">
                                                        {echo ShopCore::encode($orderProduct->getKit()->getMainProduct()->getName())}
                                                    </a>
                                                    <div class="m-b_10">
                                                    {if $num = $orderProduct->getKit()->getMainProduct()->getFirstVariant()->getnumber()}<span class="frame_number">Артикул: <span class="code">({echo $num})</span></span>{/if}
                                                </div>
                                                <div class="price price_f-s_16">
                                                    <span class="f-w_b">
                                                        {echo $orderProduct->getKit()->getMainProductPrice()}
                                                    </span> {$CS}
                                                </div>
                                            </div>
                                            <div class="photo-block">
                                                <a href="{shop_url('product/' . $orderProduct->getKit()->getMainProduct()->getUrl())}" class="photo">
                                                    <figure>
                                                        <span class="helper"></span>
                                                        <img src="{echo $orderProduct->getKit()->getMainProduct()->firstVariant->getSmallPhoto()}"
                                                             alt="{echo ShopCore::encode($orderProduct->getKit()->getMainProduct()->getName())}"/>
                                                    </figure>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="d_i-b">+</div>
                                    </li>
                                    <!-- End. Display main product of Kit -->

                                    <!-- Start. Display kits products -->
                                    {foreach $orderProduct->getKit()->getShopKitProducts() as $key => $kitProducts}
                                        <li class="span4">
                                            <div class="item_set">
                                                <div class="description">
                                                    <a href="{shop_url('product/' . $kitProducts->getSProducts()->getUrl())}">
                                                        {echo ShopCore::encode($kitProducts->getSProducts()->getName())}
                                                    </a>

                                                    <div class="m-b_10">
                                                    {if $num = $kitProducts->getSProducts()->getFirstVariant()->getnumber()}<span class="frame_number">Артикул: <span class="code">({echo $num})</span></span>{/if}
                                                </div>

                                                <div class="price price_f-s_16">
                                                    <span class="f-w_b">
                                                        {echo $kitProducts->getKitNewPrice()}
                                                    </span>{$CS}
                                                </div>
                                            </div>
                                            <div class="photo-block">
                                                <a href="{shop_url('product/' . $kitProducts->getSProducts()->getUrl())}" class="photo">
                                                    <figure>
                                                        <span class="helper"></span>
                                                        <img src="{echo $kitProducts->getSProducts()->firstVariant->getSmallPhoto()}"
                                                             alt="{echo ShopCore::encode($orderProduct->product_name)}"/>
                                                    </figure>
                                                </a>
                                            </div>
                                            <span class="top_tovar discount">-{echo $kitProducts->getDiscount()}%</span>
                                        </div>
                                        <div class="d_i-b">{if $orderProduct->getKit()->countProducts() != $key}+{/if}</div>
                                    </li>
                                {/foreach}
                                <!-- End. Display kits products -->

                            </ul>
                            <img src="{$THEME}images/gen_sum.png" alt="gen_sum"/>



                            <!-- Start. Render kit summary -->
                            <div class="c_97">(Количество комплектов - {echo $orderProduct->getQuantity()})</div>
                            <div class="price price_f-s_18"><span class="f-w_b">{echo $orderProduct->getKit()->getTotalPrice()}</span>&nbsp;{$CS}</div>
                            <!-- End. Render kit summary -->

                        </li>
                    </ul>
                </td>
            </tr>
        {/foreach}
        <!-- End. Render Ordered kit products  -->

    </tbody>
    <tfoot>

        <!-- Start. Display Order summary -->
        <tr>
            <td colspan="4">
                <div class="t-a_r inside_padd">
                    <div class="form_alert">
                        <div class="c_97" style="margin-bottom: 4px;">
                            (Сумма товаров: <span class="f-w_b">{if $model->getOriginPrice()}{echo ShopCore::app()->SCurrencyHelper->convert($model->getOriginPrice())}{else:}{echo $model->gettotalprice()}{/if}</span> {$CS})
                        {if $CI->load->module('mod_discount')->check_module_install()}{if $model->getdiscount()}<br/>(Сумма скидки: <span class="f-w_b">{echo ShopCore::app()->SCurrencyHelper->convert($model->getdiscount())}</span> {$CS}){/if}{/if}


                    {if $model->getGiftCertPrice() > 0}<br><span >(Скидка подарочного сертификата: {echo ShopCore::app()->SCurrencyHelper->convert($model->getGiftCertPrice())} {$CS}<span class="f-w_b"></span> )</span>{/if}
                    <br/>(+ Доставка: <span class="f-w_b">{if $model->getTotalPrice() >= $freeFrom && $freeFrom != 0}{echo $delivery = 0}{else:}{echo $delivery = ShopCore::app()->SCurrencyHelper->convert($model->getDeliveryPrice())}{/if}</span> {$CS})
                </div>

                {//$CI->load->module('mod_discount/discount_api')->get_all_discount_information(1, $model->getOriginPrice())}


                <span class="f-s_18">Сумма:</span>&nbsp;
                <span class="f-s_24">{echo $model->getTotalPrice() + $delivery}</span>&nbsp;
                <span class="f-s_24"> {$CS}</span>
                {//var_dump(json_decode($model->getdiscountinfo()))}

            </div>
        </div>
    </td>
</tr>
<!-- End. Display Order summary -->

</tfoot>
</table>

</div>
</div>
</div>
</article>